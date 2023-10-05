@include('layouts.halaman_direksi.header')

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('layouts.halaman_direksi.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('layouts.halaman_direksi.topbar')

                <!-- Begin Page Content -->
                <div class="container-fluid">
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
                        style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 16px; margin-right: 200px">
                        <tr>
                            <th class="text-center"><a href="{{ route('direksi.reimbursement.tambah_RB') }}"
                                    data-toggle="tooltip" data-placement="bottom" title="Buat Reimbursement"><img
                                        src="{{ asset('cashback.png') }}" width="80"></a>
                                <br>
                                <p style="text-align: center">RB</p>
                            </th>
                            <br>
                            <th class="text-center"><a href="{{ route('direksi.cash_advance.tambah_CA') }}"
                                    data-toggle="tooltip" data-placement="bottom" title="Buat Cash Advance"><img
                                        src="{{ asset('cash.png') }}" width="80"></a>
                                <br>
                                <label class="text-center">CA</label>
                            </th>

                            <th><a href="{{ route('direksi.cash_advance_report.tambah_CAR') }}" data-toggle="tooltip"
                                    data-placement="bottom" title="Buat Cash Advance Report"><img
                                        src="{{ asset('4318314.png') }}" width="80"></a>
                                <br>
                                <p style="text-align: center">CA Report</p>
                            </th>

                        </tr>
                    </table>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary text-center"> Documents Need
                                Approval</h6>
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
                                                        href="{{ $item->source == 'reimbursement' ? route('direksi.reimbursement.view_reimbursement', $item->id) : ($item->source == 'cash_advance' ? route('direksi.cash_advance.view_cash_advance', $item->id) : ($item->source == 'cash_advance_report' ? route('direksi.cash_advance_report.view_cash_advance_report', $item->id) : ($item->source == 'purchase_request' ? route('direksi.purchase_request.view_PR', $item->id) : route('direksi.purchase_order.view_PO', $item->id)))) }}">{{ $item->no_doku_real }}</a>
                                                </td>
                                                <td style="text-align: center; color: #FF914D">
                                                    <label style="font-weight: bold">Waiting For
                                                        Payment</label>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                                <!-- /.container-fluid -->
                                {{ $combinedData->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>

                    <!-- /.container-fluid -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            @include('layouts.halaman_direksi.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @include('layouts.halaman_direksi.logout')

    @include('layouts.halaman_direksi.script')

</body>


</html>
