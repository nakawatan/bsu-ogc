<?php
defined('BASEPATH') or exit('No direct script access allowed');
// define('LINK', base_url());
// define('ASSETS', LINK . 'assets/');

//print_r($student);
$tabs_param = $this->input->get('tab');
?>

<!-- <img src="" alt=""> -->
<div class="container">
    <div class="ogc-logo d-flex d-center">
        <img src="<?= ASSETS ?>images/Official_Seal_of_Batangas_State_University.png" alt="">
        <div>
            <h2>Office of Guidance and Counseling</h2>
            <span>Batangas State University Main Campus II</span>
        </div>
    </div>
	<?php $this->view('templates/banner'); ?>
	<h2 class="text-center">Office of Guidance and Counseling</h2>
	<?php $this->view('templates/admin-tab'); ?>
	<?php //print_r($request_cgmc_ojt); ?>
	<div class="tab-content tab-admin">
		<div id="tab-services" class="<?= ($tabs_param != 'forms') ? 'active' : '' ?>">
			<ul>
				<li><a href="<?= LINK ?>admin/request_cgmc"><i class="fas fa-file-alt"></i> Certificate of Good Moral Character</a></li>
				<li><a href="#"><i class="fas fa-hand-holding-heart"></i> e-Counseling</a></li>
				<li><a href="<?= LINK ?>admin/group_counseling"><i class="fas fa-users"></i> Group Counseling</a></li>
				<li><a href="<?= LINK ?>admin/appointments/exit_interview"><i class="fas fa-user-friends"></i> Exit Interview</a></li>
				<li class="has-sub-menu">
					<a href="#"><i class="fas fa-briefcase"></i> On-The-Job Training Interview</a>
					<ul class="sub-menu">
						<li><a href="<?= LINK ?>admin/appointments/initial_interview">Initial Interview</a></li>
						<li><a href="<?= LINK ?>admin/appointments/post_interview">Post Interview</a></li>
					</ul>
				</li>
			</ul>
		</div>
		
		<div id="tab-forms" class="<?= ($tabs_param == 'forms') ? 'active' : '' ?>">
			<div class="p-30">
				<p>&nbsp;</p>
				<div class="text-center">
					<button class="btn btn-primary">
						<i class="fas fa-plus"></i> Add Forms
					</button>
				</div>
				<p>&nbsp;</p>
				<?php foreach($form_list as $val): ?>
				<div class="form-file-list text-center">
					<div class="form-file-item d-flex" style="justify-content: center;margin-bottom: 10px;">
						<a href="<?= ASSETS ?>forms/<?= $val['form_file'] ?>" target="_blank" class="form-file-title"><?= $val['form_title'] ?></a>
						<button type="button" class="btn-icon btn-delete" data-id="<?= $val['id'] ?>"><i class="fas fa-times-circle"></i></button>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>

<div class="forms-modal custom-modal">
	<div class="modal-wrap">
		<div class="modal-box">
			<div class="modal-header">Add Form</div>
			<form method="post" class="form-validate" action="<?= LINK ?>admin/store_form_file">
				<div class="form-group mb-5">
			        <div class="label"><strong>Title</strong></div>
			        <input type="text" name="form_file_title" id="form_file_title">
			    </div>
			    <div class="form-group">
					<div class="label"></div>
					<input type="file" name="form_file" id="form_file">
					<label class="btn-attach" for="form_file" title="Attach file here">Attach file here</label>	
				</div>
				<p class="text-center"><button type="submit" class="btn btn-red">Save</button></p>
			</form>
		</div>
	</div>
	<div class="modal-bg-overlay"></div>
</div>