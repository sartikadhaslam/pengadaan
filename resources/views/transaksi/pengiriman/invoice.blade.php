<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <table width="100%">
        <tr>
            <td>
                <p><span style="font-size:25px"><strong>PT. UNIDEBY KENCANA</strong></span><br>
                Jl.Pangeran Jayakarta 45 Blok A5, Jakarta 111110, Indonesia <br>
                Telp. (021)6497942, 6499805, 6499806 <br>
                Fax. (021)6497686, 6256508 <br>
                Email. unideby@dnet.net.id</p>
            </td>
            <td><img src="{{ public_path('/logo.png')}}" alt="" width="100px"></td>
        </tr>
    </table>
    <br>
    <table width="100%" style="border: 1px solid black;">
        <tr>
            <td width="100%"> <span style="font-size:20px"><strong>INVOICE no</strong></span> : <strong>{{ $pengirimanHeader->no_invoice }}</strong></td>
        </tr>
    </table>
    <table width="100%" style="border: 1px solid black;">
        <tr>
            <td style="border: 1px solid black;" width="50%">
                To:<br>
                {{$masterCustomer->nama_customer}} <br>
                {{$masterCustomer->alamat}} <br></p>
            </td>
            <td style="border: 1px solid black;" width="50%">
                Date : {{ $pengirimanHeader->tanggal }}<br>
                Job Order : {{ $pengirimanHeader->no_pemesanan }}<br>
                Payment : {{ $pengirimanHeader->payment_terms }}<br>
                Delivery to : {{ $pengirimanHeader->delivery_to }}<br>
            </td>
        </tr>
    </table>
    <table width="100%" style="border: 1px solid black;">
        <tr style="border: 1px solid black;">
            <th style="border: 1px solid black;" width="5%">Item</th>
            <th style="border: 1px solid black;" width="10%">Qty</th>
            <th style="border: 1px solid black;" width="45%">Description</th>
            <th style="border: 1px solid black;" width="15%">Total Price <br>(IDR)</th>
            <th style="border: 1px solid black;" width="25%">Total Price DDP <br>(IDR)</th>
        </tr>
        @foreach($pengirimanDetail as $pengirimanDetail)
        <tr style="border: 1px solid black;">
            <td style="border: 1px solid black;text-align:center;">{{ $no++ }}</td>
            <td style="border: 1px solid black;text-align:center;">{{ $pengirimanDetail->qty }}</td>
            <td style="border: 1px solid black;">{{ $pengirimanDetail->kode_barang }} <br> {{ $pengirimanDetail->nama_barang }}</td>
            <td style="border: 1px solid black;text-align:center;">{{ number_format($pengirimanDetail->unit_price) }}</td>
            <td style="border: 1px solid black;text-align:left;padding-left:20px;">Rp {{ number_format($pengirimanDetail->total) }}</td>
        </tr>
        @endforeach
        <tr>
            <td style="border: 1px solid black;text-align:left;text-align:right;" colspan="4">Total DDP at site <br> Vat. 10 % <br>&nbsp;</td>
            <td style="border: 1px solid black;text-align:left;padding-left:20px;">Rp {{ number_format($total) }} <br> Rp {{ number_format(10/100*$total) }} <br>&nbsp;</td>
        </tr>
        <tr>
            <td style="border: 1px solid black;text-align:left;text-align:right;" colspan="4">Total price to {{ $pengirimanHeader->nama_customer }} after Vat.</td>
            <td style="border: 1px solid black;text-align:left;padding-left:20px;">Rp {{ number_format($total+(10/100*$total)) }}</td>
        </tr>
    </table>
    <br>
    <?php
    function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " Belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." Puluh". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " Ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " Ribu" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " Juta" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai/1000000000) . " Milyar" . penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai/1000000000000) . " Trilyun" . penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}

    function terbilang($nilai) {
        if($nilai<0) {
            $hasil = "minus ". trim(penyebut($nilai));
        } else {
            $hasil = trim(penyebut($nilai));
        }     		
        return $hasil;
    }
    $angka = $total+(10/100*$total);
    $terbilang = terbilang($angka);
    ?>
    <p>The Sum of Rupiah : "{{$terbilang}}"</p>
    <table width="50%">
        <tr>
            <td colspan="3">Please kindly transfer to our Bank (full amount)</td>
        </tr>
        <tr>
            <td width="40%">Beneficiary Bank</td>
            <td width="5%">:</td>
            <td width="55%">Bank Central Asia (BCA) <br>Muara Karang Beach, Jakarta Utara</td>
        </tr>
        <tr>
            <td>Swift Code</td>
            <td>:</td>
            <td>CENAIDJA</td>
        </tr>
        <tr>
            <td>Beneficiary name</td>
            <td>:</td>
            <td>PT. UNIDEBY KENCANA</td>
        </tr>
        <tr>
            <td>Account No. (IDR)</td>
            <td>:</td>
            <td>069-3001258</td>
        </tr>
    </table>
    <p>Yours faithfully,</p>
    <img src="{{ public_path('/ttd.png')}}" alt="" width="200px">
    <p><u>BUDI SANTOSO</u><br>Director.</p>
</body>
</html>