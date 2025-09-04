<?php
require_once __DIR__ . '/../Models/materialModel.php';
require_once __DIR__ . '/../../config/dbconfig.php';

class MaterialController
{
    private $materialModel;

    public function __construct()
    {
        $this->materialModel = new Material();
    }

    public function addMaterial($grade, $class, $subject, $title, $description, $file)
    {

        $target_dir = "../../storage/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir . basename($file["name"]);
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            // Store only the relative path or file name
            $filePath = basename($file["name"]);
            $this->materialModel->addMaterial($grade, $class, $subject, $title, $description, $filePath);
            return true;
        } else {
            return false;
        }
    }

    public function getTeacherMaterials()
    {
        $materials = $this->materialModel->showMaterials();
        include_once __DIR__ . '../../Views/Teacher/Materials/showMaterials.php';
    }

    public function removeMaterial($materialID)
    {
        return $this->materialModel->deleteMaterial($materialID);
    }

    public function hideMaterial($materialID)
    {
        return $this->materialModel->hideVisibility($materialID);
    }

    public function unhideMaterial($materialID)
    {
        return $this->materialModel->unhideMaterial($materialID);
    }

    public function getStudentMaterial($grade, $class)
    {
        $result = $this->materialModel->getMaterial($grade, $class);
        return $result;
    }

    public function downloadMaterial($materialID)
    {
        $fileName = $this->materialModel->fetchFileName($materialID);
        $fileLocation = __DIR__ . '/../../storage/' . $fileName;

        if (is_file($fileLocation)) {
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $fileName . '"');
            header('Content-Length: ' . filesize($fileLocation));
            readfile($fileLocation);
            exit;
        } else {
            echo "<H1>File not found</H1>";
        }
    }
}
