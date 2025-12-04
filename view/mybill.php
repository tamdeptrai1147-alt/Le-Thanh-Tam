<main>
    <div class="cart-history-container">
        <h2 class="cart-history-title">LỊCH SỬ ĐƠN HÀNG CỦA BẠN</h2>
        
        <?php
        if(is_array($listbill) && count($listbill) > 0){
            echo '<table class="table-cart">
                    <thead>
                        <tr>
                            <th>MÃ ĐƠN HÀNG</th>
                            <th>NGÀY ĐẶT</th>
                            <th>SỐ LƯỢNG</th>
                            <th>TỔNG GIÁ TRỊ</th>
                            <th>TÌNH TRẠNG</th>
                        </tr>
                    </thead>
                    <tbody>';

            foreach ($listbill as $bill) {
                extract($bill);
                
                // Xử lý tình trạng đơn hàng
                $tt = "Đơn hàng mới";
                $class_tt = "status-new"; 
                if($bill_status == 1) { $tt = "Đang xử lý"; $class_tt = "status-new"; }
                if($bill_status == 2) { $tt = "Đang giao hàng"; $class_tt = "status-shipping"; }
                if($bill_status == 3) { $tt = "Đã giao hàng"; $class_tt = "status-done"; }
                if($bill_status == 4) { $tt = "Đã hủy"; $class_tt = "status-cancel"; }

                $show_date = ($ngaydathang != "") ? $ngaydathang : "Đang cập nhật";
                $count_sp = count_item_cart($id); 

                echo '<tr>
                        <td><a href="index.php?act=mybill_detail&idbill='.$id.'">DC-'.$id.'</a></td>
                        <td>'.$show_date.'</td>
                        <td>'.$count_sp.' món</td>
                        <td style="color: #d0021b; font-weight: bold;">'.number_format($total).' đ</td>
                        <td><span class="status-btn '.$class_tt.'">'.$tt.'</span></td>
                      </tr>';
            }
            echo '</tbody></table>';
        } else {
            echo '<div style="text-align: center; padding: 50px; background: #1a1a1a; border-radius: 8px;">
                    <p style="color: #ccc;">Bạn chưa có đơn hàng nào!</p>
                    <a href="index.php?act=products" class="btn-buy" style="padding: 10px 20px;">Mua sắm ngay</a>
                  </div>';
        }
        ?>
    </div>
</main>