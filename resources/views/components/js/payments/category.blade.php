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
<script src="{{URL::asset('assets')}}/js/additional-methods.js"></script>
<style>
    label.error {
        color: red;
    }
    </style>
<script type="text/javascript">
$(function() {
    //$('#myTable').DataTable();
    $(".select2-container--default").css('width', '100%');
    var xin_table = $('#myTable').DataTable({
        "bDestroy": true,
        "ajax": {
            url: "/data-payment-category",
            type: 'GET'
        }
    });
});
var config = {};
config.placeholder = 'some value';
CKEDITOR.replace('description', config);

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
        var description = CKEDITOR.instances.description.getData();
        $("#isi_deskripsi").val(description);
        $.ajax({ //line 28
            type: 'POST',
            url: '/post-payment-category',
            dataType: 'json',
            data: new FormData($("#form_add")[0]),
            processData: false,
            contentType: false,
            success: function(data) {

                if (data.code == 200) {
                    document.getElementById("form_add").reset();
                    $("#hide_add").css('display', '');
                    $("#show_add").css('display', 'none');
                    $("#message").remove();
                    $(".toast-body").append('<label style="color:white;font-size:12px;font-weight:bold;">' + data.message + '</label>')
                    $('.toast').toast('show');
                    var xin_table = $('#myTable').dataTable({
                        "bDestroy": true,
                        "ajax": {
                            url: "/data-payment-category",
                            type: 'GET'
                        }
                    });
                } else {
                    alert("maaf ada yang salah!!!");
                }
                CKEDITOR.instances.description.setData(''); // ckeditor reset
            }
        });
    }
});

$("#form_edit").validate({
    submitHandler: function(form) {
        var description = CKEDITOR.instances.description.getData();
        $("#isi_deskripsi").val(description);
        $.ajax({ //line 28
            type: 'POST',
            url: '/update/payment-category',
            dataType: 'json',
            data: new FormData($("#form_edit")[0]),
            processData: false,
            contentType: false,
            success: function(data) {

                if (data.code == 200) {
                    
                } else {
                    alert("maaf ada yang salah!!!");
                }
                CKEDITOR.instances.description.setData(''); // ckeditor reset
            }
        });
    }
});


$(document).off('click', '#kirim_edit').on('click', '#kirim_edit', function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var description = CKEDITOR.instances.edit_description.getData();
    $("#isi_deskripsi2").val(description);
    $.ajax({ //line 28
        type: 'POST',
        url: '/update/payment-category',
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
                $(".toast-body").append('<label style="color:white;font-size:12px;font-weight:bold;" id="message">' + data.message + '</label>')
                $('.toast').toast('show');
                $("#titel_head").remove();
                $("#head_modul").append('<span id="titel_head">Add Admin</span>');
                $("#hide_add").css('display', '');
                $("#show_edit").css('display', 'none');
                //alert("okey");
                var xin_table = $('#myTable').DataTable({
                    "bDestroy": true,
                    "ajax": {
                        url: "/data-payment-category",
                        type: 'GET'
                    }
                });
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
    $("#head_modul").append('<span id="titel_head">Edit Data Kelas</span>');
    $.ajax({
        url: '/detail/payment-category/' + id,
        type: "GET",
        success: function(response) {
            console.log(response);
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
    $("#head_modul").append('<span id="titel_head">Tambah Data Modul</span>');
    $("#hide_add").css('display', '');
    $("#show_edit").css('display', 'none');
});

</script>