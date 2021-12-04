<div class="container">
    <?php $this->view('templates/banner'); ?>
    <?php $this->view('templates/admin-tab'); ?>
    <h2 class="text-center"><?= $title ?></h2>
    <h3 class="text-center"><?= $sub_heading; ?></h3>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>SR-Code</th>
                    <th>Name</th>
                    <th>Program</th>
                    <th>Year</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            if($data_table) :
                foreach($data_table as $info) :
            ?>
                <tr <?php if(!$info['cgmc_file']): ?> data-target="<?= base_url('admin/update_cgmc_ta/').$info['id'] ?>" <?= $info['cgmc_file'] ? 'disabled' : '' ?><?php endif; ?>>
                <td><span class="check-icon txt-green <?= !$info['cgmc_file'] ? 'visible-hidden' : '' ?>"><i class="fas fa-check"></i></span><?= $info['username'] ?></td>
                    <td><?= $info['last_name'] ?>, <?= $info['first_name'] ?> <?= $info['middle_name'] ?></td>
                    <td><?= $info['course'] ?></td>
                    <td>4th Year</td>
                </tr>
            <?php 
                endforeach; 
            else:
                echo '<tr><td colspan="4">NO RESULT FOUND</td></tr>';
            endif;
            ?>
            </tbody>
        </table>
    </div>
    <p class="text-center">*** Nothing Follows ***</p>
</div>
<?php //print_r($data_table); ?>
<!-- <div class="form-container"></div> -->
<div class="update-form-modal custom-modal">
    <div class="modal-wrap">
        <div class="modal-box">
            <div class="modal-header">Update Form</div>
            <div class="modal-body"></div>
        </div>
    </div>
    <div class="modal-bg-overlay"></div>
</div>