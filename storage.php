<?php 
include 'connection.php'; 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>AgriInventory Management System - Storage</title>
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
              <a href="storage.php" class="nav-link active">
                <i class="fas fa-boxes"></i>
                <p>Storage</p>
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
                <h3 class="fw-bold mb-3">Storage</h3>
                <h6 class="op-7 mb-2">Manage Storage Batches, Items, Shipments, and Facilities</h6>
              </div>
              <div class="ms-md-auto py-2 py-md-0">
                <a href="#storage-batch-form" class="btn btn-primary btn-round">Add Storage Batch</a>
              </div>
            </div>

            <!-- Charts Section -->
            <div class="row">
              <div class="col-md-6">
                <div class="card card-round chart-card">
                  <div class="card-header">
                    <div class="card-title">Storage Utilization by Month</div>
                  </div>
                  <div class="card-body">
                    <canvas id="storageUtilizationChart"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card card-round chart-card">
                  <div class="card-header">
                    <div class="card-title">Storage Types Distribution</div>
                  </div>
                  <div class="card-body">
                    <canvas id="storageTypesChart"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <!-- Storage Batch Section -->
            <div class="row" id="storage-batch-section">
              <div class="col-md-12">
                <div class="card card-round">
                  <div class="card-header">
                    <div class="card-head-row">
                      <div class="card-title">Storage Batches</div>
                      <div class="card-tools">
                        <a href="#storage-batch-form" class="btn btn-label-info btn-round btn-sm me-2">
                          <span class="btn-label">
                            <i class="fa fa-plus"></i>
                          </span>
                          Add Storage Batch
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
                            <th scope="col">Storage Type</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Stored Date</th>
                          </tr>
                        </thead>
                        <tbody>
                           <?php
                          // Fetch records
              $sql = "SELECT id, storage_type, quantity, stored_date 
                      FROM storage_batches 
                         ORDER BY id DESC";
                 $result = $conn->query($sql);

                 if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . htmlspecialchars($row['storage_type']) . "</td>
                <td>" . $row['quantity'] . "</td>
                <td>" . $row['stored_date'] . "</td>
              </tr>";
                         }
                      } else {
                         echo "<tr><td colspan='4'>No storage batches found</td></tr>";
                 }
                           ?>
                        </tbody>
                      </table>
                    </div>
                    <div class="mt-4" id="storage-batch-form">
  <h4>Add New Storage Batch</h4>
  <form id="storageBatchForm" class="row g-3" action="savestorage.php" method="POST">
    <div class="col-md-6">
      <label class="form-label">Storage Type</label>
      <input name="storageType" type="text" class="form-control" id="storageType" required />
    </div>
    <div class="col-md-6">
      <label class="form-label">Quantity</label>
      <input name="batchQuantity" type="number" class="form-control" id="batchQuantity" required />
    </div>
    <div class="col-md-6">
      <label class="form-label">Stored Date</label>
      <input name="storedDate" type="date" class="form-control" id="storedDate" required />
    </div>
    <div class="col-12">
      <button type="submit" class="btn btn-primary">Add Storage Batch</button>
    </div>
  </form>
</div>


               <!-- Stored Items Section -->
             <div class="row" id="stored-items-section">

                 <div class="col-md-12">
                  <div class="card card-round">
                   <div class="card-header">
                    <div class="card-head-row">
                     <div class="card-title">Stored Items</div>
                      <div class="card-tools">
                        <a href="#stored-items-form" class="btn btn-label-info btn-round btn-sm me-2">
                       <span class="btn-label">
                     <i class="fa fa-plus"></i>
                    </span>
                   Add Stored Item
                 </a>
               </div>
              </div>
            </div>
             <!-- Add Sensor Data Chart after the header -->
              <div class="card card-round chart-card">
                <div class="card-header">
                 <div class="card-title">Sensor Data</div>
                  </div>
                   <div class="card-body">
                  <canvas id="sensorChart"></canvas>
                </div>
              </div>
             <script>
             var sensorChart = new Chart(document.getElementById("sensorChart"), {
               type: "line",
                data: {
                  labels: ["12:00", "12:05", "12:10", "12:15"], // Sample timestamps from tblsensordata
                  datasets: [
                 {
                  label: "Temperature",
                  data: [25.5, 24.8, 25.1, 24.9], // Sample data from tblsensordata
                  backgroundColor: "#34c38f",
                  },
                {
                  label: "Humidity",
                  data: [60.2, 62.1, 61.5, 63.0],
                  backgroundColor: "#1a73e8",
                 },
                       ],
                    },
                       options: {
                     responsive: true,
                       plugins: {
                      legend: { display: true },
                        },
                        },
                           });
                      </script>
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
                           <tbody id="storedItemsTableBody"></tbody>
                              </table>
                               </div>
                               </div>
                                     </div>
                                  </div>
                               </div>
                    <div class="mt-4" id="stored-items-form">
                      <h4>Add New Stored Item</h4>
                      <form id="storedItemsForm" class="row g-3">
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
                          <button type="submit" class="btn btn-primary">Add Stored Item</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Storage Shipments Section -->
            <div class="row" id="storage-shipment-section">
              <div class="col-md-12">
                <div class="card card-round">
                  <div class="card-header">
                    <div class="card-head-row">
                      <div class="card-title">Storage Shipments</div>
                      <div class="card-tools">
                        <a href="#storage-shipment-form" class="btn btn-label-info btn-round btn-sm me-2">
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
                            <th scope="col">Destination</th>
                            <th scope="col">Ship Date</th>
                          </tr>
                        </thead>
                        <tbody id="storageShipmentTableBody"></tbody>
                      </table>
                    </div>
                    <div class="mt-4" id="storage-shipment-form">
                      <h4>Add New Storage Shipment</h4>
                      <form id="storageShipmentForm" class="row g-3">
                        <div class="col-md-6">
                          <label class="form-label">Batch ID</label>
                          <select class="form-control" id="shipmentBatchID" required></select>
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

            <!-- Storage Facilities Section -->
            <div class="row" id="storage-facility-section">
              <div class="col-md-12">
                <div class="card card-round">
                  <div class="card-header">
                    <div class="card-head-row">
                      <div class="card-title">Storage Facilities</div>
                      <div class="card-tools">
                        <a href="#storage-facility-form" class="btn btn-label-info btn-round btn-sm me-2">
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
                            <th scope="col">Storage Capacity</th>
                          </tr>
                        </thead>
                        <tbody id="storageFacilityTableBody"></tbody>
                      </table>
                    </div>
                    <div class="mt-4" id="storage-facility-form">
                      <h4>Add New Storage Facility</h4>
                      <form id="storageFacilityForm" class="row g-3">
                        <div class="col-md-6">
                          <label class="form-label">Location</label>
                          <input type="text" class="form-control" id="facilityLocation" required />
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Storage Capacity</label>
                          <input type="text" class="form-control" id="storageCapacity" required />
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
          let storageBatches = [
            {
              batchID: 1,
              storageType: "Cold Storage",
              quantity: 600,
              storedDate: "2025-07-05",
            },
            {
              batchID: 2,
              storageType: "Dry Storage",
              quantity: 500,
              storedDate: "2025-07-10",
            },
          ];
          let storedItems = [
            {
              itemID: 1,
              itemName: "Wheat Grain",
              quantity: 400,
              batchID: 1,
            },
            {
              itemID: 2,
              itemName: "Corn Seed",
              quantity: 300,
              batchID: 2,
            },
          ];
          let storageShipments = [
            {
              shipmentID: 1,
              batchID: 1,
              destination: "City A",
              shipDate: "2025-07-20",
            },
            {
              shipmentID: 2,
              batchID: 2,
              destination: "City B",
              shipDate: "2025-07-25",
            },
          ];
          let storageFacilities = [
            {
              facilityID: 1,
              location: "Warehouse A",
              storageCapacity: "1000 tons",
            },
            {
              facilityID: 2,
              location: "Warehouse B",
              storageCapacity: "800 tons",
            },
          ];

          // Charts
          var storageUtilizationChart = new Chart(document.getElementById("storageUtilizationChart"), {
            type: "bar",
            data: {
              labels: ["July 2025", "August 2025", "September 2025"],
              datasets: [
                {
                  label: "Storage Utilization",
                  data: [800, 900, 850],
                  backgroundColor: "#34c38f",
                },
              ],
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              scales: {
                y: { beginAtZero: true, title: { display: true, text: "Quantity (tons)" } },
                x: { title: { display: true, text: "Month" } },
              },
              plugins: {
                legend: { display: false },
              },
            },
          });

          var storageTypesChart = new Chart(document.getElementById("storageTypesChart"), {
            type: "pie",
            data: {
              labels: ["Cold Storage", "Dry Storage"],
              datasets: [
                {
                  label: "Storage Types",
                  data: [600, 500],
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
            storageBatches.forEach((batch) => {
              batchSelect.append(
                `<option value="${batch.batchID}">Batch ${batch.batchID}</option>`
              );
            });
          }

          // Display data
          function displayStorageBatches() {
            const storageBatchTableBody = $("#storageBatchTableBody");
            storageBatchTableBody.empty();
            storageBatches.forEach((batch) => {
              storageBatchTableBody.append(`
                <tr>
                  <td>${batch.batchID}</td>
                  <td>${batch.storageType}</td>
                  <td>${batch.quantity}</td>
                  <td>${batch.storedDate}</td>
                </tr>
              `);
            });
          }

          function displayStoredItems() {
            const storedItemsTableBody = $("#storedItemsTableBody");
            storedItemsTableBody.empty();
            storedItems.forEach((item) => {
              storedItemsTableBody.append(`
                <tr>
                  <td>${item.itemID}</td>
                  <td>${item.itemName}</td>
                  <td>${item.quantity}</td>
                  <td>${item.batchID}</td>
                </tr>
              `);
            });
          }

          function displayStorageShipments() {
            const storageShipmentTableBody = $("#storageShipmentTableBody");
            storageShipmentTableBody.empty();
            storageShipments.forEach((shipment) => {
              storageShipmentTableBody.append(`
                <tr>
                  <td>${shipment.shipmentID}</td>
                  <td>${shipment.batchID}</td>
                  <td>${shipment.destination}</td>
                  <td>${shipment.shipDate}</td>
                </tr>
              `);
            });
          }

          function displayStorageFacilities() {
            const storageFacilityTableBody = $("#storageFacilityTableBody");
            storageFacilityTableBody.empty();
            storageFacilities.forEach((facility) => {
              storageFacilityTableBody.append(`
                <tr>
                  <td>${facility.facilityID}</td>
                  <td>${facility.location}</td>
                  <td>${facility.storageCapacity}</td>
                </tr>
              `);
            });
          }

          // Initialize data and tables
          populateBatchDropdown();
          displayStorageBatches();
          displayStoredItems();
          displayStorageShipments();
          displayStorageFacilities();

          // Form submissions
         

          $("#storedItemsForm").on("submit", function (e) {
            e.preventDefault();
            const newItem = {
              itemID: storedItems.length + 1,
              itemName: $("#itemName").val(),
              quantity: parseInt($("#itemQuantity").val()),
              batchID: parseInt($("#itemBatchID").val()),
            };
            storedItems.push(newItem);
            displayStoredItems();
            this.reset();
            $.notify("Stored Item added successfully!", "success");
          });

          $("#storageShipmentForm").on("submit", function (e) {
            e.preventDefault();
            const newShipment = {
              shipmentID: storageShipments.length + 1,
              batchID: parseInt($("#shipmentBatchID").val()),
              destination: $("#destination").val(),
              shipDate: $("#shipDate").val(),
            };
            storageShipments.push(newShipment);
            displayStorageShipments();
            this.reset();
            $.notify("Storage Shipment added successfully!", "success");
          });

          $("#storageFacilityForm").on("submit", function (e) {
            e.preventDefault();
            const newFacility = {
              facilityID: storageFacilities.length + 1,
              location: $("#facilityLocation").val(),
              storageCapacity: $("#storageCapacity").val(),
            };
            storageFacilities.push(newFacility);
            displayStorageFacilities();
            this.reset();
            $.notify("Storage Facility added successfully!", "success");
          });
        });
      </script>
    </body>
  </html>