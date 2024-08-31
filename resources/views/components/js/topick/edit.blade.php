<script src="{{URL::asset('assets')}}/vendors/js/forms/select/select2.full.min.js"></script>
<script src="{{URL::asset('assets')}}/js/scripts/forms/select/form-select2.js"></script>
<script src="{{URL::asset('assets')}}/js/validate.js"></script>
<script src="{{URL::asset('assets')}}/js/additional-method.js"></script>
<script type="text/javascript">

$(function() {
    $(".select2-container--default").css('width', '100%');
});

$('#id_group').select2().on('select2:open', function () {
var a = $(this).data('select2');
if (!$('.select2-link').length) {
    a.$results.parents('.select2-results')
            .append('<div class="select2-link text-center"><button class="btn btn-primary btn-block btn-sm" onclick="TambahCategry()" style="margin-top:15px;width:100%"><i class="fa fa-plus"></i>Tambah Jasa Pengiriman</button></div>')
            .on('click', function (b) {
                a.trigger('close');
                // add your code
            });
  }
});

function TambahCategry(){
    $(".modal-category").modal('show');
}

// tambah data bidang
$(document).off('click', '#tambah_category').on('click', '#tambah_category', function() {
    var name = $('#new_category').val();
    $("#id_group").append('<option value="'+name+'" selected>'+name+'</option>') ;
    $(".modal-category").modal('hide');
});

$('#id_detail').on("change", function() {
   text = $("#id_detail option:selected").text();
   $("#url").val(text);
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
            url: '/update/topick',
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

function UploadFile(input) {
    //alert("okey");
    if (input.files && input.files[0]) {
        $("#profile").css('display', '');
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#profile')
                .attr('src', e.target.result)
                .css('width', '150px')
        };

        reader.readAsDataURL(input.files[0]);
    }
}
</script>