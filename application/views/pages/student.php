<?php
defined('BASEPATH') or exit('No direct script access allowed');
// define('LINK', base_url());
// define('ASSETS', LINK . 'assets/');

$disable_hour = maybe_unserialize($option['disable_hour']);
$disable_day = maybe_unserialize($option['disable_day']);
$disable_month = maybe_unserialize($option['disable_month']);

$disable_hour = $disable_hour ? $disable_hour : ['empty_array'];
$disable_day = $disable_day ? $disable_day : ['empty_array'];
$disable_month = $disable_month ? $disable_month : ['empty_array'];

// print_r($student);
?>

<!-- <img src="" alt=""> -->
<div class="container">
	<ul class="user-details clearfix">
		<li class="user-avatar">
			<img src="<?= $image ?>" alt="">
		</li>
	    <li class="user-fullname"><?= $student->last_name; ?>, <?= $student->first_name; ?> <?= $student->middle_name; ?></li>
	   
		
	    <li><?= $student->department; ?></li>
	    <li><?= $student->course; ?></li>
	    
	</ul><br><br>
	<?php $this->view('templates/banner'); ?>
	<h2 class="text-center">Office of Guidance and Counseling</h2>
	<br><br>
	<ul class="tabs">
		<li><a href="#tab-services" class="active">Services</a></li>
		<li><a href="#tab-transaction">Transaction</a></li>
		<li><a href="#tab-forms">Forms</a></li>
	</ul>
	<br><br>
	<?php //print_r($request_cgmc_ojt); ?>
	<div class="tab-content">
		<div id="tab-services" class="active">
			<ul>
				<li class="has-sub-menu"><a href="#"><i class="fas fa-file-alt"></i>Certificate of Good Moral Character</a>
					<ul class="sub-menu">
						<li class="has-sub-menu">
							<a href="#">On-the-Job Training</a>
							<div class="sub-menu">
								<div class="text-helper first-step">
									<p><strong>Procedure</strong></p>
									<ol>
										<li>Undergo Initial interview/Career Advising and Mentoring for Assessment.</li>
										<li>Fill up the request form for Certificate of Good Moral Character.</li>
										<li>Secure the signature of the Office of Student Discipline (OSD) Head/Coordinator and OJT Coordinator.</li>
										<li>Secure a copy of registration form (Current Semester)</li>
										<li>Secure documentary stamp at the BIR.</li>
									</ol>

									<p class="text-right">
										<button type="button" class="btn btn-red">REQUEST</button>
									</p>
								</div>
								<div class="text-helper second-step">
								
									<form class="form-validate" id="<?= $request_cgmc_ojt ? 'update_request_cgmc_ojt' : 'request_cgmc_ojt' ?>" method="post" enctype="multipart/form-data">
										<?php if($request_cgmc_ojt): ?><input type="hidden" name="request_id" value="<?= base64_encode($request_cgmc_ojt->id) ?>"><?php endif; ?>
										<div class="form-group">
											<div class="label"><strong>Registration Form</strong> <small>Current Semester</small></div>
											<input type="file" name="registration-form" id="registration-form" <?= ($ojt_registration_form_file && $ojt_registration_form_status != 'reject') || $ja_cgmc_file != ""  ? 'disabled' : '' ?>/>
											<label class="btn-attach" for="registration-form" title="Attach file here"><?= $ojt_registration_form_file ? $ojt_registration_form_file : 'Attach file here' ?></label>	
											<?php if($ojt_registration_form_status == 'approved') :?><div class="approved txt-green"><i class="fas fa-check"></i></div><?php endif; ?>
											<?php if($ojt_registration_form_status == 'reject') :?><div class="approved txt-red"><i class="fas fa-times"></i></div><?php endif; ?>
										</div>
										<div class="form-group">
											<div class="label"><strong>Certificate of Good Moral Character Form:</strong> <small>Signed by the OSD and OJT Coordinator</small></div>
											<input type="file" name="cogmc-form" id="cogmc-form" <?= ($ojt_cgmc_form_file && $ojt_cgmc_form_status != 'reject') || $ja_cgmc_file != "" ? 'disabled' : '' ?>/>
											<label class="btn-attach" for="cogmc-form" title="Attach file here"><?= $ojt_cgmc_form_file ? $ojt_cgmc_form_file : 'Attach file here' ?></label>	
											<?php if($ojt_cgmc_form_status == 'approved') :?><div class="approved txt-green"><i class="fas fa-check"></i></div><?php endif; ?>
											<?php if($ojt_cgmc_form_status == 'reject') :?><div class="approved txt-red"><i class="fas fa-times"></i></div><?php endif; ?>
										</div>
										<div class="form-group">
											<div class="label"><strong>Proof of Initial Interview / Career Advising</strong> <small>Mentoring for Assesement</small></div>
											<input type="file" name="interview-form" id="interview-form" <?= ($ojt_career_advising_file && $ojt_career_advising_status != 'reject') || $ja_cgmc_file != "" ? 'disabled' : '' ?>/>
											<label class="btn-attach" for="interview-form" title="Attach file here"><?= $ojt_career_advising_file ? $ojt_career_advising_file : 'Attach file here' ?></label>	
											<?php if($ojt_career_advising_status == 'approved') :?><div class="approved txt-green"><i class="fas fa-check"></i></div><?php endif; ?>
											<?php if($ojt_career_advising_status == 'reject') :?><div class="approved txt-red"><i class="fas fa-times"></i></div><?php endif; ?>
										</div>

										<!-- CHECKMARK -->
										<div class="form-group">
											<input type="checkbox" class="consent-agreement"/>
											<p>By uploading the files, I hereby give my consent and authorization to use the files I have provided. Further, I allow the concerned office to view and evaluate my personal information.</p>
										</div>
									   
										<div class="form-group text-right">
										<?php 
											if( !$request_cgmc_ojt 
												|| ($ojt_registration_form_status == 'reject') 
												|| ($ojt_cgmc_form_status == 'reject') 
												|| ($ojt_career_advising_status == 'reject')
											) :
										?>
											<button type="submit" class="btn btn-red" disabled="">Submit</button>
										<?php
											endif;
											if( ($ojt_registration_form_status == 'pending') 
												|| ($ojt_cgmc_form_status == 'pending') 
												|| ($ojt_career_advising_status == 'pending')
											) :
										?>
											<button type="button" class="btn btn-red" disabled="">Pending</button>
										<?php 
											endif;
											if( ($ojt_registration_form_status == 'approved') 
												&& ($ojt_cgmc_form_status == 'approved') 
												&& ($ojt_career_advising_status == 'approved')
											) :
										?>
											<button type="button" class="btn-print btn btn-red" onclick="printJS('<?= LINK.$folder.$ojt_cgmc_file; ?>')">Print</button>
										<?php
											endif;
										?>
										</div>
									</form>
								</div>	
							</div>	
						</li>
						<li class="has-sub-menu">
							<a href="#">Employment, Licensure Examination and Further Studies</a>
							<div class="sub-menu">
								<div class="text-helper first-step">
									<p><strong>Procedure</strong></p>
									<ol>
										<li>Fill up the request form for Certificate of Good Moral Character.</li>
										<li>Secure the signature of the Office of Student Discipline (OSD) Head/Coordinator.</li>
										<li>Pay a fee of thirty pesos (Php 30.00) at the <a href = "https://epaymentportal.landbank.com/pay1.php?code=SGlpYUNNT0g4ZXVvRCUyQmJ0M09NMG02b0JTNHN0VFhCSnhLVFhSSzBoN29JPQ%3D%3D" style="color:blue">Cashier's Office.</a> Be sure to secure a proof of payment. </li>
										<li>Secure a copy of diploma or Transcript of Records(TOR)</li>
										<li>Secure documentary stamp at the BIR.</li>
									</ol>
									<p class="text-right">
										<button type="button" class="btn btn-red">REQUEST</button>
									</p>
								</div>
								<div class="text-helper second-step">
									<form class="form-validate" id="<?= $request_cgmc_job_application ? 'update_request_cgmc_job_application' : 'request_cgmc_job_application' ?>" method="post" enctype="multipart/form-data">
										<?php if($request_cgmc_job_application): ?><input type="hidden" name="request_id" value="<?= base64_encode($request_cgmc_job_application->id) ?>"><?php endif; ?>
										<div class="form-group">
											<div class="label" style=text-align:left><strong>Proof of Payment:</strong> <small>(e.g., Screenshot of e-receipt)</small></div>
											<input type="file" name="pop-job-application" id="pop-job-application" <?= ($ja_receipt_number && $ja_receipt_number_status != 'reject') || $ja_cgmc_file != "" ? 'disabled' : '' ?>/>
											<label class="btn-attach" for="pop-job-application" title="Attach file here"><?= $ja_receipt_number ? $ja_receipt_number : 'Attach file here' ?></label>	
											<?php if($ja_receipt_number_status == 'approved') :?><div class="approved txt-green"><i class="fas fa-check"></i></div><?php endif; ?>
											<?php if($ja_receipt_number_status == 'reject') :?><div class="approved txt-red"><i class="fas fa-times"></i></div><?php endif; ?>
										</div>
									<!-- $ja_cgmc_form_file & $ja_cgmc_form_status is not yet on database. -->
										<div class="form-group">
											<div class="label"><strong>Certificate of Good Moral Character Form:</strong> <small>Signed by the OSD and OJT Coordinator</small></div>
											<input type="file" name="cogmc-form-ja" id="cogmc-form-ja" <?= ($ja_cgmc_form_file && $ja_cgmc_form_status != 'reject') || $ja_cgmc_file != "" ? 'disabled' : '' ?>/>
											<label class="btn-attach" for="cogmc-form-ja" title="Attach file here"><?= $ja_cgmc_form_file ? $ja_cgmc_form_file : 'Attach file here' ?></label>	
											<?php if($ja_cgmc_form_status == 'approved') :?><div class="approved txt-green"><i class="fas fa-check"></i></div><?php endif; ?>
											<?php if($ja_cgmc_form_status == 'reject') :?><div class="approved txt-red"><i class="fas fa-times"></i></div><?php endif; ?>
										</div>
									
										<div class="form-group">
											<div class="label"><strong>Diploma / Transcript of Record:</strong></div>
											<input type="file" name="tor" id="tor" <?= ($ja_tor_file && $ja_tor_status != 'reject') || $ja_cgmc_file != "" ? 'disabled' : '' ?>/>
											<label class="btn-attach" for="tor" title="Attach file here"><?= $ja_tor_file ? $ja_tor_file : 'Attach file here' ?></label>	
											<?php if($ja_tor_status == 'approved') :?><div class="approved txt-green"><i class="fas fa-check"></i></div><?php endif; ?>
											<?php if($ja_tor_status == 'reject') :?><div class="approved txt-red"><i class="fas fa-times"></i></div><?php endif; ?>
										</div>

										<!-- CHECKMARK -->
										<div class="form-group">
											<input type="checkbox" class="consent-agreement"/>
											<p>By uploading the files, I hereby give my consent and authorization to use the files I have provided. Further, I allow the concerned office to view and evaluate my personal information.</p>
										</div>
										<div class="form-group text-right">
										<?php 
											if( !$request_cgmc_job_application 
												|| ($ja_receipt_number_status == 'reject') 
												|| ($ja_tor_status == 'reject')
											) :
										?>
											<button type="submit" class="btn btn-red" disabled="">Submit</button>
										<?php
											endif;
											if( ($ja_receipt_number_status == 'pending') 
												|| ($ja_tor_status == 'pending')
											) :
										?>
											<button type="button" class="btn btn-red" disabled="">Pending</button>
										<?php 
											endif;
											if( ($ja_receipt_number_status == 'approved') 
												&& ($ja_tor_status == 'approved')
											) :
										?>
											<button type="button" class="btn-print btn btn-red" onclick="printJS('<?= LINK.$folder.$ja_cgmc_file; ?>')">Print</button>
										<?php 
											endif;
										?>
										</div>
									</form>
								</div>	
							</div>	
						</li>
					<li class="has-sub-menu">
					<a href="#">Scholarship</a>
						<div class="sub-menu">
						<div class="text-helper first-step">
						<p><strong>Procedure</strong></p>
							<ol>
								<li>Fill up the request form for Certificate of Good Moral Character.</li>
								<li>Secure the signature of the Office of Student Descipline (OSD) Head/Coordinator.</li>
								<li>Application Form of Scholarship.</li>
								<li>Registration Form (Current Semester).</li>
								<li>Copy of Grades (Previuos Semester).</li>
								<li>Pay a fee of thirty pesos (Php 30.00) at the <a href = "https://epaymentportal.landbank.com/pay1.php?code=SGlpYUNNT0g4ZXVvRCUyQmJ0M09NMG02b0JTNHN0VFhCSnhLVFhSSzBoN29JPQ%3D%3D" style="color:blue">Cashier's Office.</a> Be sure to secure a proof of payment. </li>
								<li>Secure documentary stamp at the BIR.</li>
							</ol>
						<p class="text-right">
							<button type="button" class="btn btn-red">REQUEST</button>
						</p>
						</div>
						<div class="text-helper second-step">
							<form class="form-validate" id="<?= $request_cgmc_scholarship ? 'update_request_cgmc_scholarship' : 'request_cgmc_scholarship' ?>" method="post" enctype="multipart/form-data">
							<?php if($request_cgmc_scholarship): ?><input type="hidden" name="request_id" value="<?= base64_encode($request_cgmc_scholarship->id) ?>"><?php endif; ?>
						<div class="form-group">
							<div class="label" style=text-align:left><strong>Proof of Payment:</strong> <small>e.g., Screenshot of e-receipt</small></div>
							<input type="file" name="pop-scholarship" id="pop-scholarship" <?= ($ss_receipt_number && $ss_receipt_number_status != 'reject') || $ja_cgmc_file != "" ? 'disabled' : '' ?>/>
							<label class="btn-attach" for="pop-scholarship" title="Attach file here"><?= $ss_receipt_number ? $ss_receipt_number : 'Attach file here' ?></label>	
							<?php if($ss_receipt_number_status == 'approved') :?><div class="approved txt-green"><i class="fas fa-check"></i></div><?php endif; ?>
							<?php if($ss_receipt_number_status == 'reject') :?><div class="approved txt-red"><i class="fas fa-times"></i></div><?php endif; ?>
						</div>

						<!-- Not yet on the Database -->
						<div class="form-group">
						<div class="label"><strong>Request Form for Certificate of Good Moral Character:</strong> <small>Signed by the OSD Head/Coordinator</small></div>
						<input type="file" name="cogmc-form-ss" id="cogmc-form-ss" <?= ($ss_cgmc_form_file && $ss_cgmc_form_status != 'reject') || $ja_cgmc_file != "" ? 'disabled' : '' ?>/>
						<label class="btn-attach" for="cogmc-form-ss" title="Attach file here"><?= $ss_cgmc_form_file ? $ss_cgmc_form_file : 'Attach file here' ?></label>	
						<?php if($ss_cgmc_form_status == 'approved') :?><div class="approved txt-green"><i class="fas fa-check"></i></div><?php endif; ?>
						<?php if($ss_cgmc_form_status == 'reject') :?><div class="approved txt-red"><i class="fas fa-times"></i></div><?php endif; ?>
						</div>
						
						<div class="form-group">
							<div class="label"><strong>Application Form of Scholarship:</strong></div>
								<input type="file" name="ss_application_form_file" id="ss_application_form_file" <?= ($ss_application_form_file && $ss_application_form_status != 'reject')|| $ja_cgmc_file != "" ? 'disabled' : '' ?>/>
								<label class="btn-attach" for="ss_application_form_file" title="Attach file here"><?= $ss_application_form_file ? $ss_application_form_file : 'Attach file here' ?></label>	
								<?php if($ss_application_form_status == 'approved') :?><div class="approved txt-green"><i class="fas fa-check"></i></div><?php endif; ?>
								<?php if($ss_application_form_status == 'reject') :?><div class="approved txt-red"><i class="fas fa-times"></i></div><?php endif; ?>
						</div>

						<div class="form-group">
							<div class="label"><strong>Registration Form:</strong> <small>Current Semester</small></div>
							<input type="file" name="ss_registration_form_file" id="ss_registration_form_file" <?= ($ss_registration_form_file && $ss_registration_form_status != 'reject')|| $ja_cgmc_file != "" ? 'disabled' : '' ?>/>
							<label class="btn-attach" for="ss_registration_form_file" title="Attach file here"><?= $ss_registration_form_file ? $ss_registration_form_file : 'Attach file here' ?></label>	
							<?php if($ss_registration_form_status == 'approved') :?><div class="approved txt-green"><i class="fas fa-check"></i></div><?php endif; ?>
							<?php if($ss_registration_form_status == 'reject') :?><div class="approved txt-red"><i class="fas fa-times"></i></div><?php endif; ?>
						</div>

						<div class="form-group">
							<div class="label"><strong>Grade from Previous Semester:</strong></div>
							<input type="file" name="ss_grade_from_prev_file" id="ss_grade_from_prev_file" <?= ($ss_grade_from_prev_file && $ss_grade_from_prev_status != 'reject')|| $ja_cgmc_file != "" ? 'disabled' : '' ?>/>
							<label class="btn-attach" for="ss_grade_from_prev_file" title="Attach file here"><?= $ss_grade_from_prev_file ? $ss_grade_from_prev_file : 'Attach file here' ?></label>	
							<?php if($ss_grade_from_prev_status == 'approved') :?><div class="approved txt-green"><i class="fas fa-check"></i></div><?php endif; ?>
							<?php if($ss_grade_from_prev_status == 'reject') :?><div class="approved txt-red"><i class="fas fa-times"></i></div><?php endif; ?>
						</div>
			

						<!-- CHECKMARK -->
						<div class="form-group">
							<input type="checkbox" class="consent-agreement"/>
							<p>By uploading the files, I hereby give my consent and authorization to use the files I have provided. Further, I allow the concerned office to view and evaluate my personal information.</p>
						</div>
						<div class="form-group text-right">
							<?php 
									if( !$request_cgmc_scholarship 
										|| ($ss_receipt_number_status == 'reject') 
										|| ($ss_application_form_status == 'reject') 
										|| ($ss_registration_form_status == 'reject') 
										|| ($ss_grade_from_prev_status == 'reject')
									) :
							?>
									<button type="submit" class="btn btn-red" disabled="">Submit</button>
							<?php
									endif;
									if( ($ss_receipt_number_status == 'pending') 
										|| ($ss_application_form_status == 'pending') 
										|| ($ss_registration_form_status == 'pending') 
										|| ($ss_grade_from_prev_status == 'pending')
									) :
							?>
									<button type="button" class="btn btn-red" disabled="">Pending</button>
							<?php 
									endif;
									if( ($ss_receipt_number_status == 'approved') 
										&& ($ss_application_form_status == 'approved') 
										&& ($ss_registration_form_status == 'approved') 
										&& ($ss_grade_from_prev_status == 'approved')
									) :
							?>
										<button type="button" class="btn-print btn btn-red" onclick="printJS('<?= LINK.$folder.$scholarship_cgmc_file; ?>')">Print</button>
									<?php 
											endif;
									?>
										</div>
									</form>
								</div>	
							</div>	
						</li>
						<li class="has-sub-menu">
							<a href="#">Transferring Students</a>
							<div class="sub-menu">
								<div class="text-helper first-step">
									<p><strong>Procedure</strong></p>
									<ol>
										<li>Undergo exit interview</li>
										<li>Secure the accomplished Exit Interview Form</li>
										<li>Fill up the request form for Certificate of Good Moral Character.</li>
										<li>Secure the signature of the Office of Student Discipline (OSD) Head/Coordinator.</li>
										<li>Pay a fee of thirty pesos (Php 30.00) at the <a href = "https://epaymentportal.landbank.com/pay1.php?code=SGlpYUNNT0g4ZXVvRCUyQmJ0M09NMG02b0JTNHN0VFhCSnhLVFhSSzBoN29JPQ%3D%3D" style="color:blue">Cashier's Office.</a> Be sure to secure a proof of payment. </li>
										<li>Secure documentary stamp at the BIR.</li>
									</ol>
									<p class="text-right">
										<button type="button" class="btn btn-red">REQUEST</button>
									</p>
								</div>
								<div class="text-helper second-step">
									<form class="form-validate" id="<?= $request_cgmc_transferee ? 'update_request_cgmc_transferee' : 'request_cgmc_transferee' ?>" method="post" enctype="multipart/form-data">
										<?php if($request_cgmc_transferee): ?><input type="hidden" name="request_id" value="<?= base64_encode($request_cgmc_transferee->id) ?>"><?php endif; ?>
										<div class="form-group">
											<div class="label" style=text-align:left><strong>Proof of Payment:</strong> <small>(e.g., Screenshot of e-receipt)</small></div>
											<input type="file" name="pop-transfer" id="pop-transfer" <?= ($transferee_receipt_number && $transferee_receipt_number_status != 'reject') || $ja_cgmc_file != "" ? 'disabled' : '' ?>/>
											<label class="btn-attach" for="pop-transfer" title="Attach file here"><?= $transferee_receipt_number ? $transferee_receipt_number : 'Attach file here' ?></label>	
											<?php if($transferee_receipt_number_status == 'approved') :?><div class="approved txt-green"><i class="fas fa-check"></i></div><?php endif; ?>
											<?php if($transferee_receipt_number_status == 'rejct') :?><div class="approved txt-red"><i class="fas fa-times"></i></div><?php endif; ?>
										</div>
									<!-- $transferee_cgmc_form_file & $transferee_cgmc_form_status is not yet on database. -->
										<div class="form-group">
											<div class="label"><strong>Certificate of Good Moral Character Form:</strong> <small>Signed by the OSD and OJT Coordinator</small></div>
											<input type="file" name="cogmc-form-ts" id="cogmc-form-ts" <?= ($transferee_cgmc_form_file && $transferee_cgmc_form_status != 'reject') || $ja_cgmc_file != "" ? 'disabled' : '' ?>/>
											<label class="btn-attach" for="cogmc-form-ts" title="Attach file here"><?= $transferee_cgmc_form_file ? $transferee_cgmc_form_file : 'Attach file here' ?></label>	
											<?php if($transferee_cgmc_form_status == 'approved') :?><div class="approved txt-green"><i class="fas fa-check"></i></div><?php endif; ?>
											<?php if($transferee_cgmc_form_status == 'reject') :?><div class="approved txt-red"><i class="fas fa-times"></i></div><?php endif; ?>
										</div>
									
										<div class="form-group">
											<div class="label" style=text-align:left><strong>Exit Interview Form:</strong><small>Signed by Parent/Guardian, Adviser/Program Chair, and College Dean</small></div>
											<input type="file" name="transferee_exit_interview_form_file" id="transferee_exit_interview_form_file" <?= ($transferee_exit_interview_form_file && $transferee_exit_interview_form_status != 'reject') || $ja_cgmc_file != "" ? 'disabled' : '' ?>/>
											<label class="btn-attach" for="transferee_exit_interview_form_file" title="Attach file here"><?= $transferee_exit_interview_form_file ? $transferee_exit_interview_form_file : 'Attach file here' ?></label>	
											<?php if($transferee_exit_interview_form_status == 'approved') :?><div class="approved txt-green"><i class="fas fa-check"></i></div><?php endif; ?>
											<?php if($transferee_exit_interview_form_status == 'reject') :?><div class="approved txt-red"><i class="fas fa-times"></i></div><?php endif; ?>
										</div>

										<!-- CHECKMARK -->
										<div class="form-group">
											<input type="checkbox" class="consent-agreement"/>
											<p>By uploading the files, I hereby give my consent and authorization to use the files I have provided. Further, I allow the concerned office to view and evaluate my personal information.</p>
										</div>
										<div class="form-group text-right">
										<?php
											if( !$request_cgmc_transferee 
												|| ($transferee_receipt_number_status == 'reject') 
												|| ($transferee_exit_interview_form_status == 'reject')
											) :
										?>
											<button type="submit" class="btn btn-red" disabled="">Submit</button>
										<?php
											endif;
											if( ($transferee_receipt_number_status == 'pending') 
												|| ($transferee_exit_interview_form_status == 'pending')
											) :
										?>
											<button type="button" class="btn btn-red" disabled="">Pending</button>
										<?php 
											endif;
											if( ($transferee_receipt_number_status == 'approved') 
												&& ($transferee_exit_interview_form_status == 'approved')
											) :
										?>
											<button type="button" class="btn-print btn btn-red" onclick="printJS('<?= LINK.$folder.$transferee_cgmc_file; ?>')">Print</button>
										<?php 
											endif;
										?>
										</div>
									</form>
								</div>	
							</div>	
						</li>
						<li class="has-sub-menu">
							<a href="#">Ten Outstanding Students Awards (TOSA) Application</a>
							<div class="sub-menu">
								<div class="text-helper first-step">
									<p><strong>Procedure</strong></p>
									<ol>
										<li>Fill up the request form for Certificate of Good Moral Character.</li>
										<li>Secure the signature of the Office of Student Discipline (OSD) Head/Coordinator.</li>
										<li>Secure a copy of TOSA application form of scholarship (for scholars only)</li>
										<li>Secure a copy of registration form (current semester)</li>
										<li>Secure a copy of any proof of application of honors/awards to any organization</li>
										<li>Pay a fee of thirty pesos (Php 30.00) at the <a href = "https://epaymentportal.landbank.com/pay1.php?code=SGlpYUNNT0g4ZXVvRCUyQmJ0M09NMG02b0JTNHN0VFhCSnhLVFhSSzBoN29JPQ%3D%3D" style="color:blue">Cashier's Office.</a> Be sure to secure a proof of payment. </li>
										<li>Secure documentary stamp at the BIR.</li>
									</ol>
									<p class="text-right">
										<button type="button" class="btn btn-red">REQUEST</button>
									</p>
								</div>
								<div class="text-helper second-step">
									<form class="form-validate" id="<?= $request_cgmc_tosa_app ? 'update_request_cgmc_tosa_app' : 'request_cgmc_tosa_app' ?>" method="post" enctype="multipart/form-data">
										<?php if($request_cgmc_tosa_app): ?><input type="hidden" name="request_id" value="<?= base64_encode($request_cgmc_tosa_app->id) ?>"><?php endif; ?>
										<div class="form-group">
											<div class="label" style=text-align:left><strong>Proof of payment:</strong> <small>(e.g., Screenshot of e-receipt)</small></div>
											<input type="file" name="pop-tosa" id="pop-tosa" <?= ($tosa_app_receipt_number && $tosa_app_receipt_number_status != 'reject') || $ja_cgmc_file != "" ? 'disabled' : '' ?>/>
											<label class="btn-attach" for="pop-tosa" title="Attach file here"><?= $tosa_app_receipt_number ? $tosa_app_receipt_number : 'Attach file here' ?></label>	
											<?php if($tosa_app_receipt_number_status == 'approved') :?><div class="approved txt-green"><i class="fas fa-check"></i></div><?php endif; ?>
											<?php if($tosa_app_receipt_number_status == 'reject') :?><div class="approved txt-red"><i class="fas fa-times"></i></div><?php endif; ?>
										</div>
										
									<!-- $tosa_app_cgmc_form_file & $tosa_app_cgmc_form_status is not yet on database. -->
										<div class="form-group">
											<div class="label"><strong>Certificate of Good Moral Character Form:</strong> <small>Signed by the OSD and OJT Coordinator</small></div>
											<input type="file" name="cogmc-form-tosa" id="cogmc-form-tosa" <?= ($tosa_app_cgmc_form_file && $tosa_app_cgmc_form_status != 'reject') || $ja_cgmc_file != "" ? 'disabled' : '' ?>/>
											<label class="btn-attach" for="cogmc-form-tosa" title="Attach file here"><?= $tosa_app_cgmc_form_file ? $tosa_app_cgmc_form_file : 'Attach file here' ?></label>	
											<?php if($tosa_app_cgmc_form_status == 'approved') :?><div class="approved txt-green"><i class="fas fa-check"></i></div><?php endif; ?>
											<?php if($tosa_app_cgmc_form_status == 'reject') :?><div class="approved txt-red"><i class="fas fa-times"></i></div><?php endif; ?>
										</div>
									
										<div class="form-group">
											<div class="label"><strong>TOSA Application Form of Scholarship</strong></div>
											<input type="file" name="tosa_app_form_of_scholarship_file" id="tosa_app_form_of_scholarship_file" <?= ($tosa_app_form_of_scholarship_file && $tosa_app_form_of_scholarship_status != 'reject') || $ja_cgmc_file != "" ? 'disabled' : '' ?>/>
											<label class="btn-attach" for="tosa_app_form_of_scholarship_file" title="Attach file here"><?= $tosa_app_form_of_scholarship_file ? $tosa_app_form_of_scholarship_file : 'Attach file here' ?></label>	
											<?php if($tosa_app_form_of_scholarship_status == 'approved') :?><div class="approved txt-green"><i class="fas fa-check"></i></div><?php endif; ?>
											<?php if($tosa_app_form_of_scholarship_status == 'reject') :?><div class="approved txt-red"><i class="fas fa-times"></i></div><?php endif; ?>
										</div>
										<div class="form-group">
											<div class="label"><strong>Registration Form</strong> <small>Current Semester</small></div>
											<input type="file" name="tosa_app_registration_file" id="tosa_app_registration_file" <?= ($tosa_app_registration_file && $tosa_app_registration_status != 'reject') || $ja_cgmc_file != "" ? 'disabled' : '' ?>/>
											<label class="btn-attach" for="tosa_app_registration_file" title="Attach file here"><?= $tosa_app_registration_file ? $tosa_app_registration_file : 'Attach file here' ?></label>	
											<?php if($tosa_app_registration_status == 'approved') :?><div class="approved txt-green"><i class="fas fa-check"></i></div><?php endif; ?>
											<?php if($tosa_app_registration_status == 'reject') :?><div class="approved txt-red"><i class="fas fa-times"></i></div><?php endif; ?>
										</div>
										<div class="form-group">
											<div class="label"><strong>Proof of Application of Honors/Awards</strong> </div>
											<input type="file" name="tosa_app_proof_of_app_of_ha_file" id="tosa_app_proof_of_app_of_ha_file" <?= ($tosa_app_proof_of_app_of_ha_file && $tosa_app_proof_of_app_of_ha_status != 'reject') || $ja_cgmc_file != "" ? 'disabled' : '' ?>/>
											<label class="btn-attach" for="tosa_app_proof_of_app_of_ha_file" title="Attach file here"><?= $tosa_app_registration_file ? $tosa_app_proof_of_app_of_ha_file : 'Attach file here' ?></label>	
											<?php if($tosa_app_proof_of_app_of_ha_status == 'approved') :?><div class="approved txt-green"><i class="fas fa-check"></i></div><?php endif; ?>
											<?php if($tosa_app_proof_of_app_of_ha_status == 'reject') :?><div class="approved txt-red"><i class="fas fa-times"></i></div><?php endif; ?>
										</div>

										<!-- CHECKMARK -->
										<div class="form-group">
											<input type="checkbox" class="consent-agreement"/>
											<p>By uploading the files, I hereby give my consent and authorization to use the files I have provided. Further, I allow the concerned office to view and evaluate my personal information.</p>
										</div>
										<div class="form-group text-right">
										<?php 
											if( !$request_cgmc_tosa_app
												|| ($tosa_app_receipt_number_status == 'reject') 
												|| ($tosa_app_form_of_scholarship_status == 'reject') 
												|| ($tosa_app_registration_status == 'reject') 
												|| ($tosa_app_proof_of_app_of_ha_status == 'reject')
											) :
										?>
											<button type="submit" class="btn btn-red" disabled="">Submit</button>
										<?php
											endif;
											if( ($tosa_app_receipt_number_status == 'pending') 
												|| ($tosa_app_form_of_scholarship_status == 'pending') 
												|| ($tosa_app_registration_status == 'pending') 
												|| ($tosa_app_proof_of_app_of_ha_status == 'pending')
											) :
										?>
											<button type="button" class="btn btn-red" disabled="">Pending</button>
										<?php 
											endif;
											if( ($tosa_app_receipt_number_status== 'approved') 
												&& ($tosa_app_form_of_scholarship_status == 'approved') 
												&& ($tosa_app_registration_status == 'approved') 
												&& ($tosa_app_proof_of_app_of_ha_status == 'approved')
											) :
										?>
											<button type="button" class="btn-print btn btn-red" onclick="printJS('<?= LINK.$folder.$tosa_app_cgmc_file; ?>')">Print</button>
										<?php 
											endif;
										?>
										</div>
									</form>
								</div>	
							</div>	
						</li>
						<li class="has-sub-menu">
							<a href="#">Students who will represent the University in Regional/ National/ International Competitions</a>
							<div class="sub-menu">
								<div class="text-helper first-step">
									<p><strong>Procedure</strong></p>
									<ol>
										<li>Fill up the request form for Certificate of Good Moral Character.</li>
										<li>Secure the signature of the Office of Student Discipline (OSD) Head/Coordinator.</li>
										<li>Secure a copy of registration form (current semester)</li>
										<li>Secure documentary stamp at the BIR.</li>
									</ol>
									<p class="text-right">
										<button type="button" class="btn btn-red">REQUEST</button>
									</p>
								</div>
								<div class="text-helper second-step">
									<form class="form-validate" id="<?= $request_cgmc_rnu_rep ? 'update_request_cgmc_rnu_rep' : 'request_cgmc_rnu_rep' ?>" method="post" enctype="multipart/form-data">
										<?php if($request_cgmc_rnu_rep): ?><input type="hidden" name="request_id" value="<?= base64_encode($request_cgmc_rnu_rep->id) ?>"><?php endif; ?>
									<!-- $rnu_rep_cgmc_form_file & $rnu_rep_cgmc_form_status is not yet on database. -->
										<div class="form-group">
											<div class="label"><strong>Certificate of Good Moral Character Form:</strong> <small>Signed by the OSD and OJT Coordinator</small></div>
											<input type="file" name="cogmc-form-rnu" id="cogmc-form-rnu" <?= ($rnu_rep_cgmc_form_file && $rnu_rep_cgmc_form_status != 'reject') || $ja_cgmc_file != "" ? 'disabled' : '' ?>/>
											<label class="btn-attach" for="cogmc-form-rnu" title="Attach file here"><?= $rnu_rep_cgmc_form_file ? $rnu_rep_cgmc_form_file : 'Attach file here' ?></label>	
											<?php if($rnu_rep_cgmc_form_status == 'approved') :?><div class="approved txt-green"><i class="fas fa-check"></i></div><?php endif; ?>
											<?php if($rnu_rep_cgmc_form_status == 'reject') :?><div class="approved txt-red"><i class="fas fa-times"></i></div><?php endif; ?>
										</div>
									
										<div class="form-group">
											<div class="label"><strong>Registration Form:</strong> <small>Current Semester</small></div>
											<input type="file" name="rnu_rep_registration_form_file" id="rnu_rep_registration_form_file" <?= ($rnu_rep_registration_form_file && $rnu_rep_registration_form_status != 'reject') || $ja_cgmc_file != "" ? 'disabled' : '' ?>/>
											<label class="btn-attach" for="rnu_rep_registration_form_file" title="Attach file here"><?= $rnu_rep_registration_form_file ? $rnu_rep_registration_form_file : 'Attach file here' ?></label>	
											<?php if($rnu_rep_registration_form_status == 'approved') :?><div class="approved txt-green"><i class="fas fa-check"></i></div><?php endif; ?>
											<?php if($rnu_rep_registration_form_status == 'reject') :?><div class="approved txt-red"><i class="fas fa-times"></i></div><?php endif; ?>
										</div>

										<!-- CHECKMARK -->
										<div class="form-group">
											<input type="checkbox" class="consent-agreement"/>
											<p>By uploading the files, I hereby give my consent and authorization to use the files I have provided. Further, I allow the concerned office to view and evaluate my personal information.</p>
										</div>
										<div class="form-group text-right">
										<?php 
											if( !$request_cgmc_rnu_rep || $rnu_rep_registration_form_status == 'reject') :
										?>
											<button type="submit" class="btn btn-red" disabled="">Submit</button>
										<?php
											endif;
											if($rnu_rep_registration_form_status == 'pending') :
										?>
											<button type="button" class="btn btn-red" disabled="">Pending</button>
										<?php 
											endif;
											if($rnu_rep_registration_form_status == 'approved') :
										?>
											<button type="button" class="btn-print btn btn-red" onclick="printJS('<?= LINK.$folder.$rnu_rep_cgmc_file; ?>')">Print</button>
										<?php 
											endif;
										?>
										</div>
									</form>
								</div>	
							</div>	
						</li>
					</ul>
				</li>
				<li>
					<a href="https://dione.batstate-u.edu.ph/ecounseling/#/"><i class="fas fa-hand-holding-heart"></i> e-Counseling</a>
				</li>
				<li class="has-sub-menu">
					<a href="#"><i class="fas fa-users"></i> Group Counseling</a>
					<div class="sub-menu text-center">
					<?php if($appointment_group_counseling && $appointment_group_counseling->status != "reject") : ?>
						<h3>Appointment:</h3>
						<p><?= date('F, d Y. l \a\t g:i a', strtotime($appointment_group_counseling->appointment_date)); ?></p>
					<?php else: ?>
						<button type="button" class="btn btn-red btn-appointment" data-appointment="group_counseling">Set Appointment</button>
					<?php endif; ?>
					</div>
				</li>
				<li class="has-sub-menu">
					<a href="#"><i class="fas fa-user-friends"></i> Exit Interview</a>
					<div class="sub-menu text-center">
					<?php if($appointment_exit_interview && $appointment_exit_interview->status != "reject") : ?>
						<h3>Appointment:</h3>
						<p><?= date('F, d Y. l \a\t g:i a', strtotime($appointment_exit_interview->appointment_date)); ?></p>
					<?php else: ?>
						<button type="button" class="btn btn-red btn-appointment" data-appointment="exit_interview">Set Appointment</button>
					<?php endif; ?>
					</div>
				</li>
				<li class="has-sub-menu">
					<a href="#"><i class="fas fa-briefcase"></i> On-the-Job Training Interview</a>
					<ul class="sub-menu">
						<li class="has-sub-menu">
							<a href="#">Initial Interview</a>
							<div class="sub-menu text-center">

	<!-- Bale kelangan po muna ma-aaprove itong requirement bago sya makapag set ng appointment. 
					Parang katulad po sya ng Certificate of Good moral, Yung button po nito magiging "Set Appointment" once approve na

					<div class="form-group">
											<div class="label"><strong>Registration Form</strong> <small>Current Semester</small> </div>
											<input type="file" name="tosa_app_proof_of_app_of_ha_file" id="tosa_app_proof_of_app_of_ha_file" <?= $tosa_app_proof_of_app_of_ha_file && $tosa_app_proof_of_app_of_ha_status != 'reject' ? 'disabled' : '' ?>/>
											<label class="btn-attach" for="tosa_app_proof_of_app_of_ha_file" title="Attach file here"><?= $tosa_app_registration_file ? $tosa_app_proof_of_app_of_ha_file : 'Attach file here' ?></label>	
											<?php if($tosa_app_proof_of_app_of_ha_status == 'approved') :?><div class="approved txt-green"><i class="fas fa-check"></i></div><?php endif; ?>
											<?php if($tosa_app_proof_of_app_of_ha_status == 'reject') :?><div class="approved txt-red"><i class="fas fa-times"></i></div><?php endif; ?>
										</div> 
	-->



							<?php if($appointment_initial_interview && $appointment_initial_interview->status != "reject") : ?>
								<h3>Appointment:</h3>
								<p><?= date('F, d Y. l \a\t g:i a', strtotime($appointment_initial_interview->appointment_date)); ?></p>
							<?php else: ?>
							<button type="button" class="btn btn-red btn-appointment" data-appointment="initial_interview">Set Appointment</button>
							<?php endif; ?>
							</div>
						</li>
						<li class="has-sub-menu">
							<a href="#">Post Interview</a>
							<div class="sub-menu text-center">


	<!-- Bale kelangan po muna ma-aaprove itong requirement bago sya makapag set ng appointment. 
					Parang katulad po sya ng Certificate of Good moral, Yung button po nito magiging "Set Appointment" once approve na

					<div class="form-group">
											<div class="label"><strong>Certificate  of Complition</strong> </div>
											<input type="file" name="tosa_app_proof_of_app_of_ha_file" id="tosa_app_proof_of_app_of_ha_file" <?= $tosa_app_proof_of_app_of_ha_file && $tosa_app_proof_of_app_of_ha_status != 'reject' ? 'disabled' : '' ?>/>
											<label class="btn-attach" for="tosa_app_proof_of_app_of_ha_file" title="Attach file here"><?= $tosa_app_registration_file ? $tosa_app_proof_of_app_of_ha_file : 'Attach file here' ?></label>	
											<?php if($tosa_app_proof_of_app_of_ha_status == 'approved') :?><div class="approved txt-green"><i class="fas fa-check"></i></div><?php endif; ?>
											<?php if($tosa_app_proof_of_app_of_ha_status == 'reject') :?><div class="approved txt-red"><i class="fas fa-times"></i></div><?php endif; ?>
										</div> 
									
	-->


							<?php if($appointment_post_interview && $appointment_post_interview->status != "reject") : ?>
								<h3>Appointment:</h3>
								<p><?= date('F, d Y. l \a\t g:i a', strtotime($appointment_post_interview->appointment_date)); ?></p>
							<?php else: ?>
							<button type="button" class="btn btn-red btn-appointment" data-appointment="post_interview">Set Appointment</button>
							<?php endif; ?>
							</div>
						</li>
					</ul>
				</li>
			</ul>
		</div>
		<br><br>
		<div id="tab-transaction">
			<?php 
				$request_list = [];
				if($request_cgmc_ojt){ 
					$request_list['request_cgmc_ojt']['name'] = 'CGMC On-The-Job Training';
					$request_list['request_cgmc_ojt']['remarks'] = $request_cgmc_ojt->remarks;
					// $request_list['request_cgmc_ojt']['status'] = ($ojt_registration_form_status == 'approved' && $ojt_cgmc_form_status == 'approved' && $ojt_career_advising_status == 'approved') ? 'Approved' : 'Pending'; 
					if($ojt_registration_form_status == 'approved' && $ojt_cgmc_form_status == 'approved' && $ojt_career_advising_status == 'approved'){
						$request_list['request_cgmc_ojt']['status'] = "Approved";
					}else if($ojt_registration_form_status == 'approved' && $ojt_cgmc_form_status == 'approved' && $ojt_career_advising_status == 'reject'){
						$request_list['request_cgmc_ojt']['status'] = "Rejected";
					}else {
						$request_list['request_cgmc_ojt']['status'] = "Pending";
					}
				}
				if($request_cgmc_job_application){ 
					$request_list['request_cgmc_job_application']['name'] = 'CGMC Job Application';
					$request_list['request_cgmc_job_application']['remarks'] = $request_cgmc_job_application->remarks;
					// $request_list['request_cgmc_job_application']['status'] = ($ja_receipt_number_status == 'approved' && $ja_tor_status == 'approved') ? 'Approved' : 'Pending'; 
					if ($ja_receipt_number_status == 'approved' && $ja_tor_status == 'approved'){
						$request_list['request_cgmc_job_application']['status'] = "Approved";
					}else if ($ja_receipt_number_status == 'reject' && $ja_tor_status == 'reject'){
						$request_list['request_cgmc_job_application']['status'] = "Rejected";
					}else {
						$request_list['request_cgmc_job_application']['status'] = "Pending";
					}
				}
				if($request_cgmc_scholarship){ 
					$request_list['request_cgmc_scholarship']['name'] = 'CGMC Scholarship';
					$request_list['request_cgmc_scholarship']['remarks'] = $request_cgmc_scholarship->remarks;
					// $request_list['request_cgmc_scholarship']['status'] = ($ss_receipt_number_status == 'approved' && $ss_application_form_status == 'approved' && $ss_registration_form_status == 'approved' && $ss_grade_from_prev_status == 'approved') ? 'Approved' : 'Pending'; 
					if ($ss_receipt_number_status == 'approved' && $ss_application_form_status == 'approved' && $ss_registration_form_status == 'approved' && $ss_grade_from_prev_status == 'approved') {
						$request_list['request_cgmc_scholarship']['status'] = "Approved";
					}else if($ss_receipt_number_status == 'reject' && $ss_application_form_status == 'reject' && $ss_registration_form_status == 'reject' && $ss_grade_from_prev_status == 'reject'){
						$request_list['request_cgmc_scholarship']['status'] = "Rejected";
					}else{
						$request_list['request_cgmc_scholarship']['status'] = "Pending";
					}
				}
				if($request_cgmc_transferee){ 
					$request_list['request_cgmc_transferee']['name'] = 'CGMC Transferee';
					$request_list['request_cgmc_transferee']['remarks'] = $request_cgmc_transferee->remarks;
					// $request_list['request_cgmc_transferee']['status'] = ($transferee_receipt_number_status == 'approved' && $transferee_exit_interview_form_status == 'approved') ? 'Approved' : 'Pending';  

					if ($transferee_receipt_number_status == 'approved' && $transferee_exit_interview_form_status == 'approved'){
						$request_list['request_cgmc_transferee']['status'] = "Approved";
					}else if($transferee_receipt_number_status == 'reject' && $transferee_exit_interview_form_status == 'reject'){
						$request_list['request_cgmc_transferee']['status'] = "Rejected";
					}else {
						$request_list['request_cgmc_transferee']['status'] = "Pending";
					}
				}
				if($request_cgmc_tosa_app){ 
					$request_list['request_cgmc_tosa_app']['name'] = 'CGMC TOSA Application';
					$request_list['request_cgmc_tosa_app']['remarks'] = $request_cgmc_tosa_app->remarks;
					// $request_list['request_cgmc_tosa_app']['status'] = ($tosa_app_receipt_number_status == 'approved' && $tosa_app_form_of_scholarship_status == 'approved' && $tosa_app_registration_status == 'approved') ? 'Approved' : 'Pending';  

					if ($tosa_app_receipt_number_status == 'approved' && $tosa_app_form_of_scholarship_status == 'approved' && $tosa_app_registration_status == 'approved') {
						$request_list['request_cgmc_tosa_app']['status']="Approved";
					}else if($tosa_app_receipt_number_status == 'reject' && $tosa_app_form_of_scholarship_status == 'reject' && $tosa_app_registration_status == 'reject') {
						$request_list['request_cgmc_tosa_app']['status']="Rejected";
					}else {
						$request_list['request_cgmc_tosa_app']['status']="Pending";
					}
				}
				if($request_cgmc_rnu_rep){ 
					$request_list['request_cgmc_rnu_rep']['name'] = 'CGMC Regional/ National/ International University\'s Representative';
					$request_list['request_cgmc_rnu_rep']['remarks'] = "";
					// $request_list['request_cgmc_rnu_rep']['status'] = ($rnu_rep_registration_form_status == 'approved') ? 'Approved' : 'Pending'; 
					if($rnu_rep_registration_form_status == 'approved'){
						$request_list['request_cgmc_rnu_rep']['status']="Approved";
					}else if ($rnu_rep_registration_form_status == 'reject'){
						$request_list['request_cgmc_rnu_rep']['status']="Rejected";
					}else {
						$request_list['request_cgmc_rnu_rep']['status']="Pending";
					}
				}
				if($appointment_group_counseling){ 
					$request_list['appointment_group_counseling']['name'] = 'Appointment Group Counseling';
					$request_list['appointment_group_counseling']['remarks'] = $appointment_group_counseling->remarks;
					// $request_list['appointment_group_counseling']['status'] = ($appointment_group_counseling->status == 'approved') ? 'Approved' : 'Pending'; 
					if($appointment_group_counseling->status == 'approved'){
						$request_list['appointment_group_counseling']['status']="Approved";
					}else if ($appointment_group_counseling->status == 'reject'){
						$request_list['appointment_group_counseling']['status']="Rejected";
					}else {
						$request_list['appointment_group_counseling']['status']="Pending";
					}
				}
				if($appointment_exit_interview){ 
					$request_list['appointment_exit_interview']['name'] = 'Appointment Exit Interview';
					$request_list['appointment_exit_interview']['remarks'] = $appointment_exit_interview->remarks;
					// $request_list['appointment_exit_interview']['status'] = ($appointment_exit_interview->status == 'approved') ? 'Approved' : 'Pending'; 
					if ($appointment_exit_interview->status == 'approved') {
						$request_list['appointment_exit_interview']['status'] ="Approved";
					}else if ($appointment_exit_interview->status == 'reject'){
						$request_list['appointment_exit_interview']['status'] ="Rejected";
					}else {
						$request_list['appointment_exit_interview']['status'] ="Pending";
					}
				}
				if($appointment_initial_interview){ 
					$request_list['appointment_initial_interview']['name'] = 'Appointment Initial Interview';
					$request_list['appointment_initial_interview']['remarks'] = $appointment_initial_interview->remarks;
					// $request_list['appointment_initial_interview']['status'] = ($appointment_initial_interview->status == 'approved') ? 'Approved' : 'Pending'; 
					if ($appointment_initial_interview->status == 'approved') {
						$request_list['appointment_initial_interview']['status']="Approved";
					}else if ($appointment_initial_interview->status == 'reject'){
						$request_list['appointment_initial_interview']['status']="Rejected";
					}else {
						$request_list['appointment_initial_interview']['status']="Pending";
					}
				}
				if($appointment_post_interview){ 
					$request_list['appointment_post_interview']['name'] = 'Appointment Post Interview';
					$request_list['appointment_post_interview']['remarks'] = $appointment_post_interview->remarks;
					// $request_list['appointment_post_interview']['status'] = ($appointment_post_interview->status == 'approved') ? 'Approved' : 'Pending';  
					if ($appointment_post_interview->status == 'approved') {
						$request_list['appointment_post_interview']['status'] ="Approved";
					}else if ($appointment_post_interview->status == 'reject'){
						$request_list['appointment_post_interview']['status'] ="Rejected";
					}else {
						$request_list['appointment_post_interview']['status'] ="Pending";
					}
				}

				// print_r($request_list);
				if($request_list):
			?>
			<table class="table-list">
				<tbody>
					<?php foreach($request_list as $val): ?>
					<tr>
						<td><?= $val['name'] ?></td>
						<td><?= $val['remarks'] ?></td>
						<?php if($val['status'] == 'Approved'){ ?>
						<td><span class="txt-green">Approved</span></td>
						<?php }else if($val['status'] == 'Rejected'){ ?>
						<td><span class="txt-red">Rejected</span></td>
						<?php }else{ ?>
							<td><span class="txt-pending">Pending</span></td>
						<?php } ?>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<?php
				else:
			?>
			<p class="txt-graycenter"> No previous transaction </p>
			<?php
				endif;
			?>
		</div>
		<br><br>
		<div id="tab-forms">
			<ul class="p-30">
				<?php foreach($form_list as $val): ?>
				<li><a href="<?= ASSETS ?>forms/<?= $val['form_file'] ?>"><i class="fas fa-file-pdf text-red"></i> <?= $val['form_title'] ?></a></li>
				<?php endforeach; ?>
				<!-- <li><a href="#"><i class="fas fa-file-pdf text-red"></i> Request for Certificate of Good Moral Character</a></li>
				<li><a href="#"><i class="fas fa-file-pdf text-red"></i> Exit Interview Form</a></li>
				<li><a href="#"><i class="fas fa-file-pdf text-red"></i> Exit Questionnaire for Students</a></li> -->
			</ul>
		</div>
	</div>
</div>

<div class="view-file-modal custom-modal modal-style-2">
  <div class="modal-wrap">
      <div class="modal-box">
          <!-- <div class="modal-header">Settings</div> -->
          <div class="modal-content">
            <iframe src="" frameborder="0"></iframe>
          </div>
      </div>
  </div>
  <div class="modal-bg-overlay"></div>
</div>  

<div class="datepicker-modal gc-date-modal custom-modal">
	<div class="modal-wrap">
		<div class="modal-box">
			<div class="modal-header">SET APPOINTMENT</div>
			<form method="post" id="form-date-time">
				<input type="hidden" name="appointment-type" value="group_counseling">
				<div class="form-group no-flex">
					<label for="date">Select Date</label>
					<div class="text-center">
						<input type="text" name="date" id="date" style="display: none;">
						<div id="datepicker"></div>
					</div>
				</div>
				<div class="form-group no-flex">
					
					<div>
						<label for="time">Select Time :</label>
						<div class="text-center">
							<select name="time" id="time">
							<?php foreach($allow_hour as $time): //print_r($disable_hour); ?>
							<option value="<?= $time; ?>" <?= in_array($time, $disable_hour) ? 'disabled' : '' ?>><?= $time ?></option>
							<?php endforeach; ?>							
							</select>
						</div>
					</div>
				</div>
				<div class="form-group no-flex">
				<!--	<label for="available-slots">Available Slots :</label> -->
					<div class="text-center">
				<!--		<input type="text" name="available-slots" value="<?= max_slots() - $default_available_slots; ?> Slots" readonly> -->
					</div>
				</div>
				<div class="form-group no-flex">
					<label for="available-slots">Members :</label>
					<div class="gc-member-list form-group">
					</div>
					<div class="form-group">
						<input type="text" name="gc-member" id="gc-member" value="">
						<button class="btn-add-member btn" type="button">Add member</button>
					</div>
				</div>
				<p class="text-center"><button type="submit" class="btn btn-green">SET APPOINTMENT</button></p>
			</form>
		</div>
	</div>
	<div class="modal-bg-overlay"></div>
</div>

<div class="datepicker-modal default-date-modal custom-modal">
	<div class="modal-wrap">
		<div class="modal-box">
			<div class="modal-header">SET APPOINTMENT</div>
			<form method="post" id="form-date-time-2" enctype="multipart/form-data">
				<input type="hidden" name="appointment-type">
				<div class="form-group no-flex">
					<label for="date-2">Select Date</label>
					<div class="text-center">
						<input type="text" name="date" id="date-2" style="display: none;">
						<div id="datepicker-2"></div>
					</div>
				</div>
				<div class="form-group no-flex">
				<label for="time-2">Select Time : </label>
						<div class="text-center">
							<select name="time" id="time-2" style="display: inline-block;max-width: 200px;">
							<?php foreach($allow_hour as $time): //print_r($disable_hour); ?>
							<option value="<?= $time; ?>" <?= in_array($time, $disable_hour) ? 'disabled' : '' ?>><?= $time ?></option>
							<?php endforeach; ?>							
							</select>
						</div>
					<div>
					
						<div class="exit_interview_forms">
							<div class="form-group">
								<div class="label" style=text-align:left><strong>Exit Interview Form : </strong> <small>Signed by Parent/Guardian, Adviser/Program Chair, and College Dean</small> </div>
								<input type="file" name="exit-form" id="exit-form"/>
								<label class="btn-attach" for="exit-form" title="Attach file here">Attach file here</label>
							</div>
							<div class="form-group">
								<div class="label"><strong>Exit Questionnaire : </strong> <small></small> </div>
								<input type="file" name="exit-questionnaire" id="exit-questionnaire"/>
								<label class="btn-attach" for="exit-questionnaire" title="Attach file here">Attach file here</label>
							</div> 
							<div class="form-group">
								<div class="label"><strong>Valid ID of Parent/Guardian : </strong> <small></small> </div>
								<input type="file" name="valid-id" id="valid-id"/>
								<label class="btn-attach" for="valid-id" title="Attach file here">Attach file here</label>
							</div> 
						</div>
						<div class="initial_interview_forms">
							<div class="form-group">
								<div class="label"><strong>Registration Form : </strong> <small>(Current semester)</small> </div>
								<input type="file" name="reg-form" id="reg-form"/>
								<label class="btn-attach" for="reg-form" title="Attach file here">Attach file here</label>
							</div>
						</div>
						<div class="post_interview_forms">
							<div class="form-group">
								<div class="label"><strong>Certificate of Completion : </strong> <small></small> </div>
								<input type="file" name="coc-form" id="coc-form"/>
								<label class="btn-attach" for="coc-form" title="Attach file here">Attach file here</label>
							</div>
						</div>
						
					</div>
					<!-- CHECKMARK -->
					<div class="form-group">
						<input type="checkbox" class="consent-agreement"/>
						<p>By uploading the files, I hereby give my consent and authorization to use the files I have provided. Further, I allow the concerned office to view and evaluate my personal information.</p>
					</div>
				</div>
				<p class="text-center"><button type="submit" class="btn btn-green">SET APPOINTMENT</button></p>
			</form>
		</div>
	</div>
	<div class="modal-bg-overlay"></div>
</div>


<div class="confirm-modal custom-modal" data-form="">
	<div class="modal-wrap" style="width: 400px;">
		<div class="modal-box text-center" style="background: #fff;">
			<div class="modal-header">Confirm</div>
			<h2>Are you sure you want to set an appointment?</h2>
			<p class="txt-red">August 31, 2021. Tuesday at 10:00 am</p>
			<div class="d-flex">
				<button type="button" class="btn btn-green btn-confirm" style="margin: auto;min-width: 140px;">CONFIRM</button>
				<button type="button" class="btn btn-cancel" style="margin: auto;min-width: 140px;">CANCEL</button>
			</div>
		</div>
	</div>
	<div class="modal-bg-overlay" style="opacity:.7"></div>
</div>