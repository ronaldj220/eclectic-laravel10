@php
    date_default_timezone_set('Asia/Jakarta');
@endphp
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Eclectic (Admin) | {{ $title }}</title>

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
                href="{{ route('admin.beranda') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">pt. eclectic</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.beranda') }}">
                    <i class="fa-solid fa-home fa-beat-fade"></i>
                    <span>Beranda</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading text-center">
                Halaman Master
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog fa-beat-fade"></i>
                    <span>Master</span>
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
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading text-center">
                Halaman Admin
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder fa-beat-fade"></i>
                    <span>Transaksi</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.reimbursement') }}">Reimbursement</a>
                        <a class="collapse-item" href="{{ route('admin.cash_advance') }}">Cash Advance</a>
                        <a class="collapse-item" href="{{ route('admin.cash_advance_report') }}">Cash Advance
                            Report</a>
                        <a class="collapse-item" href="{{ route('admin.purchase_request') }}">Purchase Request</a>
                        <a class="collapse-item" href="{{ route('admin.purchase_order') }}">Purchase Order</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

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

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->nama }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('assets') }}/img/undraw_profile.svg">
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
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10">
                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary text-center">Tambah Reimbursement
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.reimbursement.simpan_reimbursement') }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">No Dokumen</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" name="no_doku"
                                                value="{{ $no_dokumen }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Tanggal</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                name="tgl_diajukan" value="{{ date('d/m/Y') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Keterangan</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                name="judul_doku">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Pemohon</label>
                                            <select class="form-control" id="exampleFormControlSelect1"
                                                name="pemohon">
                                                <option value="Zhomi"> Zhomi </option>
                                                @foreach ($karyawan as $item)
                                                    <option value="{{ $item->nama }}"
                                                        {{ $item->nama == '' ? 'selected' : '' }}>
                                                        {{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Accounting</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                name="accounting" value="{{ $accounting[0]->nama }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Kasir</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                name="kasir" value="{{ $kasir[0]->nama }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Menyetujui</label>
                                            <select class="form-control" id="exampleFormControlSelect1"
                                                name="nama_menyetujui">
                                                <option value=""> --- Pilih --- </option>
                                                @foreach ($menyetujui as $item)
                                                    <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-text text-muted"
                                            style="font-size: 16px; font-family: Arial; color: red">
                                            * Aris (Keperluan Direksi) <br>
                                            * Sujiono (Keperluan Project) <br>
                                            * Yacob (Keperluan Office)
                                        </div>
                                        <div class="form-group" style="margin-top: 10px">
                                            <label for="exampleInputPassword1">File Bukti</label>
                                            <input type="file"
                                                class="form-control-file @error('bukti') is-invalid @enderror"
                                                name='bukti' accept='.pdf, .zip, .rar'>
                                            <br>
                                            <small id="passwordHelpBlock" class="form-text text-muted"
                                                style="font-family: Arial, Helvetica, sans-serif; margin-top: -10px">
                                                Gunakan PDF atau ZIP atau RAR
                                            </small>
                                            @error('bukti')
                                                <div class="alert alert-danger alert-dismissible fade show"
                                                    role="alert">
                                                    {{ $message }}
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group" style="margin-top: 10px; margin-bottom: 2px">
                                            <label for="">Pilih</label>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="project"
                                                    id="inlineRadio1" value="RB (Reimbursement)">
                                                <label class="form-check-label" for="inlineRadio1">RB
                                                    (Reimbursement)</label>
                                            </div>
                                            <div class="form-check ">
                                                <input class="form-check-input" type="radio" name="project"
                                                    id="inlineRadio2" value="TS (Timesheet Support)">
                                                <label class="form-check-label" for="inlineRadio2">TS (Timesheet
                                                    Support)</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="project"
                                                    id="inlineRadio3" value="ST (Support Ticket)">
                                                <label class="form-check-label" for="inlineRadio3">ST (Support
                                                    Ticket)</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="project"
                                                    id="inlineRadio4" value="SL (Support Lembur)">
                                                <label class="form-check-label" for="inlineRadio4">SL (Support
                                                    Lembur)</label>
                                            </div>
                                        </div>

                                        <div class="form-group mt-3">
                                            <div id="detail"></div>
                                        </div>
                                        <div class="d-flex justify-content-center" style="margin-top: 20px">
                                            <a href="javascript:;" class="btn btn-info" onclick="getRadioValue()"><i
                                                    class="fa-solid fa-circle-plus fa-bounce"></i>&nbsp;Tambah RB</a>
                                            &nbsp;&nbsp;
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="fa-solid fa-floppy-disk fa-bounce"></i>&nbsp;Submit</button>
                                            &nbsp;&nbsp;
                                            <a href="{{ route('admin.reimbursement') }}" class="btn btn-danger"><i
                                                    class="fa-solid fa-arrow-left fa-bounce"></i>&nbsp;Kembali</a>
                                        </div>
                                    </form>
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

    <script>
        function getRadioValue() {
            var radio = document.getElementsByName('project');
            var selectedValue = '';
            for (i = 0; i < radio.length; i++) {
                if (radio[i].checked) {

                    selectedValue = radio[i].value;

                    // Setelah validasi berhasil, atur template yang akan ditampilkan berdasarkan opsi yang dipilih
                    let template = '';

                    if (selectedValue === 'RB (Reimbursement)') {
                        template =
                            `<center>
                                <div class='container'>
                                    <div class = 'row'>
                                        <div class = 'col-md-6'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Deskripsi</label>
                                                <textarea class='form-control' name='deskripsi[]' rows='6'></textarea>
                                            </div>
                                        </div>
                                        <div class='col-md-6'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">File Bukti</label>
                                                <input type="file" class="form-control-file" name='foto[]' accept='.png, .jpg'>
                                                <br>
                                                <div class="form-text text-muted"
                                                    style="font-size: 12px; font-family: Arial; margin-bottom: 20px">
                                                    Harus JPG atau PNG
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">No Bukti</label>
                                                <input type="text" class="form-control" name='nobu[]'>
                                            </div>
                                        </div>
                                        <div class='col-md-6'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Mata Uang</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="kurs_rb[]">
                                                    <option value="" > --- Pilih --- </option>
                                                    @foreach ($kurs as $item)
                                                        <option value="{{ $item->mata_uang }}" {{ $item->mata_uang == 'IDR' ? 'selected' : '' }}>{{ $item->mata_uang }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class='col-md-6'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nominal</label>
                                                <input type="number" class="form-control" name='nom_rb[]'>
                                            </div>
                                        </div>
                                        <div class='col-md-5'>
                                            <div class="form-group">
                                                <label for="tgl1">Tanggal</label>
                                                <input type="date" class="form-control" name='tgl1[]'>
                                            </div>
                                        </div>
                                        <div class='col' style = 'margin-top: 40px'>
                                            <span>s/d</span>
                                        </div>
                                        <div class='col-md-5'>
                                            <div class="form-group">
                                                <label for="tgl2">Tanggal</label>
                                                <input type="date" class="form-control" name='tgl2[]'>
                                                <div class="form-text text-muted"
                                                    style="font-size: 12px; font-family: Arial; margin-bottom: 20px">
                                                    * OPSIONAL (Gunakan jika memerlukan rentang tanggal)
                                                </div>
                                            </div>
                                        </div>
                                        <div class='col-md-5'>
                                            <div class="form-group">
                                                <label for="keprluan">Project/Instansi/Perusahaan Tujuan</label>
                                                <input type="text" class="form-control @error('keperluan') is-invalid @enderror" name='keperluan[]' autofocus >
                                                @error('keperluan')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="form-text text-muted"
                                                    style="font-size: 12px; font-family: Arial; margin-bottom: 20px">
                                                    * Isi buat keperluan Project
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class = 'row'>
                                        <div class = 'col-md-12'>
                                            <div class="form-group" style = 'margin-top: 20px'>
                                                <button name="delete${i}" id="delete${i}" onclick="deleteRow(this)" type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash fa-bounce"></i>&nbsp;Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </center>`;
                    } else if (selectedValue === 'TS (Timesheet Support)') {
                        template =
                            `<center>
                                <div class='container'>
                                    <div class = 'row'>
                                        <div class = 'col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nama Karyawan</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="karyawan_ts[]">
                                                    <option value=""> --- Pilih --- </option>
                                                    @foreach ($karyawan as $item)
                                                        <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class = 'col-md-6'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Mata Uang</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="kurs_ts[]">
                                                    <option value=""> --- Pilih --- </option>
                                                    @foreach ($kurs as $item)
                                                        <option value="{{ $item->mata_uang }}" {{ $item->mata_uang == 'IDR' ? 'selected' : '' }}>{{ $item->mata_uang }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nominal</label>
                                                <input type="text" class="form-control" name='nom_ts[]' value = {{ $nominal_awal[0]->nominal }} readonly>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Hari (Secara Default)</label>
                                                <input type="text" class="form-control" name='hari_ts1[]' value = {{ $nominal_awal[0]->hari }} readonly>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Hari </label>
                                                <input type="number" class="form-control" name='hari_ts2[]'>
                                            </div>
                                        </div>
                                    </div>
                                    <div class = 'row'>
                                        <div class='col-md-12'>
                                            <div class="form-group">
                                                <button name="delete${i}" id="delete${i}" onclick="deleteRow(this)" type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash fa-bounce"></i>&nbsp;Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </center>`;
                    } else if (selectedValue === 'ST (Support Ticket)') {
                        template =
                            `<center>
                                <div class='container'>
                                    <div class = 'row'>
                                        <div class='col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nama Karyawan</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="karyawan_st[]">
                                                    <option value=""> --- Pilih --- </option>
                                                    @foreach ($karyawan as $item)
                                                        <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nickname Project</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="project_st[]">
                                                    <option value=""> --- Pilih --- </option>
                                                    @foreach ($aliases as $item)
                                                        <option value="{{ $item->aliases }}">{{ $item->aliases }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Mata Uang</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="kurs_st[]">
                                                    <option value=""> --- Pilih --- </option>
                                                    @foreach ($kurs as $item)
                                                        <option value="{{ $item->mata_uang }}" {{ $item->mata_uang == 'IDR' ? 'selected' : '' }}>{{ $item->mata_uang }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nominal</label>
                                                <input type="text" class="form-control" name='nom_st[]' value = {{ $nominal_project[0]->nominal }} readonly>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Jam </label>
                                                <input type="number" class="form-control" name='jam_st[]'>
                                            </div>
                                        </div>
                                    </div>
                                    <div class = 'row'>
                                        <div class='col-md-12'>
                                            <div class="form-group">
                                                <button name="delete${i}" id="delete${i}" onclick="deleteRow(this)" type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash fa-bounce"></i>&nbsp;Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </center>`;
                    } else if (selectedValue === 'SL (Support Lembur)') {
                        template =
                            `<center>
                                <div class='container'>
                                    <div class = 'row'>
                                        <div class='col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nama Karyawan</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="karyawan_st[]">
                                                    <option value=""> --- Pilih --- </option>
                                                    @foreach ($karyawan as $item)
                                                        <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nickname Project</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="project_st[]">
                                                    <option value=""> --- Pilih --- </option>
                                                    @foreach ($aliases as $item)
                                                        <option value="{{ $item->aliases }}">{{ $item->aliases }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Mata Uang</label>
                                                <select class="form-control" id="exampleFormControlSelect1" name="kurs_st[]">
                                                    <option value=""> --- Pilih --- </option>
                                                    @foreach ($kurs as $item)
                                                        <option value="{{ $item->mata_uang }}" {{ $item->mata_uang == 'IDR' ? 'selected' : '' }}>{{ $item->mata_uang }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nominal</label>
                                                <input type="text" class="form-control" name='nom_st[]' value = {{ $nominal_project[0]->nominal }} readonly>
                                            </div>
                                        </div>
                                        <div class='col-md-4'>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Jam </label>
                                                <input type="number" class="form-control" name='jam_st[]'>
                                            </div>
                                        </div>
                                    </div>
                                    <div class = 'row'>
                                        <div class='col-md-12'>
                                            <div class="form-group">
                                                <button name="delete${i}" id="delete${i}" onclick="deleteRow(this)" type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash fa-bounce"></i>&nbsp;Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </center>`;
                    }



                    // Kode lanjutan untuk opsi yang valid dipilih
                    let container = document.getElementById('detail');
                    let div = document.createElement('div');
                    div.innerHTML = template;
                    container.appendChild(div);

                    i++;
                }
            }
        }


        function deleteRow(id) {
            var row;
            row = id.name.substring(id.name.length - 1, id.name.length);
            var id = $('#id' + row).val();
            $('#delete' + row).closest('center').remove();
        }
    </script>
</body>
@include('sweetalert::alert')


</html>
