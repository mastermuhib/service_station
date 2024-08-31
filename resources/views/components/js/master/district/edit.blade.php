<script src="{{URL::asset('assets')}}/vendors/js/forms/select/select2.full.min.js"></script>
<script src="{{URL::asset('assets')}}/js/scripts/forms/select/form-select2.js"></script>
<script src="{{URL::asset('assets')}}/js/validate.js"></script>
<script src="{{URL::asset('assets')}}/js/additional-method.js"></script>
<script type="text/javascript">
$(function() {
    //$('#yourTable').DataTable();
    $(".select2-container--default").css('width', '100%');
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
            $("#select_city").empty();
            $("#select_province").append("<option value=''>Pilih Provinsi</option>");
            $("#select_city").append("<option value=''>Pilih Kota</option>");
            for (let i = 0; i < data.length; i++) {
                $("#select_province").append("<option value=" + data[i].id + ">" + data[i].name + "</option>");
            }
        },
        error: function(data) {
            console.log(data);
        }
    });
}

function province_change() {
    // alert(country_id)
    prov_id = $("#select_province").val();
    $.ajax({
        type: 'GET',
        url: '/get_address/cities/province_id/' + prov_id,
        dataType: 'json',
        success: function(data) {
            console.log(data)
            $("#select_city").empty();
            $("#select_city").append("<option value=''>Pilih Kota</option>");
            for (let i = 0; i < data.length; i++) {
                $("#select_city").append("<option value=" + data[i].id + ">" + data[i].name + "</option>");
            }
        },
        error: function(data) {
            console.log(data);
        }
    });
}

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
        url: '/update/master_district',
        dataType: 'json',
        data: new FormData($("#form_edit")[0]),
        processData: false,
        contentType: false,
        success: function(data) {
            //$("#modal_loading").modal('hide');
            //$(".modal-backdrop").remove();
            console.log(data)
            $(".edit-modal-data").modal('hide');
            if (data.code == 200) {
                
                show_toast(data.message, 1);
            }
        }
    });
});
$("#form_edit").validate({
    submitHandler: function(form) {
        $("#loading_edit").css('display', '');
        $("#save_edit").css('display', 'none');
        //var description = CKEDITOR.instances.description.getData();
        // var id_country = $("#country").val();
        var id_province = $("#province").val();

        //$("#isi_deskripsi").val(description);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({ //line 28
            type: 'POST',
            url: '/update/master_district',
            dataType: 'json',
            data: new FormData($("#form_edit")[0]),
            processData: false,
            contentType: false,
            success: function(data) {
                $("#loading_edit").css('display', 'none');
                $("#save_edit").css('display', '');
                $("#loading_add").css('display', 'none');
                $("#save_add").css('display', '');
                if (data.code == 200) {
                    
                    show_toast(data.message, 1);
                    
                } else {
                    alert("maaf ada yang salah!!!");
                }
            }
        });
    }
});

</script>