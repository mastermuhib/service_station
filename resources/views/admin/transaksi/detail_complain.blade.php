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
@section('title', 'Detail Komplain')
@section('content')    
    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">Detail Komplain</h2>
                <p>Dari transaksi dengan ID: {{ $detail->no_invoice }}</p>
            </div>
        </div>
        <div class="card">
            <!-- card-header end// -->
            <div class="card-body">
                <div class="row order-info-wrap">
                    <div class="col-md-12">
                        <table border="0" class="table table-bordered" style="width: 100%">
                            <tr>
                                <td style="width: 20%;text-align: left;">
                                    <h5>Pembeli</h5>
                                </td>
                                <td style="width: 70%;text-align: left;">
                                    @if ($detail->profile != null)
                                    <a href="javascript:void(0)" class="itemside">
                                        <div class="left">
                                            <img src="{{$detail->profile}}" class="img-sm img-avatar" alt="Userpic">
                                        </div>
                                        <div class="info pl-3">
                                            <h6 class="mb-0 title">{{$detail->user_name}}</h6>
                                            <small class="text-muted">{{$detail->user_email}}</small>
                                        </div>
                                    </a>
                                    @else
                                    <a href="javascript:void(0)" class="itemside">
                                        <div class="left">
                                            <span class="font-weight-bold img-sm img-avatar" style="background: #e6c81c;padding: 15px;">{{substr($detail->user_name, 0, 1)}}</span>
                                        </div>
                                        <div class="info pl-3">
                                            <h6 class="mb-0 title">{{$detail->user_name}}</h6>
                                            <small class="text-muted">{{$detail->user_email}}</small>
                                        </div>
                                    </a>`   
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 20%;text-align: left;">
                                    <h5>Gerai</h5>
                                </td>
                                <td style="width: 70%;text-align: left;">
                                    @if ($detail->shop_icon != null)
                                    <a href="javascript:void(0)" class="itemside">
                                        <div class="left">
                                            <img src="{{$detail->shop_icon}}" class="img-sm img-avatar" alt="Userpic">
                                        </div>
                                        <div class="info pl-3">
                                            <h6 class="mb-0 title">{{$detail->shop_name}}</h6>
                                            <small class="text-muted">{{$detail->address}}</small>
                                        </div>
                                    </a>
                                    @else
                                    <a href="javascript:void(0)" class="itemside">
                                        <div class="left">
                                            <span class="font-weight-bold img-sm img-avatar" style="background: #e6c81c;padding: 15px;">{{substr($detail->shop_name, 0, 1)}}</span>
                                        </div>
                                        <div class="info pl-3">
                                            <h6 class="mb-0 title">{{$detail->shop_name}}</h6>
                                            <small class="text-muted">{{$detail->address}}</small>
                                        </div>
                                    </a>`   
                                    @endif
                                </td>
                            </tr>
                            @if($detail->master_delivery_name != null)
                            <tr>
                                <td style="width: 20%;text-align: left;">
                                    <h5>Jasa Pengiriman</h5>
                                </td>
                                <td style="width: 70%;text-align: left;">
                                    @if ($detail->master_delivery_icon != null)
                                    <a href="javascript:void(0)" class="itemside">
                                        <div class="left">
                                            <img src="{{$detail->master_delivery_icon}}" class="img-sm img-avatar" alt="Userpic">
                                        </div>
                                        <div class="info pl-3">
                                            <h6 class="mb-0 title">{{$detail->master_delivery_name}}</h6>
                                            <small class="text-muted">{{$detail->no_resi}}</small>
                                        </div>
                                    </a>
                                    @else
                                    <a href="javascript:void(0)" class="itemside">
                                        <div class="left">
                                            <span class="font-weight-bold img-sm img-avatar" style="background: #e6c81c;padding: 15px;">{{substr($detail->master_delivery_name, 0, 1)}}</span>
                                        </div>
                                        <div class="info pl-3">
                                            <h6 class="mb-0 title">{{$detail->master_delivery_name}}</h6>
                                            <small class="text-muted">{{$detail->no_resi}}</small>
                                        </div>
                                    </a>`   
                                    @endif
                                </td>
                            </tr>
                            @endif
                            <tr>
                                <td style="vertical-align: top;">
                                    <h5>Detail Komplain</h5>
                                </td>
                                <td>
                                    <div class="row">
                                        @foreach($data as $d)
                                        <div class="col-md-4">
                                            <div class="card card-user">
                                                <div style="cursor: pointer;">
                                                    <div class="div_bg_image">
                                                        <a href="javascript:void(0)" class="img-wrap"> <img src="{{$d->image_product}}" alt="Product" style="max-height: 200px;width: 100%;object-fit: cover;object-position: center;"> </a>
                                                    </div>
                                                    <div class="info-wrap p-2">
                                                        <h5 class="card-title mb-0">{{$d->product_name}}</h5>
                                                        <span class="mb-0 text-success ml-4" style="font-size: 12px;">{{$d->variant_model}} {{$d->variant_color}} {{$d->variant_size}}</span>
                                                        <br>
                                                        <span>{{$d->code_item}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- card-product  end// -->
                                        </div>
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-3">
                                                    <span>Total</span>
                                                </div>
                                                <div class="col-9">
                                                    : Rp {{number_format($d->nominal)}}
                                                </div>
                                                <div class="col-3">
                                                    <span>Status Proses</span>
                                                </div>
                                                <div class="col-9">
                                                    :   @if($d->is_proccessed == '0')
                                                        <span class="text-danger">Belum diproses</span>
                                                        @else
                                                        <span class="text-success">Sudah diproses</span>
                                                        @endif
                                                </div>
                                                <div class="col-3">
                                                    <span>Status Proses</span>
                                                </div>
                                                <div class="col-9">
                                                    :   @if($d->is_proccessed == '0')
                                                        <span class="text-danger">Belum diproses</span>
                                                        @else
                                                        <span class="text-success">Sudah diproses</span>
                                                        @endif
                                                </div>
                                                
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                            @if(count($chat) > 0)
                            <tr>
                                <td style="width: 20%;text-align: left;vertical-align: top;">
                                    <h5>Chat</h5>
                                </td>
                                <td style="width: 70%;text-align: left;">
                                    <div class="mb-3" style="height: 350px;overflow: auto;" id="the_message"> 
                                    @foreach($chat as $cm)
                                        @if($cm->type == '1')
                                        <div class="new-member-list">
                                            <div class="d-flex align-items-center">
                                                <img src="{{$cm->profile}}" alt="" class="avatar">
                                                <div>
                                                    <h6>{{$cm->user_name}}<span class="text-muted ml-15" style="font-size: 12px;font-weight: 300;">{{ $cm->text_time }}</span></h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="div_left p-3">
                                            <div class="text-dark font-sm p-3" style="background: white;width: 70%;border-radius: 1px 15px 15px 30px;border: 1px solid #eeeeee;">
                                                {!! $cm->chat !!}
                                            </div>
                                            @if($cm->file != null)
                                            <div class="row mt-2">
                                                <div class="col-md-4 col-10">
                                                    <div class="card card-user mb-0">
                                                        @if($cm->is_video == 1)
                                                        <video width="320" height="240" controls>
                                                          <source src="{{$cm->file}}" type="video/mp4">
                                                          <source src="{{$cm->file}}" type="video/ogg">
                                                          Your browser does not support the video tag.
                                                        </video>
                                                        @else
                                                        <img src="{{$cm->file}}" style="width: 100%">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-2">
                                                    
                                                </div>
                                            </div>
                                            @endif
                                            <span class="text-muted p-pointer d-none" style="font-size: 12px;font-weight: 500;">1 Balasan</span>
                                        </div>
                                        @elseif($cm->type == '2')
                                        <div class="new-member-list" style="float: right;"> 
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <h6><span class="text-muted mr-15" style="font-size: 12px;font-weight: 300;">{{ $cm->text_time }}</span>{{$cm->shop_name}}</h6>
                                                </div>
                                                <img src="{{$cm->shop_icon}}" alt="" class="avatar">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-md-12 mt-30">
                                            <div class="row"> 
                                                <div class="col-3">   
                                                </div> 
                                                <div class="col-9">
                                                    
                                                    <div class="text-dark font-sm p-3" style="background: #c0ffcf;border-radius: 15px 1px 30px 15px;text-align: right;">
                                                        {!! $cm->chat !!}
                                                    </div>
                                                    @if($cm->file != null)
                                                    <div class="row mt-2">
                                                        <div class="col-md-8 col-2">
                                                            
                                                        </div>
                                                        <div class="col-md-4 col-10">
                                                            <div class="card card-user mb-0">
                                                                @if($cm->is_video == 1)
                                                                <video width="320" height="240" controls>
                                                                  <source src="{{$cm->file}}" type="video/mp4">
                                                                  <source src="{{$cm->file}}" type="video/ogg">
                                                                  Your browser does not support the video tag.
                                                                </video>
                                                                @else
                                                                <img src="{{$cm->file}}" style="width: 100%">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <p class="text-muted p-pointer d-none" style="font-size: 12px;font-weight: 500;text-align: right;">1 Balasan</p>
                                                </div>
                                            </div>  
                                        </div>
                                        @else
                                        <div class="new-member-list" style="float: right;"> 
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <h6><span class="text-muted mr-15" style="font-size: 12px;font-weight: 300;">{{ $cm->text_time }}</span>{{$cm->admin_name}}</h6>
                                                </div>
                                                <img src="{{$cm->foto_admin}}" alt="" class="avatar">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-md-12 mt-30">
                                            <div class="row"> 
                                                <div class="col-3">   
                                                </div> 
                                                <div class="col-9">
                                                    
                                                    <div class="text-dark font-sm p-3" style="background: #c0e6ff;border-radius: 15px 1px 30px 15px;text-align: right;">
                                                        {!! $cm->chat !!}
                                                    </div>
                                                    @if($cm->file != null)
                                                    <div class="row mt-2">
                                                        <div class="col-md-8 col-2">
                                                            
                                                        </div>
                                                        <div class="col-md-4 col-10">
                                                            <div class="card card-user mb-0">
                                                                @if($cm->is_video == 1)
                                                                <video width="320" height="240" controls>
                                                                  <source src="{{$cm->file}}" type="video/mp4">
                                                                  <source src="{{$cm->file}}" type="video/ogg">
                                                                  Your browser does not support the video tag.
                                                                </video>
                                                                @else
                                                                <img src="{{$cm->file}}" style="width: 100%">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <p class="text-muted p-pointer d-none" style="font-size: 12px;font-weight: 500;text-align: right;">1 Balasan</p>
                                                </div>
                                            </div>  
                                        </div>
                                        @endif
                                    @endforeach
                                    </div>
                                    <div class="col-md-12">
                                        <form id="form_reply">
                                            <input type="hidden" name="id_complain" id="id_complain" value="{{$id}}">
                                            <textarea placeholder="Tulis Komentar Admin" name="chat" id="text_chat" class="form-control" rows="4"></textarea onkeydown="pressed(event)">
                                            <div class="row mt-5">
                                                <div class="col-6">
                                                    <label>Tipe File</label>
                                                    <select class="form-control" name="is_video">
                                                        <option value="0">Foto</option>
                                                        <option value="1">Video</option>
                                                    </select>
                                                </div>
                                                <div class="col-6"> 
                                                    <label>Pilih File</label>   
                                                    <input type="file" class="form-control" name="file" id="file">
                                                </div>
                                            </div>
                                            <button class="btn btn-md mt-2 btn-success w-100 text-center" type="button" id="reply">Balas Chat<i class="fab fa-telegram-plane ml-5"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endif
                        </table>
                    </div>
                </div>
                <!-- row // -->
            </div>
            <!-- card-body end// -->
        </div>
        <!-- card end// -->
        <div class="row">
            <div class="col-md-3 col-6">
                <button class="btn btn-md w-100 btn-success" onclick="ModalComplain()" type="button" >Kabulkan Komplain</button>
            </div>
            <div class="col-md-3 col-6">
                <button class="btn btn-md w-100 btn-danger" onclick="ModalDenyComplain()" type="button" >Batalkan Komplain</button>
            </div>
        </div>
    </section>
<!-- Modal -->
<input type="hidden" id="id_complain" value="{{$id}}" name="">
<div class="modal fade text-left" id="modal_accept" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title-modal">Mengabulkan Komplain</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6 class="modal-title" id="title-modal">Apakah Anda yakin, untuk mengabulkan komplain ini?<br> Dengan mengabulkan komplain, berarti Anda menyetujui pengembalian Dana transaksi kepada pihak pembeli</h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="AcceptComplain()">Iya, Saya sudah yakin</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade text-left" id="modal_denny" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title-modal">Membatalkan Komplain</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6 class="modal-title" id="title-modal">Apakah Anda yakin, untuk membatalkan komplain ini?<br> Dengan membatalkan komplain, berarti Anda tidak menyetujui permohonan komplain </h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="DennyComplain()">Iya, Saya sudah yakin</button>
            </div>
        </div>
    </div>
</div>
<!-- -->
@include('components/componen_js')
<script type="text/javascript">
    $('#the_message').scrollTop($('#the_message')[0].scrollHeight);
    function ModalComplain(){
        $("#modal_accept").modal('show');
    }

    function ModalDenyComplain(){
        $("#modal_denny").modal('show');
    }

    function AcceptComplain(){
        id = $("#id_complain").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({ //line 28
            type: 'POST',
            url: '/approve_complain',
            dataType: 'json',
            data: { id:id },
            success: function(data) {
                if (data.code == '200') {
                    show_toast(data.message, 1);
                } else {
                    show_toast(data.message, 0);
                }
            }
        });
    }

    function DennyComplain(){
        id = $("#id_complain").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({ //line 28
            type: 'POST',
            url: '/denny_complain',
            dataType: 'json',
            data: { id:id },
            success: function(data) {
                if (data.code == '200') {
                    show_toast(data.message, 1);
                } else {
                    show_toast(data.message, 0);
                }
            }
        });
    }

    function pressed(e) {
    //alert("okey");
        reply = $("#text_chat").val();
        if ( (window.event ? event.keyCode : e.which) == 13) { 
            // If it has been so, manually submit the <form>
            //alert("enter");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({ //line 28
                type: 'POST',
                url: '/reply_complain',
                dataType: 'html',
                data: new FormData($("#form_reply")[0]),
                processData: false,
                contentType: false,
                success: function(data) {
                    $("#the_message").html(data);
                    $('#the_message').scrollTop($('#the_message')[0].scrollHeight);
                    $("#text_chat").val('');  
                }
            });
        }
    }

    
    $(document).off('click', '#reply').on('click', '#reply', function() {
    //$("#form_reply").submit(function(e) {
        reply = $("#text_chat").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({ //line 28
            type: 'POST',
            url: '/reply_complain',
            dataType: 'html',
            data: new FormData($("#form_reply")[0]),
            processData: false,
            contentType: false,
            success: function(data) {
                $("#the_message").html(data);
                $('#the_message').scrollTop($('#the_message')[0].scrollHeight);
                $("#text_chat").val(''); 
            }
        });
    });
</script>
@endsection