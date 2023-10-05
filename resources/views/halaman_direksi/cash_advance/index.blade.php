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
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary text-center">Daftar dan Lihat Cash Advance
                            </h6>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('direksi.cash_advance.tambah_CA') }}" class="btn btn-success"
                                style="margin-bottom: 20px">
                                <i class="fa-solid fa-plus fa-flip"></i>&nbsp;Ajukan CA
                            </a>
                            @if (Session::has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ Session::get('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if (Session::has('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ Session::get('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead class="text-center">
                                        <tr>
                                            <th style="width: 2%">No Dokumen</th>

                                            @if ($cash_advance && count($cash_advance) > 0)
                                                @php
                                                    $item = $cash_advance[0];
                                                @endphp
                                                @if ($item->status_approved == 'rejected' && $item->status_paid == 'rejected')
                                                    <th style="width: 2%">Status</th>
                                                @elseif ($item->status_approved == 'rejected' && $item->status_paid == 'pending')
                                                    <th style="width: 2%">Status</th>
                                                @elseif ($item->status_approved == 'pending' && $item->status_paid == 'pending')
                                                    <th style="width: 2%">Status</th>
                                                @elseif ($item->status_approved == 'approved' && $item->status_paid == 'pending')
                                                    <th style="width: 2%">Status</th>
                                                @elseif ($item->status_approved == 'approved' && $item->status_paid == 'paid')
                                                    <th style="width: 2%">Status</th>
                                                @endif
                                            @endif

                                        </tr>

                                    </thead>
                                    <tbody>
                                        @if ($cash_advance)
                                            @foreach ($cash_advance as $item)
                                                <tr>
                                                    <td><a
                                                            href="{{ route('direksi.cash_advance.view_cash_advance', $item->id) }}">{{ $item->no_doku }}</a>
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
                                                        <td
                                                            style="text-align: center; color: #FF914D; text-transform: capitalize;">
                                                            <b><label>Waiting for Approval</label></b>
                                                        </td>
                                                    @elseif ($item->status_approved == 'approved' && $item->status_paid == 'pending')
                                                        <td style="text-align: center;color: #0097B2;">
                                                            <label
                                                                style="font-weight: bold; text-transform: uppercase">Approved</label>
                                                        </td>
                                                    @elseif ($item->status_approved == 'approved' && $item->status_paid == 'paid')
                                                        <td style="text-align: center;color: #0097B2;">
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
                                {{ $cash_advance->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
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
