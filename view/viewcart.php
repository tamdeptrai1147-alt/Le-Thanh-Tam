<main>
    <div class="container" style="margin-top: 50px; min-height: 400px;">
        <h2 style="margin-bottom: 30px; text-align: center;">GIỎ HÀNG CỦA BẠN</h2>

        <?php
            // Kiểm tra giỏ hàng có rỗng không
            if(isset($_SESSION['mycart']) && (count($_SESSION['mycart']) > 0)){
                echo '
                <table style="width: 100%; border-collapse: collapse; text-align: center;">
                    <thead style="background: #000; color: #fff; font-weight: bold;">
                        <tr>
                            <th style="padding: 15px;">Hình ảnh</th>
                            <th>Sản phẩm</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                ';

                $tong = 0;
                $i = 0;
                foreach ($_SESSION['mycart'] as $cart) {
                    $hinh = "img/" . $cart[2];
                    $ttien = $cart[3] * $cart[4];
                    $tong += $ttien;
                    
                    // Link xóa sản phẩm
                    $xoasp = '<a href="index.php?act=delcart&idcart='.$i.'"><button style="background: red; color: white; border: none; padding: 5px 10px; cursor: pointer;">Xóa</button></a>';

                    echo '
                        <tr style="border-bottom: 1px solid #ddd;">
                            <td style="padding: 10px;"><img src="'.$hinh.'" height="80px"></td>
                            <td>'.$cart[1].'</td>
                            <td style="color: #d0021b; font-weight: bold;">'.number_format($cart[3]).' đ</td>
                            <td>'.$cart[4].'</td>
                            <td style="color: #d0021b; font-weight: bold;">'.number_format($ttien).' đ</td>
                            <td>'.$xoasp.'</td>
                        </tr>
                    ';
                    $i++;
                }

                echo '
                    </tbody>
                </table>
                
                <div style="text-align: right; margin-top: 30px;">
                    <h3 style="margin-bottom: 20px;">Tổng đơn hàng: <span style="color: red; font-size: 24px;">'.number_format($tong).' VNĐ</span></h3>
                    
                    <a href="index.php?act=products">
                        <button style="padding: 15px 30px; background: #333; color: white; border: none; font-weight: bold; cursor: pointer; margin-right: 10px;">TIẾP TỤC MUA HÀNG</button>
                    </a>
                    
                    <a href="#"> <button style="padding: 15px 30px; background: #d0021b; color: white; border: none; font-weight: bold; cursor: pointer;">THANH TOÁN NGAY</button>
                    </a>
                </div>
                ';

            } else {
                echo '<h3 style="text-align: center; color: #777;">Giỏ hàng trống trơn! Mua sắm đi bạn ơi.</h3>';
                echo '<div style="text-align: center; margin-top: 20px;"><a href="index.php?act=products"><button style="padding: 10px 20px; background: #d0021b; color: white; border: none;">Vào xem sản phẩm</button></a></div>';
            }
        ?>
    </div>
    <?php
// DÁN ĐOẠN NÀY VÀO CUỐI FILE viewcart.php

// Kiểm tra xem có thông báo được gửi từ Session không
if(isset($_SESSION['thongbao']) && $_SESSION['thongbao'] != ""){
    echo '<script>';
    // Hiển thị thông báo bằng JavaScript Alert
    echo 'alert("' . $_SESSION['thongbao'] . '");'; 
    echo '</script>';
    
    // Xóa ngay thông báo khỏi Session để lần sau tải trang không hiện lại
    unset($_SESSION['thongbao']); 
}
?>
</main>