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
@section('title', 'Detail Transaksi (Produk)')
@section('content')    
    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">Detail Transaksi (Produk)</h2>
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
                        <a class="btn btn-secondary print ms-2 d-none" href="javascript:void(0)" onclick="Print()"><i class="icon material-icons md-print"></i></a>
                        <button class="btn btn-info btn-md" type="button" onclick="showTransaction()"><i class="fas fa-edit">Edit Data Transaksi</i></button>
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
                                    Pembayaran : {{ $detail->bank }} <br>
                                    Tujuan     : {{ $detail->address_name }}, {{ $detail->route }}
                                </p>
                            </div>
                        </article>
                    </div>
                    <!-- col// -->
                    <div class="col-md-4">
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
                <!-- row // -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            @foreach($data as $d)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="4">
                                            <article class="icontext align-items-start">
                                                @if($d->shop_icon != null)
                                                <img src="{{$d->shop_icon}}" class="img-sm img-avatar me-2" alt="Userpic">
                                                @else
                                                <img src="{{URL::asset('assets')}}/imgs/items/1.jpg" class="img-sm img-avatar me-2" alt="Userpic">
                                                @endif
                                                        <div class="text">
                                                    <h6 class="mb-1">{{$d->shop_name}}</h6>
                                                    <p class="mb-1">
                                                        {{$d->kota}}<br>
                                                        {{$d->address}} <br>
                                                        
                                                    </p> 
                                                </div>
                                            </article>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th width="40%">Product</th>
                                        <th width="20%">Unit Price</th>
                                        <th width="20%">Quantity</th>
                                        <th width="20%" class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($d->product as $p)
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
                                </tbody>
                            </table>
                            @endforeach
                            <table class="table">
                                <tr>
                                    <td colspan="4">
                                        <article class="float-end">
                                            <dl class="dlist">
                                                <dt>Subtotal:</dt>
                                                <dd>{{ number_format($detail->nominal_amount)}}</dd>
                                            </dl>
                                            <dl class="dlist">
                                                <dt>Biaya Pengiriman:</dt>
                                                <dd>{{ number_format($detail->delivery_amount)}}</dd>
                                            </dl>
                                            <dl class="dlist">
                                                <dt>Diskon Produk:</dt>
                                                <dd>{{ number_format($detail->discount_product)}}</dd>
                                            </dl>
                                            <dl class="dlist">
                                                <dt>Diskon Promo:</dt>
                                                <dd>{{ number_format($detail->discount_promo)}}</dd>
                                            </dl>
                                            <dl class="dlist">
                                                <dt>Diskon Ongkir:</dt>
                                                <dd>{{ number_format($detail->discount_delivery)}}</dd>
                                            </dl>
                                            <dl class="dlist">
                                                <dt>Biaya Asuransi:</dt>
                                                <dd>{{ number_format($detail->assurance_amount)}}</dd>
                                            </dl>
                                            <dl class="dlist">
                                                <dt>Biaya Aplikasi:</dt>
                                                <dd>{{ number_format($detail->service_amount)}}</dd>
                                            </dl>
                                            <dl class="dlist">
                                                <dt>Total Pembayaran:</dt>
                                                <dd><b class="h5">Rp {{ number_format($detail->pay_amount)}}</b></dd>
                                            </dl>
                                            
                                        </article>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <!-- table-responsive// -->
                    </div>
                    <!-- col// -->
                    <!-- col// -->
                </div>
            </div>
            <!-- card-body end// -->
        </div>
        <!-- card end// -->
    </section>
    @foreach($data_tracking as $a=>$b)
    <section class="content-main">
        <div class="card">
            <header class="card-header">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 mb-lg-0 mb-15">
                        <article class="icontext align-items-start">
                            <img src="{{$b->shop_icon}}" class="img-sm img-avatar me-2" alt="Userpic">
                            <div class="text">
                                <h6 class="mb-1">Toko</h6>
                                <p class="mb-1">
                                    {{$b->shop_name}} <br>
                                    {{$b->no_resi}}
                                </p>
                            </div>
                        </article>
                    </div>
                </div>
            </header>
            <div class="card-body">
                <h5 class="card-title ms-2">Status Pemesanan (Tracking)</h5>
                @if($b->status == '3')
                    <h6 class="text-warning p-3 pt-0">Di Proses Saudagar</h6>
                @elseif($b->status == '4')
                    <h6 class="text-info p-3 pt-0">Sedang Dikirim</h6>
                @elseif($b->status == '5')
                    <h6 class="text-warning p-3 pt-0">Pesanan Dikomplain</h6>
                @elseif($b->status == '6')
                    <h6 class="text-success p-3 pt-0">Tiba di Tujuan</h6>
                @elseif($b->status == '7')
                    <h6 class="text-success p-3 pt-0">Pesanan Selesai</h6>
                @elseif($b->status == '8')
                    <h6 class="text-danger p-3 pt-0">Pesanan Dibatalkan</h6>
                @endif
                <ul class="verti-timeline list-unstyled font-sm">
                    <?php $no = 0; ?>
                    @foreach($b->data as $k=>$v)
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
                                    @if($b->status == '3')
                                        
                                        <h6><span class="text-warning">{{$system}} - {{tgl_indo($v->date,2)}}, {{date('d-m-Y',strtotime($v->date))}}</span></h6>
                                    @elseif($b->status == '4')
                                        <h6><span class="text-info">{{$system}} - {{tgl_indo($v->date,2)}}, {{date('d-m-Y',strtotime($v->date))}}</span></h6>
                                    @elseif($b->status == '5')
                                        <h6><span class="text-warning">{{$system}} - {{tgl_indo($v->date,2)}}, {{date('d-m-Y',strtotime($v->date))}}</span></h6>
                                    @elseif($b->status == '6')
                                        <h6><span class="text-success">{{$system}} - {{tgl_indo($v->date,2)}}, {{date('d-m-Y',strtotime($v->date))}}</span></h6>
                                    @elseif($b->status == '7')
                                        <h6><span class="text-success">{{$system}} - {{tgl_indo($v->date,2)}}, {{date('d-m-Y',strtotime($v->date))}}</span></h6>
                                    @elseif($b->status == '8')
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
    @endforeach
<!-- Modal -->
<div class="modal fade text-left" id="modal_edit_transaction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel45" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content modal-xl">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data Transaksi</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_edit_transaction">@csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <input type="hidden" name="id" value="{{$detail->id}}">
                                <label class="control-label">Nominal Transaksi</label>
                                <input type="text" name="nominal_amount" id="txt_nominal" no="nominal" class="form-control form-control-lg nominal"  placeholder="Nominal Transaksi" value="{{$detail->nominal_amount}}" required>
                            </div>
                        </div> 
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="control-label">Diskon / Potongan</label>
                                <input type="text" name="discount_amount" id="txt_discount" no="discount" class="form-control form-control-lg nominal"  placeholder="Diskon" value="{{$detail->discount_amount}}" required>
                            </div>
                        </div> 
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="control-label">Biaya Pengiriman</label>
                                <input type="text" name="delivery_amount" id="txt_delivery" no="delivery" class="form-control form-control-lg nominal"  placeholder="Biaya Pengiriman" value="{{$detail->delivery_amount}}" required>
                            </div>
                        </div> 
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="control-label">Biaya Asuransi</label>
                                <input type="text" name="assurance_amount" id="txt_assurance" no="assurance" class="form-control form-control-lg nominal"  placeholder="Biaya Asuransi" value="{{$detail->assurance_amount}}" required>
                            </div>
                        </div> 
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="control-label">Transaksi Dengan Poin</label>
                                <input type="text" name="point_amount" id="txt_point" no="point" class="form-control form-control-lg nominal"  placeholder="Dengan Poin" value="{{$detail->point_amount}}" required>
                            </div>
                        </div> 
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="control-label">Transaksi Biaya Yang Dibayar</label>
                                <input type="text" name="pay_amount" id="txt_pay" no="pay" class="form-control form-control-lg nominal"  placeholder="Yang dibayar customer" value="{{$detail->pay_amount}}" required>
                            </div>
                        </div> 
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="btn_edit_transaction" onclick="SaveTransaction()">Iya, Simpan Data</button>
            </div>
        </div>
    </div>
</div>
<!-- -->
@include('components/componen_js')
@endsection
<script type="text/javascript">
    function showTransaction(){
        $("#modal_edit_transaction").modal('show');
    }

    function SaveTransaction(){
        $.ajax({ //line 28
            type: 'POST',
            url: '/edit_data_transaction',
            dataType: 'json',
            data: new FormData($("#form_edit_transaction")[0]),
            processData: false,
            contentType: false,
            success: function(data) {
                $("#loading_add").css('display', 'none');
                $("#save_add").css('display', '');
                if (data.code == 200) {
                    
                    $("#message").remove();
                    show_toast(data.message, 1);
                    location.reload();
                } else {
                    show_toast(data.message, 0);
                }
            }
        });
    }

    $(document).off('keyup', '.nominal').on('keyup', '.nominal', function() {
        no = $(this).attr('no');
        var nominal_x = document.getElementById('txt_'+no);
        
        nominal_x.value = formatRupiah(this.value, '');
        
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        //console.log(number_string);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>