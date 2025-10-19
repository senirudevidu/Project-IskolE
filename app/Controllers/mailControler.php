<?php

class MailController
{
    public function sendWelcomeEmail($userEmail, $fName, $password)
    {
        $subject = "Welcome to IskolE";
        $message = "Hello $fName,\n\nYour account has been created successfully.\n\nYour password is: $password\n\nThank you!";
        $headers = "From: iskole.2y@gmail.com";
        if (mail($userEmail, $subject, $message, $headers)) {
            echo "Welcome email sent to $userEmail";
        } else {
            echo "Failed to send welcome email to $userEmail";
        }
    }
}
