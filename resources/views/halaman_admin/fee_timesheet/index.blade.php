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
                <div class="container">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary text-center">Daftar Biaya Timesheet</h6>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('admin.master_timesheet.tambah_timesheet') }}" class="btn btn-success"
                                style="margin-bottom: 10px"><i class="fa-solid fa-plus fa-flip"></i>&nbsp;Tambah
                                Biaya Timesheet</a>
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
                            @endif
                            <div class="table-responsive">
                                <table class="table table-bordered" width="80%" cellspacing="0">
                                    <thead class="text-center">
                                        <tr>
                                            <th style="width: 1%">No. </th>
                                            <th style="width: 20%">Nominal</th>
                                            <th style="width: 20%">Hari</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        @foreach ($timesheet as $item)
                                            <tr>
                                                <td>{{ $no++ . '.' }}</td>
                                                <td>{{ number_format($item->nominal, 0, ',', '.') }}</td>
                                                <td>{{ $item->hari . ' hari' }}</td>
                                                <td class="d-flex justify-content-center">
                                                    <a href="{{ route('admin.master_timesheet.edit_timesheet', $item->id) }}"
                                                        class="btn btn-info" data-toggle="tooltip"
                                                        data-placement="bottom" title="Edit"><i
                                                            class="fa-solid fa-pen-to-square"></i></a>
                                                    &nbsp;&nbsp;
                                                    <a href="{{ route('admin.master_timesheet.hapus_timesheet', $item->id) }}"
                                                        class="btn btn-warning" data-toggle="tooltip"
                                                        data-placement="bottom" title="Hapus"><i
                                                            class="fa-solid fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

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

</body>

</html>
