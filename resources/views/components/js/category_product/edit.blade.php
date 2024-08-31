<script src="{{URL::asset('assets')}}/vendors/js/forms/select/select2.full.min.js"></script>
<script src="{{URL::asset('assets')}}/js/scripts/forms/select/form-select2.js"></script>
<script src="{{URL::asset('assets')}}/js/validate.js"></script>
<script src="{{URL::asset('assets')}}/js/additional-method.js"></script>
<script type="text/javascript">

$(function() {
    $(".select2-container--default").css('width', '100%');
    data_table();
});

function ChangeIcon(input) {
    //alert("okey");
    if (input.files && input.files[0]) {
        $("#icon").css('display', '');
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#icon')
                .attr('src', e.target.result)
                .css('width', '200px')
                .css('height', '200px')
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function DeleteBanner(id){
    $("#btn_delete_banner").attr('no',id);
    $("#modal_delete_banner").modal('show');
}

function DelBan(){
    id = $("#btn_delete_banner").attr('no');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({ //line 28
        type: 'POST',
        url: '/delete_banner',
        dataType: 'json',
        data: {id:id },
        success: function(data) {  
            if (data.code == 200) {
                show_toast(data.message, 1);
                $("#banner_"+id).remove();
            } else {
                show_toast(data.message, 0);
            }
        }
    });
}

function ChangeBanner(input,id) {
    //alert("okey");
    if (input.files && input.files[0]) {
        $("#icon"+id).css('display', '');
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#icon'+id)
                .attr('src', e.target.result)
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function AddBanner(){
    var max = 0;
        $('.banner').each(function() {
          var value = parseInt($(this).data('no'));
          max = (value > max) ? value : max;
        });
    nomor = max + 1;
    $.ajax({
    url: '/add_banner/'+nomor,
    type: "GET",
    success: function(response) {
        $("#div_banner").append(response);
        
        }
    }); 
}

$("#form_edit").validate({
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
            url: '/update/category_product',
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
function data_table(tabel) {
    var search = $("#search").val();
    var sort   = $("#sort").val();
    var id_category = $("#id_category").val();
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
        data: { search:search,sort:sort,id_category4:id_category,start:start },
        success: function(data) {  
            $("#body_product").html(data);
        }
    });   
}

function ChangeMaster() {
    // alert(country_id)
    id = $("#select_master").val();
    $.ajax({
        type: 'GET',
        url: '/get_master_category/'+id,
        dataType: 'json',
        success: function(data) {
            console.log(data)
            $("#select_sub").empty();
            $("#select_sub").append("<option value=''>Pilih Sub Kategori 1</option>");
            $("#select_sub_sub").empty();
            $("#select_sub_sub").append("<option value=''>Pilih Sub Kategori 2</option>");
            for (let i = 0; i < data.length; i++) {
                $("#select_sub").append("<option value=" + data[i].id + ">" + data[i].name + "</option>");
            }
        },
        error: function(data) {
            console.log(data);
        }
    });
}

function ChangeSub() {
    // alert(country_id)
    id = $("#select_sub").val();
    $.ajax({
        type: 'GET',
        url: '/get_sub_category/'+id,
        dataType: 'json',
        success: function(data) {
            console.log(data)
            $("#select_sub_sub").empty();
            $("#select_sub_sub").append("<option value=''>Pilih Sub Kategori 2</option>");
            for (let i = 0; i < data.length; i++) {
                $("#select_sub_sub").append("<option value=" + data[i].id + ">" + data[i].name + "</option>");
            }
        },
        error: function(data) {
            console.log(data);
        }
    });
}
</script>