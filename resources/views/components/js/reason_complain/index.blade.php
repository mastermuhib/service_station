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
        { "data": "number" },
        { "data": "description" },
        { "data": "status" },
        { "data": "action" },
    ];

    function data_tabel(app) {
        if (app == 'data_reason_complain') {
            var nantable = $('#data_tabel').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "/data_reason_complain",
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
    data_tabel('data_reason_complain')
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

function ChangeIcon(input,id) {
    //alert("okey");
    if (input.files && input.files[0]) {
        $("#icon_"+id).css('display', '');
        var reader = new FileReader();

        reader.onload = function(e) {
            $("#icon_"+id)
                .attr('src', e.target.result)
                .css('width', '50px')
                .css('height', '50px')
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({ //line 28
            type: 'POST',
            url: '/post_reason_complain',
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
                    data_tabel('data_reason')
                } else {
                    alert("maaf ada yang salah!!!");
                }
            }
        });
    }
});

// $('#id_group').select2().on('select2:open', function () {
// var a = $(this).data('select2');
// if (!$('.select2-link').length) {
//     a.$results.parents('.select2-results')
//             .append('<div class="select2-link text-center"><button class="btn btn-primary btn-block btn-sm" onclick="TambahCategry()" style="margin-top:15px;width:100%"><i class="fa fa-plus"></i>Tambah Jasa Pengiriman</button></div>')
//             .on('click', function (b) {
//                 a.trigger('close');
//                 // add your code
//             });
//   }
// });

function TambahCategry(){
    $(".modal-category").modal('show');
}

// tambah data bidang
$(document).off('click', '#tambah_category').on('click', '#tambah_category', function() {
    var name = $('#new_category').val();
    $("#id_group").append('<option value="'+name+'" selected>'+name+'</option>') ;
    $(".modal-category").modal('hide');
});
</script>