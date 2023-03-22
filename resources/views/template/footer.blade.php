            </div>
            </div>
            <!-- Core plugin JavaScript-->
            <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

            <!-- Custom scripts for all pages-->
            <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

            <!-- Page level plugins -->
            <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

            <!-- Page level custom scripts -->
            <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
            <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>

            {{-- datatable --}}
            {{-- <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('table/js/2.2.9-datatables.responsive.min.js') }}"></script> --}}

            {{-- datatable-new --}}
            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap4.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>
            {{-- datatable responsive --}}
            <script src="https://cdn.datatables.net/fixedheader/3.3.2/js/dataTables.fixedHeader.min.js"></script>
            <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
            <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap.min.js"></script>


            @stack('scripts')

            </body>

            </html>
