<?php

namespace App\Observers\User;

use App\User;

class LdapObserver
{

    /**
     * Update the user in LDAP.
     *
     * @param User $user
     */
    public function saved(User $user)
    {
        if (!config('ldap.sync')) {
            return;
        }

        $ldapUrl = config('ldap.url');
        $ldapBase = config('ldap.base');
        $ldapUsername = config('ldap.username');
        $ldapPassword = config('ldap.password');

        $userName = strtolower($user->username);

        $dn = sprintf('uid=%s,ou=people,%s', $userName, $ldapBase);

        $conn = ldap_connect($ldapUrl);

        if ($conn && $userName) {
            $r = ldap_bind($conn, sprintf('cn=%s,%s', $ldapUsername, $ldapBase), $ldapPassword);
            if ($r) {
                $info['objectclass'][0] = 'person';
                $info['objectclass'][1] = 'organizationalPerson';
                $info['objectclass'][2] = 'inetOrgPerson';
                $info['objectclass'][3] = 'posixAccount';
                $info['objectclass'][4] = 'qmailUser';
                $info['uid'] = $userName;
                $info['userpassword'] = '{crypt}'. $user->crypt_password;
                $info['givenname'] = $user->firstname ?: $userName;
                $info['sn'] = $user->surname ?: ' ';
                $info['cn'] = $user->firstname .' '. $user->surname;
                $info['uidnumber'] = 10000 + $user->id;
                $info['gidnumber'] = 10000;
                $info['homedirectory'] = '/home/air-stream/'. $userName;
                $info['mail'] = $userName .'@air-stream.org';
                $info['accountstatus'] = 'active';
                $info['mailMessageStore'] = '/air-stream/'. $userName .'/';
                $info['deliveryMode'] = 'localdelivery';
                $info['description'] = $user->nas_password ?: null;

                if ($user->forward_email) {
                    $info['mailforwardingaddress'] = $user->email;
                    $info['deliveryMode'] = 'forwardonly';
                }

                $sr = ldap_search($conn, $ldapBase, 'uid='. $userName);

                if (ldap_count_entries($conn, $sr) > 0) {
                    ldap_delete($conn, $dn);
                }
                ldap_add($conn, $dn, array_filter($info));
            }

            ldap_close($conn);
        }
    }
}
