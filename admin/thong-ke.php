<?php
    // 1. KẾT NỐI DATABASE (BẮT BUỘC - Code bất tử)
    // Dùng include_once để đảm bảo file này luôn có kết nối, dù chạy trực tiếp hay qua index
    // Đường dẫn này trỏ ngược ra ngoài 1 cấp -> vào folder model -> vào pdo.php
    if(file_exists("../model/pdo.php")){
        include_once "../model/pdo.php";
    }

    // 2. HÀM KIỂM TRA ĐỂ TRÁNH LỖI FATAL ERROR
    if(!function_exists('pdo_query')){
        echo "<div style='color:red; padding:20px;'>LỖI: Không tìm thấy file kết nối PDO! Hãy kiểm tra lại đường dẫn '../model/pdo.php'</div>";
        die(); // Dừng ngay lập tức để không xoay vòng
    }

    // 3. LẤY DỮ LIỆU BIỂU ĐỒ (Dùng try-catch để bắt lỗi SQL)
    try {
        // Chuyển đổi ngày từ dạng '09:22:50 01/12/2025' sang dạng chuẩn
        $sql_revenue = "SELECT 
                            DATE(STR_TO_DATE(ngaydathang, '%H:%i:%s %d/%m/%Y')) as ngay_chuan, 
                            SUM(total) as tong_tien 
                        FROM bill 
                        WHERE bill_status >= 0 
                        GROUP BY ngay_chuan 
                        ORDER BY ngay_chuan ASC LIMIT 7";
        $list_revenue = pdo_query($sql_revenue);
    } catch (Exception $e) {
        $list_revenue = []; // Nếu lỗi SQL thì trả về rỗng để web không sập
    }

    $chart_dates = [];
    $chart_revenue = [];
    
    if(!empty($list_revenue) && is_array($list_revenue)){
        foreach ($list_revenue as $row) {
            if(isset($row['ngay_chuan']) && $row['ngay_chuan'] != null){
                $chart_dates[] = date('d/m', strtotime($row['ngay_chuan'])); 
                $chart_revenue[] = (int)$row['tong_tien'];
            }
        }
    }

    // 4. LẤY TRẠNG THÁI ĐƠN HÀNG
    $data_status = [0, 0, 0, 0]; 
    try {
        $sql_status = "SELECT bill_status, COUNT(*) as so_luong FROM bill GROUP BY bill_status";
        $list_status = pdo_query($sql_status);
        if(is_array($list_status)){
            foreach ($list_status as $row) {
                $stt = $row['bill_status'];
                if(isset($data_status[$stt])) $data_status[$stt] = $row['so_luong'];
            }
        }
    } catch (Exception $e) { }

    // 5. LẤY TOP SẢN PHẨM
    $top_products = [];
    try {
        $sql_top_sp = "SELECT name, img, price, SUM(soluong) as da_ban FROM cart GROUP BY idpro ORDER BY da_ban DESC LIMIT 5";
        $top_products = pdo_query($sql_top_sp);
    } catch (Exception $e) { }
?>

<div class="container-fluid">
    <div class="page-title" style="margin-bottom: 25px; border-left: 5px solid #d0021b; padding-left: 15px;">
        <h3 style="color: #fff; text-transform: uppercase; font-size: 24px; font-weight: bold; margin: 0;">
            <i class="fa-solid fa-chart-line" style="color: #d0021b; margin-right: 10px;"></i> THỐNG KÊ DOANH THU
        </h3>
    </div>

    <div class="row card-box" style="display: flex; gap: 20px; flex-wrap: wrap;">
        <div class="col-8" style="flex: 2; min-width: 500px;">
            <div class="card" style="background: #111; padding: 20px; border: 1px solid #333; border-radius: 5px;">
                <p style="border-left: 3px solid #d0021b; padding-left: 10px; color: #fff; font-weight: bold; margin-bottom: 20px; text-align: left;">
                    DOANH THU THEO NGÀY
                </p>
                <div style="height: 350px;">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-4" style="flex: 1; min-width: 300px;">
            <div class="card" style="background: #111; padding: 20px; border: 1px solid #333; border-radius: 5px;">
                <p style="border-left: 3px solid #d0021b; padding-left: 10px; color: #fff; font-weight: bold; margin-bottom: 20px; text-align: left;">
                    TRẠNG THÁI ĐƠN HÀNG
                </p>
                <div style="height: 220px; position: relative; display: flex; justify-content: center;">
                    <canvas id="statusChart"></canvas>
                </div>
                <div style="margin-top: 25px; font-size: 13px; color: #ccc;">
                    <div style="display:flex; justify-content:space-between; border-bottom:1px solid #333; padding:8px 0;">
                        <span><i class="fas fa-circle text-warning"></i> Đơn hàng mới</span> <b style="color: #fff;"><?= $data_status[0] ?></b>
                    </div>
                    <div style="display:flex; justify-content:space-between; border-bottom:1px solid #333; padding:8px 0;">
                        <span><i class="fas fa-circle" style="color: #2979ff;"></i> Đang giao</span> <b style="color: #fff;"><?= $data_status[1] ?></b>
                    </div>
                    <div style="display:flex; justify-content:space-between; padding:8px 0;">
                        <span><i class="fas fa-circle" style="color: #00e676;"></i> Hoàn thành</span> <b style="color: #fff;"><?= $data_status[2] ?></b>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card" style="background: #111; padding: 20px; border: 1px solid #333; border-radius: 5px; margin-top: 20px;">
        <p style="border-left: 3px solid #d0021b; padding-left: 10px; color: #fff; font-weight: bold; margin-bottom: 15px; text-align: left;">
            TOP SẢN PHẨM BÁN CHẠY
        </p>
        <table style="width: 100%; border-collapse: collapse; color: #ccc;">
            <thead>
                <tr style="background: #1f1f1f; color: #fff;">
                    <th style="padding: 12px; text-align: left; border-bottom: 2px solid #d0021b;">TOP</th>
                    <th style="padding: 12px; text-align: left; border-bottom: 2px solid #d0021b;">SẢN PHẨM</th>
                    <th style="padding: 12px; text-align: left; border-bottom: 2px solid #d0021b;">GIÁ BÁN</th>
                    <th style="padding: 12px; text-align: center; border-bottom: 2px solid #d0021b;">SL BÁN</th>
                    <th style="padding: 12px; text-align: right; border-bottom: 2px solid #d0021b;">TỔNG THU</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($top_products) && is_array($top_products)): $i=1; ?>
                    <?php foreach($top_products as $sp): ?>
                        <tr style="border-bottom: 1px solid #333;">
                            <td style="padding: 12px;">
                                <span style="background:#d0021b; color:#fff; padding:2px 8px; border-radius:3px; font-weight:bold;">#<?= $i++ ?></span>
                            </td>
                            <td style="padding: 12px; display: flex; align-items: center;">
                                <img src="../upload/<?= $sp['img'] ?>" 
                                     onerror="this.src='https://via.placeholder.com/40x40?text=IMG'" 
                                     style="width: 40px; height: 40px; object-fit: cover; margin-right: 10px; border: 1px solid #444; border-radius: 4px;">
                                <?= $sp['name'] ?>
                            </td>
                            <td style="padding: 12px; color: #ffab00; font-weight: bold;"><?= number_format($sp['price']) ?> đ</td>
                            <td style="padding: 12px; text-align: center; color: #fff; font-weight: bold;"><?= $sp['da_ban'] ?></td>
                            <td style="padding: 12px; text-align: right; color: #00e676; font-weight: bold;">
                                <?= number_format($sp['price'] * $sp['da_ban']) ?> đ
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5" style="padding: 20px; text-align: center;">Chưa có dữ liệu</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctxR = document.getElementById('revenueChart').getContext('2d');
    const grad = ctxR.createLinearGradient(0, 0, 0, 400);
    grad.addColorStop(0, 'rgba(208, 2, 27, 0.6)'); 
    grad.addColorStop(1, 'rgba(208, 2, 27, 0)');

    new Chart(ctxR, {
        type: 'line',
        data: {
            labels: <?= json_encode($chart_dates) ?>,
            datasets: [{
                label: 'Doanh thu',
                data: <?= json_encode($chart_revenue) ?>,
                borderColor: '#d0021b',
                backgroundColor: grad,
                fill: true, tension: 0.3, pointBackgroundColor: '#fff'
            }]
        },
        options: { 
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { grid: { color: '#333' }, ticks: { color: '#aaa', callback: function(v){ return v.toLocaleString() + ' đ'; } } },
                x: { grid: { display: false }, ticks: { color: '#aaa' } }
            }
        }
    });

    new Chart(document.getElementById('statusChart'), {
        type: 'doughnut',
        data: {
            labels: ['Mới', 'Giao', 'Xong', 'Hủy'],
            datasets: [{
                data: <?= json_encode($data_status) ?>,
                backgroundColor: ['#ffc107', '#2979ff', '#00e676', '#ff1744'],
                borderColor: '#111', borderWidth: 4
            }]
        },
        options: { responsive: true, maintainAspectRatio: false, cutout: '75%', plugins: { legend: { display: false } } }
    });
</script>