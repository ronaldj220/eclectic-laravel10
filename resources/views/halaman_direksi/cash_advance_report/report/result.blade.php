<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eclectic (Direksi) | {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="icon" href="{{ asset('logo.png') }}">

</head>

<body>
    <?php $totalAllCAR = 0; ?>
    <div class="container">
        <figure class="text-center"
            style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size: 10px;">
            <b><a style="text-transform: uppercase;">cash advance report</a></b>
            <br>
            <a style="text-transform: capitalize;">PT. Eclectic Consulting</a>
            <br>
            <b><a style="text-transform: uppercase">{{ date('d.m.Y', strtotime($tgl_awal)) }}</a> - <a
                    style="text-transform: uppercase">{{ date('d.m.Y', strtotime($tgl_akhir)) }}</a></b>
        </figure>
        @foreach ($CAR as $no_doku_CAR => $items)
            <table class="table table-borderless table-sm"
                style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-left: -5px; margin-top: -10px;">
                <tr>
                    <td>No<br>Tanggal</td>
                    <td>
                        : {{ $no_doku_CAR }}<br>
                        : {{ date('d.m.Y', strtotime($items[0]->tgl_diajukan)) }}
                    </td>
                </tr>
            </table>
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
                    <tr>
                        <th class="text-center " style="width: 100%; text-transform:capitalize;" colspan="5">
                            {{ $items[0]->judul_doku }}
                        </th>
                    </tr>
                </thead>
                <?php $no = 1;
                $totalSumCAR = 0; ?>
                @foreach ($items as $item)
                    <tr>
                        <td class="text-center" style="max-width: 5%;">{{ $no++ . '.' }}
                        </td>
                        <td style="text-transform:capitalize;">{{ $item->CAR_detail }}
                            @if ($item->tgl_1 && $item->tgl_2)
                                @php
                                    $tanggal1 = \Carbon\Carbon::parse($item->tgl_1);
                                    $tanggal2 = \Carbon\Carbon::parse($item->tgl_2);
                                @endphp
                                {{ date('d/m/y', strtotime($item->tgl_1)) }} -
                                {{ date('d/m/y', strtotime($item->tgl_2)) }}
                            @elseif ($item->tgl_1)
                                {{ date('d/m/y', strtotime($item->tgl_1)) }}
                            @endif
                            @if ($item->keperluan)
                                ({{ $item->keperluan }})
                            @endif
                        </td>
                        <td class="text-center" style="max-width: 12%; word-break: break-all;">
                            {{ $item->nobu }}</td>
                        <td class="text-center">{{ $item->curr }}</td>
                        <td class="text-end">{{ number_format($item->nominal_CAR, 2, ',', '.') }}</td>
                    </tr>
                    <?php $totalSumCAR += $item->nominal_CAR; ?>
                @endforeach
                <tr style="font-weight: bold">
                    <td colspan="3" class="text-end">Jumlah</td>
                    <td class="text-center">{{ $item->curr }}</td>
                    <td class="text-end">{{ number_format($totalSumCAR, 2, ',', '.') }}</td>
                </tr>
                <tr style="font-weight: bold">
                    <td colspan="3" class="text-end">Cash Advance {{ $items[0]->tipe_ca }}</td>
                    <td class="text-center">{{ $item->curr }}</td>
                    <td class="text-end">{{ number_format($items[0]->nominal_ca, 2, ',', '.') }}</td>
                </tr>
                @if ($totalSumCAR < $items[0]->nominal_ca)
                    <tr style="font-weight: bold">
                        <td colspan="3" class="text-end">Lebih</td>
                        <td class="text-center">{{ $item->curr }}</td>
                        <td class="text-end">
                            {{ number_format(abs($totalSumCAR - $items[0]->nominal_ca), 2, ',', '.') }}</td>
                    </tr>
                @elseif ($totalSumCAR > $items[0]->nominal_ca)
                    <tr style="font-weight: bold">
                        <td colspan="3" class="text-end" style="color: red">Kurang</td>
                        <td class="text-center" style="color: red">{{ $item->curr }}</td>
                        <td class="text-end" style="color: red">
                            {{ number_format(abs($totalSumCAR - $items[0]->nominal_ca), 2, ',', '.') }}</td>
                    </tr>
                @elseif ($totalSumCAR = $items[0]->nominal_ca)
                    <tr style="font-weight: bold">
                        <td colspan="3" class="text-end">Kurang</td>
                        <td class="text-center">{{ $item->curr }}</td>
                        <td class="text-end">
                            {{ number_format(abs($totalSumCAR - $items[0]->nominal_ca), 2, ',', '.') }}</td>
                    </tr>
                @endif
            </table>
            <div>
                <table class="table is-striped table-bordered border-dark text-center"
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-top: -20px;">
                    <tr style="height:2cm;">
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Pemohon,</div>
                            <div style="margin-top: 40px"></div>
                            <div class="center">{{ $items[0]->pemohon_ca }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Accounting,</div>
                            <div style="margin-top: 40px"></div>
                            <div class="center">{{ $items[0]->acc_ca }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Kasir,</div>
                            <div style="margin-top: 40px"></div>
                            <div class="center">{{ $items[0]->kasir_ca }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="font-weight: bold">Menyetujui,</div>
                            <div style="margin-top: 40px"></div>
                            <div class="center">{{ $items[0]->direksi }}</div>
                        </td>
                    </tr>
                </table>
            </div>
            <?php $totalAllCAR += $totalSumCAR; ?>
        @endforeach
        <div class="text-end fw-bold">
            Total CAR Rp. {{ number_format($totalAllCAR, 2, ',', '.') }}
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>
