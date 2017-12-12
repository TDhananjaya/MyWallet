<?php
  include 'header.php';

  //$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

  $userId=$_SESSION['userId'];
  $sql="SELECT amount FROM wallet WHERE userId='$userId'";
  $result=$conn->query($sql);
  $raw=$result->fetch_assoc();
  $lastAmount=$raw['amount'];

  if($userId==null){
    header("Location: signup.php");
    exit();
  }

  $sql="SELECT firstName FROM user WHERE userId='$userId'";
  $result=$conn->query($sql);
  $raw=$result->fetch_assoc();
  $firstName=$raw['firstName'];

  $sql="SELECT userName FROM user WHERE userId='$userId'";
  $result=$conn->query($sql);
  $raw=$result->fetch_assoc();
  $userName=$raw['userName'];

  date_default_timezone_set("Asia/Colombo");

  $date0=strtotime("today");
  $date=date('Y-m-d');

  $sql="SELECT dateposted FROM wallet WHERE userId='$userId'";
  $result=$conn->query($sql);
  $raw=$result->fetch_assoc();
  $lastdate=$raw['dateposted'];

  $sql1="SELECT * FROM ".$userName."_payment WHERE paymentId=
  (SELECT MAX(paymentId) FROM ".$userName."_payment)";
  $result=$conn->query($sql1);
  $raw1=$result->fetch_assoc();
  $food=$raw1['breakfast']+$raw1['lunch']+$raw1['dinner']+$raw1['drinks']+
              $raw1['otherf'];
  $transport=$raw1['transport'];
  $stationary=$raw1['stationary'];
  $funds=$raw1['funds'];
  $other=$raw1['other'];
  $psum=$raw1['psum'];

  $sql1="SELECT * FROM ".$userName."_deposit WHERE depositId=
  (SELECT MAX(depositId) FROM ".$userName."_deposit)";
  $result=$conn->query($sql1);
  $raw1=$result->fetch_assoc();
  $home=$raw1['home'];
  $friend=$raw1['friend'];
  $bank=$raw1['bank'];
  $job=$raw1['job'];
  $other=$raw1['other'];
  $dsum=$raw1['dsum'];

  ///////////

  $payment=array(7);
  $deposit=array(7);
  $datef=array(7);
  $datef[0]=date("Y-m-d",strtotime("+0 days",$date0));
  $datef[1]=date("Y-m-d",strtotime("-1 days",$date0));
  $datef[2]=date("Y-m-d",strtotime("-2 days",$date0));
  $datef[3]=date("Y-m-d",strtotime("-3 days",$date0));
  $datef[4]=date("Y-m-d",strtotime("-4 days",$date0));
  $datef[5]=date("Y-m-d",strtotime("-5 days",$date0));
  $datef[6]=date("Y-m-d",strtotime("-6 days",$date0));
  $datef[7]=date("Y-m-d",strtotime("-7 days",$date0));

  for($i=0;$i<8;$i++){
    $sql="SELECT payment FROM ".$userName."_graph WHERE dateposted='$datef[$i]'";
    $result=$conn->query($sql);
    $raw=$result->fetch_assoc();
    $payment[$i]=$raw['payment'];
  }
  for($i=0;$i<8;$i++){
    $sql="SELECT deposit FROM ".$userName."_graph WHERE dateposted='$datef[$i]'";
    $result=$conn->query($sql);
    $raw=$result->fetch_assoc();
    $deposit[$i]=$raw['deposit'];
  }

  $maxd=$payment[0];
  for($i=1;$i<7;$i++){
    if($maxd<$payment[$i]){
      $maxd=$payment[$i];
    }
  }
  $maxp=$deposit[0];
  for($i=1;$i<7;$i++){
    if($maxp<$deposit[$i]){
      $maxp=$deposit[$i];
    }
  }

  //$enddate=strtotime("+1 days",$date0);

  $dates=array(7);
  $dates[0]=date("M d",strtotime("+0 days",$date0));
  $dates[1]=date("M d",strtotime("-1 days",$date0));
  $dates[2]=date("M d",strtotime("-2 days",$date0));
  $dates[3]=date("M d",strtotime("-3 days",$date0));
  $dates[4]=date("M d",strtotime("-4 days",$date0));
  $dates[5]=date("M d",strtotime("-5 days",$date0));
  $dates[6]=date("M d",strtotime("-6 days",$date0));
  $dates[7]=date("M d",strtotime("-7 days",$date0));

  //echo $url;
  ?>


  <div class="top">
    <?php
      if($date!=$lastdate){
      echo "<form action='deposit.php' method='get'>
        <button type='submit' class='enter'>Enter today</button>
        </form>";
      }
      else{
        echo "<div class='youenterd'>You enterd today!</div>";
      }
    ?>
  </div>

  <?php
  if($lastAmount>0){
    echo "<div class='title'>$firstName, You have $lastAmount amount of LKR
          in your wallet</div>";
  }else{
    echo "<div class='title'>$firstName, You haven't money in your wallet
          :(</div>";
  }


  echo "
  <div class='chart3'>
      <canvas id='canvas3'></canvas>
  </div>
  <div class='chart4'>
      <canvas id='canvas4'></canvas>
  </div>

  <div class='chart1'>
      <canvas id='canvas1'></canvas>
  </div>

  <div class='chart2'>
      <canvas id='canvas2'></canvas>
  </div>


  <script>

  var config3 = {
      type: 'doughnut',
      data: {
          datasets: [{
              data: [
                  $food,
                  $transport,
                  $stationary,
                  $funds,
                  $other,
              ],
              backgroundColor: [
                  window.chartColors.red,
                  window.chartColors.orange,
                  window.chartColors.yellow,
                  window.chartColors.green,
                  window.chartColors.blue,
              ],
              label: 'Dataset 1'
          }],
          labels: [
              'Food',
              'Transport',
              'Stationary',
              'funds',
              'other'
          ]
      },
      options: {
          responsive: true,
          legend: {
              position: 'top',
          },
          title: {
              display: true,
              text: 'You have spent $psum of LKR today'
          },
          animation: {
              animateScale: true,
              animateRotate: true
          }
      }
  };


  var config4 = {
      type: 'doughnut',
      data: {
          datasets: [{
              data: [
                $home,
                $friend,
                $bank,
                $job,
                $other,
              ],
              backgroundColor: [
                  window.chartColors.red,
                  window.chartColors.orange,
                  window.chartColors.yellow,
                  window.chartColors.green,
                  window.chartColors.blue,
              ],
              label: 'Dataset 1'
          }],
          labels: [
              'home',
              'friend',
              'bank',
              'job',
              'other'
          ]
      },
      options: {
          responsive: true,
          legend: {
              position: 'top',
          },
          title: {
              display: true,
              text: 'You have got $dsum of LKR today'
          },
          animation: {
              animateScale: true,
              animateRotate: true
          }
      }
  };

  var config1 = {
          type: 'line',
          data: {
              labels: ['$dates[7]','$dates[6]', '$dates[5]', '$dates[4]',
              '$dates[3]', '$dates[2]', '$dates[1]','$dates[0]'],
              datasets: [{
                  label: 'Payments',
                  backgroundColor: window.chartColors.red,
                  borderColor: window.chartColors.red,
                  data: [$payment[7],$payment[6], $payment[5], $payment[4],
                  $payment[3], $payment[2], $payment[1], $payment[0]],
                  fill: false,
              }]
          },
          options: {
              responsive: true,
              title:{
                  display:true,
                  text:'Payments in last 7 days'
              },
              scales: {
                  yAxes: [{
                      ticks: {
                          min: 0,
                          max: $maxd+100
                      }
                  }]
              }
          }
      };
  var config2 = {
          type: 'line',
          data: {
              labels: ['$dates[7]','$dates[6]', '$dates[5]', '$dates[4]',
              '$dates[3]', '$dates[2]', '$dates[1]','$dates[0]'],
              datasets: [{
                  label: 'Deposits',
                  backgroundColor: window.chartColors.blue,
                  borderColor: window.chartColors.blue,
                  data: [$deposit[7],$deposit[6], $deposit[5], $deposit[4],
                  $deposit[3], $deposit[2], $deposit[1], $deposit[0]],
                  fill: false,
              }]
          },
          options: {
              responsive: true,
              title:{
                  display:true,
                  text:'Deposits in last 7 days'
              },
              scales: {
                  yAxes: [{
                      ticks: {
                          min: 0,
                          max: $maxp+100
                      }
                  }]
              }
          }
      };

      window.onload = function() {
          var ctx3 = document.getElementById('canvas3').getContext('2d');
          var ctx4 = document.getElementById('canvas4').getContext('2d');
          var ctx1 = document.getElementById('canvas1').getContext('2d');
          var ctx2 = document.getElementById('canvas2').getContext('2d');

          window.myDoughnut = new Chart(ctx3, config3);
          window.myDoughnut = new Chart(ctx4, config4);
          window.myLine = new Chart(ctx1, config1);
          window.myLine = new Chart(ctx2, config2);
      };

  </script>";

  ?>



  </body>
</html>
