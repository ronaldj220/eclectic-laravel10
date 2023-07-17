<table>
    <thead>
        <tr>
            <th style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; text-align: center;"
                colspan="10">PURCHASE ORDER</th>
        </tr>
        <tr>
            <th style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; text-align: center;"
                colspan="10">PT. Eclectic Consulting</th>
        </tr>
        <tr></tr>
        <tr>
            <th style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; width: 125%">
                Nomor PO</th>
            <th style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; width: 20%">
                :</th>
            <th style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; width: 200%">
                {{ $PO->no_doku }}</th>
        </tr>
        <tr>
            <th style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; width: 125%">
                Supplier</th>
            <th style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; width: 20%">
                :</th>
            <th style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; width: 200%">
                {{ $PO->supplier }}</th>
        </tr>
        <tr>
            <th
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; border: 10px solid black; font-weight: bold; text-align: center">
                No. </th>
            <th style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; border: 10px solid black; text-align: center; font-weight: bold"
                colspan="5">
                KETERANGAN
            </th>
            <th style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; border: 10px solid black; text-align: center; font-weight: bold; width: 50%"
                colspan="2">
                QTY
            </th>
            <th
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black; width: 95%">
                CURR</th>
            <th
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black; width: 300%">
                TOTAL HARGA</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        @foreach ($PO_detail as $item)
            <tr>
                <td
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                    {{ $no++ . '.' }}</td>
                <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: justify; border: 10px solid black"
                    colspan="5">
                    {{ $item->judul }}</td>
                <td
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                    {{ $item->jumlah }}</td>
                <td
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                    {{ $item->satuan }}</td>
                <td
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                    {{ $item->curr }}</td>
                <td
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; border: 10px solid black">
                    {{ number_format($item->nominal, 2, ',', '.') }}</td>
            </tr>
        @endforeach
        <tr>
            <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; border: 10px solid black"
                colspan="8">
                Total</td>
            <td
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                {{ $item->curr }}</td>
            <td
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; border: 10px solid black">
                {{ number_format($nominal, 2, ',', '.') }}</td>
        </tr>
        <tr>
            <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; border: 10px solid black"
                colspan="8">
                VAT</td>
            <td
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                {{ $item->curr }}</td>
            <td
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; border: 10px solid black">
                {{ number_format($PPN, 2, ',', '.') }}</td>
        </tr>
        <tr>
            <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; border: 10px solid black"
                colspan="8">
                PPh23</td>
            <td
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                {{ $item->curr }}</td>
            <td
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; border: 10px solid black">
                {{ number_format($PPH, 2, ',', '.') }}</td>
        </tr>
        <tr>
            <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; border: 10px solid black"
                colspan="8">
                PPh 4 (2)</td>
            <td
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                {{ $item->curr }}</td>
            <td
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; border: 10px solid black">
                {{ number_format($PPH_4, 2, ',', '.') }}</td>
        </tr>
        <tr>
            <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; border: 10px solid black"
                colspan="8">
                Grand Total</td>
            <td
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                {{ $item->curr }}</td>
            <td
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; border: 10px solid black">
                {{ number_format($grand_total, 2, ',', '.') }}</td>
        </tr>
        <tr></tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center">
                Surabaya, {{ $tgl_purchasing }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black"
                colspan="2">
                PURCHASING,</td>
            <td
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black; width: 300%">
                ACCOUNTING,</td>
            <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black"
                colspan="3">
                KASIR,</td>
            <td
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black; width: 300%">
                MENYETUJUI,</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="2" rowspan="3" style="border: 10px solid black"></td>
            <td rowspan="3" style="border: 10px solid black"></td>
            <td colspan="3" rowspan="3" style="border: 10px solid black"></td>
            <td rowspan="3" style="border: 10px solid black"></td>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black"
                colspan="2">
                {{ $PO->pemohon }}</td>
            <td
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black; width: 300%">
                {{ $PO->accounting }}</td>
            <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black"
                colspan="3">
                {{ $PO->kasir }}</td>
            <td
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black; width: 300%">
                {{ $PO->menyetujui }}</td>
        </tr>
    </tbody>

</table>
