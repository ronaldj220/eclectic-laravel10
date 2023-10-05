<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eclectic (Karyawan) | {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="icon" href="{{ asset('logo.png') }}">

</head>

<body>
    <div class="container">
        <figure class="text-center" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px;">
            <b><a style="text-transform: uppercase;">permintaan pembelian</a></b>
            <br>
            <b><a style="text-transform: uppercase">{{ date('d.m.Y', strtotime($tgl_awal)) }}</a> - <a
                    style="text-transform: uppercase">{{ date('d.m.Y', strtotime($tgl_akhir)) }}</a></b>
        </figure>
        @foreach ($PR as $noDokuPR => $items)
            <figure class="text-center" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px;">
                <a style="text-transform: capitalize; font-weight: bold">no. PR: {{ $items[0]->no_doku_PR }}</a>
            </figure>
            <figure class="text-end"
                style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-top: -20px;">
                <b><a style="text-transform: capitalize;">tanggal</a></b>
                <b><a style="text-transform: capitalize;">:
                        {{ date('d.m.Y', strtotime($items[0]->tgl_PR)) }}</a></b>
            </figure>
            <table class="table is-striped table-bordered border-dark table-sm"
                style="width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-top: -10px;">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 3%">No.</th>
                        <th class="text-center" style="width: 30%">Nama Barang</th>
                        <th class="text-center" style="width: 5%;" colspan="2">Qty</th>
                        <th class="text-center" style="width: 5%">Tgl. Pakai</th>
                        <th class="text-center" style="width: 12%">Keterangan</th>
                    </tr>
                </thead>
                <?php $no = 1; ?>
                @foreach ($items as $item)
                    <tr>
                        <td class="text-center" style="max-width: 5%;">{{ $no++ . '.' }}</td>
                        <td style="text-transform: capitalize">
                            {{ $item->deskripsi_PR }}
                            @if ($item->tgl_1 && $item->tgl_2)
                                {{ date('d/m/Y', strtotime($item->tgl_1)) }} -
                                {{ date('d/m/Y', strtotime($item->tgl_2)) }}
                            @elseif ($item->tgl_1)
                                {{ date('d/m/Y', strtotime($item->tgl_1)) }}
                            @endif
                        </td>
                        <td class="text-center" style="max-width: 12%; word-break: break-all;">
                            @if (floor($item->jumlah_PR) == $item->jumlah_PR)
                                {{ number_format($item->jumlah_PR, 0, ',', '.') }}
                            @else
                                {{ number_format($item->jumlah_PR, 1, ',', '.') }}
                            @endif
                        </td>
                        <td class="text-center" style="max-width: 12%; word-break: break-all;">
                            {{ $item->satuan }}</td>
                        <td class="text-center" style="max-width: 12%; word-break: break-all;">
                            {{ date('d/m/Y', strtotime($item->tgl_pakai)) }}</td>
                        <td class="text-justify" style="max-width: 12%; word-break: break-all;">
                            {{ $item->project }}</td>
                    </tr>
                @endforeach
            </table>
            <div class="container  text-center">
                <div class="row gx-5">
                    <div class="col">
                        <div class="p-3">

                        </div>
                    </div>
                    <div class="col" style="margin-right: -28px; margin-top: -30px;">
                        <div class="p-3">
                            <table class="table is-striped table-bordered border-dark text-center"
                                style="font-family: Arial, Helvetica, sans-serif; font-size: 10px;">
                                <tr>

                                    <td style="width: 50%; text-align: center; ">
                                        <div style="font-weight: bold;">Pembuat,</div>
                                        <div style="margin-top: 50px"></div>

                                        <div style="text-align: center; margin-top: -3px;">
                                            {{ $items[0]->pemohon_PR }}</div>
                                    </td>
                                    <td style="width: 50%; text-align: center;">
                                        <div style="font-weight: bold;">Menyetujui,</div>
                                        <div style="margin-top: 50px"></div>

                                        <div style="text-align: center; margin-top: -3px;">
                                            {{ $items[0]->direksi_PR }}</div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>
