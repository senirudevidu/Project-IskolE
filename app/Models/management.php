<?php

class Management
{
    protected $table = 'MP';
    protected $primaryKey = 'mpId';
    protected $allowedFields = ['mpId', 'fName', 'lName', 'email', 'phone', 'addressL1', 'addressL2', 'addressL3', 'dateOfBirth', 'gender', 'nic'];

    protected $validationRules = [
        'fName' => 'required|min_length[5]|max_length[30]',
        'lName' => 'required|min_length[5]|max_length[30]',
        'email' => 'required|valid_email|is_unique[managements.email,id,{id}]',
        'phone' => 'required|min_length[10]|max_length[15]',
        'addressL1' => 'required|max_length[255]',
        'addressL2' => 'max_length[255]',
        'addressL3' => 'max_length[255]',
        'dateOfBirth' => 'required|valid_date',
        'gender' => 'required|in_list[male,female,other]',
        'nic' => 'required|max_length[12]',
    ];

    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }
}