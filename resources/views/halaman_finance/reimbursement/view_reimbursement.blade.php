<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eclectic (Finance) | {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="icon" href="{{ asset('logo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


</head>

<body>
    <!-- Begin Page Content -->
    <div class="container" style="margin-right: 60px">
        <figure class="text-center" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px;">
            <b><a style="text-transform: uppercase;">reimbursement</a></b>
            <br>
            <b><a style="text-transform: uppercase;">PT. Eclectic Consulting</a></b>
        </figure>
        <table class="table table-borderless table-sm"
            style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 10px">
            <tr>
                <td>No<br>Tanggal</td>
                @if ($reimbursement->status_approved == 'hold' && $reimbursement->status_paid == 'hold')
                    <td>: {{ $reimbursement->no_doku_draft }}<br>:
                        {{ date('d.m.Y', strtotime($reimbursement->tgl_diajukan)) }}
                    </td>
                @else
                    <td>: {{ $reimbursement->no_doku_real }}<br>:
                        {{ date('d.m.Y', strtotime($reimbursement->tgl_diajukan)) }}
                    </td>
                @endif
            </tr>
        </table>
        @if ($reimbursement->halaman == 'RB')
            <table class="table is-striped table-bordered border-dark table-sm"
                style="width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 10px;">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 3%">No.</th>
                        <th class="text-center" style="width: 68%">Keterangan</th>
                        <th class="text-center" style="width: 12%;">No. Bukti</th>
                        <th class="text-center" style="width: 5%">Curr</th>
                        <th class="text-center" style="width: 12%">Nominal</th>
                    </tr>
                    <tr>
                        <th class="text-center" style="width: 100%; text-transform:capitalize;" colspan="5">
                            {{ $reimbursement->judul_doku }}</th>
                    </tr>
                </thead>
                <!-- Details -->
                <?php $no = 1; ?>
                @foreach ($rb_detail as $item)
                    <tr>
                        <td class="text-center" style="max-width: 5%;">{{ $no++ . '.' }}
                        </td>
                        <td style="text-transform:capitalize;">{{ $item->deskripsi }}
                            @if ($item->tanggal_1 && $item->tanggal_2)
                                @php
                                    $tanggal1 = \Carbon\Carbon::parse($item->tanggal_1);
                                    $tanggal2 = \Carbon\Carbon::parse($item->tanggal_2);
                                @endphp
                                {{ date('d/m/y', strtotime($item->tanggal_1)) }} -
                                {{ date('d/m/y', strtotime($item->tanggal_2)) }}
                            @elseif ($item->tanggal_1)
                                {{ date('d/m/y', strtotime($item->tanggal_1)) }}
                            @endif
                            @if ($item->keperluan)
                                ({{ $item->keperluan }})
                            @endif
                        </td>
                        <td class="text-center" style="max-width: 12%; word-break: break-all;">
                            {{ $item->no_bukti }}</td>
                        <td class="text-center" style="max-width: 5%;">{{ $item->curr }}
                        </td>
                        <td class="text-end">
                            {{ number_format($item->nominal, 2, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
                <!-- Total Price -->
                <tr style="font-weight: bold">
                    <td colspan="3" class="text-end">Jumlah</td>
                    <td class="text-center">{{ $item->curr }}</td>
                    <td class="text-end">{{ number_format($nominal, 2, ',', '.') }}</td>
                </tr>
            </table>
            <!-- /.container-fluid -->
            <div>
                <table class="table is-striped table-bordered border-dark text-center"
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 10px;">
                    <tr style="height:3cm;">
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Pemohon,</div>
                            <div style="margin-top: 70px"></div>
                            <div class="center">{{ $reimbursement->pemohon }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Accounting,</div>
                            <div style="margin-top: 70px"></div>
                            <div class="center">{{ $reimbursement->accounting }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Kasir,</div>
                            <div style="margin-top: 70px"></div>
                            <div class="center">{{ $reimbursement->kasir }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Menyetujui,</div>
                            <div style="margin-top: 70px"></div>

                            <div class="center">{{ $reimbursement->menyetujui }}</div>
                        </td>
                    </tr>
                </table>
            </div>
            @if ($reimbursement->status_approved == 'approved' && $reimbursement->status_paid == 'pending')
                <div class="container" style="margin-top: -20px">
                    <div class="row">
                        <div class="col">
                        </div>
                        @if ($reimbursement->menyetujui == 'Aris')
                            <div class="col">
                            </div>
                        @else
                            <div class="col">
                                <table class="table table-borderless table-sm"
                                    style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-left: 415px; margin-right: -10px;">
                                    <tr class="text-center">
                                        <td>Approved on
                                            {{ date('d/m/Y', strtotime($reimbursement->tgl_persetujuan)) }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            @elseif ($reimbursement->status_approved == 'approved' && $reimbursement->status_paid == 'paid')
                <div class="container" style="margin-top: -20px">
                    <div class="row">
                        <div class="col">
                        </div>
                        @if ($reimbursement->menyetujui == 'Aris')
                            <div class="col">
                            </div>
                        @else
                            <div class="col">
                                <table class="table table-borderless table-sm"
                                    style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-left: 200px; margin-right: -10px;">
                                    <tr class="text-center">
                                        <td>Approved on
                                            {{ date('d/m/Y', strtotime($reimbursement->tgl_persetujuan)) }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        @elseif ($reimbursement->halaman == 'TS')
            <table class="table is-striped table-bordered border-dark table-sm"
                style="width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 10px;">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 3%">No.</th>
                        <th class="text-center" style="width: 68%">Keterangan</th>
                        <th class="text-center" style="width: 12%;">No. Bukti</th>
                        <th class="text-center" style="width: 5%">Curr</th>
                        <th class="text-center" style="width: 12%">Nominal</th>
                    </tr>
                    <tr>
                        <th class="text-center" style="width: 100%; text-transform:capitalize;" colspan="5">
                            {{ $reimbursement->judul_doku }}</th>
                    </tr>
                </thead>
                <!-- Details -->
                <?php $no = 1; ?>
                @foreach ($timesheet_project_detail as $index => $item)
                    <tr>
                        <td class="text-center" style="max-width: 5%;">{{ $no++ . '.' }}
                        </td>
                        <td style="text-transform:capitalize;">{{ $item->nama_karyawan }} {{ $item->hari }} hari
                        </td>
                        <td></td>
                        <td class="text-center">{{ $item->curr }}</td>
                        <td class="text-end">
                            {{ number_format($results_TS[$index], 2, ',', '.') }}</td>
                    </tr>
                @endforeach
                <!-- Total Price -->
                <tr style="font-weight: bold">
                    <td colspan="3" class="text-end">Jumlah</td>
                    <td class="text-center">{{ $item->curr }}</td>
                    <td class="text-end">{{ number_format($total_TS, 2, ',', '.') }}</td>
                </tr>
            </table>
            <!-- /.container-fluid -->
            <div>
                <table class="table is-striped table-bordered border-dark text-center"
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 10px;">
                    <tr style="height:3cm;">
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Pemohon,</div>
                            <div style="margin-top: 70px"></div>
                            <div class="center">{{ $reimbursement->pemohon }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Accounting,</div>
                            <div style="margin-top: 70px"></div>
                            <div class="center">{{ $reimbursement->accounting }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Kasir,</div>
                            <div style="margin-top: 70px"></div>
                            <div class="center">{{ $reimbursement->kasir }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Menyetujui,</div>
                            <div style="margin-top: 70px"></div>
                            <div class="center">{{ $reimbursement->menyetujui }}</div>
                        </td>
                    </tr>
                </table>
            </div>
            <br>
        @elseif ($reimbursement->halaman == 'ST')
            <table class="table is-striped table-bordered border-dark table-sm"
                style="width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 10px;">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 3%">No.</th>
                        <th class="text-center" style="width: 68%">Keterangan</th>
                        <th class="text-center" style="width: 12%;">No. Bukti</th>
                        <th class="text-center" style="width: 5%">Curr</th>
                        <th class="text-center" style="width: 12%">Nominal</th>
                    </tr>
                    <tr>
                        <th class="text-center" style="width: 100%; text-transform:capitalize;" colspan="5">
                            {{ $reimbursement->judul_doku }}</th>
                    </tr>
                </thead>
                <!-- Details -->
                <?php $no = 1; ?>
                @foreach ($support_ticket_detail as $index => $item)
                    <tr>
                        <td class="text-center" style="max-width: 5%;">{{ $no++ . '.' }}
                        </td>
                        <td style="text-transform:capitalize;">{{ $item->nama_karyawan }}
                            ({{ $item->aliases }})
                        </td>
                        <td></td>
                        <td class="text-center">{{ $item->curr }}</td>
                        <td class="text-end">
                            {{ number_format($results[$index], 2, ',', '.') }}</td>
                    </tr>
                @endforeach

                <!-- Total Price -->
                <tr style="font-weight: bold">
                    <td colspan="3" class="text-end">Jumlah</td>
                    <td class="text-center">{{ $item->curr }}</td>
                    <td class="text-end">{{ number_format($total, 2, ',', '.') }}
                </tr>
            </table>
            <!-- /.container-fluid -->
            <div>
                <table class="table is-striped table-bordered border-dark text-center"
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 10px;">
                    <tr style="height:3cm;">
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Pemohon,</div>
                            <div style="margin-top: 70px"></div>
                            <div class="center">{{ $reimbursement->pemohon }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Accounting,</div>
                            <div style="margin-top: 70px"></div>
                            <div class="center">{{ $reimbursement->accounting }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Kasir,</div>
                            <div style="margin-top: 70px"></div>
                            <div class="center">{{ $reimbursement->kasir }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Menyetujui,</div>
                            <div style="margin-top: 70px"></div>
                            <div class="center">{{ $reimbursement->menyetujui }}</div>
                        </td>
                    </tr>
                </table>
            </div>
            <br>
        @elseif ($reimbursement->halaman == 'SL')
            <table class="table is-striped table-bordered border-dark table-sm"
                style="width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 10px;">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 3%">No.</th>
                        <th class="text-center" style="width: 68%">Keterangan</th>
                        <th class="text-center" style="width: 12%;">No. Bukti</th>
                        <th class="text-center" style="width: 5%">Curr</th>
                        <th class="text-center" style="width: 12%">Nominal</th>
                    </tr>
                    <tr>
                        <th class="text-center" style="width: 100%; text-transform:capitalize;" colspan="5">
                            {{ $reimbursement->judul_doku }}</th>
                    </tr>
                </thead>
                <!-- Details -->
                <?php $no = 1; ?>
                @foreach ($support_lembur_detail as $index => $item)
                    <tr>
                        <td class="text-center" style="max-width: 5%;">{{ $no++ . '.' }}
                        </td>
                        <td style="text-transform:capitalize;">{{ $item->nama_karyawan }}
                            ({{ $item->aliases }})
                        </td>
                        <td></td>
                        <td class="text-center">{{ $item->curr }}</td>
                        <td class="text-right">
                            {{ number_format($results[$index], 2, ',', '.') }}</td>
                    </tr>
                @endforeach
                <!-- Total Price -->
                <tr style="font-weight: bold">
                    <td colspan="3" class="text-end">Jumlah</td>
                    <td class="text-center">{{ $item->curr }}</td>
                    <td class="text-end">{{ number_format($total_ST, 2, ',', '.') }}
                </tr>
            </table>
            <!-- /.container-fluid -->
            <div>
                <table class="table is-striped table-bordered border-dark text-center"
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 10px;">
                    <tr style="height:3cm;">
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Pemohon,</div>
                            <div style="margin-top: 70px"></div>
                            <div class="center">{{ $reimbursement->pemohon }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Accounting,</div>
                            <div style="margin-top: 70px"></div>
                            <div class="center">{{ $reimbursement->accounting }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Kasir,</div>
                            <div style="margin-top: 70px"></div>
                            <div class="center">{{ $reimbursement->kasir }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Menyetujui,</div>
                            <div style="margin-top: 70px"></div>
                            <div class="center">{{ $reimbursement->menyetujui }}</div>
                        </td>
                    </tr>
                </table>
            </div>
            <br>
        @endif
        <br>
        <div class="d-flex justify-content-center" style="margin-top: 20px">

            @if ($reimbursement->status_approved == 'pending' && $reimbursement->status_paid == 'pending')
                @if ($reimbursement->pemohon == Auth::guard('kasir')->user()->nama)
                    <a href="{{ route('kasir.beranda') }}" class="btn btn-danger"><i
                            class="fa-solid fa-arrow-left fa-bounce"></i>&nbsp;Kembali</a>
                @endif
            @elseif ($reimbursement->status_approved == 'approved' && $reimbursement->status_paid == 'pending')
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#exampleModal"><i class="fa-solid fa-cash-register fa-beat"></i> &nbsp;
                    Bayar
                </button>
                &nbsp;
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Masukkan Nomor Referensi</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('kasir.reimbursement.paid_RB', $reimbursement->id) }}"
                                    method="POST">
                                    @csrf
                                    <input type="text" name="no_ref" class="form-control"
                                        placeholder="Masukkan Nomor Referensi">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Kembali</button>
                                        <button type="submit" class="btn btn-danger">Bayar</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            @elseif ($reimbursement->status_approved == 'rejected' && $reimbursement->status_paid == 'rejected')

            @elseif ($reimbursement->status_approved == 'rejected' && $reimbursement->status_paid == 'pending')
            @endif
        </div>



    </div>
    <!-- /.container-fluid -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>
