<script src="{{URL::asset('assets')}}/vendors/js/forms/select/select2.full.min.js"></script>
<script src="{{URL::asset('assets')}}/js/scripts/forms/select/form-select2.js"></script>
<script src="{{URL::asset('assets')}}/js/validate.js"></script>
<script src="{{URL::asset('assets')}}/js/additional-method.js"></script>
<script type="text/javascript">

$(function() {
    $(".select2-container--default").css('width', '100%');
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

function ChangeImage(input) {
    //alert("okey");
    if (input.files && input.files[0]) {
        $("#image").css('display', '');
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#image')
                .attr('src', e.target.result)
                .css('width', '200px')
                .css('height', '200px')
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function Official(){
    $("#div_product").html('');
    $("#div_hasil").html('');
}

function ChangeBackground(input) {
    //alert("okey");
    if (input.files && input.files[0]) {
        $("#background").css('display', '');
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#background')
                .attr('src', e.target.result)
                .css('width', '200px')
                .css('height', '200px')
        };

        reader.readAsDataURL(input.files[0]);
    }
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
            url: '/update/group_product',
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

$("#search_name").keyup(function(){
   text = $("#search_name").val();
   is_gerai = $("#is_gerai_official").val();
    if ( text.length > 2 ){
        $("#div_product").html('');
        $("#loading_searching").css('display','');
        $.ajax({
            url: '/search_product/'+text+'/'+is_gerai,
            type: "GET",
            success: function(response) {
                console.log(response);
                if (response) {
                    $("#div_product").html(response);
                    $("#loading_searching").css('display','none');
                }
            }
        });
    }
});

$(document).off('click', '.click_product').on('click', '.click_product', function() { 
    id           = $(this).attr('no');
    $('#click_product'+id).clone().appendTo('#div_hasil');
    $('#div_product #click_product'+id).remove();
    $("#action"+id).append('<div class="info text-center"><a href="javascript:void(0)" class="btn btn-sm font-sm btn-light rounded delete_item" no="'+id+'"> <i class="material-icons md-delete_forever"></i> Delete </a><input type="hidden" name="product[]" value="'+id+'"></div>')
});

$(document).off('click', '.delete_item').on('click', '.delete_item', function() { 
    id = $(this).attr('no');
    $('#div_hasil #click_product'+id).remove();
});
</script>