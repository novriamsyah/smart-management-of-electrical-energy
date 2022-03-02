@extends('halaman_template')
@section('css')
<link href="{{ asset('plugins/sweetalert/css/sweetalert.css') }}" rel="stylesheet">
@if(auth()->user()->role == 'admin' || auth()->user()->role == 'kasir')
<style type="text/css">
    #table-pengunjung tr th, #table-pengunjung tr td{
        font-size: 12px;
    }
    #table-pemasukan tr th, #table-pemasukan tr td{
        font-size: 12px;
    }
    .form-control-xs {
        height: calc(1em + .375rem + 2px) !important;
        padding: .125rem .25rem !important;
        font-size: .75rem !important;
        line-height: 1.5;
    }
    .tabel-ket tr th{
        font-size: 12px;
        padding: 5px;
    }
    .res{
        height: 500px !important;
    }
    .resy{
        height: 500px !important;
    }
    .resz{
        height: 500px !important;
    }
</style>
@else
<style type="text/css">
    .laundry-gambar{
        object-fit: cover;
        width: 15rem;
        height: 15rem;
        position: absolute;
        margin-top: -50px;
    }
    .profil-pict{
        object-fit: cover;
        width: 7rem;
        height: 7rem;
    }
    .table_profil tr th, .table_profil tr td{
        padding: 5px;
        font-size: 12px;
    }
    .table_profil tr th{
        width: 100px;
    }
    .tabel-outlet tr th, .tabel-outlet tr td{
        padding: 5px;
        font-size: 12px;
    }
    .tabel-paket tr td{
        padding: 3px;
        font-size: 12px;
    }
    .foto{
        position: relative;
    }
    .upload-btn-wrapper button{
      position: absolute;
      background-color: #7571f9;
      color: #fff;
      top: 15%;
      left: 65%;
      transform: translate(-50%, -50%);
      border: 0px;
      border-radius: 50%;
      padding: 6px 0px;
      line-height: 1.42857;
      width: 25px;
      height: 25px;
      font-size: 10px;
    }
    .ubah_foto_input{
      font-size: 100px;
      position: absolute;
      left: 0;
      top: 0;
      opacity: 0;
      }
      
</style>
@endif
@endsection
@section('konten')
@if(auth()->user()->role == 'admin')
<div class="container-fluid mt-3">        
       
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-1">
                <div class="card-body">
                    <h3 class="card-title text-white">KWh Sisa</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white" id="sisaPulsa">0.00</h2>
                        <p class="text-white mb-0">Dapat Digunakan</p>
                        {{-- <p class="text-white mb-0" id="kwh_tot">0.00</p> --}}
                    </div>
                    <span class="float-right display-7 opacity-7"><i class="fa fa-history"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-4">
                <div class="card-body">
                    <h3 class="card-title text-white">Tegangan</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white" id="tegangan">{{ $tampung->tegangan }} V</h2>
                        <p class="text-white mb-0">Tegangan Realtime</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-power-off"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-9">
                <div class="card-body">
                    <h3 class="card-title text-white">Arus</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white" id="arus">{{ $tampung->arus }} A</h2>
                        <p class="text-white mb-0">Arus Realtime</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-bolt"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-8">
                <div class="card-body">
                    <h3 class="card-title text-white">Power Factor</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white" id="stlh_pf">{{ $tampung->pf_sudah }}</h2>
                        <p class="text-white mb-0"></p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-exclamation"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
      <div class="col-lg-8 col-xs-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-between">
                        <div class="judul" style="width: 100%">
                          <h5> Data Terakhir Penggunaan Daya Aktif</h5>
                          {{-- <img src="{{ asset('gif/livv.gif') }}" width="65" alt=""><h5 style="text-align:center;">7 Data Terakhir Watt Terhadap Waktu</h5> --}}
                        </div>
                        <div class="semua-btn">
                            <a href="{{ url('/laporan_energi') }}">
                            <button class="btn btn-sm font-weight-bold text-dark">Semua Data <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button></a>
                        </div>
                    </div><br><br>
                    <div class="col-md-12 col-xs-12 mt-4">
                        <canvas id="myChartdy" style="width: 80%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"> 7 Data penggunaan daya aktif </h4>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table" id="table-pengunjung" style="width: 100%; font-weight: bold; font-size: 18px;">
                            <thead class="text-center">
                                <tr>
                                    <th>No.</th>
                                    <th>Daya Aktif</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody class="show-tabee" id="tab">
                                {{-- @foreach($suhu_data as $datas)
                                <tr>
                                    <th style="padding-left: 20px;">{{ $loop->iteration }}</th>
                                    <td>{{ $datas->temp }}</td>
                                    @php
                                    \Carbon\Carbon::setLocale('id');
                                    @endphp
                                    <td>{{ Carbon\Carbon::parse($datas->created_at)->diffForHumans()}}</td>
                                </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-between">
                            <div class="judul" style="width: 100%">
                              <h5>Data Terakhir Faktor Daya</h5>

                              {{-- <img src="{{ asset('gif/livv.gif') }}" width="65" alt=""><h5 style="text-align:center;">7 Data Terakhir Watt Power Factor</h5> --}}
                            </div>
                            <div class="semua-btn">
                                <a href="{{ url('/laporan_pf') }}">
                                <button class="btn btn-sm font-weight-bold text-dark">Semua Data <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button></a>
                            </div>
                        </div><br><br>
                        <div class="col-md-12 mt-4">
                            {{-- <canvas id="myChart" style="width: 100%; margin-top: 10px;"></canvas> --}}
                            <canvas id="myChart" style="width:80%;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"> 8 Data Power Faktor Terakhir</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table" id="table-pengunjung" style="width: 100%;font-weight: bold; font-size: 18px;">
                                <thead class="text-center">
                                    <tr>
                                        <th>PF</th>
                                        <th>Perbaikan PF</th>
                                        <th>WAKTU</th>
                                    </tr>
                                </thead>
                                <tbody class="show-suh" id="tab">
                                    {{-- @foreach($suhu_data as $datas)
                                    <tr>
                                        <th style="padding-left: 20px;">{{ $loop->iteration }}</th>
                                        <td>{{ $datas->temp }}</td>
                                        @php
                                        \Carbon\Carbon::setLocale('id');
                                        @endphp
                                        <td>{{ Carbon\Carbon::parse($datas->created_at)->diffForHumans()}}</td>
                                    </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-between">
                            <div class="judul" style="width: 100%">
                              {{-- <img src="{{ asset('gif/livv.gif') }}" width="65" alt=""> --}}
                                <h4> Monitor Daya Realtime</h4>
                                {{-- <p>Total Pemasukan Sejak Awal</p>
                                <h3>Rp. {{ number_format(\App\Struk::sum('harga_bayar'),2,',','.') }}</h3> --}}
                            </div>
                            <div class="semua-btn">
                                <a href="{{ url('/laporan_daya') }}">
                                <button class="btn btn-sm font-weight-bold text-dark">Semua Data <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button></a>
                            </div>
                        </div><br><br>
                        <div class="col-md-12 mt-4">
                            <canvas id="myBarChart" style="width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            
            {{-- @livewire('suhu.index') --}}
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">8 Data Daya Terakhir</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table" id="table-pengunjung" style="width: 100%; font-weight: bold; font-size: 18px;">
                                <thead class="text-center">
                                    <tr>
                                        
                                        <th>P</th>
                                        <th>Q</th>
                                        <th>S</th>
                                        <th>Waktu</th>
                                    </tr>
                                </thead>
                                <tbody id ="show-tabe" class="show-tabe1">
                                    {{-- @foreach($suhu_data as $datas)
                                    <tr>
                                        <th style="padding-left: 20px;">{{ $loop->iteration }}</th>
                                        <td wire:poll>{{ $datas->temp }}</td>
                                        @php
                                        \Carbon\Carbon::setLocale('id');
                                        @endphp
                                        <td>{{ Carbon\Carbon::parse($datas->created_at)->diffForHumans()}}</td>
                                    </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
@section('script')
<style url="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></style>
<script src="{{ asset('plugins/sweetalert/js/sweetalert.min.js') }}"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>

    // Enable pusher logging - don't include this in production
    // Pusher.logToConsole = true;

    var pusher = new Pusher('7085e7a65009a120e03f', {
      cluster: 'ap1',
    });

    var channel = pusher.subscribe('message');
    channel.bind('my-event', function(data) {

      var sPulsa = document.getElementById('sisaPulsa');
      var last_pulsa = parseInt(sPulsa.textContent);
      sPulsa.innerHTML = data.sisa_pulsa;

      // var kwh_ku = document.getElementById('kwh_tot');
      // var last_kwh = parseInt(kwh_ku.textContent);
      // kwh_ku.innerHTML = data.total_kwh + " kWh";

      var teg = document.getElementById('tegangan');
      var last_teg = parseInt(teg.textContent);
      teg.innerHTML = data.tegangan + " V";

      var arus = document.getElementById('arus');
      var last_arus = parseInt(arus.textContent);
      arus.innerHTML = data.arus + " A";

      var pf = document.getElementById('stlh_pf');
      var last_pf = parseInt(pf.textContent);
      pf.innerHTML = data.pf_sudah;

      
      // console.log("berhasil");
      // console.log(data);
    });
  </script>
@if(auth()->user()->role == 'admin' || auth()->user()->role == 'kasir')
<script type="text/javascript">
$(document).ready(function(){
    $('.cari_input_jumlah').on('keyup', function(){
        var searchTerm = $(this).val().toLowerCase();
        $(".isi_tabel_jumlah tr").each(function(){
          var lineStr = $(this).text().toLowerCase();
          if(lineStr.indexOf(searchTerm) == -1){
            $(this).hide();
          }else{
            $(this).show();
          }
        });
    });
    $('.cari_input_pemasukan').on('keyup', function(){
        var searchTerm = $(this).val().toLowerCase();
        $(".isi_tabel_total tr").each(function(){
          var lineStr = $(this).text().toLowerCase();
          if(lineStr.indexOf(searchTerm) == -1){
            $(this).hide();
          }else{
            $(this).show();
          }
        });
    });
    $('.status_jumlah').each(function(){
        var jml_setelah = $(this).closest('tr').next().find('.jumlah_hari').html();
        var jml_sekarang = $(this).closest('td').prev().html();
        var hasil = parseInt(jml_sekarang) - parseInt(jml_setelah);
        if(parseInt(hasil) < 0){
            $(this).html('<i class="fa fa-angle-double-down text-danger down_status" aria-hidden="true"></i>');
        }else if(parseInt(hasil) > 0){
            $(this).html('<i class="fa fa-angle-double-up text-success up_status" aria-hidden="true"></i>');
        }else{
            $(this).html('<b class="text-primary same_status">=</b>');
        }
    });
    $('.status_total').each(function(){
        var jml_setelah = $(this).closest('tr').next().find('.total_pemasukan').attr('data-harga');
        var jml_sekarang = $(this).closest('td').prev().attr('data-harga');
        var hasil = parseInt(jml_sekarang) - parseInt(jml_setelah);
        if(parseInt(hasil) < 0){
            $(this).html('<i class="fa fa-angle-double-down text-danger down_status" aria-hidden="true"></i>');
        }else if(parseInt(hasil) > 0){
            $(this).html('<i class="fa fa-angle-double-up text-success up_status" aria-hidden="true"></i>');
        }else{
            $(this).html('<b class="text-primary same_status">=</b>');
        }
    });
});

(function($) {
    "use strict"

    let ctx1 = document.getElementById("myChartdy");
    ctx1.height = 290;
    var myChart2 = new Chart(ctx1, {
        type: 'line',
        data: {
            labels: [],
            type: 'line',
            defaultFontFamily: 'Montserrat',
            datasets: [{
                data: [],
                label: "Daya Aktif",
                backgroundColor: 'rgba(191, 0, 255, 0.5)',
                pointBorderWidth: 2,
                borderColor: 'rgb(255, 0, 255)',
                datalabels: {
                align: 'start',
                anchor: 'start',
                color: '#000',
                backgroundColor: 'rgba(255, 255, 225, 0.9)',
                borderColor: 'rgb(255, 0, 255)',
                borderRadius: 32,
                borderWidth: 1,
                font: {
                weight: 'bold',
                },
                offset: 1,
                padding: 5,
                textAlign: 'center'
            }
            }]
        },
        options: {
            responsive: !0,
            maintainAspectRatio: false,
           
            scales: {
      xAxes: [{
        ticks: {
            fontSize: 13,
       },
        scaleLabel: {
          display: true,
          labelString: 'Waktu',
          fontSize: 18
          
        }
      }],
        yAxes: [{
          ticks: {
            beginAtZero:true,
            fontSize: 15,
          },
          scaleLabel: { 
          display: true,
          labelString: 'Daya Aktif (Watt)',
          fontSize: 15
        }
        }]
      }
        }
    });
    var updateChart_dy = function() {
    $.ajax({
      type: "GET",
      dataType: "json",
      url: '{{ route('chart_dy') }}',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {

        myChart2.data.labels = data.waktu;
        myChart2.data.datasets[0].data = data.dy;
        myChart2.update();
      },
      error: function(data){
        console.log(data);
      }
    });
  }
  updateChart_dy();
  setInterval(() => {
    updateChart_dy();
  }, 1000);


    


})(jQuery);

(function($) {
    "use strict"

    let ctx = document.getElementById("myChart");
    ctx.height = 320;
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            type: 'line',
            defaultFontFamily: 'Montserrat',
            datasets: [{
              label: 'Power Factor',
              data: [],
              backgroundColor: 'rgba(255, 99, 132, 0.4)',
              borderColor: 'rgb(117, 113, 249)',
              datalabels: {
              align: 'start',
              anchor: 'start',
              backgroundColor: 'rgba(255, 255, 255, 0.8)',
              color: '#000',
              borderRadius: 27,
              borderWidth: 6,
              font: {
                weight: 'bold',
              },
              offset: 1,
              padding: 5,
              textAlign: 'center'
            }
          }, {
              label: 'Perbaikan Power Factor',
              data: [],
              backgroundColor: 'rgba(26, 117, 225, 0.4)',
              borderColor: 'rgb(0, 92, 230)',
              datalabels: {
              align: 'end',
              anchor: 'end',
              backgroundColor: 'rgba(0, 0, 0, 0.4)',
              color: '#fff',
              borderRadius: 27,
              borderWidth: 6,
              font: {
                weight: 'bold',
              },
              offset: 1,
              padding: 4,
              textAlign: 'center'
            }
            }]
        },
        options: {
            responsive: !0,
            maintainAspectRatio: true,
            tooltips: {
                mode: 'index',
                titleFontSize: 12,
                titleFontColor: '#000',
                bodyFontColor: '#000',
                backgroundColor: '#fff',
                titleFontFamily: 'Montserrat',
                bodyFontFamily: 'Montserrat',
                cornerRadius: 3,
                intersect: false,
            },
            legend: {
                display: true,
                position: 'top',
                labels: {
                    usePointStyle: false,
                    fontFamily: 'Montserrat',
                },


            },
            scales: {
                xAxes: [{
                    display: true,
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Waktu'
                    }
                }],
                yAxes: [{
                    display: true,
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Nilai PF'
                    }
                }]
            },
            title: {
                display: true,
            }
        }
    });
      var updateChart = function() {
    $.ajax({
      type: "GET",
      dataType: "json",
      url: '{{ route('chart') }}',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {
        myChart.data.labels = data.waktu;
        myChart.data.datasets[0].data = data.pf;
        myChart.data.datasets[1].data = data.pf_sudah;
        myChart.update();
      },
      error: function(data){
        console.log(data);
      }
    });
  }
    updateChart();
    setInterval(() => {
      updateChart();
    }, 1000);


    


})(jQuery);

// var ctx1 = document.getElementById('myChartdy').getContext('2d');
// var ctx = document.getElementById('myChart').getContext('2d');
var ctx2 = document.getElementById('myBarChart').getContext('2d');

// var myChart2 = new Chart(ctx1, {

//   type: 'line',
//     data: {
//       labels: [],
//       datasets: [{
//         label: 'Daya Aktif',
//         data: [],
//         backgroundColor: 'rgba(191, 0, 255, 0.5)',
//         pointBorderWidth: 2,
//         borderColor: 'rgb(255, 0, 255)',
//         datalabels: {
//         align: 'start',
//         anchor: 'start',
//         color: '#000',
//         borderColor: 'rgb(255, 0, 255)',
//         borderRadius: 32,
//         borderWidth: 1,
//         // formatter: 800,
//         font: {
//           weight: 'bold',
//         },
//         offset: 1,
//         padding: 5,
//         textAlign: 'center'
//       }
      
//       }] 
//     },
//     plugins: [{
//         beforeInit: function(chart, options) {
//         chart.legend.afterFit = function() {
//         this.height = this.height + 20;
//          };
//         }
//     }],
//     options: {
//       responsive: !0,
        
//       plugins: {
//       // Change options for ALL labels of THIS CHART
//       datalabels: {
//         backgroundColor: 'rgba(255, 255, 225, 0.9)',
        
//       },
        
        
//     },
//       scales: {
//       xAxes: [{
//         ticks: {
//             fontSize: 13,
//        },
//         scaleLabel: {
//           display: true,
//           labelString: 'Waktu',
//           fontSize: 18
          
//         }
//       }],
//         yAxes: [{
//           ticks: {
//             beginAtZero:true,
//             fontSize: 15,
//           },
//           scaleLabel: { 
//           display: true,
//           labelString: 'Daya Aktif (Watt)',
//           fontSize: 15
//         }
//         }]
//       }
//     }
//   });
//   var updateChart_dy = function() {
//     $.ajax({
//       type: "GET",
//       dataType: "json",
//       url: '{{ route('chart_dy') }}',
//       headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//       },
//       success: function(data) {


//         // var coloR = [];

//         //  var dynamicColors = function() {
//         //     var r = Math.floor(Math.random() * 255);
//         //     var g = Math.floor(Math.random() * 255);
//         //     var b = Math.floor(Math.random() * 255);
//         //     return "rgb(" + r + "," + g + "," + b + ")";
//         //  };
//         //  for (var i in data) {
//         //     coloR.push(dynamicColors());
//         //  }

//         // console.log(coloR);
//         myChart2.data.labels = data.waktu;
//         myChart2.data.datasets[0].data = data.dy;
//         // myChart2.data.datasets[0].backgroundColor = coloR;
//         myChart2.update();
//       },
//       error: function(data){
//         console.log(data);
//       }
//     });
//   }
//   updateChart_dy();
//   setInterval(() => {
//     updateChart_dy();
//   }, 1000);


// var myChart = new Chart(ctx, {
//     type: 'line',
//     data: {
//       labels: [],
//       datasets: [{
//         label: 'Power Factor',
//         data: [],
//         backgroundColor: 'rgba(255, 99, 132, 0.4)',
//         borderColor: 'rgb(117, 113, 249)',
//         // borderWidth: 1,
//         datalabels: {
//         align: 'start',
//         anchor: 'start',
//         backgroundColor: 'rgba(255, 255, 255, 0.8)',
//         color: '#000',
//         borderRadius: 27,
//         borderWidth: 6,
//         // formatter: 800,
//         font: {
//           weight: 'bold',
//         },
//         offset: 1,
//         padding: 5,
//         textAlign: 'center'
//       }
//       },
//       {
//         label: 'Perbaikan Power Factor',
//         data: [],
//         backgroundColor: 'rgba(26, 117, 225, 0.4)',
//         borderColor: 'rgb(0, 92, 230)',
//         datalabels: {
//         align: 'end',
//         anchor: 'end',
//         backgroundColor: 'rgba(0, 0, 0, 0.4)',
//         color: '#fff',
//         borderRadius: 27,
//         borderWidth: 6,
//         // formatter: 800,
//         font: {
//           weight: 'bold',
//         },
//         offset: 1,
//         padding: 4,
//         textAlign: 'center'
//       }
//       }] 
//     },
//     // plugins: [{
//     //     beforeInit: function(chart, options) {
//     //     chart.legend.afterFit = function() {
//     //     this.height = this.height + 20;
//     //      };
//     //     }
//     //   }],
//     options: { 
//       // responsive: !0, 
//       legend: {
//         // position: 'top',
//         display: true,
//       },
//       scales: {
//         xAxes: [{
//           scaleLabel: {
//           display: true,
//           labelString: 'Waktu',
//           fontSize: 13
          
//         }
//         }],
//         yAxes: [{
//           ticks: {
//             beginAtZero:true
//           },
//           scaleLabel: { 
//           display: true,
//           labelString: 'Power Factor',
//           fontSize: 15
//         }
//         }]
//       }
//     }
//   });
//   var updateChart = function() {
//     $.ajax({
//       type: "GET",
//       dataType: "json",
//       url: '{{ route('chart') }}',
//       headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//       },
//       success: function(data) {
//         myChart.data.labels = data.waktu;
//         myChart.data.datasets[0].data = data.pf;
//         myChart.data.datasets[1].data = data.pf_sudah;
//         myChart.update();
//       },
//       error: function(data){
//         console.log(data);
//       }
//     });
//   }
//   updateChart();
//   setInterval(() => {
//     updateChart();
//   }, 1000);

  var myChart1 = new Chart(ctx2, {
    type: 'pie',
    data: {
      labels: [
          'Daya Aktif',
          'Daya Reaktif',
          'Daya Semu',
        //   'Yellow'
      ],
      datasets: [{
        label: 'coba pie',
        data: [10,20, 10],
        backgroundColor: [
            'rgb(225, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(225, 205, 86)',
        ],
        hoverOffset: 4,
        datalabels: {
        align: 'center',
        // anchor: 'end',
        backgroundColor: 'white',
        color: '#000',
        borderRadius: 50,
        borderWidth: 3,
        font: {
          weight: 'bold',
        },
       
        textAlign: 'center'
      }
      }]
    }
  });
  var updateChart1 = function() {
    $.ajax({
      type: "GET",
      dataType: "json",
      url: '{{ route('chartt') }}',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {
        var pie_aktif = data.aktif['0'];
        var pie_reaktif = data.reaktif['0'];
        var pie_semu = data.semu['0'];
        //   console.log(pie_suhu);

        // myChart1.data.labels = data.waktu;
       var pie_ku =  myChart1.data.datasets[0].data = [pie_aktif, pie_reaktif, pie_semu];
        // myChart1.data.datasets[1].data = data.suhu;
        myChart1.update();
        // console.log(pie_ku);
      },
      error: function(data){
        console.log(data);
      }
    });
  }
  updateChart1();
  setInterval(() => {
    updateChart1();
  }, 1000);

  var updatetab = function() {
    $.ajax({
      type: "GET",
      dataType: "json",
      url: '{{ route('charttt') }}',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {
        //   const tes = data.data.length;
        //   console.log(tes); 
        //   var coba = data.waktu[1];
        //     console.log(coba);


        //   var suhu = data['suhu'];
        //   let mas = "";
        //   suhu.forEach(myFunction);
        //   document.getElementById(#tab).innerHTML = mas;

        //  function myFunction(data) {
        //      mas += "<tr>"+
        //                 "<td>"+ data +"</td>"+
        //             "</tr>";
        //  }
        //   var humi = data['hum'];

        //   var html = '<tr>'+
        //       '<td>'+ suhu +'</td>'+
        //        '<td>'+ hum +'</td>'+
        //        '</tr>';
        //         $('.show-suh').append(html);          
        // var tam = 0;
        

        var html = '';
        var count = 1;
        if(data.data != null) {
            var tam = data.data.length;
            // console.log(tam);
        }
        if(tam>0){
            for(var i=0; i<tam; i++){
                var pf = data.data[i].pf;
                var pf_setelah = data.data[i].pf_sudah;
                var waktu = data.waktu[i];

                html += '<tr>'+
                        // '<td align="center">'+ count++ +'</td>'+
                        '<td align="center">'+ pf +'</td>'+
                        '<td align="center">'+ pf_setelah +'</td>'+
                        '<td align="center">'+ waktu +'</td>'+
                        '</tr>';
            }
            $('.show-suh').html(html);
        // console.log(html);
        }
     
      },
      error: function(data){
        console.log(data);
      }
    });
  }
  updatetab();
  setInterval(() => {
    updatetab();
  }, 1000);

  var updatetabe = function() {
    $.ajax({
      type: "GET",
      dataType: "json",
      url: '{{ route('chartttt') }}',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {
        //   const tes = data.data.length;
        //   console.log(tes); 
        //   var coba = data.waktu[1];
            // console.log(data);       

        var html = '';
        var count = 1;
        if(data.data != null) {
            var tam = data.data.length;
            // console.log(tam);
        }
        if(tam>0){
            for(var i=0; i<tam; i++){
                var aktf = data.data[i].dy_aktif;
                var rktf = data.data[i].dy_reaktif;
                var semu = data.data[i].dy_semu;
                var waktu = data.waktu[i];

                html += '<tr>'+
                        // '<td align="center">'+ count++ +'</td>'+
                        '<td align="center">'+ aktf +'</td>'+
                        '<td align="center">'+ rktf +'</td>'+
                        '<td align="center">'+ semu +'</td>'+
                        '<td align="center">'+ waktu +'</td>'+
                        '</tr>';
            }
            $('#show-tabe').html(html);
        // console.log(html);
        }
      },
      error: function(data){
        console.log(data);
      }
    });
  }
  updatetabe();
  setInterval(() => {
    updatetabe();
  }, 1000);

  var updatetabee = function() {
    $.ajax({
      type: "GET",
      dataType: "json",
      url: '{{ route('chart_wh') }}',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {
        //   const tes = data.data.length;
        //   console.log(tes); 
        //   var coba = data.waktu[1];
            // console.log(data);       

        var html = '';
        var count = 1;
        if(data.data != null) {
            var tam = data.data.length;
            // console.log(tam);
        }
        if(tam>0){
            for(var i=0; i<tam; i++){
                var aktf = data.data[i].dy_aktif;
                var waktu = data.waktu[i];

                html += '<tr>'+
                        '<td align="center">'+ count++ +'</td>'+
                        '<td align="center">'+ aktf +'</td>'+
                        '<td align="center">'+ waktu +'</td>'+
                        '</tr>';
            }
            $('.show-tabee').html(html);
        // console.log(html);
        }
      },
      error: function(data){
        console.log(data);
      }
    });
  }
  updatetabee();
  setInterval(() => {
    updatetabee();
  }, 1000);


</script>
@else
<script type="text/javascript">
(function($) {
  $.fn.inputFilter = function(inputFilter) {
    return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        this.value = "";
      }
    });
  };
}(jQuery));

$(".number_input").inputFilter(function(value) {
  return /^-?\d*$/.test(value); });

$(document).on('click', '.edit_identitas_btn', function(){
    $(this).prop('hidden', true);
    $('.update_identitas_btn').prop('hidden', false);
    $('.data_identitas').prop('hidden', true);
    $('.input_ubah').prop('hidden', false);
    $('.ubah_foto_file').prop('hidden', false);
});

$('.form_edit_identitas').submit(function(e){
    e.preventDefault();
    var request = new FormData(this);
    $.ajax({
        url: "{{ url('/update_profil_pelanggan') }}",
        method: "POST",
        data: request,
        contentType: false,
        cache: false,
        processData: false,
        success:function(data){
            if(data == "sukses"){
                swal({
                    title: "Berhasil!",
                    text: "Profil berhasil diubah",
                    type: "success"
                }, function(){
                    window.open("{{ url('/dashboard') }}", "_self");
                });
            }else{
                $('.edit_identitas_btn').prop('hidden', false);
                $('.update_identitas_btn').prop('hidden', true);
                $('.data_identitas').prop('hidden', false);
                $('.input_ubah').prop('hidden', true);
                $('.ubah_foto_file').prop('hidden', true);
            }
        }
    });
});

$(document).on('click', '.ubah_foto_btn', function(e){
    e.preventDefault();
    $('.ubah_foto_input').click();
});

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('.profil-pict').attr('src', e.target.result);
    }   
    reader.readAsDataURL(input.files[0]);
  }
}

$(".ubah_foto_input").change(function() {
  readURL(this);
});


</script>
@endif
@endsection