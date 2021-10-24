@extends("header")
@section("title")
    | MainPage
@endsection()

@section('body')
    <img src="{{ asset("public/img/hug.gif") }}" id="gif">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div id='calendar'></div>
                </div>
            </div>
            <div class="row mt-2">
                <div id="calendarDiv" class="col-12 toroshide">
                    <div class="card">
                        <div class="card-body">
                            <div id='calendar2'></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModal">Create an appointment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ url("/addEvent") }}" id="addEvent">
                                @csrf
                                <div class="form-group">
                                    <label for="fullName" class="col-form-label">*Fullname:</label>
                                    <input type="text" required class="form-control" id="fullName" name="fullName">
                                </div>
                                <div class="form-group">
                                    <label for="eventName" class="col-form-label">*Event Name:</label>
                                    <input type="text" class="form-control" id="eventName" name="eventName">
                                </div>
                                <div class="form-group">
                                    <label for="mail" class="col-form-label">*Mail:</label>
                                    <input type="text" class="form-control" id="mail" name="mail">
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="col-form-label">*Phone:</label>
                                    <input type="text" class="form-control" id="phone" name="phone">
                                </div>
                                <div class="form-group">
                                    <label for="description" class="col-form-label">Description(Optional):</label>
                                    <textarea class="form-control" id="description" name="description"></textarea>
                                </div>
                                <input type="hidden" name="startDate" id="startDate">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" onclick="submForm()" class="btn btn-primary">Make Reservation </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection()

@section('footer')
    <script>
        var calendar2;
        var calendar;
        var today = new Date().toISOString().slice(0,10);

        mainCalendar();

        function mainCalendar()
        {
            var data = '@json($data)';

            data = JSON.parse(data);


            document.addEventListener('DOMContentLoaded', function() {
                var calendarSecond = startSubCalendar()

                var calendarEl = document.getElementById('calendar');
                calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    selectable: true,
                    dayMaxEventRows: 4,
                    select: function(info) {
                        $.ajax({
                            type: "POST",
                            url: "{{ url("getSpecialEvent") }}",
                            data: { date :  info.startStr}, // serializes the form's elements.
                            success: function(data)
                            {
                                if (data != "" && data !== null && data !== undefined)
                                {
                                    if (data < 48)
                                    {
                                        calendarSecond.setOption('visibleRange', {
                                            start: info.startStr,
                                            end: info.startStr
                                        });
                                        $("#calendarDiv").removeClass("toroshide");
                                        $("html, body").animate({ scrollTop: $(document).height() }, "slow");
                                    }
                                    else
                                    {
                                        $("#calendarDiv").addClass("toroshide");
                                        toastr.error("All hours are full.")
                                    }
                                }
                            },
                            error: function (textStatus, errorThrown) {
                                var errors = textStatus.responseJSON.errors;
                                console.log(errors)
                                for(var item in errors) {
                                    toastr.warning(errors[item][0]);
                                }
                            }
                        });
                    },
                    validRange: {
                        start: today
                    },
                    events: [
                            @foreach($data as $datum)
                        {
                            title: '{{ $datum->eventName }}',
                            start: '{{ $datum->startDate }}',
                            end: '{{ $datum->endDate }}',
                            description: '{{ $datum->description }}',
                        },
                            @endforeach()
                            @foreach ($dateRange as $key=>$date)

                        {
                            start: "{{ $key }}",
                            end: "{{ $key }}",
                            overlap: false,
                            display: 'background',
                            color: "{{ $date >= 48 ? "red" : "green" }}"
                        },

                        @endforeach()
                    ],
                });
                calendar.render();
            });
        }


        function startSubCalendar()
        {
            var calendarEl2 = document.getElementById('calendar2');
            calendar2 = new FullCalendar.Calendar(calendarEl2, {
                selectable: true,
                initialView: 'timeGrid',
                visibleRange: {
                    start: "2021-10-18",
                    end: "2021-10-18"
                },
                headerToolbar: {
                    left: '',
                    center: 'title',
                    right: ''
                },
                select: function(info) {
                    if (info.allDay == false)
                        modalOpen(info);
                },
                events: [
                        <?php foreach ($data as $datum) { ?>
                    {
                        title: '<?php echo $datum->eventName; ?>',
                        start: '{{ $datum->startDate }}',
                        end: '{{ $datum->endDate }}',
                        description: '2016-09-10'
                    },
                    <?php } ?>
                ],
            });

            calendar2.render();

            return calendar2;
        }

        function modalOpen(data)
        {
            $("#startDate").val(data.startStr);
            $('#detailModal').modal('show');
        }

        function modalClose()
        {
            $("#startDate").val(" ");
            $('#detailModal').modal('hide');
        }

        function submForm()
        {

            var form = $("#addEvent");
            var url = form.attr('action');

            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if (data != "" && data !== null && data !== undefined)
                    {
                        if (data.error != "undefined" && data.error == 1)
                        {
                            toastr.error(data.msg);
                            return false;
                        }
                        var parsedData = JSON.parse(data);
                        $('#detailModal').modal('hide');
                        calendar.addEvent(parsedData);
                        calendar2.addEvent(parsedData);
                        toastr.success("Your reservation has been created.")
                    }
                },
                error: function (textStatus, errorThrown) {
                    var errors = textStatus.responseJSON.errors;
                    console.log(errors)
                    for(var item in errors) {
                        toastr.warning(errors[item][0]);
                    }
                }
            });


        }
    </script>
@endsection
