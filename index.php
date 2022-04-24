<!-- router -->
<?php 
session_start();
// require file config của hệ thống và kết nối csdl
require 'config.php';
require 'connectDB.php';
// require models
require 'model/Student.php';
require 'model/StudentRepository.php';

require 'model/Subject.php';
require 'model/SubjectRepository.php';

require 'model/Register.php';
require 'model/RegisterRepository.php';
// lấy giá trị của tham số c và a ở thanh địa chỉ
// mặc định c có giá trị student và a = index
// c là controller 
// a là action
// $_GET lấy tham số trên thanh địa chỉ, các tham số nối với nhau bởi dấu &
// $_GET là array kết hợp vì Key là chuỗi
// dấu / là domain chính
// nếu $_GET['c'] tồn tại thì trả về $_GET['c'] ngược lại trả về student
$c = $_GET['c'] ?? 'student'; // nếu c không có dữ liệu thì chọn student
$a = $_GET['a'] ?? 'index'; 
$controller = ucfirst($c) . 'Controller'; // StudentController
require "controller/$controller.php"; // controller/StudentController.php
// new là trả về đối tượng tương đương class đó
$controller = new $controller; //  class new studentController 
//$controller->index(); // gọi hàm index() của đối tượng mà biến $controller đang chứa index(student)
$controller->$a(); // gọi hàm tương ứng với giá trị trong $a của $controller

?>