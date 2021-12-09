<?php 
	$disable_hour = maybe_unserialize($option['disable_hour']);
	$disable_day = maybe_unserialize($option['disable_day']);
	$disable_month = maybe_unserialize($option['disable_month']);

	$disable_hour = $disable_hour ? $disable_hour : ['empty_array'];
	$disable_day = $disable_day ? $disable_day : ['empty_array'];
	$disable_month = $disable_month ? $disable_month : ['empty_array'];
?>
<form id="settings" method="post">
	<div class="setting-appointments">
		<h3>Appointments</h3>
		<div class="form-group">
			<div class="form-wrap form-select">
				<label>Disable Hour</label>
				<div class="select-items">
					<?php foreach($allow_hour as $time): //print_r($disable_hour); ?>
					<label><input type="checkbox" name="disable_hour[]" value="<?= $time ?>" <?= in_array($time, $disable_hour) ? 'checked' : '' ?>> <?= $time ?></label>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="form-wrap form-select">
				<label>Disable Day</label>
				<div class="select-items four-col">
					<?php foreach($allow_day as $day): ?>
					<label><input type="checkbox" name="disable_day[]" value="<?= $day ?>" <?= in_array($day, $disable_day) ? 'checked' : '' ?>> <?= $day ?></label>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="form-wrap form-select">
				<label>Disable Month</label>
				<div class="select-items two-col">
					<?php foreach($allow_month as $month): ?>
					<label><input type="checkbox" name="disable_month[]" value="<?= $month ?>" <?= in_array($month, $disable_month) ? 'checked' : '' ?>> <?= $month ?></label>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<h3>Announcements</h3>
		<div class="form-group">
			<button class="btn btn-plain" type="button">Change</button>
		</div>
	</div>
	<div class="setting-announcement" style="display: none;">
		<h3>Announcements</h3>
		<div class="form-group form-wrap">
			<div class="form-select">
				<label class="banner_add">
					<i class="fas fa-plus"></i> Add photo
					<!-- <input type="file" name="banner_add" class="hide"> -->
				</label>
			</div>	
		</div>
		<div class="banner-list">
			<?php 
				// print_r($banners);
				if($banners){
					foreach ($banners as $val) {
			?>
			<div class="banner-item d-flex">
				<div class="banner-thumb">
					<img src="<?= base_url() ?>assets/uploads/banners/<?= $val['banner_img'] ?>" alt="">
				</div>
				<button type="button" class="btn-icon btn-delete btn-delete-banner" data-id="<?= $val['id'] ?>"><i class="fas fa-times-circle"></i></button>
			</div>
			<?php
					}
				}
			?>
		</div>
	</div>
	<div>
		<h3>Password</h3>
		<div class="form-group">
			<div class="label"><strong>Current Password : </strong></div>
			<input type="password" name="old-password" class="old-password" style="border: none; border-bottom: 2px solid red; width:70%;"/>
		</div>
		<div class="form-group">
			<div class="label"><strong>New Password : </strong></div>
			<input type="password" name="new-password" class="new-password" style="border: none; border-bottom: 2px solid red; width:70%;"/>
		</div>
		<div class="form-group">
			<div class="label"><strong>New Password : </strong></div>
			<input type="password" name="confirm-password" class="confirm-password" style="border: none; border-bottom: 2px solid red; width:70%;"/>
		</div>
	</div>
	<div class="text-center">
		<button class="btn btn-red" type="submit">Save Changes</button>
	</div>
</form>