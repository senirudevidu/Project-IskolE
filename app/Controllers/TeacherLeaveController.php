<?php
require_once __DIR__ . '/../Models/LeaveModel.php';

class TeacherLeaveController {
  private LeaveModel $model;
  public function __construct(){ $this->model = new LeaveModel(); }

  public function index(?int $grade=null, ?string $class=null): void {
    $rows = $this->model->getRequestsForTeacher($grade, $class);
    $this->render('teacher/absence_list', ['rows'=>$rows]);
  }

  private function render(string $view, array $params=[]): void {
    extract($params);
    include __DIR__ . "/../Views/{$view}.php";
  }
}
