@extends('layout.app')
@section('asset')
<link rel="stylesheet" type="text/css" href="{{URL::asset('assets')}}/vendors/css/forms/select/select2.min.css">
<style type="text/css">
    table.dataTable thead .sorting, 
table.dataTable thead .sorting_asc, 
table.dataTable thead .sorting_desc {
    background : none;
}
</style>
@endsection
@section('title', 'Detail Transaksi (PPOB)')
@section('content')    
    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">Detail Penarikan Dana</h2>
                <p>Detail transaksi dengan ID: WD_{{ date('YmdHi',strtotime($data->created_at)) }}</p>
            </div>
        </div>
        <div class="card">
            <header class="card-header">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 mb-lg-0 mb-15">
                        <span> <i class="material-icons md-calendar_today"></i> <b>{{ date('d F Y H:i',strtotime($data->created_at)) }}</b> </span> <br>
                    </div>
                    <div class="col-lg-6 col-md-6 ms-auto text-md-end">
                        <select class="form-select d-inline-block mb-lg-0 mr-5 mw-200">
                            @if($data->status == 2)
                            <option class="text-danger">Gagal</option>
                            @elseif($data->status == 1)
                            <option class="text-success">Sukses</option>
                            @else
                            <option class="text-warning">Pending</option>
                            @endif
                        </select>
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
                                Informasi Akun
                            </h5>
                        </td>
                        <td colspan="3">
                            <h5>
                                Informasi Bank
                            </h5>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 15%;vertical-align: top;">
                            Name
                        </td>
                        <td style="width: 5%;vertical-align: top;">
                            :
                        </td>
                        <td style="width: 30%">
                            {{ $data->user_name }}
                        </td>
                        <td style="width: 15%;vertical-align: top;">
                            Nama Bank
                        </td>
                        <td style="width: 5%;vertical-align: top;">
                            :
                        </td>
                        <td style="width: 30%">
                            {{ $data->bank_name }} - {{ $data->account_number }}
                        </td>
                    <tr>
                        <td style="width: 15%;vertical-align: top;">
                           Nomor HP 
                        </td>
                        <td style="width: 5%;vertical-align: top;">
                            :
                        </td>
                        <td style="width: 30%">
                            {{ $data->user_phone }}
                        </td>                  
                        <td style="width: 15%;vertical-align: top;">
                            Atas Nama
                        </td>
                        <td style="width: 5%;vertical-align: top;">
                            :
                        </td>
                        <td style="width: 30%">
                            {{ $data->name }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 15%;vertical-align: top;">
                            Email
                        </td>
                        <td style="width: 5%;vertical-align: top;">
                            :
                        </td>
                        <td style="width: 30%">
                            <p>{{ $data->user_email }}</p>
                        </td>
                        <td style="width: 15%;vertical-align: top;">
                            Tanggal Penarikan
                        </td>
                        <td style="width: 5%;vertical-align: top;">
                            :
                        </td>
                        <td style="width: 30%">
                            {{ date('d F Y H:i',strtotime($data->created_at)) }}
                        </td>
                    </tr>
                </table>
                
                <table class="table" style="margin-top: 25px;">
                    <tr>
                        <td></td>
                        <td></td>
                        <td><h5>Total Penarikan:</h5></td>
                        <td style="text-align: right;"><h5>Rp {{ number_format($data->nominal)}}</h5></td>
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
@endsection