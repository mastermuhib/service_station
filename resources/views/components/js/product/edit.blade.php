<script src="{{URL::asset('assets')}}/vendors/js/forms/select/select2.full.min.js"></script>
<script src="{{URL::asset('assets')}}/js/scripts/forms/select/form-select2.js"></script>
<script src="{{URL::asset('assets')}}/js/validate.js"></script>
<script src="{{URL::asset('assets')}}/js/additional-method.js"></script>
<script type="text/javascript">

$(function() {
    $(".select2-container--default").css('width', '100%');
});

function ChangeImage(input,id) {
    //alert("okey");
    if (input.files && input.files[0]) {
        $("#image"+id).css('display', '');
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#image'+id)
                .attr('src', e.target.result)
                .css('width', '200px')
                .css('height', '200px')
        };

        reader.readAsDataURL(input.files[0]);
        image = UploadS3Image(input.files[0],'image'+id);
    }
}

function ChangeIconVariant(input,id) {
    //alert("okey");
    if (input.files && input.files[0]) {
        $("#icon_variant"+id).css('display', '');
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#icon_variant'+id)
                .attr('src', e.target.result)
                .css('width', '200px')
                .css('height', '200px')
        };

        reader.readAsDataURL(input.files[0]);
        image = UploadS3Image(input.files[0],'image_variant'+id);
        $("#input_image_variant"+id).val(image);
    }
}

function UploadS3Image(input,id){
    $("#loading_edit").css('display', '');
    $("#save_edit").css('display', 'none');
    var formData = new FormData()
    formData.append('source', input)
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({ //line 28
        type: 'POST',
        url: '/upload_image',
        dataType: 'json',
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {  
            $("#input_"+id).val(data);
            $("#loading_edit").css('display', 'none');
            $("#save_edit").css('display', '');
        }
    });
}

$("#form_edit").validate({
    submitHandler: function(form) {
    $("#loading_edit").css('display', '');
    $("#save_edit").css('display', 'none');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({ //line 28
            type: 'POST',
            url: '/update/product',
            dataType: 'json',
            data: new FormData($("#form_edit")[0]),
            processData: false,
            contentType: false,
            success: function(data) {  
                $("#loading_edit").css('display', 'none');
                $("#save_edit").css('display', '');

                if (data.code == 200) {
                    show_toast(data.message, 1);
                } else {
                    alert("maaf ada yang salah!!!");
                }
            }
        });
    }
});

$(document).off('keyup', '.price').on('keyup', '.price', function() {
    no = $(this).attr('no');
    var nominal_x = document.getElementById('price'+no);
    //nominal_x.addEventListener('keyup', function(e) {
    nominal_x.value = formatRupiah(this.value, '');
    // nominal_asli = formatClear(this.value, '');
    // $("#nominal_budget"+no).val(nominal_asli);
    // var sum = 0;
    // $('.nominal_budget').each(function(){
    //     sum += parseFloat(this.value);
    // });
    
    // $("#budget").val(sum);
    // //console.log(nominal_asli);
    // //});
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

function AddImage(){
    max = 0;
    $('.class_image').each(function(){
        var value = parseInt($(this).data('no'));
        max = (value > max) ? value : max;
    });

    var id = parseInt(max)+1;

    $.ajax({
        url: '/add_image_product/'+id,
        type: "GET",
        success: function(response) {
            console.log(response);
            if (response) {
                $("#div_image").append(response);
            }
        }
    });

}

function AddVariant(){

    max = 0;
    $('.div_variant').each(function(){
        var value = parseInt($(this).data('no'));
        max = (value > max) ? value : max;
    });

    var id = parseInt(max)+1;
    var model = $("#variant_model_name").val();

    $.ajax({
        url: '/add_variant_product/'+id+'/'+model,
        type: "GET",
        success: function(response) {
            console.log(response);
            if (response) {
                $("#div_variant").append(response);
            }
        }
    });

}

function DelImage(id){
    val = $("#input_image"+id).val();
    $("#btn_del_image").attr('no',id);
    $("#btn_del_image").attr('val',val);
    $("#modal_delete_image").modal('show');
}

function del_variant(id){
    $("#btn_del_variant").attr('no',id);
    $("#modal_delete_variant").modal('show');
}

function del_variant_tambahan(id){
    $("#div_variant"+no).remove();
}

$(document).off('click', '#btn_del_image').on('click', '#btn_del_image', function() {
    no  = $(this).attr('no');
    val = $(this).attr('val');
    //alert(val);
    $("#class_image"+no).remove();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({ //line 28
        type: 'POST',
        url: '/delete_image_product',
        dataType: 'json',
        data: { val : val },
        success: function(data) {  
            show_toast(data.message, 1);
        }
    });
    
});

$(document).off('click', '#btn_del_variant').on('click', '#btn_del_variant', function() {
    no  = $(this).attr('no');
    
    $("#div_variant"+no).remove();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({ //line 28
        type: 'POST',
        url: '/delete_variant_product',
        dataType: 'json',
        data: { val : no },
        success: function(data) {  
            show_toast(data.message, 1);
        }
    });
    
});

function ChangeMaster() {
    // alert(country_id)
    id = $("#select_master").val();
    $.ajax({
        type: 'GET',
        url: '/get_master_category/'+id,
        dataType: 'json',
        success: function(data) {
            console.log(data)
            $("#select_sub").empty();
            $("#select_sub").append("<option value=''>Pilih Sub Kategori 1</option>");
            $("#select_sub_sub").empty();
            $("#select_sub_sub").append("<option value=''>Pilih Sub Kategori 2</option>");
            $("#select_sub_4").empty();
            $("#select_sub_4").append("<option value=''>Pilih Sub Kategori 3</option>");
            for (let i = 0; i < data.length; i++) {
                $("#select_sub").append("<option value=" + data[i].id + ">" + data[i].name + "</option>");
            }
        },
        error: function(data) {
            console.log(data);
        }
    });
}

function ChangeSub() {
    // alert(country_id)
    id = $("#select_sub").val();
    $.ajax({
        type: 'GET',
        url: '/get_sub_category/'+id,
        dataType: 'json',
        success: function(data) {
            console.log(data)
            $("#select_sub_sub").empty();
            $("#select_sub_sub").append("<option value=''>Pilih Sub Kategori 2</option>");
            $("#select_sub_4").empty();
            $("#select_sub_4").append("<option value=''>Pilih Sub Kategori 3</option>");
            for (let i = 0; i < data.length; i++) {
                $("#select_sub_sub").append("<option value=" + data[i].id + ">" + data[i].name + "</option>");
            }
        },
        error: function(data) {
            console.log(data);
        }
    });
}

function ChangeSubSub() {
    // alert(country_id)
    id = $("#select_sub").val();
    $.ajax({
        type: 'GET',
        url: '/get_sub_category2/'+id,
        dataType: 'json',
        success: function(data) {
            console.log(data)
            $("#select_sub_4").empty();
            $("#select_sub_4").append("<option value=''>Pilih Sub Kategori 3</option>");
            for (let i = 0; i < data.length; i++) {
                $("#select_sub_4").append("<option value=" + data[i].id + ">" + data[i].name + "</option>");
            }
        },
        error: function(data) {
            console.log(data);
        }
    });
}
</script>