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
                            <h6 class="m-0 font-weight-bold text-primary text-center">Daftar PO</h6>
                        </div>
                        <div class="card-body">
                            @if (Session::has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ Session::get('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead class="text-center">
                                    <tr>
                                        <th>PPN</th>
                                        <th>PPh</th>
                                        <th>PPh 4 Ayat 2</th>
                                        <th>Aksi</th>
                                    </tr>
                                <tbody>
                                    @foreach ($PO as $p)
                                        <tr>
                                            <td>{{ $p->VAT * 100 . '%' }}</td>
                                            <td>{{ $p->PPH * 100 . '%' }}</td>
                                            <td>{{ $p->PPH_4 * 100 . '%' }}</td>
                                            <td><a href="{{ route('admin.master_PO.edit_PO', $p->id) }}"
                                                    class="btn btn-info" data-toggle="tooltip" data-placement="bottom"
                                                    title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                                &nbsp;&nbsp;</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                </thead>

                            </table>
                            <!-- /.container-fluid -->
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
