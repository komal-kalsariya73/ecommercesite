
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
    rel="stylesheet"
/>
  <style>
        .gradient-custom-2 {
/* fallback for old browsers */
background: #fccb90;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
}

@media (min-width: 768px) {
.gradient-form {
height: 100vh !important;
}
}
@media (min-width: 769px) {
.gradient-custom-2 {
border-top-right-radius: .3rem;
border-bottom-right-radius: .3rem;
}
}
.icons i{
     background:lightgray; 
    padding:8px;
    margin:10px;
    font-size:25px;
    border-radius:25px;
}

    </style>
</head>
<body>
<section class="gradient-form" style="background-color: #eee;">
  <form action="" method="POST" class="" id="loginForm">
  <div class=" py-3">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col-xl-8">
        <div class="card rounded-3 text-black cordheight">
          <div class="row g-0">
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                <img src="https://preview.webpixels.io/web/img/logos/clever-primary.svg" alt="...">
                  <h4 class="mt-1 mb-5 pb-1">We are The Lotus Team</h4>
                </div>

                <form>
                  <p>Please login to your account</p>

                  <div data-mdb-input-init class="form-outline mb-4">
                  <label class="form-label" for="form2Example11">Email</label>
                    <input type="email" id="email" class="form-control"
                      placeholder="Phone number or email address"  name="email"/>
                  
                  </div>
                  <div class="text-danger" id="error-email"></div>
                  <div data-mdb-input-init class="form-outline mb-4">
                  <label class="form-label" for="form2Example22">Password</label>
                    <input type="password" id="password" class="form-control" placeholder="Enter Password" name="password" />
                  
                  </div>
                  <div class="text-danger" id="error-password"></div>
                  <div class="text-center pt-1 mb-5 pb-1">
                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3 w-100  border-0" type="submit">Log
                      in</button>
                    <a class="text-muted" href="#!">Forgot password?</a>
                  </div>

                  <div class="d-flex align-items-center justify-content-center pb-4">
                    <p class="mb-0 me-2">Don't have an account?</p>
                    <button  type="" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-danger">create</button>
                  </div>
                 <div class="text-center pe-4 icons">
                 <i class="ri-facebook-fill"></i><i class="ri-twitter-fill"></i><i class="ri-google-fill"></i>
                 </div>
                </form>

              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
              <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                <h4 class="mb-4">We are more than just a company</h4>
                <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                  exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </form>
</section>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#loginForm').on('submit', function(e) {
            e.preventDefault();
            $(".text-danger").html("");

            let formData = new FormData(this);

            $.ajax({
                url: '<?= base_url('/login')?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    if (response.status === true) {
                        $('#message').html('<p class="text-success">' + response.message + '</p>');
                        window.location.href = "<?= base_url('/admin'); ?>";
                    } else if (response.status === 'error') {
                        let errors = response.errors;
                        for (let key in errors) {
                            $('#error-' + key).html(errors[key]);
                        }
                    } else {
                        $('#message').html('<p class="text-danger">' + response.message + '</p>');
                    }
                },
                error: function(xhr, status, error) {
                    $('#message').html('<p class="text-danger">An unexpected error occurred. Please try again.</p>');
                },
            });
        });
    });
</script>

</html>