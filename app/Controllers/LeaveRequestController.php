<?php
// app/Controllers/LeaveRequestController.php
require_once __DIR__ . '/../Models/LeaveModel.php';

class LeaveRequestController
{
    private $model;
    private ?string $lastError = null;

    public function __construct()
    {
        $this->model = new LeaveModel();
    }

    /* -------- PAGES (render views) -------- */

    public function index(int $studentID): void
    {
        $rows = $this->model->allByStudent($studentID);
        include __DIR__ . '/../../Views/Parent/leave_list.php';
    }

    public function create(?int $studentID, ?string $studentName): void
    {
        $mode = 'create';
        $data = [];
        // pass identity (hidden if not in $_SESSION)
        $studentID   = $studentID   ?? null;
        $studentName = $studentName ?? null;

        include __DIR__ . '/../../Views/Parent/leave_form.php';
    }

    public function edit(int $studentID, int $id): void
    {
        $row = $this->model->findById($id, $studentID);
        if (!$row) {
            header('Location: ?action=index'); exit;
        }

        $mode = 'edit';
        $data = [
            'request_id'     => $row['request_id'],
            'from_date'      => $row['from_date'],
            'to_date'        => $row['to_date'],
            'reason_details' => $row['reason'],
        ];
        include __DIR__ . '/../../Views/Parent/leave_form.php';
    }

    /* -------- ACTIONS (POST) -------- */

    public function store(int $studentID, string $studentName, array $post): void
    {
        [$from, $to, $reason, $errors] = $this->validate($post);
        if ($errors) {
            $this->flashBack($errors, 'create');
            return;
        }
        $ok = $this->model->create($studentID, $studentName, $reason, $from, $to);
        header('Location: ?action=index&ok=saved'); exit;
    }

    public function update(int $studentID, array $post): void
    {
        $id = (int)($post['request_id'] ?? 0);
        if ($id <= 0) { header('Location: ?action=index'); exit; }

        [$from, $to, $reason, $errors] = $this->validate($post);
        if ($errors) {
            $this->flashBack($errors, 'edit&id='.$id);
            return;
        }
        $ok = $this->model->update($id, $studentID, $reason, $from, $to);
        header('Location: ?action=index&ok=updated'); exit;
    }

    public function destroy(int $studentID, int $id): void
    {
        if ($id > 0) {
            $this->model->delete($id, $studentID);
        }
        header('Location: ?action=index&ok=deleted'); exit;
    }

    /* -------- Helpers -------- */

    private function validate(array $post): array
    {
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

    private function flashBack(array $errors, string $where): void
    {
        // Keep it simple: go back to form page with a quick message.
        // (You can build a full flash system later.)
        $msg = urlencode(implode(' ', $errors));
        header("Location: ?action={$where}&error={$msg}");
        exit;
    }

    /* Raw methods for AJAX (optional; you have them already) */
    public function storeRaw(int $studentID, string $studentName, array $post): bool {
        [$from,$to,$reason,$errors] = $this->validate($post);
        if ($errors) { $this->lastError = implode('; ',$errors); return false; }
        return $this->model->create($studentID, $studentName, $reason, $from, $to);
    }
    public function updateRaw(int $studentID, array $post): bool {
        $id = (int)($post['request_id'] ?? 0);
        if ($id<=0) { $this->lastError='Invalid request id.'; return false; }
        [$from,$to,$reason,$errors] = $this->validate($post);
        if ($errors) { $this->lastError = implode('; ',$errors); return false; }
        return $this->model->update($id, $studentID, $reason, $from, $to);
    }
    public function destroyRaw(int $studentID, int $id): bool {
        if ($id<=0) { $this->lastError='Invalid request id.'; return false; }
        return $this->model->delete($id, $studentID);
    }
    public function getLastError(): ?string { return $this->lastError; }
}
