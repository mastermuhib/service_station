@extends('layout.app')
@section('asset')
<link rel="stylesheet" type="text/css" href="{{URL::asset('assets')}}/vendors/css/forms/select/select2.min.css">
@endsection
@section('title', 'Detail Peserta')
@section('content')
<style type="text/css">
    td {
        vertical-align: middle;
        text-align: center;
    }
    th {
        padding-left: 5px;
    }
</style>
<div id="show_edit">
</div>
<div id="edit_password">
</div>
<div class="row" id="show_add">
    <div class="col-lg-12">
        <section class="multiple-validation">
            <div class="card mb-3">
                <div class="card-content">
                    <div class="card-body">
                        <form method="POST" class="form-horizontal p-3" id="form_edit">@csrf
                            <div class="row mb-5">
                                <div class="col-sm-6">
                                    <div class="mb-4">
                                        <label class="control-label">Nama Produk</label>
                                        <input type="hidden" name="id" value="{{$data->id}}" id="id">
                                        <input type="text" name="product_name" class="form-control form-control-lg" value="{{$data->product_name}}" placeholder="Nama Produk" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-4">
                                        <label class="control-label">Kode SKU</label>
                                        <input type="text" name="sku_code" class="form-control form-control-lg" value="{{$data->sku_code}}" placeholder="SNI005" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-4">
                                        <label class="control-label">Tipe berat</label>
                                        <select class="form-control"  name="type_of_weight">
                                            <option value="gram" <?php if ($data->type_of_weight == 'gram') {
                                                echo "selected";
                                            } ?>>gram</option>
                                            <option value="kg" <?php if ($data->type_of_weight == 'kg') {
                                                echo "selected";
                                            } ?>>kg</option>
                                            <option value="kwintal" <?php if ($data->type_of_weight == 'kwintal') {
                                                echo "selected";
                                            } ?>>kwintal</option>
                                            <option value="ton" <?php if ($data->type_of_weight == 'ton') {
                                                echo "selected";
                                            } ?>>ton</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-4">
                                        <label class="control-label">Berat Produk</label>
                                        <input type="number" min="0" name="weight" class="form-control form-control-lg" value="{{$data->weight}}" placeholder="500" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-4">
                                        <label class="control-label">Stock</label>
                                        <input type="number" min="0" name="stock" class="form-control form-control-lg" value="{{$data->stock}}" placeholder="500" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-4">
                                        <label class="control-label">Minimum Order</label>
                                        <input type="number" min="0" name="minimum_order" class="form-control form-control-lg" value="{{$data->minimum_order}}" placeholder="1" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-4">
                                        <label class="control-label">Harga</label>
                                        <input type="text" name="selling_price" class="form-control form-control-lg price" id="priceutama" no="utama" value="{{$data->selling_price}}" placeholder="500" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-4">
                                        <label class="control-label">Diskon</label>
                                        <input type="number" min="0" name="discount" class="form-control form-control-lg" value="{{$data->discount}}" placeholder="500" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-4">
                                        <label class="control-label">Bisa Pre Order ??</label>
                                        <select class="form-control"  name="pre_order">
                                            <option value="1" <?php if ($data->pre_order == 1) {
                                                echo "selected";
                                            } ?>>Ya, Bisa Pre Order</option>
                                            <option value="0" <?php if ($data->pre_order == 0) {
                                                echo "selected";
                                            } ?>>Tidak Bisa</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-4">
                                        <label class="control-label">Wajib Asuransi ??</label>
                                        <select class="form-control"  name="assurance">
                                            <option value="1" <?php if ($data->is_optional_assurance == 1) {
                                                echo "selected";
                                            } ?>>Ya, Wajib Asuransi</option>
                                            <option value="0" <?php if ($data->is_must_assurance == 1) {
                                                echo "selected";
                                            } ?>>Asuransi Opsional</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="control-label">Kategori Produk</label>
                                        <select class="select2 form-control" required data-validation-required-message="Country Wajib diisi" name="id_category1" id="select_master" onchange="ChangeMaster()">
                                            <option value="">--Pilih--</option>
                                            @foreach($master_category as $v)
                                            @if($v->id == $data->id_category1)
                                            <option value="{{$v->id}}" selected>{{$v->master_name}}</option>
                                            @else
                                            <option value="{{$v->id}}">{{$v->master_name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="control-label">Sub Kategori Produk 1</label>
                                        <select class="select2 form-control" name="id_category2" id="select_sub" onchange="ChangeSub()">
                                            <option value="">--Pilih--</option>
                                            @foreach($sub_category1 as $v)
                                            @if($v->id == $data->id_category2)
                                            <option value="{{$v->id}}" selected>{{$v->sub_category_name}}</option>
                                            @else
                                            <option value="{{$v->id}}">{{$v->sub_category_name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="control-label">Sub Kategori Produk 2</label>
                                        <select class="select2 form-control" name="id_category3" id="select_sub_sub" onchange="ChangeSubSub()">
                                            <option value="">--Pilih--</option>
                                            @foreach($sub_category2 as $v)
                                            @if($v->id == $data->id_category3)
                                            <option value="{{$v->id}}" selected>{{$v->sub_sub_category_name}}</option>
                                            @else
                                            <option value="{{$v->id}}">{{$v->sub_sub_category_name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="control-label">Sub Kategori Produk 3</label>
                                        <select class="select2 form-control" name="id_category4" id="select_sub_4">
                                            <option value="">--Pilih--</option>
                                            @foreach($sub_category3 as $v)
                                            @if($v->id == $data->id_category4)
                                            <option value="{{$v->id}}" selected>{{$v->category_product_name}}</option>
                                            @else
                                            <option value="{{$v->id}}">{{$v->category_product_name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-4">
                                        <label class="control-label">Lokasi Gudang</label>
                                        <select class="form-control select2"  name="id_warehouse[]" multiple>
                                            @foreach($gudang_in as $gi)
                                            <option value="{{$gi->id}}" selected>{{$gi->name}}</option>
                                            @endforeach
                                            @foreach($gudang_all as $ga)
                                            <option value="{{$ga->id}}">{{$ga->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-4">
                                        <label class="control-label">Metode Pengiriman</label>
                                        <select class="form-control select2"  name="id_delivery[]" multiple>
                                            @foreach($delivery_in as $di)
                                            <option value="{{$di->id}}" selected>{{$di->name}}</option>
                                            @endforeach
                                            @foreach($delivery_all as $da)
                                            <option value="{{$da->id}}">{{$da->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @if($data->main_product = 1)
                                <div class="col-sm-6">
                                    <div class="mb-4">
                                        <label class="control-label">Nama variant Model</label>
                                        <input type="text" name="variant_model_name" class="form-control form-control-lg" value="{{$data->variant_model_name}}" placeholder="500" id="variant_model_name" required>
                                    </div>
                                </div>
                                @else
                                <div class="col-sm-6">
                                    <div class="mb-4">
                                        <label class="control-label">variant Model</label>
                                        <input type="text" name="variant_model" class="form-control form-control-lg" value="{{$data->variant_model}}" placeholder="500" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-4">
                                        <label class="control-label">variant Warna</label>
                                        <input type="text" name="variant_color" class="form-control form-control-lg" value="{{$data->variant_color}}" placeholder="500" required>
                                    </div>
                                </div>
                                @endif
                                <div class="col-sm-12 col-xs-12">
                                    <div class="mb-4">
                                        <label class="control-label">Deskripsi/Keterangan</label>
                                        <fieldset class="form-label-group mb-0">
                                            <textarea data-length="2000" class="form-control char-textarea active summernote" name="description" rows="3" placeholder="Deskripsi" style="color: rgb(78, 81, 84);">{{$data->description}}</textarea>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="col-sm-12 table-responsive">
                                    <label class="control-label mb-3"><b>Image Produk : </b></label>
                                    <div class="row" id="div_image">
                                        @if(count($data->image) > 0)
                                            @for($i=0;$i < count($data->image);$i++)
                                                <div class="col-sm-2 p-2 class_image" data-no="{{$i}}" id="class_image{{$i}}">
                                                    <div class="p-2 card card-stretch gutter-b text-center" style="border: 1px solid gainsboro;border-radius: 4px;">
                                                        <i class="fas fa-trash mb-2 text-danger" style="text-align: right;cursor: pointer;" onclick="DelImage('{{$i}}')"></i>
                                                        <img id="image{{$i}}" src="{{ $data->image[$i]['image_url'] }}" alt="your image" style="max-width: 150px;max-height: 150px;" />
                                                            <label class="btn btn-success btn-sm mb-0 w-100 align-self-center"><i class="fas fa-upload mr-3"></i>
                                                                Ganti Foto<input type="file" style="display: none;" onchange="ChangeImage(this,'{{$i}}');">
                                                            <input type="hidden" name="image[]" value="{{$data->image[$i]['image']}}" id="input_image{{$i}}">
                                                        </label>
                                                    </div>
                                                </div>

                                            @endfor
                                        @else
                                            <div class="col-sm-2 p-2 class_image" data-no="1">
                                                <img id="image1" src="{{URL::asset('assets')}}/imgs/items/1.jpg" alt="your image" style="max-width: 100px;max-height: 100px;" />
                                                    <label class="btn btn-success btn-sm mb-0 w-100 align-self-center"><i class="fas fa-upload mr-3"></i>
                                                        Ganti Foto<input type="file" style="display: none;" onchange="ChangeImage(this,'1');">
                                                    <input type="hidden" name="image[]" value="" id="input_image1">
                                                </label>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 mb-4">
                                    <button class="btn btn-md btn-block" style="width: 100%" type="button" onclick="AddImage()"><i class="fas fa-plus"></i> Tambah Gambar Baru</button>          
                                </div>
                                @if(isset($variant))
                                <div class="col-sm-12" id="div_variant">
                                    <label class="control-label mb-3"><b>Variant : </b></label>
                                    <?php $no = 0; ?>
                                    @foreach($variant as $v)
                                    <?php $no = $no + 1; ?>
                                        <div class="card-body mb-2 pb-0 div_variant" id="div_variant{{$v->id}}" data-no="{{$no}}" style="border: 1px solid gainsboro;border-radius: 4px;">
                                            <div class="row gx-3">
                                                <div class="col-md-5 mb-3">
                                                    <label for="product_title" class="form-label">Kode SKU</label>
                                                    <input type="hidden" name="i_id_variant[]" value="{{$v->id}}">
                                                    <input type="text" class="form-control" name="i_variant_sku[]" value="{{$v->sku_code}}" required>
                                                </div>
                                                <div class="col-md-5 mb-4">
                                                    <label for="product_brand" class="form-label">Price</label>
                                                    <input type="text" spellcheck="false" class="form-control price" id="price{{$v->id}}" no="{{$v->id}}" name="i_selling_price[]" value="{{$v->selling_price}}" required>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Aksi</label>
                                                    <button class="btn w-100 btn-sm btn-danger" type="button"  onclick="del_variant('{{$v->id}}')"><i class="fas fa-trash" style="cursor: pointer"></i> Hapus Variant</button>
                                                </div>
                                            </div>
                                            <div class="row gx-3">
                                                <div class="col-md-5 mb-3">
                                                    <label for="product_color" class="form-label">Color</label>
                                                    <input type="text" class="form-control" name="i_variant_color[]" value="{{$v->variant_color}}" required>
                                                </div>
                                                <div class="col-md-5 mb-3">
                                                    <label for="product_size" class="form-label">{{$data->variant_model_name}}</label>
                                                    <input type="text" class="form-control" name="i_variant_model[]" value="{{$v->variant_model}}" required>
                                                </div>
                                                <div class="col-md-2 mb-3">
                                                    <label for="product_sku" class="form-label">Stock</label>
                                                    <input type="text" class="form-control" name="i_stock[]" value="{{$v->stock}}" required>
                                                </div>
                                            </div>
                                            <div class="row gx-3">
                                                <div class="col-md-5 mb-4">
                                                    <label for="product_brand" class="form-label">Deskripsi</label>
                                                    <textarea class="form-control" name="i_description[]" required>{{$v->description}}</textarea>
                                                </div>
                                                <div class="col-md-7 mb-4 text-center">
                                                    @if(isset($v->image['image_url']))
                                                    <img id="icon_variant{{$no}}" src="{{$v->image['image_url']}}" alt="your image" style="max-width: 100px;max-height: 100px;" />
                                                    @else
                                                    <img id="icon_variant{{$no}}" src="{{URL::asset('assets')}}/imgs/items/1.jpg" alt="your image" style="max-width: 100px;max-height: 100px;" />
                                                    @endif
                                                    <label class="btn btn-success btn-sm mb-0 w-100 align-self-center"><i class="fas fa-upload mr-3"></i>
                                                        Ganti Foto<input type="file" style="display: none;" onchange="ChangeIconVariant(this,'{{$no}}');">
                                                    </label>
                                                    <input type="hidden" name="image_variant[]" value="{{$v->image['image']}}" id="input_image_variant{{$no}}">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @endif
                                <div class="col-sm-12">
                                    <button class="btn btn-md btn-block" style="width: 100%" type="button" onclick="AddVariant()"><i class="fas fa-plus"></i> Tambah Varian Baru</button>          
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-sm-12 col-xs-12">
                                    <button type="submit" class="btn btn-primary mr-2 float-right" id="save_edit">Simpan Perubahan</button>
                                    <button type="button" class="btn btn-primary mr-2 float-right" style="display: none;" id="loading_edit">Loading...</button>
                                    <a href="/product/list-produk">
                                    <button type="button" class="btn btn-info float-right" style="margin-right: 10px"><i class="material-icons md-keyboard_return"></i> Kembali ke Halaman Produk</button></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<!-- Modal Hapus Image-->
<div class="modal fade text-left" id="modal_delete_image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title-modal">Apakah Anda Yakin Menghapus Gambar ini</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" id="form_aksi">
                <div class="modal-body">
                    <span>Dengan menghapus gambar, maka gambar tidak akan lagi ditampilkan</span>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="btn_del_image">Iya, Hapus</button>
            </div>
        </div>
    </div>
</div>
<!-- -->
<!-- Modal Hapus Variant-->
<div class="modal fade text-left" id="modal_delete_variant" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title-modal">Apakah Anda Yakin Menghapus Variant Produk ini</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" id="form_aksi">
                <div class="modal-body">
                    <span>Dengan menghapus variant, maka variant tidak akan lagi ditampilkan</span>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="btn_del_variant">Iya, Hapus</button>
            </div>
        </div>
    </div>
</div>
<!-- -->
@include('components/componen_js')
@include('components/js/product/edit')
@endsection