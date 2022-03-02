<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/toastr/css/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/clockpicker/dist/jquery-clockpicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/jquery-asColorPicker-master/css/asColorPicker.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.css">
    <title>yutub</title>
</head>
<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="card-title">Daftar Laporan Daya</h4>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <form class="filter_form" target="_blank" action="{{ url('/pdf') }}" method="POST">
                                    @csrf
                                    <input type="text" name="check_button" class="check_button" hidden="">
                                    <div class="form-row align-items-center">
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <input id="semua_check" name="check_semua" type="checkbox" checked="" value="1">
                                                        <label for="semua_check" class="form-check-label">&nbsp;Semua</label>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control datepicker-autoclose" name="start_date" placeholder="mm/dd/yyyy" disabled="" autocomplete="off">
                                                <input type="text" class="form-control datepicker-autoclose" name="end_date" placeholder="mm/dd/yyyy" disabled="" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn mb-1 btn-primary btn-block btn-flat font-weight-bold filter_laporan_btn"><i class="fa fa-filter"></i>&nbsp;&nbsp;Filter</button>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn mb-1 btn-danger btn-block btn-flat font-weight-bold pdf_laporan_btn"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;PDF</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-12">
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead style="text-align: center;">
                                            <tr>
                                                <th>No</th>
                                                <th>Tegangan</th>
                                                <th>Arus</th>
                                                <th>Daya</th>
                                                <th>Energi</th>
                                                <th>Waktu</th>
                                            </tr>
                                        </thead>
                                        <tbody class="isi_tabel">
                                            <?php $number = 1; ?>
                                            @foreach($data as $transaksi)
                                            <tr>
                                                <th class="align-middle text-center">{{ $number }}</th>
                                                <th class="align-middle text-center">{{ $transaksi->tegangan }}</th>
                                                <td class="align-middle text-center">{{ $transaksi->arus }}</td>
                                                <td class="align-middle text-center">{{ $transaksi->dy_aktif }}</td>
                                                <td class="align-middle text-center">{{ $transaksi->Energi }}</td>
                                                <td class="align-middle text-center">{{ $transaksi->created_at }}</td>
                                            </tr>
                                            <?php $number++; ?>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('plugins/common/common.min.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <script src="{{ asset('js/gleek.js') }}"></script>
    <script src="{{ asset('js/styleSwitcher.js') }}"></script>
    <script src="{{ asset('plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('plugins/d3v3/index.js') }}"></script>
    <script src="{{ asset('plugins/topojson/topojson.min.js') }}"></script>
    <script src="{{ asset('plugins/datamaps/datamaps.world.min.js') }}"></script>
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/pg-calendar/js/pignose.calendar.min.js') }}"></script>
    <script src="{{ asset('plugins/tables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/tables/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/tables/js/datatable-init/datatable-basic.min.js') }}"></script>
    <script src="{{ asset('plugins/toastr/js/toastr.min.js') }}"></script>
    <script src="{{ asset('js/moment.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
    <script src="{{ asset('plugins/clockpicker/dist/jquery-clockpicker.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-asColorPicker-master/libs/jquery-asColor.js') }}"></script>
    <script src="{{ asset('plugins/jquery-asColorPicker-master/libs/jquery-asGradient.js') }}"></script>
    <script src="{{ asset('plugins/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/plugins-init/form-pickers-init.js') }}"></script>
<script type="text/javascript">

$(document).on('click', '#semua_check', function(){
		if(this.checked == true){
	        $(this).val('1');
	        $('.datepicker-autoclose').prop('disabled', true);
	        $('.datepicker-autoclose').val('');
	        $('.check_button').val('filter');
			$('.filter_form').submit();
	    }else{
	        $(this).val('0');
	        $('.datepicker-autoclose').prop('disabled', false);
	    }
	});

	$(document).on('click', '.filter_laporan_btn', function(){
		var start_date = $('input[name=start_date]').val();
		// console.log(start_date);
		var end_date = $('input[name=end_date]').val();
		// console.log(start_date);
		if((start_date != '' && end_date != '') || $('#semua_check').val() == '1'){
			$('.check_button').val('filter');
			$('.filter_form').submit();
		}else if(start_date == '' && end_date == ''){
			tanggalKosong("Tanggal awal dan akhir tidak boleh kosong");
		}else if(start_date == ''){
			tanggalKosong("Tanggal awal tidak boleh kosong");
		}else{
			tanggalKosong("Tanggal akhir tidak boleh kosong");
		}
	});

	$(document).on('click', '.pdf_laporan_btn', function(){
		var start_date = $('input[name=start_date]').val();
		var end_date = $('input[name=end_date]').val();
		if((start_date != '' && end_date != '') || $('#semua_check').val() == '1'){
			$('.check_button').val('cetak_pdf');
			$('.filter_form').submit();
		}else if(start_date == '' && end_date == ''){
			tanggalKosong("Tanggal awal dan akhir tidak boleh kosong");
		}else if(start_date == ''){
			tanggalKosong("Tanggal awal tidak boleh kosong");
		}else{
			tanggalKosong("Tanggal akhir tidak boleh kosong");
		}
	});

	function tanggalKosong(keterangan){
		toastr.warning(keterangan, "Peringatan!", {
		    timeOut:5e3,
		    closeButton:!0,
		    debug:!1,
		    newestOnTop:!0,
		    progressBar:!0,
		    positionClass:"toast-bottom-right",
		    preventDuplicates:!0,
		    onclick:null,
		    showDuration:"300",
		    hideDuration:"1000",
		    extendedTimeOut:"1000",
		    showEasing:"swing",
		    hideEasing:"linear",
		    showMethod:"fadeIn",
		    hideMethod:"fadeOut",
		    tapToDismiss:!1
		});
	}

	$('.filter_form').submit(function(e){
		var check_button = $('.check_button').val();
		if(check_button == 'filter'){
			e.preventDefault();
			var request = new FormData(this);
			$.ajax({
				url: "{{ url('/filter_laporan') }}",
				method: "POST",
				data: request,
				contentType: false,
				processData: false,
				success:function(data){
					$('.isi_tabel').html(data);
					// console.log(data);
				}
			});
		}
	});
</script>



</body>
</html>

