<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Error 404 - E-library</title>

  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.css" />
  <link rel="stylesheet" href="<?= base_url(); ?>assets/vendors/bootstrap-icons/bootstrap-icons.css" />
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/app.css" />
  <style>
    #error {
      height: 100vh;
      background-color: #ebf3ff;
      padding-top: 5rem
    }

    #error .img-error {
      width: 100%
    }

    #error .error-title {
      font-size: 4rem;
      margin-top: 3rem
    }
  </style>
</head>

<body>
  <div id="error">


    <div class="error-page container">
      <div class="col-md-8 col-12 offset-md-2">
        <img class="img-error" src="<?= base_url(); ?>assets/img/error-404.png" alt="Not Found">
        <div class="text-center">
          <h1 class="error-title">NOT FOUND</h1>
          <p class='fs-5 text-gray-600'>The page you are looking not found.</p>
          <a href="<?= base_url(); ?>" class="btn btn-lg btn-outline-primary mt-3 mb-5">Go Home</a>
        </div>
      </div>
    </div>


  </div>
</body>

</html>