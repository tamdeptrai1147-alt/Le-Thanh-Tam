<main>
    <div class="container" style="margin-top: 50px; min-height: 500px; width: 1000px; margin: 50px auto; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        
        <h2 style="text-align: center; margin-bottom: 30px; text-transform: uppercase; color: #b20000; border-bottom: 2px solid #b20000; padding-bottom: 10px;">
            CHI TIẾT ĐƠN HÀNG #<?php echo $_GET['idbill']; ?>
        </h2>

        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <thead style="background-color: #333; color: #fff;">
                <tr style="height: 40px;">
                    <th style="padding: 10px;">HÌNH ẢNH</th>
                    <th>SẢN PHẨM</th>
                    <th>ĐƠN GIÁ</th>
                    <th>SỐ LƯỢNG</th>
                    <th>THÀNH TIỀN</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $tongtien = 0;
                    foreach ($bill_detail as $item) {
                        extract($item);
                        $img_path = "img/" . $img;
                        $tongtien += $thanhtien;
                        
                        echo '
                        <tr style="border-bottom: 1px solid #eee; text-align: center;">
                            <td style="padding: 10px;">
                                <img src="'.$img_path.'" height="60px" style="border: 1px solid #ddd; border-radius: 5px;">
                            </td>
                            <td style="font-weight: bold; color: #333;">'.$name.'</td>
                            <td>'.number_format($price).' đ</td>
                            <td style="font-weight: bold;">x '.$soluong.'</td>
                            <td style="color: #d0021b; font-weight: bold;">'.number_format($thanhtien).' đ</td>
                        </tr>';
                    }
                ?>
                <tr style="background-color: #f9f9f9;">
                    <td colspan="4" style="text-align: right; padding: 15px; font-weight: bold;">TỔNG THANH TOÁN:</td>
                    <td style="color: #d0021b; font-weight: bold; font-size: 18px;"><?php echo number_format($tongtien); ?> đ</td>
                </tr>
            </tbody>
        </table>

        <div style="margin-top: 30px; text-align: center;">
            <a href="index.php?act=mybill" style="display: inline-block; padding: 10px 30px; background: #555; color: #fff; text-decoration: none; border-radius: 5px; font-weight: bold;">
                <i class="fa-solid fa-arrow-left"></i> Quay lại lịch sử
            </a>
        </div>

    </div>
</main>