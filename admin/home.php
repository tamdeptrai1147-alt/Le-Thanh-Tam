<div class="container-fluid">
    <h2 class="page-title">TỔNG QUAN HỆ THỐNG</h2>
    
    <div class="card-box">
        <div class="card">
            <p>TỔNG SẢN PHẨM</p>
            <h3 class="text-green"><?php echo isset($count_sp) ? $count_sp : 0; ?></h3>
        </div>
        <div class="card">
            <p>ĐƠN HÀNG MỚI</p>
            <h3 class="text-orange"><?php echo isset($count_bill) ? $count_bill : 0; ?></h3>
        </div>
        <div class="card">
            <p>KHÁCH HÀNG</p>
            <h3 class="text-blue"><?php echo isset($count_kh) ? $count_kh : 0; ?></h3>
        </div>
        <div class="card">
            <p>DOANH THU</p>
            <h3 class="text-red"><?php echo isset($sum_total) ? number_format($sum_total) : 0; ?> đ</h3>
        </div>
    </div>

    <div style="display: flex; gap: 20px;">
        
        <div style="flex: 2; background: #111; padding: 20px; border-radius: 5px; border: 1px solid #333;">
            <h4 style="margin-bottom: 20px; color: #fff; text-transform: uppercase; font-size: 14px; border-bottom: 1px solid #333; padding-bottom: 10px;">
                <i class="fa-solid fa-chart-column" style="color: #d0021b;"></i> Biểu đồ doanh thu
            </h4>
            
            <div style="border-left: 1px solid #444; border-bottom: 1px solid #444; height: 300px; position: relative; display: flex; align-items: flex-end; justify-content: space-around; padding-bottom: 10px;">
                
                <div style="width: 40px; height: 20%; background: #b20000; opacity: 0.6;" title="Tháng 10"></div>
                <div style="width: 40px; height: 45%; background: #b20000; opacity: 0.8;" title="Tháng 11"></div>
                <div style="width: 40px; height: 80%; background: #d0021b; box-shadow: 0 0 10px #d0021b;" title="Tháng 12"></div>
                
                <div style="position: absolute; width: 100%; top: 20%; border-top: 1px dashed #333;"></div>
                <div style="position: absolute; width: 100%; top: 50%; border-top: 1px dashed #333;"></div>
                <div style="position: absolute; width: 100%; top: 80%; border-top: 1px dashed #333;"></div>
            </div>
        </div>

        <div style="flex: 1; background: #111; padding: 20px; border-radius: 5px; border: 1px solid #333;">
            <h4 style="margin-bottom: 20px; color: #fff; text-transform: uppercase; font-size: 14px; border-bottom: 1px solid #333; padding-bottom: 10px;">
                <i class="fa-regular fa-clock" style="color: #d0021b;"></i> Mới cập nhật
            </h4>
            
            <ul style="list-style: none;">
                <li style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #222;">
                    <span style="display: block; font-weight: bold; color: #fff;">Đơn hàng #13</span>
                    <span style="font-size: 13px; color: #888;">Khách: Nguyễn Văn A</span>
                    <span style="float: right; font-size: 12px; color: #4caf50;">+260k</span>
                </li>
                <li style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #222;">
                    <span style="display: block; font-weight: bold; color: #fff;">Đơn hàng #12</span>
                    <span style="font-size: 13px; color: #888;">Khách: Trần Thị B</span>
                    <span style="float: right; font-size: 12px; color: #4caf50;">+150k</span>
                </li>
                <li>
                    <span style="display: block; font-weight: bold; color: #fff;">User mới</span>
                    <span style="font-size: 13px; color: #888;">User: dragon_boy</span>
                    <span style="float: right; font-size: 12px; color: #2196f3;">New</span>
                </li>
            </ul>
        </div>
    </div>
</div>