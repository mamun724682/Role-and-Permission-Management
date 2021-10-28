<!-- jquery latest version -->
<script src="{{ asset('backend/js/vendor/jquery-2.2.4.min.js') }}"></script>
<!-- bootstrap 4 js -->
<script src="{{ asset('backend/js/popper.min.js') }}"></script>
<script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('backend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('backend/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('backend/js/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('backend/js/jquery.slicknav.min.js') }}"></script>

<!-- start chart js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
<!-- start highcharts js -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<!-- start zingchart js -->
<script src="https://cdn.zingchart.com/zingchart.min.js"></script>
<script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
</script>
<!-- all line chart activation -->
<script src="{{ asset('backend/js/line-chart.js') }}"></script>
<!-- all pie chart -->
<script src="{{ asset('backend/js/pie-chart.js') }}"></script>
<!-- others plugins -->
<script src="{{ asset('backend/js/plugins.js') }}"></script>
<script src="{{ asset('backend/js/scripts.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
<script>
        @if(Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}";
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;

                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;

                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;

                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
</script>
