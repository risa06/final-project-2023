<?php
  include "connection.php";

  // Menampung sementara data co2 ke dalam array $value[]
  $co2_2 = mysqli_query($connection,"SELECT co2 FROM datatraining");
  while ($result = mysqli_fetch_array($co2_2)) {
      $value[] = $result['co2'];
  }
  // echo max($value);
  // echo min($value);

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
  <title>Visualization - CO2</title>

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
          <div class="nav-link">Visualization</div>
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
              <h1 class="m-0">CO<sub>2</sub></h1>
            </div>
          </div>
        </div>
      </div>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12"> 

              <!-- CO2 CHART -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">CO<sub>2</sub></h3>
                </div>
                <div class="card-body">
                  <div class="chart">
                    <canvas id="co2_chart"></canvas>
                    <hr color="#A6B1E1" size="1px" style="margin: 10px 0px">      
                    <h3>Info</h3>
                    <table border="1">
                      <tr>
                        <th>Total records</th><td>:</td><td><?php echo $total_records_co2; ?></td>
                      </tr>
                      <tr>
                        <th>Minimum</th><td>:</td><td><?php echo min($value); ?></td>
                      </tr>
                      <tr>
                        <th>Maximum</th><td>:</td><td><?php echo max($value); ?></td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>

              <!-- OCCUPANCY CHART -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Occupancy</h3>
                </div>
                <div class="card-body">
                  <canvas id="occupancy_chart"></canvas>

                  <hr color="#A6B1E1" size="1px" style="margin: 10px 0px">              
                        
                  <h3>Info</h3>
                  <table border="1">
                    <tr>
                      <th>0</th>
                        <td>:</td>
                        <td>Not Occupied</td>
                    </tr>
                    <tr>
                      <th>1</th>
                        <td>:</td>
                        <td>Occupied</td>
                    </tr>
                  </table>

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
    // CO2 CHART
    var linechart = document.getElementById("co2_chart").getContext('2d');
		var myChart = new Chart(linechart, {
			type: 'line',
			data: {
				labels: [<?php while ($waktu = mysqli_fetch_array($date_time)) {echo '"'. $waktu['date_time'] . '",';} ?>],
				datasets: [{
					label: 'CO2 (part per million)',
					data: [<?php while ($gas = mysqli_fetch_array($co2)) {echo '"' . $gas['co2'] . '",';} ?>],
					backgroundColor: ['#A6B1E1'],
				}]
			},
			options: {
				responsive: true,
			}
		});
    // OCCUPANCY CHART
    var linechart2 = document.getElementById("occupancy_chart").getContext('2d');
		var myChart2 = new Chart(linechart2, {
			type: 'line',
			data: {
				labels: [<?php while ($waktu2 = mysqli_fetch_array($date_time2)) {echo '"'. $waktu2['date_time'] . '",';} ?>],
				datasets: [{
					label: 'Occupancy',
					data: [<?php while ($hunian = mysqli_fetch_array($occupancy)) {echo '"' . $hunian['occupancy'] . '",';} ?>],
					backgroundColor: ['#A6B1E1'],
				}]
			},
			options: {
				responsive: true,
			}
		});
  </script>
  
</body>

</html>

<?php } ?>