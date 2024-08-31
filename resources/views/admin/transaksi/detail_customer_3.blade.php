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
@section('title', 'Detail Transaksi (Jasa)')
@section('content')    
    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">Detail Transaksi (Jasa)</h2>
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
                        <a class="btn btn-secondary print ms-2" href="javascript:void(0)" onclick="Print()"><i class="icon material-icons md-print"></i></a>
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
                                    Jasa : {{ $detail->title }} <br>
                                    Deskripsi     : {{ $detail->description }}
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
            </div>
            <!-- card-body end// -->
        </div>
        <!-- card end// -->
    </section>
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