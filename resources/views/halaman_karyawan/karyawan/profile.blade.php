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
                <div class="container" style="margin-right: 60px;">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary text-center">Update Profil
                                        Karyawan</h6>
                                </div>
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <label class="" for="">Email:</label>
                                        <input type="text" name="email" class="form-group form-control"
                                            value="{{ Auth::user()->email }}" readonly>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="" for="">Nama:</label>
                                        <input type="text" name="nama" class="form-group form-control"
                                            value="{{ Auth::user()->nama }}" readonly>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="" for="">No Rekening:</label>
                                        <input type="number" name="no_rekening" class="form-group form-control"
                                            value="{{ Auth::user()->no_rekening }}" readonly>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="" for="">Bank:</label>
                                        <input type="text" name="bank" class="form-group form-control"
                                            value="{{ Auth::user()->bank }}" readonly>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('karyawan.beranda.profile.update_profile') }}"
                                            class="btn btn-primary"><i
                                                class="fa-solid fa-pen-to-square fa-bounce"></i>&nbsp;Update</a>
                                    </div>
                                </div>
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
</body>

</html>
