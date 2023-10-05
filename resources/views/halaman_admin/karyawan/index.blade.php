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
                            <h6 class="m-0 font-weight-bold text-primary text-center">Daftar Karyawan</h6>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('admin.karyawan.tambah_karyawan') }}" class="btn btn-success">
                                    <i class="fa-solid fa-plus fa-flip"></i>&nbsp;Tambah Karyawan
                                </a>
                                &nbsp;
                                <form action="{{ route('admin.karyawan') }}" style="margin-top: 30px" method="GET">
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
                            @endif
                            <div class="table-responsive">
                                <table class="table table-bordered" width="80%" cellspacing="0">
                                    <thead class="text-center">
                                        <tr>
                                            <th style="width: 1%">No. </th>
                                            <th style="width: 20%">Email</th>
                                            <th style="width: 20%">Nama</th>
                                            <th style="width: 20%">Jabatan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        @foreach ($dataKaryawan as $item)
                                            <tr>
                                                <td>{{ $no++ . '.' }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->jabatan }}</td>
                                                <td class="d-flex justify-content-center">
                                                    <a href="{{ route('admin.karyawan.edit_karyawan', $item->fk_user) }}"
                                                        class="btn btn-info" data-toggle="tooltip"
                                                        data-placement="bottom" title="Edit"><i
                                                            class="fa-solid fa-pen-to-square"></i></a>
                                                    &nbsp;&nbsp;
                                                    <a href="{{ route('admin.karyawan.hapus_karyawan', $item->fk_user) }}"
                                                        class="btn btn-warning" data-toggle="tooltip"
                                                        data-placement="bottom" title="Hapus"><i
                                                            class="fa-solid fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $dataKaryawan->links('pagination::bootstrap-5') }}
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
