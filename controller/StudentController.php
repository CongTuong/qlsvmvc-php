<?php 
class StudentController {
    function index() {
        $studentRepository = new StudentRepository();
        $students = $studentRepository->getAll();
        require 'view/student/index.php';
    }
    function create() {
        require 'view/student/create.php';
    }
    function store() {
        $studentRepository = new StudentRepository();
        $data= $_POST;
       
        if ($students = $studentRepository->save($data)) {
            $_SESSION['success'] = 'Đã tạo sinh viên thành công';
        }
        else {
            $_SESSION['error'] = $studentRepository->error; 
        }
        header('location: /');
    }
    function edit() {
        $id = $_GET['id'];
        $studentRepository = new StudentRepository();
        $student = $studentRepository->find($id);
        require 'view/student/edit.php';
    }
    function update() {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $birthday = $_POST['birthday'];
        $gender = $_POST['gender'];
        $studentRepository = new StudentRepository();
        $student = $studentRepository->find($id);
        $student->name = $name;
        $student->birthday = $birthday;
        $student->gender = $gender;
       
        if ($studentRepository->update($student)) {
            $_SESSION['success'] = ' Đã cập nhật sinh viên thành công';
        }
        else {
            $_SESSION['error'] = $studentRepository->error;
        }
        header('location: /');
    }
    function destroy() {
        $id = $_GET['id'];
        $studentRepository = new StudentRepository() ;
        if ($studentRepository->destroy1($id)) {
            $_SESSION['success'] = 'Đã xóa xinh viên thành công';

        }
        else {
            $_SESSION['error'] =  $studentRepository->error;
        }
        header('location:/');
    }

}
?>