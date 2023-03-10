
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link " href="index.php">
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

      <?php
           if($mUserType->getCanSale()){
          ?>
       <!-- Sales-->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#sales-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Sales</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="sales-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
   
          <li>
            <a href="javascript:void(0)" onclick="SaleNotification.addSaleNotification()">
              <i class="bi bi-circle"></i><span>Add New Sale</span>
            </a>
          </li>
    
  
          <li>
            <a href="javascript:void(0)" onclick="SaleNotification.viewSaleNotification()">
              <i class="bi bi-circle"></i><span>View Sale</span>
            </a>
          </li>
   

        </ul>
      </li><!-- End Medicines Nav -->

      <?php
           }
      ?>


<?php
  //receipt notification
           if($mUserType->getCanReceive()){
          ?>
       <!-- Receipts-->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#receipts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-receipt"></i><span>Receipts</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="receipts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
   
          <li>
            <a href="javascript:void(0)" onclick="ReceiptNotification.addReceiptNotification()">
              <i class="bi bi-circle"></i><span>Add New Receipt</span>
            </a>
          </li>
    
  
          <li>
            <a href="javascript:void(0)" onclick="ReceiptNotification.viewReceiptNotification()">
              <i class="bi bi-circle"></i><span>View Receipts</span>
            </a>
          </li>
   

        </ul>
      </li><!-- End Medicines Nav -->

      <?php
           }
      ?>



      <!-- mining activities -->
      <?php
           if($mUserType->getCanMine()){
          ?>
       <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#mine-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-minecart-loaded"></i><span>Mining</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="mine-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
  
          <li>
            <a href="javascript:void(0)" onclick="User.addUser()">
              <i class="bi bi-person"></i><span>Update Account Details</span>
            </a>
          </li>

          <li>
            <a href="javascript:void(0)" onclick="Mine.downloadJavaClient()">
              <i class="bi bi-download"></i><span>Download Java Client</span>
            </a>
          </li>
      

        </ul>
      </li><!-- End Medicines Nav -->

      <?php
           }
       ?>

</ul>

</aside><!-- End Sidebar-->
