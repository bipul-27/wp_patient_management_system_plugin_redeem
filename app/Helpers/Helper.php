<?php

namespace FluentPlugin\App\Helpers;

class Helper
{
    public static function getAuthSettings()
    {
        return get_option('__fls_auth_settings', []);
    }

    public static function getUserRoles()
    {
        global $wp_roles;
        return $wp_roles->roles;
    }

    public static function getLowLevelRoles()
    {
        $roles = self::getUserRoles();
        $lowLevelRoles = [];

        foreach ($roles as $role => $details) {
            if (!empty($details['capabilities']['manage_options'])) {
                continue;
            }
            $lowLevelRoles[$role] = $details;
        }

        return $lowLevelRoles;
    }
}
