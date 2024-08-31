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
        { "data": "name" },
        { "data": "status" },
        { "data": "action" },
    ];

    function data_tabel(app) {
        if (app == 'data_sugestion') {
            var nantable = $('#data_tabel').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "/data_sugestion",
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
    data_tabel('data_sugestion')
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
            url: '/post_sugestion',
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
                    data_tabel('data_sugestion')
                } else {
                    alert("maaf ada yang salah!!!");
                }
            }
        });
    }
});
</script>