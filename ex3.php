<?php
class Cipher
{
    protected $tst; // Khai báo biến bảo vệ cho văn bản
    protected $sh;  // Khai báo biến bảo vệ cho số dịch chuyển

    // Hàm khởi tạo
    public function __construct($tst, $sh)
    {
        $this->tst = $tst; // Thiết lập văn bản
        $this->sh = $sh;   // Thiết lập số dịch chuyển
    }
}

// Lớp Icipher kế thừa từ lớp Cipher
class Icipher extends Cipher {
    // Hàm khởi tạo
    public function __construct($tst, $sh)
    {
        parent::__construct($tst, $sh); // Gọi hàm khởi tạo của lớp cha
    }

    // Hàm mã hóa văn bản
    public function encrypt()
    {
        $tst = $this->tst; // Lấy văn bản từ thuộc tính lớp cha
        echo "Văn bản gốc: $tst<br>";
        $csr = strtolower($tst); // Chuyển văn bản thành chữ thường
        $cc = ""; // Biến chứa văn bản đã mã hóa

        // Duyệt qua từng ký tự của văn bản
        for($i = 0; $i < strlen($tst); $i++)
        {
            // Kiểm tra nếu giá trị ord có thể vượt quá phạm vi bảng chữ cái ASCII
            if(ord($csr[$i]) > 122 - ($this->sh % 26)){
                // ví dụ: dịch chuyển = 5, với z => 122 - 26 + 5 % 26 => cho ra 101 tức là e
                $cc = $cc . chr(ord($csr[$i]) - 26 + $this->sh % 26);
            }
            // Kiểm tra liệu văn bản có chứa số không
            elseif(preg_match('/\d/', $csr[$i]))
            {
                // kiểm tra giá trị ord vượt quá giới hạn số
                if(ord($csr[$i]) > 57 - ($this->sh % 10))
                // ví dụ: với 9, dịch chuyển = 3 => 57 - 10 + 3 % 10 = > 50 tức là 2
                $cc = $cc . chr(ord($csr[$i]) - 10 + $this->sh % 10);
                else
                // chỉ đơn giản là thêm dịch chuyển nếu nó không vượt quá giới hạn
                $cc = $cc . chr(ord($csr[$i]) + (int)($this->sh % 10));
            }
            else
            // chỉ đơn giản là thêm dịch chuyển nếu nó không vượt quá giới hạn
            $cc = $cc . chr(ord($csr[$i]) + (int)($this->sh % 26));
        }
        echo "Văn bản mã hóa là: ".$cc."<br>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Mã hóa Caesar</title>
</head>
<body>
    <form method="post">
        <label for="tst">Nhập văn bản cần mã hóa:</label><br>
        <input type="text" id="tst" name="tst"><br><br>
        <label for="sh">Nhập số dịch chuyển cho mã hóa Caesar:</label><br>
        <input type="text" id="sh" name="sh"><br><br>
        <input type="submit" value="Mã hóa">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $tst = strtolower(trim($_POST['tst'])); // Lấy văn bản từ biểu mẫu và chuyển thành chữ thường
        $sh = trim($_POST['sh']); // Lấy số dịch chuyển từ biểu mẫu

        // Tạo đối tượng và thực hiện mã hóa
        $k = new Icipher($tst, $sh);
        $k->encrypt();
    }
    ?>
</body>
</html>
