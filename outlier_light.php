<?php
  include "connection.php";

  // 3-SIGMA
  $mean = mysqli_query($connection, "SELECT AVG(light) AS average FROM datatraining");
  $row_mean = mysqli_fetch_assoc($mean);
  $average = $row_mean["average"];

  $std = mysqli_query($connection, "SELECT STDDEV(light) AS deviation FROM datatraining");
  $row_std = mysqli_fetch_assoc($std);
  $deviation = $row_std["deviation"];

  $z = 3;
  $upper_limit = $average + ($z * $deviation);
  $lower_limit = $average - ($z * $deviation); 

 // OUTLIER
  // $light_2 = mysqli_query($connection, "SELECT light FROM datatraining WHERE light<$lower_limit OR light>$upper_limit");
  // $total_outlier_light = mysqli_num_rows($light_2);

  // Menampung sementara data light ke dalam array $value[]
  // $light_3 = mysqli_query($connection,"SELECT light FROM datatraining");
  // while ($result = mysqli_fetch_array($light_3)) {
  //     $value[] = $result['light'];
  // }
  // echo max($value);
  // echo min($value);

  // WINSORIZING
  $light_4 = mysqli_query($connection, "SELECT light FROM datatraining");

  // Menampung sementara data light => winsorizing ke dalam array $value2[]
  $light_5 = mysqli_query($connection, "SELECT light FROM datatraining");
  while ($result2 = mysqli_fetch_array($light_5)) {
    if ($result2['light'] > $upper_limit) {
      $result2['light'] = $upper_limit;
    }
    elseif ($result2['light'] < $lower_limit) {
      $result2['light'] = $lower_limit;
    }
    $value2[] = $result2['light'];
  } 
  // echo max($value2);
  // echo min($value2);

  session_start();
  if(empty($_SESSION['input_email']) OR empty($_SESSION['input_password'])) {
    header('location: login.php');
  }
  else {

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Outlier - Light</title>

  <?php
    include "library.php";
  ?>

  <!-- style.css -->
  <link rel="stylesheet" href="style.css">

  <style>
    h3 {
      font-size: 14px;
      font-weight: 700;
      color: #424874;
      margin-bottom: 0;
    }
    h5 {
      color: #424874;
    }
    table {
      width: auto;
    }
    th {
      padding: 0px 5px 0px 0px;
      text-align: left;
      border-color: white;
      background-color: white;
      color: #424874;
      font-size: 12px;
      font-weight: 500;
    }
    td {
      padding: 0px 5px;
      border-color: white;
      background-color: white;
      color: #424874;
      font-size: 12px;
      font-weight: 500;
    }
    table .data-outlier td {
      border-color: #DEE2E6;
    }
    .page-link {
      padding: 3px 7px;
    }
    .font-pagination {
      font-size: 10px;
    }
  </style>

</head>

<body class="hold-transition sidebar-mini layout-fixed">

  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <div class="nav-link">Outlier</div>
        </li>
    </nav>

    <!-- Main Sidebar Container -->
    <?php
      include "sidebar.php";
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-white">
      <!-- Title -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <h1 class="m-0">Light</h1>
            </div>
          </div>
        </div>
      </div>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12"> 

              <hr color="#A6B1E1" size="1px" style="margin: 0px 0px 10px 0px">

              <!-- LIGHT + OUTLIER CHART -->
              <h5>Outlier detection with 3-Sigma</h5>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Light</h3>
                </div>
                <div class="card-body">
                  <div class="chart">
                    <canvas id="light_chart"></canvas>

                    <hr color="#A6B1E1" size="1px" style="margin: 10px 0px">              
                        
                    <h3>Info</h3>
                    <div class="table-responsive" id="data">
                      <!-- Table from outlier_light_source.php -->
                    </div>

                  </div>
                </div>
              </div>

              <hr color="#A6B1E1" size="1px" style="margin: 10px 0px">

              <!-- LIGHT + WINSORIZING CHART -->
              <h5>Outlier handling with Winsorizing</h5>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Light</h3>
                </div>
                <div class="card-body">
                  <div class="chart">
                    <canvas id="light_winsorizing_chart"></canvas>

                    <hr color="#A6B1E1" size="1px" style="margin: 10px 0px">              
                        
                    <h3>Info</h3>
                    <table border="1">
                      <tr>
                        <th>Total records</th>
                          <td>:</td>
                          <td><?php echo $total_records_light; ?></td>
                      </tr>
                      <tr>
                        <th>Minimum</th>
                          <td>:</td>
                          <td><?php echo min($value2); ?></td>
                      </tr>
                      <tr>
                        <th>Maximum</th>
                          <td>:</td>
                          <td><?php echo max($value2); ?></td>
                      </tr>
                      <tr>
                        <th>Lower limit</th>
                          <td>:</td>
                          <td><?php echo $lower_limit; ?></td>
                      </tr>
                      <tr>
                        <th>Upper limit</th>
                          <td>:</td>
                          <td><?php echo $upper_limit; ?></td>
                      </tr>
                    </table> 

                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </section>

    </div>
  
    <!-- Footer -->
    <?php 
      include "footer.php";
    ?>

  </div>

  <script>
    // LIGHT + OUTLIER CHART
    var linechart = document.getElementById("light_chart").getContext('2d');
		var myChart = new Chart(linechart, {
			type: 'line',
			data: {
				labels: [<?php while ($waktu = mysqli_fetch_array($date_time)) {echo '"'. $waktu['date_time'] . '",';} ?>],
				datasets: [{
					label: 'Light (lux)',
					data: [<?php while ($cahaya = mysqli_fetch_array($light)) {echo '"' . $cahaya['light'] . '",';} ?>],
					backgroundColor: ['#A6B1E1'],
				}]
			},
			options: {
				responsive: true,
        plugins: {
          annotation: {
            annotations: {
              line1: {
                type: 'line',
                yMin: [<?php echo $upper_limit; ?>],
                yMax: [<?php echo $upper_limit; ?>],
                borderColor: 'red',
                borderWidth: 2,
                label: {
                  display: true,
                  content: 'Upper Limit',
                  backgroundColor: 'rgba(255, 26, 104, 0)',
                  color: 'red',
                  position: 'top',
                  yAdjust: -6
                }
              },
              line2: {
                type: 'line',
                yMin: [<?php echo $lower_limit; ?>],
                yMax: [<?php echo $lower_limit; ?>],
                borderColor: 'red',
                borderWidth: 2,
                label: {
                  display: true,
                  content: 'Lower Limit',
                  backgroundColor: 'rgba(255, 26, 104, 0)',
                  color: 'red',
                  position: 'top',
                  yAdjust: -6
                }
              }
            }
          }
        }
			}
		});
    // LIGHT + WINSORIZING CHART
    var linechart = document.getElementById("light_winsorizing_chart").getContext('2d');
		var myChart2 = new Chart(linechart, {
			type: 'line',
			data: {
				labels: [<?php while ($waktu2 = mysqli_fetch_array($date_time2)) {echo '"'. $waktu2['date_time'] . '",';} ?>],
				datasets: [{
					label: 'Light (lux)',
					data: 
          [<?php 
            // WINSORIZING
            while ($cahaya2 = mysqli_fetch_array($light_4)) {
              if ($cahaya2['light'] > $upper_limit) {
                $cahaya2['light'] = $upper_limit;
              }
              elseif ($cahaya2['light'] < $lower_limit) {
                $cahaya2['light'] = $lower_limit;
              }
              echo '"' . $cahaya2['light'] . '",';
            } 
          ?>],
					backgroundColor: ['#A6B1E1'],
				}]
			},
			options: {
				responsive: true,
        plugins: {
          annotation: {
            annotations: {
              line1: {
                type: 'line',
                yMin: [<?php echo $upper_limit; ?>],
                yMax: [<?php echo $upper_limit; ?>],
                borderColor: 'red',
                borderWidth: 2,
                label: {
                  display: true,
                  content: 'Upper Limit',
                  backgroundColor: 'rgba(255, 26, 104, 0)',
                  color: 'red',
                  position: 'top',
                  yAdjust: -6
                }
              },
              line2: {
                type: 'line',
                yMin: [<?php echo $lower_limit; ?>],
                yMax: [<?php echo $lower_limit; ?>],
                borderColor: 'red',
                borderWidth: 2,
                label: {
                  display: true,
                  content: 'Lower Limit',
                  backgroundColor: 'rgba(255, 26, 104, 0)',
                  color: 'red',
                  position: 'top',
                  yAdjust: -6
                }
              }
            }
          }
        }
			}
		});
  </script>

  <!-- AJAX - jQuery -->
  <script>
    $(document).ready(function(){
      load_data();
      function load_data(page){
        $.ajax({
          url:"outlier_light_source.php",
          method:"POST",
          data:{page:page},
          success:function(data){
            $('#data').html(data);
          }
        })
      }
      $(document).on('click', '.halaman', function(){
        var page = $(this).attr("id");
        load_data(page);
      });
    });
  </script>
  
</body>

</html>

<?php } ?>