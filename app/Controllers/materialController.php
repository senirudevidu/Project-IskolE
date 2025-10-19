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

        $target_dir = __DIR__ . "/../storage/";
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
        $fileData = $this->materialModel->fetchFileName($materialID);

        // Check if file data exists
        if (!$fileData || !isset($fileData['file'])) {
            echo "<H1>File not found in database</H1>";
            return;
        }

        $fileName = $fileData['file']; // Extract filename from array
        $fileLocation = __DIR__ . '/../storage/' . $fileName;

        if (is_file($fileLocation)) {
            // Set headers for file download
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($fileName) . '"');
            header('Content-Length: ' . filesize($fileLocation));
            header('Cache-Control: no-cache, must-revalidate');
            header('Pragma: no-cache');

            // Read and output the file
            readfile($fileLocation);
            exit;
        } else {
            echo "<H1>File not found on server</H1>";
        }
    }

    public function editMaterial($materialID, $grade, $class, $subjectID, $title, $description, $file, $teacherID)
    {
        // If no new file provided, get the existing file name
        if ($file === null) {
            $existingFile = $this->materialModel->fetchFileName($materialID);
            $file = $existingFile['file'] ?? null;
        }

        return $this->materialModel->editMaterial($materialID, $grade, $class, $subjectID, $title, $description, $file, $teacherID);
    }
}


// Handle download request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['materialID']) && isset($_POST['download']) && $_POST['download'] == '1') {
    $controller = new MaterialController();
    $controller->downloadMaterial($_POST['materialID']);
}
