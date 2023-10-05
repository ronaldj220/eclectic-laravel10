@include('layouts.halaman_admin.header')

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('layouts.halaman_admin.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('layouts.halaman_admin.topbar')

                <!-- Begin Page Content -->
                <div class="container-fluid" style="margin-right: 60px">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary text-center">Daftar Cash Advance</h6>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('admin.cash_advance.tambah_cash_advance') }}" class="btn btn-success">
                                    <i class="fa-solid fa-plus fa-flip"></i>&nbsp;Ajukan CA
                                </a>


                                <form id="formBulan" action="{{ route('admin.cash_advance.bulan') }}" method="GET"
                                    class="ml-auto">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="bulan">Bulan</label>
                                        <input type="month" class="form-control" id="bulan" name="bulan"
                                            value="{{ request('bulan') }}">
                                    </div>
                                </form>

                                &nbsp;
                                <form action="" style="margin-top: 30px">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <input type="search" class="form-control" id="exampleFormControlInput1"
                                            name="search" placeholder="Search...">
                                    </div>
                                </form>
                            </div>
                            @if (session('success'))
                                <script>
                                    window.addEventListener('DOMContentLoaded', function() {
                                        Swal.fire({
                                            title: 'Berhasil!',
                                            text: '{{ session('success') }}',
                                            icon: 'success',
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                    });
                                </script>
                            @elseif (session('error'))
                                <script>
                                    window.addEventListener('DOMContentLoaded', function() {
                                        Swal.fire({
                                            title: 'Gagal!',
                                            text: '{{ session('error') }}',
                                            icon: 'error',
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                    });
                                </script>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead class="text-center">
                                        <tr>
                                            <th style="width: 2%">No Dokumen</th>
                                            <th style="width: 2%">CAR</th>
                                            <th style="width: 2%">Tanggal</th>
                                            <th style="width: 10%">Keterangan</th>
                                            <th style="width: 5%">Pemohon</th>
                                            @if ($CashAdvance && count($CashAdvance) > 0)
                                                @php
                                                    $item = $CashAdvance[0];
                                                @endphp
                                                @if ($item->status_approved == 'rejected' && $item->status_paid == 'rejected')
                                                    <th style="width: 2%">Status</th>
                                                    <th style="width: 2%">Aksi</th>
                                                @elseif ($item->status_approved == 'rejected' && $item->status_paid == 'pending')
                                                    <th style="width: 2%">Status</th>
                                                    <th style="width: 2%">Aksi</th>
                                                @elseif ($item->status_approved == 'pending' && $item->status_paid == 'pending')
                                                    <th style="width: 2%">Status</th>
                                                    <th style="width: 2%">Aksi</th>
                                                @elseif ($item->status_approved == 'approved' && $item->status_paid == 'pending')
                                                    <th style="width: 2%">Status</th>
                                                    <th style="width: 2%">Aksi</th>
                                                @elseif ($item->status_approved == 'approved' && $item->status_paid == 'paid')
                                                    <th style="width: 2%">Status</th>
                                                    <th style="width: 2%">Aksi</th>
                                                @endif
                                            @endif

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($CashAdvance)
                                            @foreach ($CashAdvance as $item)
                                                <tr>
                                                    <td>
                                                        <a
                                                            href="{{ route('admin.cash_advance.view_cash_advance', $item->id) }}">
                                                            {{ $item->no_doku }}
                                                    </td>
                                                    </a>

                                                    <td>
                                                        @if ($item->id_car)
                                                            <a
                                                                href="{{ route('admin.cash_advance.view_CAR', ['id' => $item->id_car]) }}">{{ $item->tipe_car }}</a>
                                                        @else
                                                            -
                                                        @endif
                                                    </td>

                                                    <td>{{ date('d.m.Y', strtotime($item->tgl_diajukan)) }}</td>
                                                    <td>{{ $item->judul_doku }}</td>
                                                    <td>{{ $item->pemohon }}</td>
                                                    @if ($item->status_approved == 'rejected' && $item->status_paid == 'rejected')
                                                        <td
                                                            style="text-align: center; color: #FF3131; text-transform: uppercase">
                                                            <label style="font-weight: bold">Submitted</label>
                                                        </td>
                                                        <td style="text-align: center">
                                                            <a href="{{ route('admin.cash_advance.excel_cash_advance', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Download Excel">
                                                                <i class="fa-solid fa-file-excel"
                                                                    style="color: #900C3F"></i>
                                                            </a>
                                                            <a href="{{ route('admin.cash_advance.view_cash_advance', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Setujui Dokumen">
                                                                <i class="fa-solid fa-square-check"
                                                                    style="color: #900C3F"></i>
                                                            </a>
                                                            <a href="{{ route('admin.cash_advance.print_cash_advance', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Print Dokumen">
                                                                <i class="fa-solid fa-print" style="color: #900C3F"></i>
                                                            </a>
                                                            <a href="{{ route('admin.cash_advance.edit_CA', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Edit CA">
                                                                <i class="fa-solid fa-pen-to-square"
                                                                    style="color: #900C3F"></i>
                                                            </a>
                                                            <a href="{{ route('admin.cash_advance.hapus_CA', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Hapus">
                                                                <i class="fa-solid fa-trash" style="color: #900C3F"></i>
                                                            </a>
                                                        </td>
                                                    @elseif ($item->status_approved == 'rejected' && $item->status_paid == 'pending')
                                                        <td
                                                            style="text-align: center; color: #FF3131; text-transform: uppercase">
                                                            <label style="font-weight: bold">Rejected</label>
                                                        </td>
                                                        <td style="text-align: center">
                                                            <a href="{{ route('admin.cash_advance.excel_cash_advance', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Download Excel">
                                                                <i class="fa-solid fa-file-excel"
                                                                    style="color: #900C3F"></i>
                                                            </a>
                                                            <a href="{{ route('admin.cash_advance.view_cash_advance', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Print Dokumen">
                                                                <i class="fa-solid fa-image"
                                                                    style="color: #900C3F"></i>
                                                            </a>
                                                            <a href="{{ route('admin.cash_advance.print_cash_advance', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Print Dokumen">
                                                                <i class="fa-solid fa-print"
                                                                    style="color: #900C3F"></i>
                                                            </a>
                                                        </td>
                                                    @elseif ($item->status_approved == 'pending' && $item->status_paid == 'pending')
                                                        <td
                                                            style="text-align: center; color: #FF914D; text-transform: uppercase;">
                                                            <b><label>Waiting for Approval</label></b>
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="{{ route('admin.cash_advance.view_cash_advance', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Lihat Dokumen">
                                                                <i class="fa-solid fa-eye" style="color: #900C3F"></i>
                                                            </a>
                                                            <a href="{{ route('admin.cash_advance.print_cash_advance', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Print Dokumen">
                                                                <i class="fa-solid fa-print"
                                                                    style="color: #900C3F"></i>
                                                            </a>
                                                            <a href="{{ route('admin.cash_advance.excel_cash_advance', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Download Excel">
                                                                <i class="fa-solid fa-file-excel"
                                                                    style="color: #900C3F"></i>
                                                            </a>
                                                            <a href="{{ route('admin.cash_advance.kirim_WA', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Kirim WA">
                                                                <i class="fa-brands fa-whatsapp"
                                                                    style="color: #900C3F"></i>
                                                            </a>
                                                        </td>
                                                    @elseif ($item->status_approved == 'approved' && $item->status_paid == 'pending')
                                                        <td
                                                            style="text-align: center; color: #0097B2; text-transform: uppercase">
                                                            <label
                                                                style="font-weight: bold; text-transform: uppercase">Approved</label>
                                                        </td>
                                                        <td style="text-align: center">
                                                            <a href="{{ route('admin.cash_advance.excel_cash_advance', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Download Excel">
                                                                <i class="fa-solid fa-file-excel"
                                                                    style="color: #900C3F"></i>
                                                            </a>
                                                            <a href="{{ route('admin.cash_advance.print_cash_advance', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Print Dokumen">
                                                                <i class="fa-solid fa-print"
                                                                    style="color: #900C3F"></i>
                                                            </a>
                                                            <a href="{{ route('admin.cash_advance.view_cash_advance', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Lihat Dokumen">
                                                                <i class="fa-solid fa-eye" style="color: #900C3F"></i>
                                                            </a>
                                                        </td>
                                                    @elseif ($item->status_approved == 'approved' && $item->status_paid == 'paid')
                                                        <td
                                                            style="text-align: center; color: #00BF63; text-transform: uppercase">
                                                            <label
                                                                style="font-weight: bold; text-transform: uppercase">paid</label>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('admin.cash_advance.excel_cash_advance', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Download Excel">
                                                                <i class="fa-solid fa-file-excel"
                                                                    style="color: #900C3F"></i>
                                                            </a>
                                                            &nbsp;
                                                            <a href="{{ route('admin.cash_advance.print_cash_advance', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Print Dokumen">
                                                                <i class="fa-solid fa-print"
                                                                    style="color: #900C3F"></i>
                                                            </a>
                                                            &nbsp;
                                                            <a href="{{ route('admin.cash_advance.view_cash_advance', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Lihat">
                                                                <i class="fa-solid fa-eye" style="color: #900C3F"></i>
                                                            </a>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                {{ $CashAdvance->links('pagination::bootstrap-5') }}
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

    <script>
        $(document).ready(function() {
            $('#bulan').change(function() {
                $('#formBulan').submit(); // Mengirimkan form saat bulan berubah
            });

        });
    </script>

</body>

</html>
