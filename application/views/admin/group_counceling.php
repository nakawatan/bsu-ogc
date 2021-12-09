<div class="appointment-modal custom-modal modal-style-2">
    <div class="modal-wrap">
        <div class="modal-box">
            <div class="modal-content">
                <!--  -->
                <h2 class="text-center">Group Counseling Appointments</h2>
                <h4 class="text-center"><i class="requested-date"></i></h4>
                <h4><span class="requested-time"></span></h4>
                <div data-request-id="" class="my-request-id">
                </div>
                <!-- <div class="mb-5 form-group" style="margin-left: 20%;">
                    <label> </label> <label class="requester-name"></label>
                </div> -->
                <!-- <div class="form-group" style="margin-left: 20%;">
                    <label>Members: </label>
                    <label class="">
                    </label>
                </div> -->
                <table style="text-align:left;border: none !important; width:80%;margin-left:20%;">
                    <tr style="text-align:left;border: none !important;">
                        <th style="border-bottom:0px !important;width: 100px;">Requestor :</th>
                        <th class="requester-name" style="border-bottom:0px !important">test Name</th>
                    </tr>
                    <tr>
                        <th style="vertical-align: top;border-bottom:0px !important">Members : </th>
                        <th class="gc-members" style="vertical-align: top;border-bottom:0px !important"></th>
                    </tr>
                </table>

                <div class="form-group">
                    <div class="label"><strong>Remarks : </strong></div>
                    <input type="text" name="txt-remarks" class="txt-remarks" style="border: none; border-bottom: 2px solid red; width:85%"/>
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
    <h2 class="text-center my-header-title">Group Counseling</h2>
    <div id='calendar' class="my-calendar" ></div>
<div>

<script>
    var calendar;
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            contentHeight: 500,
            events: {
                url: '/admin/get_group_counceling',
            },
            eventClick: function(info) {
                calendar_elem = info.el;

                // alert('Event: ' + info.event.title);
                // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                // alert('View: ' + info.event.id);

                // change the border color just for fun
                $('.requester-name').text(info.event.title);
                $('.my-request-id').attr('data-request-id',info.event.id);
                console.log(info.event.members);

                appointment_date = new Date(info.event.extendedProps.appointment_date);

                $(".requested-date").text(appointment_date.toDateString());
                $(".requested-time").text(appointment_date.toLocaleTimeString());
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

                appointment_date = new Date(info.extendedProps.appointment_date);

                $(".requested-date").text(appointment_date.toDateString());
                $(".requested-time").text(appointment_date.toLocaleTimeString());
                $('body').addClass('modal-open');
                $('.appointment-modal').fadeIn(300);
            }
        }
    }
</script>