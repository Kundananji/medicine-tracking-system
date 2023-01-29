<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link " href="index.html">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->



  <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#medicine-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Medicines</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="medicine-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <?php
           if($mUserType->getCanAddMedicine()){
          ?>
          <li>
            <a href="javascript:void(0)" onclick="Medicine.addMedicine()">
              <i class="bi bi-circle"></i><span>Add New Medicine</span>
            </a>
          </li>
          <?php
           }
          ?>
         <?php
           if($mUserType->getCanViewMedicine()){
          ?>
          <li>
            <a href="javascript:void(0)" onclick="Medicine.viewMedicine()">
              <i class="bi bi-circle"></i><span>View Medicine</span>
            </a>
          </li>
          <?php
           }
          ?>

        </ul>
      </li><!-- End Medicines Nav -->

  

</ul>

</aside><!-- End Sidebar-->
