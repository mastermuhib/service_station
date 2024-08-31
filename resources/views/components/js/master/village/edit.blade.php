<script src="{{URL::asset('assets')}}/js/validate.js"></script>
<script src="{{URL::asset('assets')}}/js/additional-method.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/forms/select/select2.full.min.js"></script>
<script src="{{URL::asset('assets')}}/js/scripts/forms/select/form-select2.js"></script>
<script type="text/javascript">

 $(function() {
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
            $("#select_city").empty().append("<option value=''>Pilih Kota</option>");
            $("#select_district").empty().append("<option value=''>Pilih Kecamatan</option>");
            $("#select_village").empty().append("<option value=''>Pilih Desa</option>");
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
            $("#select_district").empty().append("<option value=''>Pilih Kecamatan</option>");
            $("#select_village").empty().append("<option value=''>Pilih Desa</option>");
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

function city_change() {
    // alert(country_id)
    city_id = $("#select_city").val();
    $.ajax({
        type: 'GET',
        url: '/get_address/districts/regency_id/'+city_id,
        dataType: 'json',
        success: function(data) {
            console.log(data)
            $("#select_district").empty();
            $("#select_village").empty().append("<option value=''>Pilih Desa</option>");
            $("#select_district").append("<option value=''>Pilih Kecamatan</option>");
            for (let i = 0; i < data.length; i++) {
                $("#select_district").append("<option value=" + data[i].id + ">" + data[i].name + "</option>");
            }
        },
        error: function(data) {
            console.log(data);
        }
    });
}

function district_change() {
    // alert(country_id)
    dis_id = $("#select_district").val();
    $.ajax({
        type: 'GET',
        url: '/get_address/villages/district_id/'+dis_id,
        dataType: 'json',
        success: function(data) {
            console.log(data)
            $("#select_village").empty();
            $("#select_village").append("<option value=''>Pilih Desa</option>");
            for (let i = 0; i < data.length; i++) {
                $("#select_village").append("<option value=" + data[i].id + ">" + data[i].name + "</option>");
            }
        },
        error: function(data) {
            console.log(data);
        }
    });
}

$("#form_edit").validate({
    submitHandler: function(form) {
        $("#loading_edit").css('display', '');
        $("#save_edit").css('display', 'none');
        var id_province = $("#province").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({ //line 28
            type: 'POST',
            url: '/update/master_village',
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
</script>