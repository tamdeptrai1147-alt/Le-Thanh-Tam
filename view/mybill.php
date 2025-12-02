<main>
    <div class="container" style="margin-top: 50px; min-height: 500px;">
        
        <h2 style="text-align: center; margin-bottom: 30px; text-transform: uppercase; border-bottom: 2px solid #d0021b; padding-bottom: 10px; display: inline-block; color: #fff;">
            LỊCH SỬ ĐƠN HÀNG CỦA BẠN
        </h2>

        <?php
            if(is_array($listbill) && count($listbill) > 0){
                echo '
                <table style="width: 100%; border-collapse: collapse; margin-top: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                    <thead>
                        <tr style="background-color: #333; color: #fff; text-align: center;">
                            <th style="padding: 15px;">MÃ ĐƠN HÀNG</th>
                            <th>NGÀY ĐẶT</th>
                            <th>SỐ LƯỢNG MẶT HÀNG</th>
                            <th>TỔNG GIÁ TRỊ</th>
                            <th>TÌNH TRẠNG</th>
                        </tr>
                    </thead>
                    <tbody>
                ';

                foreach ($listbill as $bill) {
                    extract($bill);
                    
                    // 1. Xử lý tình trạng
                    $tt = "Đơn hàng mới";
                    if($bill_status == 1) $tt = "Đang xử lý";
                    if($bill_status == 2) $tt = "Đang giao hàng";
                    if($bill_status == 3) $tt = "Đã giao hàng";

                    // 2. GỌI HÀM ĐẾM SỐ LƯỢNG TỪ MODEL
                    // (Hàm count_item_cart ông đã có trong model/bill.php rồi nên gọi thoải mái)
                    $count_sp = count_item_cart($id); 

                    // 3. Xử lý ngày đặt
                    $show_date = ($ngaydathang != "") ? $ngaydathang : "Đang cập nhật";

                    echo '
                        <tr style="border-bottom: 1px solid #ddd; text-align: center; background: #fff;">
                            <td style="padding: 15px;">
                                <a href="index.php?act=mybill_detail&idbill='.$id.'" style="color: #d0021b; font-weight: bold; text-decoration: underline;">DC-'.$id.'</a>
                            </td>
                            <td>'.$show_date.'</td>
                            <td style="font-weight: bold; color: #333;">'.$count_sp.' món</td>
                            <td style="color: #d0021b; font-weight: bold;">'.number_format($total).' đ</td>
                            <td><span style="padding: 5px 10px; background: #b11a1aff; color: #fff; border-radius: 4px; font-size: 12px;">'.$tt.'</span></td>
                        </tr>
                    ';
                }

                echo '</tbody></table>';

            } else {
                echo '<div style="text-align: center; padding: 50px; background: #0a0a0aff;">
                        <p style="color: #ccc; font-size: 18px;">Bạn chưa có đơn hàng nào!</p>
                        <a href="index.php?act=products" style="color: #d0021b; font-weight: bold; font-size: 16px; text-decoration: underline;">Mua sắm ngay</a>
                      </div>';
            }
        ?>
    </div>
</main>