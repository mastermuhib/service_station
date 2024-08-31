<script src="{{URL::asset('assets')}}/js/validate.js"></script>
<script src="{{URL::asset('assets')}}/js/additional-method.js"></script>
<script type="text/javascript">

$(function() {
    //$('#myTable').DataTable();
    $(".select2-container--default").css('width', '100%');
});

$(document).off('click', '.check_menu').on('click', '.check_menu', function() {
    var tabel = $(this).attr('tabel');
    if ($(this).is(':checked')) {
        $(".sub" + tabel).attr('disabled', false);

    } else {

        $(".sub" + tabel).attr('disabled', 'disabled');
    }
});

$("#form_edit").validate({
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
    $("#loading_edit").css('display', '');
    $("#save_edit").css('display', 'none');
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({ //line 28
            type: 'POST',
            url: '/update/role',
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
                    show_toast(data.message, 2);
                } 
            }
        });
    }
});
</script>