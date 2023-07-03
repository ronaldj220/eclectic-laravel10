<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eclectic (Direksi) | {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="icon" href="{{ asset('logo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


</head>

<body>
    <!-- Begin Page Content -->
    <div class="container" style="margin-right: 60px">
        <figure class="text-center" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
            <b><a style="text-transform: uppercase;">reimbursement</a></b>
            <br>
            <b><a style="text-transform: uppercase;">PT. Eclectic Consulting</a></b>
        </figure>
        <br>
        <table class="table table-borderless table-sm"
            style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 12px">
            <tr>
                <td>No<br>Tanggal</td>
                <td>: {{ $reimbursement->no_doku }}<br>: {{ date('d.m.Y', strtotime($reimbursement->tgl_diajukan)) }}
                </td>
            </tr>
        </table>
        @if ($reimbursement->halaman == 'RB')
            <table class="table is-striped table-bordered border-dark table-sm"
                style="width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
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
                            {{ date('d/m/Y', strtotime($item->tanggal_1)) }}
                        </td>
                        <td class="text-center" style="max-width: 12%; word-break: break-all;">
                            {{ $item->no_bukti }}</td>
                        <td class="text-center" style="max-width: 5%;">{{ $item->curr }}
                        </td>
                        <td class="text-end">
                            {{ number_format($item->nominal, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
                <!-- Total Price -->
                <tr style="font-weight: bold">
                    <td colspan="3" class="text-end">Jumlah</td>
                    <td class="text-center">{{ $item->curr }}</td>
                    <td class="text-end">{{ number_format($nominal, 0, ',', '.') }}</td>
                </tr>
            </table>
            <!-- /.container-fluid -->
            <div>
                <table class="table is-striped table-bordered border-dark text-center"
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
                    <tr style="height:3cm;">
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Pemohon,</div>
                            @if ($karyawan->signature)
                                <div style="text-align: center;">
                                    <img id="ttdImage" src="{{ asset('ttd_karyawan/' . $karyawan->signature) }}"
                                        alt="" width="50%" style="margin-bottom: 5px; margin-right: -30px;">
                                </div>
                            @else
                                <div class="center"></div>
                            @endif
                            <div class="center">{{ $reimbursement->pemohon }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Accounting,</div>
                            <br><br><br><br>
                            <div class="center">{{ $reimbursement->accounting }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Kasir,</div>
                            <br><br><br><br>
                            <div class="center">{{ $reimbursement->kasir }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Menyetujui,</div>
                            <br><br><br><br>
                            <div class="center">{{ $reimbursement->menyetujui }}</div>
                        </td>
                    </tr>
                </table>
            </div>
            <br>
        @elseif ($reimbursement->halaman == 'TS')
            <table class="table is-striped table-bordered border-dark table-sm"
                style="width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
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
                        <td style="text-transform:capitalize;">{{ $item->nama_karyawan }}</td>
                        <td></td>
                        <td class="text-center">{{ $item->curr }}</td>
                        <td class="text-end">
                            {{ number_format($results_TS[$index], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                <!-- Total Price -->
                <tr style="font-weight: bold">
                    <td colspan="3" class="text-end">Jumlah</td>
                    <td class="text-center">{{ $item->curr }}</td>
                    <td class="text-end">{{ number_format($total_TS, 0, ',', '.') }}</td>
                </tr>
            </table>
            <!-- /.container-fluid -->
            <div>
                <table class="table is-striped table-bordered border-dark text-center"
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
                    <tr style="height:3cm;">
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Pemohon,</div>
                            <br><br><br><br>
                            <div class="center">{{ $reimbursement->pemohon }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Accounting,</div>
                            <br><br><br><br>
                            <div class="center">{{ $reimbursement->accounting }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Kasir,</div>
                            <br><br><br><br>
                            <div class="center">{{ $reimbursement->kasir }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Menyetujui,</div>
                            <br><br><br><br>
                            <div class="center">{{ $reimbursement->menyetujui }}</div>
                        </td>
                    </tr>
                </table>
            </div>
            <br>
        @elseif ($reimbursement->halaman == 'ST')
            <table class="table is-striped table-bordered border-dark table-sm"
                style="width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
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
                            {{ number_format($results[$index], 0, ',', '.') }}</td>
                    </tr>
                @endforeach

                <!-- Total Price -->
                <tr style="font-weight: bold">
                    <td colspan="3" class="text-end">Jumlah</td>
                    <td class="text-center">{{ $item->curr }}</td>
                    <td class="text-end">{{ number_format($total, 0, ',', '.') }}
                </tr>
            </table>
            <!-- /.container-fluid -->
            <div>
                <table class="table is-striped table-bordered border-dark text-center"
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
                    <tr style="height:3cm;">
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Pemohon,</div>
                            <br><br><br><br>
                            <div class="center">{{ $reimbursement->pemohon }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Accounting,</div>
                            <br><br><br><br>
                            <div class="center">{{ $reimbursement->accounting }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Kasir,</div>
                            <br><br><br><br>
                            <div class="center">{{ $reimbursement->kasir }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Menyetujui,</div>
                            <br><br><br><br>
                            <div class="center">{{ $reimbursement->menyetujui }}</div>
                        </td>
                    </tr>
                </table>
            </div>
            <br>
        @elseif ($reimbursement->halaman == 'SL')
            <table class="table is-striped table-bordered border-dark table-sm"
                style="width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
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
                            {{ number_format($results[$index], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                <!-- Total Price -->
                <tr style="font-weight: bold">
                    <td colspan="3" class="text-end">Jumlah</td>
                    <td class="text-center">{{ $item->curr }}</td>
                    <td class="text-end">{{ number_format($total_ST, 0, ',', '.') }}
                </tr>
            </table>
            <!-- /.container-fluid -->
            <div>
                <table class="table is-striped table-bordered border-dark text-center"
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
                    <tr style="height:3cm;">
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Pemohon,</div>
                            <br><br><br><br>
                            <div class="center">{{ $reimbursement->pemohon }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Accounting,</div>
                            <br><br><br><br>
                            <div class="center">{{ $reimbursement->accounting }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Kasir,</div>
                            <br><br><br><br>
                            <div class="center">{{ $reimbursement->kasir }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Menyetujui,</div>
                            <br><br><br><br>
                            <div class="center">{{ $reimbursement->menyetujui }}</div>
                        </td>
                    </tr>
                </table>
            </div>
            <br>
        @endif
        <br>
        <div class="d-flex justify-content-center" style="margin-top: 20px">
            <a href="{{ route('direksi.reimbursement') }}" class="btn btn-danger"><i
                    class="fa-solid fa-arrow-left fa-bounce"></i>&nbsp;Kembali</a>

        </div>

    </div>
    <!-- /.container-fluid -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>
