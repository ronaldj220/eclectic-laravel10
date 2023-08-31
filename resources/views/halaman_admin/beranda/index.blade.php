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
                    <!-- Di dalam berkas admin.beranda.blade.php atau halaman beranda Anda -->
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

                    <table class="table table-borderless table-lg"
                        style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 16px; margin-right: 150px">
                        <tr>
                            <th class="text-center"><a href="{{ route('admin.reimbursement.tambah_reimbursement') }}"
                                    data-toggle="tooltip" data-placement="bottom" title="Buat Reimbursement"><img
                                        src="{{ asset('cashback.png') }}" width="80"></a>
                                <br>
                                <p style="text-align: center">RB</p>
                            </th>
                            <br>
                            <th class="text-center"><a href="{{ route('admin.cash_advance.tambah_cash_advance') }}"
                                    data-toggle="tooltip" data-placement="bottom" title="Buat Cash Advance"><img
                                        src="{{ asset('cash.png') }}" width="80"></a>
                                <br>
                                <label class="text-center">CA</label>
                            </th>

                            <th><a href="{{ route('admin.cash_advance_report.tambah_cash_advance_report') }}"
                                    data-toggle="tooltip" data-placement="bottom" title="Buat Cash Advance Report"><img
                                        src="{{ asset('4318314.png') }}" width="80"></a>
                                <br>
                                <p style="text-align: center">CA Report</p>
                            </th>
                            <th>
                                <!-- Nav Item - Tables -->
                                <a href="{{ route('admin.purchase_request.tambah_purchase_request') }}"
                                    data-toggle="tooltip" data-placement="bottom" title="Buat Purchase Request"><img
                                        src="{{ asset('123.png') }}" width="80"></a>
                                <br>
                                <p style="text-align: center">PR</p>
                            </th>
                            <th>
                                <!-- Nav Item - Tables -->
                                <a href="{{ route('admin.purchase_order.tambah_PO') }}" data-toggle="tooltip"
                                    data-placement="bottom" title="Buat Purchase Order"><img
                                        src="{{ asset('images.png') }}" width="65"></a>
                                <br>
                                <p style="text-align: center">PO</p>
                            </th>

                        </tr>

                    </table>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary text-center">Incoming New Documents</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead class="text-center">
                                        <tr>
                                            <th style="width: 2%">No Dokumen</th>
                                            <th style="width: 2%">Pemohon</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($combinedData as $item)
                                            <tr>
                                                <td>
                                                    <a
                                                        href="{{ $item->source == 'reimbursement' ? route('admin.reimbursement.lihat_reimbursement', $item->id) : ($item->source == 'cash_advance' ? route('admin.cash_advance.view_cash_advance', $item->id) : ($item->source == 'cash_advance_report' ? route('admin.cash_advance_report.view_cash_advance_report', $item->id) : ($item->source == 'purchase_request' ? route('admin.purchase_request.view_PR', $item->id) : route('admin.purchase_order.view_PO', $item->id)))) }}">{{ $item->no_doku_real }}</a>
                                                </td>
                                                <td>{{ $item->pemohon }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- /.container-fluid -->
                                {{ $combinedData->links('pagination::bootstrap-5') }}
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
