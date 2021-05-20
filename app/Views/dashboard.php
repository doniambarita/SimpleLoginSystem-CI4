<!-- Krn session nya sudah terkirim di halaman dashboard , maka file header juga bisa make session nya , krn di controller
dashboard halaman nya gw susun dari header sampe footer -->
<div class="container">
  <div class="row">
    <div class="col">
    <!-- session get di dapat dari method index di dalam controller Users yg sdh mengirimkan session -->
      <h1>Hello, <?= session()->get('firstname') ?></h1>
    </div>
  </div>
</div>