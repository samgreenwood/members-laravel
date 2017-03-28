<?php

namespace App\Observers\Group;

use App\Group;

class LdapObserver
{
    /**
     * @param Group $group
     */
    public function created(Group $group)
    {
        $this->sync($group);
    }

    /**
     * @param Group $group
     */
    public function updated(Group $group)
    {
        $this->sync($group);
    }

    /**
     * Create the user in LDAP
     *
     * @param Group $group
     */
    private function sync(Group $group)
    {
        if ( ! config('ldap.sync')) return;

        $ldapUrl = config('ldap.url');
        $ldapBase = config('ldap.base');
        $ldapUsername = config('ldap.username');
        $ldapPassword = config('ldap.password');

        $groupName = strtolower($group->name);

        $dn = sprintf("cn=%s,ou=groups,%s", $groupName, $ldapBase);

        $conn = ldap_connect($ldapUrl);

        if ($conn) {
            $r = ldap_bind($conn, sprintf("cn=%s,%s", $ldapUsername, $ldapBase), $ldapPassword);
            if ($r) {
                $info['objectclass'][0] = 'top';
                $info['objectclass'][1] = 'posixGroup';
                $info['cn'] = $groupName;
                $info['gidnumber'] = 10000 + $this->getId();
                $info['memberUid'] = $group->users->pluck('username');

                $sr = ldap_search($conn, $ldapBase, "cn=" . $groupName);

                if (ldap_count_entries($conn, $sr) > 0) {
                    ldap_delete($conn, $dn);
                } else {
                    ldap_add($conn, $dn, $info);
                }
                ldap_close($conn);
            }
        }
    }
}

