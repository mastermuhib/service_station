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
var columns = [{
        "data": null,
        "sortable": false,
        "orderable": false,
        "bFilter": false,
        "targets": 'no-sort',
        "bSort": false,
        render: function(data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
        }
    },
    { "data": "no_invoice" },
    { "data": "nominal" },
    { "data": "fee_admin" },
    { "data": "income_from_shop" },
    { "data": "income" },
    { "data": "customer" },
    { "data": "date" }
];

function data_tabel(tabel) {
    var tgl_start = $("#start").val();
    var tgl_end = $("#end").val();
    var search = $("#s_search").val();
    var sort = $("#sort").val();
    
    if (tabel == 'list_income_customer') {
        var xin_table = $('#data_tabel').DataTable({
            "processing": true,
            "serverSide": true,
            "orderable": false,
            "targets": 'no-sort',
            "bSort": false,
            "bFilter": false,
            "ajax": {
                "url": '/list_income_customer',
                "dataType": "json",
                "type": "POST",
                "data": { _token: "{{csrf_token()}}",tgl_start : tgl_start,tgl_end : tgl_end,search :search,sort:sort }
            },
            "columns": columns,
            "bDestroy": true
        });
        $("#data_tabel_length").remove();
    }
    
}

$(function() {
    //$('#myTable').DataTable();
    $(".select2-container--default").css('width', '100%');
    data_tabel('list_income_customer')
    Data('data_income_customer')
});
$("#s_search").keyup(function(){
   data_tabel('list_income_customer');
   Data('data_income_customer')
});

function Data(url){
    var tgl_start = $("#start").val();
    var tgl_end = $("#end").val();
    var search = $("#s_search").val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({ //line 28
        type: 'POST',
        url: '/'+url,
        dataType: 'html',
        data: { tgl_start : tgl_start,tgl_end : tgl_end,search :search },
        success: function(data) {  
            $("#div_grafik").html(data);
        }
    });
}

function ResetAll(){
    location.reload();
}
</script>