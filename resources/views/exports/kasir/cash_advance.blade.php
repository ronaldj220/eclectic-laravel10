<table>
    <thead>
        <tr></tr>
        <tr></tr>
        <tr>
            <th style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; width: 125%; ">No</th>
            <th style="width: 13%; font-family: Arial, Helvetica, sans-serif; font-size: 12px;">:</th>
            <th colspan="2" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px">
                {{ $cash_advance->no_doku }}</th>

        </tr>
        <tr>
            <th style="font-family: Arial, Helvetica, sans-serif; font-size: 12px">Tanggal</th>
            <th style="width: 13%; font-family: Arial, Helvetica, sans-serif; font-size: 12px;">:</th>
            <th colspan="2"style="font-family: Arial, Helvetica, sans-serif; font-size: 12px">
                {{ date('d.m.Y', strtotime($cash_advance->tgl_diajukan)) }}</th>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <th
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black">
                No</th>
            <th colspan="6"
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;text-align: center; font-weight: bold; border: 10px solid black">
                Keterangan</th>
            <th
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black">
                No
                Bukti</th>
            <th
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black">
                Curr</th>
            <th
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black">
                Nominal</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <tr>
            <td
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                {{ $no++ . '.' }}
            </td>
            <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: justify; border: 10px solid black"
                colspan="6">
                {{ $cash_advance->judul_doku }}</td>
            <td
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: justify; border: 10px solid black">
            </td>
            <td
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                {{ $cash_advance->curr }}
            </td>
            <td
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; border: 10px solid black">
                {{ $cash_advance->nominal }}
            </td>
        </tr>
        <tr>
            <td colspan="8"
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; font-weight: bold; border: 10px solid black">
                Jumlah</td>
            <td
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black">
                {{ $cash_advance->curr }}</td>
            <td
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; font-weight: bold; border: 10px solid black">
                {{ $nominal }}</td>
        </tr>
        <tr></tr>
        <tr>
            <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black"
                colspan="3">
                Pemohon</td>
            <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black"
                colspan="3">
                Accounting</td>
            <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black"
                colspan="2">
                Kasir</td>
            <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black"
                colspan="2">
                Menyetujui</td>
        </tr>
        <tr>
            <td colspan="3" rowspan="3" style="border: 10px solid black"></td>
            <td colspan="3" rowspan="3" style="border: 10px solid black"></td>
            <td colspan="2" rowspan="2" style="border: 10px solid black"></td>
            <td colspan="2" rowspan="3" style="border: 10px solid black"></td>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <td colspan="3"
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                {{ $cash_advance->pemohon }}</td>
            <td colspan="3"
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                {{ $cash_advance->accounting }}</td>
            <td colspan="2"
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                {{ $cash_advance->kasir }}</td>
            <td colspan="2"
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                {{ $cash_advance->menyetujui }}</td>
        </tr>
    </tbody>

</table>
