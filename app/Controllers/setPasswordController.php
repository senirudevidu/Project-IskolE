<?php
require_once __DIR__ . '/../Models/password.php';

class SetPasswordController
{
    public function setPassword($userID, $newPassword)
    {
        $hashedPassword = Password::hashPassword($newPassword, $userID);
        $passwordModel = new Password();
        return $passwordModel->setPassword($userID, $hashedPassword);
    }
}
