@include('layouts.halaman_admin.header')

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient sidebar sidebar-dark accordion" id="accordionSidebar"
            style="background-color: #900C3F">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.beranda') }}">
                <div class="sidebar-brand-icon">
                    <img src="{{ asset('ECLECTIC GSM CROP1.png') }}" alt="" width="90%">
                </div>
                <div class="sidebar-brand-text">
                    <img src="{{ asset('ECLECTIC GSM CROP2.png') }}" alt="" width="100%">
                </div>

            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.beranda') }}">
                    <i class="fa-solid fa-home "></i>
                    <span>Beranda</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.reimbursement') }}">
                    <i class="fa-solid fa-hand-holding-heart"></i>
                    <span>Reimbursement</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.cash_advance') }}">
                    <i class="fa-solid fa-sack-dollar"></i>
                    <span>Cash Advance</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.cash_advance_report') }}">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                    <span>Cash Advance Report</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.purchase_request') }}">
                    <i class="fa-solid fa-chart-bar"></i>
                    <span>Purchase Request</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.purchase_order') }}">
                    <i class="fa-solid fa-cart-arrow-down"></i>
                    <span>Purchase Order</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog "></i>
                    <span>Setting</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.admin') }}"><i
                                class="fa-solid fa-lock fa-beat"></i>&nbsp;Admin</a>
                        <a class="collapse-item" href="{{ route('admin.karyawan') }}"><i
                                class="fa-solid fa-user fa-beat"></i>&nbsp;Karyawan</a>
                        <a class="collapse-item" href="{{ route('admin.currency') }}"><i
                                class="fa-solid fa-money-check fa-beat"></i>&nbsp;Mata Uang</a>
                        <a class="collapse-item" href="{{ route('admin.accounting') }}"><i
                                class="fa-solid fa-calculator fa-beat"></i>&nbsp;Accounting</a>
                        <a class="collapse-item" href="{{ route('admin.kasir') }}"><i
                                class="fa-solid fa-cash-register fa-beat"></i>&nbsp;Kasir</a>
                        <a class="collapse-item" href="{{ route('admin.menyetujui') }}"><i
                                class="fa-solid fa-user fa-beat"></i>&nbsp;Menyetujui</a>
                        <a class="collapse-item" href="{{ route('admin.master_timesheet') }}"><i
                                class="fa-solid fa-coins fa-beat"></i>&nbsp;Rate Timesheet Project</a>
                        <a class="collapse-item" href="{{ route('admin.master_fee_project') }}"><i
                                class="fa-solid fa-coins fa-beat"></i>&nbsp;Rate Lembur & Ticket</a>
                        <a class="collapse-item" href="{{ route('admin.supplier') }}">
                            <i class="fa-solid fa-truck-field-un fa-beat"></i>&nbsp;Supplier</a>
                        <a class="collapse-item" href="{{ route('admin.client') }}">
                            <i class="fa-solid fa-user fa-beat"></i>&nbsp;Client</a>
                        <a class="collapse-item" href="{{ route('admin.master_PO') }}">
                            <i class="fa-solid fa-user fa-beat"></i>&nbsp;Master PO</a>
                    </div>
                </div>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fa-solid fa-print"></i>
                    <span>Report</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item"
                            href="{{ route('admin.reimbursement.report_RB') }}">Reimbursement</a>
                        <a class="collapse-item" href="{{ route('admin.CA.report_CA') }}">Cash Advance</a>
                        <a class="collapse-item" href="#">Cash Advance Report</a>
                        <a class="collapse-item" href="#">Purchase Request</a>
                        <a class="collapse-item" href="#">Purchase Order</a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link"
                    href="https://drive.google.com/file/d/1RJmZuL2LmXJKe3NlkAESjgsCJc9pcX8l/view?usp=sharing">
                    <i class="fa-regular fa-circle-question"></i>
                    <span>Help</span></a>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('layouts.halaman_admin.topbar')

                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary text-center">Cari Tanggal Dokumen PR</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.PR.search_date_PR') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <label for="">Tanggal Awal</label>
                                        <input type="date"
                                            class="form-control @error('tgl_1') is-invalid @enderror" placeholder=""
                                            name="tgl_1">
                                        @error('tgl_1')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="">Tanggal Akhir</label>
                                        <input type="date"
                                            class="form-control @error('tgl_2') is-invalid @enderror" placeholder=""
                                            name="tgl_2">
                                        @error('tgl_2')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary" style="margin-top: 20px;"><i
                                            class="fa-solid fa-magnifying-glass"></i> Find</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Eclectic {{ date('Y') }}</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets') }}/js/sb-admin-2.min.js"></script>



</body>

</html>
