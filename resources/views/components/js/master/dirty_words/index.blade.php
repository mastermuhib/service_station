<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/buttons.print.min.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
<script src="{{URL::asset('assets')}}/js/scripts/datatables/datatable.js"></script>
<script src="{{URL::asset('assets')}}/vendors/js/forms/select/select2.full.min.js"></script>
<script src="{{URL::asset('assets')}}/js/scripts/forms/select/form-select2.js"></script>
<script src="{{URL::asset('assets')}}/js/ckeditor.js"></script>
<script src="{{URL::asset('assets')}}/js/validate.js"></script>
<script src="{{URL::asset('assets')}}/js/additional-method.js"></script>
<script type="text/javascript">
    $(function() {
        //$('#myTable').DataTable();
        $(".select2-container--default").css('width', '100%');
        data_tabel('data_master_country');
        
    });

    function data_tabel(tabel){
        var xin_table = $('#myTable').DataTable({
            "bDestroy": true,
            "ajax": {
                url: "/"+tabel,
                type: 'GET'
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
            
            $.ajax({ //line 28
                type: 'POST',
                url: '/post_master_country',
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
                        $("#message").remove();
                        show_toast(data.message, 1);
                        data_tabel('data_master_country');
                    } else {
                        alert("maaf ada yang salah!!!");
                    }
                    CKEDITOR.instances.description.setData(''); // ckeditor reset
                }
            });
        }
    });
    // batalkan edit
    $(document).off('click', '#batalkan3').on('click', '#batalkan3', function() {

        $("#titel_head").remove();
        $("#head_modul").append('<span id="titel_head">Tambah Data Country</span>');
        $("#hide_add").css('display', '');
        $("#show_edit").css('display', 'none');
    });
</script>