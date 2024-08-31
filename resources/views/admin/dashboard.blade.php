@extends('layout.app')
@section('asset')
<link rel="stylesheet" type="text/css" href="{{URL::asset('assets')}}/vendors/css/forms/select/select2.min.css">
<link rel="stylesheet" type="text/css" href="{{URL::asset('assets')}}/jqvmap.css">

@endsection
@section('title', 'Dashboard')

@section('content')
<div class="accordion accordion-solid accordion-panel accordion-svg-toggle mb-4 mt-0" id="faq">
    <div class="card card-custom mt-0 mb-3" data-card="true">
        <div class="card-header row">
            <div class="card-title col-10 mb-0">
                <h3 class="card-label">Menu Dashboard</h3>
            </div>
            <div class="card-toolbar col-2" style="text-align: right;">
                <a href="#" class="btn btn-icon btn-circle btn-sm btn-light-primary mr-1" data-card-tool="toggle">
                    <i class="ki ki-arrow-down icon-nm"></i>
                </a>
            </div>
        </div>
        <div class="card-body p-4 pb-0">
            <div class="row">
                <div class="col-md-2 col-4 mb-2 pr-1 pl-2">
                    <!--begin::Stats Widget 18-->
                    <div class="card bg-info card-stretch gutter-b p-2 p_pointer tab" id="tab_rekap" onclick="Move('rekap','Data Rekap')">
                        <div class="text-center">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-30 symbol-light-primary mr-2">
                                
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Text-->
                            <div class="d-flex flex-column font-weight-bold">
                                <a href="#" class="text-white text-hover-primary mb-1 font-size-sm">Data Rekap</a>
                                
                            </div>
                            <!--end::Text-->
                        </div>
                    </div>
                    <!--end::Stats Widget 18-->
                </div>
                <div class="col-md-2 col-6 mb-2 pr-1 pl-2">
                    <!--begin::Stats Widget 18-->
                    <div class="card bg-success card-stretch gutter-b p-2 p_pointer tab" id="tab_ppob" onclick="Move('ppob','Data PPOB')">
                        <div class="text-center">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-30 symbol-light-primary mr-2"> 
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Text-->
                            <div class="d-flex flex-column font-weight-bold">
                                <a href="#" class="text-white text-hover-primary mb-1 font-size-sm">Data PPOB</a> 
                            </div>
                            <!--end::Text-->
                        </div>
                    </div>
                    <!--end::Stats Widget 18-->
                </div>
                <div class="col-md-2 col-6 mb-2 pr-1 pl-2">
                    <!--begin::Stats Widget 18-->
                    <div class="card bg-success card-stretch gutter-b p-2 p_pointer tab" id="tab_jasa" onclick="Move('jasa','Data Jasa')">
                        <div class="text-center">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-30 symbol-light-primary mr-2"> 
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Text-->
                            <div class="d-flex flex-column font-weight-bold">
                                <a href="#" class="text-white text-hover-primary mb-1 font-size-sm">Data Jasa</a>
                            </div>
                            <!--end::Text-->
                        </div>
                    </div>
                    <!--end::Stats Widget 18-->
                </div>
                <div class="col-md-2 col-6 mb-2 pr-1 pl-2">
                    <!--begin::Stats Widget 18-->
                    <div class="card bg-success card-stretch gutter-b p-2 p_pointer tab" id="tab_shop" onclick="Move('shop','Statistik Toko')">
                        <div class="text-center">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-30 symbol-light-primary mr-2">
                                
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Text-->
                            <div class="d-flex flex-column font-weight-bold">
                                <a href="#" class="text-white text-hover-primary mb-1 font-size-sm">Statistik Toko</a>
                                
                            </div>
                            <!--end::Text-->
                        </div>
                    </div>
                    <!--end::Stats Widget 18-->
                </div>
                <div class="col-md-2 col-6 mb-2 pr-1 pl-2">
                    <!--begin::Stats Widget 18-->
                    <div class="card bg-success card-stretch gutter-b p-2 p_pointer tab" id="tab_perform" onclick="Move('perform','Performa Gerai')">
                        <div class="text-center">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-30 symbol-light-primary mr-2">
                                
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Text-->
                            <div class="d-flex flex-column font-weight-bold">
                                <a href="#" class="text-white text-hover-primary mb-1 font-size-sm">Performa Gerai</a>
                                
                            </div>
                            <!--end::Text-->
                        </div>
                    </div>
                    <!--end::Stats Widget 18-->
                </div>
                <div class="col-md-2 col-4 mb-2 pr-1 pl-2">
                    <!--begin::Stats Widget 18-->
                    <div class="card bg-success card-stretch gutter-b p-2 p_pointer tab" id="tab_cancel" onclick="Move('cancel','Pembatalan Pesanan')">
                        <div class="text-center">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-30 symbol-light-primary mr-2">
                                
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Text-->
                            <div class="d-flex flex-column font-weight-bold">
                                <a href="#" class="text-white text-hover-primary mb-1 font-size-sm">Pembatalan Pesanan</a>
                                
                            </div>
                            <!--end::Text-->
                        </div>
                    </div>
                    <!--end::Stats Widget 18-->
                </div>
                <div class="col-md-2 col-4 mb-2 pr-1 pl-2">
                    <!--begin::Stats Widget 18-->
                    <div class="card bg-success card-stretch gutter-b p-2 p_pointer tab" id="tab_customer" onclick="Move('customer','Statistik Pelanggan')">
                        <div class="text-center">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-30 symbol-light-primary mr-2">
                                
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Text-->
                            <div class="d-flex flex-column font-weight-bold">
                                <a href="#" class="text-white text-hover-primary mb-1 font-size-sm">Statistik Pelanggan</a>
                                
                            </div>
                            <!--end::Text-->
                        </div>
                    </div>
                    <!--end::Stats Widget 18-->
                </div>
                <div class="col-md-2 col-4 mb-2 pr-1 pl-2">
                    <!--begin::Stats Widget 18-->
                    <div class="card bg-success card-stretch gutter-b p-2 p_pointer tab" id="tab_live" onclick="Move('live','Statistik Live')">
                        <div class="text-center">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-30 symbol-light-primary mr-2">
                                
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Text-->
                            <div class="d-flex flex-column font-weight-bold">
                                <a href="#" class="text-white text-hover-primary mb-1 font-size-sm">Statistik Live</a>
                                
                            </div>
                            <!--end::Text-->
                        </div>
                    </div>
                    <!--end::Stats Widget 18-->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3 col-6">
        <h4 id="the_title">Data Rekap</h4>
        <input type="hidden" name="tab" id="tab" value="rekap">
    </div>
    <div class="col-md-3 col-3">
        <input type="date" class="form-control" name="start_date" id="start_date" onchange="Filter()" value="{{ $start }}">
    </div>
    <div class="col-md-3 col-3">
        <input type="date" class="form-control" name="end_date" id="end_date" onchange="Filter()" value="{{ $end }}">
    </div>
</div>
<div id="isi_html" class="tab-content tabcontent-border mt-4 row">

            
</div>
@include('components/componen_js')
<script type="text/javascript">
    //show_toast("hore",1);
    $(function() {
    //$('#myTable').DataTable();
        $(".select2-container--default").css('width', '100%');
        ChangeDashboard('rekap');
    });

    function Move(id,text){
        $(".tab").addClass('bg-success');
        $(".tab").removeClass('bg-info');
        // $(".tab").css('border-bottom','none');
        $("#tab_"+id).removeClass('bg-success');
        $("#tab_"+id).addClass('bg-info');
        // $("#tab_"+id).css('border-bottom','1.5px solid #019E47');
        $("#the_title").html(text);
        $("#tab").val(id);
        ChangeDashboard(id)
    }

    function ShowModalStatistic(type,start,end,title){
        $("#body_statistic").html('<div class="text-center"><h2 class="text-success">Loading..............</h2></div>');
        $("#title_statistic").html(title);
        $("#modalStatistic").modal('show');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({ //line 28
            type    : 'POST',
            url     : '/get_statistic',
            data    : { type:type,start_date:start,end_date:end },
            dataType: 'html',
            success: function(data) {
                //alert("cuuk");
                $("#body_statistic").html(data);
            }
        });

    }

    function Filter(){
        $('#isi_html').html('<div class="text-center p-10"><h3 class="text-success">Loading.....</h3></div>');
        start_date = $("#start_date").val();
        end_date   = $("#end_date").val();
        if(Date.parse(end_date) < Date.parse(start_date)){
            show_toast("Tanggal akhir harus lebih besar, silahkan ubah tanggal dulu", 0);
        } else {

            const oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
            date1 = start_date.split('-');
            date2 = end_date.split('-');

            // Now we convert the array to a Date object, which has several helpful methods
            const firstDate = new Date(date1[0], date1[1], date1[2]);
            const secondDate = new Date(date2[0], date2[1], date2[2]);

            const diffDays = Math.round(Math.abs((firstDate - secondDate) / oneDay));
            if (diffDays > 45) {
                show_toast("Maksimal 45 hari, silahkan ubah tanggal dulu", 0);
            } else {
                id = $("#tab").val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({ //line 28
                    type    : 'POST',
                    url     : '/get_dashboard',
                    data    : { id:id,start_date:start_date,end_date:end_date },
                    dataType: 'html',
                    success: function(data) {
                        //alert("cuuk");
                        $("#isi_html").html(data);
                    }
                });
            }
        }

    }

    function ChangeDashboard(id){
      //if(is_admin != 2) {
        $('#isi_html').html('<div class="text-center p-10"><h3 class="text-success">Loading.....</h3></div>');
        start_date = $("#start_date").val();
        end_date   = $("#end_date").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({ //line 28
            type    : 'POST',
            url     : '/get_dashboard',
            data    : { id:id,start_date:start_date,end_date:end_date },
            dataType: 'html',
            success: function(data) {
                //alert("cuuk");
                $("#isi_html").html(data);
            }
        });
      //}
    }
</script>
@endsection