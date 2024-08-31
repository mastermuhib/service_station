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
@section('title', 'Detail Transaksi (Sisi Seller)')
@section('content')    
    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">Detail Transaksi (Sisi Seller)</h2>
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
                            @if($detail->status == 1)
                                <option>Pesanan Baru</option>
                            @elseif($detail->status == 2)
                                <option>Siap Dikirim</option>
                            @elseif($detail->status == 3)
                                <option>Dalam Pengiriman</option>
                            @elseif($detail->status == 4)
                                <option>Dikomplain</option>
                            @elseif($detail->status == 5)
                                <option>Tiba ditujuan</option>
                            @elseif($detail->status == 6)
                                <option>Pesanan Selesai</option>
                            @elseif($detail->status == 7)
                                <option>Batal</option>
                            @elseif($detail->status == 8)
                                <option>sudah di beri rating/diberi ulasan</option>
                            @else
                                <option>Belum dibayar</option>
                            @endif 
                        </select>
                        @if($detail->invoice_pdf != null)
                        <a class="btn btn-secondary print ms-2" target="_blank" href="{{ $detail->invoice_pdf }}" ><i class="icon material-icons md-print"></i></a>
                        @endif
                    </div>
                </div>
            </header>
            <!-- card-header end// -->
            <div class="card-body">
                <div class="row mb-50 mt-20 order-info-wrap">
                    <div class="col-md-4">
                        <article class="icontext align-items-start">
                            @if($detail->profile != null)
                            <img src="{{$detail->profile}}" class="img-sm img-avatar me-2" alt="Userpic">
                            @else
                            <span class="icon icon-sm rounded-circle bg-primary-light">
                                <i class="text-primary material-icons md-person"></i>
                            </span>
                            @endif
                            <div class="text">
                                <h6 class="mb-1">Customer</h6>
                                <p class="mb-1">
                                    {{ $detail->user_name }} <br>
                                    {{ $detail->user_email }} <br>
                                    {{ $detail->user_phone }}
                                </p>
                                
                            </div>
                        </article>
                    </div>
                    <!-- col// -->
                    <div class="col-md-4">
                        <article class="icontext align-items-start">
                            <span class="icon icon-sm rounded-circle bg-primary-light">
                                <i class="text-primary material-icons md-local_shipping"></i>
                            </span>
                            <div class="text">
                                <h6 class="mb-1">Transaksi info</h6>
                                <p class="mb-1">
                                    Shipping   : {{ $data[0]->master_delivery_name }} <br>
                                    Pembayaran : {{ $detail->bank }} <br>
                                    Tujuan     : {{ $detail->address_name }}, {{ $detail->route }}
                                </p>
                            </div>
                        </article>
                    </div>
                    <!-- col// -->
                    <div class="col-md-4">
                        <article class="icontext align-items-start">
                            @if($data[0]->shop_icon != null)
                            <img src="{{$data[0]->shop_icon}}" class="img-sm img-avatar me-2" alt="Userpic">
                            @else
                            <span class="icon icon-sm rounded-circle bg-primary-light">
                                <i class="text-primary material-icons md-place"></i>
                            </span>
                            @endif
                            <div class="text">
                                <h6 class="mb-1">Toko</h6>
                                <p class="mb-1">
                                    {{ $data[0]->shop_name }} <br>{{ $data[0]->address }} <br>
                                    {{ $data[0]->kota }}
                                </p>
                            </div>
                        </article>
                    </div>
                    <!-- col// -->
                </div>
                <!-- row // -->
                <div class="row">
                    <div class="col-lg-7">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th width="40%">Product</th>
                                        <th width="20%">Unit Price</th>
                                        <th width="20%">Quantity</th>
                                        <th width="20%" class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data[0]->product as $p)
                                    <tr>
                                        <td>
                                            <a class="itemside" href="#">
                                                <div class="left">
                                                    @if($p->image != null)
                                                    <img src="{{$p->image}}" width="40" height="40" class="img-xs" alt="Item">
                                                    @else
                                                    <img src="{{URL::asset('assets')}}/imgs/items/1.jpg" width="40" height="40" class="img-xs" alt="Item">
                                                    @endif
                                                </div>
                                                <div class="info">{{$p->product_name}}</div>
                                            </a>
                                        </td>
                                        <td>{{ number_format($p->selling_price)}}</td>
                                        <td>{{$p->amount}}</td>
                                        <td class="text-end">Rp {{ number_format($p->selling_price * $p->amount)}}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4">
                                            <article class="float-end">
                                                <dl class="dlist">
                                                    <dt>Biaya Pengiriman:</dt>
                                                    <dd>{{ number_format($detail->fee_ongkir)}}</dd>
                                                </dl>
                                                
                                                <dl class="dlist">
                                                    <dt>Diskon Promo:</dt>
                                                    <dd>{{ number_format($detail->discount_promotion)}}</dd>
                                                </dl>
                                                <dl class="dlist">
                                                    <dt>Diskon Ongkir:</dt>
                                                    <dd>{{ number_format($detail->discount_ongkir)}}</dd>
                                                </dl>
                                                <dl class="dlist">
                                                    <dt>Biaya Asuransi:</dt>
                                                    <dd>{{ number_format($detail->fee_asurance)}}</dd>
                                                </dl>
                                                <dl class="dlist">
                                                    <dt>Biaya Aplikasi:</dt>
                                                    <dd>{{ number_format($detail->fee_transaction)}}</dd>
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
    <section class="content-main">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title ms-2">Status Pemesanan (Tracking)</h5>
                @if($detail->cetak_resi_pdf != null)
                <a class="btn btn-success print ms-2" target="_blank" href="{{ $detail->cetak_resi_pdf }}"><i class="icon material-icons md-print"></i> Cetak Resi</a>
                @endif
            </div>
            <div class="card-body">
                
                @if($status_tracking == '3')
                    <h6 class="text-warning p-3 pt-0">Di Proses Saudagar</h6>
                @elseif($status_tracking == '4')
                    <h6 class="text-info p-3 pt-0">Sedang Dikirim</h6>
                @elseif($status_tracking == '5')
                    <h6 class="text-warning p-3 pt-0">Pesanan Dikomplain</h6>
                @elseif($status_tracking == '6')
                    <h6 class="text-success p-3 pt-0">Tiba di Tujuan</h6>
                @elseif($status_tracking == '7')
                    <h6 class="text-success p-3 pt-0">Pesanan Selesai</h6>
                @elseif($status_tracking == '8')
                    <h6 class="text-danger p-3 pt-0">Pesanan Dibatalkan</h6>
                @endif
                <ul class="verti-timeline list-unstyled font-sm">
                    <?php $no = 0; ?>
                    @foreach($data_tracking as $k=>$v)
                    <?php $no = $no + 1; ?>
                    <?php $system = "System-Tracker"; 
                        if (isset($v->type)) {
                            if ($v->type == '1') {
                                $system = "System-Automatic";
                            } else if ($v->type == '2') {
                                $system = "Seller";
                            } else {
                                $system = "Customer";
                            }
                        }
                    ?>
                    <li class="event-list">
                        <div class="event-timeline-dot">
                            @if($no == 1)
                            <i class="material-icons md-play_circle_outline font-xxl text-success animation-fade-right"></i>
                            @else
                            <i class="material-icons md-play_circle_outline font-xxl"></i>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-10 ps-1 pe-1">
                                @if($no == 1)
                                    @if($status_tracking == '3')
                                        
                                        <h6><span class="text-warning">{{$system}} - {{tgl_indo($v->date,2)}}, {{date('d-m-Y',strtotime($v->date))}}</span></h6>
                                    @elseif($status_tracking == '4')
                                        <h6><span class="text-info">{{$system}} - {{tgl_indo($v->date,2)}}, {{date('d-m-Y',strtotime($v->date))}}</span></h6>
                                    @elseif($status_tracking == '5')
                                        <h6><span class="text-warning">{{$system}} - {{tgl_indo($v->date,2)}}, {{date('d-m-Y',strtotime($v->date))}}</span></h6>
                                    @elseif($status_tracking == '6')
                                        <h6><span class="text-success">{{$system}} - {{tgl_indo($v->date,2)}}, {{date('d-m-Y',strtotime($v->date))}}</span></h6>
                                    @elseif($status_tracking == '7')
                                        <h6><span class="text-success">{{$system}} - {{tgl_indo($v->date,2)}}, {{date('d-m-Y',strtotime($v->date))}}</span></h6>
                                    @elseif($status_tracking == '8')
                                        <h6><span class="text-danger">{{$system}} - {{tgl_indo($v->date,2)}}, {{date('d-m-Y',strtotime($v->date))}}</span></h6>
                                    @endif
                                
                                @else
                                <h6><span class="text-muted">{{$system}} - {{tgl_indo($v->date,2)}}, {{date('d-m-Y',strtotime($v->date))}}</span></h6>
                                @endif

                            </div>
                            <div class="col-2 p-0">
                                <div class="text-right" style="text-align: right;"><span style="font-size: 11px">{{tgl_indo($v->date,3)}}</span></div>
                            </div>
                            <div class="col-12 ps-1 mt-2">
                                <div>
                                    @if($v->location != '' || $v->location != null)
                                    <p>{{$v->location}}</p>
                                    @endif
                                    {{$v->desc}}
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
@include('components/componen_js')
@endsection