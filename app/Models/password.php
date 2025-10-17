<?php
class Password
{
    public static function hashPassword($fName, $userId)
    {
        $password = $fName . $userId;
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public static function verifyPassword($password, $hash)
    {
        return password_verify($password, $hash);
    }
}