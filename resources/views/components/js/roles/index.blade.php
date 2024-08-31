<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/buttons.print.min.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
<script src="{{URL::asset('assets')}}/js/scripts/datatables/datatable.js"></script>
<script src="{{URL::asset('assets')}}/js/popper.1.16.js"></script>
<script src="{{URL::asset('assets')}}/js/anypicker.min.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/forms/select/select2.full.min.js"></script>
<script src="{{URL::asset('assets')}}/js/scripts/forms/select/form-select2.js"></script>
<script src="{{URL::asset('assets')}}/js/ckeditor.js"></script>
<script src="{{URL::asset('assets')}}/js/validate.js"></script>
<script src="{{URL::asset('assets')}}/js/additional-method.js"></script>
<!-- end -->
<script type="text/javascript">

$(function() {
    //$('#myTable').DataTable();
    $(".select2-container--default").css('width', '100%');
    data_tabel('data_role')
});

function data_tabel(table){
    var xin_table = $('#data_table').DataTable({
        "bDestroy": true,
        "ajax": {
            url: "/"+table,
            type: 'GET'
        }
    });
}

$(document).off('click', '.check_menu').on('click', '.check_menu', function() {
    var tabel = $(this).attr('tabel');
    if ($(this).is(':checked')) {
        $(".sub" + tabel).attr('disabled', false);

    } else {

        $(".sub" + tabel).attr('disabled', 'disabled');
    }
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
    rules: {
        name: {
            minlength: 2
        }
    },
    messages: {
        password: {
            minlength: "Role Wajib diisi"
        }
    },
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
            url: '/post_role',
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
                $("#message").remove();
                show_toast(data.message, 1);

                var xin_table = $('#myTable').dataTable({
                    "bDestroy": true,
                    "ajax": {
                        url: "/data_role",
                        type: 'GET'
                    }
                });
            } else {
                alert("maaf ada yang salah!!!");
            } 
            }
        });
    }
});
</script>