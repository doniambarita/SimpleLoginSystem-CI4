<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/style.css">
      <title><?= $title ?></title>

  </head>
  <body>
    <!-- Di bawah gw membuat instansiasi url, jadi service akan memuat library url, jadi class url menyediakan cara
    sederhana untuk mengelola segmen pada url -->
    <?php
      // Jadi fungsi service() di bawah ini adalah alternative untuk mengembalikan sebuah instance, jdi g perlu membuat 
      // intance, lebih jelasnya liat dokumentasinya di halaman Working with URIs
      $uri = service('uri');
     ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
      <a class="navbar-brand" href="/">Ci4 Login</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Jadi jika isLoggedIn sdah di set dan hasil nya true maka, tampilan nanvbar nya akan gw set ulang menjadi
           Dashboard dan Profile dan Logout, tetapi jika tidak maka gw akan tampilkan navbar nya adalah Login dan Register -->
      <?php if (session()->get('isLoggedIn')): ?> 
        <ul class="navbar-nav mr-auto">
        <!-- Krn tadi gw sudah membuat instance, mk gw bisa menggunakan getSegment yg disediakan oleh CI untuk mengambil
        Url, jadi jika segment pertama nya di url itu dashboard/profile mk class active akan di buat, klo tidak mk akan
        gw null / kosong , untuk else nya bisa pake null atau string kosong ( '' )  -->
          <li class="nav-item <?= ($uri->getSegment(1) == 'dashboard' ? 'active' : null) ?>">
            <a class="nav-link"  href="/dashboard">Dashboard</a>
          </li>
          <li class="nav-item <?= ($uri->getSegment(1) == 'profile' ? 'active' : null) ?>">
            <a class="nav-link" href="/profile">Profile</a>
          </li>
        </ul>
        <ul class="navbar-nav my-2 my-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="/logout">Logout</a>
          </li>
        </ul>
      <?php else: ?>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item <?= ($uri->getSegment(1) == '' ? 'active' : null) ?>">
            <a class="nav-link" href="/">Login</a>
          </li>
          <li class="nav-item <?= ($uri->getSegment(1) == 'register' ? 'active' : null) ?>">
            <a class="nav-link" href="/register">Register</a>
          </li>
        </ul>
        <?php endif; ?>
      </div>
      </div>
    </nav>