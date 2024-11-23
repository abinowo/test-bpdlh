<?php

use App\Models\User;

/**
 * [helper] get role name
 *
 * @return string
 */
if (!function_exists('getRoleName')) {
    function getRoleName($arr = null)
    {
        if (isset($arr['user'])) {
            $user = $arr['user'];

            return trUc(str_replace('_', ' ', $user->getRoleNames()[0]));
        }

        return trUc(str_replace('_', ' ', auth()->user()->getRoleNames()[0]));
    }
}

/**
 * [helper] get role name slug
 *
 * @return string
 */
if (!function_exists('getRoleNameSlug')) {
    function getRoleNameSlug($arr = null)
    {
        if (isset($arr['user'])) {
            $user = $arr['user'];

            return strtolower($user->getRoleNames()[0]);
        }

        return strtolower(auth()->user()->getRoleNames()[0]);
    }
}

/**
 * [helper] get user data
 *
 * @return User
 */
if (!function_exists('getUserData')) {
    function getUserData()
    {
        $user = User::where('uuid', auth()->user()->uuid ?? null)->first();

        return $user;
    }
}
