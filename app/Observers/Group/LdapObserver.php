<?php

namespace App\Observers\Group;

use App\Group;

class LdapObserver
{

    /**
     * Update the group in LDAP.
     *
     * @param Group $group
     */
    public function saved(Group $group)
    {
        if (!config('ldap.sync')) {
            return;
        }

        $ldapUrl = config('ldap.url');
        $ldapBase = config('ldap.base');
        $ldapUsername = config('ldap.username');
        $ldapPassword = config('ldap.password');

        $groupName = strtolower($group->name);

        $dn = sprintf('cn=%s,ou=groups,%s', $groupName, $ldapBase);

        $conn = ldap_connect($ldapUrl);

        if ($conn && $groupName) {
            $r = ldap_bind($conn, sprintf('cn=%s,%s', $ldapUsername, $ldapBase), $ldapPassword);
            if ($r) {
                $info['objectclass'][0] = 'top';
                $info['objectclass'][1] = 'posixGroup';
                $info['cn'] = $groupName;
                $info['gidnumber'] = 10000 + $group->id;
                if ($group->users->count()) {
                  $info['memberUid'] = array_map('strtolower', $group->users->pluck('username')->toArray());
                }

                try {

                  $sr = ldap_search($conn, $ldapBase, 'cn='. $groupName);

                  if (ldap_count_entries($conn, $sr) > 0) {
                      ldap_delete($conn, $dn);
                  }
                } catch (\ErrorException $e) {
                }

                ldap_add($conn, $dn, $info);
            }

            ldap_close($conn);
        }
    }
}
