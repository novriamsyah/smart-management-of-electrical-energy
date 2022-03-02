<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.css">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>yutub</title>
  </head>
  
  <body>
    <div class="container-fluid atas">
        <div class="row" style="margin:0; padding: 10px;">
          <div class="col-4">
              <div class="logo">
                  <button type="button" class="btn btn-warning">LOGO 1</button>
                  <button type="button" class="btn btn-info">LOGO 2</button>
              </div>
          </div>
          <div class="col-4">
              <div class="judul" style="color: rgb(3, 126, 3);">
                  <h1>PZEM Energi Listrik</h1>
              </div>
          </div>
      </div>
            
      <div class="row justify-content-between" style="margin:0;">
          <div class="col-7">
              <div class="grap">
                <div class="card">
                  <div class="card-body">
                      <canvas id="myChart4" class="chart"></canvas>
                  </div>
                </div>
              </div>
          </div>
          <div class="col-4 offset-1">
                <div class="bok">
                    <div class="menu" style="text-align: right; margin-bottom:25px;">
                      <a href="{{ url('/semua') }}"><button type="button" class="btn btn-outline-success"> <strong>Semua Data</strong> </button></a>
                    </div>  
                    <h4>Data Realtime Energi Listrik</h4>
                      <div class="partisi">
                          <p>Tegangan</p>
                          <li id= "tegangan" class="list-group-item list-group-item-light" >{{ $data->tegangan }} <span>Volt</span></li>
                      </div>
                      <div class="partisi">
                          <p>Arus</p>
                          <li id="arus" class="list-group-item list-group-item-light" >{{ $data->arus }} <span>Amp</span></li>
                      </div>
                      <div class="partisi">
                          <p>Daya</p>
                          <li id="dayas" class="list-group-item list-group-item-light" >{{ $data->dy_aktif }} <span>Watt</span></li>
                      </div>
                      <div class="partisi">
                          <p>Energi</p>
                          <li id="energis" class="list-group-item list-group-item-light">{{ $data->Energi }} <span>kWh</span></li>
                      </div>                    
                </div>
            </div>
      </div>

      <div class="row" style="margin: 0;">
          <div class="col-2">
              <div class="medsos" >
                    <a href="#"><img src="{{asset('asset/icon/whatsapp.png')}}" alt="Whatsapp" style="width:30px;"></a>
                    <p>WA</p>
                    <a href="#"><img src="{{asset('asset/icon/gmail.png')}}" alt="Gmail" style="width:30px;"></a>
                    <p>Gmail</p>
              </div>
          </div>
          <div class="col-4">
               <div class="pil">
                  <a href="{{ url('/tegangan') }}"><button type="button" class="btn btn-success">Tegangan</button></a> 
                  <a href="{{ url('/arus') }}"><button type="button" class="btn btn-success">Arus</button></a>  
                  <a href="{{ url('/daya') }}"><button type="button" class="btn btn-success">Daya</button> </a>   
                  <a href="{{ url('/') }}"><button type="button" class="btn btn-success">Energi</button> </a> 
              </div>
        </div>
        <div class="col-6">
              <div class="kot">
                  <div id="suh" class="suhu">
                      <img src="{{asset('asset/icons/clear.svg')}}" alt="Gmail" style="width:35px;">
                      <p>25 C</p>
                  </div>
                  <div  id="humi" class="suhu">
                      <img src="{{asset('asset/icons/hum.png')}}" alt="Gmail" style="width:35px;">
                      <p>25 %</p>
                  </div>
              </div>
          <div class="kotak">
                  <h6 style="text-align: center; font-weight:bold;">Kontrol Beban Listrik</h6><hr>
              
                  @foreach($kontrol as $res)
                  <div class="bx1" style="float: left; padding-left: 10px;">
                      <p>{{$res->nama_panel}}</p>
                      <input data-id="{{$res->id}}" class="toggle-class" type="checkbox"  data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Nyala" data-off="Padam" {{ $res->panel == true ? 'checked' : '' }}>
                  </div>
                  @endforeach
          </div>
        </div>
      </div>
    </div>
      


    <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.js"></script>

    {{-- <script src="chart/dist/chart.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js" integrity="sha512-TW5s0IT/IppJtu76UbysrBH9Hy/5X41OTAbQuffZFU6lQ1rdcLHzpU5BzVvr/YFykoiMYZVWlr/PX1mDcfM9Qg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="{{asset('asset/toggle/js/bootstrap-toggle.min.js')}}"></script>
   
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>

    // Enable pusher logging - don't include this in production
    // Pusher.logToConsole = true;

    var pusher = new Pusher('7df7f325d677838e5119', {
      cluster: 'ap1',
    });

    var channel = pusher.subscribe('massage');
    channel.bind('my-event', function(data) {

      var energis = document.getElementById('energis');
      var last_energi = parseInt(energis.textContent);
      energis.innerHTML = data.energi + " kWh";

      // var kwh_ku = document.getElementById('kwh_tot');
      // var last_kwh = parseInt(kwh_ku.textContent);
      // kwh_ku.innerHTML = data.total_kwh + " kWh";

      var teg = document.getElementById('tegangan');
      var last_teg = parseInt(teg.textContent);
      teg.innerHTML = data.tegangan + " Volt";

      var arus = document.getElementById('arus');
      var last_arus = parseInt(arus.textContent);
      arus.innerHTML = data.arus + " Amp";

      var dayas = document.getElementById('dayas');
      var last_daya = parseInt(dayas.textContent);
      dayas.innerHTML = data.dy_aktif + " Watt";

      
      // console.log("berhasil");
      // console.log(data);
    });
  </script>


<script>
   
 (function($) {
   "use strict"
    let ctx4 = document.getElementById("myChart4");
    ctx4.height = 290;
    var myChart5 = new Chart(ctx4, {
        type: 'line',
        data: {
            labels: [],
            type: 'line',
            defaultFontFamily: 'Montserrat',
            datasets: [{
                data: [],
                label: "Energi",
                // backgroundColor: 'rgba(191, 0, 255, 0.5)',
                backgroundColor: 'rgba(0, 153, 51, 0.5)',
                pointBorderWidth: 2,
                borderColor: '#000',
                datalabels: {
                align: 'start',
                anchor: 'start',
                color: '#000',
                backgroundColor: 'rgba(255, 255, 225, 0.9)',
                borderColor: '#000)',
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
          labelString: 'Energi (kWh)',
          fontSize: 15
        }
        }]
      }
        }
    });
   var updateChart_energi = function() {
   $.ajax({
     type: "GET",
     dataType: "json",
     url: '{{ route('chart_energi') }}',
     headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     },
     success: function(data) {
      //  console.log(data);

       myChart5.data.labels = data.wkt;
       myChart5.data.datasets[0].data = data.energi;
       myChart5.update();
     },
     error: function(data){
       console.log(data);
     }
   });
 }
 updateChart_energi();
 setInterval(() => {
   updateChart_energi();
 }, 1000);



   })(jQuery);


</script>

<script>
  $(function() {
    $('.toggle-class').change(function() {
        var panel = $(this).prop('checked') == true ? 1 : 0; 
      //   console.log(panel);
        var id = $(this).data('id'); 
         
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('device')}}',
            data: {'panel': panel, 'id': id},
            success: function(data){
              
                
              // console.log(data.success);
            
            }
        });
    })
  });
</script>




  </body>
</html>
