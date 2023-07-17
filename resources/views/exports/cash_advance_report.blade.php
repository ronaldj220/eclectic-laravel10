<table>
    <thead>
        <tr>
            <th style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; width: 125%; ">No</th>
            <th style="width: 13%; font-family: Arial, Helvetica, sans-serif; font-size: 12px;">:</th>
            <th colspan="2" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px">
                {{ $cash_advance_report->no_doku }}</th>
        </tr>
        <tr>
            <th style="font-family: Arial, Helvetica, sans-serif; font-size: 12px">Tanggal</th>
            <th style="width: 13%; font-family: Arial, Helvetica, sans-serif; font-size: 12px;">:</th>
            <th colspan="2"style="font-family: Arial, Helvetica, sans-serif; font-size: 12px">
                {{ date('d.m.Y', strtotime($cash_advance_report->tgl_diajukan)) }}</th>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <th style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black; display: flex; align-items: center;"
                rowspan="2">
                No</th>
            <th colspan="6"
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black">
                Keterangan</th>
            <th style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black; width: 200%"
                rowspan="2">
                No Bukti</th>
            <th style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black; width: 75%"
                rowspan="2">
                Curr</th>
            <th style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black; width: 200%"
                rowspan="2">
                Nominal</th>
        </tr>
        <tr>
            <th colspan="6"
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black">
                {{ $cash_advance_report->judul_doku }}</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        @foreach ($CARDetail as $item)
            <tr>
                <td
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                    {{ $no++ . '.' }}</td>
                <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: justify; border: 10px solid black; text-transform: capitalize"
                    colspan="6">
                    {{ $item->deskripsi }}
                    @if ($item->tanggal_1 && $item->tanggal_2)
                        @php
                            $tanggal1 = \Carbon\Carbon::parse($item->tanggal_1);
                            $tanggal2 = \Carbon\Carbon::parse($item->tanggal_2);
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
                </td>
                <td
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                    {{ $item->no_bukti }}</td>
                <td
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black; ">
                    {{ $item->curr }}</td>
                <td
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; border: 10px solid black; ">
                    {{ $item->nominal }}</td>
            </tr>
        @endforeach
        <tr>
            <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; font-weight: bold; border: 10px solid black"
                colspan="8">
                Jumlah</td>
            <td
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black; ">
                {{ $item->curr }}</td>
            <td
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; border: 10px solid black; ">
                {{ $nominal }}</td>
        </tr>
        <tr>
            <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; font-weight: bold; border: 10px solid black"
                colspan="8">
                Cash Advance {{ $cash_advance_report->tipe_ca }}</td>
            <td
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black; ">
                {{ $item->curr }}</td>
            <td
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; border: 10px solid black; ">
                {{ $cash_advance_report->nominal_ca }}</td>
        </tr>
        <tr>
            @if ($nominal < $cash_advance_report->nominal_ca)
                <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; font-weight: bold; border: 10px solid black; color: black"
                    colspan="8">
                    Lebih</td>
                <td
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black;">
                    {{ $item->curr }}</td>
                <td
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; border: 10px solid black;; color: black">
                    {{ abs($cash_advance_report->nominal_ca - $nominal) }}</td>
            @elseif ($nominal > $cash_advance_report->nominal_ca)
                <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; font-weight: bold; border: 10px solid black; color: red"
                    colspan="8">
                    Kurang</td>
                <td
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black;">
                    {{ $item->curr }}</td>
                <td
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; border: 10px solid black;; color: red">
                    {{ abs($cash_advance_report->nominal_ca - $nominal) }}</td>
            @elseif ($nominal == $cash_advance_report->nominal_ca)
                <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; font-weight: bold; border: 10px solid black"
                    colspan="8">
                    Kurang</td>
                <td
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black;">
                    {{ $item->curr }}</td>
                <td
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; border: 10px solid black;">
                    {{ abs($cash_advance_report->nominal_ca - $nominal) }}</td>
            @endif
        </tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black"
                colspan="2">
                Pembuat, </td>
            <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black"
                colspan="2">
                Menyetujui, </td>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="2" rowspan="3" style="border: 10px solid black"></td>
            <td colspan="2" rowspan="3" style="border: 10px solid black"></td>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black"
                colspan="2">{{ $cash_advance_report->pemohon }}</td>
            <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black"
                colspan="2">{{ $cash_advance_report->menyetujui }}</td>
        </tr>
    </tbody>

</table>
