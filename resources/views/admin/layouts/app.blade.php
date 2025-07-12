{{-- resources/views/admin/layouts/app.blade.php --}}
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name') }} | Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link rel="icon" href="images/favicon.ico" type="image/ico">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <!-- Load compiled CSS from Laravel Mix -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" />

    <!-- Admin Theme CSS -->
    <link href="{{ asset('assets/admin/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/style.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/style-responsive.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/invoice-print.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/theme/default.css') }}" rel="stylesheet" id="theme" />
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="{{ asset('assets/admin/plugins/jquery-jvectormap/jquery-jvectormap.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/ionRangeSlider/css/ion.rangeSlider.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/ionRangeSlider/css/ion.rangeSlider.skinNice.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/password-indicator/css/password-indicator.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/bootstrap-combobox/css/bootstrap-combobox.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/jquery-tag-it/css/jquery.tagit.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/parsley/src/parsley.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
    <link
        href="{{ asset('assets/admin/plugins/bootstrap-eonasdan-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-fontawesome.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-glyphicons.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/DataTables/media/css/dataTables.bootstrap.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/bootstrap-wizard/css/bwizard.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/bootstrap-wysihtml5/dist/bootstrap3-wysihtml5.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('assets/admin/plugins/nvd3/build/nv.d3.css') }}" rel="stylesheet" />
    @yield('stylesheet')

    <!-- ================== END PAGE LEVEL STYLE ================== -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{ asset('assets/admin/plugins/pace/pace.min.js') }}"></script>
    <!-- Load compiled JS from Laravel Mix -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <!-- ================== END BASE JS ================== -->
</head>

<body>

    @yield('content')

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{ asset('assets/admin/plugins/jquery/jquery-1.9.1.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/jquery/jquery-migrate-1.1.0.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/jquery-ui/ui/minified/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--[if lt IE 9]>
        <script src="assets/admin/crossbrowserjs/html5shiv.js"></script>
        <script src="assets/admin/crossbrowserjs/respond.min.js"></script>
        <script src="assets/admin/crossbrowserjs/excanvas.min.js"></script>
    <![endif]-->
    <script src="{{ asset('assets/admin/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/jquery-cookie/jquery.cookie.js') }}"></script>
    <!-- ================== END BASE JS ================== -->

    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="{{ asset('assets/admin/plugins/gritter/js/jquery.gritter.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/flot/jquery.flot.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/flot/jquery.flot.time.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/flot/jquery.flot.resize.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/flot/jquery.flot.pie.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/sparkline/jquery.sparkline.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/jquery-jvectormap/jquery-jvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/masked-input/masked-input.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/password-indicator/js/password-indicator.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/bootstrap-combobox/js/bootstrap-combobox.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/jquery-tag-it/js/tag-it.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/bootstrap-daterangepicker/moment.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/select2/dist/js/select2.min.js') }}"></script>
    <script
        src="{{ asset('assets/admin/plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}">
    </script>
    <script src="{{ asset('assets/admin/plugins/bootstrap-show-password/bootstrap-show-password.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.js') }}"></script>
    <script src="{{ asset('assets/admin/js/form-plugins.demo.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/apps.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/DataTables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/DataTables/media/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.js') }}">
    </script>
    <script src="{{ asset('assets/admin/plugins/bootstrap-wizard/js/bwizard.js') }}"></script>
    <script src="{{ asset('assets/admin/js/form-wizards.demo.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/table-manage-default.demo.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/bootstrap-wysihtml5/dist/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/parsley/dist/parsley.js') }}"></script>
    <script src="{{ asset('assets/admin/js/dashboard.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/apps.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/login-v2.demo.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/d3.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/nvd3/build/nv.d3.js') }}"></script>
    -->
    <script src="{{ asset('assets/admin/js/apps.min.js') }}"></script>

    <!-- ================== END PAGE LEVEL JS ================== -->


    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>

    <!-- Initialize any global scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.App) {
                App.init();
                Dashboard.init();
                LoginV2.init();
                FormPlugins.init();
                TableManageDefault.init();
                FormWizard.init();
            }
        });
    </script>

    @yield('script')
</body>

</html>
