<?php
require_once __DIR__ . '/../Models/studentModel.php';

class StudentController
{
    private $studentModel;

    public function __construct()
    {
        $this->studentModel = new Student();
    }

    public function getSpecificClass($grade, $class)
    {
        $students = $this->studentModel->stdOnSpecificClass($grade, $class);
        return $students;
    }
}
