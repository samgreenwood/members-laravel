<?php

namespace App\Observers\User;

use App\User;

class LdapObserver
{
    /**
     * @param User $user
     */
    public function created(User $user)
    {
        $this->sync($user);
    }

    /**
     * @param User $user
     */
    public function updated(User $user)
    {
        $this->sync($user);
    }

    /**
     * Create the user in LDAP.
     *
     * @param User $user
     */
    private function sync(User $user)
    {
        if (!config('ldap.sync')) {
            return;
        }

        $ldapUrl = config('ldap.url');
        $ldapBase = config('ldap.base');
        $ldapUsername = config('ldap.username');
        $ldapPassword = config('ldap.password');

        $dn = sprintf('uid=%s,ou=people,%s', $user->username, $ldapBase);

        $conn = ldap_connect($ldapUrl);

        if ($conn) {
            $r = ldap_bind($conn, sprintf('cn=%s,%s', $ldapUsername, $ldapBase), $ldapPassword);
            if ($r) {
                $info['objectclass'][0] = 'person';
                $info['objectclass'][1] = 'organizationalPerson';
                $info['objectclass'][2] = 'inetOrgPerson';
                $info['objectclass'][3] = 'posixAccount';
                $info['objectclass'][4] = 'qmailUser';
                $info['uid'] = $user->username;
                $info['userpassword'] = '{crypt}' . $user->crypt_password;
                $info['givenname'] = $user->firstname;
                $info['sn'] = $user->lastname;
                $info['cn'] = $user->firstname.' '.$user->lastname;
                $info['uidnumber'] = 10000 + $user->id;
                $info['gidnumber'] = 10000;
                $info['homedirectory'] = '/home/air-stream/'.$user->username;
                $info['mail'] = $user->username.'@air-stream.org';
                $info['accountstatus'] = 'active';
                $info['mailMessageStore'] = '/air-stream/'.$user->username.'/';
                $info['deliveryMode'] = 'localdelivery';

                if ($user->forward_email) {
                    $info['mailforwardingaddress'] = $this->email;
                    $info['deliveryMode'] = 'forwardonly';
                }

                $sr = ldap_search($conn, $ldapBase, 'uid='.$user->username);

                if (ldap_count_entries($conn, $sr) > 0) {
                    ldap_delete($conn, $dn);
                }

                ldap_add($conn, $dn, $info);
            }

            ldap_close($conn);
        }
    }
}
