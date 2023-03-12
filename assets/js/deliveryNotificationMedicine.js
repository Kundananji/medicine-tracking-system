let DeliveryNotificationMedicine = (function ($) {
 "use strict";

let submitForm = (e)=>{ 

    e.preventDefault();

    let id= $('#id').val();
    let deliveryNotificationId= $('#deliveryNotificationId').val();
    let medicineId= $('#medicineId').val();
    let quantity= $('#quantity').val();
    let amount= $('#amount').val();

    if(id==null || id==""){
        alert('ID is missing');
        return;
    }
    if(deliveryNotificationId==null || deliveryNotificationId==""){
        alert('Delivery Notification is missing');
        return;
    }
    if(medicineId==null || medicineId==""){
        alert('Medicine is missing');
        return;
    }
    if(quantity==null || quantity==""){
        alert('Quantity is missing');
        return;
    }
    if(amount==null || amount==""){
        alert('Amount is missing');
        return;
    }

  $.ajax({
      url:"ajax/save-deliverynotificationmedicine.php",
      type:"post",
      dataType:"json",
      data:{
          id:id,
          deliveryNotificationId:deliveryNotificationId,
          medicineId:medicineId,
          quantity:quantity,
          amount:amount,
      },
      success:(resp)=>{
          if(resp && resp.status=="status"){
              viewDeliveryNotificationMedicine();
          }else{;
              alert(resp.message);
          }
      }
  });

}; //end submit form-add-deliveryNotificationMedicine

  let addDeliveryNotificationMedicine=(id)=>{
      $.ajax({
          url:"forms/deliverynotificationmedicine-form.php",
          type:"get",
          data:{
              id:id
          },
          success:(resp)=>{
              $('#page-content').html(resp);
          }
      })

} //end view function

  let viewDeliveryNotificationMedicine=(data)=>{
    let loader =  `<div class="alert alert-warning"><i class="bi bi-hourglass"></i> Loading....</div>`;
    if(data.deliveryNotificationId){        
       $('#show-content-modal-body').html(loader);
     }
     else{
       $('#page-content').html(loader);
     }
      $.ajax({
          url:"ajax/view-deliverynotificationmedicine.php",
          type:"get",
          success:(resp)=>{
            if(data.deliveryNotificationId){
                $('#showContentModal').modal('show');
                $('#show-content-modal-body').html(resp);
                $('#table-data-table').DataTable();
              }
              else{
                $('#page-content').html(resp);
                $('#table-data-table').DataTable();
              }
          }
      })

} //end view function

return {
    addDeliveryNotificationMedicine: addDeliveryNotificationMedicine,
    viewDeliveryNotificationMedicine: viewDeliveryNotificationMedicine,
    submitForm:submitForm
  };

})(jQuery);
