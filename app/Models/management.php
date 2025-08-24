<?php

class Management extends User
{
    protected $mpTable = 'MP';
    protected $mpPrimaryKey = 'mpId';
    protected $mpAllowedFields = ['mpId', 'userID', 'nic'];
}