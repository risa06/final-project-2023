<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        .nav-pills .nav-link.active {
			color: #F4EEFF;
    		background-color: #A6B1E1;
		}
    </style>

</head>

<body>

	<!-- Aside -->
	<aside class="main-sidebar elevation-4">
		<!-- Logo -->
		<a href="index.php" class="brand-link">
			<div class="d-flex">
				<div class="my-auto">
					<i class="fa-solid fa-house-signal brand-image" style="color: #F4EEFF; font-size: 25px;"></i>
				</div>
				<span class="brand-text logo-text">Smart Home</span>
			</div>
		</a>

		<!-- Sidebar -->
		<div class="sidebar">
			<!-- User -->
			<div class="user-panel mt-3 pb-3 mb-3 d-flex">
				<div class="image my-auto">
					<i class="fa-solid fa-circle-user" style="color: #F4EEFF; font-size: 33px"></i>
				</div>
				<div class="info">
					<div class="d-block user"><?php echo $_SESSION['name']; ?></div>
				</div>
			</div>

			<!-- Sidebar Menu -->
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<!-- Home -->
					<li class="nav-item">
						<a href="index.php" class="nav-link">
							<i class="nav-icon fas fa-home" style="color: #F4EEFF;"></i>
							<p class="sidebar-p">
								Home
							</p>
						</a>
					</li>
					<!-- Data -->
					<li class="nav-item">
						<a href="data.php" class="nav-link">
							<i class="nav-icon fas fa-table" style="color: #F4EEFF;"></i>
							<p class="sidebar-p">
								Data
							</p>
						</a>
					</li>
					<!-- Visualization -->
					<li class="nav-item">
						<a href="#" class="nav-link">
							<i class="nav-icon fa-solid fa-chart-line" style="color: #F4EEFF;"></i>
							<p class="sidebar-p">
								Visualization
								<i class="fas fa-angle-right right" style="color: #F4EEFF;"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="visual_temperature.php" class="nav-link">
									<i class="nav-icon fas fa-thermometer-half" style="color: #424874; font-size: 15px"></i>
									<p>Temperature</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="visual_humidity.php" class="nav-link">
									<i class="nav-icon fas fa-tint" style="color: #424874; font-size: 15px"></i>
									<p>Humidity</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="visual_light.php" class="nav-link">
									<i class="nav-icon fas fa-lightbulb" style="color: #424874; font-size: 15px"></i>
									<p>Light</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="visual_co2.php" class="nav-link">
									<i class="nav-icon fas fa-cloud" style="color: #424874; font-size: 15px"></i>
									<p>CO<sub>2</sub></p>
								</a>
							</li>
						</ul>
					</li>
					<!-- Outlier -->
					<li class="nav-item">
						<a href="#" class="nav-link">
							<i class="nav-icon fas fa-chart-pie" style="color: #F4EEFF;"></i>
							<p class="sidebar-p">
								Outlier
								<i class="fas fa-angle-right right" style="color: #F4EEFF;"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="outlier_temperature.php" class="nav-link">
									<i class="nav-icon fas fa-thermometer-half" style="color: #424874; font-size: 15px"></i>
									<p>Temperature</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="outlier_humidity.php" class="nav-link">
									<i class="nav-icon fas fa-tint" style="color: #424874; font-size: 15px"></i>
									<p>Humidity</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="outlier_light.php" class="nav-link">
									<i class="nav-icon fas fa-lightbulb" style="color: #424874; font-size: 15px"></i>
									<p>Light</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="outlier_co2.php" class="nav-link">
									<i class="nav-icon fas fa-cloud" style="color: #424874; font-size: 15px"></i>
									<p>CO<sub>2</sub></p>
								</a>
							</li>
						</ul>
					</li>
					<!-- Logout -->
					<li class="nav-item">
						<a href="logout.php" class="nav-link">
							<i class="nav-icon fa-solid fa-arrow-right-from-bracket" style="color: #F4EEFF;"></i>
							<p class="sidebar-p">
								Logout
							</p>
						</a>
					</li>
				</ul>
			</nav>
			
		</div>

	</aside>

	<script>
		// add active class and stay opened when selected 
		var url = window.location;

		// for sidebar menu entirely but not cover treeview
		$('ul.nav-sidebar a').filter(function() {
			return this.href == url;
		}).addClass('active');

		// for treeview
		$('ul.nav-treeview a').filter(function() {
			return this.href == url;
		}).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
	</script>

</body>

</html>