<div class="container-fluid">
    <h2 class="page-title">QUẢN LÝ SẢN PHẨM</h2>
    
    <div class="card-box" style="display: block; margin-bottom: 20px;">
        <form action="index.php?act=listsp" method="post" style="display: flex; gap: 10px;">
            <input type="text" name="kyw" placeholder="Nhập tên sản phẩm cần tìm..." style="padding: 10px; background: #222; border: 1px solid #444; color: #fff; border-radius: 4px; width: 300px;">
            
            <select name="iddm" style="padding: 10px; background: #222; border: 1px solid #444; color: #fff; border-radius: 4px;">
                <option value="0" selected>Tất cả danh mục</option>
                <?php
                    foreach ($listdanhmuc as $danhmuc) {
                        extract($danhmuc);
                        echo '<option value="'.$id.'">'.$name.'</option>';
                    }
                ?>
            </select>
            
            <input type="submit" name="listok" value="TÌM KIẾM" class="btn-main" style="border: none;">
        </form>
    </div>

    <div class="card-box" style="display: block;">
        <div class="card" style="text-align: left; padding: 0;">
            <div style="padding: 20px; border-bottom: 1px solid #333;">
                <a href="index.php?act=addsp">
                    <button type="button" class="btn-main" style="background: #00e676; color: #000;"><i class="fa-solid fa-plus"></i> Thêm Sản Phẩm Mới</button>
                </a>
            </div>
            
            <table style="margin: 0; border: none;">
                <thead>
                    <tr style="background: #b20000;"> <th style="width: 50px;">ID</th>
                        <th style="width: 100px;">ẢNH</th>
                        <th>TÊN SẢN PHẨM</th>
                        <th style="width: 150px;">GIÁ BÁN</th>
                        <th style="width: 100px;">LƯỢT XEM</th>
                        <th style="width: 150px;">THAO TÁC</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($listsanpham as $sanpham) {
                            extract($sanpham);
                            // $name, $price, $img, $id, $view ... lấy từ DB
                            
                            $suasp = "index.php?act=suasp&id=".$id;
                            $xoasp = "index.php?act=xoasp&id=".$id;
                            
                            // Xử lý ảnh
                            $hinhpath = "../img/" . $img;
                            if(is_file($hinhpath)){
                                $hinh = "<img src='".$hinhpath."' height='60' style='border-radius: 4px; border: 1px solid #555;'>";
                            } else {
                                $hinh = "No photo";
                            }

                            echo '
                            <tr>
                                <td style="color: #888;">#'.$id.'</td>
                                <td>'.$hinh.'</td>
                                <td style="font-weight: bold; color: #fff;">'.$name.'</td>
                                <td style="color: #d0021b; font-weight: bold;">'.number_format($price).' đ</td>
                                <td style="text-align: center;">'.$view.'</td>
                                <td>
                                    <a href="'.$suasp.'"><button style="background: #2979ff; color: white; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer;"><i class="fa-solid fa-pen"></i></button></a>
                                    <a href="'.$xoasp.'" onclick="return confirm(\'Xóa sản phẩm này?\')"><button style="background: #ff1744; color: white; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer; margin-left: 5px;"><i class="fa-solid fa-trash"></i></button></a>
                                </td>
                            </tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>