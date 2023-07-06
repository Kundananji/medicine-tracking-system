
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link " href="index.php">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->



  <li class="nav-item">
  <?php
           if($mUserType->getCanAddMedicine() ||$mUserType->getCanViewMedicine() ){
          ?>
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
           }
          ?>
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



<?php
  //delivery notification
           if($mUserType->getCanDeliver()){
          ?>
       <!-- Deliveries-->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#deliveries-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-truck"></i><span>Deliveries</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="deliveries-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
   
          <li>
            <a href="javascript:void(0)" onclick="DeliveryNotification.addDeliveryNotification()">
              <i class="bi bi-circle"></i><span>Add New Delivery</span>
            </a>
          </li>
    
  
          <li>
            <a href="javascript:void(0)" onclick="DeliveryNotification.viewDeliveryNotification()">
              <i class="bi bi-circle"></i><span>View Deliveries</span>
            </a>
          </li>
   

        </ul>
      </li><!-- End Medicines Nav -->

      <?php
           }
      ?>


<?php
  //prescription notification
           if($mUserType->getCanDispense()){
          ?>
       <!-- dipenses-->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#prescriptions-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-arrow-right"></i><span>Prescriptions</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="prescriptions-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
   
          <li>
            <a href="javascript:void(0)" onclick="Prescription.addPrescription()">
              <i class="bi bi-circle"></i><span>Add New Prescription</span>
            </a>
          </li>
    
  
          <li>
            <a href="javascript:void(0)" onclick="Prescription.viewPrescription()">
              <i class="bi bi-circle"></i><span>View Prescriptions</span>
            </a>
          </li>
   

        </ul>
      </li><!-- End Prescriptions Nav -->

      <?php
           }
      ?>


<?php
  //Damages notification
           if($mUserType->getCanReportDamage()){
          ?>
       <!-- damages-->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#damages-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-trash"></i><span>Damages</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="damages-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
   
          <li>
            <a href="javascript:void(0)" onclick="DamageNotification.addDamageNotification()">
              <i class="bi bi-circle"></i><span>Add New Damage</span>
            </a>
          </li>
    
  
          <li>
            <a href="javascript:void(0)" onclick="DamageNotification.viewDamageNotification()">
              <i class="bi bi-circle"></i><span>View Damages</span>
            </a>
          </li>
   

        </ul>
      </li><!-- End Prescriptions Nav -->

      <?php
           }
      ?>



<?php
  //Reports 
           if($mUserType->getCanViewReport()){
          ?>
       <!-- damages-->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#reports-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-activity"></i><span>Reports</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="reports-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
   
          <li>
            <a href="javascript:void(0)" onclick="Transaction.viewTransaction()">
              <i class="bi bi-circle"></i><span>View Transactions</span>
            </a>
          </li>
    
  
          <li>
            <a href="javascript:void(0)" onclick="Transaction.traceOnMap()">
              <i class="bi bi-circle"></i><span>View On Map</span>
            </a>
          </li>

          <li>
            <a href="javascript:void(0)" onclick="Transaction.traceMedicine()">
              <i class="bi bi-circle"></i><span>Trace Medicine</span>
            </a>
          </li>
   

        </ul>
      </li><!-- End Prescriptions Nav -->

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
            <a href="javascript:void(0)" onclick="User.updateMiningDetails()">
              <i class="bi bi-person"></i><span>Update Mining Details</span>
            </a>
          </li>

          <li>
            <a href="/mining-tool/mts-mining-tool.jar">
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
