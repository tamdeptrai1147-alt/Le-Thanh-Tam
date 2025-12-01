<main class="cart-page">
    <div class="cart-container">
        <h2 class="cart-header">Giỏ hàng của bạn</h2>

        <?php
        if(isset($_SESSION['mycart']) && (count($_SESSION['mycart']) > 0)){
            // --- DANH SÁCH SẢN PHẨM ---
            $tong = 0;
            $i = 0;
            foreach ($_SESSION['mycart'] as $cart) {
                $hinh = "img/" . $cart[2];
                $ttien = $cart[3] * $cart[4];
                $tong += $ttien;
                $xoasp = 'index.php?act=delcart&idcart='.$i;

                echo '
                <div class="cart-item">
                    <div style="display:flex; align-items:center;">
                        <img src="'.$hinh.'" alt="'.$cart[1].'">
                        <div class="item-info">
                            <div class="item-name">'.$cart[1].'</div>
                            <div class="item-meta">Mã SP: #'.$cart[0].' | Bảo hành: 36 Tháng</div>
                            <div style="color: green; font-size: 13px;">Kho hàng: Còn hàng</div>
                        </div>
                    </div>
                    <div style="text-align: right;">
                        <div class="item-price">'.number_format($cart[3]).' đ</div>
                        <div style="display:flex; align-items:center; margin-top:5px; justify-content: flex-end;">
                            
                            <div class="qty-box">
                                <a href="index.php?act=dec_cart&i='.$i.'" class="qty-btn" style="text-decoration: none;">-</a>
                                <input type="text" value="'.$cart[4].'" class="qty-input" readonly>
                                <a href="index.php?act=inc_cart&i='.$i.'" class="qty-btn" style="text-decoration: none;">+</a>
                            </div>
                            
                            <a href="'.$xoasp.'" class="btn-del"><i class="fa-solid fa-trash-can"></i></a>
                        </div>
                    </div>
                </div>';
                $i++;
            }

            // --- PHẦN FORM THANH TOÁN & TỔNG KẾT (Giữ nguyên) ---
            echo '
            <div class="checkout-row">
                <div class="col-info">
                    <h3 class="checkout-title">Thông tin khách hàng</h3>
                    <form action="index.php?act=bill" method="post">
                        <div class="form-group">
                            <input type="text" name="hoten" class="form-control" placeholder="Họ và tên *" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email *" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="tel" class="form-control" placeholder="Điện thoại *" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="address" class="form-control" placeholder="Địa chỉ chi tiết *" required>
                        </div>
                        <div class="form-group">
                            <textarea name="note" class="form-control" placeholder="Ghi chú thêm (nếu có)" rows="3"></textarea>
                        </div>
                </div>  

                <div class="col-payment">
                    <h3 class="checkout-title">Hình thức thanh toán</h3>
                    <label class="payment-method"><input type="radio" name="pttt" value="1" checked> Thanh toán tiền mặt khi nhận hàng (COD)</label>
                    <label class="payment-method"><input type="radio" name="pttt" value="2"> Chuyển khoản ngân hàng (QR Code)</label>
                    <label class="payment-method"><input type="radio" name="pttt" value="3"> Thanh toán qua thẻ ATM/Visa/Master</label>
                    <label class="payment-method"><input type="radio" name="pttt" value="4"> Trả góp qua thẻ tín dụng (0%)</label>
                </div>

                <div class="col-summary">
                    <h3 class="checkout-title">Mã giảm giá / Quà tặng</h3>
                    <div style="display:flex; gap:5px; margin-bottom:15px;">
                        <input type="text" class="form-control" placeholder="Nhập mã giảm giá">
                        <button style="background: #d0021b; color: #fff; border: none; border-radius: 4px; padding: 0 15px; font-weight: bold; cursor: pointer;">Áp dụng</button>
                    </div>

                    <div class="summary-box">
                        <div class="summary-row"><span>Tổng tiền hàng:</span> <span>'.number_format($tong).' đ</span></div>
                        <div class="summary-row"><span>Giảm giá:</span> <span>0 đ</span></div>
                        <div class="summary-row" style="border-top: 1px dashed #ddd; padding-top: 10px; margin-top: 10px;">
                            <span style="font-weight: bold;">Cần thanh toán:</span>
                            <span class="summary-total">'.number_format($tong).' đ</span>
                        </div>
                        <div style="font-size: 12px; color: #777; text-align: right; margin-top: 5px;">(Giá chưa bao gồm VAT)</div>
                    </div>

                    <div style="margin-top: 20px;">
                        <button type="submit" name="dongydathang" class="btn-order">ĐẶT HÀNG</button>
                        <button type="submit" name="dongydathang" value="1" class="btn-order">ĐẶT HÀNG</button>
                        <button type="button" class="btn-installment">MUA TRẢ GÓP</button>
                        <a href="index.php?act=products"><button type="button" class="btn-continue">CHỌN THÊM SẢN PHẨM</button></a>
                    </div>
                    </form> 
                </div>
            </div>';

        } else {
            echo '<div style="text-align: center; padding: 50px;">
                    <p>Giỏ hàng trống trơn!</p>
                    <a href="index.php?act=products" style="color: red; font-weight: bold;">Quay lại mua hàng</a>
                  </div>';
        }
        ?>
    </div>
</main>