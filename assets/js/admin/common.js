(function($){
    $(document).ready(function(){
        $('.table-wrap').on('click', 'tr', function(){
            var target = $(this).data('target');
            if(target) {
                $('.update-form-modal .modal-body').load(target);
                $('body').addClass('modal-open');
                $('.update-form-modal').fadeIn(300);
            }
        });
        $('.update-form-modal').on('click', '.btn-attach', function(){
            var target = $(this).data('target');
            // console.log('test');
            $('.view-file-modal').fadeIn(300);
            $('.view-file-modal iframe').attr('src', target);
        });
        $('.update-form-modal').on('click', '.btn-approved', function(){
            var target = $(this).data('input'),
                id = target.replace("_status", "");
            $('.update-form-modal input[name='+target+']').val('approved');
            $('.update-form-modal .approved.txt-green[data-target='+target+']').removeClass('hide');
            $('.update-form-modal .approved.txt-red[data-target='+target+']').addClass('hide');
            // $('.update-form-modal .btn-pending[data-input='+target+']').show();
            // $(this).hide();
            // $(this).parents().find('label[for='+id+']').after('test');
        });
        $('.update-form-modal').on('click', '.btn-pending', function(){
            var target = $(this).data('input'),
                id = target.replace("_status", "");
            $('.update-form-modal input[name='+target+']').val('pending');
            $('.update-form-modal label[for='+id+']').next('.approved').remove();
            $('.update-form-modal .btn-approved[data-input='+target+']').show();
            $(this).hide();
        });
        $('.update-form-modal').on('click', '.btn-reject', function(){
            var target = $(this).data('input');
            $('.update-form-modal input[name='+target+']').val('reject');
            // $('.update-form-modal label[for='+id+']').next('.approved').remove();
            $('.update-form-modal .approved.txt-red[data-target='+target+']').removeClass('hide');
            $('.update-form-modal .approved.txt-green[data-target='+target+']').addClass('hide');
            // $('.update-form-modal .btn-pending[data-input='+target+']').hide();
            // $('.update-form-modal .btn-approved[data-input='+target+']').show();
        });
        $('.update-form-modal').on('submit', '#update_cgmc_ojt', function(e){
            e.preventDefault();
            var form     = $(this)[0],
                formData = new FormData(form);
            $.ajax({
                url: $(this).attr('action'),
                data: formData,
                method: 'POST',
                contentType: false,
                processData: false,
                cache: false,
                success: function(response) {
                    var request_id = $('.update-form-modal').find('input[name=request_id]').val(),
                        student_id = $('.update-form-modal').find('input[name=student_id]').val(),
                        cgmc_type = $('.update-form-modal').find('input[name=cgmc_type]').val(),
                        registration_form_status = $('.update-form-modal').find('input[name=registration_form_status]').val(),
                        cgmc_form_status = $('.update-form-modal').find('input[name=cgmc_form_status]').val(),
                        career_advising_status = $('.update-form-modal').find('input[name=career_advising_status]').val();

                    $('.cgmc-file-modal').find('input[name=request_id]').val(request_id);
                    $('.cgmc-file-modal').find('input[name=student_id]').val(student_id);
                    $('.cgmc-file-modal').find('input[name=cgmc_type]').val(cgmc_type);

                    if(registration_form_status == 'approved' && cgmc_form_status == 'approved' && career_advising_status == 'approved'){
                        $('.cgmc-file-modal').fadeIn(300);
                    }else{
                        Swal.fire({
                            title: 'Save!',
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
        $('.update-form-modal').on('submit', '#update_cgmc_ja', function(e){
            e.preventDefault();
            var form     = $(this)[0],
                formData = new FormData(form);
            $.ajax({
                url: $(this).attr('action'),
                data: formData,
                method: 'POST',
                contentType: false,
                processData: false,
                cache: false,
                success: function(response) {
                    var request_id = $('.update-form-modal').find('input[name=request_id]').val(),
                        student_id = $('.update-form-modal').find('input[name=student_id]').val(),
                        cgmc_type = $('.update-form-modal').find('input[name=cgmc_type]').val(),
                        receipt_number_status = $('.update-form-modal').find('input[name=receipt_number_status]').val(),
                        tor_status = $('.update-form-modal').find('input[name=tor_status]').val();

                    $('.cgmc-file-modal').find('input[name=request_id]').val(request_id);
                    $('.cgmc-file-modal').find('input[name=student_id]').val(student_id);
                    $('.cgmc-file-modal').find('input[name=cgmc_type]').val(cgmc_type);

                    if(receipt_number_status == 'approved' && tor_status == 'approved'){
                        $('.cgmc-file-modal').fadeIn(300);
                    }else{
                        Swal.fire({
                            title: 'Save!',
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
        $('.update-form-modal').on('submit', '#update_cgmc_ss', function(e){
            e.preventDefault();
            var form     = $(this)[0],
                formData = new FormData(form);
            $.ajax({
                url: $(this).attr('action'),
                data: formData,
                method: 'POST',
                contentType: false,
                processData: false,
                cache: false,
                success: function(response) {
                    var request_id = $('.update-form-modal').find('input[name=request_id]').val(),
                        student_id = $('.update-form-modal').find('input[name=student_id]').val(),
                        cgmc_type = $('.update-form-modal').find('input[name=cgmc_type]').val(),
                        receipt_number_status = $('.update-form-modal').find('input[name=receipt_number_status]').val(),
                        application_form_status = $('.update-form-modal').find('input[name=application_form_status]').val(),
                        registration_form_status = $('.update-form-modal').find('input[name=registration_form_status]').val(),
                        grades_from_prev_status = $('.update-form-modal').find('input[name=grades_from_prev_status]').val();

                    $('.cgmc-file-modal').find('input[name=request_id]').val(request_id);
                    $('.cgmc-file-modal').find('input[name=student_id]').val(student_id);
                    $('.cgmc-file-modal').find('input[name=cgmc_type]').val(cgmc_type);

                    if(receipt_number_status == 'approved' && application_form_status == 'approved' && registration_form_status == 'approved' && grades_from_prev_status == 'approved'){
                        $('.cgmc-file-modal').fadeIn(300);
                    }else{
                        Swal.fire({
                            title: 'Save!',
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
        $('.update-form-modal').on('submit', '#update_cgmc_tf', function(e){
            e.preventDefault();
            var form     = $(this)[0],
                formData = new FormData(form);
            $.ajax({
                url: $(this).attr('action'),
                data: formData,
                method: 'POST',
                contentType: false,
                processData: false,
                cache: false,
                success: function(response) {
                    var request_id = $('.update-form-modal').find('input[name=request_id]').val(),
                        student_id = $('.update-form-modal').find('input[name=student_id]').val(),
                        cgmc_type = $('.update-form-modal').find('input[name=cgmc_type]').val(),
                        receipt_number_status = $('.update-form-modal').find('input[name=receipt_number_status]').val(),
                        exit_interview_form_status = $('.update-form-modal').find('input[name=exit_interview_form_status]').val();

                    $('.cgmc-file-modal').find('input[name=request_id]').val(request_id);
                    $('.cgmc-file-modal').find('input[name=student_id]').val(student_id);
                    $('.cgmc-file-modal').find('input[name=cgmc_type]').val(cgmc_type);

                    if(receipt_number_status == 'approved' && exit_interview_form_status == 'approved'){
                        $('.cgmc-file-modal').fadeIn(300);
                    }else{
                        Swal.fire({
                            title: 'Save!',
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
        $('.update-form-modal').on('submit', '#update_cgmc_ta', function(e){
            e.preventDefault();
            var form     = $(this)[0],
                formData = new FormData(form);
            $.ajax({
                url: $(this).attr('action'),
                data: formData,
                method: 'POST',
                contentType: false,
                processData: false,
                cache: false,
                success: function(response) {
                    var request_id = $('.update-form-modal').find('input[name=request_id]').val(),
                        student_id = $('.update-form-modal').find('input[name=student_id]').val(),
                        cgmc_type = $('.update-form-modal').find('input[name=cgmc_type]').val(),
                        receipt_number_status = $('.update-form-modal').find('input[name=receipt_number_status]').val(),
                        tosa_app_form_of_scholarship_status  = $('.update-form-modal').find('input[name=tosa_app_form_of_scholarship_status ]').val(),
                        registration_status  = $('.update-form-modal').find('input[name=registration_status ]').val(),
                        proof_of_app_of_ha_status  = $('.update-form-modal').find('input[name=proof_of_app_of_ha_status ]').val();

                    $('.cgmc-file-modal').find('input[name=request_id]').val(request_id);
                    $('.cgmc-file-modal').find('input[name=student_id]').val(student_id);
                    $('.cgmc-file-modal').find('input[name=cgmc_type]').val(cgmc_type);

                    if(receipt_number_status == 'approved' && tosa_app_form_of_scholarship_status == 'approved' && registration_status == 'approved' && proof_of_app_of_ha_status == 'approved'){
                        $('.cgmc-file-modal').fadeIn(300);
                    }else{
                        Swal.fire({
                            title: 'Save!',
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
        $('.update-form-modal').on('submit', '#update_cgmc_rnur', function(e){
            e.preventDefault();
            var form     = $(this)[0],
                formData = new FormData(form);
            $.ajax({
                url: $(this).attr('action'),
                data: formData,
                method: 'POST',
                contentType: false,
                processData: false,
                cache: false,
                success: function(response) {
                    var request_id = $('.update-form-modal').find('input[name=request_id]').val(),
                        student_id = $('.update-form-modal').find('input[name=student_id]').val(),
                        cgmc_type = $('.update-form-modal').find('input[name=cgmc_type]').val(),
                        registration_form_status = $('.update-form-modal').find('input[name=registration_form_status]').val();

                    $('.cgmc-file-modal').find('input[name=request_id]').val(request_id);
                    $('.cgmc-file-modal').find('input[name=student_id]').val(student_id);
                    $('.cgmc-file-modal').find('input[name=cgmc_type]').val(cgmc_type);

                    if(registration_form_status == 'approved'){
                        $('.cgmc-file-modal').fadeIn(300);
                    }else{
                        Swal.fire({
                            title: 'Save!',
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
        $('.cgmc-file-modal').on('submit', 'form', function(e){
            e.preventDefault();
            var form     = $(this)[0],
                formData = new FormData(form);
            $.ajax({
                url: $(this).attr('action'),
                data: formData,
                method: 'POST',
                contentType: false,
                processData: false,
                cache: false,
                success: function(response) {
                    // console.log(response);
                    if(response.error){
                        if(response.fields.cgmc_file.message){
                            Swal.fire({
                                title: 'Error!',
                                text: response.fields.cgmc_file.message,
                                icon: 'error',
                                showConfirmButton: true,
                            });
                        }    
                    }else{
                        Swal.fire({
                            title: 'Success!',
                            text: 'Certification of Good moral character has been sent successfully',
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
        $('#student-cgmc-file').on('change', function(){
            var id = $(this).attr('id'),
                filename = $(this).val().replace(/C:\\fakepath\\/i, '');
            $('.btn[for='+id+']').text(filename);
            $('.btn[for='+id+']').attr('title',filename);
            // console.log(id);
        });
        $('.form-select').click(function(){
            $('.select-items').hide();
            $('.select-items', this).show();
        });
        $('body').click(function(e){   
            if(e.target.class == "form-select")
            return;

            if($(e.target).closest('.form-select').length)
            return;             

            $('.select-items').hide();
        });
        $('#settings').submit(function(e){
            e.preventDefault();
            var form     = $(this)[0],
                formData = new FormData(form);
            $.ajax({
                url: site_params.base_url+'admin/settings',
                data: formData,
                contentType: false,
                processData: false,
                cache: false,
                method: 'POST',
                success: function(response) {
                    Swal.fire({
                        title: 'Save!',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function(){
                        location.reload();
                    });
                }
            });
        });
        $('.btn-settings').on('click', function(e){
            e.preventDefault();
            $('body').addClass('modal-open');
            $('.settings-modal').fadeIn(300);
        });
        $('.btn-days').on('click', '.btn', function(e){
            e.preventDefault();
            var target = $(this).attr('href');
            $('.appointment-modal .modal-content').load(target);
            $('body').addClass('modal-open');
            $('.appointment-modal').fadeIn(300);
        });

        var clicks = 0;
        $('#settings').on('click', '.banner_add', function(){
            let i = clicks++;
            $('.banner-list').prepend('<div class="banner-item d-flex hide"><div class="banner-thumb"><input type="file" name="banner_new_'+i+'" class="banner-new hide"><img src="" alt=""></div><button type="button" class="btn-icon btn-delete btn-delete-new"><i class="fas fa-times-circle"></i></button></div>');
            $('.banner-list>.banner-item:first-child input[type=file]').click();
        });

        $('#settings').on('change', 'input[type=file]', function(){
            let input = $(this),
                file = input.prop('files')[0],
                file_name = file['name'],
                ext = file_name.substr( (file_name.lastIndexOf('.') +1) );
            if (file && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    input.next('img').attr('src', e.target.result);
                    $('.banner-list>.banner-item:first-child').removeClass('hide');
                }
                reader.readAsDataURL(file);
            } else{
                alert('Please check file extension');
            }
        });

        $('#settings').on('click', '.btn-plain', function(){
            $('.setting-announcement').show();
            $('.setting-appointments').hide();
        });

        $('#settings').on('click', '.btn-delete-new', function(){
            $(this).parents('.banner-item').remove();
        });

        $('#settings').on('click', '.btn-delete-banner', function(){
            var id = $(this).data('id');
            Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.isConfirmed) {
                $(this).parents('.banner-item').remove();
                $.ajax({
                    url: site_params.base_url+'admin/delete_banner',
                    data: {id : id},
                    method: 'POST',
                    success: function(response) {
                        Swal.fire(
                          'Deleted!',
                          'Your file has been deleted.',
                          'success'
                        )
                    }
                });
              }
            });
        });

        $('.appointment-modal:not(.appointment-type)').on('click', '.btn-confirm', function(e){
            e.preventDefault();
            var form     = $(this).parents('.data-group'),
                formData = form.serialize();
            
            $.ajax({
                url: '/admin/update_group_counceling_v2',
                data: {
                    "request_id":$('.my-request-id').attr('data-request-id'),
                    "status":"approved",
                },
                method: 'POST',
                success: function(response) {
                    $('body').removeClass('modal-open');
                    $('.appointment-modal').fadeOut(300);
                    Swal.fire({
                        title: 'Save!',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function(){
                        form.find('button').prop("disabled", true);
                        form.find('.check-icon').removeClass('hide');
                    });
                }
            });
        });

        $('.appointment-modal:not(.appointment-type)').on('click', '.btn-reject', function(e){
            e.preventDefault();
            var form     = $(this).parents('.data-group'),
                formData = form.serialize();
            
            $.ajax({
                url: '/admin/update_group_counceling_v2',
                data: {
                    "request_id":$('.my-request-id').attr('data-request-id'),
                    "status":"approved",
                },
                method: 'POST',
                success: function(response) {
                    $('body').removeClass('modal-open');
                    $('.appointment-modal').fadeOut(300);
                    Swal.fire({
                        title: 'Save!',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function(){
                        form.find('button').prop("disabled", true);
                        form.find('.times-icon').removeClass('hide');
                    });
                }
            });
        });

        $('.appointment-type').on('click', '.btn-confirm[data-request-id]', function(e){
            e.preventDefault();
            var form     = $(this),
                formData = [{name: 'request_id', value: form.data('request-id')}];
            $.ajax({
                url: site_params.base_url+'admin/update_appointment_request/approved',
                data: formData,
                method: 'POST',
                success: function(response) {
                    console.log(response);
                    Swal.fire({
                        title: 'Save!',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function(){
                        form.parents('.appointment-item').find('button').prop("disabled", true);
                        form.parents('.appointment-item').find('.check-icon').removeClass('hide');
                    });
                }
            });
        });

        $('.appointment-type').on('click', '.btn-reject[data-request-id]', function(e){
            e.preventDefault();
            var form     = $(this),
                formData = [{name: 'request_id', value: form.data('request-id')}];
            $.ajax({
                url: site_params.base_url+'admin/update_appointment_request/reject',
                data: formData,
                method: 'POST',
                success: function(response) {
                    console.log(response);
                    Swal.fire({
                        title: 'Save!',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function(){
                        form.parents('.appointment-item').find('button').prop("disabled", true);
                        form.parents('.appointment-item').find('.times-icon').removeClass('hide');
                    });
                }
            });
        });

        $('#tab-forms').on('click','.btn-primary', function(e){
            e.preventDefault();
            $('.forms-modal').fadeIn(300);
        });

        $('.forms-modal').on('submit', '.form-validate', function(e){
            e.preventDefault();
            var form     = $(this)[0],
                formData = new FormData(form);

            $('.forms-modal .error').remove();    
            $.ajax({
                url: $(this).attr('action'),
                data: formData,
                method: 'POST',
                contentType: false,
                processData: false,
                cache: false,
                success: function(response) {
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
                        Swal.fire({
                            title: 'Success!',
                            text: 'Successfully Added!',
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

        $('#tab-forms').on('click', '.btn-delete', function(){
            var id = $(this).data('id');
            Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.isConfirmed) {
                $(this).parents('.form-file-item').remove();
                $.ajax({
                    url: site_params.base_url+'admin/delete_form_file',
                    data: {id : id},
                    method: 'POST',
                    success: function(response) {
                        Swal.fire(
                          'Deleted!',
                          'Your file has been deleted.',
                          'success'
                        )
                    }
                });
              }
            });
        });
    });
})(jQuery);