<?php
// app/Models/LeaveModel.php
require_once __DIR__ . '/../../config/dbconfig.php';

class LeaveModel
{
    private mysqli $conn;

    public function __construct()
    {
        $db = new Database();
        $c = $db->getConnection();
        if (!$c) throw new Exception('DB connection failed');
        $this->conn = $c;
    }

    public function create(int $studentID, string $studentName, string $reason, string $from, string $to): bool
    {
        // Your table columns: request_id (AI), student_id, student_name, reason, date, from_date, to_date
        $sql  = "INSERT INTO Leave_Request (student_id, student_name, reason, date, from_date, to_date)
                 VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $date = $from; // keep 'date' same as from_date (per your schema)
        $stmt->bind_param('isssss', $studentID, $studentName, $reason, $date, $from, $to);
        return $stmt->execute();
    }

    public function allByStudent(int $studentID): array
    {
        $stmt = $this->conn->prepare(
            "SELECT request_id, student_id, student_name, reason, from_date, to_date, date
             FROM Leave_Request
             WHERE student_id = ?
             ORDER BY request_id DESC"
        );
        $stmt->bind_param('i', $studentID);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function findById(int $id, int $studentID): ?array
    {
        $stmt = $this->conn->prepare(
            "SELECT request_id, student_id, student_name, reason, from_date, to_date, date
             FROM Leave_Request
             WHERE request_id = ? AND student_id = ?"
        );
        $stmt->bind_param('ii', $id, $studentID);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        return $row ?: null;
    }

    public function update(int $id, int $studentID, string $reason, string $from, string $to): bool
    {
        $stmt = $this->conn->prepare(
            "UPDATE Leave_Request
                SET reason = ?, from_date = ?, to_date = ?, date = ?
              WHERE request_id = ? AND student_id = ?"
        );
        $date = $from;
        $stmt->bind_param('ssssii', $reason, $from, $to, $date, $id, $studentID);
        return $stmt->execute();
    }

    public function delete(int $id, int $studentID): bool
    {
        $stmt = $this->conn->prepare("DELETE FROM Leave_Request WHERE request_id = ? AND student_id = ?");
        $stmt->bind_param('ii', $id, $studentID);
        return $stmt->execute();
    }
}
