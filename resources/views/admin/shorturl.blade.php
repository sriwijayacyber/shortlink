<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shortlink Form</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@include("admin.layout.navbar")
<div class="container mt-5">
  <h2 class="mb-4">Create Shortlink URL</h2>
  <form>
    <div class="mb-3">
      <label for="originalUrl" class="form-label">Original URL</label>
      <input type="url" class="form-control" id="originalUrl" placeholder="Enter the original URL" required>
    </div>
    <div class="input-group mb-3">
      <label class="input-group-text" for="inputGroupSelect01">Jenis PLatform</label>
      <select class="form-select" id="inputGroupSelect01">
        <option value="1">Tokopedia</option>
        <option value="2">Shoppe</option>
        <option value="3"></option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Generate Shortlink</button>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
