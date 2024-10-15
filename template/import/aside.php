<?php
  function active_nav_link($nav_link)
  {
      if( !empty($_REQUEST['action']))
          if($_REQUEST['action'] == $nav_link)
              return 'active';
  }

?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">

  <div class="pb-2 w-100 text-center text-white">
    <a href="" class="w-100">
      <img src="template\dist\img\logosisas.jpg" alt="Logo" class="brand-image elevation-3" style="width: 100%; opacity: .8">
    </a>
    <span class="brand-text display-4"> C... & R... </span>
  </div>
  <div class="divider"></div>

  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
          <a href="?action=dashboard" class="nav-link btn_nav_link <?= active_nav_link("dashboard") ?>">
            <i class="nav-icon fas fa-circle"></i>
            <p>
              DASHBOARD
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="?action=entrant" class="nav-link btn_nav_link <?= active_nav_link("entrant") ?>">
            <i class="nav-icon fas fa-circle"></i>
            <p>
              COURRIER ENTRANT
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="?action=sortant" class="nav-link btn_nav_link <?= active_nav_link("sortant") ?>">
            <i class="nav-icon fas fa-circle"></i>
            <p>
              COURRIER SORTANT
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="?action=reunion" class="nav-link btn_nav_link <?= active_nav_link("reunion") ?>">
            <i class="nav-icon fas fa-circle"></i>
            <p>
              SALLE DE REUNION
            </p>
          </a>
        </li>
        
      </ul>
    </nav>
  </div>
</aside>