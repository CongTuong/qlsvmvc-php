<?php 
class SubjectRepository {
    public $error;
    protected function fetch($cond = null) {
        global $conn; // để bên trong hàm có thể truy xuất biến bên ngoài hàm
        $sql = "SELECT * FROM subject";
        if ($cond) {
            $sql .= " WHERE $cond";
        }
       $result = $conn->query($sql);
       $subjects = [];
       if ($result->num_rows > 0 ) {
           while ($row = $result->fetch_assoc()) {
               // [] là thêm 1 phần tử vào cuối danh sách
               // mỗi phần tử trong danh sách là đối tượng(object) có kiểu dữ liệu là subject
               $subjects[] = new Subject($row['id'],$row['name'],$row['number_of_credit']) ;
           }
       }
       return $subjects;
    }
    function getAll() {
        $subjects = $this->fetch();
        return $subjects;
    }
    function getByPattern($search) {
         $cond = "name LIKE '%$search%'";
         return $this->fetch($cond);   
    }
    function find($id) {
        $cond = "id=$id";
        $subjects = $this->fetch($cond); // danh sách chỉ một phần tử 
        $subject = current($subjects); // lấy phần tử đầu tiên của danh sách -------- không hiểu ? tại sao lấy phần tử đầu tiên khi mà danh sách chỉ cso 1 phần tử
        return $subject;
       
    }
    function update($subject) {
        global $conn;
        $name       = $subject->name;
        $number_of_credit   = $subject->number_of_credit;
        $id = $subject->id;
        $sql = "UPDATE subject SET name='$name',number_of_credit= '$number_of_credit' WHERE id=$id";
        if ($conn->query($sql)) {
            return true;
        }
        $this->error = "Error" . $sql . "<br>" . $conn->error;
        return false;
    }
    
    function save($data) {
        global $conn;
        $name       = $data['name'];
        $number_of_credit   = $data['number_of_credit'];
      
        $sql = "INSERT INTO subject (name,number_of_credit) VALUES('$name','$number_of_credit')" ;
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
        $registers = $registerRepository->getBySubjectId($id);
        if (count($registers) > 0) {
            $this->error = "Môn học đã được sinh viên đăng ký, vui lòng xóa đăng ký môn học trước";
            return false;
        }
        $sql = "DELETE FROM subject WHERE id=$id" ;
        if ($conn->query($sql)) {
            return true;
        }
        $this->error = "Error" . $sql . "<br>" . $conn->error;
        return false;
    }
}
