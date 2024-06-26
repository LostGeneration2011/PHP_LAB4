<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
/**
* Giao diện Target đại diện cho giao diện mà lớp của ứng dụng của bạn đã tuân theo.
*/
interface Notification
{
    public function send(string $title, string $message);
}

/**
* Đây là một ví dụ về lớp hiện có tuân theo giao diện Target.
* Thực tế là nhiều ứng dụng thực có thể không có giao diện này được định nghĩa rõ ràng.
* Nếu bạn gặp tình huống này, cách tốt nhất là mở rộng Adapter từ một trong các lớp hiện có của ứng dụng của bạn.
* Nếu điều đó không phù hợp (ví dụ, SlackNotification không giống như một lớp con của EmailNotification),
* thì việc trích xuất một giao diện nên là bước đầu tiên của bạn.
*/
class EmailNotification implements Notification
{
    private $adminEmail;

    // Hàm khởi tạo
    public function __construct(string $adminEmail)
    {
        $this->adminEmail = $adminEmail;
    }

    // Hàm gửi email
    public function send(string $title, string $message): void
    {
        mail($this->adminEmail, $title, $message);
        echo "Đã gửi email với tiêu đề '$title' tới '{$this->adminEmail}' có nội dung '$message'.";
    }
}

/**
* Adaptee là một lớp hữu ích, không tương thích với giao diện Target.
* Bạn không thể chỉ thay đổi mã của lớp để tuân theo giao diện Target, vì mã này có thể được cung cấp bởi một thư viện của bên thứ ba.
*/
class SlackApi
{
    private $login;
    private $apiKey;

    // Hàm khởi tạo
    public function __construct(string $login, string $apiKey)
    {
        $this->login = $login;
        $this->apiKey = $apiKey;
    }

    // Hàm đăng nhập
    public function logIn(): void
    {
        // Gửi yêu cầu xác thực tới dịch vụ web Slack.
        echo "Đã đăng nhập vào tài khoản Slack '{$this->login}'.\n";
    }

    // Hàm gửi tin nhắn
    public function sendMessage(string $chatId, string $message): void
    {
        // Gửi yêu cầu gửi tin nhắn tới dịch vụ web Slack.
        echo "Đã đăng tin nhắn sau vào chat '$chatId': '$message'.\n";
    }
}

/**
* Adapter là một lớp liên kết giao diện Target và lớp Adaptee.
* Trong trường hợp này, nó cho phép ứng dụng gửi thông báo sử dụng Slack API.
*/
class SlackNotification implements Notification
{
    private $slack;
    private $chatId;

    // Hàm khởi tạo
    public function __construct(SlackApi $slack, string $chatId)
    {
        $this->slack = $slack;
        $this->chatId = $chatId;
    }

    /**
    * Adapter không chỉ có khả năng điều chỉnh giao diện, mà còn có thể
    * chuyển đổi dữ liệu đầu vào sang định dạng yêu cầu bởi Adaptee.
    */
    public function send(string $title, string $message): void
    {
        $slackMessage = "#" . $title . "# " . strip_tags($message);
        $this->slack->logIn();
        $this->slack->sendMessage($this->chatId, $slackMessage);
    }
}

/**
* Mã khách hàng có thể hoạt động với bất kỳ lớp nào tuân theo giao diện Target.
*/
function clientCode(Notification $notification)
{
    // ...
    echo $notification->send("Website is down!", "<strong style='color:red;font-size: 50px;'>Alert!</strong> Our website is not responding. Call admins and bring it up!");
    // ...
}

echo "Mã khách hàng được thiết kế đúng và hoạt động với thông báo email:\n";

$notification = new EmailNotification("developers@example.com");
clientCode($notification);
echo "\n\n";
echo "Mã khách hàng tương tự có thể hoạt động với các lớp khác thông qua adapter:\n";

$slackApi = new SlackApi("example.com", "XXXXXXXX");
$notification = new SlackNotification($slackApi, "Example.com Developers");
clientCode($notification);
?>


</body>
</html>