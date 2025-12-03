<?php
    if(is_array($bill)){
        extract($bill);
        $ttdh = get_ttdh($bill_status);
    }
?>
<div class="container-fluid">
    <h2 class="page-title">CHI TIẾT ĐƠN HÀNG: DC-<?=$id?></h2>
    
    <div class="card-box" style="display: flex; gap: 20px; margin-bottom: 20px;">
        <div class="card" style="flex: 1; text-align: left; background: #222; border: 1px solid #444;">
            <h3 style="font-size: 16px; border-bottom: 1px solid #444; padding-bottom: 10px; margin-bottom: 15px; color: #d0021b;">THÔNG TIN KHÁCH HÀNG</h3>
            <p style="color: #ccc; margin-bottom: 5px;"><strong>Người đặt:</strong> <?=$bill_name?></p>
            <p style="color: #ccc; margin-bottom: 5px;"><strong>Email:</strong> <?=$bill_email?></p>
            <p style="color: #ccc; margin-bottom: 5px;"><strong>Số điện thoại:</strong> <?=$bill_tel?></p>
            <p style="color: #ccc;"><strong>Địa chỉ:</strong> <?=$bill_address?></p>
        </div>

        <div class="card" style="flex: 1; text-align: left; background: #222; border: 1px solid #444;">
            <h3 style="font-size: 16px; border-bottom: 1px solid #444; padding-bottom: 10px; margin-bottom: 15px; color: #d0021b;">THÔNG TIN ĐƠN HÀNG</h3>
            <p style="color: #ccc; margin-bottom: 5px;"><strong>Mã đơn:</strong> DC-<?=$id?></p>
            <p style="color: #ccc; margin-bottom: 5px;"><strong>Ngày đặt:</strong> <?=$ngaydathang?></p>
            <p style="color: #ccc; margin-bottom: 5px;"><strong>Tổng tiền:</strong> <span style="color: #00e676; font-size: 16px;"><?=number_format($total)?> đ</span></p>
            <p style="color: #ccc;"><strong>Trạng thái:</strong> <?=$ttdh?></p>
        </div>
    </div>

    <div class="card-box" style="display: block;">
        <div class="card" style="text-align: left; padding: 0;">
            <table style="margin: 0; border: none;">
                <thead>
                    <tr style="background: #333;">
                        <th style="width: 50px;">STT</th>
                        <th style="width: 100px;">HÌNH ẢNH</th>
                        <th>TÊN SẢN PHẨM</th>
                        <th style="width: 150px;">ĐƠN GIÁ</th>
                        <th style="width: 100px; text-align: center;">SỐ LƯỢNG</th>
                        <th style="width: 150px;">THÀNH TIỀN</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 1;
                        foreach ($bill_detail as $cart) {
                            extract($cart);
                            // $img, $name, $price, $soluong, $thanhtien lấy từ bảng cart
                            
                            // Xử lý ảnh
                            $hinhpath = "../img/" . $img;
                            if(is_file($hinhpath)){
                                $hinh = "<img src='".$hinhpath."' height='50' style='border: 1px solid #555; border-radius: 4px;'>";
                            } else {
                                $hinh = "No photo";
                            }

                            echo '
                            <tr>
                                <td style="color: #888;">'.$i.'</td>
                                <td>'.$hinh.'</td>
                                <td style="font-weight: bold; color: #fff;">'.$name.'</td>
                                <td style="color: #ccc;">'.number_format($price).' đ</td>
                                <td style="text-align: center; font-weight: bold;">'.$soluong.'</td>
                                <td style="color: #d0021b; font-weight: bold;">'.number_format($thanhtien).' đ</td>
                            </tr>';
                            $i++;
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div style="margin-top: 20px;">
        <a href="index.php?act=listdh"><button class="btn-main" style="background: #555;">QUAY LẠI DANH SÁCH</button></a>
        <a href="index.php?act=suadh&id=<?=$id?>"><button class="btn-main" style="background: #2979ff; margin-left: 10px;">CẬP NHẬT TRẠNG THÁI</button></a>
    </div>
</div>