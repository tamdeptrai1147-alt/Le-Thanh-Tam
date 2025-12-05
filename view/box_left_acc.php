<div class="acc-sidebar">
    <div class="user-profile-mini">
        <div class="user-avatar">
            <i class="fa-solid fa-dragon"></i> </div>
        <div class="user-info-text">
            <strong><?=$_SESSION['user']['user']?></strong>
            <span style="color: #d0021b;"><i class="fa-solid fa-pen"></i> Sửa hồ sơ</span>
        </div>
    </div>

    <nav class="acc-menu">
        <ul>
            <?php $act = isset($_GET['act']) ? $_GET['act'] : ''; ?>
            
            <li>
                <a href="index.php?act=edit_taikhoan" class="<?php if($act=='edit_taikhoan') echo 'active'; ?>">
                    <i class="fa-solid fa-user"></i> Tài khoản của tôi
                </a>
            </li>
            <li>
                <a href="index.php?act=address" class="<?php if($act=='address') echo 'active'; ?>">
                    <i class="fa-solid fa-map-location-dot"></i> Sổ địa chỉ
                </a>
            </li>
            <li>
                <a href="index.php?act=mybill" class="<?php if($act=='mybill') echo 'active'; ?>">
                    <i class="fa-solid fa-file-invoice-dollar"></i> Đơn mua
                </a>
            </li>
            <li>
                <a href="index.php?act=thoat" style="color: #666;">
                    <i class="fa-solid fa-right-from-bracket"></i> Đăng xuất
                </a>
            </li>
        </ul>
    </nav>
</div>