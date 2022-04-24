<?php 
class RegisterRepository {
    public $error;
    //trả về danh sách môn học ( subject) đưa vào điều kiện $cond
    // nếu gọi hàm mà không truyền tham số thì $cond có giá trị là null
    protected function fetch($cond = null) {
        global $conn; // để bên trong hàm có thể truy xuất biến bên ngoài hàm
        $sql = "SELECT register.*, student.name AS student_name, subject.name AS subject_name FROM register
        JOIN student ON student.id = register.student_id
        JOIN subject ON subject.id = register.subject_id";
        if ($cond) {
            $sql .= " WHERE $cond";
        }
       $result = $conn->query($sql);
       $registers = [];
       if ($result->num_rows > 0 ) {
           while ($row = $result->fetch_assoc()) {
               // [] là thêm 1 phần tử vào cuối danh sách
               $registers[] = new Register($row['id'],$row['student_id'],$row['subject_id'],$row['score'],$row['student_name'],$row['subject_name']) ;
           }
       }
       return $registers;
    }
    function getAll() {
        $registers = $this->fetch();
        return $registers;
    }
    function getByPattern($search) {
         $cond = "student.name LIKE '%$search%' OR subject.name LIKE '%$search%'";
         return $this->fetch($cond);   
    }
    function find($id) {
        $cond = "register.id=$id";
        $registers = $this->fetch($cond); // danh sách chỉ một phần tử 
        $register = current($registers); // lấy phần tử đầu tiên của danh sách -------- không hiểu ? tại sao lấy phần tử đầu tiên khi mà danh sách chỉ cso 1 phần tử
        return $register;
       
    }
    function update($register) {
        global $conn;
      
        $score = $register->score;
        // $student_id       = $register->student_id;
        // $subject_id   = $register->subject_id;
        $id = $register->id;
        $sql = "UPDATE register SET score='$score' WHERE id=$id";
        if ($conn->query($sql)) {
            return true;
        }
        $this->error = "Error" . $sql . "<br>" . $conn->error;
        return false;
    }
    
    function save($data) {
        global $conn;
        $student_id       = $data['student_id'];
        $subject_id   = $data['subject_id'];
        $sql = "INSERT INTO register (student_id,subject_id) VALUES('$student_id','$subject_id')" ;
        if ($conn->query($sql)) {
            return true;
        }
        $this->error = "Error" . $sql . "<br>" . $conn->error;
        return false;
    }
    function destroy1($id) {
        global $conn;
        $sql = "DELETE FROM register WHERE id=$id" ;
        if ($conn->query($sql)) {
            return true;
        }
        $this->error = "Error" . $sql . "<br>" . $conn->error;
        return false;
    }
    function getByStudentId($student_id) {
        $cond = "student.id=$student_id";
        $registers = $this->fetch($cond);
        return $registers;
    }
    function getBySubjectId($subject_id) {
        $cond = "subject.id=$subject_id";
        $registers = $this->fetch($cond);
        return $registers;
    }
}
