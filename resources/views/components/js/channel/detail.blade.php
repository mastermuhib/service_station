<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/buttons.print.min.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
<script src="{{URL::asset('assets')}}/js/scripts/datatables/datatable.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/forms/select/select2.full.min.js"></script>
<script src="{{URL::asset('assets')}}/js/scripts/forms/select/form-select2.js"></script>

<script type="text/javascript">
var column = [
        { "data": "no" },
        { "data": "shop" },
        { "data": "start" },
        { "data": "end" },
        { "data": "action" },
    ];

    function data_tabel(app) {
        id_channel = $("#id_channel").val();
        if (app == 'data_list_join_channel') {
            var nantable = $('#data_tabel').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "/data_list_join_channel",
                    "dataType": "json",
                    "type": "POST",
                    "data": { _token: "{{csrf_token()}}",id_channel:id_channel }
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
    data_tabel('data_list_join_channel')
});

</script>