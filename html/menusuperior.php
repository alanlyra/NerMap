<?php
require_once 'system.php';
require_once 'checklogin.php';
require_once 'lang.php';
saveCurrentURL();
?>

<nav class="navbar navbar-expand navbar-light bg-menusuperior topbar mb-4 static-top shadow" style="background-image: url(img/futuro.jpeg);">

  <!-- Topbar Search -->
  <!-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
    <div class="input-group">
      <input type="text" class="form-control bg-light border-0 small" placeholder="Pesquisar por..." aria-label="Search" aria-describedby="basic-addon2">
      <div class="input-group-append">
        <button class="btn btn-primary" type="button">
          <i class="fas fa-search fa-sm"></i>
        </button>
      </div>
    </div>
  </form> -->

  
  <!-- Topbar Navbar -->
  <ul class="navbar-nav ml-auto">

<!-- Nav Item - Search Dropdown (Visible Only XS) -->
<li class="nav-item dropdown no-arrow d-sm-none" style="list-style:none;">
  <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-search fa-fw"></i>
  </a>
  <!-- Dropdown - Messages -->
  <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
    <form class="form-inline mr-auto w-100 navbar-search">
      <div class="input-group">
        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search fa-sm"></i>
          </button>
        </div>
      </div>
    </form>
  </div>
</li>


<!-- Nav Item - Messages -->
<!--<li class="nav-item dropdown no-arrow mx-1 show" style="list-style:none;">
  <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    <i class="fas fa-envelope fa-fw"></i>

    <span class="badge badge-danger badge-counter">7</span>
  </a>

  <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in show" aria-labelledby="messagesDropdown">
    
    <h6 class="dropdown-header">
      Convites
    </h6>
    <div style="height: 200px; overflow: auto;">
    <a class="dropdown-item d-flex align-items-center" href="#">
      <div class="dropdown-list-image mr-3">
        <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
      </div>
      <div class="font-weight-bold">
        <div class="text-truncate">TRM Work in 2050</div>
        <div class="small text-gray-500">Aceitar · Recusar</div>
      </div>
    </a>
    <a class="dropdown-item d-flex align-items-center" href="#">
      <div class="dropdown-list-image mr-3">
        <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
      </div>
      <div>
        <div class="text-truncate">I have the photos that you</div>
        <div class="small text-gray-500">Jae Chun · 1d</div>
      </div>
    </a>
    <a class="dropdown-item d-flex align-items-center" href="#">
      <div class="dropdown-list-image mr-3">
        <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
      </div>
      <div>
        <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
      </div>
    </a>
    <a class="dropdown-item d-flex align-items-center" href="#">
      <div class="dropdown-list-image mr-3">
        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
      </div>
      <div>
        <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
        <div class="small text-gray-500">Chicken the Dog · 2w</div>
      </div>
    </a>
    </div>
    <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
  </div>
</li>-->

<li class="nav-item dropdown no-arrow mx-1 show" style="list-style:none;">
  <a class="nav-link dropdown-toggle" href="#" id="languagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    <i class="fas fa-globe fa-fw"></i>
  </a>

  <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="languagesDropdown">
    
    <h6 class="dropdown-header" style="background-color: whitesmoke; border: 0; color: #5a5c69;">
      <?php echo $LANG['39']; ?>
    </h6>
    <div style="height: auto; width: 180px; overflow: auto;">
    <a class="dropdown-item d-flex align-items-center" href="#" onclick="change_language('en-us');">
      <div class="dropdown-list-image mr-3">
        <img class="rounded-circle" src="img/en-us2.png" title="English" style="height: 25px; width: 25px;">
      </div>
      <div>
        <div class="text-truncate">English</div>
      </div>
    </a>
    <a class="dropdown-item d-flex align-items-center" href="#" onclick="change_language('pt-BR');">
      <div class="dropdown-list-image mr-3">
        <img class="rounded-circle" src="img/pt-br2.png" alt="Português" style="height: 25px; width: 25px;">
      </div>
      <div>
        <div class="text-truncate">Português</div>
      </div>
    </a>
    
    </div>
  </div>
</li>

<div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow" style="list-style:none;">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['name']?></span>
        <img class="img-profile rounded-circle" src="<?php echo $_SESSION['photo']?>">
      </a>
      <!-- Dropdown - User Information -->
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

        <a class="dropdown-item" href="#">
          <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
          <?php echo $_SESSION['email']?>
        </a>
        <div class="dropdown-divider" style="visibility: hidden; margin: 0;"></div>
        <a class="dropdown-item" href="config-usuario.php" style="margin-bottom: 0.3rem;">
          <i class="fas fa-cog fa-sm fa-fw mr-2 text-gray-400"></i>
          <?php echo $LANG['35']; ?>
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal" style="margin-top: 0.3rem;">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
          <?php echo $LANG['112']; ?>
        </a>
      </div>
    </li>

  </ul>

</nav>
