<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/buttons.print.min.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
<script src="{{URL::asset('assets')}}/js/scripts/datatables/datatable.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/forms/select/select2.full.min.js"></script>
<script src="{{URL::asset('assets')}}/js/scripts/forms/select/form-select2.js"></script>
<script src="{{URL::asset('assets')}}/js/ckeditor.js"></script>
<script src="{{URL::asset('assets')}}/js/validate.js"></script>
<script src="{{URL::asset('assets')}}/js/additional-method.js"></script>
<script type="text/javascript">
var column = [
        { "data": "no" },
        { "data": "name" },
        { "data": "province" },
        { "data": "country" },
        { "data": "id_shiper" },
        { "data": "status" },
        { "data": "action" },
    ];

    function data_tabel(tabel) {
        var nantable = $('#yourTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "/"+tabel,
                "dataType": "json",
                "type": "POST",
                "data": { _token: "{{csrf_token()}}" }
            },
            "columns": column,
            "bDestroy": true
        });
        return nantable;
    }
 $(function() {
    //$('#yourTable').DataTable();
    $(".select2-container--default").css('width', '100%');
    data_tabel('data_master_city')
});


$(function(){ /* DOM ready */
    $(".country").on("change", function() {
        var country_id = this.value;
        country_change(country_id);
    });
});

function country_change() {
    // alert(country_id)
    country_id = $("#select_country").val();
    $.ajax({
        type: 'GET',
        url: '/get_address/provinces/country_id/'+country_id,
        dataType: 'json',
        success: function(data) {
            console.log(data)
            $("#select_province").empty();
            $("#select_province").append("<option value=''>Pilih Provinsi</option>");
            for (let i = 0; i < data.length; i++) {
                $("#select_province").append("<option value=" + data[i].id + ">" + data[i].name + "</option>");
            }
        },
        error: function(data) {
            console.log(data);
        }
    });
}

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
       // var description = CKEDITOR.instances.description.getData();
        // var id_country = $("#country").val();
        var id_province = $("#province").val();
        if (id_province == '') {
            // alert('Provinsi wajib diisi')
        } else {
           // $("#isi_deskripsi").val(description);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({ //line 28
                type: 'POST',
                url: '/post_master_city',
                dataType: 'json',
                data: new FormData($("#form_add")[0]),
                processData: false,
                contentType: false,
                success: function(data) {                
                    if (data.code == 200) {
                        
                        document.getElementById("form_add").reset();
                        $("#hide_add").css('display', '');
                        $("#show_add").css('display', 'none');
                        $(".toast-body").empty();
                        show_toast(data.message, 1);

                        data_table('data_master_city')
                    } else {
                        alert("maaf ada yang salah!!!");
                    }
                    // CKEDITOR.instances.description.setData(''); // ckeditor reset
                }
            });
        }
    }
});
$(document).off('click', '#kirim_edit').on('click', '#kirim_edit', function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // var description = CKEDITOR.instances.edit_description.getData();
    // $("#isi_deskripsi2").val(description);
    $.ajax({ //line 28
        type: 'POST',
        url: '/update/master_city',
        dataType: 'json',
        data: new FormData($("#form_edit")[0]),
        processData: false,
        contentType: false,
        success: function(data) {
            //$("#modal_loading").modal('hide');
            //$(".modal-backdrop").remove();
            $(".edit-modal-data").modal('hide');
            if (data.code == 200) {
                document.getElementById("form_edit").reset();
                $("#message").remove();
                show_toast(data.message, 1);

                $("#titel_head").remove();
                $("#head_modul").append('<span id="titel_head">Add City</span>');
                $("#hide_add").css('display', '');
                $("#show_edit").css('display', 'none');
                //alert("okey");
                var nantable = $('#yourTable').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "/data_master_city",
                        "dataType": "json",
                        "type": "POST",
                        "data": { _token: "{{csrf_token()}}" }
                    },
                    "columns": column,
                    "bDestroy": true
                });
                nantable.ajax.reload();
            }
        }
    });
});

$(document).off('click', '.edit_data').on('click', '.edit_data', function() {
    var id = $(this).attr('id');

    $("#detail_edit").remove();
    //alert("sini kan")
    $("#hide_add").css('display', 'none');
    $("#show_add").css('display', 'none');
    $("#titel_head").remove();
    $("#head_modul").append('<span id="titel_head">Edit Data City</span>');
    $.ajax({
        url: '/detail/master_city/' + id,
        type: "GET",
        success: function(response) {
            // console.log(response);
            $(window).scrollTop(0);

            if (response) {
                $("#show_edit").html(response);
                $("#show_edit").css('display', '');
            }
            $('.select2').select2();
            $(".select2-container--default").css('width', '100%');
        }
    });
});
// batalkan edit
$(document).off('click', '#batalkan3').on('click', '#batalkan3', function() {

    $("#titel_head").remove();
    $("#head_modul").append('<span id="titel_head">Tambah Data City</span>');
    $("#hide_add").css('display', '');
    $("#show_edit").css('display', 'none');
});

function GenerateShiper(id){
    $("#GenerateShiper_"+id).attr('disabled','disabled');
    $("#GenerateShiper_"+id).html('loading.....');
    $.ajax({
    url: '/district_shiper/'+id,
    type: "GET",
    success: function(data) {
        show_toast(data.message, 1);
        data_tabel('data_master_city');
        }
    }); 
}

</script>