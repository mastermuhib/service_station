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
@section('title', 'Detail Transaksi (Iklan / Ads)')
@section('content')    
    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">Detail Transaksi (Iklan / Ads)</h2>
                <p>Detail transaksi dengan ID: {{ $detail->no_invoice }}</p>
            </div>
        </div>
        <div class="card">
            <header class="card-header">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 mb-lg-0 mb-15">
                        <span> <i class="material-icons md-calendar_today"></i> <b>{{ date('d F Y H:i',strtotime($detail->created_at)) }}</b> </span> <br>
                        <small class="text-muted">No Invoice: {{ $detail->no_invoice }}</small>
                    </div>
                    <div class="col-lg-6 col-md-6 ms-auto text-md-end">
                        <select class="form-select d-inline-block mb-lg-0 mr-5 mw-200">
                            @if($detail->status == 2)
                                <option>Lunas</option>
                            @elseif($detail->status == 8)
                                <option>Batal</option>
                            @else
                                <option>Belum dibayar</option>
                            @endif 
                        </select>
                        @if($detail->link_pdf != null)
                        <a class="btn btn-secondary print ms-2" target="_blank" href="{{ $detail->link_pdf }}" ><i class="icon material-icons md-print"></i></a>
                        @endif
                    </div>
                </div>
            </header>
            <!-- card-header end// -->
            <div class="card-body">
                <div class="row mb-50 mt-20 order-info-wrap">
                    <div class="col-md-4">
                        <article class="icontext align-items-start">
                            @if($detail->shop_icon != null)
                            <img src="{{$detail->shop_icon}}" class="img-sm img-avatar me-2" alt="Userpic">
                            @else
                            <span class="icon icon-sm rounded-circle bg-primary-light">
                                <i class="text-primary material-icons md-person"></i>
                            </span>
                            @endif
                            <div class="text">
                                <h6 class="mb-1">{{ $detail->shop_name }}</h6>
                                <p class="mb-1">
                                    {{ $detail->user_name }} <br>
                                    {{ $detail->user_email }} <br>
                                    {{ $detail->user_phone }}
                                </p>
                                
                            </div>
                        </article>
                    </div>
                    <!-- col// -->
                    
                    <!-- col// -->
                </div>
                <!-- row // -->
                <div class="row">
                    <div class="col-lg-7">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th width="50%">Iklan / Ads</th>
                                        <th width="25%">Unit Price</th>
                                        <th width="25%" class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <tr>
                                        <td>
                                            <a class="itemside" href="#">
                                                <div class="left">
                                                    @if($detail->icon != null)
                                                    <img src="{{$detail->icon}}" width="40" height="40" class="img-xs" alt="Item">
                                                    @else
                                                    <img src="{{URL::asset('assets')}}/imgs/items/1.jpg" width="40" height="40" class="img-xs" alt="Item">
                                                    @endif
                                                </div>
                                                <div class="info">{{$detail->title}}</div>
                                            </a>
                                        </td>
                                        <td>{{ number_format($detail->nominal)}}</td>
                                        <td class="text-end">Rp {{ number_format($detail->nominal)}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <article class="float-end">
                                                <dl class="dlist">
                                                    <dt>Diskon Promo:</dt>
                                                    <dd>{{ number_format($detail->discount)}}</dd>
                                                </dl>
                                                <dl class="dlist">
                                                    <dt>Biaya Aplikasi:</dt>
                                                    <dd>{{ number_format($detail->fee_admin)}}</dd>
                                                </dl>
                                                <dl class="dlist">
                                                    <dt>Total Pembayaran:</dt>
                                                    <dd><b class="h5">Rp {{ number_format($detail->total)}}</b></dd>
                                                </dl>
                                                
                                            </article>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- table-responsive// -->
                    </div>
                    <!-- col// -->
                    <div class="col-lg-1"></div>
                    <div class="col-lg-4">
                        <div class="box shadow-sm bg-light">
                            <h6 class="mb-15">Payment info</h6>
                            <p>
                                <img src="{{$detail->bank_icon}}" class="border me-2" height="40">
                                {{$detail->bank}}
                                <br>
                                Virtual Akun : {{$detail->va_number}} <br>
                            </p>
                        </div>
                        
                    </div>
                    <!-- col// -->
                </div>
            </div>
            <!-- card-body end// -->
        </div>
        <!-- card end// -->
    </section>
@include('components/componen_js')
@endsection