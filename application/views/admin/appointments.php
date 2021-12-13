<div class="appointment-modal custom-modal modal-style-2">
    <div class="modal-wrap">
        <div class="modal-box">
            <div class="modal-content">
                <!--  -->
                <h2 class="text-center div-title">Group Counseling Appointments</h2>
                <h4 class="text-center"><i class="requested-date"></i></h4>
                <h4><span class="requested-time"></span></h4>
                <div data-request-id="" class="my-request-id">
                    <div class="mb-5 form-group" style="margin-left: 20%;">
                        <label>Requestor : </label> &nbsp;<label class="requester-name"></label>
                    </div>
                    </br>
                    <div class="form-group exit-form-group">
                        <div class="label"><strong>Exit Form : </strong></div>
                        <label class="btn-attach exit-form" for="exit-form" title="Attach file here"></label>
                    </div>
                    <div class="form-group exit-questionnaire-group">
                        <div class="label"><strong>Exit Questionnaire : </strong></div>
                        <label class="btn-attach exit-questionnaire" for="exit-questionnaire" title="Attach file here"></label>
                    </div>

                    <div class="form-group valid-id-group">
                        <div class="label"><strong>Valid ID of Parent/Guardian : </strong></div>
                        <label class="btn-attach valid-id" for="valid-id" title="Attach file here"></label>
                    </div>
                    <div class="form-group registration-form-group">
                        <div class="label"><strong>Registration Form : </strong></div>
                        <label class="btn-attach registration-form" for="registration-form" title="Attach file here"></label>
                    </div>
                    <div class="form-group coc-form-group">
                        <div class="label"><strong>Certificate of Completion : </strong></div>
                        <label class="btn-attach coc-form" for="coc-form" title="Attach file here"></label>
                    </div>

                    <div class="form-group">
                        <div class="label"><strong>Remarks : </strong></div>
                        <input type="text" name="txt-remarks" class="txt-remarks" style="border: none; border-bottom: 2px solid red; width:85%;"/>
                    </div>
                </div>
                <div class="text-right">
                    <button class="btn btn-green btn-small btn-confirm" type="button">Confirm</button>
                    <button class="btn btn-red btn-small btn-reject" type="button">Reject</button>
                </div>
                <!--  -->
            </div>
        </div>
    </div>
    <div class="modal-bg-overlay"></div>
</div> 

<style>
    .my-header-title{
        background: white;
        border-radius: 19px;
        padding: 8px;
        margin-bottom: 10px;
    }

    .my-main-container {
        background: #eaeaea;
        margin: 0 auto;
        width: 80%;
        /* padding: 5px; */
        padding-left: 5px;
        padding-right: 5px;
        padding-bottom: 5px;
        border-radius: 19px;
    }

    .my-calendar {
        background:white;
    }
</style>
<div class="my-main-container">
    <h2 class="text-center my-header-title"></h2>
    <div id='calendar' class="my-calendar" ></div>
<div>

<script>
    var calendar;
    var appointment_type = '<?php echo $appointment_type; ?>';
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            contentHeight: 500,
            events: {
                url: '/admin/get_group_counceling?type=<?php echo $appointment_type; ?>',
            },
            eventClick: function(info) {
                calendar_elem = info.el;
                // alert('Event: ' + info.event.title);
                // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                // alert('View: ' + info.event.id);

                // change the border color just for fun
                info.el.style.borderColor = 'red';
                $('.requester-name').text(info.event.title);
                $('.my-request-id').attr('data-request-id',info.event.id);
                
                $('.gc-members').empty();
                $('.gc-members').append(info.event.extendedProps.members);
                if (info.event.extendedProps.status != "pending"){
                    $('.txt-remarks').val(info.event.extendedProps.remarks);
                    $('.txt-remarks').attr('disabled','disabled');
                    $('.btn-confirm').hide();
                    $('.btn-reject').hide();
                }else {
                    $('.txt-remarks').val("");
                    $('.txt-remarks').removeAttr('disabled');
                    $('.btn-confirm').show();
                    $('.btn-reject').show();
                }
                $('body').addClass('modal-open');
                $('.appointment-modal').fadeIn(300);

                $('.exit-form-group').hide();
                $('.exit-questionnaire-group').hide();
                $('.valid-id-group').hide();
                $('.registration-form-group').hide();
                $('.coc-form-group').hide();

                appointment_date = new Date(info.event.extendedProps.appointment_date);

                $(".requested-date").text(appointment_date.toDateString());
                $(".requested-time").text(appointment_date.toLocaleTimeString());

                if (info.event.extendedProps.exit_form != "") {
                    $('.exit-form-group').show();
                    $(".exit-form").text(info.event.extendedProps.exit_form);
                }

                if (info.event.extendedProps.exit_questionnaire != "") {
                    $('.exit-questionnaire-group').show();
                    $(".exit-questionnaire").text(info.event.extendedProps.exit_questionnaire);
                }

                if (info.event.extendedProps.valid_id != "") {
                    $('.valid-id-group').show();
                    $(".valid-id").text(info.event.extendedProps.valid_id);
                }

                if (info.event.extendedProps.registration_form != "") {
                    $('.registration-form-group').show();
                    $(".registration-form").text(info.event.extendedProps.registration_form);
                }

                if (info.event.extendedProps.certificate_of_completion != "") {
                    $('.coc-form-group').show();
                    $(".coc-form").text(info.event.extendedProps.certificate_of_completion);
                }

                $('.exit-form').unbind('click').on('click',function(){
                    $('.view-file-modal').fadeIn(300);
                    $('.view-file-modal iframe').attr('src',info.event.extendedProps.exit_form_url);
                });

                $('.exit-questionnaire').unbind('click').on('click',function(){
                    $('.view-file-modal').fadeIn(300);
                    $('.view-file-modal iframe').attr('src',info.event.extendedProps.exit_questionnaire_url);
                });

                $('.valid-id').unbind('click').on('click',function(){
                    $('.view-file-modal').fadeIn(300);
                    $('.view-file-modal iframe').attr('src',info.event.extendedProps.valid_id_url);
                });

                $('.registration-form').unbind('click').on('click',function(){
                    $('.view-file-modal').fadeIn(300);
                    $('.view-file-modal iframe').attr('src',info.event.extendedProps.registration_form_url);
                });

                $('.coc-form').unbind('click').on('click',function(){
                    $('.view-file-modal').fadeIn(300);
                    $('.view-file-modal iframe').attr('src',info.event.extendedProps.certificate_of_completion_url);
                });

                // var target = $(this).data('target');
                // // console.log('test');
                // $('.view-file-modal').fadeIn(300);
                // $('.view-file-modal iframe').attr('src', target);
                
            },
            eventColor: '#afa726',
            loading: function( isLoading ) {
                if (isLoading == true) {
                    //show your loader
                } else {
                    setTimeout(loadCurrentEvent, 3000);
                }
            },
            eventTimeFormat: { // like '14:30:00'
                hour: '2-digit',
                minute: '2-digit',
                meridiem: true
            }
        });
        calendar.render();
        if (appointment_type == "exit_interview"){
            $('.div-title').text("Exit Interview");
            $(".my-header-title").text("Exit Interview");
        }else if (appointment_type == "initial_interview"){
            $('.div-title').text("OJT Initial Interview");
            $(".my-header-title").text("OJT Initial Interview");
        }else{
            $('.div-title').text("OJT Post Interview");
            $(".my-header-title").text("OJT Post Interview");
        }
    });

    function loadCurrentEvent(){
        const urlParams = new URLSearchParams(window.location.search);
        const myParam = urlParams.get('id');
        events = calendar.getEvents();
        for (x = 0;x<events.length;x++) {
            info = events[x]._def;
            if (events[x]._def.publicId == myParam){
                $('.requester-name').text(info.title);
                $('.my-request-id').attr('data-request-id',info.publicId);
                $('.gc-members').empty();
                $('.gc-members').append(info.extendedProps.members);
                if (info.extendedProps.status != "pending"){
                    $('.txt-remarks').val(info.extendedProps.remarks);
                    $('.txt-remarks').attr('disabled','disabled');

                    $('.btn-confirm').hide();
                    $('.btn-reject').hide();
                }else {
                    $('.txt-remarks').val("");
                    $('.txt-remarks').removeAttr('disabled');
                    $('.btn-confirm').show();
                    $('.btn-reject').show();
                }
                $('body').addClass('modal-open');
                $('.appointment-modal').fadeIn(300);

                $('.exit-form-group').hide();
                $('.exit-questionnaire-group').hide();
                $('.registration-form-group').hide();
                $('.coc-form-group').hide();

                appointment_date = new Date(info.extendedProps.appointment_date);

                $(".requested-date").text(appointment_date.toDateString());
                $(".requested-time").text(appointment_date.toLocaleTimeString());

                if (info.extendedProps.exit_form != "") {
                    $('.exit-form-group').show();
                    $(".exit-form").text(info.extendedProps.exit_form);
                }

                if (info.extendedProps.exit_questionnaire != "") {
                    $('.exit-questionnaire-group').show();
                    $(".exit-questionnaire").text(info.extendedProps.exit_questionnaire);
                }

                if (info.extendedProps.registration_form != "") {
                    $('.registration-form-group').show();
                    $(".registration-form").text(info.extendedProps.registration_form);
                }

                if (info.extendedProps.certificate_of_completion != "") {
                    $('.coc-form-group').show();
                    $(".coc-form").text(info.extendedProps.certificate_of_completion);
                }

                if (info.extendedProps.valid_id != "") {
                    $('.valid-id-group').show();
                    $(".valid-id").text(info.extendedProps.valid_id);
                }

                $('.exit-form').unbind('click').on('click',function(){
                    $('.view-file-modal').fadeIn(300);
                    $('.view-file-modal iframe').attr('src',info.extendedProps.exit_form_url);
                });

                $('.exit-questionnaire').unbind('click').on('click',function(){
                    $('.view-file-modal').fadeIn(300);
                    $('.view-file-modal iframe').attr('src',info.extendedProps.exit_questionnaire_url);
                });

                $('.registration-form').unbind('click').on('click',function(){
                    $('.view-file-modal').fadeIn(300);
                    $('.view-file-modal iframe').attr('src',info.extendedProps.registration_form_url);
                });

                $('.valid-id').unbind('click').on('click',function(){
                    $('.view-file-modal').fadeIn(300);
                    $('.view-file-modal iframe').attr('src',info.extendedProps.valid_id_url);
                });

                $('.coc-form').unbind('click').on('click',function(){
                    $('.view-file-modal').fadeIn(300);
                    $('.view-file-modal iframe').attr('src',info.extendedProps.certificate_of_completion_url);
                });
            }
        }
    }
</script>