<?php
// Khởi động session
session_start();

// Bao gồm lớp Student
include_once 'Student.php';

// Kiểm tra và lấy thông tin từ form
if (isset($_POST['name']) && isset($_POST['age']) && isset($_POST['grade'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $grade = $_POST['grade'];

    // Tạo đối tượng Student mới
    $student = new Student($name, $age, $grade);

    // Lấy danh sách sinh viên từ session
    $studentList = isset($_SESSION['studentList']) ? unserialize($_SESSION['studentList']) : [];

    // Thêm sinh viên mới vào danh sách
    $studentList[] = $student;

    // Lưu danh sách sinh viên vào session
    $_SESSION['studentList'] = serialize($studentList);
}

// Chuyển hướng lại trang index
header('Location: index.php');
exit();
?>
