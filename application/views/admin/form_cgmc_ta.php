<form class="form-validate" id="update_cgmc_ta" action="./update_cgmc_ta/<?= $data_table['id'] ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="student_id" value="<?= $data_table['student_id'] ?>">
    <input type="hidden" name="request_id" value="<?= $data_table['id'] ?>">
    <input type="hidden" name="cgmc_type" value="request_cgmc_tosa_app">
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
    <div class="form-group mb-5">
        <div class="label"><strong>Proof of Payment:</strong> <small>(e.g., Screenshot of e-receipt)</small></div>
        <label class="btn-attach" for="receipt_number" data-target="<?= base_url('assets/uploads/docs/').encodeFolder($data_table['student_id']).'/'.$data_table['receipt_number'] ?>"><?= $data_table['receipt_number']; ?></label>
        <div class="approved txt-green <?= $data_table['receipt_number_status'] == 'pending' || $data_table['receipt_number_status'] == 'reject' ? 'hide' : '' ?>" data-target="receipt_number_status"><i class="fas fa-check"></i></div>
        <div class="approved txt-red <?= $data_table['receipt_number_status'] == 'pending' || $data_table['receipt_number_status'] == 'approved' ? 'hide' : '' ?>" data-target="receipt_number_status"><i class="fas fa-times"></i></div>
    </div>
    <div class="form-group text-right mt-0">
        <div><input type="hidden" name="receipt_number_status" value="<?= $data_table['receipt_number_status'] ?>"></div>
        <div class="d-right">
          <button type="button" class="btn btn-green btn-small btn-approved" data-input="receipt_number_status">Approved</button>
          <button type="button" class="btn btn-small btn-reject" data-input="receipt_number_status">Reject</button>
        </div>
    </div>
 <!-- $tosa_app_cgmc_form_file & $tosa_app_cgmc_form_status is not yet on database. -->
		<div class="form-group mb-5">
          <div class="label"><strong>Certificate of Good Moral Character Form:</strong><small>Signed by the OSD and OJT Coordinator</small></div>
          <label class="btn-attach" for="tosa_app_cgmc_form_file" data-target="<?= base_url('assets/uploads/docs/').encodeFolder($data_table['student_id']).'/'.$data_table['cgmc_form_file'] ?>"><?= $data_table['cgmc_form_file']; ?></label>   
          <div class="approved txt-green <?= $data_table['cgmc_form_status'] == 'pending' || $data_table['cgmc_form_status'] == 'reject' ? 'hide' : '' ?>" data-target="tosa_app_cgmc_form_status"><i class="fas fa-check"></i></div>
          <div class="approved txt-red <?= $data_table['cgmc_form_status'] == 'pending' || $data_table['cgmc_form_status'] == 'approved' ? 'hide' : '' ?>" data-target="tosa_app_cgmc_form_status"><i class="fas fa-times"></i></div>
        </div>
    <div class="form-group text-right mt-0">
        <div><input type="hidden" name="tosa_app_cgmc_form_status" value="<?= $data_table['cgmc_form_status'] ?>"></div>
        <div class="d-right">
          <button type="button" class="btn btn-green btn-small btn-approved" data-input="tosa_app_cgmc_form_status">Approved</button>
          <button type="button" class="btn btn-small btn-reject" data-input="tosa_app_cgmc_form_status">Reject</button>
        </div>
    </div>
	
    <div class="form-group mb-5">
        <div class="label"><strong>TOSA Application Form of Scholarship:</strong></div>
        <label class="btn-attach" for="tosa_app_form_of_scholarship_file" data-target="<?= base_url('assets/uploads/docs/').encodeFolder($data_table['student_id']).'/'.$data_table['tosa_app_form_of_scholarship_file'] ?>"><?= $data_table['tosa_app_form_of_scholarship_file']; ?></label>   
        <div class="approved txt-green <?= $data_table['tosa_app_form_of_scholarship_status'] == 'pending' || $data_table['tosa_app_form_of_scholarship_status'] == 'reject' ? 'hide' : '' ?>" data-target="tosa_app_form_of_scholarship_status"><i class="fas fa-check"></i></div>
        <div class="approved txt-red <?= $data_table['tosa_app_form_of_scholarship_status'] == 'pending' || $data_table['tosa_app_form_of_scholarship_status'] == 'approved' ? 'hide' : '' ?>" data-target="tosa_app_form_of_scholarship_status"><i class="fas fa-times"></i></div>
    </div>
    <div class="form-group text-right mt-0">
        <div><input type="hidden" name="tosa_app_form_of_scholarship_status" value="<?= $data_table['tosa_app_form_of_scholarship_status'] ?>"></div>
        <div class="d-right">
          <button type="button" class="btn btn-green btn-small btn-approved" data-input="tosa_app_form_of_scholarship_status">Approved</button>
          <button type="button" class="btn btn-small btn-reject" data-input="tosa_app_form_of_scholarship_status">Reject</button>
        </div>
    </div>
    <div class="form-group mb-5">
        <div class="label"><strong>Registration Form:</strong></div>
        <label class="btn-attach" for="registration_file" data-target="<?= base_url('assets/uploads/docs/').encodeFolder($data_table['student_id']).'/'.$data_table['registration_file'] ?>"><?= $data_table['registration_file']; ?></label>   
        <div class="approved txt-green <?= $data_table['registration_status'] == 'pending' || $data_table['registration_status'] == 'reject' ? 'hide' : '' ?>" data-target="registration_status"><i class="fas fa-check"></i></div>
        <div class="approved txt-red <?= $data_table['registration_status'] == 'pending' || $data_table['registration_status'] == 'approved' ? 'hide' : '' ?>" data-target="registration_status"><i class="fas fa-times"></i></div>
    </div>
    <div class="form-group text-right mt-0">
        <div><input type="hidden" name="registration_status" value="<?= $data_table['registration_status'] ?>"></div>
        <div class="d-right">
          <button type="button" class="btn btn-green btn-small btn-approved" data-input="registration_status">Approved</button>
          <button type="button" class="btn btn-small btn-reject" data-input="registration_status">Reject</button>
        </div>
    </div>
    <div class="form-group mb-5">
        <div class="label"><strong>Proof of application of honors/awards:</strong></div>
        <label class="btn-attach" for="proof_of_app_of_ha_file" data-target="<?= base_url('assets/uploads/docs/').encodeFolder($data_table['student_id']).'/'.$data_table['proof_of_app_of_ha_file'] ?>"><?= $data_table['proof_of_app_of_ha_file']; ?></label>   
        <div class="approved txt-green <?= $data_table['proof_of_app_of_ha_status'] == 'pending' || $data_table['proof_of_app_of_ha_status'] == 'reject' ? 'hide' : '' ?>" data-target="proof_of_app_of_ha_status"><i class="fas fa-check"></i></div>
        <div class="approved txt-red <?= $data_table['proof_of_app_of_ha_status'] == 'pending' || $data_table['proof_of_app_of_ha_status'] == 'approved' ? 'hide' : '' ?>" data-target="proof_of_app_of_ha_status"><i class="fas fa-times"></i></div>
    </div>
    <div class="form-group text-right mt-0">
        <div><input type="hidden" name="proof_of_app_of_ha_status" value="<?= $data_table['proof_of_app_of_ha_status'] ?>"></div>
        <div class="d-right">
          <button type="button" class="btn btn-green btn-small btn-approved" data-input="proof_of_app_of_ha_status">Approved</button>
          <button type="button" class="btn btn-small btn-reject" data-input="proof_of_app_of_ha_status">Reject</button>
        </div>
    </div>
    <div class="form-group text-right">
      <button type="submit" class="btn btn-red">Done</button>
    </div>
</form>