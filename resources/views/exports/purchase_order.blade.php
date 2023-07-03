<table>
    <thead>
        <tr>
            <th style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; text-align: center;"
                colspan="9">PURCHASE ORDER</th>
        </tr>
        <tr>
            <th style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; text-align: center;"
                colspan="9">PT. Eclectic Consulting</th>
        </tr>
        <tr></tr>
        <tr>
            <th style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; width: 50%" colspan="3">
                Nomor PO</th>
            <th style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; width: 200%">
                {{ $PO->no_doku }}</th>
        </tr>
        <tr>
            <th style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; width: 50%" colspan="3">
                Supplier</th>
            <th style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; width: 200%">
                {{ $PO->supplier }}</th>
        </tr>
        <tr>
            <th
                style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; text-align: center; width: 40%; border: 10px solid black">
                No.</th>
            <th style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; text-align: center; border: 10px solid black"
                colspan="4">
                KETERANGAN</th>
            <th style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; text-align: center; border: 10px solid black"
                colspan="2">
                Qty</th>
            <th style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; text-align: center; border: 10px solid black"
                colspan="2">
                Curr</th>
            <th style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; text-align: center; border: 10px solid black"
                colspan="2">
                Total Harga</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        @foreach ($PO_detail as $item)
            <tr>
                <td
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                    {{ $no++ . '.' }}</td>
                <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black"
                    colspan="4">
                    {{ $item->judul }}</td>
                <td
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                    {{ $item->jumlah }}</td>
                <td
                    style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                    {{ $item->satuan }}</td>
                <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black"
                    colspan="2">
                    {{ $item->curr }}</td>
                <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; border: 10px solid black"
                    colspan="2">
                    {{ number_format($item->nominal, 0, ',', '.') }}</td>
            </tr>
        @endforeach
        <tr>
            <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; border: 10px solid black"
                colspan="7">
                Total</td>
            <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black"
                colspan="2">
                {{ $item->curr }}</td>
            <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; border: 10px solid black"
                colspan="2">
                {{ number_format($nominal, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; border: 10px solid black"
                colspan="7">
                VAT 11%</td>
            <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black"
                colspan="2">
                {{ $item->curr }}</td>
            <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; border: 10px solid black"
                colspan="2">
                @foreach ($VAT as $item)
                    {{ number_format($item->VAT * $nominal, 0, '', '') }}
                @endforeach
            </td>
        </tr>
        <tr>
            <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; border: 10px solid black"
                colspan="7">
                TOTAL</td>
            <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black"
                colspan="2">
                IDR</td>
            <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; border: 10px solid black"
                colspan="2">
                {{ number_format($total, 0, ',', '.') }}
            </td>
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
            <td>Surabaya, {{ $PO->tgl_purchasing }}</td>
        </tr>
    </tbody>
</table>
