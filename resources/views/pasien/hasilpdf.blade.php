<html>
<head>
    <title>
        {{ $title }}
    </title>
{{-- @if(stripos(\Request::url(), 'localhost') !== FALSE)
    <link rel="stylesheet" href="{{ asset('css/paper.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/table-v2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tabel.css') }}">
@else
    <link rel="stylesheet" href="{{ asset('service/css/paper.css') }} ">
    <link rel="stylesheet" href="{{ asset('service/css/table-v2.css') }}">
    <link rel="stylesheet" href="{{ asset('service/css/tabel.css') }}">
@endif --}}
</head>
<style type="text/css" media="print">
    @media print
    {
        @page
        {
            size: auto;
            margin: 0;
            /* size: portrait; */
        }
        footer {
            display: none
        }
        header {
            display: none
        }
        body {
            -webkit-print-color-adjust: exact !important;
        }
    }
</style>
<style>
    tr td {
        padding:2px 4px 2px 4px;
    }
    .borderss{
        border-bottom: 1px solid black;
    }
    .baris1 {
       border: 2px solid #000000;
    }
    .baris2 {
       border: 1px solid #000000;
    }
    .garishalus{
       border:0.01em solid #9a9a9a;
    }
    .garishalus tr td {
       border:0.01em solid #9a9a9a;
       /* border: thin solid #9a9a9a; */
    }
    body{
        font-family: Tahoma, Geneva, sans-serif;
    }
    .ontop{
        vertical-align: top;
    }
 @page { size: A4 } .garis6 td{padding:3px !important;}
</style>

<body style="background-color: #CCCCCC;margin: 0" onLoad="window.print()">
<div align="center">
    <table class="bayangprint" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" border="0" width="" style="padding:25px">
        <tbody>

            <tr>
                <td style="padding-top:25px">
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tr>
                            <td align="center">
                                <font style="font-size: 14pt;font-weight: 600;text-decoration: underline;" color="#000000">
                                    Data Identitas
                                </font>
                                <br>
                                <font style="font-size: 12pt;font-weight: 600;" color="#000000">
                                {{-- {{$raw->nosurat}} --}}

                                </font>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding-top:10px">
                    <table width="85%" cellspacing="0" cellpadding="0" border="0" align="center">
                        <tr>
                            <td width=70%"><font style="font-size: 12pt;" color="#000000" >Nama Pasien</font></td>
                            <td width="1%"><font style="font-size: 12pt;" color="#000000" >:</font></td>
                            <td width="10%"><font style="font-size: 12pt; font-weight:bold" color="#000000" >{{$pasien->namapasien}}</font></td>
                        </tr>
                        <tr>
                            <td width="100%" height="5" colspan="4"></td>
                        </tr>
                        <tr>
                            <td width=70%"><font style="font-size: 12pt;" color="#000000" >NIK</font></td>
                            <td width="1%"><font style="font-size: 12pt;" color="#000000" >:</font></td>
                            <td width="10%"><font style="font-size: 12pt;" color="#000000" >{{$pasien->nik}}</font></td>
                        </tr>
                        <tr>
                            <td width="100%" height="8" colspan="4"></td>
                        </tr>
                        <tr>
                            <td width=70%"><font style="font-size: 12pt;" color="#000000" >Jenis Kelamin</font></td>
                            <td width="1%"><font style="font-size: 12pt;" color="#000000" >:</font></td>
                            <td width="10%"><font style="font-size: 12pt;" color="#000000" >{{$pasien->jeniskelamin}}</font></td>
                        </tr>
                        <tr>
                            <td width="100%" height="8" colspan="4"></td>
                        </tr>
                        <tr>
                            {{-- <td width="8%"><font style="font-size: 12pt;" color="#000000" ></font></td> --}}
                            <td width=70%"><font style="font-size: 12pt;" color="#000000" >Umur</font></td>
                            <td width="1%"><font style="font-size: 12pt;" color="#000000" >:</font></td>
                            <td width="10%"><font style="font-size: 12pt;" color="#000000" >{{$pasien->umur}}</font></td>
                        </tr>
                        <tr>
                            <td width="100%" height="8" colspan="4"></td>
                        </tr>
                        <tr>

                            <td width=70%"><font style="font-size: 12pt;" color="#000000" >Alamat</font></td>
                            <td width="1%"><font style="font-size: 12pt;" color="#000000" >:</font></td>
                            <td width="10%"><font style="font-size: 12pt;" color="#000000" >{{$pasien->alamat}}</font></td>
                        </tr>

                    </table>`

                    <hr>
                    <h3>Riwayat Pasien</h3>
                    <table style="margin-top:5px" width ="35%" cellspacing="0" cellpadding="0" border="0" align="left">
                        <tr>
                            <td width="100%" height="8" colspan="4"></td>
                        </tr>
                        <tr>
                            <td width="8%"><font style="font-size: 12pt;" color="#000000" ></font></td>
                            <td width=20%"><font style="font-size: 12pt;" color="#000000" >Tinggi Badan</font></td>
                            <td width="1%"><font style="font-size: 12pt;" color="#000000" >:</font></td>
                            <td width="71%"><font style="font-size: 12pt;" color="#000000" >{{($pasien->tinggibadan !== null ? $pasien->tinggibadan : '-' )}}</font></td>
                        </tr>
                        <tr>
                            <td width="100%" height="8" colspan="4"></td>
                        </tr>
                        <tr>
                            <td width="8%"><font style="font-size: 12pt;" color="#000000" ></font></td>
                            <td width=20%"><font style="font-size: 12pt;" color="#000000" >Berat Badan</font></td>
                            <td width="1%"><font style="font-size: 12pt;" color="#000000" >:</font></td>
                            <td width="71%"><font style="font-size: 12pt;" color="#000000" >{{($pasien->beratbadan !== null ? $pasien->beratbadan : '-' )}}</font></td>
                        </tr>
                        <tr>
                            <td width="100%" height="8" colspan="4"></td>
                        </tr>
                        <tr>
                            <td width="8%"><font style="font-size: 12pt;" color="#000000" ></font></td>
                            <td width=20%"><font style="font-size: 12pt;" color="#000000" >Berat Badan</font></td>
                            <td width="1%"><font style="font-size: 12pt;" color="#000000" >:</font></td>
                            <td width="71%"><font style="font-size: 12pt;" color="#000000" >{{($pasien->imunisasi !== null ? $pasien->imunisasi : '-' )}}</font></td>
                        </tr>
                        <tr>
                            <td width="100%" height="8" colspan="4"></td>
                        </tr>
                        <tr>
                            <td width="8%"><font style="font-size: 12pt;" color="#000000" ></font></td>
                            <td width=20%"><font style="font-size: 12pt;" color="#000000" >Stunting</font></td>
                            <td width="1%"><font style="font-size: 12pt;" color="#000000" >:</font></td>
                            <td width="71%"><font style="font-size: 12pt;" color="#000000" >{{($pasien->stunting !== null ? $pasien->stunting : '-' )}}</font></td>
                        </tr>
                        <tr>
                            <td width="100%" height="8" colspan="4"></td>
                        </tr>
                        <tr>
                            <td width="8%"><font style="font-size: 12pt;" color="#000000" ></font></td>
                            <td width=20%"><font style="font-size: 12pt;" color="#000000" >obat</font></td>
                            <td width="1%"><font style="font-size: 12pt;" color="#000000" >:</font></td>
                            <td width="71%"><font style="font-size: 12pt;" color="#000000" >{{($pasien->obat !== null ? $pasien->obat : '-' )}}</font></td>
                        </tr>


                    </table>



                </td>

            </tr>
            <tr>
                <td style="padding-top:70px">
                    <table width="85%" cellspacing="0" cellpadding="0" border="0" align= "center" >
                        <tr>
                            <td width="50%">

                            </td>
                            <td width="50%" align="center">
                                {{-- <font style="font-size: 12pt;" color="#000000" >Bandung, {{ App\Traits\Valet::getDateIndo(date('Y-m-d')) }}</font> --}}
                                <!-- <br>
                                <font style="font-size: 11pt;" color="#000000" >Dokter</font> -->
                            </td>

                        </tr>
                        <tr>
                            <td width="55%" ></td>
                            <td width="50%" style="text-align: center ;"  >
                                <div style= " padding: 5 0 ;" >
                                    {{-- {{$qrdokter}} --}}
                                </div>
                            </td>
                            <!-- <td width="50%" height="100"></td>
                            <td width="50%" height="100"></td> -->
                        </tr>

                        <tr>
                            <td width="50%">
                                {{-- <font style="font-size: 9pt;" color="#000000" >Lembar 1 : Untuk Pasien</font> --}}
                                <br>
                                {{-- <font style="font-size: 9pt; " color="#000000" >Lembar 2 : Untuk Arsip</font> --}}
                            </td>
                            <td width="50%" align="center">
                                {{-- <font style="font-size: 11pt;" color="#000000" >{{$raw->namalengkap}}</font> --}}
                                <br>

                            </td>

                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</div>
</body>
<script>
    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
    });
</script>

</html>
