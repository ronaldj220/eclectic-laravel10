<table>
    <thead>
        <tr>
            <th style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; text-align: center;"
                colspan="7">PERMINTAAN PEMBELIAN</th>
        </tr>
        <tr>
            <th style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; text-align: center;"
                colspan="7">No. PR: {{ $PR->no_doku }}</th>
        </tr>
        <tr></tr>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; text-align: center;">
                Tanggal</th>
            <th
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; text-align: center; width: 25%">
                :</th>
            <th
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; text-align: justify;width: 150%">
                {{ date('d.m.Y', strtotime($PR->tgl_diajukan)) }}
            </th>
        </tr>
        <tr></tr>
        <tr>
            <th
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; text-align: center; width: 40%; border: 10px solid black">
                No</th>
            <th
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; text-align: center; width: 500%; border: 10px solid black">
                Nama Barang</th>
            <th style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; text-align: center; border: 10px solid black"
                colspan="2">
                Qty</th>
            <th
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; text-align: center; border: 10px solid black">
                Tgl. Pakai</th>
            <th style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; text-align: center; border: 10px solid black"
                colspan="2">
                Keterangan</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        @foreach ($PR_detail as $item)
            <tr>
                <td
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                    {{ $no++ }}</td>
                <td
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: justify; border: 10px solid black">
                    {{ $item->judul }}
                </td>
                <td
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; border: 10px solid black">
                    @if (floor($item->jumlah) == $item->jumlah)
                        {{ number_format($item->jumlah, 0, ',', '.') }}
                    @else
                        {{ number_format($item->jumlah, 1, ',', '.') }}
                    @endif
                </td>
                <td
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                    {{ $item->satuan }}</td>
                <td
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                    {{ date('d/m/Y', strtotime($item->tgl_pakai)) }}</td>
                <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black"
                    colspan="2">
                    {{ $item->project }}</td>
            </tr>
        @endforeach
        <tr>
            <td
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
            </td>
            <td
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: justify; border: 10px solid black">
                @if ($item->tgl_1 && $item->tgl_2)
                    {{ date('d/m/Y', strtotime($item->tgl_1)) }} - {{ date('d/m/Y', strtotime($item->tgl_2)) }}
                @elseif ($item->tgl_1)
                    {{ date('d/m/Y', strtotime($item->tgl_1)) }}
                @endif
            </td>
            <td
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; border: 10px solid black">

            <td
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
            </td>
            <td
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
            </td>
            <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black"
                colspan="2">
            </td>
        </tr>
        <tr></tr>
        <tr>
            <td></td>
            <td></td>
            <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black; font-weight: bold"
                colspan="3">Pemohon, </td>
            <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black; font-weight: bold"
                colspan="2">Menyetujui, </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td colspan="3" rowspan="3" style="border: 10px solid black;"></td>
            <td colspan="2" rowspan="3" style="border: 10px solid black;"></td>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <td></td>
            <td></td>
            <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black; font-weight: bold"
                colspan="3"> {{ $PR->pemohon }}</td>
            <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black; font-weight: bold"
                colspan="2"> {{ $PR->menyetujui }}</td>
        </tr>
    </tbody>
</table>
