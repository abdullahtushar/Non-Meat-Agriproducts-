<?php 
include 'connection.php'; 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>AgriInventory Management System - Welcome</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link
      rel="icon"
      href="assets/img/kaiadmin/favicon.ico"
      type="image/x-icon"
    />

    <!-- Fonts and icons -->
    <script src="assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["assets/css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/plugins.min.css" />
    <link rel="stylesheet" href="assets/css/kaiadmin.min.css" />
    <link rel="stylesheet" href="assets/css/demo.css" />

    <!-- Custom CSS -->
    <style>
      body {
        background: linear-gradient(135deg, #34c38f 0%, #1a73e8 100%);
        min-height: 100vh;
        font-family: "Public Sans", sans-serif;
        color: #fff;
      }
      .navbar {
        background-color: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        transition: background-color 0.3s ease;
      }
      .navbar .btn {
        border-radius: 8px;
        padding: 8px 20px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
      }
      .navbar .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
      }
      .navbar .btn-primary {
        background-color: #34c38f;
        border-color: #34c38f;
      }
      .navbar .btn-primary:hover {
        background-color: #28a745;
      }
      .navbar .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
      }
      .navbar .btn-secondary:hover {
        background-color: #5a6268;
      }
      .hero-section {
        text-align: center;
        padding: 50px 0;
        animation: fadeIn 1s ease-in-out;
      }
      .hero-section img {
        max-height: 150px;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
        transition: transform 0.3s ease;
      }
      .hero-section img:hover {
        transform: scale(1.05);
      }
      .hero-section h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
      }
      .hero-section h4 {
        font-size: 1.25rem;
        opacity: 0.9;
        margin-bottom: 30px;
      }
      .card {
        background-color: rgba(255, 255, 255, 0.95);
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
      }
      .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.3);
      }
      .card-header {
        background-color: transparent;
        border-bottom: none;
      }
      .card-title {
        font-size: 1.5rem;
        color: #343a40;
        font-weight: 600;
      }
      .card-body p, .card-body ul {
        color: #495057;
      }
      .card-body ul li {
        margin-bottom: 10px;
        transition: color 0.3s ease;
      }
      .card-body ul li:hover {
        color: #34c38f;
      }
      .chart-card canvas {
        height: 200px !important;
        width: 100% !important;
      }
      .footer {
        background-color: rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
        color: #fff;
        padding: 20px 0;
      }
      .footer a {
        color: #fff;
        transition: color 0.3s ease;
      }
      .footer a:hover {
        color: #34c38f;
      }
      @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
      }
    </style>
  </head>
  <body>
    <div class="wrapper">
      <!-- Header -->
      <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
        <div class="container-fluid">
          <a href="landing.php" class="logo">
            <img
              src="assets/img/agricultureLogo1.jpg"
              alt="navbar brand"
              class="navbar-brand"
              height="40"
            />
          </a>
          <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
  <li class="nav-item">
  <a href="login.php" class="btn btn-primary btn-round me-2">Login</a>
</li>
<li class="nav-item">
  <a href="register.php" class="btn btn-secondary btn-round">Sign Up</a>
</li>

</ul>

        </div>
      </nav>

      <!-- Main Content -->
      <div class="container">
        <div class="page-inner">
          <!-- Hero Section -->
          <div class="row mt-4 hero-section">
            <div class="col-md-12 text-center">
              <h1 class="fw-bold mb-3">Welcome to AgriInventory Management System</h1>
              <h4 class="op-7 mb-4">
                Streamline your agricultural operations with our comprehensive management platform
              </h4>
              <img
                src="assets/img/agricultureLogo1.jpg"
                alt="AgriInventory Logo"
                class="img-fluid mb-4"
                style="max-height: 150px;"
              />
            </div>
          </div>

          <!-- Project Ideas Section -->
          <div class="row">
            <div class="col-md-12">
              <div class="card card-round">
                <div class="card-header">
                  <div class="card-title">About Our Project</div>
                </div>
                <div class="card-body">
                  <p>
                    The AgriInventory Management System is designed to empower farmers, agribusinesses, and agricultural cooperatives by providing tools to manage crops, inventory, storage, packaging, shipping, and vendor relationships efficiently. Our mission is to enhance productivity and sustainability in agriculture through technology.
                  </p>
                  <h5 class="mt-4">Key Features:</h5>
                  <ul>
                    <li><strong>Crop Management</strong>: Track crop types, planting, and harvest schedules to optimize yields.</li>
                    <li><strong>Inventory Tracking</strong>: Monitor farming units and resource requirements in real-time.</li>
                    <li><strong>Storage Management</strong>: Manage warehouse capacity and storage conditions for harvested crops.</li>
                    <li><strong>Packaging & Shipping</strong>: Streamline batch packaging and shipment processes for efficient distribution.</li>
                    <li><strong>Vendor & Order Management</strong>: Maintain vendor relationships and track orders seamlessly.</li>
                  </ul>
                  <p>
                    Whether you're a small-scale farmer or a large agricultural enterprise, our platform provides a user-friendly interface to manage all aspects of your operations, backed by data-driven insights.
                  </p>
                </div>
              </div>
            </div>
          </div>

          <!-- Usage Statistics Section -->
          <div class="row mt-4">
            <div class="col-md-12">
              <div class="card card-round chart-card">
                <div class="card-header">
                  <div class="card-title">Website Usage Statistics</div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <h5>Monthly Active Users</h5>
                      <canvas id="usersChart" height="200"></canvas>
                    </div>
                    <div class="col-md-6">
                      <h5>Page Views by Section</h5>
                      <canvas id="pageViewsChart" height="200"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <footer class="footer">
        <div class="container-fluid d-flex justify-content-between">
          <nav class="pull-left">
            <ul class="nav">
              <li class="nav-item">
                <a class="nav-link" href="#">Contact Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About</a>
              </li>
            </ul>
          </nav>
          <div class="copyright">
            2025, AgriInventory Management System
          </div>
        </div>
      </footer>
    </div>

    <!-- Core JS Files -->
    <script src="assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script src="assets/js/plugin/chart.js/chart.min.js"></script>
    <script src="assets/js/kaiadmin.min.js"></script>

    <script>
      $(document).ready(function () {
        // Monthly Active Users Bar Chart
        var usersChart = new Chart(document.getElementById("usersChart"), {
          type: "bar",
          data: {
            labels: ["Jan 2025", "Feb 2025", "Mar 2025", "Apr 2025", "May 2025", "Jun 2025"],
            datasets: [
              {
                label: "Active Users",
                data: [120, 150, 180, 200, 230, 250],
                backgroundColor: "#1a73e8",
              },
            ],
          },
          options: {
            responsive: true,
            scales: {
              y: { 
                beginAtZero: true,
                title: { display: true, text: "Users" }
              },
              x: { title: { display: true, text: "Month" } }
            },
            plugins: {
              legend: { display: false },
            },
          },
        });

        // Page Views by Section Bar Chart
        var pageViewsChart = new Chart(document.getElementById("pageViewsChart"), {
          type: "bar",
          data: {
            labels: ["Crops", "Inventory", "Storage", "Packaging", "Orders"],
            datasets: [
              {
                label: "Page Views",
                data: [500, 400, 300, 250, 200],
                backgroundColor: "#34c38f",
              },
            ],
          },
          options: {
            responsive: true,
            scales: {
              y: { 
                beginAtZero: true,
                title: { display: true, text: "Views" }
              },
              x: { title: { display: true, text: "Section" } }
            },
            plugins: {
              legend: { display: false },
            },
          },
        });
      });
    </script>
  </body>
</html>