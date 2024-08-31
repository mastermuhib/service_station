@extends('layout.app')
@section('asset')
<link rel="stylesheet" type="text/css" href="{{URL::asset('assets')}}/vendors/css/forms/select/select2.min.css">
<style type="text/css">
    table.dataTable thead .sorting, 
table.dataTable thead .sorting_asc, 
table.dataTable thead .sorting_desc {
    background : none;
}
@media print {
  body {
    visibility: hidden;
  }
  #section_print {
    visibility: visible;
    position: absolute;
    left: 0;
    top: 0;
  }
}
</style>
@endsection
@section('title', 'Detail Transaksi (PPOB)')
@section('content')    
    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">Detail Transaksi (PPOB)</h2>
                <p>Detail transaksi dengan ID: {{ $data->no_invoice }}</p>
            </div>
        </div>
        <div class="card" id="section_print">
            <header class="card-header">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 mb-lg-0 mb-15">
                        <span> <i class="material-icons md-calendar_today"></i> <b>{{ date('d F Y H:i',strtotime($data->created_at)) }}</b> </span> <br>
                        <small class="text-muted">No Invoice: {{ $data->no_invoice }}</small>
                    </div>
                    <div class="col-lg-6 col-md-6 ms-auto text-md-end">
                        <select class="form-select d-inline-block mb-lg-0 mr-5 mw-200">
                            @if($data->status < 2)
                            <option class="text-danger">Belum Lunas</option>
                            
                            @else
                            <option class="text-success">LUNAS</option>
                            
                            @endif
                        </select>
                        <a class="btn btn-secondary print ms-2" href="javascript:void(0)" onclick="Print()"><i class="icon material-icons md-print"></i></a>
                    </div>
                </div>
            </header>
            <!-- card-header end// -->
            <div class="card-body">
                <div class="row mb-50 mt-20 order-info-wrap">
                    <table border="0" style="margin-bottom: 25px;width: 100%">
                    <tr>
                        <td colspan="3">
                            <h5>
                                Diterbitkan Atas Nama
                            </h5>
                        </td>
                        <td colspan="3">
                            <h5>
                                UNTUK
                            </h5>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 15%;vertical-align: top;">
                            Penjual
                        </td>
                        <td style="width: 5%;vertical-align: top;">
                            :
                        </td>
                        <td style="width: 30%">
                            <h6>SOUQ</h6>
                        </td>
                        <td style="width: 15%;vertical-align: top;">
                            Pembeli
                        </td>
                        <td style="width: 5%;vertical-align: top;">
                            :
                        </td>
                        <td style="width: 30%">
                            <h6>{{ $data->user_name }} <span class="text-muted">{{ $data->user_phone }}</span></h6>
                        </td>
                    <tr>
                        <td style="width: 15%;vertical-align: top;">
                            
                        </td>
                        <td style="width: 5%;vertical-align: top;">
                            
                        </td>
                        <td style="width: 30%">
                            
                        </td>                  
                        <td style="width: 15%;vertical-align: top;">
                            Tanggal Pembelian
                        </td>
                        <td style="width: 5%;vertical-align: top;">
                            :
                        </td>
                        <td style="width: 30%">
                            <h6>{{ date('d F Y H:i',strtotime($data->created_at)) }}</h6>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 15%;vertical-align: top;">
                            Pembayaran
                        </td>
                        <td style="width: 5%;vertical-align: top;">
                            :
                        </td>
                        <td style="width: 30%">
                            <p>{{ $data->bank }}</p>
                        </td>
                        <td style="width: 15%;vertical-align: top;">
                            Kategori Produk
                        </td>
                        <td style="width: 5%;vertical-align: top;">
                            :
                        </td>
                        <td style="width: 30%">
                            {{ $data->group }}
                        </td>
                    </tr>
                </table>
                <table class="table table-bordered table-striped table-hover" width="100" style="width: 100%">
                    <thead>
                        <tr>
                            <td style="width: 70%" colspan="3">INFO LENGKAP PRODUK</td>
                            <td style="width: 30%"></td>
                        </tr>
                    </thead>
                    <tbody>
                    @if($data->slug == 'pulsa-dan-paket-data')
                        <tr>
                            <td>Jenis Layanan</td>
                            <td>:</td>
                            <td style="text-align: left;">{{ $data->name }}</td>
                            <td rowspan="3"><span></span></td>
                        </tr>
                        <tr>
                            <td>Nomor</td>
                            <td>:</td>
                            <td style="text-align: left;">{{ $data->nomor }}</td>
                        </tr>
                        <tr>
                            <td>Serial Number</td>
                            <td>:</td>
                            <td style="text-align: left;">{{ $data->serial_number }}</td>
                        </tr>
                    @elseif($data->slug == 'pdam')
                        <tr>
                            <td>Jenis Layanan</td>
                            <td>:</td>
                            <td style="text-align: left;">{{ $data->name }}</td>
                            <td rowspan="5"><h6>Rp {{ number_format($data->total_of_pay) }}</h6></td>
                        </tr>
                        <tr>
                            <td>Nomor Pelanggan</td>
                            <td>:</td>
                            <td style="text-align: left;">{{ $data->nomor_pelanggan }}</td>
                        </tr>
                        <tr>
                            <td>Serial Number</td>
                            <td>:</td>
                            <td style="text-align: left;">{{ $data->serial_number }}</td>
                        </tr>
                        <tr>
                            <td>Total Tagihan</td>
                            <td>:</td>
                            <td style="text-align: left;">{{ $data->nominal }}</td>
                        </tr>
                        <tr>
                            <td>Biaya Admin</td>
                            <td>:</td>
                            <td style="text-align: left;">{{ $data->fee_admin }}</td>
                        </tr>
                    @elseif($data->slug == 'pln')
                        <tr>
                            <td>Jenis Layanan</td>
                            <td>:</td>
                            <td style="text-align: left;">{{ $data->name }}</td>
                            @if($data->token != null)
                            <td rowspan="11"><h6>Rp {{ number_format($data->total_of_pay) }}</h6></td>
                            @else
                            <td rowspan="10"><h6>Rp {{ number_format($data->total_of_pay) }}</h6></td>
                            @endif
                        </tr>
                        <tr>
                            <td>No. Meter/ldpel</td>
                            <td>:</td>
                            <td style="text-align: left;">{{ $data->no_meter }}</td>
                        </tr>
                        <tr>
                            <td>Nama Pelanggan</td>
                            <td>:</td>
                            <td style="text-align: left;">{{ $data->nama_pelanggan }}</td>
                        </tr>
                        <tr>
                            <td>Tarif/Daya</td>
                            <td>:</td>
                            <td style="text-align: left;">{{ $data->tarif_daya }}</td>
                        </tr>
                        <tr>
                            <td>BL/TH</td>
                            <td>:</td>
                            <td style="text-align: left;">{{ $data->BLTH }}</td>
                        </tr>
                        <tr>
                            <td>Stand Meter</td>
                            <td>:</td>
                            <td style="text-align: left;">{{ $data->stand_meter }}</td>
                        </tr>
                        <tr>
                            <td>RP TAG PLN</td>
                            <td>:</td>
                            <td style="text-align: left;">{{ $data->rp_tag_pln }}</td>
                        </tr>
                        <tr>
                            <td>NO REFF</td>
                            <td>:</td>
                            <td style="text-align: left;">{{ $data->no_reff }}</td>
                        </tr>
                        <tr>
                            <td>Total Tagihan</td>
                            <td>:</td>
                            <td style="text-align: left;">Rp {{ number_format($data->nominal) }}</td>
                        </tr>
                        <tr>
                            <td>Biaya Admin</td>
                            <td>:</td>
                            <td style="text-align: left;">Rp {{ number_format($data->fee_admin) }}</td>
                        </tr>
                        @if($data->token != null)
                        <tr>
                            <td>TOKEN</td>
                            <td>:</td>
                            <td style="text-align: left;">{{$data->token}}</td>
                        </tr>
                        @endif
                    @else
                        <tr>
                            <td>Jenis Layanan</td>
                            <td>:</td>
                            <td style="text-align: left;">{{$data->name}}</td>
                            <td rowspan="5"><h6>Rp {{ number_format($data->total_of_pay) }}</h6></td>
                        </tr>
                        <tr>
                            <td>Nomor Referensi</td>
                            <td>:</td>
                            <td style="text-align: left;">{{$data->no_reff}}</td>
                        </tr>
                        <tr>
                            <td>Nama Pelanggan</td>
                            <td>:</td>
                            <td style="text-align: left;">{{$data->nama_pelanggan}}</td>
                        </tr>
                        <tr>
                            <td>Nomor Pelanggan</td>
                            <td>:</td>
                            <td style="text-align: left;">{{$data->nomor_pelanggan}}</td>
                        </tr>
                        <tr>
                            <td>Total Tagihan</td>
                            <td>:</td>
                            <td style="text-align: left;">Rp {{ number_format($data->nominal) }}</td>
                        </tr>
                     @endif  
                    </tbody>
                </table>
                <table class="table" style="margin-top: 25px;">
                    <tr>
                        <td style="width: 50%"></td>
                        <td style="width: 10%"></td>
                        <td style="width: 20%"><h5>Subtotal:</h5></td>
                        <td style="width: 20%;text-align: right;"><h5>{{ number_format($data->nominal_amount)}}</h5></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Biaya Aplikasi:</td>
                        <td style="text-align: right;">{{ number_format($data->service_amount)}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Diskon:</td>
                        <td style="text-align: right;">{{ number_format($data->discount_amount)}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><h5>Total Pembayaran:</h5></td>
                        <td style="text-align: right;"><h5>Rp {{ number_format($data->pay_amount)}}</h5></td>
                    </tr>
                    
                </table>
                <table class="table" style="margin-top: 25px;">
                    <tr>
                        <td colspan="4">
                            <label>Invoice ini sah dan diproses oleh komputer<br> Silahkan hubungi <span class="text-success">SOUQ CARE</span> apabila kamu membutuhkan bantuan</label>
                        </td>
                    </tr>
                </table>
                    <!-- col// -->
                </div>
            </div>
            <!-- card-body end// -->
        </div>
        <!-- card end// -->
    </section>
@include('components/componen_js')
<script type="text/javascript">
    function Print(){
        window.print();
    }
</script>
@endsection