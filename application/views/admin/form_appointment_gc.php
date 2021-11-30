<h2 class="text-center">Group Counseling Appointments</h2>
<h3 class="text-center">
	<i><?= date('F j, Y', strtotime($date)); ?></i><br>
	<small><?= date('l', strtotime($date)); ?></small>
</h3>
<?php 
  //print_r($appointment);
  foreach($appointment as $key => $val) : 
    echo '<h3>'.date('h:i A', strtotime($key)).'</h3>';
    echo '<form class="data-group" method="post" action="'.base_url('admin/update_appointment_gc/').$date.'">';
    $arr = [];
    foreach ($val as $info) {
      $arr[$info['status']][] = $info;
?>
    <input type="hidden" name="request_id[]" value="<?= $info['id'] ?>">
    <div data-request-id="<?= $info['id'] ?>" class="d-flex">
      <span><?= $info['first_name'].' '.$info['middle_name'].' '.$info['last_name'] ?></span>
      <div class="status-icon">
        <span class="times-icon txt-red <?= ($info['status'] != 'reject') ? 'hide' : '' ?>"><i class="fas fa-times" aria-hidden="true"></i></span>
        <span class="check-icon txt-green <?= ($info['status'] != 'approved') ? 'hide' : '' ?>"><i class="fas fa-check" aria-hidden="true"></i></span>
      </div>
    </div>
<?php
    }
?>
    <div class="text-right">
      <button class="btn btn-green btn-small btn-confirm" type="button" <?=!isset($arr['pending']) ? 'disabled' : '' ?>>Confirm</button>
      <button class="btn btn-red btn-small btn-reject" type="button" <?=!isset($arr['pending']) ? 'disabled' : '' ?>>Reject</button>
    </div>
<?php
    echo '</form>';
  endforeach; 
?>