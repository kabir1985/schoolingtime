    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <!-- <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://randomuser.me/api/portraits/men/1.jpg" alt="User Image">
        <div>
          <p class="app-sidebar__user-name"> <?php //echo $_SESSION['name'];?></p>
          <p class="app-sidebar__user-designation"><?php //echo $_SESSION['mobile'];?></p>
        </div>
      </div> -->
      <ul class="app-menu">
        <li><a class="app-menu__item active" href="<?php echo site_url('/supperadmin')?>"><i class="app-menu__icon bi bi-speedometer"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-laptop"></i><span class="app-menu__label">Settings</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="<?php echo site_url('supperadmin/courseStatus')?>"><i class="icon bi bi-circle-fill"></i> Course Active/Inactive</a></li>
            <li><a class="treeview-item" href="<?php echo site_url('supperadmin/coursetypeadd'); ?>"><i class="icon bi bi-circle-fill"></i> Course Type Add</a></li>
            <li><a class="treeview-item" href="<?php echo site_url('supperadmin/course-section-add'); ?>"><i class="icon bi bi-circle-fill"></i> Course Section Add</a></li>
            <li><a class="treeview-item" href="<?php echo site_url('supperadmin/coursecategoryadd'); ?>"><i class="icon bi bi-circle-fill"></i> Course Category Add</a></li>
            <li><a class="treeview-item" href="<?php echo site_url('supperadmin/sales-commission-view'); ?>"><i class="icon bi bi-circle-fill"></i> Sales Commission Set</a></li>
          </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-ui-checks"></i><span class="app-menu__label">Forms</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="#"><i class="icon bi bi-circle-fill"></i> Form Components</a></li>
            <li><a class="treeview-item" href="#"><i class="icon bi bi-circle-fill"></i> Form Samples</a></li>
          </ul>
        </li>
        <li><a class="app-menu__item" href="#"><i class="app-menu__icon bi bi-code-square"></i><span class="app-menu__label">Docs</span></a></li>
      </ul>
    </aside>