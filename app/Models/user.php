<?php

class User
{
    protected $Userable = 'user';
    protected $Userid = 'userID';
    protected $UserAllowedFields = ['userID', 'fName', 'lName', 'email', 'phone', 'dateOfBirth', 'gender', 'password', 'role'];

    protected $userConn;
    function __construct()
    {
    }
}
