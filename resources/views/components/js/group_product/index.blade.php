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
        { "data": "jumlah" },
        { "data": "icon" },
        { "data": "end" },
        { "data": "status" },
        { "data": "action" },
    ];

function data_tabel(tabel) {
    var search = $("#s_search").val();
    var sort = $("#sort").val();
    
    if (tabel == 'data_group_product') {
        var xin_table = $('#data_tabel').DataTable({
            "processing": true,
            "serverSide": true,
            "orderable": false,
            "targets": 'no-sort',
            "bSort": false,
            "bFilter": false,
            "ajax": {
                "url": '/data_group_product',
                "dataType": "json",
                "type": "POST",
                "data": { _token: "{{csrf_token()}}",search :search,sort:sort}
            },
            "columns": column,
            "bDestroy": true
        });
        $("#data_tabel_length").remove();
    }
    
}
$(function() {
    // $('#yourTable').DataTable();
    $(".select2-container--default").css('width', '100%');
    data_tabel('data_group_product')
});

function Official(){
    $("#div_product").html('');
    $("#div_hasil").html('');
}

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

function ChangeImage(input) {
    //alert("okey");
    if (input.files && input.files[0]) {
        $("#image").css('display', '');
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#image')
                .attr('src', e.target.result)
                .css('width', '200px')
                .css('height', '200px')
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function ChangeBackground(input) {
    //alert("okey");
    if (input.files && input.files[0]) {
        $("#background").css('display', '');
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#background')
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
            url: '/post_group_product',
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
                    data_tabel('data_group_product')
                } else {
                    alert("maaf ada yang salah!!!");
                }
            }
        });
    }
});

$("#search_name").keyup(function(){
   text = $("#search_name").val();
   is_gerai = $("#is_gerai_official").val();
    if ( text.length > 2 ){
        $("#div_product").html('');
        $("#loading_searching").css('display','');
        $.ajax({
            url: '/search_product/'+text+'/'+is_gerai,
            type: "GET",
            success: function(response) {
                console.log(response);
                if (response) {
                    $("#div_product").html(response);
                    $("#loading_searching").css('display','none');
                }
            }
        });
    }
});

$(document).off('click', '.click_product').on('click', '.click_product', function() { 
    id           = $(this).attr('no');
    $('#click_product'+id).clone().appendTo('#div_hasil');
    $('#div_product #click_product'+id).remove();
    $("#action"+id).append('<div class="info text-center"><a href="javascript:void(0)" class="btn btn-sm font-sm btn-light rounded delete_item" no="'+id+'"> <i class="material-icons md-delete_forever"></i> Delete </a><input type="hidden" name="product[]" value="'+id+'"></div>')
});

$(document).off('click', '.delete_item').on('click', '.delete_item', function() { 
    id = $(this).attr('no');
    $('#div_hasil #click_product'+id).remove();
});
</script>