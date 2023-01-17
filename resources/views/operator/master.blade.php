<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SKKL & PKPLH</title>

    <!-- link bootstrap&datapicker -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
    <!-- datatable -->
    <link rel="stylesheet" href="{{ asset('css/jquery.datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cloudflare.twitter-bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.css') }}">
    <!-- jquery&datapicker -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>


    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('operator.sidebar')

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

                <!-- dataTable -->
                <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
                <script src="{{ asset('js/1.12.1-jquery.datatables.min.js') }}"></script>
                <script src="{{ asset('js/2.2.9-datatables.responsive.min.js') }}"></script>
                <script src="{{ asset('js/datatables.bootstrap4.min.js') }}"></script>

                <script src="{{ asset('js/datatables.bootstrap4.js') }}"></script>
                <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
                <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
                <script>
                    $(document).ready(function() {
                        $('#table').DataTable({
                            "responsive": true,
                            "lengthChange": true,
                            "autoWidth": true
                        });
                    });
                </script>

            </div>
            <!-- End of Main Content -->

            @include('operator.footer')