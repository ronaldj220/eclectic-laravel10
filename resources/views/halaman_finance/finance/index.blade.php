<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Eclectic (Finance) | {{ $title }}</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets') }}/css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="icon" href="{{ asset('logo.png') }}">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient sidebar sidebar-dark accordion" id="accordionSidebar"
            style="background-color: #900C3F">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center"
                href="{{ route('kasir.beranda') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">pt. eclectic</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('kasir.beranda') }}">
                    <i class="fa-solid fa-home fa-beat-fade"></i>
                    <span>Beranda</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('kasir.reimbursement') }}">
                    <i class="fa-solid fa-money-bill-transfer fa-beat-fade"></i>
                    <span>Reimbursement</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">


            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('kasir.cash_advance') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Cash Advance</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('kasir.cash_advance_report') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Cash Advance Report</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('kasir.purchase_request') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Purchase Request</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('kasir.purchase_order') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Purchase Order</span></a>
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

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::guard('kasir')->user()->nama }}
                                    <br>
                                    <small>Kasir</small></span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('assets') }}/img/undraw_profile_3.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-start mb-4">
                        <a href="https://drive.google.com/file/d/1uCNOVvTxZFA5X6Qeyqae2CbhJ5hq903y/view?usp=sharing"><i
                                class="fa-solid fa-cloud-arrow-down"></i> Download</a>
                    </div>
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-center mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard (Finance)</h1>
                    </div>

                    <table class="table table-borderless table-lg"
                        style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 16px; margin-right: 150px">
                        <tr>
                            <th class="text-center"><a href="{{ route('kasir.reimbursement.tambah_RB') }}"
                                    data-toggle="tooltip" data-placement="bottom" title="Buat Reimbursement"><img
                                        src="{{ asset('cashback.png') }}" width="80"></a>
                                <br>
                                <p style="text-align: center">RB</p>
                            </th>
                            <br>
                            <th class="text-center"><a href="{{ route('kasir.cash_advance.tambah_CA') }}"
                                    data-toggle="tooltip" data-placement="bottom" title="Buat Cash Advance"><img
                                        src="{{ asset('cash.png') }}" width="80"></a>
                                <br>
                                <label class="text-center">CA</label>
                            </th>

                            <th><a href="{{ route('kasir.cash_advance_report.tambah_CAR') }}" data-toggle="tooltip"
                                    data-placement="bottom" title="Buat Cash Advance Report"><img
                                        src="{{ asset('4318314.png') }}" width="80"></a>
                                <br>
                                <p style="text-align: center">CA Report</p>
                            </th>
                            <th>
                                <!-- Nav Item - Tables -->
                                <a href="{{ route('kasir.purchase_request.tambah_PR') }}" data-toggle="tooltip"
                                    data-placement="bottom" title="Buat Purchase Request"><img
                                        src="{{ asset('123.png') }}" width="80"></a>
                                <br>
                                <p style="text-align: center">PR</p>
                            </th>
                            <th>
                                <!-- Nav Item - Tables -->
                                <a href="{{ route('kasir.purchase_order.tambah_PO') }}" data-toggle="tooltip"
                                    data-placement="bottom" title="Buat Purchase Order"><img
                                        src="{{ asset('images.png') }}" width="65"></a>
                                <br>
                                <p style="text-align: center">PO</p>
                            </th>
                        </tr>

                    </table>
                    <br>
                    <!-- Begin Page Content -->
                    <div class="container-fluid" style="margin-right: 60px">
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary text-center">Documents Need Payment</h6>
                            </div>
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead class="text-center">
                                            <tr>
                                                <th style="width: 2%">No Dokumen</th>

                                                @if ($reimbursement && count($reimbursement) > 0)
                                                    @php
                                                        $item = $reimbursement[0];
                                                    @endphp
                                                    @if ($item->status_approved == 'approved' && $item->status_paid == 'pending')
                                                        <th style="width: 3%">Status</th>
                                                    @endif
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($reimbursement)
                                                @foreach ($reimbursement as $item)
                                                    <tr>
                                                        <td><a
                                                                href="{{ route('kasir.reimbursement.view_reimbursement', $item->id) }}">{{ $item->no_doku }}</a>
                                                        </td>
                                                        @if ($item->status_approved == 'approved' && $item->status_paid == 'pending')
                                                            <td style="text-align: center; color: #FF914D">
                                                                <label style="font-weight: bold">Waiting For
                                                                    Payment</label>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            @endif
                                            @if ($CA)
                                                @foreach ($CA as $item)
                                                    <tr>
                                                        <td><a
                                                                href="{{ route('kasir.cash_advance.view_cash_advance', $item->id) }}">{{ $item->no_doku }}</a>
                                                        </td>
                                                        @if ($item->status_approved == 'approved' && $item->status_paid == 'pending')
                                                            <td style="text-align: center; color: #FF914D">
                                                                <label style="font-weight: bold">Waiting For
                                                                    Payment</label>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            @endif
                                            @if ($CAR)
                                                @foreach ($CAR as $item)
                                                    <tr>
                                                        <td><a
                                                                href="{{ route('kasir.cash_advance_report.view_cash_advance_report', $item->id) }}">{{ $item->no_doku }}</a>
                                                        </td>
                                                        @if ($item->status_approved == 'approved' && $item->status_paid == 'pending')
                                                            <td style="text-align: center; color: #FF914D">
                                                                <label style="font-weight: bold">Waiting For
                                                                    Payment</label>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            @endif
                                            @if ($PR)
                                                @foreach ($PR as $item)
                                                    <tr>
                                                        <td><a
                                                                href="{{ route('kasir.purchase_request.view_PR', $item->id) }}">{{ $item->no_doku }}</a>
                                                        </td>
                                                        @if ($item->status_approved == 'approved' && $item->status_paid == 'pending')
                                                            <td style="text-align: center; color: #FF914D">
                                                                <label style="font-weight: bold">Waiting For
                                                                    Payment</label>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            @endif
                                            @if ($PO)
                                                @foreach ($PO as $item)
                                                    <tr>
                                                        <td><a
                                                                href="{{ route('kasir.reimbursement.view_reimbursement', $item->id) }}">{{ $item->no_doku }}</a>
                                                        </td>
                                                        @if ($item->status_approved == 'approved' && $item->status_paid == 'pending')
                                                            <td style="text-align: center; color: #FF914D">
                                                                <label style="font-weight: bold">Waiting For
                                                                    Payment</label>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                    <!-- /.container-fluid -->
                                    {{ $reimbursement->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- /.container-fluid -->

                <!-- Begin Page Content -->
                <div class="container">


                    <div class="row" style="justify-content: center">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-5 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                RB (need payment)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $dataRB }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Annual) Card Example -->
                        <div class="col-xl-3 col-md-5 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                CA (need payment)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $dataCA }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tasks Card Example -->
                        <div class="col-xl-3 col-md-5 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">CAR
                                                (need payment)
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                        {{ $dataCAR }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style=" justify-content: center">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-5 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                PR (need payment)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $dataPR }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Annual) Card Example -->
                        <div class="col-xl-3 col-md-5 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                PO (need payment)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $dataPO }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>



                </div>
                <!-- /.container-fluid -->


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

    <script src="{{ asset('assets/js/tooltip.js') }}"></script>


</body>

@include('sweetalert::alert')

</html>
