<script src="{{URL::asset('assets')}}/vendors/js/forms/select/select2.full.min.js"></script>
<script src="{{URL::asset('assets')}}/js/scripts/forms/select/form-select2.js"></script>
<script src="{{URL::asset('assets')}}/js/validate.js"></script>
<script src="{{URL::asset('assets')}}/js/additional-method.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/buttons.print.min.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
<script src="{{URL::asset('assets')}}/js/scripts/datatables/datatable.js"></script>
<script type="text/javascript">

$(function() {
    $(".select2-container--default").css('width', '100%');
    data_table();
    reviewTable()
    discussTable()
});

var id_shop = $("#id_shop").val();

var column_review = [
    { "data": "no" },
    { "data": "product" },
    { "data": "user" },
    { "data": "rating" },
    { "data": "action" },
];

function reviewTable() {
    
    var nantable = $('#ulasan_table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "/data_product_review",
            "dataType": "json",
            "type": "POST",
            "data": { _token: "{{csrf_token()}}",id_shop:id_shop }
        },
        "columns": column_review,
        "bDestroy": true
    });
    // return nantable;
    console.log(nantable)
}

var column_discuss = [
    { "data": "no" },
    { "data": "product" },
    { "data": "shop" },
    { "data": "jumlah" },
    { "data": "jumlah_topick" },
    { "data": "action" },
];

function discussTable(app) {
    
    var nantable = $('#diskusi_table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "/data_product_discuss",
            "dataType": "json",
            "type": "POST",
            "data": { _token: "{{csrf_token()}}",id_shop:id_shop }
        },
        "columns": column_discuss,
        "bDestroy": true
    });
    // return nantable;
    console.log(nantable)
}

function data_table(tabel) {
    var search = $("#search").val();
    var sort   = $("#sort").val();
    var id_etalase = $("#id_etalase").val();
    var start  = $("#start").val();

    //send data
    $("#body_product").html('<div class="col-md-12"><div class="text-center mt-20 mb-20"><span class="text-success">Loading............</span></div></div>');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({ //line 28
        type: 'POST',
        url: '/get_data_product',
        dataType: 'html',
        data: { search:search,sort:sort,id_etalase:id_etalase,start:start,id_shop:id_shop },
        success: function(data) {  
            $("#body_product").html(data);
        }
    });   
}
function ChangeLevel(){
    $("#modal_level").modal('show');
}

function ChangeIconGerai(input) {
    //alert("okey");
    if (input.files && input.files[0]) {
        $("#icon_gerai").css('display', '');
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#icon_gerai')
            .attr('src', e.target.result)
            .css('width', '200px')
            .css('height', '200px')
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function SaveLevel(){
    level = $("#id_level").val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({ //line 28
        type: 'POST',
        url: '/set_level_shop',
        dataType: 'json',
        data: { level:level,id:id_shop },
        success: function(data) {  
            if (data.code == 200) {
                show_toast(data.message, 1);
                location.reload();
            } else {
                show_toast(data.message, 0);
            }
        }
    });   
}

function ActionShop(id){
    location.assign('/shop/toko/edit/'+id);
}

$("#form_add").validate({
    submitHandler: function(form) {
    $("#loading_add").css('display', '');
    $("#save_add").css('display', 'none');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({ //line 28
            type: 'POST',
            url: '/update_shop',
            dataType: 'json',
            data: new FormData($("#form_add")[0]),
            processData: false,
            contentType: false,
            success: function(data) {  
                $("#loading_add").css('display', 'none');
                $("#save_add").css('display', '');  
                if (data.code == 200) {
                    show_toast(data.message, 1);
                } else {
                    show_toast(data.message, 0);
                }
            }
        });
    }
});

function province_change(id) {
    // alert(country_id)
    prov_id = $("#select_province"+id).val();
    $.ajax({
        type: 'GET',
        url: '/get_address/cities/province_id/' + prov_id,
        dataType: 'json',
        success: function(data) {
            console.log(data)
            $("#select_city"+id).empty();
            $("#select_city"+id).append("<option value=''>Pilih Kota</option>");
            for (let i = 0; i < data.length; i++) {
                $("#select_city"+id).append("<option value=" + data[i].id + ">" + data[i].name + "</option>");
            }
        },
        error: function(data) {
            console.log(data);
        }
    });
}

function city_change(id) {
    // alert(country_id)
    city_id = $("#select_city"+id).val();
    $.ajax({
        type: 'GET',
        url: '/get_address/districts/regency_id/'+city_id,
        dataType: 'json',
        success: function(data) {
            console.log(data)
            $("#select_district"+id).empty();
            $("#select_village"+id).empty().append("<option value=''>Pilih Desa</option>");
            $("#select_district"+id).append("<option value=''>Pilih Kecamatan</option>");
            for (let i = 0; i < data.length; i++) {
                $("#select_district"+id).append("<option value=" + data[i].id + ">" + data[i].name + "</option>");
            }
        },
        error: function(data) {
            console.log(data);
        }
    });
}

function district_change(id) {
    // alert(country_id)
    dis_id = $("#select_district"+id).val();
    $.ajax({
        type: 'GET',
        url: '/get_address/villages/district_id/'+dis_id,
        dataType: 'json',
        success: function(data) {
            console.log(data)
            $("#select_village"+id).empty();
            $("#select_village"+id).append("<option value=''>Pilih Desa</option>");
            for (let i = 0; i < data.length; i++) {
                $("#select_village"+id).append("<option value=" + data[i].id + ">" + data[i].name + "</option>");
            }
        },
        error: function(data) {
            console.log(data);
        }
    });
}

function ChangeData(id){
    $(".nav-link").removeClass('active');
    $("#nav_"+id).addClass('active');
    $("#section_body").html('<div class="col-md-12"><div class="text-center mt-20 mb-20"><span class="text-success">Loading............</span></div></div>');
    $.ajax({ //line 28
        type: 'GET',
        url: '/get_data_shop/'+id_shop+'/'+id,
        dataType: 'html',
        success: function(data) {  
            $("#section_body").html(data);
            
        }
    });   
}
</script>