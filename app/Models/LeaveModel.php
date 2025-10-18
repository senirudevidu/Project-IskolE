<?php
require_once __DIR__ . '/../../config/dbconfig.php';

class LeaveModel {
  private mysqli $conn;

  public function __construct() {
    $db = new Database();
    $this->conn = $db->getConnection();
  }

  /* CREATE */
  public function create(int $studentID, string $studentName, string $reason, string $fromDate, string $toDate): bool {
    // Keep legacy `date` column equal to `from_date` for compatibility
    $sql = "INSERT INTO `Leave_Request`
              (student_id, student_name, reason, date, from_date, to_date)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $this->conn->prepare($sql);
    if (!$stmt) return false;
    $date = $fromDate;
    $stmt->bind_param("isssss", $studentID, $studentName, $reason, $date, $fromDate, $toDate);
    $ok = $stmt->execute();
    $stmt->close();
    return $ok;
  }

  /* READ: all by student */
  public function allByStudent(int $studentID): array {
    $sql  = "SELECT request_id, student_id, student_name, reason, date, from_date, to_date
             FROM `Leave_Request`
             WHERE student_id = ?
             ORDER BY request_id DESC";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $studentID);
    $stmt->execute();
    $res = $stmt->get_result();
    $rows = $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    $stmt->close();
    return $rows;
  }

  /* READ: one by id (scoped) */
  public function findById(int $requestID, int $studentID): ?array {
    $sql  = "SELECT request_id, student_id, student_name, reason, date, from_date, to_date
             FROM `Leave_Request`
             WHERE request_id = ? AND student_id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ii", $requestID, $studentID);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res ? $res->fetch_assoc() : null;
    $stmt->close();
    return $row ?: null;
  }

  /* UPDATE */
  public function update(int $requestID, int $studentID, string $reason, string $fromDate, string $toDate): bool {
    $sql  = "UPDATE `Leave_Request`
             SET reason = ?, date = ?, from_date = ?, to_date = ?
             WHERE request_id = ? AND student_id = ?";
    $stmt = $this->conn->prepare($sql);
    if (!$stmt) return false;
    $date = $fromDate;
    $stmt->bind_param("ssssii", $reason, $date, $fromDate, $toDate, $requestID, $studentID);
    $ok = $stmt->execute();
    $stmt->close();
    return $ok;
  }

  /* DELETE */
  public function delete(int $requestID, int $studentID): bool {
    $stmt = $this->conn->prepare("DELETE FROM `Leave_Request` WHERE request_id = ? AND student_id = ?");
    $stmt->bind_param("ii", $requestID, $studentID);
    $ok = $stmt->execute();
    $stmt->close();
    return $ok;
  }

  /* TEACHER VIEW (optionally filter by grade/class) */
  public function getRequestsForTeacher(?int $gradeFilter = null, ?string $classFilter = null): array {
    $sql = "SELECT 
              lr.request_id,
              lr.student_id,
              lr.student_name,
              lr.reason,
              lr.from_date,
              lr.to_date,
              s.regNumber,
              s.grade,
              s.class,
              CONCAT(u.firstName, ' ', u.lastName) AS full_name
            FROM `Leave_Request` lr
            JOIN `student` s ON s.studentID = lr.student_id
            LEFT JOIN `user` u ON u.userID = s.userID
            WHERE 1=1";
    $types = '';
    $params = [];
    if ($gradeFilter !== null) { $sql .= " AND s.grade = ?"; $types.='i'; $params[]=$gradeFilter; }
    if ($classFilter !== null && $classFilter !== '') { $sql .= " AND s.class = ?"; $types.='s'; $params[]=$classFilter; }
    $sql .= " ORDER BY lr.request_id DESC";

    $stmt = $this->conn->prepare($sql);
    if ($types !== '') { $stmt->bind_param($types, ...$params); }
    $stmt->execute();
    $res = $stmt->get_result();
    $rows = $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    $stmt->close();
    return $rows;
  }
}
