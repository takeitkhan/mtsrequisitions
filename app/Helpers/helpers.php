<?php

if (!function_exists('enrollStatus')) {
  function enrollStatus($status)
  {
    switch ($status) {
      case 'Enroll':
        $colorClass = '';
        break;
      case 'Terminated':
        $colorClass = 'is-danger has-text-danger';
        break;
      case 'Long Leave':
        $colorClass = 'is-link has-text-link';
        break;
      case 'Left Job':
        $colorClass = 'is-warning has-text-warning';
        break;
      default:
        $colorClass = '';
    }
    return $colorClass;
  }
}


if (!function_exists('titleSet')) {
  function titleSet($spShowTitleSet = null, $spTitle = null, $spSubTitle = null, $spStatus = null, $spMessage = null)
  {
      if (!empty($spShowTitleSet) && $spShowTitleSet == true) {
          ob_start();
          ?>
          <div class="level-item is-5">
              <div>
                  <h3><strong><?php echo htmlspecialchars($spTitle); ?></strong> | <?php echo ucfirst(htmlspecialchars($spSubTitle)); ?></h3>
              </div>
              <?php if (!empty($spStatus) && $spStatus == 1) { ?>
                  <p class="has-text-success hideMessage">
                      <?php echo !empty($spMessage) ? htmlspecialchars($spMessage) : ''; ?>
                  </p>
              <?php } else { ?>
                  <p class="has-text-danger hideMessage">
                      <?php echo !empty($spMessage) ? htmlspecialchars($spMessage) : ''; ?>
                  </p>
              <?php } ?>
          </div>
          <?php
          return ob_get_clean();
      }
      return '';
  }
}


if (!function_exists('buttonSet')) {
  function buttonSet($spShowButtonSet = null, $spAddUrl = null, $spAllData = null, $spTitle = null, $spExportCSV = null, $spCss = null, $xspAllData = null, $xspTitle = null)
  {
      if (!empty($spShowButtonSet) && $spShowButtonSet == true) {
          ob_start();
          ?>
          <div class="level-item is-4">
              <?php if (!empty($spAllData)) { ?>
                  <a href="<?php echo htmlspecialchars($spAllData); ?>?route_id=<?php echo htmlspecialchars(request()->get('route_id')); ?>"
                     class="is-rounded button is-small is-info-light" aria-haspopup="true" aria-controls="dropdown-menu3">
                      <span><i class="fas fa-database"></i> <?php echo htmlspecialchars($spTitle ?? 'All Datas'); ?></span>
                  </a>
              <?php } ?>

              <?php if ($spAddUrl != '#') { ?>
                  <a href="<?php echo htmlspecialchars($spAddUrl); ?>" class="is-rounded button is-small is-info-light" 
                     aria-haspopup="true" aria-controls="dropdown-menu">
                      <span><i class="fas fa-plus"></i> Add</span>
                  </a>
              <?php } ?>

              <?php if (!empty($xspAllData)) { ?>
                  <?php if (auth()->user()->isManager(auth()->user()->id) || auth()->user()->isResource(auth()->user()->id) || 
                            auth()->user()->isCFO(auth()->user()->id) || auth()->user()->isAccountant(auth()->user()->id)) { ?>
                      <div class="column is-1">
                          <div class="level-item is-4">
                              <a href="<?php echo htmlspecialchars($xspAllData); ?>" 
                                 class="button is-small <?php echo htmlspecialchars($spCss ?? 'is-info-light'); ?> is-rounded"
                                 aria-haspopup="true" aria-controls="dropdown-menu3">
                                  <span><i class="fas fa-database"></i> <?php echo htmlspecialchars($xspTitle ?? 'All Datas'); ?></span>
                              </a>
                          </div>
                      </div>
                  <?php } ?>
              <?php } ?>

              <?php if (!empty($spExportCSV)) { ?>
                  <div class="dropdown">
                      <div class="dropdown-trigger">
                          <button class="is-rounded button is-small is-info-light" aria-haspopup="true" aria-controls="dropdown-menu3">
                              <span><i class="fas fa-tasks"></i> Action</span>
                          </button>
                      </div>
                      <div class="dropdown-menu" id="dropdown-menu3" role="menu">
                          <div class="dropdown-content">
                              <a href="<?php echo htmlspecialchars($spExportCSV); ?>" class="dropdown-item">
                                  Export CSV
                              </a>
                          </div>
                      </div>
                  </div>
              <?php } ?>
          </div>
          <?php
          return ob_get_clean();
      }
      return '';
  }
}

