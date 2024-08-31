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
@section('title', 'Promosi')
@section('content')
<div class="accordion accordion-solid accordion-panel accordion-svg-toggle mb-3 mt-3" id="faq">
    <div class="card p-6 col-md-12">
        <div class="card-header" id="faqHeading2">
            <div class="card-title font-size-h4 text-dark collapsed" data-toggle="collapse" data-target="#faq2" aria-expanded="false" aria-controls="faq2" role="button">
                <div class="card-label">Filter transaksi <i class="fas fa-filter ml-10"></i></div>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div id="faq2" class="collapse" aria-labelledby="faqHeading2" data-parent="#faq" style="">
            <div class="card-body pt-3 font-size-h6 font-weight-normal text-dark-50">
                <form id="form_filter">
                    <div class="row" data-select2-id="4">
                        <div class="col-md-3">
                            <label>Dari Tanggal</label>
                            <input type="date" name="tgl_start" class="form-control form-control-lg form-control form-control-lg-lg" onchange="data_tabel('data_transaksi_service')" id="start">
                        </div>
                        <div class="col-md-3">
                            <label>Sampai Tanggal</label>
                            <input type="date" name="tgl_end" class="form-control form-control-lg form-control form-control-lg-lg" onchange="data_tabel('data_transaksi_service')" id="end">
                        </div>
                        <div class="col-md-3">
                            <label>Status Transaksi (disisi customer) </label>
                            <select class="select2 form-control form-control-lg" id="status" name="status" onchange="data_tabel('data_transaksi_service')">
                                <option value="">Semua</option>
                                <option value="1">Menunggu Pembayaran</option>
                                <option value="2">Menunggu Konfirmasi</option>
                                <option value="3">Diproses Saudagar</option>
                                <option value="4">Sedang Dikirim</option>
                                <option value="5">Dikomplain</option>
                                <option value="6">Selesai</option>
                                <option value="8">Batal</option>
                                <option value="9">Expired</option>
                                <option value="10">sudah di rating / diberi ulasan</option>
                            </select>
                        </div>
                        <input type="hidden" name="sort" value="" id="is_sort">
                    </div>
                </form>
            </div>
        </div>
        <!--end::Body-->
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <!--begin::List Widget 9-->
        <div class="card card-custom card-stretch gutter-b">
            <!--begin::Header-->
            <div class="card-header align-items-center border-0 row">
                <div class="col-md-2">
                    <h5 class="text-dark font-weight-bold ml-3"><spaan>List Transaksi Jasa</spaan></h5> 
                </div>
                <div class="col-md-6 pl-0">
                </div>
                <div class="col-md-4">
                    
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body" style="margin-top: -25px;">
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <!-- <div class="card-header">
                                    <h4 class="card-title">List Admin</h4>
                                </div> -->
                                <div class="card-content">
                                    <div class="card-body card-dashboard">
                                        <div class="row">
                                            <div class="col-md-2 col-xs-12">
                                                <div class="mb-4">
                                                    <button class="btn btn-block btn-sm btn-danger" onclick="ResetAll()" type="button"><i class="fas fa-sync"></i> Refresh</button>
                                                </div>
                                            </div> 
                                            <div class="col-md-4 col-xs-12">
                                                <div class="mb-4">
                                                    <select class="form-control form-control-lg form-control form-control-lg-lg" onchange="data_tabel('data_transaksi')" id="sort" style="height: 45px;">
                                                        <option value="0" selected>Urutkan By Tanggal (Terbaru)</option>
                                                        <option value="1">Urutkan By Tanggal (Terlama)</option>
                                                    </select>
                                                </div>
                                            </div> 
                                            <div class="col-md-6">
                                                <div class="input-group rounded bg-light">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <span class="svg-icon svg-icon-lg">
                                                                <!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
                                                                <i class="fas fa-search"></i>
                                                                <!--end::Svg Icon-->
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <input type="text" id="s_search" class="form-control form-control-lg h-45px" placeholder="Cari Invoice/Customer">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-hover" id="data_tabel">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>No Invoice</th>
                                                        <th>Nominal</th>
                                                        <th>Pembeli</th>
                                                        <th>Jasa/Toko</th>
                                                        <th>Status</th>
                                                        <th>Tanggal</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <!--end: Card Body-->
        </div>
        <!--end: Card-->
        <!--end: List Widget 9-->
        <!-- </div> -->
    </div>
</div>
<input type="hidden" id="id_user" name="">
@include('components/componen_js')
@include('components/js/transaksi/index_service')
@endsection