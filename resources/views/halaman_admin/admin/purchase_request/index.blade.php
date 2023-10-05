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
                            <h6 class="m-0 font-weight-bold text-primary text-center">Daftar Purchase Request</h6>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('admin.purchase_request.tambah_purchase_request') }}"
                                    class="btn btn-success">
                                    <i class="fa-solid fa-plus fa-flip"></i>&nbsp;Ajukan PR
                                </a>


                                <form id="formBulan" action="{{ route('admin.purchase_request.bulan') }}" method="GET"
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
                                            <th style="width: 2%">PO</th>
                                            <th style="width: 1%">Tanggal</th>
                                            <th style="width: 10%">Keterangan</th>
                                            <th style="width: 10%">Pemohon</th>
                                            @if ($purchase_request && count($purchase_request) > 0)
                                                @php
                                                    $item = $purchase_request[0];
                                                @endphp
                                                @if ($item->status_approved == 'rejected' && $item->status_paid == 'rejected')
                                                    <th style="width: 3%">Status</th>
                                                    <th style="width: 3%">Aksi</th>
                                                @elseif ($item->status_approved == 'rejected' && $item->status_paid == 'pending')
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
                                        @if ($purchase_request)
                                            @foreach ($purchase_request as $item)
                                                <tr>
                                                    <td>
                                                        <a
                                                            href="{{ route('admin.purchase_request.view_PR', $item->id) }}">
                                                            {{ $item->no_doku }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        @if ($item->id_pr)
                                                            <a
                                                                href="{{ route('admin.purchase_request.view_PO', ['id' => $item->id_pr]) }}">{{ $item->tipe_pr }}</a>
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
                                                        <td style="text-align: center;">
                                                            <a href="{{ route('admin.purchase_request.excel_purchase_request', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Download Excel">
                                                                <i class="fa-solid fa-file-excel"
                                                                    style="color: #900C3F"></i>
                                                            </a>
                                                            <a href="{{ route('admin.purchase_request.print_purchase_request', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Print Dokumen">
                                                                <i class="fa-solid fa-print" style="color: #900C3F"></i>
                                                            </a>
                                                            <a href="{{ route('admin.purchase_request.view_PR', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Setujui Dokumen">
                                                                <i class="fa-solid fa-eye" style="color: #900C3F">
                                                                </i>
                                                            </a>
                                                            <a href="{{ route('admin.purchase_request.edit_PR', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Edit PR">
                                                                <i class="fa-solid fa-pen-to-square"
                                                                    style="color: #900C3F"></i>
                                                            </a>
                                                            <a href="#" data-toggle="tooltip"
                                                                data-placement="bottom" title="Hapus" class="delete"
                                                                data-id="{{ $item->id }}"
                                                                data-nama="{{ $item->no_doku }}"><i
                                                                    class="fa-solid fa-trash"
                                                                    style="color: #900C3F"></i></a>
                                                        </td>
                                                    @elseif ($item->status_approved == 'rejected' && $item->status_paid == 'pending')
                                                        <td style="text-align: center; color: #FF3131">
                                                            <label style="font-weight: bold">Rejected</label>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <a href="{{ route('admin.purchase_request.excel_purchase_request', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Download Excel">
                                                                <i class="fa-solid fa-file-excel"
                                                                    style="color: #900C3F"></i>
                                                            </a>
                                                            <a href="{{ route('admin.purchase_request.print_purchase_request', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Print Dokumen">
                                                                <i class="fa-solid fa-print"
                                                                    style="color: #900C3F"></i>
                                                            </a>
                                                            <a href="{{ route('admin.purchase_request.view_PR', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Setujui Dokumen">
                                                                <i class="fa-solid fa-eye" style="color: #900C3F">
                                                                </i>
                                                            </a>
                                                        </td>
                                                    @elseif ($item->status_approved == 'pending' && $item->status_paid == 'pending')
                                                        <td style="text-align: center; color: #FF914D">
                                                            <label style="font-weight: bold">Waiting For
                                                                Approval</label>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <a href="{{ route('admin.purchase_request.excel_purchase_request', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Download Excel">
                                                                <i class="fa-solid fa-file-excel"
                                                                    style="color: #900C3F"></i>
                                                            </a>
                                                            <a href="{{ route('admin.purchase_request.print_purchase_request', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Print Dokumen">
                                                                <i class="fa-solid fa-print"
                                                                    style="color: #900C3F"></i>
                                                            </a>
                                                            <a href="{{ route('admin.purchase_request.view_PR', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Setujui Dokumen">
                                                                <i class="fa-solid fa-eye" style="color: #900C3F">
                                                                </i>
                                                            </a>
                                                        </td>
                                                    @elseif ($item->status_approved == 'approved' && $item->status_paid == 'pending')
                                                        <td style="text-align: center;color: #0097B2;">
                                                            <label
                                                                style="font-weight: bold; text-transform: uppercase">Approved</label>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <a href="{{ route('admin.purchase_request.excel_purchase_request', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Download Excel">
                                                                <i class="fa-solid fa-file-excel"
                                                                    style="color: #900C3F"></i>
                                                            </a>
                                                            <a href="{{ route('admin.purchase_request.print_purchase_request', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Print Dokumen">
                                                                <i class="fa-solid fa-print"
                                                                    style="color: #900C3F"></i>
                                                            </a>
                                                            <a href="{{ route('admin.purchase_request.view_PR', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Setujui Dokumen">
                                                                <i class="fa-solid fa-eye" style="color: #900C3F">
                                                                </i>
                                                            </a>
                                                        </td>
                                                    @elseif ($item->status_approved == 'approved' && $item->status_paid == 'paid')
                                                        <td style="text-align: center;color: #00BF63;">
                                                            <label
                                                                style="font-weight: bold; text-transform: uppercase">paid</label>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <a href="{{ route('admin.purchase_request.excel_purchase_request', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Download Excel">
                                                                <i class="fa-solid fa-file-excel"
                                                                    style="color: #900C3F"></i>
                                                            </a>
                                                            <a href="{{ route('admin.purchase_request.print_purchase_request', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Print Dokumen">
                                                                <i class="fa-solid fa-print"
                                                                    style="color: #900C3F"></i>
                                                            </a>
                                                            <a href="{{ route('admin.purchase_request.view_PR', $item->id) }}"
                                                                data-toggle="tooltip" data-placement="bottom"
                                                                title="Setujui Dokumen">
                                                                <i class="fa-solid fa-eye" style="color: #900C3F">
                                                                </i>
                                                            </a>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                <!-- /.container-fluid -->
                                {{ $purchase_request->links('pagination::bootstrap-5') }}
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
            $('#cari').change(function() {
                $('#formCari').submit(); // Mengirimkan form saat bulan berubah
            });
        });
    </script>

    <script>
        $('.delete').click(function() {
            var dokumenId = $(this).attr('data-id');
            var no_doku = $(this).attr('data-nama');
            Swal.fire({
                title: 'Yakin',
                text: "Kamu akan menghapus nomor dokumen dengan " + no_doku + "? ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = 'purchase_request/hapus_PR/' + dokumenId;
                }
            })
        })
    </script>


</body>

</html>
