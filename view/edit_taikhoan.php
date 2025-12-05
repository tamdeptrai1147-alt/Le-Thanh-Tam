<?php
    if(isset($_SESSION['user']) && (is_array($_SESSION['user']))){
        extract($_SESSION['user']);
    }
?>
<div class="account-page">
    
    <?php include "view/box_left_acc.php"; ?>

    <div class="acc-content">
        <div class="acc-header">
            <h2>Hồ Sơ Của Tôi</h2>
            <p>Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
        </div>

        <form action="index.php?act=edit_taikhoan" method="post">
            <div class="form-row">
                <div class="form-label">Tên đăng nhập</div>
                <div class="form-input-box">
                    <input type="text" name="user" class="acc-input" value="<?=$user?>" readonly style="background: #222;">
                </div>
            </div>
            
            <div class="form-row">
    <div class="form-label">Email</div>
    <div class="form-input-box">
        <input type="text" name="email" class="acc-input" value="<?=$email?>" readonly style="background: #222; color: #888; cursor: not-allowed;">
        
        <span style="color: #555; font-size: 12px; margin-top: 5px; display: block;">
            Email đăng ký không thể thay đổi
        </span>
    </div>
</div>

            <div class="form-row">
                <div class="form-label">Số điện thoại</div>
                <div class="form-input-box">
                    <input type="text" name="tel" class="acc-input" value="<?=$tel?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-label">Mật khẩu</div>
                <div class="form-input-box">
                    <input type="password" name="pass" class="acc-input" value="<?=$pass?>">
                </div>
            </div>
            
            <input type="hidden" name="address" value="<?=$address?>">
            <input type="hidden" name="id" value="<?=$id?>">

            <div class="form-row">
                <div class="form-label"></div>
                <div class="form-input-box">
                    <button type="submit" name="capnhat" value="1" class="btn-save-acc">Lưu Thay Đổi</button>
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