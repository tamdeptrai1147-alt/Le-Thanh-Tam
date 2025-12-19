<div class="container-fluid">
    <h2 class="page-title">QUẢN LÝ NGƯỜI DÙNG</h2>
    
    <div class="card-box" style="display: block;">
        <div class="card" style="text-align: left; padding: 0;">
            <table style="margin: 0; border: none;">
                <thead>
                    <tr style="background: #3498db;"> <th style="width: 50px;">ID</th>
                        <th>TÊN ĐĂNG NHẬP</th>
                        <th>HỌ VÀ TÊN / EMAIL</th>
                        <th>ĐIỆN THOẠI</th>
                        <th style="width: 200px;">VAI TRÒ</th>
                        <th style="width: 100px;">THAO TÁC</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($listtaikhoan as $tk) {
                            extract($tk);
                            // $id, $user, $email, $role, $tel...
                            
                            $xoatk = "index.php?act=xoakh&id=".$id;
                            
                            // Xử lý hiển thị vai trò
                            if($role == 1){
                                $role_txt = "Quản trị viên (Admin)";
                                $color_role = "color: #ff1744; font-weight: bold;";
                            } else {
                                $role_txt = "Khách hàng";
                                $color_role = "color: #fff;";
                            }

                            // Form để sửa quyền nhanh
                            $form_role = '
                            <form action="index.php?act=suarole" method="post" style="display:flex; gap:5px;">
                                <input type="hidden" name="id" value="'.$id.'">
                                <select name="role" style="padding: 5px; background: #222; color: #fff; border: 1px solid #444; border-radius: 3px;">
                                    <option value="0" '.($role==0?'selected':'').'>Khách hàng</option>
                                    <option value="1" '.($role==1?'selected':'').'>Admin</option>
                                </select>
                                <button type="submit" name="capnhat_role" value="1" style="background: #00e676; border: none; padding: 5px; border-radius: 3px; cursor: pointer; color: #000; font-weight: bold;">Lưu</button>
                            </form>';

                            echo '
                            <tr>
                                <td style="color: #888;">#'.$id.'</td>
                                <td style="font-weight: bold; color: #fff;">'.$user.'</td>
                                <td>
                                    <span style="display:block; font-weight:bold;">'.$user.'</span> <span style="font-size:12px; color:#aaa;">'.$email.'</span>
                                </td>
                                <td>'.$tel.'</td>
                                <td>'.$form_role.'</td>
                                <td>
                                    
                            </tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>