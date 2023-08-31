@include('layouts.halaman_karyawan.header')

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('layouts.halaman_karyawan.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('layouts.halaman_karyawan.topbar')

                <!-- Begin Page Content -->
                <div class="container-fluid" style="margin-right: 60px">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary text-center">Daftar Reimbursement</h6>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('karyawan.reimbursement.tambah_reimbursement') }}"
                                    class="btn btn-success">
                                    <i class="fa-solid fa-plus fa-flip"></i>&nbsp;Ajukan RB
                                </a>
                                &nbsp; &nbsp; &nbsp;
                                <form action="{{ route('karyawan.reimbursement') }}" method="GET" id="formCari">
                                    @csrf
                                    <div class="form-group">
                                        <input type="search" class="form-control" name="search"
                                            placeholder="Search...">
                                    </div>
                                </form>
                            </div>
                            @if (Session::has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ Session::get('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead class="text-center">
                                        <tr>
                                            <th style="width: 2%">No Dokumen</th>
                                            <th style="width: 20%">Keterangan</th>

                                            @if ($reimbursement && count($reimbursement) > 0)
                                                @php
                                                    $item = $reimbursement[0];
                                                @endphp
                                                @if ($item->status_approved == 'rejected' && $item->status_paid == 'rejected')
                                                    <th style="width: 3%">Status</th>
                                                    <th style="width: 3%">Aksi</th>
                                                @elseif ($item->status_approved == 'rejected' && $item->status_paid == 'pending')
                                                    <th style="width: 3%">Status</th>
                                                    <th style="width: 3%">Aksi</th>
                                                @elseif ($item->status_approved == 'hold' && $item->status_paid == 'hold')
                                                    <th style="width: 3%">Status</th>
                                                    <th style="width: 3%">Aksi</th>
                                                @elseif ($item->status_approved == 'pending' && $item->status_paid == 'pending')
                                                    <th style="width: 3%">Status</th>
                                                    <th style="width: 3%">Aksi</th>
                                                @elseif ($item->status_approved == 'approved' && $item->status_paid == 'pending')
                                                    <th style="width: 3%">Status</th>
                                                    <th style="width: 3%">Aksi</th>
                                                @elseif ($item->status_approved == 'approved' && $item->status_paid == 'paid')
                                                    <th style="width: 3%">Status</th>
                                                    <th style="width: 3%">Aksi</th>
                                                @endif
                                            @endif
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @if ($reimbursement)
                                            @foreach ($reimbursement as $item)
                                                <tr>
                                                    <td><a
                                                            href="{{ route('karyawan.reimbursement.view_reimbursement', $item->id) }}">{{ $item->no_doku_real }}</a>
                                                    </td>
                                                    <td>{{ $item->judul_doku }}</td>

                                                    @if ($item->status_approved == 'rejected' && $item->status_paid == 'rejected')
                                                        <td style="text-align: center; color: #FF3131">
                                                            <label style="font-weight: bold">Submitted</label>
                                                        </td>
                                                        <td style="text-align: center">
                                                            <a href="{{ route('karyawan.reimbursement.view_reimbursement', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="View ">
                                                                <i class="fa-solid fa-eye" style="color: #900C3F"></i>
                                                            </a>
                                                            &nbsp;
                                                            <a href="{{ route('karyawan.reimbursement.lihat_bukti_reimbursement', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Print Bukti">
                                                                <i class="fa-solid fa-image" style="color: #900C3F"></i>
                                                            </a>
                                                            &nbsp;


                                                        </td>
                                                    @elseif ($item->status_approved == 'rejected' && $item->status_paid == 'pending')
                                                        <td style="text-align: center; color: #FF3131">
                                                            <label style="font-weight: bold">Rejected</label>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <a href="{{ route('karyawan.reimbursement.view_reimbursement', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="View ">
                                                                <i class="fa-solid fa-eye" style="color: #900C3F"></i>
                                                            </a>
                                                            &nbsp;
                                                            <a href="{{ route('karyawan.reimbursement.lihat_bukti_reimbursement', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Print Bukti">
                                                                <i class="fa-solid fa-image" style="color: #900C3F"></i>
                                                            </a>

                                                        </td>
                                                    @elseif ($item->status_approved == 'pending' && $item->status_paid == 'pending')
                                                        <td style="text-align: center; color: #FF914D">
                                                            <label style="font-weight: bold">Waiting For
                                                                Approval</label>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <a href="{{ route('karyawan.reimbursement.view_reimbursement', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="View ">
                                                                <i class="fa-solid fa-eye" style="color: #900C3F"></i>
                                                            </a>
                                                            &nbsp;
                                                            <a href="{{ route('karyawan.reimbursement.lihat_bukti_reimbursement', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Print Bukti">
                                                                <i class="fa-solid fa-image" style="color: #900C3F"></i>
                                                            </a>
                                                        </td>
                                                    @elseif ($item->status_approved == 'approved' && $item->status_paid == 'pending')
                                                        <td style="text-align: center;color: #00BF63;">
                                                            <label
                                                                style="font-weight: bold; text-transform: uppercase">Approved</label>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <a href="{{ route('karyawan.reimbursement.view_reimbursement', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Print Dokumen">
                                                                <i class="fa-solid fa-print"
                                                                    style="color: #900C3F"></i>
                                                            </a>
                                                            &nbsp;
                                                            <a href="{{ route('karyawan.reimbursement.lihat_bukti_reimbursement', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Print Bukti">
                                                                <i class="fa-solid fa-image"
                                                                    style="color: #900C3F"></i>
                                                            </a>
                                                            &nbsp;
                                                        </td>
                                                    @elseif ($item->status_approved == 'approved' && $item->status_paid == 'paid')
                                                        <td style="text-align: center;color: #00BF63;">
                                                            <label
                                                                style="font-weight: bold; text-transform: uppercase">paid</label>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <a href="{{ route('karyawan.reimbursement.view_reimbursement', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Print Dokumen">
                                                                <i class="fa-solid fa-print"
                                                                    style="color: #900C3F"></i>
                                                            </a>
                                                            &nbsp;
                                                            <a href="{{ route('karyawan.reimbursement.lihat_bukti_reimbursement', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Print Bukti">
                                                                <i class="fa-solid fa-image"
                                                                    style="color: #900C3F"></i>
                                                            </a>
                                                            &nbsp;
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
            <!-- End of Main Content -->

            @include('layouts.halaman_karyawan.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @include('layouts.halaman_karyawan.logout')

    @include('layouts.halaman_karyawan.script')
    <script>
        $(document).ready(function() {
            $('#bulan').change(function() {
                $('#formBulan').submit(); // Mengirimkan form saat bulan berubah
            });
            $('#cari').change(function() {
                $('#formCari').submit(); // Mengirimkan form saat bulan berubah
            });
        });
    </script>


</body>

</html>
