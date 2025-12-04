<div class="row mb">
    <div class="boxtitle">QUÊN MẬT KHẨU</div>
    <div class="row boxcontent" style="min-height: 300px;">
        
        <form action="index.php?act=quenmk" method="post" style="width: 50%; margin: 0 auto; padding-top: 20px;">
            <div class="row mb10">
                Email đăng ký của bạn:<br>
                <input type="email" name="email" required placeholder="Nhập email..." style="width: 100%; padding: 10px; margin-top: 5px;">
            </div>
            
            <div class="row mb10">
                <input type="submit" value="Gửi yêu cầu" name="gui_email" style="padding: 10px 20px; cursor: pointer;">
                <input type="reset" value="Nhập lại" style="padding: 10px 20px; cursor: pointer;">
            </div>
        </form>

        <?php 
            if(isset($thongbao) && ($thongbao != "")){
                echo '<h3 style="color: red; text-align: center; margin-top: 20px;">'.$thongbao.'</h3>';
            }
        ?>
        
    </div>
</div>