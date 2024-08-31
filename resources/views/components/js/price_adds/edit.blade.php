<script src="{{URL::asset('assets')}}/vendors/js/forms/select/select2.full.min.js"></script>
<script src="{{URL::asset('assets')}}/js/scripts/forms/select/form-select2.js"></script>
<script src="{{URL::asset('assets')}}/js/validate.js"></script>
<script src="{{URL::asset('assets')}}/js/additional-method.js"></script>
<!-- <script src="{{URL::asset('assets')}}/js/ckeditor.js"></script> -->
<script>
    // var config = {};
    // config.placeholder = 'some value';
    // CKEDITOR.replace('description', config);
</script>
<script type="text/javascript">

$(function() {
    $(".select2-container--default").css('width', '100%');
});

function UpFile(input,id) {
    //alert("okey");
    if (input.files && input.files[0]) {
        $("#for_"+id).css('display', '');
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#for_'+id)
                .attr('src', e.target.result)
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function IsFree(){
    status = $("#is_free").val();
    if (status == '1') {
        $("#nominal").attr('readonly','readonly');
        $("#nominal").val(0);
    } else {
        $("#nominal").attr('readonly',false);
        $("#nominal").val("");
    }
}

function IsUnlimited(){
    status = $("#is_unlimited").val();
    if (status == '1') {
        $("#number_of_voucher").attr('readonly','readonly');
        $("#number_of_voucher").val(0);
    } else {
        $("#number_of_voucher").attr('readonly',false);
        $("#number_of_voucher").val("");
    }
}


$("#form_edit").validate({
    submitHandler: function(form) {
    $("#loading_edit").css('display', '');
    $("#save_edit").css('display', 'none');
    // var text = CKEDITOR.instances.description.getData();
    // $("#isi_deskripsi").val(text);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({ //line 28
            type: 'POST',
            url: '/update/price_adds',
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
var nominal = document.getElementById('nominal');
nominal.addEventListener('keyup', function(e) {
    nominal.value = formatRupiah(this.value,'');
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
</script>