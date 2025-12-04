<?php
// 1. Hàm thêm liên hệ vào Database
function insert_lienhe($name, $email, $tel, $subject, $content){
    $sql = "INSERT INTO lienhe(name, email, tel, subject, content) VALUES('$name', '$email', '$tel', '$subject', '$content')";
    pdo_execute($sql);
}

// 2. Hàm gửi Email qua Google SMTP
function send_mail_lienhe($name, $email, $tel, $subject, $content){
    // Gọi các file thư viện PHPMailer
    require 'model/PHPMailer/src/Exception.php';
    require 'model/PHPMailer/src/PHPMailer.php';
    require 'model/PHPMailer/src/SMTP.php';

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    try {
        // Cấu hình Server Gmail
        $mail->SMTPDebug = 0;                      // Để 0 để tắt thông báo lỗi rườm rà
        $mail->isSMTP();                           
        $mail->Host       = 'smtp.gmail.com';      
        $mail->SMTPAuth   = true;                  
        
        // =================================================================
        // THAY THÔNG TIN CỦA BẠN VÀO ĐÂY
        // =================================================================
        $mail->Username   = 'haihung200628@gmail.com'; // Email của bạn (người gửi)
        $mail->Password   = 'fklc kyrd ahzj xbbt';     // Mật khẩu ứng dụng 16 số của bạn
        // =================================================================

        $mail->SMTPSecure = 'tls';                 
        $mail->Port       = 587;                   

        // Cấu hình người gửi & người nhận
        $mail->setFrom('haihung200628@gmail.com', 'DragonCore System'); 
        
        // Gửi đến chính bạn (để Admin nhận được thông báo)
        $mail->addAddress('haihung200628@gmail.com');   
        
        // (Tùy chọn) Gửi thêm 1 bản copy cho khách hàng
        // $mail->addAddress($email); 

        // Nội dung Email
        $mail->isHTML(true);                                  
        $mail->CharSet = 'UTF-8'; // Giúp hiển thị tiếng Việt không bị lỗi font
        $mail->Subject = '[DragonCore] Khach hang moi: ' . $subject;
        $mail->Body    = "
            <h3>Thông tin liên hệ mới từ Website</h3>
            <p><strong>Họ tên:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>SĐT:</strong> $tel</p>
            <p><strong>Tiêu đề:</strong> $subject</p>
            <p><strong>Nội dung:</strong><br>$content</p>
        ";

        $mail->send();
    } catch (Exception $e) {
        // Nếu lỗi mail thì bỏ qua, không làm gián đoạn web
        // echo "Lỗi mail: " . $mail->ErrorInfo;
    }
}
?>