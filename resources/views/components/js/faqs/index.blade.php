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
        { "data": "category" },
        { "data": "question" },
        { "data": "answer" },
        { "data": "viewer" },
        { "data": "status" },
        { "data": "action" },
    ];

    function data_tabel(app) {
        if (app == 'data_faqs') {
            id_category = $("#filter_category").val();
            id_category_main = $("#filter_master_category").val();
            var nantable = $('#data_tabel').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "/data_faqs",
                    "dataType": "json",
                    "type": "POST",
                    "data": { _token: "{{csrf_token()}}",id_category:id_category,id_category_main:id_category_main }
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
    data_tabel('data_faqs')
});

function UpFile(input,id) {
    //alert("okey");
    if (input.files && input.files[0]) {
        $("#for_"+id).css('display', '');
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#for_'+id)
                .attr('src', e.target.result)
        };

        reader.readAsDataURL(input.files[0]);
    }
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
    var text = CKEDITOR.instances.description.getData();
    $("#isi_deskripsi").val(text);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({ //line 28
            type: 'POST',
            url: '/post_faqs',
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
                    location.reload();
                } else {
                    alert("maaf ada yang salah!!!");
                }
            }
        });
    }
});

function ChangeCategory() {
    // alert(country_id)
    country_id = $("#master_category").val();
    $.ajax({
        type: 'GET',
        url: '/get_category_faq/'+country_id,
        dataType: 'json',
        success: function(data) {
            console.log(data)
            $("#id_category").empty();
            $("#id_category").append("<option value=''>Pilih Sub Kategori</option>");
            for (let i = 0; i < data.length; i++) {
                $("#id_category").append("<option value=" + data[i].id + ">" + data[i].title + "</option>");
            }
        },
        error: function(data) {
            console.log(data);
        }
    });
}

function ChangeCat() {
    // alert(country_id)
    data_tabel('data_faqs');
    country_id = $("#master_category").val();
    $.ajax({
        type: 'GET',
        url: '/get_category_faq/'+country_id,
        dataType: 'json',
        success: function(data) {
            console.log(data)
            $("#filter_category").empty();
            $("#filter_category").append("<option value=''>Semua Sub Kategori</option>");
            for (let i = 0; i < data.length; i++) {
                $("#filter_category").append("<option value=" + data[i].id + ">" + data[i].title + "</option>");
            }
        },
        error: function(data) {
            console.log(data);
        }
    });
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

</script>