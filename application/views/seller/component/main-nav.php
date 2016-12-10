<div class="col-md-3 left_col menu_fixed">
  <div class="left_col scroll-view">

    <div class="navbar nav_title" style="border: 0;">
      <a href="/admin" class="site_title"><i class="fa fa-paw"></i> <span>Tròn Design</span></a>
    </div>

    <div class="clearfix"></div>

    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <ul class="nav side-menu">

          <?php foreach($nav as $index=>$item): ?>
            <li class="<?php echo $alias === $item['alias'] ? 'current-page' : '' ?>">
              <a href="<?php echo $index ?>">
                <?php echo $item['icon'] ?> <?php echo $item['text'] ?><?php echo $item['notify'] ?>
              </a>
            </li>
          <?php endforeach; ?>
          
        </ul>
      </div>

    </div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
      <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="FullScreen">
        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Lock">
        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Logout">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
      </a>
    </div>
    <!-- /menu footer buttons -->
  </div>
</div>