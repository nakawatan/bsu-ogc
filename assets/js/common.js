(function($){
	$(document).ready(function(){
		setTimeout(function(){
			$('.preloader').fadeOut(300);
		}, 2000);
		$('#register').on('submit', function(e){
			e.preventDefault();
			var loading = $('.form_loader');
			loading.fadeIn(300);
			// $(this).find('[name=email_hidden]').val($(this).find('#email').val() + '@g.batstate-u.edu.ph');	
			$.ajax({
                url: "./register/validate",
                data: $(this).serialize(),
                dataType: 'json',
				method: 'post',
				success: function(response) {
					// console.log(response);
					$('.error-msg').remove();
                    $('.is-invalid').removeClass('is-invalid');
                    if(response.error){
                        $.each(response.fields, function(index, value){
                            if(value.message){
                            	if(index == 'email'){
                            		$('#'+index).parent().after('<div class="error-msg">'+value.message+'</div>');
                            		$('#'+index).parent().addClass('is-invalid');
                            	}else{
                            		$('#'+index).after('<div class="error-msg">'+value.message+'</div>');
                            		$('#'+index).addClass('is-invalid');
                            	}
                            }
                        });    
                    }else{
                        Swal.fire({
                    		title: 'Success!',
                    		text: 'You have successfully registered',
                    		icon: 'success',
                    		showConfirmButton: false,
  							timer: 1500
						}).then(function(){
							window.location.href = './login';
						});
                    }
                    loading.fadeOut(300);
				}
            });	
		});
		$('#register [name=department]').on('change', function(){
			var id  = $(this).val(),
				arr = params_register[id],
				test2 = '';
			$('#register [name=program] option').remove()
			$.each(arr.courses, function(i, item){
				$('#register [name=program]').append('<option value="'+item+'">'+item+'</option>');
			});
			$( "#register [name=program]" ).focus();
		});
		$('.tabs:not(.no-action) a').on('click', function(e){
			e.preventDefault();
			var target = $(this).attr('href');
			$('.tabs a').removeClass('active');
			$('.tab-content>div').removeClass('active');
			$(this).addClass('active');
			$(target).addClass('active');
		});
		$('.first-step').on('click', '.btn-red', function(){
			var first_step = $(this).parents('.first-step');
			first_step.fadeOut('slow', function(){
				first_step.next('.second-step').fadeIn('slow');
			});
		});
		$('.form-group').on('change', 'input[type=file]', function(){
			var id = $(this).attr('id'),
				filename = $(this).val().replace(/C:\\fakepath\\/i, ''),
				form_validate = $(this).parents('.form-validate');
			$('.btn-attach[for='+id+']').html(filename);
			$('.btn-attach[for='+id+']').attr('title',filename);
			// $(form_validate.find('input[type=file]:not([disabled])')).each(function(){
			// 	if($(this).val() === ''){
			// 		is_valid = false;
			// 		return false;
			// 	}
			// });
			// if(is_valid){
			// 	// form_validate.find('button[type=submit]').prop("disabled", false);
			// }
		});
		$('.form-validate').on('change', 'input', function(){
			var is_valid = true,
				form_validate = $(this).parents('.form-validate');

			$(form_validate).find('input:not([disabled])').each(function(){
				if ($(this).val() == "") {
					is_valid = false;
					return false;
				}
			});
			if (!$(form_validate).find('.consent-agreement').prop("checked")) {
				is_valid = false;
			}

			if(is_valid){
				form_validate.find('button[type=submit]').prop("disabled", false);
			}else {
				form_validate.find('button[type=submit]').prop("disabled", true);
			}
		});
		// var is_valid = true;
		// $('.form-validate').find('input:not([disabled])').each(function(){
		// 	var element = $(this);
		// 	if (element.val() == "") {
		// 		isValid = false;
		// 	}
		// });
		$('.has-sub-menu > a').on('click', function(e){
			e.preventDefault(); 
			$(this).parent().toggleClass('active');
			$(this).next('.sub-menu').slideToggle(300);
		});
		$('.confirm-modal').on('click', '.btn-cancel', function(){
			$('.confirm-modal').hide();
		});
		$('.confirm-modal').on('click', '.btn-confirm', function(){
			var $this = $('.confirm-modal').data('form'),
				form = $($this),
				// formData = form.serialize();
				formData = new FormData(form[0]);
			
			$('.error').remove();
			// console.log(formData);
			$.ajax({
                url: "./student/set_appointment",
                data: formData,
				contentType: false,
				processData: false,
				method: 'POST',
				success: function(response) {
					if(response.error){
						$.each(response.fields, function(index, value){
                            if(value.message){
                                $('#'+index).after('<div class="error">'+value.message+'</div>');
                            }
                        })
						if(response.message){
							Swal.fire({
	                    		title: 'Error!',
	                    		text: response.message,
	                    		icon: 'error',
	                    		showConfirmButton: true,
							});
						} 
					}else{
						Swal.fire({
                    		title: 'Success!',
                    		text: 'Your request has been sent successfully',
                    		icon: 'success',
                    		showConfirmButton: false,
  							timer: 1500
						}).then(function(){
							location.reload();
						});
					}
				}
            });	
		});
		$('#form-date-time').submit(function(e){
			e.preventDefault();
			$('.confirm-modal').attr('data-form', '#form-date-time');
			$('.error').remove();
			var form = $(this),
				formData = form.serialize();
			$.ajax({
                url: "./student/form_appointment_validate",
                data: formData,
                dataType: "json",
				method: 'POST',
				success: function(response) {
					let date_field = form.find('input[name=date]').val(),
						time_field = form.find('select[name=time]').val(),
						str_time = time_field.split(" ");
					if(response.error){
						$.each(response.fields, function(index, value){
                            if(value.message){
                                // $('#'+index).after('<div class="error">Please select available date</div>');
                                Swal.fire({
		                    		title: 'Error!',
		                    		text: 'Please select available date',
		                    		icon: 'error',
		                    		showConfirmButton: true,
								});
                            }
                        })
						if(response.message){
							Swal.fire({
	                    		title: 'Error!',
	                    		text: response.message,
	                    		icon: 'error',
	                    		showConfirmButton: true,
							});
						} 
					}else{
						$('.confirm-modal .txt-red').text($.datepicker.formatDate('MM dd, yy. DD', new Date(date_field))+' at '+str_time[0]+' '+str_time[1]);
						$('.confirm-modal').attr('data-form', '#form-date-time');
						$('.confirm-modal').fadeIn(300);
					}
				}
            });	
		});
		$('#form-date-time-2').submit(function(e){
			e.preventDefault();
			// $('.confirm-modal').attr('data-form', '#form-date-time-2');
			// $('.confirm-modal').fadeIn(300);
			if(!$(this).find('.consent-agreement').prop('checked')){
				Swal.fire({
					title: 'Error!',
					text: 'Consent agreement not checked.',
					icon: 'error',
					showConfirmButton: true,
				});
				return;
			}
			appointmentType=$('#form-date-time-2 input[name=appointment-type]').val() ;
			if (appointmentType== "exit_interview") {
				if ($('#exit-form')[0].files.length == 0 || $('#exit-questionnaire')[0].files.length == 0 || $('#valid-id')[0].files.length == 0) {
					Swal.fire({
						title: 'Error!',
						text: 'Exit Form and Questionnaire cannot be empty.',
						icon: 'error',
						showConfirmButton: true,
					});
					return;
				}
			}else if (appointmentType == "initial_interview") {
				if ($('#reg-form')[0].files.length == 0) {
					Swal.fire({
						title: 'Error!',
						text: 'Registration Form cannot be empty.',
						icon: 'error',
						showConfirmButton: true,
					});
					return;
				}
			}else {
				if ($('#coc-form')[0].files.length == 0) {
					Swal.fire({
						title: 'Error!',
						text: 'Certificate of Completion cannot be empty.',
						icon: 'error',
						showConfirmButton: true,
					});
					return;
				}
			}
			var form = $(this),
				formData = form.serialize();
			$.ajax({
                url: "./student/form_appointment_validate",
                data: formData,
                dataType: "json",
				method: 'POST',
				success: function(response) {
					let date_field = form.find('input[name=date]').val(),
						time_field = form.find('select[name=time]').val(),
						str_time = time_field.split(" ");
					if(response.error){
						$.each(response.fields, function(index, value){
                            if(value.message){
                                // $('#'+index).after('<div class="error">'+value.message+'</div>');
                                Swal.fire({
		                    		title: 'Error!',
		                    		text: 'Please select available date',
		                    		icon: 'error',
		                    		showConfirmButton: true,
								});
                            }
                        })
						if(response.message){
							Swal.fire({
	                    		title: 'Error!',
	                    		text: response.message,
	                    		icon: 'error',
	                    		showConfirmButton: true,
							});
						} 
					}else{
						// August 31, 2021. Tuesday at 10:00 am
						$('.confirm-modal .txt-red').text($.datepicker.formatDate('MM dd, yy. DD', new Date(date_field))+' at '+str_time[0]+' '+str_time[1]);
						$('.confirm-modal').attr('data-form', '#form-date-time-2');
						$('.confirm-modal').fadeIn(300);
					}
				}
            });	
		});
		$('#request_cgmc_ojt').submit(function(e){
			e.preventDefault();
			var form 	 = $(this)[0],
				formData = new FormData(form);

			$('#request_cgmc_ojt .error').remove();
            $.ajax({
                url: "./student/request_cgmc_ojt",
                data: formData,
                dataType: "json",
				contentType: false,
				processData: false,
				cache: false,
				method: 'POST',
				success: function(response) {
					var button = $('#request_cgmc_ojt button[type=submit]');
					if(response.error){
						$.each(response.fields, function(index, value){
                            if(value.message){
                                $('#'+index).after('<div class="error">'+value.message+'</div>');
                            }
                        });
						if(response.message){
							alert(response.message);
						}  
                    }else{
                    	button.text('Pending');
                    	button.prop('disabled',true);
                    	$('.btn-attach').prop('disabled',true);
                    	Swal.fire({
                    		title: 'Success!',
                    		text: 'Your request has been sent successfully',
                    		icon: 'success',
                    		showConfirmButton: false,
  							timer: 1500
						});
                    	// console.log('success');
                    }
				},
				error: function(response) {
					// console.log(response);
				}
            });
		});
		$('#update_request_cgmc_ojt').submit(function(e){
			e.preventDefault();
			var form 	 = $(this)[0],
				formData = new FormData(form);

			$('#update_request_cgmc_ojt .error').remove();
            $.ajax({
                url: "./student/update_request_cgmc_ojt",
                data: formData,
                dataType: "json",
				contentType: false,
				processData: false,
				cache: false,
				method: 'POST',
				success: function(response) {
					var button = $('#update_request_cgmc_ojt button[type=submit]');
					if(response.error){
						$.each(response.fields, function(index, value){
                            if(value.message){
                                $('#'+index).after('<div class="error">'+value.message+'</div>');
                            }
                        });
						if(response.message){
							alert(response.message);
						}  
                    }else{
                    	button.text('Pending');
                    	button.prop('disabled',true);
                    	$('.btn-attach').prop('disabled',true);
                    	$('#update_request_cgmc_ojt .approved.txt-red').remove();
                    	Swal.fire({
                    		title: 'Success!',
                    		text: 'Your request has been sent successfully',
                    		icon: 'success',
                    		showConfirmButton: false,
  							timer: 1500
						});
                    	// console.log('success');
                    }
				}
            });
		});
		$('#request_cgmc_job_application').submit(function(e){
			e.preventDefault();
			var form 	 = $(this)[0],
				formData = new FormData(form);

			$('#request_cgmc_job_application .error').remove();
            $.ajax({
                url: "./student/request_cgmc_job_application",
                data: formData,
                dataType: "json",
				contentType: false,
				processData: false,
				cache: false,
				method: 'POST',
				success: function(response) {
					var button = $('#request_cgmc_job_application button[type=submit]');
					console.log(button);
					if(response.error){
						$.each(response.fields, function(index, value){
                            if(value.message){
                                $('#'+index).before('<div class="error">'+value.message+'</div>');
                            }
                        });
						if(response.message){
							alert(response.message);
						}  
                    }else{
                    	button.text('Pending');
                    	button.prop('disabled',true);
                    	$('.btn-attach').prop('disabled',true);
                    	Swal.fire({
                    		title: 'Success!',
                    		text: 'Your request has been sent successfully',
                    		icon: 'success',
                    		showConfirmButton: false,
  							timer: 1500
						});
                    }
				}
            });
		});
		$('#update_request_cgmc_job_application').submit(function(e){
			e.preventDefault();
			var form 	 = $(this)[0],
				formData = new FormData(form);

			$('#update_request_cgmc_job_application .error').remove();
            $.ajax({
                url: "./student/update_request_cgmc_job_application",
                data: formData,
                dataType: "json",
				contentType: false,
				processData: false,
				cache: false,
				method: 'POST',
				success: function(response) {
					var button = $('#update_request_cgmc_job_application button[type=submit]');
					if(response.error){
						$.each(response.fields, function(index, value){
                            if(value.message){
                                $('#'+index).after('<div class="error">'+value.message+'</div>');
                            }
                        });
						if(response.message){
							alert(response.message);
						}  
                    }else{
                    	button.text('Pending');
                    	button.prop('disabled',true);
                    	$('.btn-attach').prop('disabled',true);
                    	$('#update_request_cgmc_job_application .approved.txt-red').remove();
                    	Swal.fire({
                    		title: 'Success!',
                    		text: 'Your request has been sent successfully',
                    		icon: 'success',
                    		showConfirmButton: false,
  							timer: 1500
						});
                    	// console.log('success');
                    }
				}
            });
		});
		$('#request_cgmc_scholarship').submit(function(e){
			e.preventDefault();
			var form 	 = $(this)[0],
				formData = new FormData(form);

			$('#request_cgmc_scholarship .error').remove();
            $.ajax({
                url: "./student/request_cgmc_scholarship",
                data: formData,
                dataType: "json",
				contentType: false,
				processData: false,
				cache: false,
				method: 'POST',
				success: function(response) {
					var button = $('#request_cgmc_scholarship button[type=submit]');
					console.log(button);
					if(response.error){
						$.each(response.fields, function(index, value){
                            if(value.message){
                                $('#'+index).before('<div class="error">'+value.message+'</div>');
                            }
                        });
						if(response.message){
							alert(response.message);
						}  
                    }else{
                    	button.text('Pending');
                    	button.prop('disabled',true);
                    	$('.btn-attach').prop('disabled',true);
                    	Swal.fire({
                    		title: 'Success!',
                    		text: 'Your request has been sent successfully',
                    		icon: 'success',
                    		showConfirmButton: false,
  							timer: 1500
						});
                    }
				}
            });
		});
		$('#update_request_cgmc_scholarship').submit(function(e){
			e.preventDefault();
			var form 	 = $(this)[0],
				formData = new FormData(form);

			$('#update_request_cgmc_cholarship .error').remove();
            $.ajax({
                url: "./student/update_request_cgmc_scholarship",
                data: formData,
                dataType: "json",
				contentType: false,
				processData: false,
				cache: false,
				method: 'POST',
				success: function(response) {
					var button = $('#update_request_cgmc_scholarship button[type=submit]');
					if(response.error){
						$.each(response.fields, function(index, value){
                            if(value.message){
                                $('#'+index).after('<div class="error">'+value.message+'</div>');
                            }
                        });
						if(response.message){
							alert(response.message);
						}  
                    }else{
                    	button.text('Pending');
                    	button.prop('disabled',true);
                    	$('.btn-attach').prop('disabled',true);
                    	$('#update_request_cgmc_scholarship .approved.txt-red').remove();
                    	Swal.fire({
                    		title: 'Success!',
                    		text: 'Your request has been sent successfully',
                    		icon: 'success',
                    		showConfirmButton: false,
  							timer: 1500
						});
                    	// console.log('success');
                    }
				}
            });
		});
		$('#request_cgmc_transferee').submit(function(e){
			e.preventDefault();
			var form 	 = $(this)[0],
				formData = new FormData(form);

			$('#request_cgmc_transferee .error').remove();
            $.ajax({
                url: "./student/request_cgmc_transferee",
                data: formData,
                dataType: "json",
				contentType: false,
				processData: false,
				cache: false,
				method: 'POST',
				success: function(response) {
					var button = $('#request_cgmc_transferee button[type=submit]');
					console.log(button);
					if(response.error){
						$.each(response.fields, function(index, value){
                            if(value.message){
                                $('#'+index).before('<div class="error">'+value.message+'</div>');
                            }
                        });
						if(response.message){
							alert(response.message);
						}  
                    }else{
                    	button.text('Pending');
                    	button.prop('disabled',true);
                    	$('.btn-attach').prop('disabled',true);
                    	Swal.fire({
                    		title: 'Success!',
                    		text: 'Your request has been sent successfully',
                    		icon: 'success',
                    		showConfirmButton: false,
  							timer: 1500
						});
                    }
				}
            });
		});
		$('#update_request_cgmc_transferee').submit(function(e){
			e.preventDefault();
			var form 	 = $(this)[0],
				formData = new FormData(form);

			$('#update_request_cgmc_transferee .error').remove();
            $.ajax({
                url: "./student/update_request_cgmc_transferee",
                data: formData,
                dataType: "json",
				contentType: false,
				processData: false,
				cache: false,
				method: 'POST',
				success: function(response) {
					var button = $('#update_request_cgmc_transferee button[type=submit]');
					if(response.error){
						$.each(response.fields, function(index, value){
                            if(value.message){
                                $('#'+index).after('<div class="error">'+value.message+'</div>');
                            }
                        });
						if(response.message){
							alert(response.message);
						}  
                    }else{
                    	button.text('Pending');
                    	button.prop('disabled',true);
                    	$('.btn-attach').prop('disabled',true);
                    	$('#update_request_cgmc_transferee .approved.txt-red').remove();
                    	Swal.fire({
                    		title: 'Success!',
                    		text: 'Your request has been sent successfully',
                    		icon: 'success',
                    		showConfirmButton: false,
  							timer: 1500
						});
                    	// console.log('success');
                    }
				}
            });
		});
		$('#request_cgmc_tosa_app').submit(function(e){
			e.preventDefault();
			var form 	 = $(this)[0],
				formData = new FormData(form);

			$('#request_cgmc_tosa_app .error').remove();
            $.ajax({
                url: "./student/request_cgmc_tosa_app",
                data: formData,
                dataType: "json",
				contentType: false,
				processData: false,
				cache: false,
				method: 'POST',
				success: function(response) {
					var button = $('#request_cgmc_tosa_app button[type=submit]');
					console.log(button);
					if(response.error){
						$.each(response.fields, function(index, value){
                            if(value.message){
                                $('#'+index).before('<div class="error">'+value.message+'</div>');
                            }
                        });
						if(response.message){
							alert(response.message);
						}  
                    }else{
                    	button.text('Pending');
                    	button.prop('disabled',true);
                    	$('.btn-attach').prop('disabled',true);
                    	Swal.fire({
                    		title: 'Success!',
                    		text: 'Your request has been sent successfully',
                    		icon: 'success',
                    		showConfirmButton: false,
  							timer: 1500
						});
                    }
				}
            });
		});
		$('#update_request_cgmc_tosa_app').submit(function(e){
			e.preventDefault();
			var form 	 = $(this)[0],
				formData = new FormData(form);

			$('#update_request_cgmc_tosa_app .error').remove();
            $.ajax({
                url: "./student/update_request_cgmc_tosa_app",
                data: formData,
                dataType: "json",
				contentType: false,
				processData: false,
				cache: false,
				method: 'POST',
				success: function(response) {
					var button = $('#update_request_cgmc_tosa_app button[type=submit]');
					if(response.error){
						$.each(response.fields, function(index, value){
                            if(value.message){
                                $('#'+index).after('<div class="error">'+value.message+'</div>');
                            }
                        });
						if(response.message){
							alert(response.message);
						}  
                    }else{
                    	button.text('Pending');
                    	button.prop('disabled',true);
                    	$('.btn-attach').prop('disabled',true);
                    	$('#update_request_cgmc_tosa_app .approved.txt-red').remove();
                    	Swal.fire({
                    		title: 'Success!',
                    		text: 'Your request has been sent successfully',
                    		icon: 'success',
                    		showConfirmButton: false,
  							timer: 1500
						});
                    	// console.log('success');
                    }
				}
            });
		});
		$('#request_cgmc_rnu_rep').submit(function(e){
			e.preventDefault();
			var form 	 = $(this)[0],
				formData = new FormData(form);

			$('#request_cgmc_rnu_rep .error').remove();
            $.ajax({
                url: "./student/request_cgmc_rnu_rep",
                data: formData,
                dataType: "json",
				contentType: false,
				processData: false,
				cache: false,
				method: 'POST',
				success: function(response) {
					var button = $('#request_cgmc_rnu_rep button[type=submit]');
					console.log(button);
					if(response.error){
						$.each(response.fields, function(index, value){
                            if(value.message){
                                $('#'+index).before('<div class="error">'+value.message+'</div>');
                            }
                        });
						if(response.message){
							alert(response.message);
						}  
                    }else{
                    	button.text('Pending');
                    	button.prop('disabled',true);
                    	$('.btn-attach').prop('disabled',true);
                    	Swal.fire({
                    		title: 'Success!',
                    		text: 'Your request has been sent successfully',
                    		icon: 'success',
                    		showConfirmButton: false,
  							timer: 1500
						});
                    }
				}
            });
		});

		$('#update_request_cgmc_rnu_rep').submit(function(e){
			e.preventDefault();
			var form 	 = $(this)[0],
				formData = new FormData(form);

			$('#update_request_cgmc_rnu_rep .error').remove();
            $.ajax({
                url: "./student/update_request_cgmc_rnu_rep",
                data: formData,
                dataType: "json",
				contentType: false,
				processData: false,
				cache: false,
				method: 'POST',
				success: function(response) {
					var button = $('#update_request_cgmc_rnu_rep button[type=submit]');
					if(response.error){
						$.each(response.fields, function(index, value){
                            if(value.message){
                                $('#'+index).after('<div class="error">'+value.message+'</div>');
                            }
                        });
						if(response.message){
							alert(response.message);
						}  
                    }else{
                    	button.text('Pending');
                    	button.prop('disabled',true);
                    	$('.btn-attach').prop('disabled',true);
                    	$('#update_request_cgmc_rnu_rep .approved.txt-red').remove();
                    	Swal.fire({
                    		title: 'Success!',
                    		text: 'Your request has been sent successfully',
                    		icon: 'success',
                    		showConfirmButton: false,
  							timer: 1500
						});
                    	// console.log('success');
                    }
				}
            });
		});
		$('.btn-appointment[data-appointment=group_counseling]').on('click', function(e){
			$('body').addClass('modal-open');
			$('.gc-date-modal').fadeIn(300);
		});

		$('.btn-appointment:not([data-appointment=group_counseling])').on('click', function(e){
			var appointment = $(this).data('appointment');
			$('.exit_interview_forms input[type="file"]').val("");
			$('.initial_interview_forms input[type="file"]').val("");
			$('.post_interview_forms input[type="file"]').val("");

			$(".exit_interview_forms").hide();
			$(".initial_interview_forms").hide();
			$(".post_interview_forms").hide();
			$('#form-date-time-2 input[name=appointment-type]').val(appointment);
			if (appointment == "initial_interview"){
				$(".initial_interview_forms").show();
			}
			if (appointment == "post_interview"){
				$(".post_interview_forms").show();
			}
			if (appointment == "exit_interview"){
				$(".exit_interview_forms").show();
			}
			$('body').addClass('modal-open');
			$('.default-date-modal').fadeIn(300);
		});

		$('.modal-bg-overlay, .modal-close').on('click', function(e){
			$('body').removeClass('modal-open');
			$(this).parents('.custom-modal').fadeOut(300);
		});
		

		$( "#datepicker" ).datepicker({
			inline: true,
			altField: '#date',
			dateFormat: 'yy-mm-dd',
			minDate: new Date(),
			maxDate: '+1y',
			beforeShowDay: function(date) {
				$.datepicker.noWeekends;
				// return [ ( day > 0 && day < 6 ), "" ];
				// console.log($.datepicker.noWeekends);
				var monthsToDisable = site_params.disable_months,
					daysToDisable 	= site_params.disable_days,
					datesToDisable 	= site_params.disable_dates
					month 			= date.getMonth() + 1,
					days 			= date.getDate(),
					day 			= date.getDay();
			    if($.inArray(days, daysToDisable) != -1){
			    	$('#time option').prop('disabled',false);
			    	$('#time option:not([disabled])').first().prop('selected', true);
			    	if ($.inArray(month, monthsToDisable) != -1) {
			    		$('#time option').each(function(index, element){
					    	let el = $(element).val();
					    	if($.inArray(el, site_params.disable_hour) != -1){
					    		$(element).prop('disabled',true);
					    	}
					    });
					    $('#time option:not([disabled])').first().prop('selected', true);
				        return [false];
				    }
			    }
			    if(( day > 0 && day < 6 )){
			    	return [true];
			    }else{
			    	return [false];
			    }
			},
			onSelect: function(date) {
				// console.log(date);
				$.ajax({
	                url: "./student/gc_check_available_slots",
	                data: {date: date},
					method: 'POST',
					success: function(response) {
						if(response){
							$('input[name="available-slots"]').val(response.available_slots+' Slots');
						}
						
					}
	            });
			}
		});

		$( "#datepicker-2" ).datepicker({
			inline: true,
			altField: '#date-2',
			dateFormat: 'yy-mm-dd',
			minDate: new Date(),
			maxDate: '+1y',
			beforeShowDay: function(date) {
				$.datepicker.noWeekends;
				// return [ ( day > 0 && day < 6 ), "" ];
				// console.log($.datepicker.noWeekends);
				var monthsToDisable = site_params.disable_months,
					daysToDisable 	= site_params.disable_days,
					datesToDisable 	= site_params.disable_dates
					month 			= date.getMonth() + 1,
					days 			= date.getDate(),
					day 			= date.getDay();

			    if($.inArray(days, daysToDisable) != -1){
			    	$('#time-2 option').prop('disabled',false);
			    	$('#time-2 option:not([disabled])').first().prop('selected', true);
			    	if ($.inArray(month, monthsToDisable) != -1) {
			            $('#time-2 option').each(function(index, element){
					    	let el = $(element).val();
					    	if($.inArray(el, site_params.disable_hour) != -1){
					    		$(element).prop('disabled',true);
					    	}
					    });
					    $('#time-2 option:not([disabled])').first().prop('selected', true);
				        return [false];
				    }
			    }
			    if(( day > 0 && day < 6 )){
			    	return [true];
			    }else{
			    	return [false];
			    }
			}
		});

		$('.ui-state-highlight').removeClass('ui-state-highlight');
		$('.ui-state-active').removeClass('ui-state-active');
		$('#date, #date-2').val('');

		// admin login button

		$('.btn-admin').on('click',function(){
            if($(this).text()=="Admin"){
				$('.admin-login-form').show();
                $('.g-signin2').hide();
                $('.btn-admin').text('Student Login');
                $('.btn-login').show();
            }else {
				$('.admin-login-form').hide();
                $('.g-signin2').show();
                $('.btn-login').hide();
                $('.btn-admin').text('Admin');
            }
            
        });
        // $('#not_signed_in8tbtaw6ppa2a').text('Student Sign in');
		$('.abcRioButtonContents').find('span').eq(0).text("Student Sign in");

		// Swiper
	    var swiper = new Swiper('.swiper-container', {
	        // Default parameters
	        slidesPerView: 2,
	        spaceBetween: 30,
	        centeredSlides: true,
	        autoplay: {
	            delay: 2000,
	        },
	        navigation: {
	            nextEl: '.swiper-button-next',
	            prevEl: '.swiper-button-prev',
	        },
	    });
	});


	// notification functions
    // ANIMATEDLY DISPLAY THE NOTIFICATION COUNTER.
    $('#noti_Counter')
        .css({ opacity: 0 })
        .text('0')  // ADD DYNAMIC VALUE (YOU CAN EXTRACT DATA FROM DATABASE OR XML).
        .css({ top: '-10px' })
        .animate({ top: '-2px', opacity: 1 }, 500);

    $('#noti_Button').click(function () {
        // TOGGLE (SHOW OR HIDE) NOTIFICATION WINDOW.
        $('#notifications').fadeToggle('fast', 'linear', function () {
            if ($('#notifications').is(':hidden')) {
                // $('#noti_Button').css('background-color', '#2E467C');
            }
            // CHANGE BACKGROUND COLOR OF THE BUTTON.
            // else $('#noti_Button').css('background-color', '#FFF');
        });
		get_notifications_ajax();

        $('#noti_Counter').fadeOut('slow');     // HIDE THE COUNTER.

        return false;
    });

    // HIDE NOTIFICATIONS WHEN CLICKED ANYWHERE ON THE PAGE.
    $(document).click(function () {
        $('#notifications').hide();

        // CHECK IF NOTIFICATION COUNTER IS HIDDEN.
        if ($('#noti_Counter').is(':hidden')) {
            // CHANGE BACKGROUND COLOR OF THE BUTTON.
            $('#noti_Button').css('background-color', '#2E467C');
        }
    });

    $('#notifications').click(function () {
        return false;       // DO NOTHING WHEN CONTAINER IS CLICKED.
    });

	// get-notifications
	$.ajax({
		url: "/admin/get_notifications",
		data: $(this).serialize(),
		dataType: 'json',
		method: 'post',
		success: function(response) {
			notification_count = response.cgmc_ja_pending.length;
			notification_count += response.cgmc_ojt_pending.length;
			notification_count += response.cgmc_rnur_pending.length;
			notification_count += response.cgmc_ss_pending.length;
			notification_count += response.cgmc_ta_pending.length;
			notification_count += response.cgmc_tf_pending.length;
			notification_count += response.counseling.length;
			notification_count += response.exit_interview.length;
			notification_count += response.initial_interview.length;
			notification_count += response.post_interview.length;
			$('#noti_Counter').text(notification_count);
		}
	});

	function get_notifications_ajax(){
		$.ajax({
			url: "/admin/get_notifications",
			data: $(this).serialize(),
			dataType: 'json',
			method: 'post',
			success: function(response) {
				$div = $('#notifications').find('div').eq(0);
				$div.empty();
				if (response.cgmc_ojt_pending.length > 0) {
					$div.append(
						$('<h2>').text(response.cgmc_ojt_pending.length + " pending OJT request.").addClass('notification-text')
						.on('click',function(){
							window.location.href = "/admin/cgmc_ojt";
						})
						
					)
				}
				if (response.cgmc_ja_pending.length > 0) {
					$div.append(
						$('<h2>').text(response.cgmc_ja_pending.length + " pending Job application request.").addClass('notification-text')
						.on('click',function(){
							window.location.href = "/admin/cgmc_ja";
						})
					)
				}

				if (response.cgmc_ss_pending.length > 0) {
					$div.append(
						$('<h2>').text(response.cgmc_ss_pending.length + " pending scholarship request.").addClass('notification-text')
						.on('click',function(){
							window.location.href = "/admin/cgmc_ss";
						})
					)
				}

				if (response.cgmc_tf_pending.length > 0) {
					$div.append(
						$('<h2>').text(response.cgmc_tf_pending.length + " pending student transfer request.").addClass('notification-text')
						.on('click',function(){
							window.location.href = "/admin/cgmc_tf";
						})
					)
				}

				if (response.cgmc_ta_pending.length > 0) {
					$div.append(
						$('<h2>').text(response.cgmc_ta_pending.length + " pending TOSA request.").addClass('notification-text')
						.on('click',function(){
							window.location.href = "/admin/cgmc_ta";
						})
					)
				}

				if (response.cgmc_rnur_pending.length > 0) {
					$div.append(
						$('<h2>').text(response.cgmc_rnur_pending.length + " pending competition request.").addClass('notification-text')
						.on('click',function(){
							window.location.href = "/admin/cgmc_rnur";
						})
					)
				}

				$.each(response.counseling,function(k,v){
					$div.append(
						$('<h2>').text("Counceling(" + v.first_name + " " + v.last_name  + ")").addClass('notification-text')
						.on('click',function(){
							window.location.href = "/admin/group_counseling?id=" + v.id;
						})
					)
				});

				$.each(response.exit_interview,function(k,v){
					$div.append(
						$('<h2>').text("Exit Interview(" + v.first_name + " " + v.last_name  + ")").addClass('notification-text')
						.on('click',function(){
							window.location.href = "/admin/appointments/exit_interview?id=" + v.id;
						})
					)
				});

				$.each(response.initial_interview,function(k,v){
					$div.append(
						$('<h2>').text("Initial Interview(" + v.first_name + " " + v.last_name  + ")").addClass('notification-text')
						.on('click',function(){
							window.location.href = "/admin/appointments/initial_interview?id=" + v.id;
						})
					)
				});

				$.each(response.post_interview,function(k,v){
					$div.append(
						$('<h2>').text("Post Interview(" + v.first_name + " " + v.last_name  + ")").addClass('notification-text')
						.on('click',function(){
							window.location.href = "/admin/appointments/post_interview?id=" + v.id;
						})
					)
				});
			}
		});
	}

	$('.btn-add-member').on('click',function(){
		if ($("#gc-member").val() == "") {
			return;
		}

		if ($(".gc-members").length == 4) {
			Swal.fire({
				title: 'Error!',
				text: 'Maximum of 5 members only.',
				icon: 'error',
				showConfirmButton: false,
				  timer: 1500
			})
			return;
		}
		$(".gc-member-list").append(
			$('<input>')
			.attr('type','text')
			.attr('readonly',true)
			.val($("#gc-member").val())
			.addClass("gc-members")
			.attr('name',"gc-members[]")
		);
		$("#gc-member").val("")
	});
})(jQuery);