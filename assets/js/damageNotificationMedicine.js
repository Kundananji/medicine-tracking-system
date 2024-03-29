let DamageNotificationMedicine = (function ($) {
 "use strict";

let submitForm = (e)=>{ 

    e.preventDefault();

    let id= $('#id').val();
    let damageNotificationId= $('#damageNotificationId').val();
    let medicineId= $('#medicineId').val();
    let quantity= $('#quantity').val();
    let amount= $('#amount').val();
    let details= $('#details').val();

    if(id==null || id==""){
        alert('ID is missing');
        return;
    }
    if(damageNotificationId==null || damageNotificationId==""){
        alert('Damage Notification is missing');
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
    if(details==null || details==""){
        alert('Details of Damage is missing');
        return;
    }

  $.ajax({
      url:"ajax/save-damagenotificationmedicine.php",
      type:"post",
      dataType:"json",
      data:{
          id:id,
          damageNotificationId:damageNotificationId,
          medicineId:medicineId,
          quantity:quantity,
          amount:amount,
          details:details,
      },
      success:(resp)=>{
          if(resp && resp.status=="success"){
              viewDamageNotificationMedicine();
          }else{;
              alert(resp.message);
          }
      }
  });

}; //end submit form-add-damageNotificationMedicine

  let addDamageNotificationMedicine=(id)=>{
      $.ajax({
          url:"forms/damagenotificationmedicine-form.php",
          type:"get",
          data:{
              id:id
          },
          success:(resp)=>{
              $('#page-content').html(resp);
          }
      })

} //end view function

  let viewDamageNotificationMedicine=(data)=>{
    let loader =  `<div class="alert alert-warning"><i class="bi bi-hourglass"></i> Loading....</div>`;
    if(data.damageNotificationId){        
       $('#show-content-modal-body').html(loader);
     }
     else{
       $('#page-content').html(loader);
     }
      $.ajax({
          url:"ajax/view-damagenotificationmedicine.php",
          type:"get",
          data:data,
          success:(resp)=>{
            if(data.damageNotificationId){
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
    addDamageNotificationMedicine: addDamageNotificationMedicine,
    viewDamageNotificationMedicine: viewDamageNotificationMedicine,
    submitForm:submitForm
  };

})(jQuery);
