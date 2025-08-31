<?php 
include 'connection.php'; 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>AgriInventory Management System - Vendors & Orders</title>
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
      .wrapper {
        display: flex;
        min-height: 100vh;
      }
      .new-sidebar {
        background-color: #343a40; /* Kaiadmin dark theme */
        width: 200px;
        padding: 0;
        flex-shrink: 0;
      }
      .new-sidebar .sidebar-logo {
        text-align: center;
        padding: 10px 0;
        border-bottom: 1px solid #495057;
      }
      .new-sidebar .nav {
        margin-top: 10px;
      }
      .new-sidebar .nav-link {
        color: #adb5bd;
        padding: 10px 20px;
        display: flex;
        align-items: center;
        border-radius: 4px;
        margin: 5px 10px;
        transition: background-color 0.3s, color 0.3s;
      }
      .new-sidebar .nav-link:hover,
      .new-sidebar .nav-link.active {
        background-color: #34c38f; /* Kaiadmin green accent */
        color: #fff;
      }
      .new-sidebar .nav-link i {
        margin-right: 10px;
        font-size: 18px;
      }
      .new-sidebar .nav-link p {
        margin: 0;
        font-size: 14px;
        font-family: "Public Sans", sans-serif;
      }
      .main-panel {
        flex-grow: 1;
        background-color: #f5f7fb;
      }
      .new-header {
        background-color: #fff;
        border-bottom: 1px solid #dee2e6;
        padding: 10px 20px;
        display: flex;
        align-items: center;
        height: 61px; /* Match sidebar logo height */
      }
      .chart-card canvas {
        height: 100px !important;
        width: 100% !important;
      }
    </style>
  </head>
  <body>
    <div class="wrapper">
      <!-- New Sidebar -->
      <div class="new-sidebar">
        <div class="sidebar-logo">
          <a href="landing.php" class="logo">
            <img
              src="assets/img/agricultureLogo1.jpg"
              alt="navbar brand"
              class="navbar-brand"
              height="40"
            />
          </a>
        </div>
        <div class="sidebar-content">
          <ul class="nav">
            <li class="nav-item">
              <a href="landing.php" class="nav-link">
                <i class="fas fa-home"></i>
                <p>Home Page</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="vendorsAndOrders.php" class="nav-link active">
                <i class="fas fa-user-tie"></i>
                <p>Vendors & Orders</p>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <!-- End New Sidebar -->

      <div class="main-panel">
        <div class="new-header">
          <div class="container-fluid">
            <a href="landing.php" class="logo">
              <img
                src="assets/img/agricultureLogo1.jpg"
                alt="navbar brand"
                class="navbar-brand"
                height="40"
              />
            </a>
          </div>
        </div>

        <div class="container">
          <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
              <div>
                <h3 class="fw-bold mb-3">Vendors & Orders</h3>
                <h6 class="op-7 mb-2">Manage Vendors, Orders, Shipments, and Contracts</h6>
              </div>
              <div class="ms-md-auto py-2 py-md-0">
                <a href="#vendor-form" class="btn btn-primary btn-round">Add Vendor</a>
              </div>
            </div>

            <!-- Charts Section -->
            <div class="row">
              <div class="col-md-6">
                <div class="card card-round chart-card">
                  <div class="card-header">
                    <div class="card-title">Orders by Month</div>
                  </div>
                  <div class="card-body">
                    <canvas id="ordersChart"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card card-round chart-card">
                  <div class="card-header">
                    <div class="card-title">Vendor Distribution</div>
                  </div>
                  <div class="card-body">
                    <canvas id="vendorDistributionChart"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <!-- Vendor List Section -->
            <div class="row" id="vendor-section">
              <div class="col-md-12">
                <div class="card card-round">
                  <div class="card-header">
                    <div class="card-head-row">
                      <div class="card-title">Vendor List</div>
                      <div class="card-tools">
                        <a href="#vendor-form" class="btn btn-label-info btn-round btn-sm me-2">
                          <span class="btn-label">
                            <i class="fa fa-plus"></i>
                          </span>
                          Add Vendor
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table align-items-center mb-0">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">Vendor ID</th>
                            <th scope="col">Vendor Name</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Location</th>
                          </tr>
                        </thead>
                        <tbody id="vendorTableBody"></tbody>
                      </table>
                    </div>
                    <div class="mt-4" id="vendor-form">
                      <h4>Add New Vendor</h4>
                      <form id="vendorForm" class="row g-3">
                        <div class="col-md-6">
                          <label class="form-label">Vendor Name</label>
                          <input type="text" class="form-control" id="vendorName" required />
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Contact</label>
                          <input type="text" class="form-control" id="vendorContact" required />
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Location</label>
                          <input type="text" class="form-control" id="vendorLocation" required />
                        </div>
                        <div class="col-12">
                          <button type="submit" class="btn btn-primary">Add Vendor</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Orders Section -->
            <div class="row" id="orders-section">
              <div class="col-md-12">
                <div class="card card-round">
                  <div class="card-header">
                    <div class="card-head-row">
                      <div class="card-title">Orders</div>
                      <div class="card-tools">
                        <a href="#orders-form" class="btn btn-label-info btn-round btn-sm me-2">
                          <span class="btn-label">
                            <i class="fa fa-plus"></i>
                          </span>
                          Add Order
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table align-items-center mb-0">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Vendor ID</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Order Date</th>
                          </tr>
                        </thead>
                        <tbody id="ordersTableBody"></tbody>
                      </table>
                    </div>
                    <div class="mt-4" id="orders-form">
                      <h4>Add New Order</h4>
                      <form id="ordersForm" class="row g-3">
                        <div class="col-md-6">
                          <label class="form-label">Vendor ID</label>
                          <select class="form-control" id="orderVendorID" required></select>
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Item Name</label>
                          <input type="text" class="form-control" id="orderItemName" required />
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Order Date</label>
                          <input type="date" class="form-control" id="orderDate" required />
                        </div>
                        <div class="col-12">
                          <button type="submit" class="btn btn-primary">Add Order</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Order Shipments Section -->
            <div class="row" id="order-shipment-section">
              <div class="col-md-12">
                <div class="card card-round">
                  <div class="card-header">
                    <div class="card-head-row">
                      <div class="card-title">Order Shipments</div>
                      <div class="card-tools">
                        <a href="#order-shipment-form" class="btn btn-label-info btn-round btn-sm me-2">
                          <span class="btn-label">
                            <i class="fa fa-plus"></i>
                          </span>
                          Add Shipment
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table align-items-center mb-0">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">Shipment ID</th>
                            <th scope="col">Order ID</th>
                            <th scope="col">Destination</th>
                            <th scope="col">Ship Date</th>
                          </tr>
                        </thead>
                        <tbody id="orderShipmentTableBody"></tbody>
                      </table>
                    </div>
                    <div class="mt-4" id="order-shipment-form">
                      <h4>Add New Order Shipment</h4>
                      <form id="orderShipmentForm" class="row g-3">
                        <div class="col-md-6">
                          <label class="form-label">Order ID</label>
                          <select class="form-control" id="shipmentOrderID" required></select>
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Destination</label>
                          <input type="text" class="form-control" id="destination" required />
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Ship Date</label>
                          <input type="date" class="form-control" id="shipDate" required />
                        </div>
                        <div class="col-12">
                          <button type="submit" class="btn btn-primary">Add Shipment</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Vendor Contracts Section -->
            <div class="row" id="vendor-contracts-section">
              <div class="col-md-12">
                <div class="card card-round">
                  <div class="card-header">
                    <div class="card-head-row">
                      <div class="card-title">Vendor Contracts</div>
                      <div class="card-tools">
                        <a href="#vendor-contracts-form" class="btn btn-label-info btn-round btn-sm me-2">
                          <span class="btn-label">
                            <i class="fa fa-plus"></i>
                          </span>
                          Add Contract
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table align-items-center mb-0">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">Contract ID</th>
                            <th scope="col">Vendor ID</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                          </tr>
                        </thead>
                        <tbody id="vendorContractsTableBody"></tbody>
                      </table>
                    </div>
                    <div class="mt-4" id="vendor-contracts-form">
                      <h4>Add New Vendor Contract</h4>
                      <form id="vendorContractsForm" class="row g-3">
                        <div class="col-md-6">
                          <label class="form-label">Vendor ID</label>
                          <select class="form-control" id="contractVendorID" required></select>
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Start Date</label>
                          <input type="date" class="form-control" id="startDate" required />
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">End Date</label>
                          <input type="date" class="form-control" id="endDate" required />
                        </div>
                        <div class="col-12">
                          <button type="submit" class="btn btn-primary">Add Contract</button>
                        </div>
                      </form>
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
                  <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
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
      <script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
      <script src="assets/js/plugin/chart.js/chart.min.js"></script>
      <script src="assets/js/kaiadmin.min.js"></script>

      <script>
        $(document).ready(function () {
          // Sample data
          let vendors = [
            {
              vendorID: 1,
              vendorName: "Vendor A",
              contact: "contact@vendora.com",
              location: "City A",
            },
            {
              vendorID: 2,
              vendorName: "Vendor B",
              contact: "contact@vendorb.com",
              location: "City B",
            },
          ];
          let orders = [
            {
              orderID: 1,
              vendorID: 1,
              itemName: "Wheat Grain",
              orderDate: "2025-07-10",
            },
            {
              orderID: 2,
              vendorID: 2,
              itemName: "Corn Seed",
              orderDate: "2025-07-15",
            },
          ];
          let orderShipments = [
            {
              shipmentID: 1,
              orderID: 1,
              destination: "City C",
              shipDate: "2025-07-20",
            },
            {
              shipmentID: 2,
              orderID: 2,
              destination: "City D",
              shipDate: "2025-07-25",
            },
          ];
          let vendorContracts = [
            {
              contractID: 1,
              vendorID: 1,
              startDate: "2025-01-01",
              endDate: "2025-12-31",
            },
            {
              contractID: 2,
              vendorID: 2,
              startDate: "2025-02-01",
              endDate: "2025-12-31",
            },
          ];

          // Charts
          var ordersChart = new Chart(document.getElementById("ordersChart"), {
            type: "bar",
            data: {
              labels: ["July 2025", "August 2025", "September 2025"],
              datasets: [
                {
                  label: "Orders",
                  data: [50, 60, 55],
                  backgroundColor: "#34c38f",
                },
              ],
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              scales: {
                y: { beginAtZero: true, title: { display: true, text: "Number of Orders" } },
                x: { title: { display: true, text: "Month" } },
              },
              plugins: {
                legend: { display: false },
              },
            },
          });

          var vendorDistributionChart = new Chart(document.getElementById("vendorDistributionChart"), {
            type: "pie",
            data: {
              labels: ["Vendor A", "Vendor B"],
              datasets: [
                {
                  label: "Vendor Distribution",
                  data: [30, 20],
                  backgroundColor: ["#007bff", "#0056b3"],
                },
              ],
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              plugins: {
                legend: {
                  display: true,
                  position: "bottom",
                  labels: {
                    font: {
                      family: "Public Sans",
                      size: 12,
                    },
                  },
                },
              },
            },
          });

          // Populate dropdowns
          function populateVendorDropdown() {
            const vendorSelect = $("#orderVendorID, #contractVendorID");
            vendorSelect.html('<option value="">Select Vendor</option>');
            vendors.forEach((vendor) => {
              vendorSelect.append(
                `<option value="${vendor.vendorID}">${vendor.vendorName}</option>`
              );
            });
          }

          function populateOrderDropdown() {
            const orderSelect = $("#shipmentOrderID");
            orderSelect.html('<option value="">Select Order</option>');
            orders.forEach((order) => {
              orderSelect.append(
                `<option value="${order.orderID}">Order ${order.orderID}</option>`
              );
            });
          }

          // Display data
          function displayVendors() {
            const vendorTableBody = $("#vendorTableBody");
            vendorTableBody.empty();
            vendors.forEach((vendor) => {
              vendorTableBody.append(`
                <tr>
                  <td>${vendor.vendorID}</td>
                  <td>${vendor.vendorName}</td>
                  <td>${vendor.contact}</td>
                  <td>${vendor.location}</td>
                </tr>
              `);
            });
          }

          function displayOrders() {
            const ordersTableBody = $("#ordersTableBody");
            ordersTableBody.empty();
            orders.forEach((order) => {
              ordersTableBody.append(`
                <tr>
                  <td>${order.orderID}</td>
                  <td>${order.vendorID}</td>
                  <td>${order.itemName}</td>
                  <td>${order.orderDate}</td>
                </tr>
              `);
            });
          }

          function displayOrderShipments() {
            const orderShipmentTableBody = $("#orderShipmentTableBody");
            orderShipmentTableBody.empty();
            orderShipments.forEach((shipment) => {
              orderShipmentTableBody.append(`
                <tr>
                  <td>${shipment.shipmentID}</td>
                  <td>${shipment.orderID}</td>
                  <td>${shipment.destination}</td>
                  <td>${shipment.shipDate}</td>
                </tr>
              `);
            });
          }

          function displayVendorContracts() {
            const vendorContractsTableBody = $("#vendorContractsTableBody");
            vendorContractsTableBody.empty();
            vendorContracts.forEach((contract) => {
              vendorContractsTableBody.append(`
                <tr>
                  <td>${contract.contractID}</td>
                  <td>${contract.vendorID}</td>
                  <td>${contract.startDate}</td>
                  <td>${contract.endDate}</td>
                </tr>
              `);
            });
          }

          // Initialize data and tables
          populateVendorDropdown();
          populateOrderDropdown();
          displayVendors();
          displayOrders();
          displayOrderShipments();
          displayVendorContracts();

          // Form submissions
          $("#vendorForm").on("submit", function (e) {
            e.preventDefault();
            const newVendor = {
              vendorID: vendors.length + 1,
              vendorName: $("#vendorName").val(),
              contact: $("#vendorContact").val(),
              location: $("#vendorLocation").val(),
            };
            vendors.push(newVendor);
            displayVendors();
            populateVendorDropdown();
            this.reset();
            $.notify("Vendor added successfully!", "success");
          });

          $("#ordersForm").on("submit", function (e) {
            e.preventDefault();
            const newOrder = {
              orderID: orders.length + 1,
              vendorID: parseInt($("#orderVendorID").val()),
              itemName: $("#orderItemName").val(),
              orderDate: $("#orderDate").val(),
            };
            orders.push(newOrder);
            displayOrders();
            populateOrderDropdown();
            this.reset();
            $.notify("Order added successfully!", "success");
          });

          $("#orderShipmentForm").on("submit", function (e) {
            e.preventDefault();
            const newShipment = {
              shipmentID: orderShipments.length + 1,
              orderID: parseInt($("#shipmentOrderID").val()),
              destination: $("#destination").val(),
              shipDate: $("#shipDate").val(),
            };
            orderShipments.push(newShipment);
            displayOrderShipments();
            this.reset();
            $.notify("Order Shipment added successfully!", "success");
          });

          $("#vendorContractsForm").on("submit", function (e) {
            e.preventDefault();
            const newContract = {
              contractID: vendorContracts.length + 1,
              vendorID: parseInt($("#contractVendorID").val()),
              startDate: $("#startDate").val(),
              endDate: $("#endDate").val(),
            };
            vendorContracts.push(newContract);
            displayVendorContracts();
            this.reset();
            $.notify("Vendor Contract added successfully!", "success");
          });
        });
      </script>
    </body>
  </html>