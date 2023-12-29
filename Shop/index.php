<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.css">
    <link rel="stylesheet" href="fontawesome/css/brands.css">
    <link rel="stylesheet" href="fontawesome/css/solid.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="../js/bootstrap.bundle.js"></script>
    <script src="app.js"></script>
  </head>

<body onload="rechercher()">
<!--Header -->
<div class="container">
  <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-2 mb-2 border-bottom">
    <div class="col-md-3 mb-2 mb-md-0">
      <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
        <span class="fs-4"><strong>MecAssist</strong></span>
      </a>
    </div>

    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
      <li><a href="#" class="nav-link px-2 link-body-emphasis">Home</a></li>
      <li><a href="#" class="nav-link px-2 link-body-emphasis">Community</a></li>
      <li><a href="#" class="nav-link px-2 link-body-emphasis">Shop</a></li>
      <li><a href="#" class="nav-link px-2 link-body-emphasis">FAQs</a></li>
      <li><a href="#" class="nav-link px-2 link-body-emphasis">About</a></li>
    </ul>
      
    <div class="col-md-3 text-end">
      <button type="button" class="btn btn-outline-danger me-2">Login</button>
      <button type="button" class="btn btn-danger">Sign-up</button>
    </div>
  </header>
</div>
  <main>
    <div class="container">
        <div class="row">
            <!-- Navigation on the left -->
            <div class="col-md-3" style="margin-top: 80px;"> <!-- Adjust margin-top as needed -->
                <nav>
                    <ul class="nav1 justify-content-center mb-md-0">
                        <li><button class="nav-link px-2 link-secondary">Washing</button></li>
                        <li><button class="nav-link px-2 link-secondary">Correction & Polishing</button></li>
                        <li><button class="nav-link px-2 link-secondary">Protective Wax</button></li>
                        <li><button class="nav-link px-2 link-secondary">Rim Tires</button></li>
                        <li><button class="nav-link px-2 link-secondary">Windows and headlights</button></li>
                        <li><button class="nav-link px-2 link-secondary">Interior</button></li>
                        <li><button class="nav-link px-2 link-secondary">Other Surfaces</button></li>
                        <li><button class="nav-link px-2 link-secondary">Accessories</button></li>
                        <li><button class="nav-link px-2 link-secondary">Kits</button></li>
                    </ul>
                </nav>
            </div>
            <!-- Form on the right -->
            <div class="col mt-4">
                <div class="bg-img">
                    <h1><span class="badge badge-secondary car">Join Our Car Community</span></h1>
                    <a href="#" class="badge badge-secondary join">Join now</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container items" style="margin-top: 100px; text-align: center;">
    <h1 class="row mt-4 font-weight-bold text-danger">
        <div class="col">
        <button class="border rounded border-danger bg-danger">&nbsp;&nbsp;&nbsp;</button>Explore Our Products </div></h1>
    </div>
    <div class="container">
    <div class="row">
        <div class="col">
            <input type="text" id="rech" onchange="rechercher()" class="form-control mt-3 mb-3 h3" placeholder="Search for Product" >
            
        </div>
    </div>

    <div class="row" id="pic"> </div></div>
</body>
</html>