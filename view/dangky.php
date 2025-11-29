<main>
    <div class="container" style="max-width: 500px; margin: 50px auto; padding: 30px; background: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <h2 style="text-align: center; color: #b20000; margin-bottom: 25px;">ĐĂNG KÝ THÀNH VIÊN</h2>

        <?php 
            // Hiển thị thông báo (nếu có)
            if(isset($thongbao) && $thongbao != ""){
                echo '<p style="color: green; font-weight: bold; text-align: center;">'.$thongbao.'</p>';
            }
        ?>

        <form action="index.php?act=dangky" method="post">
            <label>Tên đăng nhập:</label>
            <input type="text" name="user" required>

            <label>Mật khẩu:</label>
            <input type="password" name="pass" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Địa chỉ:</label>
            <input type="text" name="address">

            <label>Điện thoại:</label>
            <input type="text" name="tel">

            <div style="text-align: center; margin-top: 20px;">
                <input type="submit" name="dangky" value="ĐĂNG KÝ" class="btn-submit">
                <input type="reset" value="NHẬP LẠI" class="btn-reset">
            </div>
        </form>
    </div>
</main>
<style>
    /* CSS CƠ BẢN cho form */
    label { display: block; margin-top: 15px; font-weight: bold; color: #333; }
    input[type="text"], input[type="password"], input[type="email"] {
        width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;
    }
    .btn-submit { background: #b20000; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; margin-right: 10px; }
    .btn-reset { background: #555; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; }
</style>