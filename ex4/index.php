<?php
// Khởi động session
session_start();

// Bao gồm lớp Student
include_once 'Student.php';

// Lấy danh sách sinh viên từ session
$studentList = isset($_SESSION['studentList']) ? unserialize($_SESSION['studentList']) : [];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form thông tin sinh viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Form thông tin sinh viên</h2>
<form id="studentForm" action="process.php" method="post">
    <label for="name">Tên:</label><br>
    <input type="text" id="name" name="name" required><br>
    <label for="age">Tuổi:</label><br>
    <input type="number" id="age" name="age" required><br>
    <label for="grade">Lớp:</label><br>
    <input type="text" id="grade" name="grade" required><br><br>
    <input type="submit" value="Gửi">
</form>

<h2>Danh sách sinh viên</h2>
<table>
    <thead>
        <tr>
            <th>Tên</th>
            <th>Tuổi</th>
            <th>Lớp</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($studentList as $student): ?>
        <tr>
            <td><?php echo htmlspecialchars($student->getName()); ?></td>
            <td><?php echo htmlspecialchars($student->getAge()); ?></td>
            <td><?php echo htmlspecialchars($student->getGrade()); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
// Tự động làm mới trang sau khi gửi biểu mẫu
document.getElementById('studentForm').addEventListener('submit', function() {
    setTimeout(function() {
        window.location.reload();
    }, 100); // Đặt thời gian delay nhỏ để đảm bảo form được gửi trước khi làm mới
});
</script>

</body>
</html>
