<?php
    if(isset($_SESSION['user']) && (is_array($_SESSION['user']))){
        extract($_SESSION['user']);
    }
?>

<div class="account-page">
    
    <div class="acc-sidebar">
        <div class="user-profile-mini">
            <div class="user-avatar">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="user-info-text">
                <strong><?=$user?></strong>
                <span><i class="fa-solid fa-pen"></i> Sửa hồ sơ</span>
            </div>
        </div>

        <nav class="acc-menu">
            <ul>
                <li><a href="index.php?act=edit_taikhoan" class="active"><i class="fa-solid fa-user"></i> Hồ sơ của tôi</a></li>
                <li><a href="index.php?act=mybill"><i class="fa-solid fa-file-invoice"></i> Đơn mua</a></li>
                <li><a href="index.php?act=thoat" style="color: #666;"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a></li>
            </ul>
        </nav>
    </div>

    <div class="acc-content">
        <div class="acc-header">
            <h2>Hồ Sơ Của Tôi</h2>
            <p>Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
        </div>

        <form action="index.php?act=edit_taikhoan" method="post">
            
            <div class="form-row">
                <div class="form-label">Tên đăng nhập</div>
                <div class="form-input-box">
                    <input type="text" name="user" class="acc-input" value="<?=$user?>" readonly>
                    <span class="form-note">Tên đăng nhập không thể thay đổi</span>
                </div>
            </div>

            <div class="form-row">
                <div class="form-label">Mật khẩu</div>
                <div class="form-input-box">
                    <input type="text" name="pass" class="acc-input" value="<?=$pass?>">
                </div>
            </div>

            

            <div class="form-row">
                <div class="form-label">Số điện thoại</div>
                <div class="form-input-box">
                    <input type="text" name="tel" class="acc-input" value="<?=$tel?>">
                </div>
            </div>

             <div class="form-row">
                <div class="form-label">Địa chỉ</div>
                <div class="form-input-box">
                    <input type="text" name="address" class="acc-input" value="<?=$address?>">
                </div>
            </div>

            <input type="hidden" name="id" value="<?=$id?>">

            <input type="hidden" name="email" value="<?=$email?>">

            <div class="form-row">
                <div class="form-label"></div>
                <div class="form-input-box">
                    <button type="submit" name="capnhat" value="1" class="btn-save-acc">Lưu Thay Đổi</button>
                </div>
            </div>
            
            <?php 
                if(isset($thongbao) && ($thongbao!="")){
                    echo '<div style="margin-top: 20px; padding: 10px; background: rgba(0,255,0,0.1); border: 1px solid #00ff00; color: #00ff00; text-align: center; border-radius: 4px;">'.$thongbao.'</div>';
                }
            ?>

        </form>
    </div>
</div>