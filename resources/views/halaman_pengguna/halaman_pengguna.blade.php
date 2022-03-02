<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="{{ asset('plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/sweetalert/css/sweetalert.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/toastr/css/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="style1.css">

    <title>Hello, world!</title>
  </head>
  {{-- #ffa400 #ffa500 #ffdf00 --}}
  <body style="background: #ffdf00">
    <div class="container-fluid">
    <div class="row">
        <div class="col-8 offset-2">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5"> Tambah Pengguna Baru</h4>
                    <div class="form-validation">
                        <form class="form-valide" action="{{ url('/simpan_pengguna') }}" method="post" enctype="multipart/form-data" name="pengguna_baru_form">
                            @csrf
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-kode-pengguna">Kode Pengguna <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="val-kode-pengguna" name="kd_pengguna" value="{{ $max_code }}" readonly="readonly">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-username">Username <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="val-username" name="username" placeholder="Masukkan username">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-email">Email <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="val-email" name="email" placeholder="Masukkan email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-password">Password <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="val-password" name="password" placeholder="Masukkan password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="val-role">Posisi <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-6">
                                    <select class="form-control" id="val-role" name="role">
                                        <option value="">-- Pilih Posisi --</option>
                                        <option value="admin">Admin</option>
                                        {{-- <option value="kasir">Kasir</option> --}}
                                        <option value="admin_low">User</option>
                                        {{-- <option value="user2">User2</option>
                                        <option value="user3">User3</option> --}}
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-8 ml-auto">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-8 offset-2">
            <div class="card" style="margin-top: 30px">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                    	<h4 class="card-title">Daftar Pengguna</h4>
                    	{{-- <button type="button" class="btn font-weight-bold btn-sm mb-1 btn-primary tambah_pengguna_btn">Tambah Pengguna <span class="btn-icon-right"><i class="fa fa-plus"></i></span></button> --}}
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead style="text-align: center;">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Pengguna</th>
                                    <th>Posisi</th>
                                    <th>Username</th>
                                    <th>Waktu</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $number = 1 ?>
                            	@foreach($penggunas as $pengguna)
                                @if($pengguna->role == 'admin' || $pengguna->role == 'admin_low')
                                <tr>
                                    <th class="align-middle text-center">{{ $number }}</th>
                                    <td class="text-center">{{ $pengguna->kd_pengguna }}</td>
                                    <td>
                                        @if($pengguna->role == 'admin')
                                        <i class="fa fa-circle-o text-success mr-2"></i>
                                        @else
                                        <i class="fa fa-circle-o text-primary mr-2"></i>
                                        @endif
                                        &nbsp;{{ $pengguna->role }}</td>
                                    <td>{{ $pengguna->username }}</td>
                                    <td>{{ $pengguna->created_at }}</td>
                                    <td style="text-align: center;">
                                        <a href="{{ url('/hapus_pengguna/'.$pengguna->id) }}" style="color: red;"><i class="fa fa-trash c-primary" style="font-size: 16px;"></i></a>
                                    </td>
                                </tr>
                                <?php $number++ ?>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="{{ asset('plugins/tables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/tables/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/tables/js/datatable-init/datatable-basic.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('plugins/toastr/js/toastr.min.js') }}"></script>
    <script src="{{ asset('js/jquery.form-validator.min.js') }}"></script>
    <script type="text/javascript">
    
$(function() {
  $("form[name='pengguna_baru_form']").validate({
    rules: {
      nama: "required",
      username: "required",
      email: "required",
      password: {
        required: true,
        minlength: 5
      },
      role: "required"
    },
    messages: {
      nama: "<span style='color: red;'>Nama tidak boleh kosong</span>",
      username: "<span style='color: red;'>Username tidak boleh kosong</span>",
      email: "<span style='color: red;'>Email tidak boleh kosong</span>",
      password: {
        required: "<span style='color: red;'>Password tidak boleh kosong</span>",
        minlength: "<span style='color: red;'>Kata sandi harus lebih dari 5 karakter</span>"
      },
      role: "<span style='color: red;'>Silakan pilih posisi</span>"
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
});
    
    $(document).on('click', '.tambah_pengguna_btn', function(e){
        e.preventDefault();
        var cek_count = $(this).attr('data-count');
        if(parseInt(cek_count) != 0)
        {
            window.open("{{ url('/tambah_pengguna') }}","_self");
        }else{
            outlet_kosong();
        }
    });
    
    function outlet_kosong(){
        toastr.warning("Silakan buat outlet terlebih dahulu","Peringatan !", {
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
    
    @if ($message = Session::get('tersimpan'))
    swal(
        "Berhasil!",
        "{{ $message }}",
        "success"
    );
    @endif
    
    @if ($message = Session::get('terhapus'))
    swal(
        "Berhasil!",
        "{{ $message }}",
        "success"
    );
    @endif
    
    @if ($message = Session::get('terubah'))
    swal(
        "Berhasil!",
        "{{ $message }}",
        "success"
    );
    @endif
    </script>



  </body>
</html>