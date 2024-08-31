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
var column = [
        { "data": "no" },
        { "data": "product" },
        { "data": "user" },
        { "data": "rating" },
        { "data": "action" },
    ];

    function data_tabel(app) {
        type = $("#user_type").val();
        if (app == 'data_product_review') {
            var nantable = $('#data_tabel').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "/data_product_review",
                    "dataType": "json",
                    "type": "POST",
                    "data": { _token: "{{csrf_token()}}",type:type }
                },
                "columns": column,
                "bDestroy": true
            });
            // return nantable;
            console.log(nantable)
        }
    }
$(function() {
    // $('#yourTable').DataTable();
    $(".select2-container--default").css('width', '100%');
    data_tabel('data_product_review')
});


</script>