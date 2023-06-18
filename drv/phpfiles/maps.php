<?php
    session_start();
    if(isset($_COOKIE['src']) && isset($_COOKIE['dest']) && isset($_COOKIE['km'])) {
      $src= $_COOKIE['src'];
      $dest= $_COOKIE['dest'];
      $km= $_COOKIE['km'];
      $kms = str_replace('km','',$km);
      $kmss = (float)$kms;
    }
    $datetimelocal1 = date('Y-m-d'); 
          $datetimelocal2 = date('h:i'); 
          $datetimelocal = $datetimelocal1."T".$datetimelocal2;
    if(isset($_SESSION['did'])) {
      $did = $_SESSION['did'];
      // echo $did;
      if(isset($_POST['submit'])) {
        $datetime = $_POST['datetime'];
        // echo $datetime;
        if($src!='' && $dest!='') {
          $conn = mysqli_connect('localhost','root','','crew');
          date_default_timezone_set('Asia/Kolkata');
          
          // echo $datetimelocal;
          $select = "INSERT INTO trip(src,dest,km,did,strt) VALUES('$src','$dest',$kmss,$did,'$datetime');";
          $res = mysqli_query($conn, $select);
          setcookie('src','');
          setcookie('dest','');
          setcookie('km','');
          $_SESSION['did'] = $did;
          header('location: ./ong.php');
        } else {
          header('location:./maps.php');
        }
      }
    } else {
    echo 'error';
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/mapstyle.css" rel="stylesheet">
    <title>Maps</title>
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css" rel="stylesheet">
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.css" type="text/css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
      #map1, #map2 { 
        width: 350px; height:350px; 
      }
      @media screen and (max-width: 1200px) {
        #map1, #map2 { 
        width: 300px; height:300px; 
      }
      }
      @media screen and (max-width: 600px) {
        #map1, #map2 { 
        width: 250px; height:250px; 
      }
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-light">
      <div class="container-fluid">
          <a class="navbar-brand bold" href="#">Akele beCar</a>
          <div class="nav-logo">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
          </div>  
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                      <a class="nav-link active bold" aria-current="page" href="../profile/index.php">Profile</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link active bold" aria-current="page" href="../phpfiles/Mapclone.html">Directions</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link active bold" aria-current="page" href="./ong.php">Ongoing Rides</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link active bold" aria-current="page" href="../login/logout.php">Logout</a>
                  </li>
              </ul>
          </div>
      </div>
    </nav>
    <div class="container">
      <h1 style="text-align: center; text-decoration: underline wavy ">Akele beCar</h1>
      <div class="innerinnerinner">
        <div class="inner-box">
          <div class="in">
            <div class="innerhead">
              <h3>Enter source</h3> 
            </div>
            <div class="innerinner">
              <div id="map1"></div>
            </div>
          </div>
          <div class="in">
            <div class="innerhead">
              <h3>Enter destination</h3> 
            </div>
            <div class="innerinner">
              <div id="map2"></div>
            </div>
          </div>
        </div>
        <div class="datetime">
          <br>
          <label for="datetime">Date</label>
          <form method="POST">
            <input type="datetime-local" id="datetime" min="<?php echo $datetimelocal; ?>" name="datetime" required>
            <br><br>
          <!-- </form> -->
        </div>
        <div class="innerdist">
          <label for="output1">Distance</label>
          <div id="output1"></div>
          <label for="output2">Duration</label>
          <div id="output2"></div>
        </div>
        </div>
        <div class="submitbtn">
            <input style="text-align: center;" type="submit" name="submit" id="button" value="Let's ride" />
          </form>
        </div>
    </div>  
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js"></script>
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
      var address1, address2;
      //source map
      mapboxgl.accessToken = 'pk.eyJ1IjoiYWRtaW5uaW5qYSIsImEiOiJjbGZlNjBiNmswbXpnNDJubTRwMnkydHdrIn0.u_KqBLNcOkfBU5ithnA7LA';
      const map1 = new mapboxgl.Map({
        container: 'map1',
        // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
        style: 'mapbox://styles/mapbox/streets-v12',
        center: [77.5946,12.9716],
        zoom: 13
      });

      const geocoder1 = new MapboxGeocoder({
          accessToken: mapboxgl.accessToken,
          marker: {
              color: 'orange'
          },
          mapboxgl: mapboxgl
      });

      map1.addControl(geocoder1);
      geocoder1.on('result', function(e) {
      // const location = e.result.center;
      address1 = e.result.text;
        //   console.log('Location:', location);
      console.log('Address of source: ', address1);
      });
        //destination
      mapboxgl.accessToken = 'pk.eyJ1IjoiYWRtaW5uaW5qYSIsImEiOiJjbGZlNjBiNmswbXpnNDJubTRwMnkydHdrIn0.u_KqBLNcOkfBU5ithnA7LA';
      const map2 = new mapboxgl.Map({
          container: 'map2',
          // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
          style: 'mapbox://styles/mapbox/streets-v12',
          center: [77.5946,12.9716],
          zoom: 13
      });

      const geocoder2 = new MapboxGeocoder({
          accessToken: mapboxgl.accessToken,
          marker: {
              color: 'orange'
          },
          mapboxgl: mapboxgl
      });

      map2.addControl(geocoder2);
      geocoder2.on('result', function(e) {
        // const location = e.result.center;
      address2 = e.result.text;
        //   console.log('Location:', location);
      console.log('Address of destination: ', address2);
      if(address1!= null && address2!= null){
          axios.get('https://api.distancematrix.ai/maps/api/distancematrix/json',{
      params:{
          origins:address1,
          destinations:address2,
          key:"gbsxfa8IB7WoHDGdwkFb1zxBoBLDg",
          region:'IN',
      }
      }).then(function(response){
            var distanceinkms=response.data.rows[0].elements[0].distance.text;
            document.getElementById('output1').innerHTML= distanceinkms;
            var duration=response.data.rows[0].elements[0].duration.text;
            document.getElementById('output2').innerHTML= duration;
          //    document.cookie = "address1php = " + address1 + address2 + distanceinkms ;
            document.cookie = "src = " + address1 ;
            document.cookie = "dest = " + address2  ;
            document.cookie = "km = " + distanceinkms ;
            
      }).catch(function(err){
      });
          }
      });

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>