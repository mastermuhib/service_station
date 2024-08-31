<!-- Modal -->
<div class="modal fade text-left" id="modal_aksi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title-modal">Ubah Status</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" id="form_aksi">
                <div class="modal-body modal_aksi">
                    <input type="hidden" value="" id="id_data" name="id">
                    <input type="hidden" value="" id="id_tujuan" name="tujuan">
                    <input type="hidden" value="" id="id_aksi" name="aksi">
                    <input type="hidden" value="" id="id_tabel" name="tabel">
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="aksi_kirim">OK</button>
            </div>
        </div>
    </div>
</div>
<!-- -->
<!-- Modal -->
<div class="modal fade text-left" id="modalStatistic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title_statistic"></h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="body_statistic">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- -->
<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#6993FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#E1E9FF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->
<script src="{{URL::asset('assets')}}/plugins/global/plugins.bundle.js"></script>
<script src="{{URL::asset('assets')}}/plugins/custom/prismjs/prismjs.bundle.js"></script>
<script src="{{URL::asset('assets')}}/js/scripts.bundle.js"></script>
<script src="{{URL::asset('assets')}}/js/vendors/bootstrap.bundle.min.js"></script>
<script src="{{URL::asset('assets')}}/js/vendors/select2.min.js"></script>
<script src="{{URL::asset('assets')}}/js/vendors/perfect-scrollbar.js"></script>
<script src="{{URL::asset('assets')}}/js/vendors/jquery.fullscreen.min.js"></script>
<script src="{{URL::asset('assets')}}/js/vendors/chart.js"></script>
<!-- Main Script -->
<script src="{{URL::asset('assets')}}/js/main.js?v=1.1" type="text/javascript"></script>
<script src="{{URL::asset('assets')}}/js/custom-chart.js" type="text/javascript"></script>
<script src="{{URL::asset('assets')}}/js/pages/features/miscellaneous/toastr.js"></script>
<style>
label.error {
    color: red;
    margin-top: 3px;
    font-size: 11px;
}

</style>
<script type="text/javascript">
	function show_toast(message, type) {
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "30",
            "hideDuration": "100",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        if (type == 1) {
            toastr.success(message, "Notification");
        } else {
            toastr.error(message, "Error Notification")
        }

    }
    $(document).off('click', '.aksi').on('click', '.aksi', function() {
        $("#modal_detail").remove();
        $('#title-modal').html('Warning !!!');
        $('#aksi_kirim').html('Ok');
        var id = $(this).attr('id');
        $("#id_data").val(id);
        var aksi = $(this).attr('aksi');
        $("#id_aksi").val(aksi);
        //alert(aksi);
        var tujuan = $(this).attr('tujuan');
        $("#id_tujuan").val(tujuan);
        var data = $(this).attr('data');
        $("#id_tabel").val(data);
        if (aksi == 'delete') {
            var kata = "Apakah Anda Akan Menghapus Data Ini ??";
        } else if (aksi == 'aktif') {
            var kata = "Apakah Anda Akan Mengaktifkan Data Ini ??";
            if (tujuan == 'master_cabang') {
                var kata = "Apakah Anda Akan Mengaktifkan Data Ini, Sehingga muncul di Aplikasi ??";
            }
        } else if (aksi == 'reset_password') {
            var kata = "Apakah Anda Akan Mereset Password Akun ini ??";
        } else if (aksi == 'approve_pembayaran') {
            var kata = "Apakah Anda yakin menerima pembayaran transaksi ini ??";
        } else if (aksi == 'approve_otp') {
            var kata = "Apakah Anda Akan Mengapprove OTP untuk Akun ini ??";
        } else if (aksi == 'batalkan') {
            var kata = "Apakah Anda Menyetujui Pembatalan ini ??";

        } else {
            var kata = "Apakah Anda Akan Menonaktifkan Data Ini ??";
            if (tujuan == 'master_cabang') {
                var kata = "Apakah Anda Akan Menonaktifkan Data Ini, Sehingga hanya muncul sebagai office ??";
            }
        }

        var app = '<span id="modal_detail" style="color:red;font-weight:bold;font-size:12px;">' + kata + '</span>';
        if (aksi == 'blokir') {
            app = kata;
        }

        $(".modal_aksi").append(app);
        $("#modal_aksi").modal('show');

    });

    $(document).off('click', '#aksi_kirim').on('click', '#aksi_kirim', function() {
        //alert("coba")
        id = $("#id_data").val();
        //alert(id);
        aksi = $("#id_aksi").val();
        tujuan = $("#id_tujuan").val();
        tabel = $("#id_tabel").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({ //line 28
            type: 'POST',
            url: '/' + aksi + '/' + tujuan,
            dataType: 'json',
            data: new FormData($("#form_aksi")[0]),
            processData: false,
            contentType: false,
            success: function(data) {
                if (data.code == 200) {
                    $(".toast-body").empty();
                    show_toast(data.message, 1);
                    $(".modal").modal("hide");
                    if (tujuan == 'shop' || tujuan == 'product') {
                        data_table(tabel)
                    } else {
                        data_tabel(tabel)
                    }

                } else {
                    alert("maaf ada yang salah!!!");
                }
            }
        });
    });

    $(document).off('click', '.aksi_suspend').on('click', '.aksi_suspend', function() {
        $("#modal_detail").remove();
        $('#title-modal').html('Warning !!!');
        $('#aksi_kirim').html('Ok');
        var id = $(this).attr('id');
        $("#id_data").val(id);
        var status = $(this).attr('status');
        var suspend = $(this).attr('suspend');
        var reason = $(this).attr('reason');
        var aksi = $(this).attr('aksi');
        $("#id_aksi").val(aksi);
        //alert(status);
        var tujuan = $(this).attr('tujuan');
        $("#id_tujuan").val(tujuan);
        var data = $(this).attr('data');
        $("#id_tabel").val(data);
        if (status == '0') {

           app = '<div id="modal_detail" class="row"><div class="mb-4 col-md-12"><label class="form-label">Status</label><br><select class"form-select" style="width:100%;height:41px;" name="status" id="status_suspend"><option value="0" selected>Tidak Aktif</option><option value="2" selected>Suspend</option><option value="1">Aktif</option><option value="3">Blokir selamanya</option></select></div><div class="mb-4 col-md-12" id="suspend_tanggal"><label class="control-label">Suspend Sampai Tanggal</label><input type="datetime-local" name="suspend_date_active" class="form-control form-control-lg" value="'+suspend+'" placeholder="" required></div><div class="mb-4 col-md-12" id="div_reason"><label class="control-label">Alasan</label><textarea name="reason" class="form-control form-control-lg">'+reason+'</textarea></div></div>';
        } else if (status == '1') {
            app = '<div id="modal_detail" class="row"><div class="mb-4 col-md-12"><label class="form-label">Status</label><br><select class"form-select" style="width:100%;height:41px;" name="status" id="status_suspend"><option value="0" selected>Tidak Aktif</option><option value="2">Suspend</option><option value="1" selected>Aktif</option><option value="3">Blokir selamanya</option></select></div><div class="mb-4 col-md-12" id="suspend_tanggal" style="display:none"><label class="control-label">Suspend Sampai Tanggal</label><input type="datetime-local" name="suspend_date_active" class="form-control form-control-lg" value="'+suspend+'" placeholder="" required></div><div class="mb-4 col-md-12" id="div_reason" style="display:none"><label class="control-label">Alasan</label><textarea name="reason" class="form-control form-control-lg">'+reason+'</textarea></div></div>';
        } else if (status == '2') {
            app = '<div id="modal_detail" class="row"><div class="mb-4 col-md-12"><label class="form-label">Status</label><br><select class"form-select" style="width:100%;height:41px;" name="status" id="status_suspend"><option value="0" selected>Tidak Aktif</option><option value="2" selected>Suspend</option><option value="1">Aktif</option><option value="3">Blokir selamanya</option></select></div><div class="mb-4 col-md-12" id="suspend_tanggal" style="display:none"><label class="control-label">Suspend Sampai Tanggal</label><input type="datetime-local" name="suspend_date_active" class="form-control form-control-lg" value="'+suspend+'" placeholder="" required></div><div class="mb-4 col-md-12" id="div_reason" style="display:none"><label class="control-label">Alasan</label><textarea name="reason" class="form-control form-control-lg">'+reason+'</textarea></div></div>';
            
        } else  {
             app = '<div id="modal_detail" class="row"><div class="mb-4 col-md-12"><label class="form-label">Status</label><br><select class"form-select" style="width:100%;height:41px;" name="status" id="status_suspend"><option value="0" selected>Tidak Aktif</option><option value="2">Suspend</option><option value="1">Aktif</option><option value="3" selected>Blokir selamanya</option></select></div><div class="mb-4 col-md-12" id="suspend_tanggal" style="display:none"><label class="control-label">Suspend Sampai Tanggal</label><input type="datetime-local" name="suspend_date_active" class="form-control form-control-lg" value="'+suspend+'" placeholder="" required></div><div class="mb-4 col-md-12" id="div_reason"><label class="control-label">Alasan</label><textarea name="reason" class="form-control form-control-lg">'+reason+'</textarea></div></div>'; 
        }

        $(".modal_aksi").append(app);
        $("#modal_aksi").modal('show');

    });

    $(document).off('change', '#status_suspend').on('change', '#status_suspend', function() {
        val = $("#status_suspend").val();
        if (val == '2') {
            $("#suspend_tanggal").css('display','');
            $("#div_reason").css('display','');
        } else if (val == '1' || val == '0') {
            $("#suspend_tanggal").css('display','none');
            $("#div_reason").css('display','none');

        } else {
            $("#suspend_tanggal").css('display','none');
            $("#div_reason").css('display','');

        }
    });
</script>
