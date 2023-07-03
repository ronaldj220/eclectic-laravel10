<table>
    <thead>
        <tr></tr>
        <tr></tr>
        <tr>
            <th style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; width: 125%; ">No</th>
            <th style="width: 13%; font-family: Arial, Helvetica, sans-serif; font-size: 12px;">:</th>
            @if (
                $halaman_reimbursement->halaman == 'RB' ||
                    $halaman_reimbursement->halaman == 'TS' ||
                    $halaman_reimbursement->halaman == 'ST' ||
                    $halaman_reimbursement->halaman == 'SL')
                <th colspan="2" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px">
                    {{ $halaman_reimbursement->no_doku }}</th>
            @endif

        </tr>
        <tr>
            <th style="font-family: Arial, Helvetica, sans-serif; font-size: 12px">Tanggal</th>
            <th style="width: 13%; font-family: Arial, Helvetica, sans-serif; font-size: 12px;">:</th>
            @if (
                $halaman_reimbursement->halaman == 'RB' ||
                    $halaman_reimbursement->halaman == 'TS' ||
                    $halaman_reimbursement->halaman == 'ST' ||
                    $halaman_reimbursement->halaman == 'SL')
                <th colspan="2"style="font-family: Arial, Helvetica, sans-serif; font-size: 12px">
                    {{ date('d.m.Y', strtotime($halaman_reimbursement->tgl_diajukan)) }}</th>
            @endif
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
            <th style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black"
                colspan="2">No
                Bukti</th>
            <th style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black"
                colspan="2">
                Curr</th>
            <th style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black"
                colspan="2">
                Nominal</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        @if (
            $halaman_reimbursement->halaman == 'RB' ||
                $halaman_reimbursement->halaman == 'TS' ||
                $halaman_reimbursement->halaman == 'ST' ||
                $halaman_reimbursement->halaman == 'SL')
            <tr>
                <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black; height: 350%; word-wrap: break-word"
                    colspan="13">
                    {{ $halaman_reimbursement->judul_doku }}</td>
            </tr>
            @if ($halaman_reimbursement->halaman == 'RB')
                @foreach ($rb_detail as $item)
                    <tr>
                        <td
                            style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                            {{ $no++ . '.' }}</td>
                        <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: justify; border: 10px solid black; width: 30%"
                            colspan="6">
                            {{ $item->deskripsi }} {{ date('d/m/Y', strtotime($item->tanggal_1)) }}</td>
                        <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black; width: 50%"
                            colspan="2">
                            {{ $item->no_bukti }}</td>
                        <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black; width: 50%"
                            colspan="2">
                            {{ $item->curr }}</td>
                        <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; border: 10px solid black; width: 50%"
                            colspan="2">
                            {{ $item->nominal }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="9"
                        style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; font-weight: bold; border: 10px solid black">
                        Jumlah</td>
                    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black"
                        colspan="2">
                        {{ $item->curr }}</td>
                    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; font-weight: bold; border: 10px solid black"
                        colspan="2">
                        {{ $nominal }}</td>
                </tr>
                <tr></tr>
                <tr>
                    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black"
                        colspan="4">
                        Pemohon</td>
                    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black"
                        colspan="3">
                        Accounting</td>
                    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black"
                        colspan="3">
                        Kasir</td>
                    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black"
                        colspan="3">
                        Menyetujui</td>
                </tr>
                <tr>
                    <td colspan="4" rowspan="3" style="border: 10px solid black"></td>
                    <td colspan="3" rowspan="3" style="border: 10px solid black"></td>
                    <td colspan="3" rowspan="3" style="border: 10px solid black"></td>
                    <td colspan="3" rowspan="3" style="border: 10px solid black"></td>
                </tr>
                <tr></tr>
                <tr></tr>
                <tr>
                    <td colspan="4"
                        style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                        {{ $halaman_reimbursement->pemohon }}</td>
                    <td colspan="3"
                        style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                        {{ $halaman_reimbursement->accounting }}</td>
                    <td colspan="3"
                        style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                        {{ $halaman_reimbursement->kasir }}</td>
                    <td colspan="3"
                        style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                        {{ $halaman_reimbursement->menyetujui }}</td>
                </tr>
            @elseif ($halaman_reimbursement->halaman == 'TS')
                @foreach ($ts_detail as $index => $item)
                    <tr>
                        <td
                            style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                            {{ $no++ . '.' }}</td>
                        <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: justify; border: 10px solid black; width: 30%"
                            colspan="6">
                            {{ $item->nama_karyawan }} </td>
                        <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black; width: 50%"
                            colspan="2"></td>
                        <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black; width: 50%"
                            colspan="2">
                            {{ $item->curr }}</td>
                        <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; border: 10px solid black; width: 50%"
                            colspan="2">
                            {{ $hasil_ts[$index] }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="9"
                        style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; font-weight: bold; border: 10px solid black">
                        Jumlah</td>
                    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black"
                        colspan="2">
                        {{ $item->curr }}</td>
                    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; font-weight: bold; border: 10px solid black"
                        colspan="2">
                        {{ $nominal_ts }}</td>
                </tr>
                <tr></tr>
                <tr>
                    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black"
                        colspan="4">
                        Pemohon</td>
                    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black"
                        colspan="3">
                        Accounting</td>
                    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black"
                        colspan="3">
                        Kasir</td>
                    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black"
                        colspan="3">
                        Menyetujui</td>
                </tr>
                <tr>
                    <td colspan="4" rowspan="3" style="border: 10px solid black"></td>
                    <td colspan="3" rowspan="3" style="border: 10px solid black"></td>
                    <td colspan="3" rowspan="3" style="border: 10px solid black"></td>
                    <td colspan="3" rowspan="3" style="border: 10px solid black"></td>
                </tr>
                <tr></tr>
                <tr></tr>
                <tr>
                    <td colspan="4"
                        style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                        {{ $halaman_reimbursement->pemohon }}</td>
                    <td colspan="3"
                        style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                        {{ $halaman_reimbursement->accounting }}</td>
                    <td colspan="3"
                        style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                        {{ $halaman_reimbursement->kasir }}</td>
                    <td colspan="3"
                        style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                        {{ $halaman_reimbursement->menyetujui }}</td>
                </tr>
            @elseif ($halaman_reimbursement->halaman == 'ST')
                @foreach ($st_detail as $index => $item)
                    <tr>
                        <td
                            style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                            {{ $no++ . '.' }}</td>
                        <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: justify; border: 10px solid black; width: 30%"
                            colspan="6">
                            {{ $item->nama_karyawan }} ({{ $item->aliases }})</td>
                        <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black; width: 50%"
                            colspan="2"></td>
                        <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black; width: 50%"
                            colspan="2">
                            {{ $item->curr }}</td>
                        <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; border: 10px solid black; width: 50%"
                            colspan="2">
                            {{ $hasil_st[$index] }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="9"
                        style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; font-weight: bold; border: 10px solid black">
                        Jumlah</td>
                    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black"
                        colspan="2">
                        {{ $item->curr }}</td>
                    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; font-weight: bold; border: 10px solid black"
                        colspan="2">
                        {{ $nominal_st }}</td>
                </tr>
                <tr></tr>
                <tr>
                    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black"
                        colspan="4">
                        Pemohon</td>
                    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black"
                        colspan="3">
                        Accounting</td>
                    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black"
                        colspan="3">
                        Kasir</td>
                    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black"
                        colspan="3">
                        Menyetujui</td>
                </tr>
                <tr>
                    <td colspan="4" rowspan="3" style="border: 10px solid black"></td>
                    <td colspan="3" rowspan="3" style="border: 10px solid black"></td>
                    <td colspan="3" rowspan="3" style="border: 10px solid black"></td>
                    <td colspan="3" rowspan="3" style="border: 10px solid black"></td>
                </tr>
                <tr></tr>
                <tr></tr>
                <tr>
                    <td colspan="4"
                        style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                        {{ $halaman_reimbursement->pemohon }}</td>
                    <td colspan="3"
                        style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                        {{ $halaman_reimbursement->accounting }}</td>
                    <td colspan="3"
                        style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                        {{ $halaman_reimbursement->kasir }}</td>
                    <td colspan="3"
                        style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                        {{ $halaman_reimbursement->menyetujui }}</td>
                </tr>
            @elseif ($halaman_reimbursement->halaman == 'SL')
                @foreach ($sl_detail as $index => $item)
                    <tr>
                        <td
                            style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                            {{ $no++ . '.' }}</td>
                        <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: justify; border: 10px solid black; width: 30%"
                            colspan="6">
                            {{ $item->nama_karyawan }} ({{ $item->aliases }})</td>
                        <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black; width: 50%"
                            colspan="2"></td>
                        <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black; width: 50%"
                            colspan="2">
                            {{ $item->curr }}</td>
                        <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; border: 10px solid black; width: 50%"
                            colspan="2">
                            {{ $hasil_sl[$index] }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="9"
                        style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; font-weight: bold; border: 10px solid black">
                        Jumlah</td>
                    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black"
                        colspan="2">
                        {{ $item->curr }}</td>
                    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: right; font-weight: bold; border: 10px solid black"
                        colspan="2">
                        {{ $nominal_sl }}</td>
                </tr>
                <tr></tr>
                <tr>
                    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black"
                        colspan="4">
                        Pemohon</td>
                    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black"
                        colspan="3">
                        Accounting</td>
                    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black"
                        colspan="3">
                        Kasir</td>
                    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; font-weight: bold; border: 10px solid black"
                        colspan="3">
                        Menyetujui</td>
                </tr>
                <tr>
                    <td colspan="4" rowspan="3" style="border: 10px solid black"></td>
                    <td colspan="3" rowspan="3" style="border: 10px solid black"></td>
                    <td colspan="3" rowspan="3" style="border: 10px solid black"></td>
                    <td colspan="3" rowspan="3" style="border: 10px solid black"></td>
                </tr>
                <tr></tr>
                <tr></tr>
                <tr>
                    <td colspan="4"
                        style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                        {{ $halaman_reimbursement->pemohon }}</td>
                    <td colspan="3"
                        style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                        {{ $halaman_reimbursement->accounting }}</td>
                    <td colspan="3"
                        style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                        {{ $halaman_reimbursement->kasir }}</td>
                    <td colspan="3"
                        style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; text-align: center; border: 10px solid black">
                        {{ $halaman_reimbursement->menyetujui }}</td>
                </tr>
            @endif
        @endif



    </tbody>

</table>
