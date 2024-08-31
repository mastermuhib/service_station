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
        { "data": "name" },
        { "data": "url" },
        { "data": "icon" },
        { "data": "jumlah" },
        { "data": "status" },
        { "data": "action" },
    ];

function data_tabel(tabel) {
    var search = $("#s_search").val();
    var sort = $("#sort").val();
    
    if (tabel == 'data_product_ppob') {
        var xin_table = $('#data_tabel').DataTable({
            "processing": true,
            "serverSide": true,
            "orderable": false,
            "targets": 'no-sort',
            "bSort": false,
            "bFilter": true,
            "ajax": {
                "url": '/data_product_ppob',
                "dataType": "json",
                "type": "POST",
                "data": { _token: "{{csrf_token()}}",search :search,sort:sort}
            },
            "columns": column,
            "bDestroy": true
        });
        //$("#data_tabel_length").remove();
    }
    
}
$(function() {
    // $('#yourTable').DataTable();
    $(".select2-container--default").css('width', '100%');
    data_tabel('data_product_ppob')
});

function ChangeIcon(input) {
    //alert("okey");
    if (input.files && input.files[0]) {
        $("#icon").css('display', '');
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#icon')
                .attr('src', e.target.result)
                .css('width', '200px')
                .css('height', '200px')
        };

        reader.readAsDataURL(input.files[0]);
    }
}

$('#id_detail').on("change", function() {
   text = $("#id_detail option:selected").text();
   $("#url").val(text);
});


$('#tambah').on("click", function() {
    // alert('tes')
    $("#hide_add").css('display', 'none');
    $("#show_add").css('display', '');
});
$('#batalkan').on("click", function() {
    $("#hide_add").css('display', '');
    $("#show_add").css('display', 'none');
});
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
            url: '/post_product_ppob',
            dataType: 'json',
            data: new FormData($("#form_add")[0]),
            processData: false,
            contentType: false,
            success: function(data) {  
                $("#loading_add").css('display', 'none');
                $("#save_add").css('display', '');  
                if (data.code == 200) {

                    document.getElementById("form_add").reset();
                    $("#hide_add").css('display', '');
                    $("#show_add").css('display', 'none');
                    
                    show_toast(data.message, 1);
                    data_tabel('data_product_ppob')
                } else {
                    alert("maaf ada yang salah!!!");
                }
            }
        });
    }
});

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
            url: '/update/product_ppob',
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
</script>