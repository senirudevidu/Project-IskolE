<?php
// app/Models/LeaveModel.php
require_once __DIR__ . '/../../config/dbconfig.php';

class LeaveModel
{
    private mysqli $conn;
    private string $table = "Leave_Request";

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
        if ($this->conn === null) {
            throw new Exception("Database connection could not be established.");
        }
    }

    public function checkConnection(): bool
    {
        return $this->conn !== null;
    }







private function findChildByParentUser(int $userID): ?array {
    $sql = "SELECT s.studentID, CONCAT(u.fName,' ',u.lName) AS full_name
            FROM parent p
            JOIN student s ON s.studentID = p.studentID
            JOIN user u    ON u.userID    = s.userID
            WHERE p.userID = ?
            ORDER BY p.parentID ASC
            LIMIT 1";
    $st = $this->conn->prepare($sql);
    $st->bind_param('i',$userID);
    $st->execute();
    $row = $st->get_result()->fetch_assoc();
    return $row ?: null;
}

private function findStudentByStudentUser(int $userID): ?array {
    $sql = "SELECT s.studentID, CONCAT(u.fName,' ',u.lName) AS full_name
            FROM parent p
            JOIN student s ON s.studentID = p.studentID
            JOIN user    u ON u.userID    = s.userID
            WHERE p.parentID = ?
            LIMIT 1"; 
    $st = $this->conn->prepare($sql);
    $st->bind_param('i',$userID);
    $st->execute();
    $row = $st->get_result()->fetch_assoc();
    return $row ?: null;
}

















private function resolveStudentName(int $studentId): ?string {
    $sql = "SELECT CONCAT(u.fName,' ',u.lName)
            FROM student s
            JOIN user u ON u.userID = s.userID
            WHERE s.studentID = ? LIMIT 1";
    $st = $this->conn->prepare($sql);
    $st->bind_param("i", $studentId);
    $st->execute();
    $name = $st->get_result()->fetch_column();
    return $name ?: null;
}





  public function createLeaveRequest(array $data): bool {
    $studentId   = isset($data['student_id']) ? (int)$data['student_id'] : null;
    $studentName = $data['student_name'] ?? null;
    $reason      = $data['reason'] ?? null;
    $fromDate    = $data['from_date'] ?? null;
    $toDate      = $data['to_date'] ?? null;

    if (!$reason || !$fromDate || !$toDate) {
        throw new Exception("Missing required fields.");
    }

    // fill name if only id present
    if ($studentId && !$studentName) {
        $studentName = $this->resolveStudentName($studentId);
    }

    // 👇 NEW: auto-fill via logged-in user
    if ((!$studentId || !$studentName) && !empty($data['user_id'])) {
        $uid = (int)$data['user_id'];

        if ($child = $this->findChildByParentUser($uid)) {
            $studentId   = $studentId   ?: (int)$child['studentID'];
            $studentName = $studentName ?: $child['full_name'];
        }

        if (!$studentId || !$studentName) {
            $sql = "SELECT s.studentID, CONCAT(u.fName,' ',u.lName) AS full_name
                    FROM student s
                    JOIN user u ON u.userID = s.userID
                    WHERE s.userID = ?
                    LIMIT 1";
            $st = $this->conn->prepare($sql);
            $st->bind_param('i',$uid);
            $st->execute();
            if ($row = $st->get_result()->fetch_assoc()) {
                $studentId   = $studentId   ?: (int)$row['studentID'];
                $studentName = $studentName ?: $row['full_name'];
            }
        }
    }
if ($studentId && $studentName) {
        $sql = "INSERT INTO {$this->table}
                (student_id, student_name, reason, from_date, to_date)
                VALUES (?,?,?,?,?)";
        $st = $this->conn->prepare($sql);
        $st->bind_param("issss", $studentId, $studentName, $reason, $fromDate, $toDate);
        return $st->execute();
    }

    // last resort (columns nullable නම් පමණි)
    $sql = "INSERT INTO {$this->table} (from_date, to_date, reason) VALUES (?,?,?)";
    $st  = $this->conn->prepare($sql);
    $st->bind_param("sss", $fromDate, $toDate, $reason);
    return $st->execute();
}

    /** ------------ READ: list (optionally by student) ------------ */
    public function listLeaveRequests(?int $studentId = null): array
    {
        if ($studentId !== null) {
            $sql = "SELECT request_id, student_id, student_name, reason, from_date, to_date
                    FROM {$this->table}
                    WHERE student_id = ?
                    ORDER BY request_id DESC";
            $stmt = $this->conn->prepare($sql);
            if (!$stmt) { throw new Exception($this->conn->error); }
            $stmt->bind_param("i", $studentId);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        $sql = "SELECT request_id, student_id, student_name, reason, from_date, to_date
                FROM {$this->table}
                ORDER BY request_id DESC";
        $res = $this->conn->query($sql);
        if (!$res) { throw new Exception($this->conn->error); }
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    /** ------------ READ: one ------------ */
    public function getLeaveRequestById(int $requestId): ?array
    {
        $sql = "SELECT request_id, student_id, student_name, reason, from_date, to_date
                FROM {$this->table}
                WHERE request_id = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) { throw new Exception($this->conn->error); }
        $stmt->bind_param("i", $requestId);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        return $row ?: null;
    }

    /** ------------ UPDATE (only the fields you pass) ------------ */
    public function updateLeaveRequest(int $requestId, array $data): bool
    {
        $fields = [];
        $params = [];
        $types  = "";

        if (isset($data['from_date']))  { $fields[] = "from_date = ?";  $params[] = $data['from_date'];  $types .= "s"; }
        if (isset($data['to_date']))    { $fields[] = "to_date = ?";    $params[] = $data['to_date'];    $types .= "s"; }
        if (isset($data['reason']))     { $fields[] = "reason = ?";     $params[] = $data['reason'];     $types .= "s"; }
        if (isset($data['student_id'])) { $fields[] = "student_id = ?"; $params[] = (int)$data['student_id']; $types .= "i"; }
        if (isset($data['student_name'])) { $fields[] = "student_name = ?"; $params[] = $data['student_name']; $types .= "s"; }

        if (empty($fields)) {
            // nothing to update
            return false;
        }

        $sql = "UPDATE {$this->table} SET " . implode(", ", $fields) . " WHERE request_id = ?";
        $params[] = $requestId;
        $types    .= "i";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) { throw new Exception($this->conn->error); }

        $stmt->bind_param($types, ...$params);
        return $stmt->execute();
    }

    /** ------------ DELETE ------------ */
    public function deleteLeaveRequest(int $requestId): bool
    {
        $sql = "DELETE FROM {$this->table} WHERE request_id = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) { throw new Exception($this->conn->error); }
        $stmt->bind_param("i", $requestId);
        return $stmt->execute();
    }

    /* -----------------------------------------------------------------
       OPTIONAL: only keep if your table really has a `status` column
       ----------------------------------------------------------------- */
    public function updateLeaveRequestStatus(int $requestId, string $status): bool
    {
        // Remove this method if there is no `status` column in your table.
        $sql = "UPDATE {$this->table} SET status = ? WHERE request_id = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) { throw new Exception($this->conn->error); }
        $stmt->bind_param("si", $status, $requestId);
        return $stmt->execute();
    }
}