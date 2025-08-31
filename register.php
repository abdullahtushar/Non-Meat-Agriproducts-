<?php 
include 'connection.php'; 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>AgriInventory Management System - Sign Up</title>
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
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: "Public Sans", sans-serif;
      }
      .register-container {
        max-width: 400px;
        width: 100%;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        padding: 30px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
      }
      .register-container:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.3);
      }
      .register-header {
        text-align: center;
        margin-bottom: 20px;
      }
      .register-header img {
        width: 80px;
        margin-bottom: 10px;
      }
      .register-header h3 {
        font-size: 1.5rem;
        color: #343a40;
      }
      .form-group {
        margin-bottom: 20px;
        position: relative;
      }
      .form-group label {
        font-weight: 500;
        color: #495057;
      }
      .form-group input {
        border-radius: 8px;
        padding: 10px;
        border: 1px solid #ced4da;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
      }
      .form-group input:focus {
        border-color: #34c38f;
        box-shadow: 0 0 8px rgba(52, 195, 143, 0.3);
      }
      .btn {
        border-radius: 8px;
        padding: 10px 20px;
        transition: background-color 0.3s ease, transform 0.2s ease;
      }
      .btn-home {
        background-color: #6c757d;
        border-color: #6c757d;
      }
      .btn-home:hover {
        background-color: #5a6268;
        transform: translateY(-2px);
      }
      .btn-cancel {
        background-color: #f46a6a;
        border-color: #f46a6a;
      }
      .btn-cancel:hover {
        background-color: #e55353;
        transform: translateY(-2px);
      }
      .btn-signup {
        background-color: #34c38f;
        border-color: #34c38f;
      }
      .btn-signup:hover {
        background-color: #28a745;
        transform: translateY(-2px);
      }
    </style>
  </head>
  <body>
    <div class="register-container">
      <div class="register-header">
        <img src="assets/img/agricultureLogo1.jpg" alt="Logo" />
        <h3>AgriInventory Management System</h3>
      </div>
      <form id="registerForm" class="row g-3">
        <div class="col-md-12 form-group">
          <label for="username">Username</label>
          <input type="text" class="form-control" id="username" required />
        </div>
        <div class="col-md-12 form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" required />
        </div>
        <div class="col-md-12 form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" required />
        </div>
        <div class="col-md-12 form-group">
          <label for="confirmPassword">Confirm Password</label>
          <input type="password" class="form-control" id="confirmPassword" required />
        </div>
        <div class="col-12 d-flex justify-content-between">
          <a href="landing.php" class="btn btn-home btn-round">Home</a>
          <a href="landing.php" class="btn btn-cancel btn-round">Cancel</a>
          <button type="submit" class="btn btn-signup btn-round">Sign Up</button>
        </div>
      </form>
    </div>

    <!-- Core JS Files -->
    <script src="assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
    <script src="assets/js/kaiadmin.min.js"></script>

    <script>
      $(document).ready(function () {
        $("#registerForm").on("submit", function (e) {
          e.preventDefault();
          const username = $("#username").val().trim();
          const email = $("#email").val().trim();
          const password = $("#password").val();
          const confirmPassword = $("#confirmPassword").val();

          // Basic validation
          if (!username || username.length < 3) {
            $.notify("Username must be at least 3 characters long!", {
              type: "error",
              placement: { from: "top", align: "center" },
              time: 2000,
            });
            return;
          }
          if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            $.notify("Please enter a valid email address!", {
              type: "error",
              placement: { from: "top", align: "center" },
              time: 2000,
            });
            return;
          }
          if (password.length < 6) {
            $.notify("Password must be at least 6 characters long!", {
              type: "error",
              placement: { from: "top", align: "center" },
              time: 2000,
            });
            return;
          }
          if (password !== confirmPassword) {
            $.notify("Passwords do not match!", {
              type: "error",
              placement: { from: "top", align: "center" },
              time: 2000,
            });
            return;
          }

          // Simulate registration (replace with backend API call)
          $.notify("Registration successful! Redirecting to login...", {
            type: "success",
            placement: { from: "top", align: "center" },
            time: 2000,
          });
          setTimeout(() => {
            window.location.href = "login.php";
          }, 2000);
        });
      });
    </script>
  </body>
</html>