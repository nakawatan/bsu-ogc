<form class="form-validate" id="update_cgmc_ja" action="./update_cgmc_ja/<?= $data_table['id'] ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="student_id" value="<?= $data_table['student_id'] ?>">
    <input type="hidden" name="request_id" value="<?= $data_table['id'] ?>">
    <input type="hidden" name="cgmc_type" value="request_cgmc_job_application">
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
        <div class="label"><strong>Proof of Payment:</strong> <small>e.g., Screenshot of e-receipt</small></div>
        <input type="number" name="receipt_number" id="receipt_number" value="<?= $data_table['receipt_number'] ?>">
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
    <!-- $ja_cgmc_form_file & $ja_cgmc_form_status is not yet on database.
		<div class="form-group mb-5">
          <div class="label"><strong>Certificate of Good Moral Character Form:</strong><small>Signed by the OSD and OJT Coordinator</small></div>
          <label class="btn-attach" for="ja_cgmc_form_file" data-target="<?= base_url('assets/uploads/docs/').encodeFolder($data_table['student_id']).'/'.$data_table['$ja_cgmc_form_file'] ?>"><?= $data_table['$ja_cgmc_form_file']; ?></label>   
          <div class="approved txt-green <?= $data_table['ja_cgmc_form_status'] == 'pending' || $data_table['ja_cgmc_form_status'] == 'reject' ? 'hide' : '' ?>" data-target="ja_cgmc_form_status"><i class="fas fa-check"></i></div>
          <div class="approved txt-red <?= $data_table['ja_cgmc_form_status'] == 'pending' || $data_table['ja_cgmc_form_status'] == 'approved' ? 'hide' : '' ?>" data-target="ja_cgmc_form_status"><i class="fas fa-times"></i></div>
        </div>
    <div class="form-group text-right mt-0">
        <div><input type="hidden" name="ja_cgmc_form_status" value="<?= $data_table['ja_cgmc_form_status'] ?>"></div>
        <div class="d-right">
          <button type="button" class="btn btn-green btn-small btn-approved" data-input="ja_cgmc_form_status">Approved</button>
          <button type="button" class="btn btn-small btn-reject" data-input="ja_cgmc_form_status">Reject</button>
        </div>
    </div>
	-->
    <div class="form-group mb-5">
        <div class="label"><strong>Diploma / Transcript of Record:</strong></div>
        <label class="btn-attach" for="tor_file" data-target="<?= base_url('assets/uploads/docs/').encodeFolder($data_table['student_id']).'/'.$data_table['tor_file'] ?>"><?= $data_table['tor_file']; ?></label>   
        <div class="approved txt-green <?= $data_table['tor_status'] == 'pending' || $data_table['tor_status'] == 'reject' ? 'hide' : '' ?>" data-target="tor_status"><i class="fas fa-check"></i></div>
        <div class="approved txt-red <?= $data_table['tor_status'] == 'pending' || $data_table['tor_status'] == 'approved' ? 'hide' : '' ?>" data-target="tor_status"><i class="fas fa-times"></i></div>
    </div>
    <div class="form-group text-right mt-0">
        <div><input type="hidden" name="tor_status" value="<?= $data_table['tor_status'] ?>"></div>
        <div class="d-right">
          <button type="button" class="btn btn-green btn-small btn-approved" data-input="tor_status">Approved</button>
          <button type="button" class="btn btn-small btn-reject" data-input="tor_status">Reject</button>
        </div>
    </div>
    <div class="form-group text-right">
      <button type="submit" class="btn btn-red">Done</button>
    </div>
</form>