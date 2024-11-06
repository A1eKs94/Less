<?php

include "../../app/config.php";
require_once("../../app/ProductsController.php");

$productsController = new ProductsController();
$brands = $productsController->getBrands();

?>
<!doctype html>
<html lang="en">
<!-- [Head] start -->

<head>
  <?php include "../layouts/head.php" ?>
</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
  <!-- [ Pre-loader ] start -->
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>

  <!-- [ Pre-loader ] End -->
  <?php include "../layouts/sidebar.php" ?>
  <?php include "../layouts/navbar.php" ?>

  <!-- [ Main Content ] start -->
  <div class="pc-container">
    <div class="pc-content">
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript: void(0)">E-commerce</a></li>
                <li class="breadcrumb-item" aria-current="page">Add New Product</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Añadir Producto</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <!-- [ Main Content ] start -->
      <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-xl-6">
          <div class="card">
            <div class="card-header">
              <h5>Descripción de producto</h5>
            </div>
            <form method="POST" action="../app/ProductsController.php" enctype="multipart/form-data">
              <div class="card-body">
                <div class="mb-3">
                  <label class="form-label">Nombre</label>
                  <input type="text" class="form-control" placeholder="Enter Product Name" name="name" />
                </div>
                <div class="mb-3">
                  <select class="form-control" name="brand_id" required>
                    <option value="">Selecciona una marca</option>
                    <?php foreach ($brands as $brand): ?>
                      <option value="<?= $brand['id'] ?>"><?= $brand['name'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="mb-3">
                  <label class="form-label">Características</label>
                  <input type="text" class="form-control" placeholder="Enter Product Name" name="features" />
                </div>
                <div class="mb-3">
                  <label class="form-label">Slug</label>
                  <input type="text" class="form-control" placeholder="Enter Product Name" name="slug" />
                </div>
                <div class="mb-0">
                  <label class="form-label">Descripción</label>
                  <textarea class="form-control" placeholder="Enter Product Description" name="description"></textarea>
                </div>
              </div>
            </div>


          </div>
          <div class="col-xl-6">
            <div class="card">
              <div class="card-header">
                <h5>Product image</h5>
              </div>
              <div class="card-body">
                <div class="mb-0">
                  <p><span class="text-danger">*</span> Recommended resolution is 640*640 with file size</p>
                  <label class="btn btn-outline-secondary" for="flupld"><i class="ti ti-upload me-2"></i> Click to Upload</label>
                  <input type="file" id="flupld" class="d-none" name="cover" />
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-12">
            <div class="card">
              <div class="card-body text-end btn-page">
                <button class="btn btn-primary mb-0" type="submit">Save product</button>
                <input type="hidden" name="action" value="crear_producto"/>
              </div>
            </div>
          </div>
          <!-- [ sample-page ] end -->
        </div>
      </form>
      <!-- [ Main Content ] end -->
    </div>
  </div>

  <?php include "../layouts/footer.php" ?>

  <?php include "../layouts/scripts.php" ?>

  <?php include "../layouts/modals.php" ?>
</body>
<!-- [Body] end -->undefined

</html>