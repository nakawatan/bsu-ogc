<div id="site-banner">
    <div class="swiper-container container">
        <div class="swiper-wrapper">
            <?php 
                if($banners){
                    foreach ($banners as $val) {
            ?>
            <div class="swiper-slide">
                <img src="<?= ASSETS.'uploads/banners/'.$val['banner_img'] ?>" alt="">
            </div>
            <?php
                    }
                }
            ?>
        </div>
        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
</div>