<?php
require_once __DIR__ . '../Models/LeaveModel.php';

class LeaveRequestController {
  private $model;           // use untyped if you’re on older PHP
  private ?string $lastError = null;

  public function __construct() {
    $this->model = new LeaveModel();
  }

  public function storeRaw(int $studentID, string $studentName, array $post): bool {
    [$from, $to, $reason, $errors] = $this->validate($post);
    if ($errors) { $this->lastError = implode('; ', $errors); return false; }
    return $this->model->create($studentID, $studentName, $reason, $from, $to);
  }

  public function updateRaw(int $studentID, array $post): bool {
    $rid = (int)($post['request_id'] ?? 0);
    if ($rid <= 0) { $this->lastError = 'Invalid request id.'; return false; }
    [$from, $to, $reason, $errors] = $this->validate($post);
    if ($errors) { $this->lastError = implode('; ', $errors); return false; }
    return $this->model->update($rid, $studentID, $reason, $from, $to);
  }

  public function destroyRaw(int $studentID, int $requestID): bool {
    if ($requestID <= 0) { $this->lastError = 'Invalid request id.'; return false; }
    return $this->model->delete($requestID, $studentID);
  }

  public function getLastError(): ?string { return $this->lastError; }

  private function validate(array $post): array {
    $from   = trim((string)($post['from_date'] ?? ''));
    $to     = trim((string)($post['to_date'] ?? ''));
    $reason = trim((string)($post['reason_details'] ?? ''));
    $errors = [];

    if ($from === '')   $errors[] = 'From date is required.';
    if ($to === '')     $errors[] = 'To date is required.';
    if ($reason === '') $errors[] = 'Reason is required.';

    if (!$errors) {
      try {
        $df = new DateTime($from);
        $dt = new DateTime($to);
        if ($dt < $df) $errors[] = 'To date must be on or after From date.';
      } catch (Throwable $e) {
        $errors[] = 'Invalid date format.';
      }
    }
    return [$from, $to, $reason, $errors];
  }
}
