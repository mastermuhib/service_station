<script type="text/javascript">
$(function() {
    //$('#myTable').DataTable();
    $(".select2-container--default").css('width', '100%');
    //data_tabel('data_admin')
});

$('.select2').on('change', function() { // when the value changes
    $(this).valid(); // trigger validation on this element
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
            url: '/post_promosi',
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
</script>