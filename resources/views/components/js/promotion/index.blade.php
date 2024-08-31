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
    { "data": "name" },
    { "data": "code" },
    { "data": "potongan" },
    { "data": "kuota" },
    { "data": "terpakai" },
    { "data": "date" },
    { "data": "end" },
    { "data": "admin" },
    { "data": "status" },
    { "data": "actions" }
];

function data_tabel(tabel) {
    var tgl_start = $("#start").val();
    var tgl_end = $("#end").val();
    var status = $("#s_status").val();
    var cabang = $("#s_cabang").val();
    var search = $("#s_search").val();
    var tipe = $("#s_tipe").val();
    var sort = $("#sort").val();
    
    if (tabel == 'data_promosi_umum') {
        var xin_table = $('#data_tabel').DataTable({
            "processing": true,
            "serverSide": true,
            "orderable": false,
            "targets": 'no-sort',
            "bSort": false,
            "bFilter": false,
            "ajax": {
                "url": '/data_promosi_umum',
                "dataType": "json",
                "type": "POST",
                "data": { _token: "{{csrf_token()}}",tgl_start : tgl_start,tgl_end : tgl_end,status : status,cabang : cabang,search :search,sort:sort,tipe:tipe }
            },
            "columns": columns,
            "bDestroy": true
        });
        $("#data_tabel_length").remove();
    }
    
}

function gantiProfile_admin(input) {
    //alert("okey");
    if (input.files && input.files[0]) {
        $("#profile_admin").css('display', '');
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#profile_admin')
                .attr('src', e.target.result)
                .css('width', '150px')
        };

        reader.readAsDataURL(input.files[0]);
    }
}

$(function() {
    //$('#myTable').DataTable();
    $(".select2-container--default").css('width', '100%');
    data_tabel('data_promosi_umum')
});
$("#s_search").keyup(function(){
   data_tabel('data_promosi_umum');
});


$('.select2').on('change', function() { // when the value changes
    $(this).valid(); // trigger validation on this element
});

$('#tambah').on("click", function() {
    // alert('tes')
    $(window).scrollTop(0);
    $("#show_add").css('display', '');
});
$('#batalkan').on("click", function() {
    $("#show_add").css('display', 'none');
});

$("#form_add").validate({
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
        $("#submit").css('display','none');
        $("#promo_loading").css('display','');
        $.ajax({ //line 28
            type: 'POST',
            url: '/post_promosi_umum',
            dataType: 'json',
            data: new FormData($("#form_add")[0]),
            processData: false,
            contentType: false,
            success: function(data) {
                if (data.code == 200) {
                    document.getElementById("form_add").reset();
                    $("#hide_add").css('display', '');
                    $("#show_add").css('display', 'none');
                    show_toast(data.message, 1);
                    $("#submit").css('display','');
                    $("#promo_loading").css('display','none');

                    data_tabel('data_promosi_umum')
                } else {
                    show_toast(data.message, 0);
                }
            }
        });
    }
});


$(document).off('click', '#is_all_payment').on('click', '#is_all_payment', function() {
    if ($(this).is(':checked')) {
        $(".is_all_payment").prop('checked','checked');
        
    } else {
        $(".is_all_payment").prop('checked',false);
        
    }
});
$(document).off('click', '#is_all_delivery').on('click', '#is_all_delivery', function() {
    if ($(this).is(':checked')) {
        $(".is_all_delivery").prop('checked','checked');
        
    } else {
        $(".is_all_delivery").prop('checked',false);
        
    }
});
$(document).off('click', '#is_all_category').on('click', '#is_all_category', function() {
    if ($(this).is(':checked')) {
        $(".is_all_category").prop('checked','checked');
        
    } else {
        $(".is_all_category").prop('checked',false);
        
    }
});
$(document).off('click', '#is_all_level').on('click', '#is_all_level', function() {
    if ($(this).is(':checked')) {
        $(".is_all_level").prop('checked','checked');
        
    } else {
        $(".is_all_level").prop('checked',false);
        
    }
});
$(document).off('click', '#is_all_frontgroup').on('click', '#is_all_frontgroup', function() {
    if ($(this).is(':checked')) {
        $(".is_all_frontgroup").prop('checked','checked');
    } else {
        $(".is_all_frontgroup").prop('checked',false);  
    }
});
$(document).off('click', '#is_all_ppob').on('click', '#is_all_ppob', function() {
    if ($(this).is(':checked')) {
        $(".is_all_ppob").prop('checked','checked');
        
    } else {
        $(".is_all_ppob").prop('checked',false);
        
    }
});

$(document).off('click', '.user_coupon').on('click', '.user_coupon', function() {
    id = $(this).attr('id');
    $("#modal_user_preview").modal('show')
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
        url :'/detail_user_promotion/'+id,
        type: "GET",
        success: function (response) {
            if(response) {
                $("#proses_loading").css('display','none');
                $("#isi_preview").html(response);
            }
        }
    });  
});

$(document).off('click', '.edit_data').on('click', '.edit_data', function() {
    var id = $(this).attr('id');
    $("#show_add").css('display', 'none');
    $.ajax({
        url: '/detail/participant/' + id,
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

$(document).off('click', '#batalkan3').on('click', '#batalkan3', function() {

    $("#titel_head").remove();
    $("#head_modul").append('<span id="titel_head">Tambah Data Admin</span>');
    $("#hide_add").css('display', '');
    $("#show_edit").css('display', 'none').empty();
});

$(document).off('click', '#kirim_edit').on('click', '#kirim_edit', function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({ //line 28
        type: 'POST',
        url: '/update/promosi',
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
                show_toast(data.message, 1);

                $("#show_edit").css('display', 'none').empty();
                //alert("okey");
                data_tabel('data_promosi_umum')
            }
        }
    });
});
// is admin cabang
$(document).off('click', '#centang_diskon').on('click', '#centang_diskon', function() {
    if ($("#centang_diskon").prop('checked') == true) {
        $("#div_diskon").css('display', '');
    } else {
        $("#div_diskon").css('display', 'none');
    }
});

$(document).off('change', '#tipe_discount').on('change', '#tipe_discount', function() {
    tipe = $("#tipe_discount").val();
    if ( tipe == 0) {
        $(".nominal").css('display', '');
        $(".prosentase").css('display', 'none');

    } else {
        $(".nominal").css('display', 'none');
        $(".prosentase").css('display', '');
    }

});
$(document).off('change', '#select_role').on('change', '#select_role', function() {
    
    id = $(this).val();
    $(".get_role").remove();
    $.ajax({
        url: '/select_role/'+id+'/company',
        type: "GET",
        success: function(response) {
            //console.log(response);
            if (response) {
                $("#div_company").html(response);
            }
            $('.select2').select2();
            $(".select2-container--default").css('width', '100%');
        }
    });
    //kode ao
    $.ajax({
        url: '/select_role/'+id+'/kode',
        type: "GET",
        success: function(response) {
            //console.log(response);
            if (response) {
                $("#div_kode").html(response);
            }
        }
    });
});


function DataTable(){
    //alert("okey");
    sort = $("#sort").val();
    $("#is_sort").val(sort);

    data_tabel('data_promosi_umum');
}
function FilterBy(){
    alert("cak");
}


$(document).off('click','.d_detail').on('click','.d_detail', function (){
    var id = $(this).attr('id');
    tingkatan = $("#tingkatan").val();
    
    $("#button_id").attr('tabel',id);
    //$("#id_user").val(id);
    //alert(status);
    $("#modal_prev").modal('show'); 
    $("#proses_loading").css('display','');
    //$("#footer_cv").css('display','none');
    //alert(status);
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
        url :'/detail_participant/'+id+'/'+tingkatan,
        type: "GET",
        success: function (response) {
            // console.log(response);
            if(response) {
                $("#isi_preview").html(response);
                $("#proses_loading").css('display','none');
                //$("#footer_cv").css('display','');
            }
        }
    });      
});

$(document).off('click', '.batalkan').on('click', '.batalkan', function(){
   id = $(this).attr('id');
   status = $(this).attr('status');
   //alert(status);
   $(".span_batal").html(status);
   $("#id_user").val(id);
   $("#batalKan").modal('show'); 
});
function ImportEX() {
    $("#loading_import").css('display','');
    $("#btn_import").css('display','none');
    $.ajax({ //line 28
        type: 'POST',
        url: '/import_participant',
        //url: '/import_update_participant',
        dataType: 'json',
        data: new FormData($("#form_import")[0]),
        processData: false,
        contentType: false,
        success: function(data) {
            if (data.code == 200) {
                document.getElementById("form_import").reset();
                $("#message").remove();
                show_toast(data.message, 1);
                $("#loading_import").css('display','none');
                $("#btn_import").css('display','');

                data_tabel('data_promosi')
            } else {
                show_toast(data.message, 0);
                $("#loading_import").css('display','none');
                $("#btn_import").css('display','');
            }
        }
    });
}

$(document).off('click','#download_excel').on('click','#download_excel', function(){
    var serial = $("#form_filter").serialize();
    window.open("/download_excel/"+serial, '_blank');
});

function ResetAll(){
    location.reload();
}
$("#is_percentage").change(function() { 
   // alert("zau zau");
    val = $(this).val();
    if (val == 1) {
        $("#potongan_jumlah").css('display','none');
        $("#potongan_jumlah").attr('disabled','disabled');
        $("#potongan_persentasi").css('display','');
        $("#potongan_persentasi").attr('disabled',false);
        $("#max_potongan").attr('required','required');
        $("#max_pot").css('display','');
    } else {
        $("#potongan_jumlah").css('display','');
        $("#potongan_jumlah").attr('disabled',false);
        $("#potongan_persentasi").css('display','none');
        $("#potongan_persentasi").attr('disabled','disabled');
        $("#max_potongan").attr('required',false);
        $("#max_potongan").val('');
        $("#max_pot").css('display','none');

    }
});

function PromotionType(){
    val = $("#type_product").val();
    if (val == 1) {
        $("#div_ppob").css('display','none');
    } else {
        $("#div_ppob").css('display','');
    }
}

var max_potongan = document.getElementById('max_potongan');
max_potongan.addEventListener('keyup', function(e) {
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    max_potongan.value = formatRupiah(this.value,'');
});

var potongan = document.getElementById('potongan_jumlah');
potongan.addEventListener('keyup', function(e) {
    potongan.value = formatRupiah(this.value,'');
});

var minimal_transaksi = document.getElementById('minimal_transaksi');
minimal_transaksi.addEventListener('keyup', function(e) {
    minimal_transaksi.value = formatRupiah(this.value,'');
});
/* Fungsi formatRupiah */
function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}

function AddBank(){
    var max = 0;
    $('.tr_bank').each(function() {
      var value = parseInt($(this).data('no'));
      max = (value > max) ? value : max;
    });
   // alert(max);
    var id = parseInt(max)+1;

    $.ajax({
        url: '/add_bank_promotion/'+id,
        type: "GET",
        success: function(response) {
            console.log(response);
            if (response) {
                $("#body_bank").append(response);
            }
        }
    });
}

function DeleteBank(id){
    $("#tr_bank"+id).remove();
}

function AddPengiriman(){
    var max = 0;
    $('.tr_delivery').each(function() {
      var value = parseInt($(this).data('no'));
      max = (value > max) ? value : max;
    });
   // alert(max);
    var id = parseInt(max)+1;

    $.ajax({
        url: '/add_delivery_promotion/'+id,
        type: "GET",
        success: function(response) {
            console.log(response);
            if (response) {
                $("#body_delivery").append(response);
            }
        }
    });
}

function DeleteDelivery(id){
    $("#tr_delivery"+id).remove();
}

function ChangeBank(id){
    val = $("#id_payment"+id).val();
    $.ajax({
        url: '/detail_bank_promotion/'+val,
        type: "GET",
        success: function(response) {
            console.log(response);
            if (response) {
                $("#td_bank"+id).html(response);
            }
        }
    });
}

function ChangeDelivery(id){
    val = $("#id_delivery"+id).val();
    $.ajax({
        url: '/detail_delivery_promotion/'+val,
        type: "GET",
        success: function(response) {
            console.log(response);
            if (response) {
                $("#td_delivery"+id).html(response);
            }
        }
    });
}
</script>