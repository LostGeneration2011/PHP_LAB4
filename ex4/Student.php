<?php
// Định nghĩa lớp Student để quản lý thông tin sinh viên
class Student {
    private $name;
    private $age;
    private $grade;

    // Hàm khởi tạo
    public function __construct($name, $age, $grade) {
        $this->name = $name;
        $this->age = $age;
        $this->grade = $grade;
    }

    // Lấy tên sinh viên
    public function getName() {
        return $this->name;
    }

    // Lấy tuổi sinh viên
    public function getAge() {
        return $this->age;
    }

    // Lấy lớp sinh viên
    public function getGrade() {
        return $this->grade;
    }
}
?>
