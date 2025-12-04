<main>
    <div class="cart-history-container">
        <h2 class="cart-history-title">
            CHI TIẾT ĐƠN HÀNG #<?php echo isset($_GET['idbill']) ? $_GET['idbill'] : ''; ?>
        </h2>

        <table class="table-cart">
            <thead>
                <tr>
                    <th>HÌNH ẢNH</th>
                    <th>SẢN PHẨM</th>
                    <th>ĐƠN GIÁ</th>
                    <th>SỐ LƯỢNG</th>
                    <th>THÀNH TIỀN</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Kiểm tra biến $bill_detail có tồn tại không trước khi lặp
                    if(isset($bill_detail) && is_array($bill_detail)){
                        $tongtien = 0;
                        foreach ($bill_detail as $item) {
                            extract($item);
                            $img_path = "img/" . $img;
                            $tongtien += $thanhtien;
                            
                            echo '<tr>
                                <td><img src="'.$img_path.'" style="height: 60px; border: 1px solid #444; border-radius: 5px;"></td>
                                <td style="text-align: left; padding-left: 20px; font-weight: bold; color: #fff;">'.$name.'</td>
                                <td>'.number_format($price).' đ</td>
                                <td style="font-weight: bold;">x '.$soluong.'</td>
                                <td style="color: #d0021b; font-weight: bold;">'.number_format($thanhtien).' đ</td>
                            </tr>';
                        }
                        echo '<tr style="background-color: #111; border-top: 2px solid #d0021b;">
                                <td colspan="4" style="text-align: right; padding: 15px; font-weight: bold; text-transform: uppercase;">TỔNG THANH TOÁN:</td>
                                <td style="color: #d0021b; font-weight: bold; font-size: 20px;">'.number_format($tongtien).' đ</td>
                              </tr>';
                    }
                ?>
            </tbody>
        </table>

        <div style="margin-top: 30px; text-align: left;">
            <a href="index.php?act=mybill" class="btn-back" style="display: inline-block; padding: 12px 25px; background: #222; color: #ccc; border: 1px solid #444; border-radius: 5px; font-weight: bold;">
                <i class="fa-solid fa-arrow-left"></i> Quay lại lịch sử
            </a>
        </div>
    </div>
</main>