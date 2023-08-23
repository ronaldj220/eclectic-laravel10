<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eclectic (Finance) | {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="icon" href="{{ asset('logo.png') }}">

</head>

<body onload="window.print()">
    <!-- Begin Page Content -->
    <div class="container" style="margin-right: 60px; ">
        <figure class="text-center" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px;">
            <b><a style="text-transform: uppercase;">reimbursement</a></b>
            <br>
            <b><a style="text-transform: uppercase;">PT. Eclectic Consulting</a></b>
        </figure>
        <table class="table table-borderless table-sm"
            style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-left: -5px;">
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
                style="width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-top: -20px;">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 6%">No.</th>
                        <th class="text-center" style="width: 50%; margin-right: -20px;">Keterangan</th>
                        <th class="text-center" style="width: 25%;">No. Bukti</th>
                        <th class="text-center" style="width: 5%">Curr</th>
                        <th class="text-center" style="width: 12%">Nominal</th>
                    </tr>
                    <!-- table title --->
                    <tr>
                        <th class="text-center " style="width: 100%; text-transform:capitalize;" colspan="5">
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
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-top: -20px;">
                    <tr style="height:2cm;">
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Pemohon,</div>
                            <div style="margin-top: 40px"></div>
                            <div class="center">{{ $reimbursement->pemohon }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Accounting,</div>
                            <div style="margin-top: 40px"></div>
                            <div class="center">{{ $reimbursement->accounting }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Kasir,</div>
                            <div style="margin-top: 40px"></div>
                            <div class="center">{{ $reimbursement->kasir }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Menyetujui,</div>
                            <div style="margin-top: 40px"></div>
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
                                    style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-left: 200px; margin-right: -10px;">
                                    <tr class="text-center">
                                        <td>Approved on {{ date('d/m/Y', strtotime($reimbursement->tgl_persetujuan)) }}
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
                                        <td>Approved on {{ date('d/m/Y', strtotime($reimbursement->tgl_persetujuan)) }}
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
                style="width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-top: -20px;">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 3%">No.</th>
                        <th class="text-center" style="width: 50%">Keterangan</th>
                        <th class="text-center" style="width: 15%;">No. Bukti</th>
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
                            {{ number_format($item->nominal, 2, ',', '.') }}</td>
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
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-top: -20px;">
                    <tr style="height:2cm;">
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Pemohon,</div>
                            <div style="margin-top: 40px"></div>
                            <div class="center">{{ $reimbursement->pemohon }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Accounting,</div>
                            <div style="margin-top: 40px"></div>
                            <div class="center">{{ $reimbursement->accounting }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Kasir,</div>
                            <div style="margin-top: 40px"></div>
                            <div class="center">{{ $reimbursement->kasir }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Menyetujui,</div>
                            <div style="margin-top: 40px"></div>
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
                                    style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-left: 200px; margin-right: -10px;">
                                    <tr class="text-center">
                                        <td>Approved on {{ date('d/m/Y', strtotime($reimbursement->tgl_persetujuan)) }}
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
                                        <td>Approved on {{ date('d/m/Y', strtotime($reimbursement->tgl_persetujuan)) }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        @elseif ($reimbursement->halaman == 'ST')
            <table class="table is-striped table-bordered border-dark table-sm"
                style="width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-top: -20px;">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 3%">No.</th>
                        <th class="text-center" style="width: 50%">Keterangan</th>
                        <th class="text-center" style="width: 15%;">No. Bukti</th>
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
                            {{ $item->jam }} jam
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
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-top: -20px;">
                    <tr style="height:2cm;">
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Pemohon,</div>
                            <div style="margin-top: 40px"></div>
                            <div class="center">{{ $reimbursement->pemohon }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Accounting,</div>
                            <div style="margin-top: 40px"></div>
                            <div class="center">{{ $reimbursement->accounting }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Kasir,</div>
                            <div style="margin-top: 40px"></div>
                            <div class="center">{{ $reimbursement->kasir }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Menyetujui,</div>
                            <div style="margin-top: 40px"></div>
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
                                    style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-left: 200px; margin-right: -10px;">
                                    <tr class="text-center">
                                        <td>Approved on {{ date('d/m/Y', strtotime($reimbursement->tgl_persetujuan)) }}
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
                                        <td>Approved on {{ date('d/m/Y', strtotime($reimbursement->tgl_persetujuan)) }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        @elseif ($reimbursement->halaman == 'SL')
            <table class="table is-striped table-bordered border-dark table-sm"
                style="width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-top: -20px;">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 3%">No.</th>
                        <th class="text-center" style="width: 50%">Keterangan</th>
                        <th class="text-center" style="width: 15%;">No. Bukti</th>
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
                            {{ $item->jam }} jam
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
                    <td class="text-end">{{ number_format($total_ST, 2, ',', '.') }}
                </tr>
            </table>
            <!-- /.container-fluid -->
            <div>
                <table class="table is-striped table-bordered border-dark text-center"
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-top: -20px;">
                    <tr style="height:2cm;">
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Pemohon,</div>
                            <div style="margin-top: 40px"></div>
                            <div class="center">{{ $reimbursement->pemohon }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Accounting,</div>
                            <div style="margin-top: 40px"></div>
                            <div class="center">{{ $reimbursement->accounting }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Kasir,</div>
                            <div style="margin-top: 40px"></div>
                            <div class="center">{{ $reimbursement->kasir }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Menyetujui,</div>
                            <div style="margin-top: 40px"></div>
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
                                    style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-left: 200px; margin-right: -10px;">
                                    <tr class="text-center">
                                        <td>Approved on {{ date('d/m/Y', strtotime($reimbursement->tgl_persetujuan)) }}
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
                                        <td>Approved on {{ date('d/m/Y', strtotime($reimbursement->tgl_persetujuan)) }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        @endif
        <br>

    </div>
    <style>
        @media print {
            #printPageButton {
                display: none;
            }

            #hidme {
                display: none;
            }

            #content {
                position: relative;
                display: table;
            }

            #ttdImage {
                width: 125px;
                margin-right: 40px;
                /* Sesuaikan ukuran gambar sesuai kebutuhan */
            }

            #ttdImage2 {
                width: 125px;
                margin-right: -30px;
                /* Sesuaikan ukuran gambar sesuai kebutuhan */
            }


        }

        @page {
            size: 21cm 16cm auto;
        }

        .printableArea {
            width: 10cm;
        }

        body {
            margin-left: 0.6cm;
            margin-right: 0.1cm;
            margin-top: -4px;
        }

        table {
            page-break-inside: auto;
            page-break-after: auto;
            position: relative;
        }
    </style>
    <!-- /.container-fluid -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>
