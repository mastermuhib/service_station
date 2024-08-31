<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/buttons.print.min.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
<script src="{{URL::asset('assets')}}/js/scripts/datatables/datatable.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/forms/select/select2.full.min.js"></script>
<script src="{{URL::asset('assets')}}/js/scripts/forms/select/form-select2.js"></script>
<script src="{{URL::asset('assets')}}/js/validate.js"></script>
<script src="{{URL::asset('assets')}}/js/additional-method.js"></script>
<script type="text/javascript">

function data_table(tabel) {
    var search = $("#search").val();
    var sort   = $("#sort").val();
    var status = $("#status").val();
    var start  = $("#start").val();

    //send data
    $("#body_shop").html('<div class="col-md-12"><div class="text-center mt-20 mb-20"><span class="text-success">Loading............</span></div></div>');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({ //line 28
        type: 'POST',
        url: '/get_data_shop',
        dataType: 'html',
        data: { search:search,sort:sort,status:status,start:start },
        success: function(data) {  
            $("#body_shop").html(data);
        }
    });   
}

function LoadMore(){
        //alert('end reached');  
    $("#loadmore").css('display','none'); 
    $("#loading_loadmore").css('display',''); 
    offset      = $("#is_offset").val();
    offset_now  = parseInt(offset) + 10;
    var search = $("#search").val();
    var sort   = $("#sort").val();
    var status = $("#status").val();
    var start  = $("#start").val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({ //line 28
        type: 'POST',
        url: '/shop/other',
        dataType: 'html',
        data: { offset:offset_now,search:search,sort:sort,status:status,start:offset_now },
        success: function(data) {  
            $("#body_shop").append(data);
            $("#is_offset").val(offset_now);
            //$("#loadmore").css('display',''); 
            $("#loading_loadmore").css('display','none');
            CekLoadMore();
        }
    });
}

function CekLoadMore(){
    
    offset      = $("#is_offset").val();
    var search = $("#search").val();
    var sort   = $("#sort").val();
    var status = $("#status").val();
    var start  = $("#start").val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({ //line 28
        type: 'POST',
        url: '/shop/cek_load_more',
        dataType: 'json',
        data: { offset:offset_now,search:search,sort:sort,status:status,start:offset },
        success: function(data) { 
            console.log(); 
            if (data.jumlah == '1') {
                $("#loadmore").css('display',''); 
            }
        }
    });
}
$(function() {
    // $('#yourTable').DataTable();
    $(".select2-container--default").css('width', '100%');
    data_table('data_shop')
});
</script>