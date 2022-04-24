<?php 
class RegisterController {
    function index() {
        $registerRepository = new RegisterRepository();
        $search = $_GET['search'] ?? null;
        if ($search) {
            $registers = $registerRepository->getByPattern($search);
        }
        else {
            $registers = $registerRepository->getAll();
        }
        require 'view/register/index.php';
    }
    function create() {
        $studentRepository = new StudentRepository();
        $students = $studentRepository->getAll();

        $subjectRepository = new SubjectRepository();
        $subjects = $subjectRepository->getAll();
        require 'view/register/create.php';
    }
    function store() {
        $registerRepository = new RegisterRepository();
        $data= $_POST;
        if ($registerRepository->save($data)) {
            $_SESSION['success'] = 'Đã tạo đăng ký đăng ký môn học thành công';
        }
        else {
            $_SESSION['error'] = $registerRepository->error; 
        }
        header('location: ?c=register');
        
    }
    function edit() {
        $id = $_GET['id'];
        $registerRepository = new RegisterRepository();
        $register = $registerRepository->find($id);
        require 'view/register/edit.php';
    }
    function update() {
        $id = $_POST['id'];
        // $student_id = $_POST['student_id'];
        // $subject_id = $_POST['subject_id'];
        $score = $_POST['score'];
        $registerRepository = new RegisterRepository();
        $register = $registerRepository->find($id);
        // $register->student_id = $student_id;
        // $register->subject_id = $subject_id;
        $register->score = $score;
        if ($registerRepository->update($register)) {
            $_SESSION['success'] = ' Đã cập nhật điểm thành công';
        }
        else {
            $_SESSION['error'] = $registerRepository->error;
        }
        header('location: ?c=register');
    }
    function destroy() {
        $id = $_GET['id'];
        $registerRepository = new RegisterRepository() ;
        if ($registerRepository->destroy1($id)) {
            $_SESSION['success'] = 'Đã xóa xinh viên thành công';
        }
        else {
            $_SESSION['error'] =  $registerRepository->error;
        }
        header('location: ?c=register');
    }

}
?>