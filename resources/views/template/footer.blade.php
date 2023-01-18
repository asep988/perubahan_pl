            <!-- Footer -->
            <footer class="sticky-footer" style="background-color: #C0C0C0;">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

            </div>
            <!-- End of Page Wrapper -->

            <!-- Bootstrap core JavaScript-->
            {{-- <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
            <script src="{{ asset('js/popper.js') }}"></script>
            <script src="https://cdn.jsdelivr.net/npm/@floating-ui/core@1.1.0"></script>
            <script src="https://cdn.jsdelivr.net/npm/@floating-ui/dom@1.1.0"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
            <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
            <script src="{{ asset('js/bootstrap.min.js') }}"></script> --}}

            <!-- Core plugin JavaScript-->
            <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

            <!-- Custom scripts for all pages-->
            <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
            
            <!-- Page level plugins -->
            <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
            
            <!-- Page level custom scripts -->
            <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
            <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>

            <script src="js/jquery.dataTables.min.js"></script>
            
            @stack('scripts')

            </body>

            </html>