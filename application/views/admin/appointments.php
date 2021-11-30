<div class="container">
    <?php $this->view('templates/banner'); ?>
    <?php $this->view('templates/admin-tab'); ?>
    <h2 class="text-center"><?= $title; ?></h2>
    <h3 class="text-center" style="text-transform: uppercase;"><?= $get_month; ?></h3>
    <div class="btn-list-style-2 btn-months btn-two-col <?= $get_month ? 'hide' : '' ?>">
        <?php 
            foreach (allow_month() as $month) {
                echo '<a href="'.LINK.'admin/appointments/'.$type.'/'.$month.'" class="accordion">'.$month.'</a>';
            }
        ?>
    </div>
    <?php //print_r($get_appointments); ?>
    <div class="btn-list-style-2 btn-days <?= !empty($get_month) ? '' : 'hide' ?>">
        <?php 
            foreach (allow_days_of_week() as $day) :
                echo '<a href="'.LINK.'admin/appointments/'.$type.'/'.$get_month.'/'.$day.'">'.$day.'</a>';
        ?>
        <div class="<?= $day != $get_day ? 'hide' : '' ?>">
            <?php if($get_appointments): ?>
            <table>
                <tbody>
                <?php foreach($get_appointments as $appointments) : ?>
                    <tr>
                        <td>
                            <span class="check-icon txt-green <?= $appointments['status'] == 'pending' ? 'visible-hidden' : '' ?>"><i class="fas fa-check"></i></span>
                            <span class="date-holder"><?= date('d', strtotime($appointments['date'])); ?></span>
                            <span class="txt-pending <?= $appointments['status'] == 'approved' ? 'visible-hidden' : '' ?>">Pending</span>
                        </td>
                        <td><a href="<?= LINK ?>admin/update_appointment/<?= $type.'/'.$appointments['date'] ?>" class="btn btn-green btn-small">View Appointments</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php 
                else: echo '<div class="text-center">No Results Found</div>';
                endif; 
            ?>
        </div>
        <?php
            endforeach;
        ?>
    </div>
</div>

<div class="appointment-modal appointment-type custom-modal modal-style-2">
    <div class="modal-wrap">
        <div class="modal-box">
            <div class="modal-content"></div>
        </div>
    </div>
    <div class="modal-bg-overlay"></div>
</div> 