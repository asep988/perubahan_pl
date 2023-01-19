<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Scripts (Disini)--> 
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    {{-- <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    
    <title>SKKL & PKPLH</title>

    <!-- link bootstrap&datapicker -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
    <!-- datatable -->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css"/> --}}
    <link rel="stylesheet" href="{{ asset('css/jquery.datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cloudflare.twitter-bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.css') }}">
    {{-- <link type="text/css" href="{{ asset('jquery-ui/jquery-ui.css') }}" rel="stylesheet">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('jquery-ui/jquery-ui.min.js') }}"></script> --}}
    
    <!-- jquery&datapicker -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <!-- select2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('template.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- tempat_topbar -->

                @yield('content')
                <script type="text/javascript">
                    $('.date').datepicker({
                        format: 'yyyy/mm/dd',
                        autoclose: 'true'
                    });
                </script>
                <script src="{{ asset('js/bootstrap.min.js') }}"></script>

                <!-- ckeditor -->
                <script src="https://cdn.tiny.cloud/1/hq3fwdzyw02rpmstjsppgvlus70tbut6gt60m8gfvnp6udmm/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

                <script>
                    tinymce.init({
                        selector: 'textarea#mytextarea',
                        height: 400,
                        forced_root_block: "",
                        force_br_newlines: true,
                        force_p_newlines: true,
                        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                        toolbar1: 'undo redo | insert | styleselect table | bold italic | hr alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media ',
                        toolbar2: 'forecolor backcolor emoticons | fontselect | fontsizeselect | fullscreen',
                        templates: [{
                                title: 'Test template 1',
                                content: ''
                            },
                            {
                                title: 'Test template 2',
                                content: ''
                            }
                        ],
                        content_css: [
                            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                            '//www.tinymce.com/css/codepen.min.css'
                        ],
                    });
                </script>
                
                {{-- <script>
                    $(document).ready( function () {
                    $('#myTable').DataTable();
                    } );
                </script> --}}
            </div>
            <!-- End of Main Content -->

            @include('template.footer')