<form class="form-validate" id="update_cgmc_rnur" action="./update_cgmc_rnur/<?= $data_table['id'] ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="student_id" value="<?= $data_table['student_id'] ?>">
    <input type="hidden" name="request_id" value="<?= $data_table['id'] ?>">
    <input type="hidden" name="cgmc_type" value="request_cgmc_rnu_rep">
    <div class="form-header d-flex" style="margin-bottom: 30px; justify-content: space-between;">
      <div>
        <h3 style="margin-bottom: 10px;"><?= $data_table['last_name'] ?>, <?= $data_table['first_name'] ?> <?= $data_table['middle_name'] ?></h3>
        <span><?= $data_table['course'] ?></span>
      </div>
      <div class="text-right">
        <h3 style="margin-bottom: 10px;">18-07620</h3>
        <span>4th year</span>
      </div>
    </div>
    <!-- $rnu_rep_cgmc_form_file & $rnu_rep_cgmc_form_status is not yet on database. -->
		<div class="form-group mb-5">
          <div class="label"><strong>Certificate of Good Moral Character Form:</strong><small>Signed by the OSD and OJT Coordinator</small></div>
          <label class="btn-attach" for="rnu_rep_cgmc_form_file" data-target="<?= base_url('assets/uploads/docs/').encodeFolder($data_table['student_id']).'/'.$data_table['cgmc_form_file'] ?>"><?= $data_table['cgmc_form_file']; ?></label>   
          <div class="approved txt-green <?= $data_table['cgmc_form_status'] == 'pending' || $data_table['cgmc_form_status'] == 'reject' ? 'hide' : '' ?>" data-target="rnu_rep_cgmc_form_status"><i class="fas fa-check"></i></div>
          <div class="approved txt-red <?= $data_table['cgmc_form_status'] == 'pending' || $data_table['cgmc_form_status'] == 'approved' ? 'hide' : '' ?>" data-target="rnu_rep_cgmc_form_status"><i class="fas fa-times"></i></div>
        </div>
    <div class="form-group text-right mt-0">
        <div><input type="hidden" name="rnu_rep_cgmc_form_status" value="<?= $data_table['cgmc_form_status'] ?>"></div>
        <div class="d-right">
          <button type="button" class="btn btn-green btn-small btn-approved" data-input="rnu_rep_cgmc_form_status">Approved</button>
          <button type="button" class="btn btn-small btn-reject" data-input="rnu_rep_cgmc_form_status">Reject</button>
        </div>
    </div>
	
    <div class="form-group mb-5">
        <div class="label"><strong>Registration Form:</strong></div>
        <label class="btn-attach" for="registration_form_file" data-target="<?= base_url('assets/uploads/docs/').encodeFolder($data_table['student_id']).'/'.$data_table['registration_form_file'] ?>"><?= $data_table['registration_form_file']; ?></label>   
        <div class="approved txt-green <?= $data_table['registration_form_status'] == 'pending' || $data_table['registration_form_status'] == 'reject' ? 'hide' : '' ?>" data-target="registration_form_status"><i class="fas fa-check"></i></div>
        <div class="approved txt-red <?= $data_table['registration_form_status'] == 'pending' || $data_table['registration_form_status'] == 'approved' ? 'hide' : '' ?>" data-target="registration_form_status"><i class="fas fa-times"></i></div>
    </div>
    <div class="form-group text-right mt-0">
        <div><input type="hidden" name="registration_form_status" value="<?= $data_table['registration_form_status'] ?>"></div>
        <div class="d-right">
          <button type="button" class="btn btn-green btn-small btn-approved" data-input="registration_form_status">Approved</button>
          <button type="button" class="btn btn-small btn-reject" data-input="registration_form_status">Reject</button>
        </div>
    </div>
    <div class="form-group text-right">
      <button type="submit" class="btn btn-red">Done</button>
    </div>
</form>