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
    var type = $("#type").val();
    //send data
    $("#body_shop").html('<div class="col-md-12"><div class="text-center mt-20 mb-20"><span class="text-success">Loading............</span></div></div>');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({ //line 28
        type: 'POST',
        url: '/get_data_featured_shop',
        dataType: 'html',
        data: { type:type },
        success: function(data) {  
            $("#body_shop").html(data);
        }
    });   
}
$(function() {
    // $('#yourTable').DataTable();
    $(".select2-container--default").css('width', '100%');
    data_table('data_shop')
});

$("#form_add").validate({
    submitHandler: function(form) {
    $("#btn_loading").css('display', '');
    $("#btn_submit").css('display', 'none');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({ //line 28
            type: 'POST',
            url: '/post_featured_shop',
            dataType: 'json',
            data: new FormData($("#form_add")[0]),
            processData: false,
            contentType: false,
            success: function(data) {  
                $("#btn_loading").css('display', 'none');
                $("#btn_submit").css('display', ''); 
                if (data.code == 200) {
                    show_toast(data.message, 1);
                    location.reload();
                } else {
                    show_toast(data.message, 0);
                }
                //location.reload();
            }
        });
    }
});

function deleteItem(id){
    $("#modal_delete").modal('show');
    $("#btn-delete").attr('no',id);
}

$(document).off('click', '#btn-delete').on('click', '#btn-delete', function() {
    id = $(this).attr('no');
    var type = $("#type").val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({ //line 28
        type: 'POST',
        url: '/delete_featured_shop',
        dataType: 'json',
        data: { type:type,id:id },
        success: function(data) {  
            if (data.code == 200) {
                show_toast(data.message, 1);
                location.reload();
            } else {
                show_toast(data.message, 0);
            }
        }
    });   
});
</script>