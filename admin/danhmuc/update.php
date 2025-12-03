<?php
    if(is_array($dm)){
        extract($dm);
    }
?>

<div class="container-fluid">
    <h2 class="page-title">CẬP NHẬT DANH MỤC</h2>
    
    <div class="card-box" style="display: block;">
        <div class="card" style="text-align: left; max-width: 600px; margin: 0 auto;">
            
            <form action="index.php?act=updatedm" method="post">
                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 5px; color: #ccc;">Mã loại</label>
                    <input type="text" disabled value="DC-<?=$id?>" style="width: 100%; padding: 10px; background: #333; border: 1px solid #555; color: #888; border-radius: 4px;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 5px; color: #fff; font-weight: bold;">Tên danh mục</label>
                    <input type="text" name="tenloai" value="<?=$name?>" required style="width: 100%; padding: 10px; background: #222; border: 1px solid #555; color: #fff; border-radius: 4px;">
                </div>

                <div>
                    <input type="hidden" name="id" value="<?=$id?>">
                    
                    <input type="submit" name="capnhat" value="CẬP NHẬT" class="btn-main" style="padding: 10px 25px; font-size: 14px; background: #2979ff;">
                    <a href="index.php?act=listdm"><button type="button" class="btn-main" style="background: #555;">HỦY BỎ</button></a>
                </div>
            </form>
        </div>
    </div>
</div>