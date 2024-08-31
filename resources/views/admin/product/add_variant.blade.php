<div class="card-body mb-2 pb-0 div_variant" id="div_variant{{$no}}" data-no="{{$no}}" style="border: 1px solid gainsboro;border-radius: 4px;">
    <div class="row gx-3">
        <div class="col-md-5 mb-3">
            <label for="product_title" class="form-label">Kode SKU</label>
            <input type="hidden" name="i_id_variant[]" value="">
            <input type="text" class="form-control" name="i_variant_sku[]" value="{{$sku_code}}" required>
        </div>
        <div class="col-md-5 mb-4">
            <label for="product_brand" class="form-label">Price</label>
            <input type="text" spellcheck="false" class="form-control price" id="price{{$no}}" no="{{$no}}" name="i_selling_price[]" value="" required>
        </div>
        <div class="col-md-2">
            <label class="form-label">Aksi</label>
            <button class="btn w-100 btn-sm btn-danger" type="button" onclick="del_variant_tambahan('{{$no}}')"><i class="fas fa-trash"></i> Hapus Variant</button>
        </div>
    </div>
    <div class="row gx-3">
        <div class="col-md-5 mb-3">
            <label for="product_color" class="form-label">Color</label>
            <input type="text" class="form-control" name="i_variant_color[]" value="" required>
        </div>
        <div class="col-md-5 mb-3">
            <label for="product_size" class="form-label">{{$variant_model_name}}</label>
            <input type="text" class="form-control" name="i_variant_model[]" value="" required>
        </div>
        <div class="col-md-2 mb-3">
            <label for="product_sku" class="form-label">Stock</label>
            <input type="text" class="form-control" name="i_stock[]" value="" required>
        </div>
    </div>
    <div class="row gx-3">
        <div class="col-md-5 mb-4">
            <label for="product_brand" class="form-label">Deskripsi</label>
            <textarea class="form-control" name="i_description[]" required></textarea>
        </div>
        <div class="col-md-7 mb-4 text-center">
            <img id="icon_variant{{$no}}" src="{{URL::asset('assets')}}/imgs/items/1.jpg" alt="your image" style="max-width: 100px;max-height: 100px;" />
            <label class="btn btn-success btn-sm mb-0 w-100 align-self-center"><i class="fas fa-upload mr-3"></i>
                Ganti Foto<input type="file" style="display: none;" onchange="ChangeIconVariant(this,'{{$no}}');">
            </label>
            <input type="hidden" name="image_variant[]" value="" id="input_image_variant{{$no}}">
        </div>
    </div>
</div>