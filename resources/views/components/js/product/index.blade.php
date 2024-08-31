<script src="{{URL::asset('assets')}}/vendors/js/forms/select/select2.full.min.js"></script>
<script src="{{URL::asset('assets')}}/js/scripts/forms/select/form-select2.js"></script>
<script src="{{URL::asset('assets')}}/js/validate.js"></script>
<script src="{{URL::asset('assets')}}/js/additional-method.js"></script>
<script type="text/javascript">

$(function() {
    $(".select2-container--default").css('width', '100%');
    data_table();
});

function data_table(tabel) {
    $("#start").val(0);
    var search = $("#search").val();
    var sort   = $("#sort").val();
    var id_category1 = $("#select_master").val();
    var id_category2 = $("#select_sub").val();
    var id_category3 = $("#select_sub_sub").val();
    var id_category4 = $("#select_sub_4").val();
    var id_shop = $("#id_shop").val();
    var start  = $("#start").val();
    var id_city = $("#id_city").val();

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
        data: { search:search,sort:sort,id_category1:id_category1,id_category2:id_category2,id_category3:id_category3,id_category4:id_category4,start:start,id_shop:id_shop,id_city:id_city },
        success: function(data) {  
            $("#body_product").html(data);
            CekLoadMore()
        }
    });   
}

function Next(){
    now = $("#start").val();
    start = parseInt(now) + 8;
    $("#btn-next").css('display','none');
    var search = $("#search").val();
    var sort   = $("#sort").val();
    var id_category = $("#id_category").val();
    var id_shop = $("#id_shop").val();
    var id_city = $("#id_city").val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({ //line 28
        type: 'POST',
        url: '/get_data_product',
        dataType: 'html',
        data: { search:search,sort:sort,id_category:id_category,start:start,id_shop:id_shop,id_city:id_city },
        success: function(data) {  
            $("#body_product").append(data);
            $("#start").val(start);
            CekLoadMore()
        }
    });   
}

function CekLoadMore(){
    start = $("#start").val();
    var search = $("#search").val();
    var sort   = $("#sort").val();
    var id_category = $("#id_category").val();
    var id_shop = $("#id_shop").val();
    var id_city = $("#id_city").val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({ //line 28
        type: 'POST',
        url: '/cek_load_more_product',
        data: { search:search,sort:sort,id_category:id_category,start:start,id_shop:id_shop,id_city:id_city },
        success: function(data) { 
            console.log(data.jumlah) 
            //if (data.jumlah > 0) {
                $("#btn-next").css('display','');
            // } else {
            //     $("#btn-next").css('display','none');
            // }

        }
    });   
}

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
            data_table('data_products')
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
            data_table('data_products')
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
            data_table('data_products');
        },
        error: function(data) {
            console.log(data);
        }
    });
}
</script>