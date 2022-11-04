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
    <br>
    <table width="100%">
        <tr>
            <td width="45%">
                Kepada. Yth <br>
                {{$masterCustomer->nama_customer}} <br>
                {{$masterCustomer->alamat}} <br>
                Up. {{$masterCustomer->nama_pic}} <br>
                Phone. {{$masterCustomer->no_telp}}</p>
            </td>
            <td width="10%">
            <td width="15%">
                QTY<br>
                Gross Weight<br>
                Dimensi<br>
                PO. No
            </td>
            <td width="3%">: <br>
                : <br>
                : <br>
                : <br>
            </td>
            <td width="22%">
                {{$qty}}<br>
                {{ $pengirimanHeader->gross_weight }}<br>
                {{ $pengirimanHeader->dimensi }}<br>
                {{ $pengirimanHeader->no_pemesanan }}
            </td>
        </tr>
    </table>
    <center>
        <p><strong><u>SURAT JALAN BARANG</u></strong><br>{{ $pengirimanHeader->no_surat_jalan }}</p>
    </center>
    
    <table width="100%" style="border: 1px solid black;">
        <tr style="border: 1px solid black;">
            <th style="border: 1px solid black;" width="10%">No</th>
            <th style="border: 1px solid black;" width="50%">Uraian Barang yang akan dikirim</th>
            <th style="border: 1px solid black;" width="10%">Quantity</th>
            <th style="border: 1px solid black;" width="15%">Keterangan</th>
        </tr>
        @foreach($pengirimanDetail as $pengirimanDetail)
        <tr style="border: 1px solid black;">
            <td style="border: 1px solid black;text-align:center;">{{ $no++ }}</td>
            <td style="border: 1px solid black;">{{ $pengirimanDetail->kode_barang }} <br> {{ $pengirimanDetail->nama_barang }}</td>
            <td style="border: 1px solid black;text-align:center;">{{ $pengirimanDetail->qty }}</td>
            <td style="border: 1px solid black;text-align:center;">Mohon tanda terima ini ditanda tangani dan stampel perusahaan.</td>
        </tr>
        @endforeach
    </table>
    <br>
    <table width="100%">
        <tr>
            <td>
                <p>Tanggal Kirim : {{$pengirimanHeader->tanggal}} <br> 
                PT. Unideby Kencana</p>
                <br><br>
                <p>(SINTYA)</p>
            </td>
            <td width="20%"></td>
            <td>
                <p>Diterima oleh : <br>
                {{$masterCustomer->nama_customer}}</p>
                <br><br>
                <p>({{$masterCustomer->nama_pic}})</p>
            </td>
        </tr>
    </table>
</body>
</html>