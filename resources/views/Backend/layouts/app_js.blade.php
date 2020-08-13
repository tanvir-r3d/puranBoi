
    <script type="text/javascript" src="/bower_components/jquery/js/jquery.min.js"></script>
    <script type="text/javascript" src="/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/bower_components/popper.js/js/popper.min.js"></script>
    <script type="text/javascript" src="/bower_components/bootstrap/js/bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="/bower_components/modernizr/js/modernizr.js"></script>
    <!-- Chart js -->
    <script type="text/javascript" src="/bower_components/chart.js/js/Chart.js"></script>
    <!-- amchart js -->
    <script src="/assets/pages/widget/amchart/amcharts.js"></script>
    <script src="/assets/pages/widget/amchart/serial.js"></script>
    <script src="/assets/pages/widget/amchart/light.js"></script>
    <script src="/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="/assets/js/SmoothScroll.js"></script>
    <script src="/assets/js/pcoded.min.js"></script>
    <!-- custom js -->
    <script src="/assets/js/vartical-layout.min.js"></script>
    <script type="text/javascript" src="/assets/pages/dashboard/custom-dashboard.js"></script>
    <script type="text/javascript" src="/assets/js/script.min.js"></script>
    <script type="text/javascript" src="/vendor/jsvalidation/js/jsvalidation.js"></script>

    <script src="/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script type="text/javascript" src="/assets/dropify/dist/js/dropify.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script>
    @foreach ($errors->all() as $error)
    iziToast.warning({
        title: "Warning",
        message: "{{ $error }}",
        position: 'topRight',
    });
    @endforeach

    @if(Session::has('message'))
      var type = "{{ Session::get('alert-type') }}";
      switch(type){
          case 'info':
          iziToast.info({
            title: "{{ Session::get('title') }}",
            message: "{{ Session::get('message') }}",
            position: 'topRight',
        });
              break;

          case 'warning':
              iziToast.warning({
                title: "{{ Session::get('title') }}",
                message: "{{ Session::get('message') }}",
                position: 'topRight',
            });
              break;

          case 'success':
          iziToast.success({
                title: "{{ Session::get('title') }}",
                message: "{{ Session::get('message') }}",
                position: 'topRight',
                });
              break;

          case 'error':
              iziToast.error({
                title: "{{ Session::get('message') }}",
                message: "{{ Session::get('message') }}",
                position: 'topRight',
                });
              break;
      }
    @endif
  </script>

@yield('script')
</body>
</html>
