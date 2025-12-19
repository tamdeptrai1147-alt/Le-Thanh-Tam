<div class="container-fluid">
    <h2 class="page-title">QUẢN LÝ ĐƠN HÀNG</h2>
    
    <div class="card-box" style="display: block; margin-bottom: 20px;">
        <form action="index.php?act=listdh" method="post" style="display: flex; gap: 10px;">
            <input type="text" name="kyw" placeholder="Nhập mã đơn hàng..." style="padding: 10px; background: #222; border: 1px solid #444; color: #fff; border-radius: 4px; width: 300px;">
            <input type="submit" name="listok" value="TÌM KIẾM" class="btn-main" style="border: none;">
        </form>
    </div>

    <div class="card-box" style="display: block;">
        <div class="card" style="text-align: left; padding: 0;">
            <table style="margin: 0; border: none;">
                <thead>
                    <tr style="background: #b20000;">
                        <th style="width: 80px;">MÃ ĐƠN</th>
                        <th>KHÁCH HÀNG</th>
                        <th style="width: 100px; text-align: center;">SỐ LƯỢNG</th>
                        <th style="width: 150px;">TỔNG TIỀN</th>
                        <th style="width: 150px;">TRẠNG THÁI</th>
                        <th style="width: 150px; text-align: center;">THANH TOÁN</th> <th style="width: 150px;">NGÀY ĐẶT</th>
                        <th style="width: 150px;">THAO TÁC</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($listbill as $bill) {
                            extract($bill);
                            $kh = '<span style="font-weight:bold; color:#fff;">'.$bill_name.'</span><br>'.$bill_email.'<br>'.$bill_tel;
                            $count_sp = count_item_cart($id); 
                            $ttdh = get_ttdh($bill_status); 
                            
                            // Xử lý hiển thị Thanh toán
                         // Logic kiểm tra thanh toán:
                            // Nếu Đã giao hàng (status=3) HOẶC Chuyển khoản (pttt=2) HOẶC Thẻ (pttt=3)
                            if($bill_status == 3 || $bill_pttt == 2 || $bill_pttt == 3){
                                $tt_thanhtoan = '<span style="color:#00e676; font-weight:bold; font-size:12px;"><i class="fa-solid fa-check"></i> Đã TT</span>';
                            } else {
                                $tt_thanhtoan = '<span style="color:#ff1744; font-weight:bold; font-size:12px;"><i class="fa-solid fa-xmark"></i> Chưa TT</span>';
                            }

                            $suadh = "index.php?act=suadh&id=".$id;
                            $xoadh = "index.php?act=xoadh&id=".$id;
                            
                            $color_status = "#ffff00"; 
                            if($bill_status == 1) $color_status = "#00e676"; 
                            if($bill_status == 2) $color_status = "#2979ff"; 
                            if($bill_status == 3) $color_status = "#ff1744"; 

                            echo '
                            <tr>
                                <td style="color: #ccc; font-weight: bold;">DC-'.$id.'</td>
                                <td style="font-size: 13px; color: #888; line-height: 1.5;">'.$kh.'</td>
                                <td style="text-align: center; font-weight: bold; color: #fff;">'.$count_sp.'</td>
                                <td style="color: #d0021b; font-weight: bold;">'.number_format($total).' đ</td>
                                <td style="color: '.$color_status.'; font-weight: bold;">'.$ttdh.'</td>
                                <td style="text-align: center;">'.$tt_thanhtoan.'</td> <td style="font-size: 12px; color: #666;">'.$ngaydathang.'</td>
                                <td>
                                    <a href="index.php?act=chitietdh&id='.$id.'"><button style="background: #00e676; color: #000; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer; font-weight: bold; margin-right: 5px;"><i class="fa-solid fa-eye"></i></button></a>
                                    <a href="'.$suadh.'"><button style="background: #2979ff; color: white; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer;"><i class="fa-solid fa-pen-to-square"></i></button></a>
                                    
                                </td>
                            </tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>