<div class="appointment-modal custom-modal modal-style-2">
    <div class="modal-wrap">
        <div class="modal-box">
            <div class="modal-content">
                <!--  -->
                <h2 class="text-center div-title">Group Counseling Appointments</h2>
                <div data-request-id="" class="my-request-id d-flex">
                    <div>
                        <label>Requestor : </label> <span class="requester-name"></span>
                    </div>
                    </br>
                    <div class="status-icon">
                        <!-- <span class="times-icon txt-red"><i class="fas fa-times visible" aria-hidden="true"></i></span>
                        <span class="check-icon txt-green"><i class="fas fa-check" aria-hidden="true"></i></span> -->
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

<div id='calendar'></div>

<script>
    var calendar;
    var appointment_type = '<?php echo $appointment_type; ?>';
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
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
                console.log(info.event.members);
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
        if (appointment_type == "exit_interview"){
            $('.div-title').text("Exit Interview");
        }else if (appointment_type == "initial_interview"){
            $('.div-title').text("OJT Initial Interview");
        }else{
            $('.div-title').text("OJT Post Interview");
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
                    $('.btn-confirm').hide();
                    $('.btn-reject').hide();
                }else {
                    $('.btn-confirm').show();
                    $('.btn-reject').show();
                }
                $('body').addClass('modal-open');
                $('.appointment-modal').fadeIn(300);
            }
        }
    }
</script>