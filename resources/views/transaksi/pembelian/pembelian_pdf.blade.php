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
                <p><strong>PT. UNIDEBY KENCANA</strong><br>
                Jl.Pangeran Jayakarta 45 Blok A5, Jakarta 111110, Indonesia <br>
                Telp. (021)6497942, 6499805, 6499806 <br>
                Fax. (021)6497686, 6256508 <br>
                Email. unideby@dnet.net.id</p>
            </td>
            <td><img src="{{ public_path('/logo.png')}}" alt="" width="100px"></td>
        </tr>
    </table>
    <center>
        <p><strong><u>PURCHASE ORDER</u></strong><br>{{ $pembelianHeader->no_pembelian }}</p>
    </center>
    <table width="100%">
        <tr>
            <td>Supplier</td>
            <td>:</td>
            <td>{{ $masterPrinciple->nama_principle }}</td>
            <td>Date</td>
            <td>:</td>
            <td>{{ $pembelianHeader->tanggal_pembelian }}</td>
        </tr>
        <tr>
            <td>Address</td>
            <td>:</td>
            <td>{{ $masterPrinciple->alamat }}</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Contact</td>
            <td>:</td>
            <td>{{ $masterPrinciple->no_telp }} <br> {{ $masterPrinciple->fax }}</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <p>Please supply the following in quantity and at prices spesified here under :</p>
    <table width="100%" style="border: 1px solid black;">
        <tr style="border: 1px solid black;">
            <th style="border: 1px solid black;" width="10%">Item No</th>
            <th style="border: 1px solid black;" width="50%">Descriptions</th>
            <th style="border: 1px solid black;" width="10%">Qty</th>
            <th style="border: 1px solid black;" width="15%">Price/Unit (USD)</th>
            <th style="border: 1px solid black;" width="15%">Total Amount (USD)</th>
        </tr>
        @foreach($pembelianDetail as $pembelianDetail)
        <tr style="border: 1px solid black;">
            <td style="border: 1px solid black;text-align:center;">{{ $no++ }}</td>
            <td style="border: 1px solid black;">{{ $pembelianDetail->kode_barang }} <br> {{ $pembelianDetail->nama_barang }}</td>
            <td style="border: 1px solid black;text-align:center;">{{ $pembelianDetail->qty }}</td>
            <td style="border: 1px solid black;text-align:center;">{{ number_format($pembelianDetail->unit_price) }}</td>
            <td style="border: 1px solid black;text-align:center;">{{ number_format($pembelianDetail->total) }}</td>
        </tr>
        @endforeach
        <tr>
            <td style="border: 1px solid black;text-align:right;" colspan="4">TOTAL PRICE Ex-Work USA</td>
            <td style="border: 1px solid black;text-align:center;">{{ number_format($total) }}</td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td>Terms and conditions: <br> {!! $pembelianHeader->term_condition !!}</td> 
        </tr>
    </table>
    <br>
    <p>We accept this order and agree to the above terms. <br> 
    Authorized by (Name & Signature)</p>
    <img src="{{ public_path('/ttd.png')}}" alt="" width="200px">
    <p><u>BUDI SANTOSO</u><br>Director</p>
</body>
</html>