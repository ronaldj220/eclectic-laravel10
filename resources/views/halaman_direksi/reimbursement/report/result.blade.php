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
    <div class="container" style="margin-right: 60px">
        <figure class="text-center" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px;">
            <b><a style="text-transform: uppercase;">reimbursement</a></b>
            <br>
            <b><a style="text-transform: uppercase;">PT. Eclectic Consulting</a></b>
            <br>
            <b><a style="text-transform: uppercase">{{ date('d.m.Y', strtotime($tgl_awal)) }}</a> - <a
                    style="text-transform: uppercase">{{ date('d.m.Y', strtotime($tgl_akhir)) }}</a></b>
        </figure>
        <?php
        $TotalAkhir = 0;
        // Total Akhir Semua;
        $totalAkhirRB = 0;
        $totalAkhirTS = 0;
        $totalAkhirST = 0;
        $totalAkhirSL = 0;
        ?>
        @foreach ($reimbursements as $noDokuReal => $items)
            <table class="table table-borderless table-sm"
                style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-left: -5px; margin-top: -10px;">
                <tr>
                    <td>No<br>Tanggal</td>
                    <td>
                        : {{ $noDokuReal }}<br>
                        : {{ date('d.m.Y', strtotime($items[0]->tgl_diajukan)) }}
                    </td>
                </tr>
            </table>
            @if ($items[0]->halaman == 'RB')
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
                    $totalSumRB = 0;
                    ?>
                    @foreach ($items as $item)
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
                            <td class="text-center">
                                {{ $item->curr }}
                            </td>
                            <td class="text-end">
                                {{ number_format($item->nominal, 2, ',', '.') }}
                            </td>

                        </tr>
                        <?php $totalSumRB += $item->nominal; ?>
                    @endforeach
                    <tr style="font-weight: bold">
                        <td colspan="3" class="text-end">Jumlah</td>
                        <td class="text-center">{{ $item->curr }}</td>
                        <td class="text-end">{{ number_format($totalSumRB, 2, ',', '.') }}</td>
                    </tr>
                </table>
                <?php $totalAkhirRB += $totalSumRB; ?>
                <div>
                    <table class="table is-striped table-bordered border-dark text-center"
                        style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-top: -20px;">
                        <tr style="height:2cm;">
                            <td style="width:25%">
                                <div class="center" style="font-weight: bold">Pemohon,</div>
                                <div style="margin-top: 40px"></div>
                                <div class="center">{{ $items[0]->pemohon }}</div>
                            </td>
                            <td style="width:25%">
                                <div class="center" style="font-weight: bold">Accounting,</div>
                                <div style="margin-top: 40px"></div>
                                <div class="center">{{ $items[0]->accounting }}</div>
                            </td>
                            <td style="width:25%">
                                <div class="center" style="font-weight: bold">Kasir,</div>
                                <div style="margin-top: 40px"></div>
                                <div class="center">{{ $items[0]->kasir }}</div>
                            </td>
                            <td style="width:25%">
                                <div class="center" style="font-weight: bold">Menyetujui,</div>
                                <div style="margin-top: 40px"></div>
                                <div class="center">{{ $items[0]->menyetujui }}</div>
                            </td>
                        </tr>
                    </table>
                </div>
            @elseif ($items[0]->halaman == 'TS')
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
                    $totalSumTS = 0;
                    ?>
                    @foreach ($items as $item)
                        <tr>
                            <td class="text-center" style="max-width: 5%;">{{ $no++ . '.' }}
                            </td>
                            <td style="text-transform:capitalize;">{{ $item->nama_TS }} {{ $item->hari_TS }} hari</td>
                            <td></td>
                            <td class="text-center"> IDR</td>
                            <td class="text-end">{{ number_format($item->nominal_ts, 2, ',', '.') }}</td>
                        </tr>
                        <?php $totalSumTS += $item->nominal_ts; ?>
                    @endforeach
                    <tr style="font-weight: bold">
                        <td colspan="3" class="text-end">Jumlah</td>
                        <td class="text-center">IDR</td>
                        <td class="text-end">{{ number_format($totalSumTS, 2, ',', '.') }}</td>
                    </tr>
                </table>
                <?php $totalAkhirTS += $totalSumTS; ?>
                <div>
                    <table class="table is-striped table-bordered border-dark text-center"
                        style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-top: -20px;">
                        <tr style="height:2cm;">
                            <td style="width:25%">
                                <div class="center" style="font-weight: bold">Pemohon,</div>
                                <div style="margin-top: 40px"></div>
                                <div class="center">{{ $items[0]->pemohon }}</div>
                            </td>
                            <td style="width:25%">
                                <div class="center" style="font-weight: bold">Accounting,</div>
                                <div style="margin-top: 40px"></div>
                                <div class="center">{{ $items[0]->accounting }}</div>
                            </td>
                            <td style="width:25%">
                                <div class="center" style="font-weight: bold">Kasir,</div>
                                <div style="margin-top: 40px"></div>
                                <div class="center">{{ $items[0]->kasir }}</div>
                            </td>
                            <td style="width:25%">
                                <div class="center" style="font-weight: bold">Menyetujui,</div>
                                <div style="margin-top: 40px"></div>
                                <div class="center">{{ $items[0]->menyetujui }}</div>
                            </td>
                        </tr>
                    </table>
                </div>
            @elseif ($items[0]->halaman == 'ST')
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
                    $totalSumST = 0;
                    ?>
                    @foreach ($items as $item)
                        <tr>
                            <td class="text-center" style="max-width: 5%;">{{ $no++ . '.' }}
                            </td>
                            <td style="text-transform:capitalize;">{{ $item->nama_ST }} ({{ $item->project_ST }})
                                @if (floor($item->jam_ST) == $item->jam_ST)
                                    {{ number_format($item->jam_ST, 0, ',', '.') }} jam
                                @else
                                    {{ number_format($item->jam_ST, 1, ',', '.') }} jam
                                @endif
                            </td>
                            <td></td>
                            <td class="text-center">IDR</td>
                            <td class="text-end">{{ number_format($item->nominal_astd, 2, ',', '.') }}</td>
                            <?php $totalSumST += $item->nominal_astd; ?>
                        </tr>
                    @endforeach
                    <tr style="font-weight: bold">
                        <td colspan="3" class="text-end">Jumlah</td>
                        <td class="text-center">IDR</td>
                        <td class="text-end">{{ number_format($totalSumST, 2, ',', '.') }}</td>
                    </tr>
                </table>
                <?php $totalAkhirST += $totalSumST; ?>
                <div>
                    <table class="table is-striped table-bordered border-dark text-center"
                        style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-top: -20px;">
                        <tr style="height:2cm;">
                            <td style="width:25%">
                                <div class="center" style="font-weight: bold">Pemohon,</div>
                                <div style="margin-top: 40px"></div>
                                <div class="center">{{ $items[0]->pemohon }}</div>
                            </td>
                            <td style="width:25%">
                                <div class="center" style="font-weight: bold">Accounting,</div>
                                <div style="margin-top: 40px"></div>
                                <div class="center">{{ $items[0]->accounting }}</div>
                            </td>
                            <td style="width:25%">
                                <div class="center" style="font-weight: bold">Kasir,</div>
                                <div style="margin-top: 40px"></div>
                                <div class="center">{{ $items[0]->kasir }}</div>
                            </td>
                            <td style="width:25%">
                                <div class="center" style="font-weight: bold">Menyetujui,</div>
                                <div style="margin-top: 40px"></div>
                                <div class="center">{{ $items[0]->menyetujui }}</div>
                            </td>
                        </tr>
                    </table>
                </div>
            @elseif ($items[0]->halaman == 'SL')
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
                    $totalSumSL = 0;
                    ?>
                    @foreach ($items as $item)
                        <tr>
                            <td class="text-center" style="max-width: 5%;">{{ $no++ . '.' }}
                            </td>
                            <td style="text-transform:capitalize;">{{ $item->nama_SL }} ({{ $item->project_SL }})
                                @if (floor($item->jam_SL) == $item->jam_SL)
                                    {{ number_format($item->jam_SL, 0, ',', '.') }} jam
                                @else
                                    {{ number_format($item->jam_SL, 1, ',', '.') }} jam
                                @endif
                            </td>
                            <td></td>
                            <td class="text-center">IDR</td>
                            <td class="text-end">{{ number_format($item->nominal_asld, 2, ',', '.') }}</td>
                            <?php $totalSumSL += $item->nominal_asld; ?>
                        </tr>
                    @endforeach
                    <tr style="font-weight: bold">
                        <td colspan="3" class="text-end">Jumlah</td>
                        <td class="text-center">IDR</td>
                        <td class="text-end">{{ number_format($totalSumSL, 2, ',', '.') }}</td>
                    </tr>
                </table>
                <?php $totalAkhirSL += $totalSumSL; ?>
                <div>
                    <table class="table is-striped table-bordered border-dark text-center"
                        style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-top: -20px;">
                        <tr style="height:2cm;">
                            <td style="width:25%">
                                <div class="center" style="font-weight: bold">Pemohon,</div>
                                <div style="margin-top: 40px"></div>
                                <div class="center">{{ $items[0]->pemohon }}</div>
                            </td>
                            <td style="width:25%">
                                <div class="center" style="font-weight: bold">Accounting,</div>
                                <div style="margin-top: 40px"></div>
                                <div class="center">{{ $items[0]->accounting }}</div>
                            </td>
                            <td style="width:25%">
                                <div class="center" style="font-weight: bold">Kasir,</div>
                                <div style="margin-top: 40px"></div>
                                <div class="center">{{ $items[0]->kasir }}</div>
                            </td>
                            <td style="width:25%">
                                <div class="center" style="font-weight: bold">Menyetujui,</div>
                                <div style="margin-top: 40px"></div>
                                <div class="center">{{ $items[0]->menyetujui }}</div>
                            </td>
                        </tr>
                    </table>
                </div>
            @endif
        @endforeach
        <?php $TotalAkhir = $totalAkhirRB + $totalAkhirTS + $totalAkhirST + $totalAkhirSL; ?>
        <div class="text-end fw-bold">
            Total Reimbursement {{ date('d.m.Y', strtotime($tgl_awal)) }} - {{ date('d.m.Y', strtotime($tgl_akhir)) }}
            Rp. {{ number_format($TotalAkhir, 2, ',', '.') }}
        </div>



    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>
