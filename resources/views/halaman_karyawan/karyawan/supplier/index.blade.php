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
                <div class="container">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary text-center">Daftar Supplier untuk PR/PO</h6>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('karyawan.supplier.add_supplier') }}" class="btn btn-success"
                                style="margin-bottom: 10px"><i class="fa-solid fa-plus fa-flip"></i>&nbsp;Tambah
                                Supplier</a>
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
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="width: 1%">No. </th>
                                            <th style="width: 20%; text-align: center">Nama Supplier</th>
                                            <th style="width: 20%; text-align: center">PIC</th>
                                            <th style="width: 20%; text-align: center">Menyetujui</th>
                                            <th style="text-align: center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        @foreach ($supplier as $item)
                                            <tr>
                                                <td>{{ $no++ . '.' }}</td>
                                                <td>{{ $item->nama_supplier }}</td>
                                                <td>{{ $item->PIC }}</td>
                                                <td>{{ $item->menyetujui }}</td>
                                                <td class="d-flex justify-content-center">
                                                    <a href="{{ route('karyawan.supplier.edit_supplier', $item->id) }}"
                                                        class="btn btn-info" data-toggle="tooltip"
                                                        data-placement="bottom" title="Edit"><i
                                                            class="fa-solid fa-pen-to-square"></i></a>
                                                    &nbsp;&nbsp;
                                                    <a href="javascript:void(0);" class="btn btn-warning delete"
                                                        data-id="{{ $item->id }}" data-toggle="tooltip"
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
        $('.delete').click(function() {
            var dokumenId = $(this).attr('data-id');
            Swal.fire({
                title: 'Yakin',
                text: "Kamu akan menghapus supplier ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = 'supplier/delete_supplier/' + dokumenId;
                }
            })
        })
    </script>

    <script src="{{ asset('assets/js/tooltip.js') }}"></script>
    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>
</body>

</html>
