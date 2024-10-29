<?php
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
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

$productos = json_decode($response, true)['data'] ?? [];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
       

        .main-content {
            flex-grow: 1;
        }

        .card-img-top {
            max-height: 150px;
            max-width: 300px;
            object-fit: cover;
        }

        
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
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

    <div class="d-flex flex-grow-1">
        <div class="sidebar d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="fs-4">Sidebar</span>
            </a>
            <hr />
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link active" aria-current="page">Home</a>
                </li>
                <li>
                    <a href="#" class="nav-link text-white">Dashboard</a>
                </li>
                <li>
                    <a href="#" class="nav-link text-white">Orders</a>
                </li>
                <li>
                    <a href="#" class="nav-link text-white">Products</a>
                </li>
                <li>
                    <a href="#" class="nav-link text-white">Customers</a>
                </li>
            </ul>
            <hr />
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <strong>User</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href="#">New project...</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
            </div>
        </div>

        <div class="main-content p-3">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">Añadir producto</button>
            <div
                class="modal fade"
                id="editModal"
                tabindex="-1"
                aria-labelledby="editModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Añadir producto</h5>
                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="app/newProduct.php">
                                <div class="mb-3">
                                    <label class="form-label">Nombre</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="name"
                                        required />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Slug</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="slug"
                                        required />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Descripción</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="description"
                                        required />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Características</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="features"
                                        required />
                                </div>
                                <button type="submit" class="btn btn-primary">Añadir</button>
                                <input type="hidden" name="addProduct" />
                            </form>
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <?php if (!empty($productos)): ?>
                        <?php foreach ($productos as $producto): ?>
                            <div class="col-12 col-md-4 mb-3">
                                <div class="card">
                                    <img src="<?= $producto['cover'] ?: './img/no-img.jpg' ?>" class="card-img-top" alt="<?= $producto['name'] ?: 'Product Image' ?>" />
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $producto['name'] ?: 'Card title' ?></h5>
                                        <p class="card-text"><?= $producto['description'] ?: 'Some quick example text.' ?></p>
                                        <a href="product.php?slug=<?= $producto['slug'] ?>" class="btn btn-primary">Go somewhere</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No products found.</p>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>