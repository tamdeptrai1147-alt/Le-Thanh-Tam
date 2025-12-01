<main>
    <div class="container" style="max-width: 500px; margin: 50px auto; padding: 30px; background: #222; border-radius: 10px; box-shadow: 0 0 20px rgba(220, 20, 20, 0.3);">
        
        <h2 style="text-align: center; color: #fff; margin-bottom: 25px; font-weight: bold; text-transform: uppercase;">
            ĐĂNG KÝ THÀNH VIÊN
        </h2>

        <?php 
            if(isset($thongbao) && $thongbao != ""){
                echo '<p style="color: #0f0; font-weight: bold; text-align: center;">'.$thongbao.'</p>';
            }
        ?>

        <form action="index.php?act=dangky" method="post">
            <label style="font-weight: bold; color: #ccc; display: block; margin-top: 15px;">Tên đăng nhập:</label>
            <input type="text" name="user" required style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #555; border-radius: 4px; background: #333; color: #fff;">

            <label style="font-weight: bold; color: #ccc; display: block; margin-top: 15px;">Mật khẩu:</label>
            <input type="password" name="pass" required style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #555; border-radius: 4px; background: #333; color: #fff;">

            <label style="font-weight: bold; color: #ccc; display: block; margin-top: 15px;">Email:</label>
            <input type="email" name="email" required style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #555; border-radius: 4px; background: #333; color: #fff;">

            <label style="font-weight: bold; color: #ccc; display: block; margin-top: 15px;">Địa chỉ:</label>
            <input type="text" name="address" style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #555; border-radius: 4px; background: #333; color: #fff;">

            <label style="font-weight: bold; color: #ccc; display: block; margin-top: 15px;">Điện thoại:</label>
            <input type="text" name="tel" style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #555; border-radius: 4px; background: #333; color: #fff;">

            <div style="text-align: center; margin-top: 25px;">
                <input type="submit" name="dangky" value="ĐĂNG KÝ" style="background: #b20000; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; margin-right: 10px;">
                <input type="reset" value="NHẬP LẠI" style="background: #555; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">
            </div>
        </form>
    </div>
</main>