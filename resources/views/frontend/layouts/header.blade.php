<!-- top 
  <form class="navbar-form navbar-left newsletter" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Enter Your Email Id Here">
        </div>
        <button type="submit" class="btn btn-inverse">Subscribe</button>
    </form>
 top -->

<!-- header -->
{{-- <nav class="navbar  navbar-default" role="navigation">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php"><img src="frontend/images/logo.png"  alt="holiday crown"></a>
      </div>
  
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
        
        <ul class="nav navbar-nav">        
          <li><a href="index.php">Home </a></li>
          <li><a href="rooms-tariff.php">Rooms & Tariff</a></li>        
          <li><a href="introduction.php">Introduction</a></li>
          <li><a href="gallery.php">Gallery</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
      </div><!-- Wnavbar-collapse -->
    </div><!-- container-fluid -->
  </nav> --}}
  <!-- header -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
    <a class="navbar-brand" href="frontend/images/logo.png"><img src="{{asset('frontend/images/logo.png')}}"  alt="holiday crown"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse navbar-right" id="navbarTogglerDemo02">
      <ul class="navbar-nav ml-auto f-color">
        <li><a href="index.php" class="nav-item">Home </a></li>
        <li><a href="rooms-tariff.php" class="nav-item">Rooms & Tariff</a></li>        
        <li><a href="introduction.php" class="nav-item">Introduction</a></li>
        <li><a href="gallery.php" class="nav-item">Gallery</a></li>
        <li><a href="contact.php" class="nav-item">Contact</a></li>
      </ul>
    </div>
    </div>
  </nav>