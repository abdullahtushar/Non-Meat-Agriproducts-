<?php 
include 'connection.php'; 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>AgriInventory Management System - Packaging & Shipping</title>
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
              <a href="packagingAndShipping.php" class="nav-link active">
                <i class="fas fa-box-open"></i>
                <p>Packaging & Shipping</p>
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
                <h3 class="fw-bold mb-3">Packaging & Shipping</h3>
                <h6 class="op-7 mb-2">Manage Batch Packages, Packaged Items, Shipments, and Facilities</h6>
              </div>
              <div class="ms-md-auto py-2 py-md-0">
                <a href="#batch-form" class="btn btn-primary btn-round">Add Batch Package</a>
              </div>
            </div>

            <!-- Charts Section -->
            <div class="row">
              <div class="col-md-6">
                <div class="card card-round chart-card">
                  <div class="card-header">
                    <div class="card-title">Shipments by Month</div>
                  </div>
                  <div class="card-body">
                    <canvas id="shipmentsChart"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card card-round chart-card">
                  <div class="card-header">
                    <div class="card-title">Batch Sizes by Facility</div>
                  </div>
                  <div class="card-body">
                    <canvas id="batchSizesChart"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <!-- Batch Package Section -->
            <div class="row" id="batch-section">
              <div class="col-md-12">
                <div class="card card-round">
                  <div class="card-header">
                    <div class="card-head-row">
                      <div class="card-title">Batch Packages</div>
                      <div class="card-tools">
                        <a href="#batch-form" class="btn btn-label-info btn-round btn-sm me-2">
                          <span class="btn-label">
                            <i class="fa fa-plus"></i>
                          </span>
                          Add Batch
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table align-items-center mb-0">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">Batch ID</th>
                            <th scope="col">Batch Size</th>
                            <th scope="col">Packing Date</th>
                            <th scope="col">Expiry Date</th>
                          </tr>
                        </thead>
                        <tbody>
<?php
                          // Fetch all batches
$sql = "SELECT batch_id, batch_size, packing_date, expiry_date FROM batches ORDER BY batch_id DESC";
$result = $conn->query($sql);

// Display table rows
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['batch_id'] . "</td>";
        echo "<td>" . $row['batch_size'] . "</td>";
        echo "<td>" . $row['packing_date'] . "</td>";
        echo "<td>" . $row['expiry_date'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4' class='text-center'>No batches found</td></tr>";
}
?>
                        </tbody>
                      </table>
                    </div>
                    <div class="mt-4" id="batch-form">
                      <h4>Add New Batch Package</h4>
                      <form id="batchForm" class="row g-3" action="savepackagingAndShipping.php" method="POST">
                        <div class="col-md-6">
                          <label class="form-label">Batch Size</label>
                          <input name="batchSize" type="number" class="form-control" id="batchSize" required />
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Packing Date</label>
                          <input name="packingDate" type="date" class="form-control" id="packingDate" required />
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Expiry Date</label>
                          <input name="batchExpiryDate" type="date" class="form-control" id="batchExpiryDate" required />
                        </div>
                        <div class="col-12">
                          <button type="submit" class="btn btn-primary">Add Batch</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Packaged Item Section -->
            <div class="row" id="packaged-item-section">
              <div class="col-md-12">
                <div class="card card-round">
                  <div class="card-header">
                    <div class="card-head-row">
                      <div class="card-title">Packaged Items</div>
                      <div class="card-tools">
                        <a href="#packaged-item-form" class="btn btn-label-info btn-round btn-sm me-2">
                          <span class="btn-label">
                            <i class="fa fa-plus"></i>
                          </span>
                          Add Packaged Item
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table align-items-center mb-0">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">Item ID</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Batch ID</th>
                          </tr>
                        </thead>
                        <tbody id="packagedItemTableBody"></tbody>
                      </table>
                    </div>
                    <div class="mt-4" id="packaged-item-form">
                      <h4>Add New Packaged Item</h4>
                      <form id="packagedItemForm" class="row g-3">
                        <div class="col-md-6">
                          <label class="form-label">Item Name</label>
                          <input type="text" class="form-control" id="itemName" required />
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Quantity</label>
                          <input type="number" class="form-control" id="itemQuantity" required />
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Batch ID</label>
                          <select class="form-control" id="itemBatchID" required></select>
                        </div>
                        <div class="col-12">
                          <button type="submit" class="btn btn-primary">Add Packaged Item</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Shipment Package Section -->
            <div class="row" id="shipment-section">
              <div class="col-md-12">
                <div class="card card-round">
                  <div class="card-header">
                    <div class="card-head-row">
                      <div class="card-title">Shipment Packages</div>
                      <div class="card-tools">
                        <a href="#shipment-form" class="btn btn-label-info btn-round btn-sm me-2">
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
                            <th scope="col">Batch ID</th>
                            <th scope="col">Facility ID</th>
                            <th scope="col">Destination</th>
                            <th scope="col">Ship Date</th>
                          </tr>
                        </thead>
                        <tbody id="shipmentTableBody"></tbody>
                      </table>
                    </div>
                    <div class="mt-4" id="shipment-form">
                      <h4>Add New Shipment Package</h4>
                      <form id="shipmentForm" class="row g-3">
                        <div class="col-md-6">
                          <label class="form-label">Batch ID</label>
                          <select class="form-control" id="shipmentBatchID" required></select>
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Facility ID</label>
                          <select class="form-control" id="facilityID" required></select>
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

            <!-- Packaging Facility Section -->
            <div class="row" id="facility-section">
              <div class="col-md-12">
                <div class="card card-round">
                  <div class="card-header">
                    <div class="card-head-row">
                      <div class="card-title">Packaging Facilities</div>
                      <div class="card-tools">
                        <a href="#facility-form" class="btn btn-label-info btn-round btn-sm me-2">
                          <span class="btn-label">
                            <i class="fa fa-plus"></i>
                          </span>
                          Add Facility
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table align-items-center mb-0">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">Facility ID</th>
                            <th scope="col">Location</th>
                            <th scope="col">Warehouse ID</th>
                          </tr>
                        </thead>
                        <tbody id="facilityTableBody"></tbody>
                      </table>
                    </div>
                    <div class="mt-4" id="facility-form">
                      <h4>Add New Packaging Facility</h4>
                      <form id="facilityForm" class="row g-3">
                        <div class="col-md-6">
                          <label class="form-label">Location</label>
                          <input type="text" class="form-control" id="facilityLocation" required />
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Warehouse ID</label>
                          <select class="form-control" id="facilityWarehouseID" required></select>
                        </div>
                        <div class="col-12">
                          <button type="submit" class="btn btn-primary">Add Facility</button>
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
          let batchPackages = [
            {
              batchID: 1,
              batchSize: 100,
              packingDate: "2025-07-20",
              expiryDate: "2026-07-20",
            },
            {
              batchID: 2,
              batchSize: 150,
              packingDate: "2025-07-22",
              expiryDate: "2026-07-22",
            },
          ];
          let packagedItems = [
            {
              itemID: 1,
              itemName: "Wheat Package",
              quantity: 50,
              batchID: 1,
            },
            {
              itemID: 2,
              itemName: "Rice Package",
              quantity: 70,
              batchID: 2,
            },
          ];
          let shipmentPackages = [
            {
              shipmentID: 1,
              batchID: 1,
              facilityID: 1,
              destination: "City A",
              shipDate: "2025-07-25",
            },
            {
              shipmentID: 2,
              batchID: 2,
              facilityID: 2,
              destination: "City B",
              shipDate: "2025-07-26",
            },
          ];
          let packagingFacilities = [
            {
              facilityID: 1,
              location: "Facility A",
              warehouseID: 1,
            },
            {
              facilityID: 2,
              location: "Facility B",
              warehouseID: 2,
            },
          ];
          let warehouses = [
            {
              warehouseID: 1,
              location: "Warehouse A",
              storageCapacity: "1000 tons",
              storageFeatures: "Climate control",
            },
            {
              warehouseID: 2,
              location: "Warehouse B",
              storageCapacity: "800 tons",
              storageFeatures: "Ventilated",
            },
          ];

          // Charts
          var shipmentsChart = new Chart(document.getElementById("shipmentsChart"), {
            type: "bar",
            data: {
              labels: ["July 2025", "August 2025", "September 2025"],
              datasets: [
                {
                  label: "Shipments",
                  data: [50, 70, 60],
                  backgroundColor: "#34c38f",
                },
              ],
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              scales: {
                y: { beginAtZero: true, title: { display: true, text: "Shipments" } },
                x: { title: { display: true, text: "Month" } },
              },
              plugins: {
                legend: { display: false },
              },
            },
          });

          var batchSizesChart = new Chart(document.getElementById("batchSizesChart"), {
            type: "pie",
            data: {
              labels: ["Facility A", "Facility B"],
              datasets: [
                {
                  label: "Batch Size",
                  data: [250, 300],
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
          function populateBatchDropdown() {
            const batchSelect = $("#itemBatchID, #shipmentBatchID");
            batchSelect.html('<option value="">Select Batch</option>');
            batchPackages.forEach((batch) => {
              batchSelect.append(
                `<option value="${batch.batchID}">Batch ${batch.batchID}</option>`
              );
            });
          }

          function populateFacilityDropdown() {
            const facilitySelect = $("#facilityID");
            facilitySelect.html('<option value="">Select Facility</option>');
            packagingFacilities.forEach((facility) => {
              facilitySelect.append(
                `<option value="${facility.facilityID}">${facility.location}</option>`
              );
            });
          }

          function populateWarehouseDropdown() {
            const warehouseSelect = $("#facilityWarehouseID");
            warehouseSelect.html('<option value="">Select Warehouse</option>');
            warehouses.forEach((warehouse) => {
              warehouseSelect.append(
                `<option value="${warehouse.warehouseID}">${warehouse.location}</option>`
              );
            });
          }

          // Display data
          function displayBatchPackages() {
            const batchTableBody = $("#batchTableBody");
            batchTableBody.empty();
            batchPackages.forEach((batch) => {
              batchTableBody.append(`
                <tr>
                  <td>${batch.batchID}</td>
                  <td>${batch.batchSize}</td>
                  <td>${batch.packingDate}</td>
                  <td>${batch.expiryDate}</td>
                </tr>
              `);
            });
          }

          function displayPackagedItems() {
            const packagedItemTableBody = $("#packagedItemTableBody");
            packagedItemTableBody.empty();
            packagedItems.forEach((item) => {
              packagedItemTableBody.append(`
                <tr>
                  <td>${item.itemID}</td>
                  <td>${item.itemName}</td>
                  <td>${item.quantity}</td>
                  <td>${item.batchID}</td>
                </tr>
              `);
            });
          }

          function displayShipmentPackages() {
            const shipmentTableBody = $("#shipmentTableBody");
            shipmentTableBody.empty();
            shipmentPackages.forEach((shipment) => {
              shipmentTableBody.append(`
                <tr>
                  <td>${shipment.shipmentID}</td>
                  <td>${shipment.batchID}</td>
                  <td>${shipment.facilityID}</td>
                  <td>${shipment.destination}</td>
                  <td>${shipment.shipDate}</td>
                </tr>
              `);
            });
          }

          function displayPackagingFacilities() {
            const facilityTableBody = $("#facilityTableBody");
            facilityTableBody.empty();
            packagingFacilities.forEach((facility) => {
              facilityTableBody.append(`
                <tr>
                  <td>${facility.facilityID}</td>
                  <td>${facility.location}</td>
                  <td>${facility.warehouseID}</td>
                </tr>
              `);
            });
          }

          // Initialize data and tables
          populateBatchDropdown();
          populateFacilityDropdown();
          populateWarehouseDropdown();
          displayBatchPackages();
          displayPackagedItems();
          displayShipmentPackages();
          displayPackagingFacilities();

          // Form submissions
          
          $("#packagedItemForm").on("submit", function (e) {
            e.preventDefault();
            const newItem = {
              itemID: packagedItems.length + 1,
              itemName: $("#itemName").val(),
              quantity: parseInt($("#itemQuantity").val()),
              batchID: parseInt($("#itemBatchID").val()),
            };
            packagedItems.push(newItem);
            displayPackagedItems();
            this.reset();
            $.notify("Packaged Item added successfully!", "success");
          });

          $("#shipmentForm").on("submit", function (e) {
            e.preventDefault();
            const newShipment = {
              shipmentID: shipmentPackages.length + 1,
              batchID: parseInt($("#shipmentBatchID").val()),
              facilityID: parseInt($("#facilityID").val()),
              destination: $("#destination").val(),
              shipDate: $("#shipDate").val(),
            };
            shipmentPackages.push(newShipment);
            displayShipmentPackages();
            this.reset();
            $.notify("Shipment Package added successfully!", "success");
          });

          $("#facilityForm").on("submit", function (e) {
            e.preventDefault();
            const newFacility = {
              facilityID: packagingFacilities.length + 1,
              location: $("#facilityLocation").val(),
              warehouseID: parseInt($("#facilityWarehouseID").val()),
            };
            packagingFacilities.push(newFacility);
            displayPackagingFacilities();
            populateFacilityDropdown();
            this.reset();
            $.notify("Packaging Facility added successfully!", "success");
          });
        });
      </script>
    </body>
  </html>