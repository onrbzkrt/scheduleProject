    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src='{{ asset("public/js/popper.min.js") }}'></script>
    <script src='{{ asset("public/js/moment.js") }}'></script>
    <script src='{{ asset("public/js/bootstrap.min.js") }}'></script>
    <script src='{{ asset("public/js/main.js") }}'></script>
    <script src='{{ asset("public/js/toastr.js") }}'></script>

    <script>
        $( document ).ready(function() {
            $("#gif").addClass("d-none");
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $("#gif").removeClass("d-none");
            },
            complete: function() {
                $("#gif").addClass("d-none");
            }
        });

    </script>
