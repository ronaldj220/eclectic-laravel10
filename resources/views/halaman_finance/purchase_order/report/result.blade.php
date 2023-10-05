@php
    use Carbon\Carbon;
@endphp

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eclectic (Finance) | {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="icon" href="{{ asset('logo.png') }}">

</head>

<body>
    @php
        $totalAll = 0;
    @endphp
    <div class="container">
        <figure class="text-center" style="font-family: Arial, Helvetica, sans-serif; font-size: 10px;">
            <b><a style="text-transform: uppercase;">purchase order</a></b>
            <br>
            <b><a style="text-transform: capitalize;">pt. eclectic consulting</a></b>
            <br>
            <b><a style="text-transform: uppercase">{{ date('d.m.Y', strtotime($tgl_awal)) }}</a> - <a
                    style="text-transform: uppercase">{{ date('d.m.Y', strtotime($tgl_akhir)) }}</a></b>
        </figure>
        @foreach ($PO as $noDokuPO => $items)
            <table class="table table-borderless table-sm"
                style="width: auto; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-left: -5px;">
                <tr>
                    <td>Nomor PO<br>Supplier</td>
                    <td>: {{ $noDokuPO }}<br>
                        : {{ $items[0]->supplier }}
                    </td>
                </tr>
            </table>
            <table class="table is-striped table-bordered border-dark table-sm"
                style="width: 100%; font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-top: -15px;">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 3%">No.</th>
                        <th class="text-center" style="width: 30%">Keterangan</th>
                        <th class="text-center" style="width: 5%;" colspan="2">Qty</th>
                        <th class="text-center" style="width: 5%">Curr</th>
                        <th class="text-center" style="width: 10%">Total Harga</th>
                    </tr>
                </thead>
                <?php $no = 1;
                $totalPO = 0;
                ?>
                @foreach ($items as $item)
                    <tr>
                        <td class="text-center" style="max-width: 5%;">{{ $no++ . '.' }}</td>
                        <td style="text-transform: capitalize;">{{ $item->judul_PO }}
                            @if ($item->tgl_1 && $item->tgl_2)
                                {{ date('d/m/y', strtotime($item->tgl_1)) }} -
                                {{ date('d/m/y', strtotime($item->tgl_2)) }}
                            @elseif ($item->tgl_1)
                                {{ date('d/m/y', strtotime($item->tgl_1)) }}
                            @endif
                        </td>
                        <td style="text-transform: capitalize; text-align: center">
                            @if (floor($item->jumlah) == $item->jumlah)
                                {{ number_format($item->jumlah, 0, ',', '.') }}
                            @else
                                {{ number_format($item->jumlah, 1, ',', '.') }}
                            @endif
                        </td>
                        <td style="text-transform: capitalize; text-align: center">{{ $item->satuan }}</td>
                        <td style="text-transform: capitalize; text-align: center">
                            @if ($item->curr == 'IDR')
                                {{ $item->curr }}
                            @elseif ($item->curr == 'USD')
                                {{ $item->curr }}
                            @elseif ($item->curr == 'SGD')
                                {{ $item->curr }}
                            @elseif ($item->curr == 'EUR')
                                {{ $item->curr }}
                            @endif
                        </td>
                        <td style="text-transform: capitalize; text-align: right">
                            @if ($item->curr == 'IDR')
                                {{ number_format($item->nominal_PO, 2, ',', '.') }}
                            @elseif ($item->curr == 'USD')
                                {{ number_format($item->nominal_PO, 2, ',', '.') }}
                            @elseif ($item->curr == 'SGD')
                                {{ number_format($item->nominal_PO, 2, ',', '.') }}
                            @elseif ($item->curr == 'EUR')
                                {{ number_format($item->nominal_PO, 2, ',', '.') }}
                            @endif
                        </td>
                    </tr>
                    <?php $totalPO += $item->nominal_PO; ?>
                @endforeach
                <tr style="font-weight: bold" class="print_jumlah">
                    <td colspan="4" class="text-end">Jumlah</td>
                    <td class="text-center">
                        @if ($item->curr == 'IDR')
                            {{ $item->curr }}
                        @elseif ($item->curr == 'USD')
                            {{ $item->curr }}
                        @elseif ($item->curr == 'SGD')
                            {{ $item->curr }}
                        @elseif ($item->curr == 'EUR')
                            {{ $item->curr }}
                        @endif
                    </td>
                    <td class="text-end">
                        @if ($item->curr == 'IDR')
                            {{ number_format($totalPO, 2, ',', '.') }}
                        @elseif ($item->curr == 'USD')
                            {{ number_format($totalPO, 2, ',', '.') }}
                        @elseif ($item->curr == 'SGD')
                            {{ number_format($totalPO, 2, ',', '.') }}
                        @elseif ($item->curr == 'EUR')
                            {{ number_format($totalPO, 2, ',', '.') }}
                        @endif
                    </td>
                </tr>
                @if ($items[0]->PPN)
                    @php
                        $ppnValue = ($items[0]->PPN / 100) * $totalPO;
                    @endphp
                    <tr style="font-weight: bold" class="print_jumlah">
                        <td colspan="4" class="text-end">VAT (11%)</td>
                        <td class="text-center">
                            @if ($item->curr == 'IDR' || $item->curr == 'USD' || $item->curr == 'SGD' || $item->curr == 'EUR')
                                {{ $item->curr }}
                            @endif
                        </td>
                        <td class="text-end">
                            @if ($item->curr == 'IDR' || $item->curr == 'USD' || $item->curr == 'SGD' || $item->curr == 'EUR')
                                {{ number_format($ppnValue, 2, ',', '.') }}
                            @endif
                        </td>
                    </tr>
                @elseif ($items[0]->PPN == null)
                    @php
                        $ppnValue = ($items[0]->PPN / 100) * $totalPO;
                    @endphp
                    <tr style="font-weight: bold" class="print_jumlah" hidden>
                        <td colspan="4" class="text-end">VAT (11%)</td>
                        <td class="text-center">
                            @if ($item->curr == 'IDR' || $item->curr == 'USD' || $item->curr == 'SGD' || $item->curr == 'EUR')
                                {{ $item->curr }}
                            @endif
                        </td>
                        <td class="text-end">
                            @if ($item->curr == 'IDR' || $item->curr == 'USD' || $item->curr == 'SGD' || $item->curr == 'EUR')
                                {{ number_format($ppnValue, 2, ',', '.') }}
                            @endif
                        </td>
                    </tr>
                @endif
                @if ($items[0]->PPH)
                    @php
                        $pphValue = ($items[0]->PPH / 100) * $totalPO;
                    @endphp
                    <tr style="font-weight: bold" class="print_jumlah">
                        <td colspan="4" class="text-end">PPh23 (2%)</td>
                        <td class="text-center">
                            @if ($item->curr == 'IDR' || $item->curr == 'USD' || $item->curr == 'SGD' || $item->curr == 'EUR')
                                {{ $item->curr }}
                            @endif
                        </td>
                        <td class="text-end "@if ($pphValue != 0) style="color: red" @endif>
                            @if ($item->curr == 'IDR' || $item->curr == 'USD' || $item->curr == 'SGD' || $item->curr == 'EUR')
                                {{ number_format($pphValue, 2, ',', '.') }}
                            @endif
                        </td>
                    </tr>
                @elseif ($items[0]->PPH == null)
                    @php
                        $pphValue = ($items[0]->PPH / 100) * $totalPO;
                    @endphp
                    <tr style="font-weight: bold" class="print_jumlah" hidden>
                        <td colspan="4" class="text-end">PPh23 (2%)</td>
                        <td class="text-center">
                            @if ($item->curr == 'IDR' || $item->curr == 'USD' || $item->curr == 'SGD' || $item->curr == 'EUR')
                                {{ $item->curr }}
                            @endif
                        </td>
                        <td class="text-end "@if ($pphValue != 0) style="color: red" @endif>
                            @if ($item->curr == 'IDR' || $item->curr == 'USD' || $item->curr == 'SGD' || $item->curr == 'EUR')
                                {{ number_format($pphValue, 2, ',', '.') }}
                            @endif
                        </td>
                    </tr>
                @endif
                @if ($items[0]->PPH_4)
                    @php
                        $pph_4Value = ($items[0]->PPH_4 / 100) * $totalPO;
                    @endphp
                    <tr style="font-weight: bold" class="print_jumlah">
                        <td colspan="4" class="text-end">PPh 4 (2)</td>
                        <td class="text-center">
                            @if ($item->curr == 'IDR' || $item->curr == 'USD' || $item->curr == 'SGD' || $item->curr == 'EUR')
                                {{ $item->curr }}
                            @endif
                        </td>
                        <td class="text-end "@if ($pph_4Value != 0) style="color: red" @endif>
                            @if ($item->curr == 'IDR' || $item->curr == 'USD' || $item->curr == 'SGD' || $item->curr == 'EUR')
                                {{ number_format($pph_4Value, 2, ',', '.') }}
                            @endif
                        </td>
                    </tr>
                @elseif ($items[0]->PPH_4 == null)
                    @php
                        $pph_4Value = ($items[0]->PPH_4 / 100) * $totalPO;
                    @endphp
                    <tr style="font-weight: bold" class="print_jumlah" hidden>
                        <td colspan="4" class="text-end">PPh 4 (2)</td>
                        <td class="text-center">
                            @if ($item->curr == 'IDR' || $item->curr == 'USD' || $item->curr == 'SGD' || $item->curr == 'EUR')
                                {{ $item->curr }}
                            @endif
                        </td>
                        <td class="text-end "@if ($pph_4Value != 0) style="color: red" @endif>
                            @if ($item->curr == 'IDR' || $item->curr == 'USD' || $item->curr == 'SGD' || $item->curr == 'EUR')
                                {{ number_format($pph_4Value, 2, ',', '.') }}
                            @endif
                        </td>
                    </tr>
                @endif
                @if ($items[0]->ctm_1 && $items[0]->ctm_2 !== null)
                    @php
                        $ctm_2Value = ($items[0]->ctm_2 / 100) * $totalPO;
                    @endphp
                    <tr style="font-weight: bold" class="print_jumlah">
                        <td colspan="4" class="text-end">{{ $items[0]->ctm_1 }}</td>
                        <td class="text-center">
                            @if ($item->curr == 'IDR' || $item->curr == 'USD' || $item->curr == 'SGD' || $item->curr == 'EUR')
                                {{ $item->curr }}
                            @endif
                        </td>
                        <td class="text-end "@if ($ctm_2Value != 0) style="color: red" @endif>
                            @if ($item->curr == 'IDR' || $item->curr == 'USD' || $item->curr == 'SGD' || $item->curr == 'EUR')
                                {{ number_format($ctm_2Value, 2, ',', '.') }}
                            @endif
                        </td>
                    </tr>
                @endif
                <?php $totalAll2 = $totalPO + $ppnValue - $pphValue; ?>
                <?php $totalAll += $totalPO + $ppnValue - $pphValue; ?>
                <tr style="font-weight: bold" class="print_jumlah">
                    <td colspan="4" class="text-end">Grand Total</td>
                    <td class="text-center">
                        @if ($item->curr == 'IDR')
                            {{ $item->curr }}
                        @elseif ($item->curr == 'USD')
                            {{ $item->curr }}
                        @elseif ($item->curr == 'SGD')
                            {{ $item->curr }}
                        @elseif ($item->curr == 'EUR')
                            {{ $item->curr }}
                        @endif
                    </td>
                    <td class="text-end">
                        @if ($item->curr == 'IDR')
                            {{ number_format($totalAll2, 2, ',', '.') }}
                        @elseif ($item->curr == 'USD')
                            {{ number_format($totalAll2, 2, ',', '.') }}
                        @elseif ($item->curr == 'SGD')
                            {{ number_format($totalAll2, 2, ',', '.') }}
                        @elseif ($item->curr == 'EUR')
                            {{ number_format($totalAll2, 2, ',', '.') }}
                        @endif
                    </td>
                </tr>
            </table>
            <?php
            $carbonDate = Carbon::createFromFormat('Y-m-d', $items[0]->tgl_purchasing)->locale('id');
            $formattedDate = $carbonDate->isoFormat('DD MMMM YYYY');
            ?>
            <p
                style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; text-align: right; margin-top: -10px;">
                Surabaya,
                {{ $formattedDate }}</p>
            <div style="margin-top: 20px">
                <table class="table is-striped table-bordered border-dark text-center"
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; margin-top: -20px;">
                    <tr style="height:2cm;">
                        <td style="width:25%">
                            <div class="center" style="text-transform: uppercase">purchasing,</div>
                            <div style="margin-top: 70px"></div>
                            <div class="center">{{ $items[0]->pemohon }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="text-transform: uppercase">accounting,</div>
                            <div style="margin-top: 70px"></div>
                            <div class="center">{{ $items[0]->acc }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="text-transform: uppercase">kasir,</div>
                            <div style="margin-top: 70px"></div>
                            <div class="center">{{ $items[0]->kasir }}</div>
                        </td>
                        <td style="width:25%">
                            <div class="center" style="text-transform: uppercase">menyetujui,</div>
                            <div style="margin-top: 70px"></div>
                            <div class="center">{{ $items[0]->menyetujui }}</div>
                        </td>
                    </tr>
                </table>
            </div>
        @endforeach
        <div class="text-end fw-bold">
            Total PO {{ date('d.m.Y', strtotime($tgl_awal)) }} - {{ date('d.m.Y', strtotime($tgl_akhir)) }} Rp.
            {{ number_format($totalAll, 2, ',', '.') }}
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>
