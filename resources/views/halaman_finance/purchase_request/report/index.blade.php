@include('layouts.halaman_kasir.header')

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('layouts.halaman_kasir.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('layouts.halaman_kasir.topbar')

                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary text-center">Cari Tanggal Dokumen PR</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('kasir.PR.searchPR') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <label for="">Tanggal Awal</label>
                                        <input type="date" class="form-control @error('tgl_1') is-invalid @enderror"
                                            placeholder="" name="tgl_1">
                                        @error('tgl_1')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="">Tanggal Akhir</label>
                                        <input type="date" class="form-control @error('tgl_2') is-invalid @enderror"
                                            placeholder="" name="tgl_2">
                                        @error('tgl_2')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary" style="margin-top: 20px;"><i
                                            class="fa-solid fa-magnifying-glass"></i> Find</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

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

    @include('layouts.halaman_kasir.logout')

    @include('layouts.halaman_kasir.script')


</body>

</html>
