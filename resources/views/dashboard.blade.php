<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('energi-pzem/style.css')}}" type="text/css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
   
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link href="{{asset('energi-pzem/toggle/css/bootstrap-toggle.min.css')}}" rel="stylesheet">

    
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.min.js" type="text/javascript"></script>

    <title>Easy Monitoring</title>
  </head>
  <body>
    <div class="dasar_bg">

        <div class="row" style="margin:0; padding: 10px;">
            <div class="col-4">
                <div class="logo">
                    <!-- <img src="" alt="">
                    <img src="" alt=""> -->
                    <button type="button" class="btn btn-warning">lOGO 1</button>
                    <button type="button" class="btn btn-info">LOGO 2</button>
                </div>
            </div>
            <div class="col-4">
                <div class="judul">
                
                    <h1>PZEM Energi Listrik</h1>
                    
                 </div>
            </div>
            <div class="col-4" style="text-align: right; ">
                <button type="button" class="btn btn-success">Semua Data</button>
                    <button type="button" class="btn btn-danger">PDF</button>
            </div>
            
        </div>
        
       

         <div class="row justify-content-between" style="margin:0;">
            <div class="col-7">
                <div class="card" style="border-style: none;">
                    <div class="card-body">
                        {{-- <div id="chart" style="width:115%; height:420px;"></div> --}}
                        <canvas id="chart" style="width:120%; height:420px; margin-left:20px;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-4" >
                <h4 style="text-align: center;">Data Realtime Energi Listrik</h4>
                <div class="box">
                    <div class="partisi">
                         <p>Tegangan :</p>
                         <li id= "tegangan" class="list-group-item list-group-item-light" style="width:180px;">{{ $pzems->tegangan }} <span>Volt</span></li>
                     </div>
                    <div class="partisi">
                        <p>Arus :</p>
                        <li id="arus" class="list-group-item list-group-item-light" style="width:180px;">{{ $pzems->arus }} <span>Amp</span></li>
                    </div>
                    <div class="partisi">
                        <p>Daya :</p>
                        <li id="dayas" class="list-group-item list-group-item-light" style="width:180px;">{{ $pzems->daya }} <span>Watt</span></li>
                    </div>
                    <div class="partisi">
                        <p>Energi :</p>
                        <li id="energis" class="list-group-item list-group-item-light" style="width:180px;">{{ $pzems->energi }} <span>kWh</span></li>
                    </div>
                    
                    
                </div>

            </div>
        </div>
        <div class="row" style="margin: 0;">
            
            <div class="col-2">
                <div class="medsos">
                        <a href="#"><img src="{{asset('energi-pzem/asset/icon/whatsapp.png')}}" alt="Whatsapp" style="width:30px;"></a>
                        <p>WA</p>
                        <a href="#"><img src="{{asset('energi-pzem/asset/icon/gmail.png')}}" alt="Gmail" style="width:30px;"></a>
                        <p>Gmail</p>
                </div>
                
            </div>
            <div class="col-4" style=" padding-left: 20px;">
                <div class="pil">
                    <a href=""><button type="button" class="btn btn-success">Tegangan</button></a> 
                    <a href=""><button type="button" class="btn btn-success">Arus</button></a>  
                    <a href=""><button type="button" class="btn btn-success">Daya</button> </a>   
                    <a href=""><button type="button" class="btn btn-success">Energi</button> </a> 
                </div>
                <div class="pul">

                </div>
            </div>
            <div class="col-6">
                <div class="kot">
                    <div class="suhu">
                        <img src="{{asset('energi-pzem/asset/icons/clear.svg')}}" alt="Gmail" style="width:35px;">
                        <p>25 C</p>
                    </div>
                    <div class="suhu">
                        <img src="{{asset('energi-pzem/asset/icons/hum.png')}}" alt="Gmail" style="width:35px;">
                        <p>25 %</p>
                    </div>
                    
                </div>
                <div class="kotak">

                    <h6 style="text-align: center; font-weight:bold;">Kontrol Beban Listrik</h6><hr>
                    <div class="bx1" style="float: left; padding-left: 10px;">
                        <p>Lampu 1</p>
                        <input type="checkbox" checked data-toggle="toggle" data-on="Hidup" data-off="Padam" data-onstyle="success" data-offstyle="danger">
                    </div>
                    <div class="bx1" style="float: left; padding-left: 10px; padding-top: 1px;">
                        <p>Lampu 2</p>
                        <input type="checkbox" checked data-toggle="toggle" data-on="Hidup" data-off="Padam" data-onstyle="success" data-offstyle="danger">
                    </div>
                    <div class="bx1" style="float: left; padding-left: 10px; padding-top: 1px;">
                        <p>Lampu 3</p>
                        <input type="checkbox" checked data-toggle="toggle" data-on="Hidup" data-off="Padam" data-onstyle="success" data-offstyle="danger">
                    </div>
                </div>
                
            </div>
            
            
        </div>
    </div>
        
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="{{asset('energi-pzem/toggle/js/bootstrap-toggle.min.js')}}"></script>
    <style url="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js" integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
<!--     
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>

    // Enable pusher logging - don't include this in production
    // Pusher.logToConsole = true;

    var pusher = new Pusher('a866aa1fd390b6b27793', {
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
      dayas.innerHTML = data.daya + " Watt";

      
      // console.log("berhasil");
      // console.log(data);
    });
  </script>


    <script>
     (function($) {
    "use strict"

    let ctx1 = document.getElementById("chart");
    ctx1.height = 295;
    var myChart2 = new Chart(ctx1, {
        type: 'line',
        data: {
            labels: [],
            type: 'line',
            defaultFontFamily: 'Montserrat',
            datasets: [{
                data: [],
                label: "Daya Aktif",
                // backgroundColor: 'rgba(191, 0, 255, 0.5)',
                pointBorderWidth: 2,
                borderColor: '#333',
                
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
    var updateChart_teg = function() {
    $.ajax({
      type: "GET",
      dataType: "json",
      url: '{{ route('chart_teg') }}',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {

        myChart2.data.labels = data.waktu;
        myChart2.data.datasets[0].data = data.teg;
        myChart2.update();
      },
      error: function(data){
        console.log(data);
      }
    });
  }
  updateChart_teg();
  setInterval(() => {
    updateChart_teg();
  }, 1000);



    })(jQuery);

 </script>




  </body>
</html>