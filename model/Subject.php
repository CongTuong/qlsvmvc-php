<?php 
class Subject {
    // attributes / properties
    public $id;
    public $name;
    public $number_of_credit;
  

    // Hàm khởi tạo
    public function __construct($id, $name, $number_of_credit) {
        // Truy cập vào thuộc tính id của class/object
        $this->id = $id;
        $this->name = $name;
        $this->number_of_credit = $number_of_credit;
   
    }
}
?>