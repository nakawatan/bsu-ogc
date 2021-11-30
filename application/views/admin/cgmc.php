<div class="container">
    <?php $this->view('templates/banner'); ?>
    <?php $this->view('templates/admin-tab'); ?>
    <h2 class="text-center"><?= $title ?></h2>
    <div class="btn-list">
        <a href="<?= LINK ?>admin/cgmc_ojt" class="<?= $cgmc_ojt_pending ? 'btn-pending' : '' ?>">On-the-job Training <?= $cgmc_ojt_pending ? '<i>Pending</i>' : '' ?></a>
        <a href="<?= LINK ?>admin/cgmc_ja" class="<?= $cgmc_ja_pending ? 'btn-pending' : '' ?>">Employment, licensure examination and further studies <?= $cgmc_ja_pending ? '<i>Pending</i>' : '' ?></a>
        <a href="<?= LINK ?>admin/cgmc_ss" class="<?= $cgmc_ss_pending ? 'btn-pending' : '' ?>">Scholarship <?= $cgmc_ss_pending ? '<i>Pending</i>' : '' ?></a>
        <a href="<?= LINK ?>admin/cgmc_tf" class="<?= $cgmc_tf_pending ? 'btn-pending' : '' ?>">Transferring Students <?= $cgmc_tf_pending ? '<i>Pending</i>' : '' ?></a>
        <a href="<?= LINK ?>admin/cgmc_ta" class="<?= $cgmc_ta_pending ? 'btn-pending' : '' ?>">Ten Outstanding Students Awards (TOSA) Application <?= $cgmc_ta_pending ? '<i>Pending</i>' : '' ?></a>
        <a href="<?= LINK ?>admin/cgmc_rnur" class="<?= $cgmc_rnur_pending ? 'btn-pending' : '' ?>">Students who will represent the University in regional/ national/ international competitions <?= $cgmc_rnur_pending ? '<i>Pending</i>' : '' ?></a>
    </div>    
</div>