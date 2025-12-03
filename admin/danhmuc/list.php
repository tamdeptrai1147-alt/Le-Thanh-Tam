<div class="container-fluid">
    <h2 class="page-title">QUẢN LÝ DANH MỤC</h2>
    
    <div class="card-box" style="display: block;">
        <div class="card" style="text-align: left;">
            <div style="margin-bottom: 20px;">
                <a href="index.php?act=adddm">
                    <button type="button" class="btn-main"><i class="fa-solid fa-plus"></i> THÊM DANH MỤC MỚI</button>
                </a>
            </div>
            
            <table>
                <thead>
                    <tr>
                        <th style="width: 50px;">CHỌN</th>
                        <th style="width: 100px;">MÃ LOẠI</th>
                        <th>TÊN DANH MỤC</th>
                        <th style="width: 150px;">THAO TÁC</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($listdanhmuc as $danhmuc) {
                            extract($danhmuc);
                            // $id và $name lấy từ database
                            $suadm = "index.php?act=suadm&id=".$id;
                            $xoadm = "index.php?act=xoadm&id=".$id;
                            
                            echo '
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>DC-'.$id.'</td>
                                <td style="font-weight: bold; color: #fff;">'.$name.'</td>
                                <td>
                                    <a href="'.$suadm.'"><button style="background: #2979ff; color: white; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer;"><i class="fa-solid fa-pen-to-square"></i> Sửa</button></a>
                                    <a href="'.$xoadm.'" onclick="return confirm(\'Bạn có chắc chắn muốn xóa?\')"><button style="background: #ff1744; color: white; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer; margin-left: 5px;"><i class="fa-solid fa-trash"></i> Xóa</button></a>
                                </td>
                            </tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>