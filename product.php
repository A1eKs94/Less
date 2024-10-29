<?php 
$slug = $_GET['slug'];

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://crud.jonathansoto.mx/api/products/slug/$slug",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer 13|TJVmwZdhJoQzsqsVziB7MnreYhmc2zPMPXM9ww61'
    ),
));

$response = curl_exec($curl);
curl_close($curl);

$product = json_decode($response, true);

$product = $product['data']; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $product['name'] ?? 'Producto' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .sidebar {
            height: 100vh;
        }
        .main-content {
            flex-grow: 1;
        }
    </style>
</head>
<body class="d-flex flex-column">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <form class="d-flex ms-auto" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <div class="d-flex flex-grow-2">
        <div class="sidebar d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="fs-4">Sidebar</span>
            </a>
            <hr />
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Home</a></li>
                <li><a href="#" class="nav-link text-white">Dashboard</a></li>
                <li><a href="#" class="nav-link text-white">Orders</a></li>
                <li><a href="#" class="nav-link text-white">Products</a></li>
                <li><a href="#" class="nav-link text-white">Customers</a></li>
            </ul>
            <hr />
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <strong>Usuario</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href="#">New project...</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
            </div>
        </div>

        <div class="main-content p-3">
            <div class="container p-2">
                <?php if ($product): ?>
                    <div class="card mb-5">
                        <div class="card-header"><?= $product['name'] ?></div>
                        <div class="card-body">
                            <img src="<?= $product['cover'] ?: './img/no-img.jpg' ?>" class="img-fluid" alt="<?= $product['name'] ?: 'Product Image' ?>" />
                            <p class="card-text"><?= $product['description'] ?: 'No description available.' ?></p>
                            <h5 class="card-title"><?= $product['features'] ?? 'Featur not available' ?></h5>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                        </div>
                    </div>
                <?php else: ?>
                    <p>Producto no encontrado.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div
      class="modal fade"
      id="editModal"
      tabindex="-1"
      aria-labelledby="editModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit Information</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <form>
              <div class="mb-3">
                <label for="firstName" class="form-label">First Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="firstName"
                  placeholder="Enter first name"
                  required
                />
              </div>
              <div class="mb-3">
                <label for="lastName" class="form-label">Last Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="lastName"
                  placeholder="Enter last name"
                  required
                />
              </div>
              <div class="mb-3">
                <label for="handle" class="form-label">Handle</label>
                <input
                  type="text"
                  class="form-control"
                  id="handle"
                  placeholder="Enter handle"
                  required
                />
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Close
            </button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
