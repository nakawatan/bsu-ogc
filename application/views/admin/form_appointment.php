<h2 class="text-center"><?= $title ?></h2>
<h3 class="text-center">
	<i><?= date('F j, Y', strtotime($date)); ?></i><br>
	<small><?= date('l', strtotime($date)); ?></small>
</h3>

<?php 
  foreach($appointment as $key => $val) : 
    echo '<h3>'.date('h:i A', strtotime($key)).'</h3>';
    foreach ($val as $info) {
?>
    <div class="d-flex d-center appointment-item">
      <div class="status-icon">
        <span class="times-icon txt-red <?= ($info['status'] != 'reject') ? 'hide' : '' ?>"><i class="fas fa-times" aria-hidden="true"></i></span>
        <span class="check-icon txt-green <?= ($info['status'] != 'approved') ? 'hide' : '' ?>"><i class="fas fa-check" aria-hidden="true"></i></span>
      </div>
      <span><?= $info['first_name'].' '.$info['middle_name'].' '.$info['last_name'] ?></span>
      <div class="d-right">
        <button class="btn btn-green btn-small btn-confirm" type="button" data-request-id="<?= $info['id'] ?>" <?= $info['status'] != 'pending' ? 'disabled' : ''; ?>>Confirm</button>
        <button class="btn btn-red btn-small btn-reject" type="button" data-request-id="<?= $info['id'] ?>" <?= $info['status'] != 'pending' ? 'disabled' : ''; ?>>Reject</button>
      </div>
    </div>
<?php
    }
  endforeach; 
?>