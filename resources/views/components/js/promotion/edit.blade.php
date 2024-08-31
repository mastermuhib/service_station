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
$(function() {
    //$('#myTable').DataTable();
    $(".select2-container--default").css('width', '100%');
    //data_tabel('data_admin')
});

function gantiProfile(input) {
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

function PromotionType(){
    val = $("#type_product").val();
    if (val == 1) {
        $("#div_ppob").css('display','');
    } else {
        $("#div_ppob").css('display','none');
    }
}

$(document).off('click', '#is_all_payment').on('click', '#is_all_payment', function() {
    alert("okey");
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
                $("#submit").css('display','');
                $("#promo_loading").css('display','none');
                if (data.code == 200) {
                    
                    show_toast(data.message, 1);

                    //data_tabel('data_produk')
                } else {
                    show_toast(data.message, 0);
                }
            }
        });
    }
});
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
var harga_jual = document.getElementById('harga');
harga_jual.addEventListener('keyup', function(e) {
    harga_jual.value = formatRupiah(this.value, '');
});
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