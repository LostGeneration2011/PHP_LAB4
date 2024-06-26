<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
// Định nghĩa lớp Books
class Books {
    /* Biến thành viên */
    var $price; // Giá sách
    var $title; // Tiêu đề sách

    /* Hàm khởi tạo */
    function __construct($_title, $_price) {
        $this->title = $_title; // Thiết lập tiêu đề sách
        $this->price = $_price; // Thiết lập giá sách
    }

    /* Hàm thành viên */
    
    // Hàm thiết lập giá sách
    function setPrice($_price){
        $this->price = $_price; // Cập nhật giá sách
    }

    // Hàm lấy giá sách
    function getPrice(){
        echo $this->price ."<br/>"; // Hiển thị giá sách
    }

    // Hàm thiết lập tiêu đề sách
    function setTitle($_title){
        $this->title = $_title; // Cập nhật tiêu đề sách
    }

    // Hàm lấy tiêu đề sách
    function getTitle(){
        echo $this->title ." <br/>"; // Hiển thị tiêu đề sách
    }

    // Hàm chào hỏi
    function sayHello(){
        echo "Hello<br>"; // Hiển thị thông báo chào hỏi
    }
}

// Tạo các đối tượng sách
$java = new Books("OOP with Java", 10); // Sách về OOP với Java
$ios = new Books("Advanced iOS Programming", 15); // Sách về lập trình iOS nâng cao
$game = new Books("Game Programming", 7); // Sách về lập trình game

/* Lấy và hiển thị các giá trị đã thiết lập */
$java->getTitle(); // Hiển thị tiêu đề sách Java
$ios->getTitle(); // Hiển thị tiêu đề sách iOS
$game->getTitle(); // Hiển thị tiêu đề sách Game
$java->getPrice(); // Hiển thị giá sách Java
$ios->getPrice(); // Hiển thị giá sách iOS
$game->getPrice(); // Hiển thị giá sách Game
$game->sayHello(); // Hiển thị thông báo chào hỏi
?>

</body>
</html>