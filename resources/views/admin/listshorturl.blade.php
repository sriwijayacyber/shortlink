<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shortlink Table</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Gaya untuk tombol */
    .btn-action {
      padding: 5px 10px;
      margin-right: 5px;
      border-radius: 20px; /* Tambahkan border radius */
    }

    /* Gaya untuk sel aksi */
    .action-cell {
      display: flex;
      justify-content: center;
      align-items: center;
    }

    /* Efek hover pada baris tabel */
    tbody tr:hover {
      background-color: #f5f5f5; /* Warna latar belakang saat hover */
    }

    /* Efek shadow pada tabel */
    .table {
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Tambahkan shadow */
    }
  </style>
</head>
<body>
 @include("admin.layout.navbar")   
  <div class="container">
    <h1>Shortlink Table</h1>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Link</th>
          <th scope="col">Description</th>
          <th scope="col">Jenis Platform</th>
          <th scope="col" class="px-6">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><a href="https://example.com/link1">https://example.com/link1</a></td>
          <td>Description 1</td>
          <td>Shoppe</td>
          <td class="action-cell">
            <a href="#" class="btn btn-primary btn-action">Edit</a>
            <a href="#" class="btn btn-danger btn-action">Delete</a>
          </td>
        </tr>
        <tr>
          <td><a href="https://example.com/link2">https://example.com/link2</a></td>
          <td>Description 2</td>
          <td>Shoppe</td>
          <td class="action-cell">
            <a href="#" class="btn btn-primary btn-action">Edit</a>
            <a href="#" class="btn btn-danger btn-action">Delete</a>
          </td>
        </tr>
        <tr>
          <td><a href="https://example.com/link3">https://example.com/link3</a></td>
          <td>Description 3</td>
          <td>Shoppe</td>
          <td class="action-cell">
            <a href="#" class="btn btn-primary btn-action">Edit</a>
            <a href="#" class="btn btn-danger btn-action">Delete</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Bootstrap JS (opsional, hanya diperlukan jika Anda menggunakan komponen Bootstrap yang memerlukan JS) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
