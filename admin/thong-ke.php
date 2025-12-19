<?php
    // KẾT NỐI DATABASE (Sửa lỗi Fatal Error)
    include_once "../model/pdo.php"; 

    // --- A. DATA BIỂU ĐỒ ---
    $sql_revenue = "SELECT DATE(STR_TO_DATE(ngaydathang, '%H:%i:%s %d/%m/%Y')) as ngay_chuan, SUM(total) as tong_tien 
                    FROM bill WHERE bill_status >= 0 GROUP BY ngay_chuan ORDER BY ngay_chuan ASC LIMIT 7";
    $list_revenue = pdo_query($sql_revenue);
    $dates = []; $totals = [];
    if(is_array($list_revenue)){
        foreach ($list_revenue as $r) { 
            if($r['ngay_chuan']){ $dates[] = date('d/m', strtotime($r['ngay_chuan'])); $totals[] = (int)$r['tong_tien']; }
        }
    }

    // --- B. DATA TRẠNG THÁI ---
    $list_stt = pdo_query("SELECT bill_status, COUNT(*) as sl FROM bill GROUP BY bill_status");
    $stt_data = [0,0,0,0];
    if(is_array($list_stt)){ foreach($list_stt as $s) { if(isset($stt_data[$s['bill_status']])) $stt_data[$s['bill_status']] = $s['sl']; } }

    // --- C. DATA TOP SP ---
    $top_sp = pdo_query("SELECT name, img, price, SUM(soluong) as da_ban FROM cart GROUP BY idpro ORDER BY da_ban DESC LIMIT 5");
?>

<div class="container-fluid">
    <div style="border-left:5px solid #d0021b; padding-left:15px; margin-bottom:25px;">
        <h3 style="color:#fff; text-transform:uppercase; font-weight:bold;">THỐNG KÊ DOANH THU</h3>
    </div>

    <div style="display:flex; gap:20px; flex-wrap:wrap;">
        <div style="flex:2; background:#111; padding:20px; border:1px solid #333; border-radius:5px;">
            <p style="color:#fff; border-left:3px solid #d0021b; padding-left:10px; margin-bottom:15px;">DOANH THU 7 NGÀY QUA</p>
            <div style="height:300px;"><canvas id="chartRevenue"></canvas></div>
        </div>
        <div style="flex:1; background:#111; padding:20px; border:1px solid #333; border-radius:5px;">
            <p style="color:#fff; border-left:3px solid #d0021b; padding-left:10px; margin-bottom:15px;">TRẠNG THÁI</p>
            <div style="height:200px;"><canvas id="chartStatus"></canvas></div>
             <div style="margin-top:15px; color:#ccc; font-size:13px;">
                <div style="display:flex; justify-content:space-between; border-bottom:1px solid #333; padding:5px 0;"><span>Mới:</span> <b style="color:#fff"><?=$stt_data[0]?></b></div>
                <div style="display:flex; justify-content:space-between; border-bottom:1px solid #333; padding:5px 0;"><span>Giao:</span> <b style="color:#fff"><?=$stt_data[1]?></b></div>
                <div style="display:flex; justify-content:space-between; padding:5px 0;"><span>Xong:</span> <b style="color:#fff"><?=$stt_data[2]?></b></div>
            </div>
        </div>
    </div>

    <div style="background:#111; padding:20px; border:1px solid #333; border-radius:5px; margin-top:20px;">
        <p style="color:#fff; border-left:3px solid #d0021b; padding-left:10px; margin-bottom:15px;">TOP SẢN PHẨM</p>
        <table style="width:100%; color:#ccc; border-collapse:collapse;">
            <thead><tr style="background:#1f1f1f; color:#fff;"><th style="padding:10px; text-align:left;">SP</th><th style="padding:10px;">GIÁ</th><th style="padding:10px;">BÁN</th><th style="padding:10px; text-align:right;">THU</th></tr></thead>
            <tbody>
                <?php if($top_sp): foreach($top_sp as $sp): ?>
                <tr style="border-bottom:1px solid #333;">
                    <td style="padding:10px; display:flex; align-items:center;">
                        <img src="../upload/<?=$sp['img']?>" onerror="this.src='https://via.placeholder.com/40'" style="width:40px; height:40px; margin-right:10px; object-fit:cover;">
                        <?=$sp['name']?>
                    </td>
                    <td style="padding:10px; color:#ffab00; font-weight:bold;"><?=number_format($sp['price'])?>đ</td>
                    <td style="padding:10px; text-align:center; color:#fff;"><?=$sp['da_ban']?></td>
                    <td style="padding:10px; text-align:right; color:#00e676; font-weight:bold;"><?=number_format($sp['price']*$sp['da_ban'])?>đ</td>
                </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    new Chart(document.getElementById('chartRevenue'), {
        type:'line',
        data:{ labels:<?=json_encode($dates)?>, datasets:[{label:'Doanh thu', data:<?=json_encode($totals)?>, borderColor:'#d0021b', backgroundColor:'rgba(208,2,27,0.2)', fill:true, tension:0.4}] },
        options:{ plugins:{legend:{display:false}}, scales:{y:{grid:{color:'#333'},ticks:{color:'#aaa'}}, x:{grid:{display:false},ticks:{color:'#aaa'}}} }
    });
    new Chart(document.getElementById('chartStatus'), {
        type:'doughnut',
        data:{ labels:['Mới','Giao','Xong','Hủy'], datasets:[{data:<?=json_encode($stt_data)?>, backgroundColor:['#ffc107','#2979ff','#00e676','#ff1744'], borderColor:'#111', borderWidth:3}] },
        options:{ cutout:'75%', plugins:{legend:{display:false}} }
    });
</script>