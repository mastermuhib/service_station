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
<script src="{{URL::asset('assets')}}/js/ckeditor.js"></script>
<script>
    var config = {};
    config.placeholder = 'some value';
    CKEDITOR.replace('description', config);
</script>
<script type="text/javascript">
var column = [
        { "data": "no" },
        { "data": "tipe" },
        { "data": "official" },
        { "data": "banner" },
        { "data": "url" },
        { "data": "status" },
        { "data": "action" },
    ];

    function data_tabel(app) {
        if (app == 'data_banner') {
            var nantable = $('#data_tabel').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "/data_banner",
                    "dataType": "json",
                    "type": "POST",
                    "data": { _token: "{{csrf_token()}}" }
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
    data_tabel('data_banner')
});

function ChangeBanner(input) {
    //alert("okey");
    if (input.files && input.files[0]) {
        $("#banner").css('display', '');
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#banner')
                .attr('src', e.target.result)
                .css('width', '900px')
                .css('height', '400px')
        };

        reader.readAsDataURL(input.files[0]);
    }
}

$('#type').on("change", function() {
    type = $('#type').val();
    if (type == '0') {
        $(".internal").css('display','');
        $(".eksternal").css('display','none');
    } else {
        $(".internal").css('display','none');
        $(".eksternal").css('display','');
        $("#url").val('');
    }
    
});

function Official(){
    $("#id_detail").empty();
    $("#id_detail").empty().append("<option value=''>--Pilih--</option>");
    $("#type_internal").empty();
    $("#type_internal").empty().append("<option value=''>--Pilih--</option>");
    $("#type_internal").append('<option value="1">Produk</option><option value="2">Saudagar / Toko</option><option value="3">Promosi</option><option value="4">Notifikasi</option><option value="6">List produk by Keyword</option>');
}

function InternalType(){
    id = $("#type_internal").val();
    is_gerai = $("#is_gerai_official").val();
    if (id == '6') {
        $("#div_pilihan").html('<div class="mb-4"><label>Masukkan Keyword</label><input type="text" class="form-control" name="keyword" required></div>');
    } else {
        $("#div_pilihan").html('<div class="mb-4"><label>Detail Banner</label><select class="form-control select2" name="id_detail" id="id_detail" required></select></div>');
        $(".select2-container--default").css('width', '100%');
        $.ajax({
            type: 'GET',
            url: '/get_type_banner/'+id+'/'+is_gerai,
            dataType: 'json',
            success: function(data) {
                console.log(data)
                $("#id_detail").empty();
                $("#id_detail").empty().append("<option value=''>--Pilih--</option>");
                for (let i = 0; i < data.length; i++) {
                    $("#id_detail").append("<option value=" + data[i].id + ">" + data[i].name + "</option>");
                }
            },
            error: function(data) {
                console.log(data);
            }
        });
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
    var text = CKEDITOR.instances.description.getData();
    $("#isi_deskripsi").val(text);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({ //line 28
            type: 'POST',
            url: '/post_banner',
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
                    data_tabel('data_banner')
                } else {
                    alert("maaf ada yang salah!!!");
                }
            }
        });
    }
});
</script>