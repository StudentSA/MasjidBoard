<?php $activePage = basename($_SERVER['PHP_SELF'], ".php"); ?>

    <header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
        <a class="navbar-brand">Musjid Admin</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item <?= ($activePage == 'salaahtimes') ? 'active':''; ?>">
              <a class="nav-link" href="./salaahtimes.php">Salaah Times </a>
            </li>
            <li class="nav-item <?= ($activePage == 'perpetualcalender') ? 'active':''; ?>">
              <a class="nav-link" href="./perpetualcalender.php">Perpetual Calender</a>
            </li>
            <li class="nav-item <?= ($activePage == 'masjidnotices') ? 'active':'';; ?>">
              <a class="nav-link" href="./masjidnotices.php">Masjid Notices</a>
            </li>
          </ul>
        </div>
        <span class="navbar-text">
            <b class="text-capitalize" id="welcome">Welcome : <?php echo $login_session; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
        </span>
        <span class="navbar-text">
            <a href="logout.php" class="btn btn-secondary btn-sm active" role="button" aria-pressed="true">Log Out</a>
        </span>
      </nav>
    </header>
