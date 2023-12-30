<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <script src="../js/bootstrap.bundle.js"></script>
  </head>

<body>

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
      <li><a href="#" class="nav-link px-2 link-secondary">Home</a></li>
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
<div class="bg-img">
  <main>
    <div class="container">
        <div class="row">
            <!-- Navigation on the left -->
            <div class="col-md-3" style="margin-top: 100px;"> <!-- Adjust margin-top as needed -->
                <nav>
                    <ul class="nav1 justify-content-center mb-md-0">
                        <li><a href="#" class="nav-link px-4 link-light font-weight-bold border rounded border-secondary selected">Account Settings</a></li>
                        <li><a href="#" class="nav-link px-2 link-light font-weight-bold border rounded border-secondary li">Profile Details</a></li>
                        <li><a href="#" class="nav-link px-2 link-light font-weight-bold border rounded border-secondary li">Cart</a></li>
                        <li><a href="#" class="nav-link px-2 link-light font-weight-bold border rounded border-secondary li">Manage Wishlist</a></li>
                        <li><a href="#" class="nav-link px-2 link-light font-weight-bold border rounded border-secondary li">Ordered Items</a></li>
                        <li><a href="#" class="nav-link px-2 link-light font-weight-bold border rounded border-secondary li">Delete Account</a></li>
                    </ul>
                </nav>
            </div>
            <!-- Form on the right -->
            <div class="col-md-9">
                <form class="row g-3 needs-validation was-validated" novalidate="" style="text-align: center; float: right;">
                    <h1><span class="badge badge-secondary">Account Details</span></h1>
                      <div class="col-md-3 position-relative">
                        <label for="validationTooltip01" class="form-label">First name</label>
                        <input type="text" class="form-control" id="validationTooltip01" value="Houssam" required="">
                      </div>
                      <div class="col-md-3 position-relative">
                        <label for="validationTooltip02" class="form-label">Last name</label>
                        <input type="text" class="form-control" id="validationTooltip02" value="Aoun" required="">
                      </div>
                        <div class="col-md-4 position-relative">
                          <label for="validationTooltipUsername" class="form-label">Email</label>
                        <div class="input-group has-validation">
                          <input type="text" class="form-control" id="validationTooltipUsername" aria-describedby="validationTooltipUsernamePrepend" required="">
                        </div>
                      </div>
                      <div class="col-md-6 position-relative">
                        <label for="validationTooltip03" class="form-label">Address</label>
                        <input type="text" class="form-control" id="validationTooltip03" required="">
                      </div>
                      <div class="col-md-4 position-relative">
                        <label for="validationTooltip04" class="form-label">User type</label>
                        <select class="form-select" id="validationTooltip04" required="">
                          <option selected="" disabled="" value="">Choose...</option>
                          <option>Professional Mechanic</option>
                          <option>Buyer/Seller</option>
                        </select>
                      </div>
                      <div class="col-12"></div>
                          <div class="col-md-3 position-relative">
                            <label class="form-label">Old Password</label>
                            <input type="password" class="form-control" id="validationTooltip04" required=""
                              placeholder="**********" />
                          </div>
                          <br>
                          <!-- input -->
                          <div class="col-md-3 mb-4 position-relative">
                            <label class="form-label">New Password</label>
                            <input type="password" class="form-control" onchange="valpw()"
                              placeholder="**********" />
                          </div>
                          <div class="col-12" style="text-align: center;">
                              <button class="btn btn-danger" type="submit">Confirm Changes</button>
                              <button class="btn btn-secondary" type="reset">Cancel</button>
                          </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>
  </body>
</html>