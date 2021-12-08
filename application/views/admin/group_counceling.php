<div class="appointment-modal custom-modal modal-style-2">
    <div class="modal-wrap">
        <div class="modal-box">
            <div class="modal-content">
                <!--  -->
                <h2 class="text-center">Group Counseling Appointments</h2>
                <div data-request-id="" class="my-request-id">
                    <div class="mb-5 form-group">
                        <label>Requestor : </label> <span class="requester-name"></span>
                    </div>
                    <div class="mb-5 form-group">
                        <label>Date : </label> <span class="requested-date"></span>
                    </div>
                    <div class="mb-5 form-group">
                        <label>Time : </label> <span class="requested-time"></span>
                    </div>
                    </br>
                    <div class="status-icon">
                        <!-- <span class="times-icon txt-red"><i class="fas fa-times visible" aria-hidden="true"></i></span>
                        <span class="check-icon txt-green"><i class="fas fa-check" aria-hidden="true"></i></span> -->
                    </div>
                </div>
                <label>Members: </label>
                <div class="gc-members">
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

<div id='calendar'></div>

<script>
    var calendar;
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
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
                    $('.btn-confirm').hide();
                    $('.btn-reject').hide();
                }else {
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
                    $('.btn-confirm').hide();
                    $('.btn-reject').hide();
                }else {
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