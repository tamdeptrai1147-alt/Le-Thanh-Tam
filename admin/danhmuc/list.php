<div class="container-fluid">
    <h2 class="page-title">QUẢN LÝ DANH MỤC</h2>
    
    <div class="card-box" style="display: block;">
        <div class="card" style="text-align: left;">
            <div style="margin-bottom: 20px;">
                <a href="index.php?act=adddm">
                    <button type="button" class="btn-main"><i class="fa-solid fa-plus"></i> THÊM DANH MỤC MỚI</button>
                </a>
            </div>
            
            <table>
                <thead>
                    <tr>
                        <th style="width: 50px;">CHỌN</th>
                        <th style="width: 100px;">MÃ LOẠI</th>
                        <th>TÊN DANH MỤC</th>
                        <th style="width: 150px; text-align: center;">TRẠNG THÁI</th>
                        <th style="width: 150px;">THAO TÁC</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listdanhmuc as $danhmuc): ?>
                        <?php
                            extract($danhmuc);
                            // $id, $name, $status lấy từ database
                            $suadm = "index.php?act=suadm&id=".$id;
                            
                            // Kiểm tra trạng thái (Mặc định là 0 nếu chưa có)
                            $trangthai = isset($status) ? $status : 0;
                        ?>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>DC-<?=$id?></td>
                            <td style="font-weight: bold; color: #fff;"><?=$name?></td>
                            
                            <td style="text-align: center;">
                                <?php if($trangthai == 0): ?>
                                    <span style="color:#00e676; font-weight:bold;">Đang hiện</span>
                                <?php else: ?>
                                    <span style="color:#666; font-style:italic;">Đã ẩn</span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <a href="<?=$suadm?>">
                                    <button style="background: #2979ff; color: white; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer;">
                                        <i class="fa-solid fa-pen-to-square"></i> Sửa
                                    </button>
                                </a>

                                <?php if($trangthai == 0): ?>
                                    <a href="index.php?act=an_hien_dm&id=<?=$id?>&tt=1" onclick="return confirm('Tạm ẩn danh mục này? (Các sản phẩm thuộc danh mục này vẫn còn)')">
                                        <button style="background: #ff1744; color: white; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer; margin-left: 5px;" title="Ẩn danh mục">
                                            <i class="fa-solid fa-eye-slash"></i>
                                        </button>
                                    </a>
                                <?php else: ?>
                                    <a href="index.php?act=an_hien_dm&id=<?=$id?>&tt=0" onclick="return confirm('Hiển thị lại danh mục này?')">
                                        <button style="background: #00e676; color: #000; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer; margin-left: 5px;" title="Hiện danh mục">
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
</div>