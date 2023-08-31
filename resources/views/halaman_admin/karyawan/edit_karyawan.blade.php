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
                        <a class="collapse-item" href="#">RB</a>
                        <a class="collapse-item" href="#">CA</a>
                        <a class="collapse-item" href="#">CAR</a>
                        <a class="collapse-item" href="#">PR</a>
                        <a class="collapse-item" href="#">PO</a>
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
                                <a class="dropdown-item"
                                    href="{{ route('admin.admin.edit_admin', Auth::user()->id) }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile ({{ Auth::user()->nama }}) | {{ Auth::user()->jabatan }}
                                </a>
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
                        <div class="col-lg-6">
                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary text-center">Edit Karyawan</h6>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.karyawan.update_karyawan', $karyawan->id) }}"
                                        method="POST" id="formId">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Alamat Email</label>
                                            <input type="email" class="form-control" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" name="email"
                                                value="{{ $karyawan->email }}" readonly>
                                            <small id="emailHelp" class="form-text text-muted">Digunakan untuk login
                                                sebagai karyawan</small>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Nama</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                name="nama" value="{{ $karyawan->nama }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">No Rekening</label>
                                            <input type="number" class="form-control" id="exampleInputPassword1"
                                                name="no_rekening" value="{{ $karyawan->no_rekening }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Bank</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                name="bank" value="{{ $karyawan->bank }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Nomor Telepon</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1"
                                                name="no_telp">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Jabatan</label>
                                            <select class="form-control" id="exampleFormControlSelect1"
                                                name="jabatan">
                                                <option value="{{ $karyawan->jabatan }}">{{ $karyawan->jabatan }}
                                                </option>
                                                <option value="Konsultan">Konsultan</option>
                                                <option value="Project Manager">Project Manager</option>
                                                <option value="Support Manager">Support Manager</option>
                                                <option value="Staff">Staff</option>
                                            </select>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary" id="updateBtn"><i
                                                    class="fa-solid fa-floppy-disk fa-bounce"></i>&nbsp;Update</button>

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

            @include('layouts.halaman_admin.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @include('layouts.halaman_admin.logout')

    @include('layouts.halaman_admin.script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('updateBtn').addEventListener('click', function(event) {
            event.preventDefault(); // Untuk mencegah pengiriman formulir secara otomatis

            Swal.fire({
                title: 'Apakah anda yakin ingin update? ',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Simpan',
                denyButtonText: `Jangan Simpan`,
            }).then((result) => {
                if (result.isConfirmed) {
                    // Tindakan jika tombol "Save" diklik
                    document.getElementById('formId').submit(); // Submit formulir secara manual
                } else if (result.isDenied) {
                    // Tindakan jika tombol "Don't save" diklik
                    Swal.fire('Perubahan tidak akan disimpan', '', 'info');
                }
            });
        });
    </script>
</body>


</html>
