<?php

class User
{
    protected $table = 'user';
    protected $id = 'userID';

    protected $allowedFields = ['userID', 'fName', 'lName', 'email', 'phone', 'dateOfBirth', 'gender', 'password', 'role'];
    protected $validationRules = [
        'fName' => 'required|min_length[5]|max_length[30]',
        'lName' => 'required|min_length[5]|max_length[30]',
        'email' => 'required|valid_email|is_unique[user.email,id,{id}]',
        'phone' => 'required|min_length[10]|max_length[15]',
        'dateOfBirth' => 'required|valid_date',
        'gender' => 'required|in_list[male,female]',
        'role' => 'required|in_list[student,teacher,mp,admin, parent]',
        'password' => 'required|min_length[8]|max_length[255]',
    ];

    
}
