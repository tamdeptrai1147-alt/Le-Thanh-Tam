<?php
// 1. Hàm thêm liên hệ vào Database (Giữ nguyên)
function insert_lienhe($name, $email, $tel, $subject, $content){
    $sql = "INSERT INTO lienhe(name, email, tel, subject, content) VALUES('$name', '$email', '$tel', '$subject', '$content')";
    pdo_execute($sql);
}

// 2. Hàm gửi Email (Đã sửa lỗi SSL cho Localhost)
function send_mail_lienhe($name, $email, $tel, $subject, $content){
    // Import thư viện PHPMailer
    require 'model/PHPMailer/src/Exception.php';
    require 'model/PHPMailer/src/PHPMailer.php';
    require 'model/PHPMailer/src/SMTP.php';

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    try {
        // --- CẤU HÌNH SERVER ---
        $mail->SMTPDebug = 0;                      // Tắt debug để không hiện chữ linh tinh nếu gửi thành công
        $mail->isSMTP();                           
        $mail->Host       = 'smtp.gmail.com';      
        $mail->SMTPAuth   = true;                  
        
        // --- TÀI KHOẢN GMAIL ---
        $mail->Username   = 'haihung200628@gmail.com'; 
        $mail->Password   = 'fklc kyrd ahzj xbbt';     // Mật khẩu ứng dụng
        
        // --- CẤU HÌNH MÃ HÓA (Nên dùng TLS & Port 587 trước) ---
        $mail->SMTPSecure = 'tls';                 
        $mail->Port       = 587;                   

        // --- QUAN TRỌNG: BỎ QUA LỖI SSL (Giúp chạy được trên Localhost/XAMPP) ---
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        // --- CẤU HÌNH NGƯỜI GỬI & NHẬN ---
        $mail->setFrom('haihung200628@gmail.com', 'DragonCore System'); 
        $mail->addAddress('haihung200628@gmail.com'); // Gửi về cho Admin
        // $mail->addAddress($email); // Bỏ comment dòng này nếu muốn gửi cả cho khách

        // --- NỘI DUNG EMAIL ---
        $mail->isHTML(true);                                  
        $mail->CharSet = 'UTF-8'; 
        $mail->Subject = '[DragonCore] Liên hệ mới từ: ' . $name;
        $mail->Body    = "
            <h3>Thông tin khách hàng liên hệ:</h3>
            <p><strong>Họ tên:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>SĐT:</strong> $tel</p>
            <p><strong>Tiêu đề:</strong> $subject</p>
            <hr>
            <p><strong>Nội dung:</strong><br>$content</p>
        ";

        $mail->send();
        // Nếu muốn hiện thông báo thành công thì bỏ comment dòng dưới
        // echo "<script>alert('Gửi mail thành công!');</script>";

    } catch (Exception $e) {
        // --- NẾU LỖI SẼ HIỆN RA Ở ĐÂY ---
        echo "<div style='color:red; background: #fff; padding: 20px; border: 2px solid red; margin: 20px;'>";
        echo "<h3>KHÔNG GỬI ĐƯỢC MAIL!</h3>";
        echo "Lỗi chi tiết: " . $mail->ErrorInfo;
        echo "</div>";
    }
}
?>