<?php
  include("../pass/login/config.php");
  session_start();
  $did=1;
  $sql = "Select km from trip WHERE `did`=$did;";
  $res = mysqli_query($conn, $sql);
  $c1=$res->fetch_assoc();
  $km=$c1['km'];
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, 
    initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="profile3stylesheet.css">
    <title>Profile 3</title>
</head>
<body>
  <div id="left">
    <div class="profile-pic-container">
      <img src="imgs\carbonimgs10.png" alt="profile-pic" class="profile-pic">
    </div>
    </div>
  
  <div id="end-ride">
    <input id="button" type="button" value='End ride' onClick='findfootprint();'>
    </div>
  <div class="progress-container">
    <progress value="0" max="100" id="p1"></progress>
  </div>
<div class="all">
  <div class="container">
    <div class="row">
        <div class="col-lg-6 mb-4">
<div id="card-element1">
<div class="card img-fluid" style="width:350px">
  <img class="card-img-top" src="imgs\carbonimgs10.png" alt="Card image" style="width:350px">
  <div class="card-img-overlay">
    <h4 class="card-title">You saved.... </h4>
    <h3 class="card-text">You saved <span id="totalcarbon"></span> Kg of carbon</h3>
    <a href="#" class="btn btn-primary">Find out more</a>
  </div>
</div>
</div>
</div></div></div></div>
<div class="container">
  <div class="row">
      <div class="col-lg-6 mb-4">
<div id="card-element2">
  <div class="card img-fluid" style="width:350px">
    <img class="card-img-top" src="imgs\treesimg10.png" alt="Card image" style="width:350px">
    <div class="card-img-overlay">
      <h4 class="card-title2">Trees planted.... </h4>
      <h3 class="card-text2">We planted <span id="trees"></span> trees on behalf of you</h3>
      <a href="#" class="btn btn-primary">Find out more</a>
    </div>
  </div>
  </div>
  </div></div></div>
</div>
<br><br><br>
  </body>
  <script>
    // let x = "<?php echo"$row";?>"
    // console.log(x);
    // const distanceinkm = localStorage.getItem('distance');
    // document.getElementById('distance').textContent = distanceinkm;
    // console.log(distanceinkm)
    const distanceinkm = localStorage.getItem('distance');
    console.log(distanceinkm);
    
    const km = Number(distanceinkm);
    console.log(km);
    
    if (Number(distanceinkm)){
      console.log("true");
    }
    else{
      console.log("infinite");
    }
    let totalemmission=0;
    let treesplanted=0;
    let carbonFootprint = 0;
    async function findfootprint()
    {
      var carType = "small";
      let km = 100;
      // logic
      const petrol_fact = 2.3;
      
      let fuelConsumption;
      switch (carType) {
        case "small":
            fuelConsumption = km/ 12.75;
            carbonFootprint = fuelConsumption * petrol_fact ;
            break;
          case "midsize":
            fuelConsumption = km / 11.9;
            carbonFootprint = fuelConsumption * petrol_fact ;
            break;
          case "large":
            fuelConsumption = km / 8.5;
            carbonFootprint = fuelConsumption * petrol_fact ;
            break;
          case "smallSUV":
            fuelConsumption = km / 10.6;
            carbonFootprint = fuelConsumption * petrol_fact ;
            break;
          case "midsizeSUV":
            fuelConsumption = km / 9.1;
            carbonFootprint = fuelConsumption * petrol_fact ;
            break;
          case "largeSUV":
            fuelConsumption = km / 6.4;
            carbonFootprint = fuelConsumption * petrol_fact ;
            break;
          default:
            console.log("Invalid car type.");
            return;
        }
        totalemmission=totalemmission+carbonFootprint;
        console.log("Carbon footprint "+carbonFootprint);
        console.log("totalemmission "+totalemmission);
        updateprogressbar();
      }
      async function updateprogressbar()
      {    
        if(totalemmission>=100)
        {
          treesplanted++;
          totalemmission=0;
          document.getElementById("p1").value= 0;  
        }
        else
        {
          var v1=document.getElementById('p1').value;
          document.getElementById("p1").value= v1 + carbonFootprint;
        }
        document.getElementById("totalcarbon").innerHTML = totalemmission; 
        document.getElementById("trees").innerHTML = treesplanted;  
      }


</script>
</html>