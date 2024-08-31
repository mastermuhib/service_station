<script src="{{URL::asset('assets')}}/js/validate.js"></script>
<script src="{{URL::asset('assets')}}/js/additional-method.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/forms/select/select2.full.min.js"></script>
<script src="{{URL::asset('assets')}}/js/scripts/forms/select/form-select2.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/buttons.print.min.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
<script src="{{URL::asset('assets')}}/js/scripts/datatables/datatable.js"></script>
<script type="text/javascript">
var columns = [{
        "data": null,
        "sortable": false,
        "orderable": false,
        "bFilter": false,
        "targets": 'no-sort',
        "bSort": false,
        render: function(data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
        }
    },
    { "data": "title" },
    { "data": "nominal" },
    { "data": "deskripsi" },
    { "data": "status" },
    { "data": "date" }
];

function data_tabel(tabel) {
    var tgl_start = $("#tgl_start").val();
    var id_user = $("#id_user").val();
    var tgl_end = $("#tgl_end").val();
    var status = $("#status").val();
    var search = $("#s_search").val();
    var sort = $("#sort").val();
    
    if (tabel == 'data_saldo_history') {
        var xin_table = $('#data_tabel').DataTable({
            "processing": true,
            "serverSide": true,
            "orderable": false,
            "targets": 'no-sort',
            "bSort": false,
            "bFilter": false,
            "ajax": {
                "url": '/data_saldo_history',
                "dataType": "json",
                "type": "POST",
                "data": { _token: "{{csrf_token()}}",tgl_start : tgl_start,tgl_end : tgl_end,status : status,search :search,sort:sort,id_user:id_user,is_seller : 1 }
            },
            "columns": columns,
            "bDestroy": true
        });
        $("#data_tabel_length").remove();
    }
    
}

$("#s_search").keyup(function(){
   data_tabel('data_saldo_history');
});
$(function() {
    $(".select2-container--default").css('width', '100%');
    data_tabel('data_saldo_history')
    data_product();
});

$('#tambah').on("click", function() {
    // alert('tes')
    $(window).scrollTop(0);
    $("#show_add").css('display', '');
});
$('#batalkan').on("click", function() {
    $("#show_add").css('display', 'none');
});

function gantiProfile(input,id) {
    //alert("okey");
    if (input.files && input.files[0]) {
        $("#img_"+id).css('display', '');
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#img_'+id)
                .attr('src', e.target.result)
                .css('width', '150px')
        };

        reader.readAsDataURL(input.files[0]);
    }
}

$("#form_edit").validate({
    rules: {
        password: {
            minlength: 6
        },
        confirm_password: {
            equalTo: "#password"
        }
    },
    messages: {
        password: {
            minlength: "password minimal 6 character"
        },
        confirm_password: {
            equalTo: "password not match"
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
            url: '/update/customer',
            dataType: 'json',
            data: new FormData($("#form_edit")[0]),
            processData: false,
            contentType: false,
            success: function(data) {
                $("#save_edit").css('display', '');
                $("#loading_edit").css('display', 'none');
                if (data.code == 200) {
                    show_toast(data.message, 1);
                    location.reload();
                } else {
                    show_toast(data.message, 2);
                }
            }
        });
    }
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

$('.d_address').on("click", function() {
    // alert('tes')
    id_user = $("#id_user").val()
    no = $(this).attr('no');
    $(".d_address").removeClass("active");
    $("#d_address"+no).addClass("active");
    $.ajax({
        type: 'GET',
        url: '/get_address_customer/'+no+'/'+id_user,
        dataType: 'html',
        success: function(data) {
            $("#this_form").html(data);
            
        },
        error: function(data) {
            console.log(data);
        }
    });
});

function ChangePassword(){
    $("#modal_password").modal('show');
}

$('#aksi_ubah_password').on("click", function() {
    // alert('tes')
    password = $("#password").val();
    c_password = $("#confirm_password").val();
    if (password != c_password) {
            show_toast("Password harus Sama", 2);
    } else {
        if (password == '' || c_password == '') {
            show_toast("Password wajib diisi", 2);
        } else {
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({ //line 28
                type: 'POST',
                url: '/update/customer/password',
                dataType: 'json',
                data: new FormData($("#form_ubah_password")[0]),
                processData: false,
                contentType: false,
                success: function(data) {
                    $("#modal_password").modal('hide');
                    
                    if (data.code == 200) {
                        show_toast(data.message, 1);
                    } else {
                        show_toast(data.message, 2);
                    }
                }
            });
        }
    }
});

function data_product() {
    var search = $("#search").val();
    var sort   = $("#sort").val();
    var id_category = $("#id_category").val();
    var id_seller = $("#id_seller").val();
    var start  = $("#start").val();

    //send data
    $("#body_product").html('<div class="col-md-12"><div class="text-center mt-20 mb-20"><span class="text-success">Loading............</span></div></div>');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({ //line 28
        type: 'POST',
        url: '/get_data_product',
        dataType: 'html',
        data: { search:search,sort:sort,id_category:id_category,start:start,id_seller:id_seller },
        success: function(data) {  
            $("#body_product").html(data);
        }
    });   
}
</script>