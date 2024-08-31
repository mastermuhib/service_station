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
    { "data": "user" },
    { "data": "shop" },
    { "data": "status" },
    { "data": "date" },
    { "data": "actions" }
];

function data_tabel(tabel) {
    var tgl_start = $("#start").val();
    var tgl_end = $("#end").val();
    var status = $("#status_service").val();
    var search = $("#s_search").val();
    var sort = $("#sort").val();
    
    if (tabel == 'data_transaksi_service') {
        var xin_table = $('#data_tabel').DataTable({
            "processing": true,
            "serverSide": true,
            "orderable": false,
            "targets": 'no-sort',
            "bSort": false,
            "bFilter": false,
            "ajax": {
                "url": '/data_transaksi_service',
                "dataType": "json",
                "type": "POST",
                "data": { _token: "{{csrf_token()}}",tgl_start : tgl_start,tgl_end : tgl_end,status : status,search :search,sort:sort }
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
    data_tabel('data_transaksi_service')
});
$("#s_search").keyup(function(){
   data_tabel('data_transaksi_service');
});


$('.select2').on('change', function() { // when the value changes
    $(this).valid(); // trigger validation on this element
});

$('#tambah').on("click", function() {
    // alert('tes')
    $(window).scrollTop(0);
    $("#show_add").css('display', '');
});
$('#batalkan').on("click", function() {
    $("#show_add").css('display', 'none');
});



$(document).off('click','#download_excel').on('click','#download_excel', function(){
    var serial = $("#form_filter").serialize();
    window.open("/download_excel/"+serial, '_blank');
});

function ResetAll(){
    location.reload();
}
</script>