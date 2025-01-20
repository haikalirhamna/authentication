<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/main.css">
  <title>Document</title>
</head>

<body>
  <section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex align-items-center justify-content-center h-100">
        <div class="col-md-8 col-lg-7 col-xl-6">
          <img src="assets/images/background.svg"
            class="img-fluid" alt="Phone image">
        </div>
        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
          <form method="post" action="backend/register.php">
            <!-- Username input -->
            <div data-mdb-input-init class="form-outline mb-4">
              <input type="text" id="username" name="username" class="form-control form-control-lg" />
              <label class="form-label" for="username">Username</label>
            </div>

            <!-- Email input -->
            <div data-mdb-input-init class="form-outline mb-4">
              <input type="email" id="email" name="email" class="form-control form-control-lg" />
              <label class="form-label" for="email">Email address</label>
            </div>

            <!-- Password input -->
            <div data-mdb-input-init class="form-outline mb-4">
              <input type="password" id="password" name="password" class="form-control form-control-lg" />
              <label class="form-label" for="password">Password</label>
            </div>

            <!-- Confirm input -->
            <div data-mdb-input-init class="form-outline mb-4">
              <input type="password" id="confirm" name="confirm" class="form-control form-control-lg" />
              <label class="form-label" for="confirm">Password Confirmation</label>
            </div>

            <div class="d-flex justify-content-around align-items-center mb-4">
            </div>

            <!-- Submit button -->
            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary w-100 btn-block">Register</button>

          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Modal -->
  <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="statusModalLabel">Message</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="modalMessage">
          <!-- Message content will be inserted here -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Display modal if there's a message in the query string
    <?php if (isset($_GET['status'])): ?>
      var status = "<?php echo $_GET['status']; ?>";
      var message = "<?php echo isset($_GET['error']) ? urldecode($_GET['error']) : ''; ?>";
      var modalMessage = '';

      if (status === 'success') {
        modalMessage = 'Registrasi berhasil!';
        document.getElementById('statusModalLabel').textContent = 'Success';
        document.getElementById('modalMessage').textContent = modalMessage;
      } else if (status === 'failed') {
        modalMessage = 'Registrasi gagal: ' + message;
        document.getElementById('statusModalLabel').textContent = 'Error';
        document.getElementById('modalMessage').textContent = modalMessage;
      } else if (status === 'password_mismatch') {
        modalMessage = message;
        document.getElementById('statusModalLabel').textContent = 'Error';
        document.getElementById('modalMessage').textContent = modalMessage;
      } else if (status === 'unauthorized') {
        modalMessage = 'Username or Password is Incorrect';
        document.getElementById('statusModalLabel').textContent = 'Error';
        document.getElementById('modalMessage').textContent = modalMessage;
      }

      // Show modal if there's a message
      if (modalMessage) {
        var myModal = new bootstrap.Modal(document.getElementById('statusModal'));
        myModal.show();
      }
    <?php endif; ?>
  </script>
</body>

</html>