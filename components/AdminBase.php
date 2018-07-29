<?php
/**
 * Abstract class AdminBase contains common logic
 * for controllers of admin panel
 */
abstract class AdminBase
{
    /**
     * Method checks if the user is admin
     * @return boolean
     */
    public static function checkAdmin()
    {
        // Check if the user is logged in. If not -> redirect
        $userId = User::checkLogged();
        // Get info about current user
        $user = User::getUserById($userId);
        // If the user's role is "admin", then it's ok
        if ($user['role'] == 'admin') {
            return true;
        }
        // or Access denied
        die('Access denied');
    }
}