
<?php
  require APPROOT.'/views/template/header.php';
  //require APPROOT.'/views/template/navbar.php';
  //require APPROOT.'/views/template/heading.php';
  //flash messages
  //flash('siteMessage');
?>
<style>

body {
  text-align: center;
  display: -ms-flexbox;
  display: flex;
  color: #fff;
  background: url(<?php echo URLROOT; ?>/public/img/splash.jpg) no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}

.cover-container {
  min-height: 1024px;
  background-color: rgba(0,72,124,0.9); /* Black background with opacity */
}

.cover {
  padding: 0 1.5rem;
}

.cover-heading {
  font-family: 'Playfair Display', serif;
}
.cover .btn-lg {
  padding: .75rem 1.25rem;
}
/*
 * Footer
 */
.mastfoot {
  background-color: #00487C;
  color: #fff;
}
</style>
<div class="cover-container d-flex w-100 h-100 mx-auto flex-column">

<header class="masthead mb-auto">
  <nav id="topNav" class="navbar navbar-expand-md navbar-dark bg-fcDarkBlue">
    <a class="navbar-brand" href="<?php echo URLROOT; ?>"><i class="fab fa-avianex text-white fa-lg"></i> FS FlightCase</a>
    <div class="collapse navbar-collapse" id="navbar">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <i class="fas fa-sunset text-white mr-2"></i> <i class="fas fa-signal-alt-3 text-white mr-2"></i><a href="#" onClick="window.location.reload();"><i class="fas fa-battery-three-quarters text-white"></i></a>
        </li>
      </ul>
    </div>
  </nav>
</header>

<main role="main" class="inner cover">
<h1 class="cover-heading">FS FLIGHTCASE</h1>
<p class="lead">An electronic flightbag for Microsoft Flight Simulator.</p>
<p class="lead">
  <a href="<?php echo URLROOT; ?>/account/login" class="btn btn-lg btn-fcBlue">Login</a>
</p>
</main>
<footer class="mastfoot mt-auto">
  <div class="inner p-3">
    <span class="ml-3">FS Flightcase - https://simulated.flights</span>
  </div>
</footer>
</div>
<?php //require APPROOT.'/views/template/footer.php'; ?>
