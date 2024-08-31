<script src="{{URL::asset('assets')}}/vendors/js/forms/select/select2.full.min.js"></script>
<script src="{{URL::asset('assets')}}/js/scripts/forms/select/form-select2.js"></script>
<script src="{{URL::asset('assets')}}/js/validate.js"></script>
<script src="{{URL::asset('assets')}}/js/additional-method.js"></script>
<script type="text/javascript">

$(function() {
    $(".select2-container--default").css('width', '100%');
    data_table('data_service');
});

function data_table(tabel) {
    $("#start").val(0);
    var search = $("#search").val();
    var sort   = $("#sort").val();
    // var id_skill = $("#id_skill").val();
    // var id_sub_skill = $("#id_sub_skill").val();
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
        url: '/get_data_service',
        dataType: 'html',
        data: { search:search,sort:sort,start:start },
        success: function(data) {  
            $("#body_product").html(data);
            CekLoadMore();
        }
    });   
}
//btn-next
function Next(){
    now = $("#start").val();
    start = parseInt(now) + 8;
    var search = $("#search").val();
    var sort   = $("#sort").val();
    // var id_skill = $("#id_skill").val();
    // var id_sub_skill = $("#id_sub_skill").val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({ //line 28
        type: 'POST',
        url: '/get_data_service',
        dataType: 'html',
        data: { search:search,sort:sort,start:start },
        success: function(data) {  
            $("#body_product").append(data);
            CekLoadMore();
            $("#start").val(start);
            
        }
    });   
}

//cek load more
function CekLoadMore(){
    start = $("#start").val();
    var search = $("#search").val();
    var sort   = $("#sort").val();
    // var id_skill = $("#id_skill").val();
    // var id_sub_skill = $("#id_sub_skill").val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({ //line 28
        type: 'POST',
        url: '/load_more_data_service',
        data: { search:search,sort:sort,start:start },
        success: function(data) {  
            if (data.jumlah > 0) {
                $("#btn-next").css('display','');
            } else {
                $("#btn-next").css('display','none');
            }
        }
    });   
}

function ChangeMaster() {
    // alert(country_id)
    id = $("#id_skill").val();
    $.ajax({
        type: 'GET',
        url: '/get_sub_skill/'+id,
        dataType: 'json',
        success: function(data) {
            console.log(data)
            $("#id_sub_skill").empty();
            $("#id_sub_skill").append("<option value=''>Pilih Sub Skill</option>");
            for (let i = 0; i < data.length; i++) {
                $("#id_sub_skill").append("<option value=" + data[i].id + ">" + data[i].title + "</option>");
            }
            data_table('data_service')
        },
        error: function(data) {
            console.log(data);
        }
    });
}

</script>