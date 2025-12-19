<?php
    if(is_array($bill)){
        extract($bill);
    }
?>
<div class="container-fluid">
    <h2 class="page-title">CẬP NHẬT TRẠNG THÁI ĐƠN HÀNG: DC-<?=$id?></h2>
    
    <div class="card-box" style="display: block;">
        <div class="card" style="text-align: left; max-width: 600px; margin: 0 auto;">
           <form action="index.php?act=updatedh" method="post">
    
    <div style="margin-bottom: 20px;">
        <label style="color: #ccc; display: block; margin-bottom: 10px;">Chọn trạng thái đơn hàng:</label>
        <div style="background: #222; padding: 20px; border-radius: 5px; border: 1px solid #444;">
            
            <div style="margin-bottom: 10px; opacity: <?=($bill_status > 0) ? '0.5' : '1'?>;">
                <input type="radio" name="ttdh" value="0" 
                    <?=($bill_status==0)?'checked':''?> 
                    <?=($bill_status > 0)?'disabled':''?> > 
                <span style="color: #ffff00; font-weight: bold; margin-left: 5px;">Đơn hàng mới</span>
            </div>
            
            <div style="margin-bottom: 10px; opacity: <?=($bill_status > 1) ? '0.5' : '1'?>;">
                <input type="radio" name="ttdh" value="1" 
                    <?=($bill_status==1)?'checked':''?> 
                    <?=($bill_status > 1)?'disabled':''?> > 
                <span style="color: #00e676; font-weight: bold; margin-left: 5px;">Đang xử lý</span>
            </div>
            
            <div style="margin-bottom: 10px; opacity: <?=($bill_status > 2) ? '0.5' : '1'?>;">
                <input type="radio" name="ttdh" value="2" 
                    <?=($bill_status==2)?'checked':''?> 
                    <?=($bill_status > 2)?'disabled':''?> > 
                <span style="color: #2979ff; font-weight: bold; margin-left: 5px;">Đang giao hàng</span>
            </div>
            
            <div>
                <input type="radio" name="ttdh" value="3" 
                    <?=($bill_status==3)?'checked':''?>
                    > 
                <span style="color: #ff1744; font-weight: bold; margin-left: 5px;">Đã giao hàng (Hoàn tất)</span>
            </div>

        </div>
    </div>

    <div>
        <input type="hidden" name="id" value="<?=$id?>">
        
        <?php if($bill_status < 3): ?>
            <input type="submit" name="capnhat" value="CẬP NHẬT NGAY" class="btn-main" style="padding: 10px 30px; background: #b20000; font-size: 14px;">
        <?php else: ?>
            <button type="button" class="btn-main" style="background: #333; cursor: not-allowed;">ĐƠN HÀNG ĐÃ HOÀN TẤT</button>
        <?php endif; ?>
        
        <a href="index.php?act=listdh"><button type="button" class="btn-main" style="background: #555;">QUAY LẠI</button></a>
    </div>

</form>
        </div>
    </div>
</div>