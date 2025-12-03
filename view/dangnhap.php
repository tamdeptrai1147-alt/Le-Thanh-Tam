<main>
    <div class="container" style="max-width: 500px; margin: 50px auto; padding: 40px; background: #222; border-radius: 10px; box-shadow: 0 0 20px rgba(220, 20, 20, 0.3);">
        
        <h2 style="text-align: center; color: #fff; margin-bottom: 30px; font-weight: bold; text-transform: uppercase;">
            ĐĂNG NHẬP
        </h2>

        <?php if(isset($thongbao)&&$thongbao!="") echo '<p style="color:red;text-align:center;font-weight:bold;">'.$thongbao.'</p>'; ?>

        <form action="index.php?act=dangnhap" method="post">
            <div style="margin-bottom: 15px;">
                <label style="font-weight: bold; color: #ccc;">Tên đăng nhập:</label>
                <input type="text" name="user" required style="width: 100%; padding: 10px; border: 1px solid #555; border-radius: 5px; margin-top: 5px; background: #333; color: #fff;">
            </div>

            <div style="margin-bottom: 25px;">
                <label style="font-weight: bold; color: #ccc;">Mật khẩu:</label>
                <input type="password" name="pass" required style="width: 100%; padding: 10px; border: 1px solid #555; border-radius: 5px; margin-top: 5px; background: #333; color: #fff;">
            </div>

            <input type="submit" name="dangnhap" value="ĐĂNG NHẬP NGAY" style="width: 100%; padding: 12px; background: #b20000; color: #fff; border: none; font-weight: bold; border-radius: 5px; cursor: pointer; font-size: 16px;">
            
            <p style="text-align: center; margin-top: 20px;">
                <a href="index.php?act=quenmk" style="color: #888; font-size: 14px; text-decoration: none;">Quên mật khẩu?</a>
            </p>
            <p style="text-align: center; margin-top: 10px; font-size: 14px; color: #ccc;">
                Chưa có tài khoản? <a href="index.php?act=dangky" style="color: #b20000; font-weight: bold;">Đăng ký ngay</a>
            </p>
        </form>
    </div>
</main>