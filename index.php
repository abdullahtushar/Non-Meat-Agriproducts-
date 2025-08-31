<?php
include 'connection.php'; // Include database connection
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>AgriInventory Management System - Admin Dashboard</title>
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

    <!-- Custom CSS for Sidebar and Charts -->
    <style>
      .chart-card canvas {
        height: 150px !important;
        width: 100% !important;
      }
    </style>
  </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      <div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
          <div class="logo-header" data-background-color="dark">
            <a href="landing.php" class="logo">
              <img
                src="assets/img/agricultureLogo1.jpg"
                alt="navbar brand"
                class="navbar-brand"
                height="40"
              />
              <span style="color: white; font-size: 18px; margin-left: 10px; font-weight: bold;">
      GreenHarvestFarm
    </span>
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <ul class="nav nav-secondary">
              <li class="nav-item">
                <a href="landing.php">
                  <i class="fas fa-home"></i>
                  <p>Home Page</p>
                </a>
              </li>
              <li class="nav-item active">
                <a href="dashboard.php">
                  <i class="fas fa-tachometer-alt"></i>
                  <p>Admin Dashboard</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="login.php">
                  <i class="fas fa-sign-out-alt"></i>
                  <p>Logout</p>
                </a>
              </li>
              <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Crop Management</h4>
              </li>
              <li class="nav-item">
                <a href="crops.php">
                  <i class="fas fa-leaf"></i>
                  <p>Crops</p>
                </a>
              </li>
              <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Inventory</h4>
              </li>
              <li class="nav-item">
                <a href="inventory.php">
                  <i class="fas fa-tractor"></i>
                  <p>Inventory</p>
                </a>
              </li>
              <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Storage</h4>
              </li>
              <li class="nav-item">
                <a href="storage.php">
                  <i class="fas fa-warehouse"></i>
                  <p>Storage</p>
                </a>
              </li>
              <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Packaging & Shipping</h4>
              </li>
              <li class="nav-item">
                <a href="packagingAndShipping.php">
                  <i class="fas fa-box"></i>
                  <p>Packaging & Shipping</p>
                </a>
              </li>
              <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Vendors & Orders</h4>
              </li>
              <li class="nav-item">
                <a href="vendorsAndOrders.php">
                  <i class="fas fa-users"></i>
                  <p>Vendors & Orders</p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- End Sidebar -->

      <div class="main-panel">
        <div class="main-header">
          <div class="main-header-logo">
            <div class="logo-header" data-background-color="dark">
              <a href="landing.php" class="logo">
                <img
                  src="assets/img/agricultureLogo1.jpg"
                  alt="navbar brand"
                  class="navbar-brand"
                  height="20"
                />
              </a>
              <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                  <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                  <i class="gg-menu-left"></i>
                </button>
              </div>
              <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
              </button>
            </div>
          </div>
          <nav
            class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom"
          >
            <div class="container-fluid">
              <nav
                class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex"
              >
                <div class="input-group">
                  <div class="input-group-prepend">
                    <button type="submit" class="btn btn-search pe-1">
                      <i class="fa fa-search search-icon"></i>
                    </button>
                  </div>
                  <input
                    type="text"
                    placeholder="Search ..."
                    class="form-control"
                  />
                </div>
              </nav>
              <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li
                  class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none"
                >
                  <a
                    class="nav-link dropdown-toggle"
                    data-bs-toggle="dropdown"
                    href="#"
                    role="button"
                    aria-expanded="false"
                    aria-haspopup="true"
                  >
                    <i class="fa fa-search"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-search animated fadeIn">
                    <form class="navbar-left navbar-form nav-search">
                      <div class="input-group">
                        <input
                          type="text"
                          placeholder="Search ..."
                          class="form-control"
                        />
                      </div>
                    </form>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
        </div>

        <div class="container">
          <div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3">Admin Dashboard</h3>
                <h6 class="op-7 mb-2">Overview of Crops, Storage, Orders, Packaging, and Vendors</h6>
              </div>
            </div>

            <div class="row">
              <!-- Crops Pie Chart -->
              <div class="col-md-4">
                <div class="card card-round chart-card">
                  <div class="card-header">
                    <div class="card-title">Crop Distribution</div>
                  </div>
                  <div class="card-body">
                    <canvas id="cropsChart" height="150"></canvas>
                  </div>
                </div>
              </div>
              <!-- Storage Pie Chart -->
              <div class="col-md-4">
                <div class="card card-round chart-card">
                  <div class="card-header">
                    <div class="card-title">Storage Capacity</div>
                  </div>
                  <div class="card-body">
                    <canvas id="storageChart" height="150"></canvas>
                  </div>
                </div>
              </div>
              <!-- Orders Bar Chart -->
              <div class="col-md-4">
                <div class="card card-round chart-card">
                  <div class="card-header">
                    <div class="card-title">Customer Orders</div>
                  </div>
                  <div class="card-body">
                    <canvas id="ordersChart" height="150"></canvas>
                  </div>
                </div>
              </div>
              <!-- Packaging Orders Bar Chart -->
              <div class="col-md-6">
                <div class="card card-round chart-card">
                  <div class="card-header">
                    <div class="card-title">Packaging Orders by Month</div>
                  </div>
                  <div class="card-body">
                    <canvas id="packagingOrdersChart" height="150"></canvas>
                  </div>
                </div>
              </div>
              <!-- Vendor Distribution Pie Chart -->
              <div class="col-md-6">
                <div class="card card-round chart-card">
                  <div class="card-header">
                    <div class="card-title">Vendor Distribution</div>
                  </div>
                  <div class="card-body">
                    <canvas id="vendorDistributionChart" height="150"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <footer class="footer">
          <div class="container-fluid d-flex justify-content-between">
            <nav class="pull-left">
              <ul class="nav">
                <li class="nav-item">
                  <a class="nav-link" href="#">Help</a>
                </li>
              </ul>
            </div>
            <div class="copyright">
              2025, AgriInventory Management System
            </div>
          </div>
        </footer>
      </div>
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
        // Crops Pie Chart
        var cropsChart = new Chart(document.getElementById("cropsChart"), {
          type: "pie",
          data: {
            labels: ["Wheat", "Rice", "Corn", "Barley"],
            datasets: [
              {
                data: [40, 30, 20, 10],
                backgroundColor: ["#1a73e8", "#34c38f", "#f1b44c", "#f46a6a"],
              },
            ],
          },
          options: {
            responsive: true,
            plugins: {
              legend: { position: "top" },
            },
          },
        });

        // Storage Pie Chart
        var storageChart = new Chart(document.getElementById("storageChart"), {
          type: "pie",
          data: {
            labels: ["Full", "Vacant"],
            datasets: [
              {
                data: [70, 30],
                backgroundColor: ["#34c38f", "#e8ecef"],
              },
            ],
          },
          options: {
            responsive: true,
            plugins: {
              legend: { position: "top" },
            },
          },
        });

        // Orders Bar Chart
        var ordersChart = new Chart(document.getElementById("ordersChart"), {
          type: "bar",
          data: {
            labels: ["2025-07-01", "2025-07-02", "2025-07-03", "2025-07-04"],
            datasets: [
              {
                label: "Orders",
                data: [15, 25, 10, 20],
                backgroundColor: "#1a73e8",
              },
            ],
          },
          options: {
            responsive: true,
            scales: {
              y: { beginAtZero: true },
            },
            plugins: {
              legend: { display: false },
            },
          },
        });

        // Packaging Orders Bar Chart
        var packagingOrdersChart = new Chart(document.getElementById("packagingOrdersChart"), {
          type: "bar",
          data: {
            labels: ["July 2025", "August 2025", "September 2025"],
            datasets: [
              {
                label: "Packaging Orders",
                data: [200, 250, 230],
                backgroundColor: "#34c38f",
              },
            ],
          },
          options: {
            responsive: true,
            scales: {
              y: { beginAtZero: true, title: { display: true, text: "Quantity (units)" } },
              x: { title: { display: true, text: "Month" } },
            },
            plugins: {
              legend: { display: false },
            },
          },
        });

        // Vendor Distribution Pie Chart
        var vendorDistributionChart = new Chart(document.getElementById("vendorDistributionChart"), {
          type: "pie",
          data: {
            labels: ["Vendor A", "Vendor B"],
            datasets: [
              {
                label: "Vendor Distribution",
                data: [30, 20],
                backgroundColor: ["#1a73e8", "#34c38f"],
              },
            ],
          },
          options: {
            responsive: true,
            plugins: {
              legend: { position: "top" },
            },
          },
        });
      });
    </script>
  </body>
</html>