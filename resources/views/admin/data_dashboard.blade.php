<div class="row">
	   <div class="col-md-3">
		<div class="card card-custom card-stretch gutter-b">
			<!--begin::Header-->
			<div class="card-header border-0 pt-5">
				<h3 class="card-title font-weight-bolder">User Mendaftar</h3>
			</div>
			<div class="card-body d-flex flex-column">
				<div class="flex-grow-1" style="position: relative;">
					<div class="text-center">
						<h1 class="font-weight-bolder">{{$user}}</h1>
					</div>
				</div>
				<!-- <div class="pt-5">
					<p class="text-center font-weight-normal font-size-lg pb-7">Notes: Merupakan User yang pernah mendaftar</p>
				</div> -->
			</div>
			<!--end::Body-->
		</div>
		<!--end::Mixed Widget 14-->
	</div>
	<div class="col-md-3">
		<div class="card card-custom card-stretch gutter-b">
			<!--begin::Header-->
			<div class="card-header border-0 pt-5">
				<h3 class="card-title font-weight-bolder">Jumlah Pasien</h3>
			</div>
			<div class="card-body d-flex flex-column">
				<div class="flex-grow-1" style="position: relative;">
					<div class="text-center">
						<h1 class="font-weight-bolder">{{$pasien}}</h1>
					</div>
				</div>
				<!-- <div class="pt-5">
					<p class="text-center font-weight-normal font-size-lg pb-7">Notes: Merupakan jumlah pasien yang pernah memesan</p>
				</div> -->
			</div>
			<!--end::Body-->
		</div>
		<!--end::Mixed Widget 14-->
	</div>
	<div class="col-md-3">
		<div class="card card-custom card-stretch gutter-b">
			<!--begin::Header-->
			<div class="card-header border-0 pt-5">
				<h3 class="card-title font-weight-bolder">Jumlah Transaksi</h3>
			</div>
			<div class="card-body d-flex flex-column">
				<div class="flex-grow-1" style="position: relative;">
					<div class="text-center">
						<h1 class="font-weight-bolder">{{$jumlah_transaksi}}</h1>
					</div>
				</div>
				<!-- <div class="pt-5">
					<p class="text-center font-weight-normal font-size-lg pb-7">Notes: Merupakan jumlah transaksi yang pernah terjadi</p>
				</div> -->
			</div>
			<!--end::Body-->
		</div>
		<!--end::Mixed Widget 14-->
	</div>
	<div class="col-md-3">
		<div class="card card-custom card-stretch gutter-b">
			<!--begin::Header-->
			<div class="card-header border-0 pt-5">
				<h3 class="card-title font-weight-bolder">Transaksi Terbayar</h3>
			</div>
			<div class="card-body d-flex flex-column">
				<div class="flex-grow-1" style="position: relative;">
					<div class="text-center">
						<h1 class="font-weight-bolder">Rp. {{ number_format($terbayar) }}</h1>
					</div>
				</div>
				<!-- <div class="pt-5">
					<p class="text-center font-weight-normal font-size-lg pb-7">Notes: Merupakan jumlah transaksi yang sudah terbayar</p>
				</div> -->
			</div>
			<!--end::Body-->
		</div>
		<!--end::Mixed Widget 14-->
	</div>

	<div class="col-md-6">
        <div id="container_pendidikan"></div>
	</div>
	<div class="col-md-6">
        <div id="bar_transaksi"></div>
	</div>
	<div class="col-md-6 mt-5">
        <div id="bar_user"></div>
	</div>
	<div class="col-md-6 mt-5">
        <div id="bar_pasien"></div>
	</div>

    
     <div class="col-md-12 mt-5">
        <!--begin::List Widget 9-->
	        <div class="card card-custom card-stretch gutter-b">
	            <!--begin::Header-->
	            <div class="card-header align-items-center border-0 row">
	                <div class="col-md-4">
	                    <h5 class="text-dark font-weight-bold ml-3"><spaan>Jadwal</spaan></h5> 
	                </div>
	                <div class="col-md-4 pl-0">
	                </div>
	                <div class="col-md-2">
	                    
	                </div>
	            </div>
	            <!--end::Header-->
	            <!--begin::Body-->
	            <div class="card-body" style="margin-top: -25px;">
	                <section id="basic-datatable">

	                	<div class="row mb-2">
							<div class="col-md-5">
								<label class="label-control">
									Dari tanggal
								</label>
								<input type="date" name="start" id="awal" class="form-control form-control-lg" value="{{$start}}">
							</div>
							<div class="col-md-5">
								<label class="label-control">
									Sampai tanggal
								</label>
								<input type="date" name="end" id="akhir" class="form-control form-control-lg" value="{{$end}}">
							</div>
				            <div class="col-md-2">
				                <button style="padding: 12px;margin-top: 25px;" type="button" id="FilterDashTabel" class="btn btn-success btn-block"><i class="fas fa-filter"></i> FILTER</button>
				            </div>
						</div>
						<hr>
	                    <div class="row">
	                        <div class="col-12">
	                            <div class="card">
	                                <!-- <div class="card-header">
	                                    <h4 class="card-title">List Admin</h4>
	                                </div> -->
	                                <div class="card-content">
	                                    <div class="card-body card-dashboard">
	                                        
	                                        <div class="table-responsive">
	                                            <table class="table zero-configuration" id="data_tabel">
	                                                <thead>
	                                                    <tr>
	                                                        <th>No</th>
	                                                        <th>Pasien</th>
	                                                        <th>Cabang</th>
	                                                        <th>Tanggal</th>
	                                                        <th>Jam</th>
	                                                        <th>No Urut</th>
	                                                        <th>Status</th>
	                                                    </tr>
	                                                </thead>
	                                            </table>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </section>
	            </div>
	            <!--end: Card Body-->
	        </div>
	        <!--end: Card-->
	        <!--end: List Widget 9-->
	        <!-- </div> -->
	    </div>

</div>

<script type="text/javascript">

	$(document).off('click', '#FilterDashTabel').on('click', '#FilterDashTabel', function() {
	    // ChangeDashboard();
	    data_tabel('data_schedule_pasien')
	});

	$(function() {
	    data_tabel('data_schedule_pasien')
	});

	function data_tabel(tabel) {

	    var tgl_start = $("#awal").val();
	    var akhir = $("#akhir").val();
	   
	    
	    if (tabel == 'data_schedule_pasien') {
	        var xin_table = $('#data_tabel').DataTable({
	            "processing": true,
	            "serverSide": true,
	            "orderable": false,
	            "targets": 'no-sort',
	            "bSort": false,
	            "bFilter": false,
	            "ajax": {
	                "url": '/data_schedule_pasien_dasboard',
	                "dataType": "json",
	                "type": "POST",
	                "data": { _token: "{{csrf_token()}}",tgl_start : tgl_start,akhir:akhir }
	            },
	            "columns": columns,
	            "bDestroy": true
	        });
	        $("#data_tabel_length").remove();
	    }
	    
	}

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
	    { "data": "pasien" },
	    { "data": "cabang" },
	    { "data": "date" },
	    { "data": "time" },
	    { "data": "no_urut" },
	    { "data": "status" },
	];
	
	Highcharts.chart('container_pendidikan', {
	    chart: {
	        plotBackgroundColor: null,
	        plotBorderWidth: null,
	        plotShadow: false,
	        type: 'pie'
	    },
	    title: {
	        text: 'Jenis Kelamin Pasien'
	    },
	    subtitle :{
	        text : 'Grafik jenis kelamin pasien'
	    },
	    tooltip: {
	        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
	    },
	    accessibility: {
	        point: {
	            valueSuffix: '%'
	        }
	    },
	    export :true,
	    plotOptions: {
	        pie: {
	            allowPointSelect: true,
	            cursor: 'pointer',
	            dataLabels: {
	                enabled: true,
	                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
	                connectorColor: 'silver'
	            }
	        }
	    },
	    series: [{
	        name: 'Jenis Kelamin',
	        data: [
	            { name: 'Laki Laki', y: <?php echo json_encode($jk_l) ?> },
	            { name: 'Perempuan', y:  <?php echo json_encode($jk_p) ?> },
	        ]
	    }]
	});


	Highcharts.chart('bar_transaksi', {
	    chart: {
	        type: 'column'
	    },
	    title: {
	        text: 'Transaksi'
	    },
	    subtitle: {
	        text: 'Cart Transaksi'
	    },
	    xAxis: {
	        categories: <?php echo json_encode($month) ?>,
	        crosshair: true
	    },
	    yAxis: {
	        min: 0,
	        title: {
	            text: 'Rainfall (mm)'
	        }
	    },
	    tooltip: {
	        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
	        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
	            '<td style="padding:0"><b>{point.y:.1f} Transaksi</b></td></tr>',
	        footerFormat: '</table>',
	        shared: true,
	        useHTML: true
	    },
	    plotOptions: {
	        column: {
	            pointPadding: 0.2,
	            borderWidth: 0
	        }
	    },
	    series: [{
	        name: 'Jumlah Transaksi',
	        data:  <?php echo json_encode($penjualan) ?>

	    }, 
	    // {
	    //     name: 'Nominal Transaksi',
	    //     data:  <?php echo json_encode($nominal) ?>

	    // }
	    ]
	});


	Highcharts.chart('bar_user', {
	    chart: {
	        type: 'column'
	    },
	    title: {
	        text: 'User'
	    },
	    subtitle: {
	        text: 'Cart User Registrasi'
	    },
	    xAxis: {
	        categories: <?php echo json_encode($month) ?>,
	        crosshair: true
	    },
	    yAxis: {
	        min: 0,
	        title: {
	            text: 'Rainfall (mm)'
	        }
	    },
	    tooltip: {
	        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
	        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
	            '<td style="padding:0"><b>{point.y:.1f} User</b></td></tr>',
	        footerFormat: '</table>',
	        shared: true,
	        useHTML: true
	    },
	    plotOptions: {
	        column: {
	            pointPadding: 0.2,
	            borderWidth: 0
	        }
	    },
	    series: [{
	        name: 'Jumlah User',
	        data:  <?php echo json_encode($user_all) ?>

	    }]
	});

	Highcharts.chart('bar_pasien', {
	    chart: {
	        type: 'column'
	    },
	    title: {
	        text: 'Pasien'
	    },
	    subtitle: {
	        text: 'Cart Pasien Registrasi'
	    },
	    xAxis: {
	        categories: <?php echo json_encode($month) ?>,
	        crosshair: true
	    },
	    yAxis: {
	        min: 0,
	        title: {
	            text: 'Rainfall (mm)'
	        }
	    },
	    tooltip: {
	        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
	        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
	            '<td style="padding:0"><b>{point.y:.1f} Pasien</b></td></tr>',
	        footerFormat: '</table>',
	        shared: true,
	        useHTML: true
	    },
	    plotOptions: {
	        column: {
	            pointPadding: 0.2,
	            borderWidth: 0
	        }
	    },
	    series: [{
	        name: 'Jumlah Pasien',
	        data:  <?php echo json_encode($pasien_all) ?>

	    }]
	});


</script>