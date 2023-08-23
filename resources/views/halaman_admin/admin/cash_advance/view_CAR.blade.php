<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eclectic (Admin) | {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="icon" href="{{ asset('logo.png') }}">

</head>

<body>
    <div class="container">
        <figure class="text-center"
            style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; font-size: 10px;">
            <b><a style="text-transform: uppercase;">cash advance report</a></b>
            <br>
            <a style="text-transform: capitalize;">PT. Eclectic Consulting</a>
        </figure>
        <table class="table table-borderless table-sm"
            style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-left: -5px;">
            <tr>
                <td>No<br>Tanggal</td>
                <td>: {{ $CAR->no_doku }}<br>:
                    {{ date('d.m.Y', strtotime($CAR->tgl_diajukan)) }}
                </td>
            </tr>
        </table>
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
                <!-- table title --->
                <tr>
                    <th class="text-center " style="width: 100%; text-transform:capitalize;" colspan="5">
                        {{ $CAR->judul_doku }}</th>
                </tr>
            </thead>
            <!-- Details -->
            <?php $no = 1; ?>
            @foreach ($CAR_Detail as $item)
                <tr>
                    <td class="text-center" style="max-width: 5%;">{{ $no++ . '.' }}
                    </td>
                    <td style="text-transform:capitalize;">{{ $item->deskripsi }}
                        @if ($item->tanggal_1 && $item->tanggal_2)
                            @php
                                $tanggal1 = \Carbon\Carbon::parse($item->tanggal_1);
                                $tanggal2 = \Carbon\Carbon::parse($item->tanggal_2);
                                $selisihHari = $tanggal2->diffInDays($tanggal1);
                            @endphp
                            {{ date('d/m/y', strtotime($item->tanggal_1)) }} -
                            {{ date('d/m/y', strtotime($item->tanggal_2)) }}
                            @if ($item->keperluan)
                                ({{ $item->keperluan }})
                            @endif
                        @elseif ($item->tanggal_1)
                            {{ date('d/m/y', strtotime($item->tanggal_1)) }}
                            @if ($item->keperluan)
                                ({{ $item->keperluan }})
                            @endif
                        @endif
                    <td class="text-center" style="max-width: 12%; word-break: break-all;">
                        {{ $item->no_bukti }}</td>
                    <td class="text-center" style="max-width: 5%;">{{ $item->curr }}
                    </td>
                    <td class="text-end">
                        {{ number_format($item->nominal, 2, ',', '.') }}
                    </td>
                </tr>
            @endforeach
            <tr style="font-weight: bold">
                <td colspan="3" class="text-end">Jumlah</td>
                <td class="text-center">{{ $item->curr }}</td>
                <td class="text-end">{{ number_format($nominal, 2, ',', '.') }}</td>
            </tr>
            <tr style="font-weight: bold">
                <td colspan="3" class="text-end">Cash Advance {{ $CAR->tipe_ca }}</td>
                <td class="text-center">{{ $item->curr }}</td>
                <td class="text-end">{{ number_format($CAR->nominal_ca, 2, ',', '.') }}</td>
            </tr>
            @if ($nominal < $CAR->nominal_ca)
                <tr style="font-weight: bold">
                    <td colspan="3" class="text-end">Lebih</td>
                    <td class="text-center">{{ $item->curr }}</td>
                    <td class="text-end">
                        {{ number_format(abs($nominal - $CAR->nominal_ca), 2, ',', '.') }}</td>
                </tr>
            @elseif ($nominal > $CAR->nominal_ca)
                <tr style="font-weight: bold">
                    <td colspan="3" class="text-end" style="color: red">Kurang</td>
                    <td class="text-center" style="color: red">{{ $item->curr }}</td>
                    <td class="text-end" style="color: red">
                        {{ number_format(abs($nominal - $CAR->nominal_ca), 2, ',', '.') }}</td>
                </tr>
            @elseif ($nominal = $CAR->nominal_ca)
                <tr style="font-weight: bold">
                    <td colspan="3" class="text-end">Kurang</td>
                    <td class="text-center">{{ $item->curr }}</td>
                    <td class="text-end">
                        {{ number_format(abs($nominal - $CAR->nominal_ca), 2, ',', '.') }}</td>
                </tr>
            @endif
        </table>
        <div class="container text-center">
            <div class="row gx-5">
                <div class="col">

                </div>
                <div class="col" style="margin-right: -28px; margin-top: -30px;">
                    <div class="p-3">
                        <table class="table is-striped table-bordered border-dark text-center"
                            style="font-family: Arial, Helvetica, sans-serif; font-size: 10px;">
                            <tr>

                                <td style="width: 50%; text-align: center; ">
                                    <div class="center" style="font-weight: bold">Pemohon,</div>
                                    <div style="margin-top: 40px"></div>
                                    <div class="center">{{ $CAR->pemohon }}</div>
                                </td>
                                <td style="width: 50%; text-align: center;">
                                    <div class="center" style="font-weight: bold">Menyetujui,</div>
                                    <div style="margin-top: 40px"></div>
                                    <div class="center">{{ $CAR->menyetujui }}</div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if ($CAR->status_approved == 'approved' && $CAR->status_paid == 'pending')
            <div class="container" style="margin-top: -30px">
                <div class="row">
                    <div class="col">
                    </div>
                    @if ($CAR->menyetujui == 'Aris')
                        <div class="col">
                        </div>
                    @else
                        <div class="col">
                            <table class="table table-borderless table-sm"
                                style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-left: 430px; margin-right: -10px;">
                                <tr class="text-center">
                                    <td>Approved on
                                        {{ date('d/m/Y', strtotime($CAR->tgl_persetujuan)) }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        @elseif ($CAR->status_approved == 'approved' && $CAR->status_paid == 'paid')
            <div class="container" style="margin-top: -30px">
                <div class="row">
                    <div class="col">
                    </div>
                    @if ($CAR->menyetujui == 'Aris')
                        <div class="col">
                        </div>
                    @else
                        <div class="col">
                            <table class="table table-borderless table-sm"
                                style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-left: 430px; margin-right: -10px;">
                                <tr class="text-center">
                                    <td>Approved on
                                        {{ date('d/m/Y', strtotime($CAR->tgl_persetujuan)) }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>
