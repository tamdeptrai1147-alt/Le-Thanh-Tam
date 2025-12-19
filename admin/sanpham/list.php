<div class="container-fluid">
    <h2 class="page-title">QUẢN LÝ SẢN PHẨM</h2>
    
    <div class="card-box" style="display: block; margin-bottom: 20px;">
        <form action="index.php?act=listsp" method="post" style="display: flex; gap: 10px;">
            <input type="text" name="kyw" placeholder="Nhập tên sản phẩm..." style="padding: 10px; background: #222; border: 1px solid #444; color: #fff; border-radius: 4px; width: 300px;">
            
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
            <table style="margin: 0; border: none;">
                <thead>
                    <tr style="background: #b20000;">
                        <th style="width: 50px;">ID</th>
                        <th style="width: 100px;">HÌNH ẢNH</th>
                        <th>TÊN SẢN PHẨM</th>
                        <th style="width: 150px;">GIÁ BÁN</th>
                        <th style="width: 100px; text-align: center;">LƯỢT XEM</th>
                        <th style="width: 100px; text-align: center;">TRẠNG THÁI</th>
                        <th style="width: 150px;">THAO TÁC</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listsanpham as $sanpham): ?>
                        <?php
                            extract($sanpham);
                            $suasp = "index.php?act=suasp&id=".$id;
                            
                            // 1. Xử lý hình ảnh
                            $hinhpath = "../img/" . $img;
                            if(is_file($hinhpath)){
                                $hinh_html = "<img src='".$hinhpath."' height='60' style='border-radius: 4px; border: 1px solid #555;'>";
                            } else {
                                $hinh_html = "No photo";
                            }

                            // 2. Xử lý trạng thái (Nếu chưa có cột status thì mặc định là 0)
                            $trangthai = isset($status) ? $status : 0;
                        ?>
                        <tr>
                            <td style="color: #888;">#<?=$id?></td>
                            <td><?=$hinh_html?></td>
                            <td style="font-weight: bold; color: #fff;"><?=$name?></td>
                            <td style="color: #d0021b; font-weight: bold;"><?=number_format($price)?> đ</td>
                            <td style="text-align: center;"><?=$view?></td>
                            
                            <td style="text-align: center;">
                                <?php if($trangthai == 0): ?>
                                    <span style="color:#00e676; font-weight:bold;">Đang hiện</span>
                                <?php else: ?>
                                    <span style="color:#666; font-style:italic;">Đã ẩn</span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <a href="<?=$suasp?>">
                                    <button style="background: #2979ff; color: white; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer;">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>
                                </a>
                               
                                <?php if($trangthai == 0): ?>
                                    <a href="index.php?act=an_hien_sp&id=<?=$id?>&tt=1" onclick="return confirm('Tạm ẩn sản phẩm này?')">
                                        <button style="background: #ff1744; color: #fff; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer; margin-left: 5px;" title="Ẩn sản phẩm">
                                            <i class="fa-solid fa-eye-slash"></i>
                                        </button>
                                    </a>
                                <?php else: ?>
                                    <a href="index.php?act=an_hien_sp&id=<?=$id?>&tt=0" onclick="return confirm('Hiển thị lại sản phẩm này?')">
                                        <button style="background: #00e676; color: #000; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer; margin-left: 5px;" title="Hiện sản phẩm">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <div style="margin-top: 20px;">
        <a href="index.php?act=addsp">
            <input type="button" value="NHẬP THÊM" class="btn-main" style="padding: 10px 20px; font-weight: bold;">
        </a>
    </div>
</div>