<?php 
class SubjectController {
    function index() {
        $subjectRepository = new SubjectRepository();
        $search = $_GET['search'] ?? null;
        if ($search) {
            $subjects = $subjectRepository->getByPattern($search);
        }
        else {
            $subjects = $subjectRepository->getAll();
        }
        $subjects = $subjectRepository->getAll();
        require 'view/subject/index.php';
    }
    function create() {
        require 'view/subject/create.php';
    }
    function store() {
        $subjectRepository = new SubjectRepository();
        $data= $_POST;
        if ($subjects = $subjectRepository->save($data)) {
            $_SESSION['success'] = 'Đã tạo môn học thành công';
        }
        else {
            $_SESSION['error'] = $subjectRepository->error; 
        }
        header('location: ?c=subject');
    }
    function edit() {
        $id = $_GET['id'];
        $subjectRepository = new SubjectRepository();
        $subject = $subjectRepository->find($id);
        require 'view/subject/edit.php';
    }
    function update() {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $number_of_credit = $_POST['number_of_credit'];
        $subjectRepository = new SubjectRepository();
        $subject = $subjectRepository->find($id);
        $subject->name = $name;
        $subject->number_of_credit = $number_of_credit;
      
        if ($subjectRepository->update($subject)) {
            $_SESSION['success'] = ' Đã cập nhật môn học thành công';
        }
        else {
            $_SESSION['error'] = $subjectRepository->error;
        }
        header('location: ?c=subject');
    }
    function destroy() {
        $id = $_GET['id'];
        $subjectRepository = new SubjectRepository() ;
        if ($subjectRepository->destroy1($id)) {
            $_SESSION['success'] = 'Đã xóa xinh viên thành công';
        }
        else {
            $_SESSION['error'] =  $subjectRepository->error;
        }
        header('location: ?c=subject');
    }

}
?>