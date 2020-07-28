<?php

namespace App\Role;

/***
 * Class UserRole
 * @package App\Role
 */
class UserRole {

    // const ROLE_ADMIN = 'ROLE_ADMIN';
    // const ROLE_MANAGEMENT = 'ROLE_MANAGEMENT';
    // const ROLE_FINANCE = 'ROLE_FINANCE';
    // const ROLE_ACCOUNT_MANAGER = 'ROLE_ACCOUNT_MANAGER';
    // const ROLE_SUPPORT = 'ROLE_SUPPORT';
    const ROLE_GENERAL = '50';
    const ROLE_ADMIN = '40';
    const ROLE_MODERATOR = '30';
    const ROLE_USER = '20';

    /**
     * @var array
     */
    protected static $roleHierarchy = [
        self::ROLE_GENERAL => ['*'],
        self::ROLE_ADMIN => [
            self::ROLE_MODERATOR,
            self::ROLE_USER,
        ],
        self::ROLE_MODERATOR => [
            self::ROLE_USER,
        ],
        self::ROLE_USER => [
        ],
    ];

    /**
     * @param string $role
     * @return array
     */
    public static function getAllowedRoles(string $role)
    {
        if (isset(self::$roleHierarchy[$role])) {
            return self::$roleHierarchy[$role];
        }

        return [];
    }

    /***
     * @return array
     */
    public static function getRoleList()
    {
        return [
            static::ROLE_GENERAL =>'General',
            static::ROLE_ADMIN => 'Admin',
            static::ROLE_MODERATOR => 'Moder',
            static::ROLE_USER => 'User',
        ];
    }

}