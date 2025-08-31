<?php 
include 'connection.php'; 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>AgriInventory Management System - Crops</title>
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
              <a href="crops.php" class="nav-link active">
                <i class="fas fa-leaf"></i>
                <p>Crops</p>
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
                <h3 class="fw-bold mb-3">Crops</h3>
                <h6 class="op-7 mb-2">Manage Crop Batches, Inventory, Shipments, and Facilities</h6>
              </div>
              <div class="ms-md-auto py-2 py-md-0">
                <a href="#crop-batch-form" class="btn btn-primary btn-round">Add Crop Batch</a>
              </div>
            </div>

            <!-- Charts Section -->
            <div class="row">
              <div class="col-md-6">
                <div class="card card-round chart-card">
                  <div class="card-header">
                    <div class="card-title">Crop Yield by Month</div>
                  </div>
                  <div class="card-body">
                    <canvas id="cropYieldChart"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card card-round chart-card">
                  <div class="card-header">
                    <div class="card-title">Crop Types Distribution</div>
                  </div>
                  <div class="card-body">
                    <canvas id="cropTypesChart"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <!-- Crop Batch Section -->
            <div class="row" id="crop-batch-section">
              <div class="col-md-12">
                <div class="card card-round">
                  <div class="card-header">
                    <div class="card-head-row">
                      <div class="card-title">Crop Batches</div>
                      <div class="card-tools">
                        <a href="#crop-batch-form" class="btn btn-label-info btn-round btn-sm me-2">
                          <span class="btn-label">
                            <i class="fa fa-plus"></i>
                          </span>
                          Add Crop Batch
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
                            <th scope="col">Crop Type</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Planting Date</th>
                          </tr>
                        </thead>
                        <tbody>
<?php 
                          // Fetch data
$sql = "SELECT id, crop_type, quantity, planting_date FROM crop_batches ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . htmlspecialchars($row['crop_type']) . "</td>
                <td>" . $row['quantity'] . "</td>
                <td>" . $row['planting_date'] . "</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='4'>No crop batches found</td></tr>";
}
?>
                        </tbody>
                      </table>
                    </div>
                    <div class="mt-4" id="crop-batch-form">
                      <h4>Add New Crop Batch</h4>
                      <form id="cropBatchForm" class="row g-3" action="savecropbatch.php" method="POST"> 
                        <div class="col-md-6">
                          <label class="form-label">Crop Type</label>
                          <input name="cropType" type="text" class="form-control" id="cropType" required />
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Quantity</label>
                          <input name="cropQuantity" type="number" class="form-control" id="cropQuantity" required />
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Planting Date</label>
                          <input name="plantingDate" type="date" class="form-control" id="plantingDate" required />
                        </div>
                        <div class="col-12">
                          <button type="submit" class="btn btn-primary">Add Crop Batch</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Crop Inventory Section -->
            <div class="row" id="crop-inventory-section">
              <div class="col-md-12">
                <div class="card card-round">
                  <div class="card-header">
                    <div class="card-head-row">
                      <div class="card-title">Crop Inventory</div>
                      <div class="card-tools">
                        <a href="#crop-inventory-form" class="btn btn-label-info btn-round btn-sm me-2">
                          <span class="btn-label">
                            <i class="fa fa-plus"></i>
                          </span>
                          Add Crop Item
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
                            <th scope="col">Crop Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Batch ID</th>
                          </tr>
                        </thead>
                        <tbody id="cropInventoryTableBody"></tbody>
                      </table>
                    </div>
                    <div class="mt-4" id="crop-inventory-form">
                      <h4>Add New Crop Item</h4>
                      <form id="cropInventoryForm" class="row g-3">
                        <div class="col-md-6">
                          <label class="form-label">Crop Name</label>
                          <input type="text" class="form-control" id="cropName" required />
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
                          <button type="submit" class="btn btn-primary">Add Crop Item</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Crop Shipments Section -->
            <div class="row" id="crop-shipment-section">
              <div class="col-md-12">
                <div class="card card-round">
                  <div class="card-header">
                    <div class="card-head-row">
                      <div class="card-title">Crop Shipments</div>
                      <div class="card-tools">
                        <a href="#crop-shipment-form" class="btn btn-label-info btn-round btn-sm me-2">
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
                        <tbody id="cropShipmentTableBody"></tbody>
                      </table>
                    </div>
                    <div class="mt-4" id="crop-shipment-form">
                      <h4>Add New Crop Shipment</h4>
                      <form id="cropShipmentForm" class="row g-3">
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

            <!-- Crop Facilities Section -->
            <div class="row" id="crop-facility-section">
              <div class="col-md-12">
                <div class="card card-round">
                  <div class="card-header">
                    <div class="card-head-row">
                      <div class="card-title">Crop Facilities</div>
                      <div class="card-tools">
                        <a href="#crop-facility-form" class="btn btn-label-info btn-round btn-sm me-2">
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
                        <tbody id="cropFacilityTableBody"></tbody>
                      </table>
                    </div>
                    <div class="mt-4" id="crop-facility-form">
                      <h4>Add New Crop Facility</h4>
                      <form id="cropFacilityForm" class="row g-3">
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
          let cropBatches = [
            {
              batchID: 1,
              cropType: "Wheat",
              quantity: 500,
              plantingDate: "2025-03-10",
            },
            {
              batchID: 2,
              cropType: "Corn",
              quantity: 400,
              plantingDate: "2025-04-15",
            },
          ];
          let cropInventory = [
            {
              itemID: 1,
              cropName: "Wheat Grain",
              quantity: 300,
              batchID: 1,
            },
            {
              itemID: 2,
              cropName: "Corn Kernel",
              quantity: 200,
              batchID: 2,
            },
          ];
          let cropShipments = [
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
          let cropFacilities = [
            {
              facilityID: 1,
              location: "Farm A",
              storageCapacity: "1000 tons",
            },
            {
              facilityID: 2,
              location: "Farm B",
              storageCapacity: "800 tons",
            },
          ];

          // Charts
          var cropYieldChart = new Chart(document.getElementById("cropYieldChart"), {
            type: "bar",
            data: {
              labels: ["July 2025", "August 2025", "September 2025"],
              datasets: [
                {
                  label: "Crop Yield",
                  data: [500, 700, 600],
                  backgroundColor: "#34c38f",
                },
              ],
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              scales: {
                y: { beginAtZero: true, title: { display: true, text: "Yield (tons)" } },
                x: { title: { display: true, text: "Month" } },
              },
              plugins: {
                legend: { display: false },
              },
            },
          });

          var cropTypesChart = new Chart(document.getElementById("cropTypesChart"), {
            type: "pie",
            data: {
              labels: ["Wheat", "Corn"],
              datasets: [
                {
                  label: "Crop Types",
                  data: [400, 300],
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
            cropBatches.forEach((batch) => {
              batchSelect.append(
                `<option value="${batch.batchID}">Batch ${batch.batchID}</option>`
              );
            });
          }

          // Display data
          function displayCropBatches() {
            const cropBatchTableBody = $("#cropBatchTableBody");
            cropBatchTableBody.empty();
            cropBatches.forEach((batch) => {
              cropBatchTableBody.append(`
                <tr>
                  <td>${batch.batchID}</td>
                  <td>${batch.cropType}</td>
                  <td>${batch.quantity}</td>
                  <td>${batch.plantingDate}</td>
                </tr>
              `);
            });
          }

          function displayCropInventory() {
            const cropInventoryTableBody = $("#cropInventoryTableBody");
            cropInventoryTableBody.empty();
            cropInventory.forEach((item) => {
              cropInventoryTableBody.append(`
                <tr>
                  <td>${item.itemID}</td>
                  <td>${item.cropName}</td>
                  <td>${item.quantity}</td>
                  <td>${item.batchID}</td>
                </tr>
              `);
            });
          }

          function displayCropShipments() {
            const cropShipmentTableBody = $("#cropShipmentTableBody");
            cropShipmentTableBody.empty();
            cropShipments.forEach((shipment) => {
              cropShipmentTableBody.append(`
                <tr>
                  <td>${shipment.shipmentID}</td>
                  <td>${shipment.batchID}</td>
                  <td>${shipment.destination}</td>
                  <td>${shipment.shipDate}</td>
                </tr>
              `);
            });
          }

          function displayCropFacilities() {
            const cropFacilityTableBody = $("#cropFacilityTableBody");
            cropFacilityTableBody.empty();
            cropFacilities.forEach((facility) => {
              cropFacilityTableBody.append(`
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
          displayCropBatches();
          displayCropInventory();
          displayCropShipments();
          displayCropFacilities();

          // Form submissions
          

          $("#cropInventoryForm").on("submit", function (e) {
            e.preventDefault();
            const newItem = {
              itemID: cropInventory.length + 1,
              cropName: $("#cropName").val(),
              quantity: parseInt($("#itemQuantity").val()),
              batchID: parseInt($("#itemBatchID").val()),
            };
            cropInventory.push(newItem);
            displayCropInventory();
            this.reset();
            $.notify("Crop Item added successfully!", "success");
          });

          $("#cropShipmentForm").on("submit", function (e) {
            e.preventDefault();
            const newShipment = {
              shipmentID: cropShipments.length + 1,
              batchID: parseInt($("#shipmentBatchID").val()),
              destination: $("#destination").val(),
              shipDate: $("#shipDate").val(),
            };
            cropShipments.push(newShipment);
            displayCropShipments();
            this.reset();
            $.notify("Crop Shipment added successfully!", "success");
          });

          $("#cropFacilityForm").on("submit", function (e) {
            e.preventDefault();
            const newFacility = {
              facilityID: cropFacilities.length + 1,
              location: $("#facilityLocation").val(),
              storageCapacity: $("#storageCapacity").val(),
            };
            cropFacilities.push(newFacility);
            displayCropFacilities();
            this.reset();
            $.notify("Crop Facility added successfully!", "success");
          });
        });
      </script>
    </body>
  </html>