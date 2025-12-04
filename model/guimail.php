<?php
// Nhúng thư viện PHPMailer
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// =======================================================================
// 1. HÀM GỬI HÓA ĐƠN (Dùng khi khách đặt hàng xong)
// =======================================================================
function gui_hoa_don_email($email_khach, $ten_khach, $ma_don, $tong_tien, $noi_dung_hang){
    $mail = new PHPMailer(true);

    try {
        // Cấu hình Server
        $mail->isSMTP();                                            
        $mail->Host       = 'smtp.gmail.com';                     
        $mail->SMTPAuth   = true;                                   
        
        // --- CẤU HÌNH TÀI KHOẢN ---
        $mail->Username   = 'tamdeptrai1147@gmail.com';  // Email của bạn
        $mail->Password   = 'apcr xyeu yalr yzf';        // Mật khẩu ứng dụng bạn vừa tạo
        // --------------------------

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
        $mail->Port       = 465;                                    
        $mail->CharSet    = 'UTF-8'; 

        // Người gửi & Người nhận
        $mail->setFrom('tamdeptrai1147@gmail.com', 'DragonCore Store'); 
        $mail->addAddress($email_khach, $ten_khach);                   

        // Nội dung Email
        $mail->isHTML(true);                                  
        $mail->Subject = 'Xác nhận đơn hàng #DC-' . $ma_don . ' - DragonCore';
        
        $body = "
            <div style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
                <div style='background: #000; padding: 15px; text-align: center;'>
                    <h2 style='color: #d0021b; margin: 0;'>DRAGON CORE GAMING</h2>
                </div>
                <div style='padding: 20px;'>
                    <p>Xin chào <strong>$ten_khach</strong>,</p>
                    <p>Cảm ơn bạn đã tin tưởng đặt hàng tại DragonCore. Đơn hàng của bạn đã được tiếp nhận.</p>
                    
                    <p><strong>Mã đơn hàng:</strong> <span style='color:#007bff; font-weight:bold;'>#DC-$ma_don</span></p>
                    <p><strong>Tổng thanh toán:</strong> <span style='color:#d0021b; font-size:18px; font-weight:bold;'>".number_format($tong_tien)." VNĐ</span></p>
                    
                    <hr style='border: 0; border-top: 1px solid #ddd; margin: 20px 0;'>
                    
                    <h3 style='margin-bottom: 10px;'>Chi tiết đơn hàng:</h3>
                    <table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse; width: 100%; border-color: #ddd;'>
                        <tr style='background-color: #f8f9fa;'>
                            <th style='text-align: left;'>Sản phẩm</th>
                            <th style='text-align: center; width: 50px;'>SL</th>
                            <th style='text-align: right;'>Thành tiền</th>
                        </tr>
                        $noi_dung_hang
                    </table>
                    
                    <p style='margin-top: 20px;'>Chúng tôi sẽ sớm liên hệ qua điện thoại để xác nhận thời gian giao hàng.</p>
                    <p><i>Hotline hỗ trợ: 0988.123.456</i></p>
                </div>
            </div>
        ";

        $mail->Body = $body;
        $mail->send();
    } catch (Exception $e) {
        // Lỗi thì bỏ qua
    }
}

// =======================================================================
// 2. HÀM GỬI LIÊN HỆ (Dùng khi khách điền form liên hệ -> Gửi về Admin)
// =======================================================================
function gui_email_lien_he($ten, $email, $sdt, $tieude, $noidung){
    $mail = new PHPMailer(true);

    try {
        // Cấu hình Server (Y hệt bên trên)
        $mail->isSMTP();                                            
        $mail->Host       = 'smtp.gmail.com';                     
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'tamdeptrai1147@gmail.com'; 
        $mail->Password   = 'apcr xyeu yalr yzf';        // Mật khẩu ứng dụng
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
        $mail->Port       = 465;                                    
        $mail->CharSet    = 'UTF-8'; 

        // Người gửi & Người nhận
        $mail->setFrom('tamdeptrai1147@gmail.com', 'He Thong Web'); 
        $mail->addAddress('tamdeptrai1147@gmail.com'); // Gửi về cho Admin (Chính bạn)
        $mail->addReplyTo($email, $ten);               // Để Admin bấm Reply là trả lời cho khách

        // Nội dung
        $mail->isHTML(true);                                  
        $mail->Subject = "[LIÊN HỆ] $tieude - Từ khách hàng $ten";
        $mail->Body    = "
            <div style='font-family: Arial, sans-serif;'>
                <h3 style='color: #007bff;'>📩 Có khách hàng liên hệ mới!</h3>
                <p><strong>Họ tên:</strong> $ten</p>
                <p><strong>Email:</strong> <a href='mailto:$email'>$email</a></p>
                <p><strong>SĐT:</strong> $sdt</p>
                <div style='background: #f9f9f9; padding: 15px; border-left: 4px solid #007bff; margin-top: 10px;'>
                    <strong>Nội dung tin nhắn:</strong><br>
                    ".nl2br($noidung)."
                </div>
            </div>
        ";

        $mail->send();
    } catch (Exception $e) {
        // Lỗi thì bỏ qua
    }
}
?>