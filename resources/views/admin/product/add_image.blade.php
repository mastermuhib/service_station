<div class="col-sm-2 p-2 class_image" data-no="{{$no}}" id="class_image{{$no}}">
    <div class="p-2 card card-stretch gutter-b text-center" style="border: 1px solid gainsboro;border-radius: 4px;">
        <i class="fas fa-trash mb-2 text-danger" style="text-align: right;cursor: pointer;" onclick="DelImage('{{$no}}')"></i>
        <img id="image{{$no}}" src="{{URL::asset('assets')}}/imgs/items/1.jpg" alt="your image" style="max-width: 150px;max-height: 150px;">
            <label class="btn btn-success btn-sm mb-0 w-100 align-self-center"><i class="fas fa-upload mr-3"></i>
                Ganti Foto<input type="file" style="display: none;" onchange="ChangeImage(this,'{{$no}}');">
            <input type="hidden" name="image[]" value="" id="input_image{{$no}}">
        </label>
    </div>
</div>