<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= isset($title) ? $title : "Garbage Bank" ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
  <!-- Main content -->
  <main class="flex-grow">
    <?php $this->load->view($content); ?>
  </main>

  <!-- Footer -->
  <?php $this->load->view('partials/footer'); ?>

</body>
</html>
