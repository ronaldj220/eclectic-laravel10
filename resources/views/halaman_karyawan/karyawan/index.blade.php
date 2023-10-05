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
                        style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 16px; margin-right: 150px">
                        <tr>
                            <th class="text-center"><a href="{{ route('karyawan.reimbursement.tambah_reimbursement') }}"
                                    data-toggle="tooltip" data-placement="bottom" title="Buat Reimbursement"><img
                                        src="{{ asset('cashback.png') }}" width="80"></a>
                                <br>
                                <p style="text-align: center">RB</p>
                            </th>
                            <br>
                            <th class="text-center"><a href="{{ route('karyawan.cash_advance.tambah_cash_advance') }}"
                                    data-toggle="tooltip" data-placement="bottom" title="Buat Cash Advance"><img
                                        src="{{ asset('cash.png') }}" width="80"></a>
                                <br>
                                <label class="text-center">CA</label>
                            </th>

                            <th><a href="{{ route('karyawan.cash_advance_report.tambah_CAR') }}" data-toggle="tooltip"
                                    data-placement="bottom" title="Buat Cash Advance Report"><img
                                        src="{{ asset('4318314.png') }}" width="80"></a>
                                <br>
                                <p style="text-align: center">CA Report</p>
                            </th>
                            @if (Auth::user()->jabatan == 'Staff')
                                <th>
                                    <!-- Nav Item - Tables -->
                                    <a href="{{ route('karyawan.purchase_request.tambah_PR') }}" data-toggle="tooltip"
                                        data-placement="bottom" title="Buat Purchase Request"><img
                                            src="{{ asset('123.png') }}" width="80"></a>
                                    <br>
                                    <p style="text-align: center">PR</p>
                                </th>
                                <th>
                                    <!-- Nav Item - Tables -->
                                    <a href="{{ route('karyawan.purchase_order.tambah_PO') }}" data-toggle="tooltip"
                                        data-placement="bottom" title="Buat Purchase Order"><img
                                            src="{{ asset('images.png') }}" width="65"></a>
                                    <br>
                                    <p style="text-align: center">PO</p>
                                </th>
                            @elseif (Auth::user()->jabatan == 'Accounting')
                                <th>
                                    <!-- Nav Item - Tables -->
                                    <a href="{{ route('karyawan.purchase_request.tambah_PR') }}" data-toggle="tooltip"
                                        data-placement="bottom" title="Buat Purchase Request"><img
                                            src="{{ asset('123.png') }}" width="80"></a>
                                    <br>
                                    <p style="text-align: center">PR</p>
                                </th>
                                <th>
                                    <!-- Nav Item - Tables -->
                                    <a href="{{ route('karyawan.purchase_order.tambah_PO') }}" data-toggle="tooltip"
                                        data-placement="bottom" title="Buat Purchase Order"><img
                                            src="{{ asset('images.png') }}" width="65"></a>
                                    <br>
                                    <p style="text-align: center">PO</p>
                                </th>
                            @endif
                        </tr>

                    </table>
                    <br>
                    <!-- Begin Page Content -->
                    <div class="container-fluid" style="margin-right: 60px">
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary text-center">Daftar Permohonan</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead class="text-center">
                                            <tr>
                                                <th style="width: 2%">No Dokumen</th>

                                                @if ($reimbursement && count($reimbursement) > 0)
                                                    @php
                                                        $item = $reimbursement[0];
                                                    @endphp
                                                    @if ($item->status_approved == 'rejected' && $item->status_paid == 'rejected')
                                                        <th style="width: 3%">Status</th>
                                                    @elseif ($item->status_approved == 'rejected' && $item->status_paid == 'pending')
                                                        <th style="width: 3%">Status</th>
                                                    @elseif ($item->status_approved == 'pending' && $item->status_paid == 'pending')
                                                        <th style="width: 3%">Status</th>
                                                    @elseif ($item->status_approved == 'approved' && $item->status_paid == 'pending')
                                                        <th style="width: 3%">Status</th>
                                                    @elseif ($item->status_approved == 'approved' && $item->status_paid == 'paid')
                                                        <th style="width: 3%">Status</th>
                                                    @endif
                                                @endif
                                                @if ($CA && count($CA) > 0)
                                                    @php
                                                        $item = $CA[0];
                                                    @endphp
                                                    @if ($item->status_approved == 'rejected' && $item->status_paid == 'rejected')
                                                        <th style="width: 3%">Status</th>
                                                    @elseif ($item->status_approved == 'rejected' && $item->status_paid == 'pending')
                                                        <th style="width: 3%">Status</th>
                                                    @elseif ($item->status_approved == 'pending' && $item->status_paid == 'pending')
                                                        <th style="width: 3%">Status</th>
                                                    @elseif ($item->status_approved == 'approved' && $item->status_paid == 'pending')
                                                        <th style="width: 3%">Status</th>
                                                    @elseif ($item->status_approved == 'approved' && $item->status_paid == 'paid')
                                                        <th style="width: 3%">Status</th>
                                                    @endif
                                                @endif
                                                @if ($CAR && count($CAR) > 0)
                                                    @php
                                                        $item = $CAR[0];
                                                    @endphp
                                                    @if ($item->status_approved == 'rejected' && $item->status_paid == 'rejected')
                                                        <th style="width: 3%">Status</th>
                                                    @elseif ($item->status_approved == 'rejected' && $item->status_paid == 'pending')
                                                        <th style="width: 3%">Status</th>
                                                    @elseif ($item->status_approved == 'pending' && $item->status_paid == 'pending')
                                                        <th style="width: 3%">Status</th>
                                                    @elseif ($item->status_approved == 'approved' && $item->status_paid == 'pending')
                                                        <th style="width: 3%">Status</th>
                                                    @elseif ($item->status_approved == 'approved' && $item->status_paid == 'paid')
                                                        <th style="width: 3%">Status</th>
                                                    @endif
                                                @endif
                                            </tr>

                                        </thead>
                                        <tbody>
                                            @if ($reimbursement)
                                                @foreach ($reimbursement as $item)
                                                    <tr>
                                                        <td><a
                                                                href="{{ route('karyawan.reimbursement.view_reimbursement', $item->id) }}">{{ $item->no_doku_real }}</a>
                                                        </td>
                                                        @if ($item->status_approved == 'rejected' && $item->status_paid == 'rejected')
                                                            <td style="text-align: center; color: #FF3131">
                                                                <label style="font-weight: bold">Submitted</label>
                                                            </td>
                                                        @elseif ($item->status_approved == 'rejected' && $item->status_paid == 'pending')
                                                            <td style="text-align: center; color: #FF3131">
                                                                <label style="font-weight: bold">Rejected</label>
                                                            </td>
                                                        @elseif ($item->status_approved == 'pending' && $item->status_paid == 'pending')
                                                            <td style="text-align: center; color: #FF914D">
                                                                <label style="font-weight: bold">Waiting For
                                                                    Approval</label>
                                                            </td>
                                                        @elseif ($item->status_approved == 'approved' && $item->status_paid == 'pending')
                                                            <td style="text-align: center;color: #00BF63;">
                                                                <label
                                                                    style="font-weight: bold; text-transform: uppercase">Approved</label>
                                                            </td>
                                                        @elseif ($item->status_approved == 'approved' && $item->status_paid == 'paid')
                                                            <td style="text-align: center;color: #00BF63;">
                                                                <label
                                                                    style="font-weight: bold; text-transform: uppercase">Paid</label>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                        <tbody>
                                            @if ($CA)
                                                @foreach ($CA as $item)
                                                    <tr>
                                                        <td><a
                                                                href="{{ route('karyawan.cash_advance.view_cash_advance', $item->id) }}">{{ $item->no_doku }}</a>
                                                        </td>
                                                        @if ($item->status_approved == 'rejected' && $item->status_paid == 'rejected')
                                                            <td style="text-align: center; color: #FF3131">
                                                                <label style="font-weight: bold">Submitted</label>
                                                            </td>
                                                        @elseif ($item->status_approved == 'rejected' && $item->status_paid == 'pending')
                                                            <td style="text-align: center; color: #FF3131">
                                                                <label style="font-weight: bold">Rejected</label>
                                                            </td>
                                                        @elseif ($item->status_approved == 'pending' && $item->status_paid == 'pending')
                                                            <td style="text-align: center; color: #FF914D">
                                                                <label style="font-weight: bold">Waiting For
                                                                    Approval</label>
                                                            </td>
                                                        @elseif ($item->status_approved == 'approved' && $item->status_paid == 'pending')
                                                            <td style="text-align: center;color: #00BF63;">
                                                                <label
                                                                    style="font-weight: bold; text-transform: uppercase">Approved</label>
                                                            </td>
                                                        @elseif ($item->status_approved == 'approved' && $item->status_paid == 'paid')
                                                            <td style="text-align: center;color: #00BF63;">
                                                                <label
                                                                    style="font-weight: bold; text-transform: uppercase">Paid</label>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                        <tbody>
                                            @if ($CAR)
                                                @foreach ($CAR as $item)
                                                    <tr>
                                                        <td><a
                                                                href="{{ route('karyawan.cash_advance_report.view_CAR', $item->id) }}">{{ $item->no_doku }}</a>
                                                        </td>
                                                        @if ($item->status_approved == 'rejected' && $item->status_paid == 'rejected')
                                                            <td style="text-align: center; color: #FF3131">
                                                                <label style="font-weight: bold">Submitted</label>
                                                            </td>
                                                        @elseif ($item->status_approved == 'rejected' && $item->status_paid == 'pending')
                                                            <td style="text-align: center; color: #FF3131">
                                                                <label style="font-weight: bold">Rejected</label>
                                                            </td>
                                                        @elseif ($item->status_approved == 'pending' && $item->status_paid == 'pending')
                                                            <td style="text-align: center; color: #FF914D">
                                                                <label style="font-weight: bold">Waiting For
                                                                    Approval</label>
                                                            </td>
                                                        @elseif ($item->status_approved == 'approved' && $item->status_paid == 'pending')
                                                            <td style="text-align: center;color: #00BF63;">
                                                                <label
                                                                    style="font-weight: bold; text-transform: uppercase">Approved</label>
                                                            </td>
                                                        @elseif ($item->status_approved == 'approved' && $item->status_paid == 'paid')
                                                            <td style="text-align: center;color: #00BF63;">
                                                                <label
                                                                    style="font-weight: bold; text-transform: uppercase">Paid</label>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                    <!-- /.container-fluid -->
                                    {{ $reimbursement->links('pagination::bootstrap-5') }}
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.container-fluid -->





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
