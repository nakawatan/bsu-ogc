<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

    </main><!-- #site-main -->

    <footer id="site-footer">
        <div class="container">
            <h3>About <div class="fr">Email Address: <a href="#">ogc.main2@g.batstate-u.edu.ph</a></div></h3>
            <p>University's Guidance Counselors</p>
            <p class="tab-style"><img src="<?= ASSETS ?>images/Official_Seal_of_Batangas_State_University.png" alt="" class="fr"><span>Pablo Borbon Main I, Lemery, and San Juan</span> <strong>-</strong> Asst. Prof. Renan T. Mallari, RGC LPT<br>
            <span>Alangilan, Balayan, Lobo and Mabini</span> <strong>-</strong> Ms. Carol Biklin G. Macabagdal<br>
            <span>JBLPC - Malvar</span> <strong>-</strong> Asst. Prof. Leonora P. Santos, RGC<br>
            <span>Lipa</span> <strong>-</strong> Ms. Shelyn Extra, RPm<br>
            <span>ARASOF - Nasugbu</span> <strong>-</strong> Ms. Analyn H. Venzon, RGC<br>
            <span>Rosario</span> <strong>-</strong> Dr. Myra A. Bersoto, RGC. RPm</p>
            <p>The university, through its registered guidance counselors, is ready to reach out and connect with you, our dear clients, through different online or electronic platforms.</p>
            <p class="text-right" style="margin-top: 50px;">Leading Innovations, Transforming Lives</p>
        </div>
    </footer>

    <?php if($controller == 'admin'): ?>
    <div class="view-file-modal custom-modal modal-style-2">
      <div class="modal-wrap">
          <div class="modal-box">
              <button class="modal-close" type="button"><i class="far fa-times-circle"></i></button>
              <div class="modal-header">View File</div>
              <div class="modal-content">
                <iframe src="" frameborder="0"></iframe>
              </div>
          </div>
      </div>
      <div class="modal-bg-overlay-2"></div>
    </div>  
    <div class="settings-modal custom-modal modal-style-2">
        <div class="modal-wrap">
            <div class="modal-box">
                <!-- <button class="modal-close" type="button"><i class="fas fa-times"></i></button> -->
                <div class="modal-header">Settings</div>
                <div class="modal-content">
                    <?php $this->view('admin/settings'); ?>
                </div>
            </div>
        </div>
        <div class="modal-bg-overlay"></div>
    </div> 
    <div class="cgmc-file-modal custom-modal modal-style-3">
        <div class="modal-wrap" style="max-width: 700px;">
            <div class="modal-box">
                <div class="modal-header">
                    <h3>GOOD MORAL CHARACTER</h3>
                    <i><?= isset($sub_heading) ? $sub_heading : '' ?></i>
                </div>
                <div class="modal-content">
                    <form method="post" action="<?= LINK ?>admin/update_cgmc_file">
                        <input type="hidden" name="request_id" value="">
                        <input type="hidden" name="student_id" value="">
                        <input type="hidden" name="cgmc_type" value="">
                        <div class="text-center" style="padding: 100px 0;">
                            <input type="file" name="cgmc_file" id="student-cgmc-file" style="display: none;">
                            <label for="student-cgmc-file" class="btn" title="">Attach file here</label>
                        </div>
                        <div class="text-right">
                            <button class="btn btn-red" type="submit">Send</button>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
        <div class="modal-bg-overlay-2"></div>
    </div>  
    <?php endif; ?>

    <?php 
        $disable_hour = maybe_unserialize($option['disable_hour']);
        $disable_day = maybe_unserialize($option['disable_day']);
        $disable_hour = maybe_unserialize($option['disable_hour']);
        $disable_month = maybe_unserialize($option['disable_month']);
        $disable_dates = [];
        $d_month = [];
        $d_day = [];
        // print_r($gc_appointments_not_available);
        if($gc_appointments_not_available){
            foreach ($gc_appointments_not_available as $d) {
                $disable_dates[] = date('Y-m-d', strtotime($d));
            }
        }
        
        foreach ($disable_month as $month) {
            $d_month[] = (int) date('n', strtotime($month));
        }

        foreach ($disable_day as $day) {
            $d_day[] = (int) $day;
        }
    ?>

    <script>
        var site_params = {
            'base_url': '<?= LINK ?>',
            'disable_hour' : <?= json_encode($disable_hour) ?>,
            'disable_months' : <?= json_encode($d_month) ?>,
            'disable_days' : <?= json_encode($d_day) ?>,
            'disable_dates' : <?= json_encode($disable_dates) ?>,
            'maxDate' : '<?= date('Y-m-d', strtotime('+3 months')); ?>'
        };
        // console.log(disable_day);
    </script>

    <script src="/assets/js/jquery.js"></script>
    <script src="<?= ASSETS ?>js/plugins/print.min.js"></script>
    <!-- <script src="<?= ASSETS ?>js/plugins/jquery.datetimepicker.full.js"></script> -->
    <script src="/assets/js/jquery-ui.js"></script>
    <script src="<?= ASSETS ?>js/plugins/sweetalert.min.js"></script>
    <script src="<?= ASSETS ?>js/plugins/swiper.min.js"></script>
    <script src="<?= ASSETS ?>js/common.js"></script>

    <?php if($controller == 'admin'): ?><script src="<?= ASSETS ?>js/admin/common.js"></script><?php endif; ?>
</body>

</html>