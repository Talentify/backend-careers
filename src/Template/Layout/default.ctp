<!DOCTYPE html>
<html>
<head>
  <?= $this->Html->charset() ?>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    Get Aboard:
    <?= $this->fetch('title') ?>
  </title>
  <?= $this->Html->meta('icon') ?>
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.1/normalize.css">
  <?php
    echo $this->Html->css([
      '/plugins/bootstrap-4.4.1-dist/css/bootstrap.min.css',
      '/plugins/'
    ]);
    echo $this->fetch('meta');
    echo $this->fetch('css');
  ?>
</head>
<body>
  <main class="main">
    <div class="container">
      <div class="row align-items-end mt-5 mx-0">
        <a href="/" class="col col-sm-3 col-md-2 px-sm-0">
          <?= $this->Html->image('get_aboard.png', ['class' => 'img-fluid', 'alt' => 'Get Aboard']) ?>
        </a>
      </div>
      <?= $this->Flash->render() ?>
      <?= $this->fetch('content') ?>
    </div>
  </main>
  <?php
    echo $this->Html->script([
      '/plugins/jquery/jquery-3.3.1.min.js',
      '/plugins/bootstrap-4.4.1-dist/js/bootstrap.min.js'
    ]);
    echo $this->fetch('script')
  ?>
</body>
</html>
