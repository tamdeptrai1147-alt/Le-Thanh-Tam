<main>
    <div class="banner">
        <img src="img/banner.jpg" alt="Banner" style="width:100%; height:300px; object-fit:cover; background:#333;">
    </div>
    
    <h2>NEW ARRIVALS</h2>
    <div class="row">
        <?php
            foreach($spnew as $sp){
                extract($sp);
                // Vì database để tiếng Anh nên biến là $name, $price, $img
                $img_path = "img/" . $img;
                echo '
                    <div class="boxsp">
                        <div class="img-box">
                            <img src="'.$img_path.'" alt="'.$name.'">
                        </div>
                        <h3>'.$name.'</h3>
                        <p class="price">$'.$price.'</p>
                        <button>Add to Cart</button>
                    </div>
                ';
            }
        ?>
    </div>
</main>