<?php 
    // @include('../login/config.php');
    // session_start();
    // if(isset($_SESSION['uid'])&&isset($_SESSION['nid'])) {
    //     $uid = $_SESSION['uid'];
    //     $nid = $_SESSION['nid'];
    //     $a1="SELECT tripid,did FROM notify WHERE `uid`=1 and nid=9 and uend=1;";
    //     $b1=mysqli_query($conn, $a1);
    //     $c1=$b1->fetch_assoc();
    //     $tripid = $c1['tripid'];
    //     $did = $c1['did'];
    //     $a2="SELECT COUNT(`uid`) FROM notify WHERE tripid=$tripid and did=$did and drvad=1 and usrad=1;";
    //     $b2=mysqli_query($conn,$a2);
    //     $c2=$b2->fetch_assoc();
    //     $numusr=$c2['COUNT(`uid`)'];
    //     $a3="SELECT km FROM trip WHERE tripid=$tripid;";
    //     $b3=mysqli_query($conn, $a3);
    //     $c3=$b3->fetch_assoc();
    //     $km = $c3['km'];
    //     $a4="SELECT dprice FROM driver WHERE did=$did;";
    //     $b4=mysqli_query($conn, $a4);
    //     $c4=$b4->fetch_assoc();
    //     $cost = $c4['dprice'];
    //     $amount = ($cost*$km)/$numusr;
    //     $_SESSION['uid']=$uid;
    //     $_SESSION['did']=$did;
    // } else {
    //     echo 'UID not found';
    // }
?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/pay.css">
    <title>Payment</title>
</head>
<body>
<div class="container">
    <h1>Pay</h1>
    <h2>Amount: &#x20B9 <?php //echo $amount; ?></h2>
    <div class="inner-box">
        <div>
        <h1>UPI</h1>    
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                    <img src="../assets/cashless-payment.png" alt="Avatar" style="width:200px;height:200px;">
                    </div>
                    <div class="flip-card-back">
                    <a href="../review/reviewpass.php"><img src="../assets/upi.svg" alt="Bag" style="width:200px;height:200px;"></a>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <h1>Cash</h1>
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                    <img src="../assets/payment-method.png" alt="Payment" style="width:200px;height:200px;">
                    </div>
                    <div class="flip-card-back">
                    <a href="../review/reviewpass.php"><img src="../assets/money-bag.png" alt="Bag" style="width:200px;height:200px;"></a>
                    </div>
            </div>
        </div>
        </div>
    </div>
</div>  
</body>
</html> -->






<?php 
    @include('../login/config.php'); 
    // $conn=mysqli_connect('localhost','root','','crew');
    session_start();
    if(isset($_SESSION['uid'])&&isset($_SESSION['nid'])) {
        $uid = $_SESSION['uid'];
        // echo $uid;
        // $uid=1;
        $nid = $_SESSION['nid'];
        // $nid=9;
        $a1="SELECT tripid,did FROM notify WHERE `uid`=$uid and nid=$nid and uend=1;";
        $b1=mysqli_query($conn, $a1);
        $c1=$b1->fetch_assoc();
        $tripid = $c1['tripid'];
        $did = $c1['did'];
        $a5="SELECT dcar FROM driver WHERE did=$did;";
        $b5=mysqli_query($conn, $a5);
        $c5=$b5->fetch_assoc();
        $car = $c5['dcar'];
        $a2="SELECT COUNT(`uid`) FROM notify WHERE tripid=$tripid and did=$did and drvad=1 and usrad=1;";
        $b2=mysqli_query($conn,$a2);
        $c2=$b2->fetch_assoc();
        $numusr=$c2['COUNT(`uid`)'];
        $a3="SELECT km FROM trip WHERE tripid=$tripid;";
        $b3=mysqli_query($conn, $a3);
        $c3=$b3->fetch_assoc();
        $km = $c3['km'];
        $a4="SELECT dprice FROM driver WHERE did=$did;";
        $b4=mysqli_query($conn, $a4);
        $c4=$b4->fetch_assoc();
        $cost = $c4['dprice'];
        $amount = ($cost*$km)/$numusr;
        $a6="SELECT * from carbon WHERE `uid`=$uid;";
        $b6=mysqli_query($conn, $a6);
        $c6=$b6->fetch_assoc();
        $emission = $c6['emission'];
        $trees = $c6['trees'];
        $_SESSION['uid']=$uid;
        $_SESSION['did']=$did;
        if(isset($_COOKIE['emission'])&& isset($_COOKIE['trees'])) {
            $emission2= $_COOKIE['emission'];
            $trees2= $_COOKIE['trees'];
            setcookie("trees",0);
            setcookie("emission",0);
            $emission1 = (int)$emission2;
            $trees1 = (int)$trees2;
            $a7="UPDATE carbon SET emission=$emission1, trees=$trees1 WHERE `uid`=$uid;";
            $b7=mysqli_query($conn,$a7); 
            
          } else {
            echo 'error';
          }        
    } else {
        echo 'UID not found';
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/pay.css">
    <title>Payment</title>
</head>
<body>
<div class="container">
    <h1>Pay</h1>
    <h2>Amount: &#x20B9 <?php echo $amount; ?></h2>
    <div class="inner-box">
        <div class="innerinnerbox">
            <div>
                <h1>Carbon</h1>
                <h3 class="card-text">You saved nearly <span id="totalcarbon">0</span> Kg of carbon on this trip</h3>
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <img src="../assets/carbonimgs10.png" alt="Carbon" style="width:200px;height:200px;">
                    </div>
                </div>
            </div>
            <div>
                <h1>Tree</h1>
                <h3 class="card-text2">We planted <span id="trees">0</span> trees on behalf of you</h3>
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <img src="../assets/treesimg10.png" alt="Carbon" style="width:200px;height:200px;">
                    </div>
                </div>
            </div>
        </div> 
        <div class="innerinnerbox">
        <div>
            <h1>UPI</h1>    
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="../assets/cashless-payment.png" alt="Avatar" style="width:200px;height:200px;">
                    </div>
                    <div class="flip-card-back">
                        <a href="../review/reviewpass.php"><img src="../assets/upi.svg" alt="Bag" style="width:200px;height:200px;"></a>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <h1>Cash</h1>
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="../assets/payment-method.png" alt="Payment" style="width:200px;height:200px;">
                    </div>
                    <div class="flip-card-back">
                        <a href="../review/reviewpass.php"><img src="../assets/money-bag.png" alt="Bag" style="width:200px;height:200px;"></a>
                    </div>
                </div>
            </div>
        </div> 
        </div>   
    </div>
</div>

<script>
    let totalemmission=0,totalemmission1=<?php echo $emission; ?>;
    let treesplanted=<?php echo $trees; ?>;
    console.log(totalemmission1);
    console.log(treesplanted);
    let carbonFootprint = 0;
    let carType="small";
    let km = <?php echo $km; ?>;
    console.log(km);
    // let km = 100;
    async function findfootprint()
    {
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
        totalemmission1+=carbonFootprint;
        totalemmission = Math.round(totalemmission1);
        console.log("Carbon footprint "+carbonFootprint);
        if(totalemmission > 100) {
            treesplanted+=1;
            totalemmission-=100;
        }
        document.getElementById("totalcarbon").innerHTML = carbonFootprint;
        document.getElementById("trees").innerHTML = treesplanted;
        document.cookie = "emission = " + totalemmission;
        document.cookie = "trees = " + treesplanted;
      }
      window.onload = function() {
        findfootprint();
      };
</script>  
</body>
</html>