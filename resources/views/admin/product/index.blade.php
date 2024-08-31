@extends('layout.app')
@section('content')
<div class="card mb-4">
    <header class="card-header">
        <div class="row gx-3">
            <div class="col-md-3 me-auto mb-5">
                <input type="text" placeholder="Search by nama produk atau nama toko.." class="form-control" onkeyup="data_table('data_productx')" id="search">
                <input type="hidden" name="start" id="start" value="0">
                <input type="hidden" name="id_shop" id="id_shop" value="">
            </div>
            <div class="col-md-3 mb-5">
                <select class="select2 form-control" name="id_category1" id="select_master" onchange="ChangeMaster()">
                    <option value="">Semua Kategori</option>
                    @foreach($category_product as $v)
                    
                    <option value="{{$v->id}}">{{$v->master_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 mb-5">
                <select class="select2 form-control" name="id_category2" id="select_sub" onchange="ChangeSub()">
                    <option value="">Semua Sub Kategori 1</option>
                </select>
            </div>
            <div class="col-md-3 mb-5">
                <select class="select2 form-control" name="id_category3" id="select_sub_sub" onchange="ChangeSubSub()">
                    <option value="">Semua Sub Kategori 2</option>
                </select>
            </div>
            <div class="col-md-3 mb-5">
                <select class="select2 form-control" name="id_category4" id="select_sub_4" onchange="data_table('data_products')">
                    <option value="">Semua Sub Kategori 3</option>
                </select>
            </div>
            <div class="col-md-3 mb-5">
                <select class="form-select select2" onchange="data_table('data_products')" id="id_city">
                    <option value="">Semua Lokasi</option>
                    @foreach($gudang as $g)
                    <option value="{{$g->id}}">{{$g->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select" onchange="data_table('data_products')" id="sort">
                    <option value="1">Urutkan Terbaru</option>
                    <option value="2">Stock Terbanyak</option>
                    <option value="3">Terlaris</option>
                    <option value="4">Rating Tertinggi</option>
                    <option value="3">Harga Termahal</option>
                </select>
            </div>
        </div>
    </header>
    <div class="card-body">
        <div class="row" id="body_product">
            
            <!-- col.// -->
        </div>
        <!-- row.// -->
        <div class="text-center">
            <button type="button" id="btn-next" onclick="Next()" style="display: none;" class="btn btn-sm btn-success">Lihat Produk Lainya</button>
        </div>
    </div>
    <!--  card-body.// -->
</div>
@include('components/componen_js')
@include('components/js/product/index')
@endsection