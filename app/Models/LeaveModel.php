<?php

require_once './../../config/dbconfig.php';
class LeaveModel
{
  private $conn;
  private $table = "Leave_Request";

  public function __construct()
  {
    $database = new Database();
    $this->conn = $database->getConnection();
    if ($this->conn === null) {
      throw new Exception("Database connection could not be established.");
    } else {
      // echo "Database connection established in LeaveModel.";
    }
  }
  public function checkConnection()
  {
    return $this->conn !== null;
  }
  public function createLeaveRequest(array $data): bool
  {
    $sql = "INSERT INTO " . $this->table . " (teacher_id, grade, class, start_date, end_date, reason, status) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param(
      "iisssss",
      $data['teacher_id'],
      $data['grade'],
      $data['class'],
      $data['start_date'],
      $data['end_date'],
      $data['reason'],
      $data['status']
    );
    return $stmt->execute();
  }
  public function updateLeaveRequestStatus(int $requestId, string $status): bool
  {
    $sql = "UPDATE " . $this->table . " SET status = ? WHERE request_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("si", $status, $requestId);
    return $stmt->execute();
  }
  public function getLeaveRequestById(int $requestId): ?array
  {
    $sql = "SELECT * FROM " . $this->table . " WHERE request_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $requestId);
    $stmt->execute();
    $result = $stmt->get_result();
    $request = $result->fetch_assoc();
    return $request ?: null;
  }
  public function getRequestsForTeacher(?int $grade = null, ?string $class = null): array
  {
    $query = "SELECT * FROM " . $this->table;
    $conditions = [];
    $params = [];
    $types = "";

    if ($grade !== null) {
      $conditions[] = "grade = ?";
      $params[] = $grade;
      $types .= "i";
    }
    if ($class !== null) {
      $conditions[] = "class = ?";
      $params[] = $class;
      $types .= "s";
    }

    if (count($conditions) > 0) {
      $query .= " WHERE " . implode(" AND ", $conditions);
    }

    $stmt = $this->conn->prepare($query);
    if ($stmt === false) {
      throw new Exception("Failed to prepare statement: " . $this->conn->error);
    }

    if (!empty($params)) {
      $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $requests = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $requests;
  }

}