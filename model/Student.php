<?php 
class Student {
    // attributes / properties
    public $id;
    public $name;
    public $birthday;
    public $gender;

    // Hàm khởi tạo
    public function __construct($id, $name, $birthday, $gender) {
        // Truy cập vào thuộc tính id của class/object
        $this->id = $id;
        $this->name = $name;
        $this->birthday = $birthday;
        $this->gender = $gender;
    }
}
?>