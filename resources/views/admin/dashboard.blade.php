<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
@include("admin.layout.navbar")

<!-- Page content -->
<div class="container-fluid mt-4">
  <div class="row">
    <div class="col-md-6 col-lg-3 mb-4">
      <div class="card text-center h-100">
        <div class="card-body">
          <div class="card-icon bg-primary text-white mb-2">
            <i class="bi bi-briefcase"></i>
          </div>
          <h5 class="card-title">Link Active</h5>
          <h2 class="card-text">18</h2>
          <p class="card-subtext">2 Completed</p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
      <div class="card text-center h-100">
        <div class="card-body">
          <div class="card-icon bg-primary text-white mb-2">
            <i class="bi bi-list-task"></i>
          </div>
          <h5 class="card-title">Saldo</h5>
          <h2 class="card-text">132</h2>
          <p class="card-subtext">28 Completed</p>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap Icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
</body>
</html>
