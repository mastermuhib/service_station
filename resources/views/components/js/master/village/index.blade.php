<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/buttons.print.min.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
<script src="{{URL::asset('assets')}}/js/scripts/datatables/datatable.js"></script>
<script src="{{URL::asset('assets')}}/js/validate.js"></script>
<script src="{{URL::asset('assets')}}/js/additional-method.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/forms/select/select2.full.min.js"></script>
<script src="{{URL::asset('assets')}}/js/scripts/forms/select/form-select2.js"></script>
<script type="text/javascript">
var column = [
    { "data": "no" },
    { "data": "name" },
    { "data": "kecamatan" },
    { "data": "kota" },
    { "data": "id_shiper" },
    { "data": "status" },
    { "data": "action" },
];

function data_tabel(table) {
    prov_id     = $("#filter_province").val();
    city_id     = $("#filter_city").val();
    district_id = $("#filter_district").val();
    is_shiper = $("#is_shiper").val();
    var nantable = $('#yourTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "/"+table,
            "dataType": "json",
            "type": "POST",
            "data": { _token: "{{csrf_token()}}",id_province:prov_id,id_city:city_id,is_shiper:is_shiper,id_district:district_id }
        },
        "columns": column,
        "bDestroy": true
    });
    return nantable;
}
 $(function() {
    $('#yourTable').DataTable();
    $(".select2-container--default").css('width', '100%');
    data_tabel('data_master_village')
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

function filter_province() {
    data_tabel('data_master_village')
    prov_id = $("#filter_province").val();
    $.ajax({
        type: 'GET',
        url: '/get_address/cities/province_id/' + prov_id,
        dataType: 'json',
        success: function(data) {
            console.log(data)
            $("#filter_city").empty();
            $("#filter_city").append("<option value=''>Semua Kota</option>");
            for (let i = 0; i < data.length; i++) {
                $("#filter_city").append("<option value=" + data[i].id + ">" + data[i].name + "</option>");
            }
        },
        error: function(data) {
            console.log(data);
        }
    });
}

function filter_city() {
    data_tabel('data_master_village')
    city_id = $("#filter_city").val();
    $.ajax({
        type: 'GET',
        url: '/get_address/districts/regency_id/'+city_id,
        dataType: 'json',
        success: function(data) {
            console.log(data)
            $("#filter_district").empty();
            $("#filter_district").append("<option value=''>Semua Kecamatan</option>");
            for (let i = 0; i < data.length; i++) {
                $("#filter_district").append("<option value=" + data[i].id + ">" + data[i].name + "</option>");
            }
        },
        error: function(data) {
            console.log(data);
        }
    });
}

function filter_district() {
    data_tabel('data_master_village')
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
        // var description = CKEDITOR.instances.description.getData()
        // var id_country = $("#country").val();
        var id_province = $("#province").val();


        // $("#isi_deskripsi").val(description);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({ //line 28
            type: 'POST',
            url: '/post_master_village',
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
                    $(".toast-body").empty();
                    show_toast(data.message, 1);

                    var nantable = $('#yourTable').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "ajax": {
                            "url": "/data_master_village",
                            "dataType": "json",
                            "type": "POST",
                            "data": { _token: "{{csrf_token()}}" }
                        },
                        "columns": column,
                        "bDestroy": true
                    });
                    nantable.ajax.reload();

                    
                } else {
                    alert("maaf ada yang salah!!!");
                }
            }
        });
    }
});

// batalkan edit
$(document).off('click', '#batalkan3').on('click', '#batalkan3', function() {

    $("#titel_head").remove();
    $("#head_modul").append('<span id="titel_head">Tambah Data Modul</span>');
    $("#hide_add").css('display', '');
    $("#show_edit").css('display', 'none');
});

</script>