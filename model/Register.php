<?php 
class Register {
    // attributes / properties
    public $id;
    public $student_id;
    public $subject_id;
    public $score;
    public $student_name;
    public $subject_name;

    // Hàm khởi tạo
    public function __construct($id, $student_id, $subject_id,$score,$student_name,$subject_name) {
        // Truy cập vào thuộc tính id của class/object
        $this->id = $id;
        $this->student_id = $student_id;
        $this->subject_id = $subject_id;
        $this->score = $score;
        $this->student_name = $student_name;
        $this->subject_name = $subject_name;
    }
}
?>