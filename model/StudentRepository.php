<?php 
class StudentRepository {
    public $error;
    protected function fetch($cond = null) {
        global $conn; // để bên trong hàm có thể truy xuất biến bên ngoài hàm
        $sql = "SELECT * FROM student";
        if ($cond) {
            $sql .= " WHERE $cond";
        }
       $result = $conn->query($sql);
       $students = [];
       if ($result->num_rows > 0 ) {
           while ($row = $result->fetch_assoc()) {
               // [] là thêm 1 phần tử vào cuối danh sách
               $students[] = new Student($row['id'],$row['name'],$row['birthday'],$row['gender']) ;
           }
       }
       return $students;
    }
    function getAll() {
        $students = $this->fetch();
        return $students;
    }
    function find($id) {
        $cond = "id=$id";
        $students = $this->fetch($cond); // danh sách chỉ một phần tử 
        $student = current($students); // lấy phần tử đầu tiên của danh sách -------- không hiểu ? tại sao lấy phần tử đầu tiên khi mà danh sách chỉ cso 1 phần tử
        return $student;
       
    }
    function update($student) {
        global $conn;
        $name       = $student->name;
        $birthday   = $student->birthday;
        $gender     = $student->gender;
        $id = $student->id;
        $sql = "UPDATE student SET name='$name',birthday= '$birthday', gender ='$gender' WHERE id=$id";
        if ($conn->query($sql)) {
            return true;
        }
        $this->error = "Error" . $sql . "<br>" . $conn->error;
        return false;
    }
    
    function save($data) {
        global $conn;
        $name       = $data['name'];
        $birthday   = $data['birthday'];
        $gender     = $data['gender'];
        $sql = "INSERT INTO student (name,birthday,gender) VALUES('$name','$birthday','$gender')" ;
        if ($conn->query($sql)) {
            return true;
        }
        $this->error = "Error" . $sql . "<br>" . $conn->error;
        return false;
    }
    function destroy1($id) {
        global $conn;
        $registerRepository = new RegisterRepository();
        // trả về danh sách đăng ký môn học của sinh viên cần xóa
        $registers = $registerRepository->getByStudentId($id);
        if (count($registers) > 0) {
            $this->error = "Sinh viên đã đăng ký môn học, vui lòng xóa đăng ký môn học trước";
            return false;
        }
        $sql = "DELETE FROM student WHERE id=$id" ;
        if ($conn->query($sql)) {
            return true;
        }
        $this->error = "Error" . $sql . "<br>" . $conn->error;
        return false;
    }
}
