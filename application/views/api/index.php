<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Test Api</title>
  <link rel="stylesheet" href="<?= base_url('assets/user/css/bootstrap.min.css') ?>">
</head>

<body>
  <div class="container">
    <h1 class="text-center my-5">CRUD API</h1>

    <table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Judul Buku</th>
          <th>Pengarang</th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody>
      </tbody>
    </table>
  </div>

  <script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
  <script>
    $(document).ready(function() {
      function fetch_data() {
        $.ajax({
          method: "POST",
          url: "<?= base_url('test_api/action'); ?>",
          data: {
            data_action: 'fetch_all'
          },
          success: function(response) {
            $('tbody').html(response);
          }
        });
      }

      fetch_data();

      $(document).on('click', '.edit', function() {

      });
    });
  </script>
</body>

</html>