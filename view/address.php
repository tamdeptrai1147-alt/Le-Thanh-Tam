<div class="account-page">
    
    <?php include "view/box_left_acc.php"; ?>

    <div class="acc-content">
        <div class="acc-header">
            <h2>Sổ Địa Chỉ</h2>
            <p>Quản lý địa chỉ giao hàng của bạn (Hiện tại hỗ trợ 1 địa chỉ mặc định)</p>
        </div>

        <form action="index.php?act=address" method="post">
            <div class="form-row">
                <div class="form-label">Họ và tên</div>
                <div class="form-input-box">
                    <input type="text" class="acc-input" value="<?=$_SESSION['user']['user']?>" readonly style="background: #222; color: #777;">
                </div>
            </div>

            <div class="form-row">
                <div class="form-label">Số điện thoại</div>
                <div class="form-input-box">
                    <input type="text" class="acc-input" value="<?=$_SESSION['user']['tel']?>" readonly style="background: #222; color: #777;">
                </div>
            </div>

            <div class="form-row">
                <div class="form-label">Địa chỉ nhận hàng</div>
                <div class="form-input-box">
                    <textarea name="address" class="acc-input" style="height: 100px; padding-top: 10px;" required><?=$address?></textarea>
                    <span style="color: #666; font-size: 12px; margin-top: 5px; display: block;">Ví dụ: Số 123, Đường ABC, Phường XYZ, Quận 1, TP.HCM</span>
                </div>
            </div>

            <input type="hidden" name="id" value="<?=$id?>">
            <input type="hidden" name="user" value="<?=$user?>">
            <input type="hidden" name="pass" value="<?=$pass?>">
            <input type="hidden" name="email" value="<?=$email?>">
            <input type="hidden" name="tel" value="<?=$tel?>">

            <div class="form-row">
                <div class="form-label"></div>
                <div class="form-input-box">
                    <button type="submit" name="capnhat_address" value="1" class="btn-save-acc">Lưu Địa Chỉ</button>
                </div>
            </div>
            
            <?php 
                if(isset($thongbao) && ($thongbao!="")){
                    echo '<div style="margin-top: 20px; color: #d0021b; font-weight: bold; text-align: center;">'.$thongbao.'</div>';
                }
            ?>
        </form>
    </div>
</div>