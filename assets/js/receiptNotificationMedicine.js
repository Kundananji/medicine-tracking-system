let ReceiptNotificationMedicine = (function ($) {
 "use strict";

let submitForm = (e)=>{ 

    e.preventDefault();

    let id= $('#id').val();
    let receiptNotificationId= $('#receiptNotificationId').val();
    let medicineId= $('#medicineId').val();
    let quantity= $('#quantity').val();
    let amount= $('#amount').val();

    if(id==null || id==""){
        alert('ID is missing');
        return;
    }
    if(receiptNotificationId==null || receiptNotificationId==""){
        alert('Receipt Notification is missing');
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
      url:"ajax/save-receiptnotificationmedicine.php",
      type:"post",
      dataType:"json",
      data:{
          id:id,
          receiptNotificationId:receiptNotificationId,
          medicineId:medicineId,
          quantity:quantity,
          amount:amount,
      },
      success:(resp)=>{
          if(resp && resp.status=="status"){
              viewReceiptNotificationMedicine();
          }else{;
              alert(resp.message);
          }
      }
  });

}; //end submit form-add-receiptNotificationMedicine

  let addReceiptNotificationMedicine=(id)=>{
      $.ajax({
          url:"forms/receiptnotificationmedicine-form.php",
          type:"get",
          data:{
              id:id
          },
          success:(resp)=>{
              $('#page-content').html(resp);
          }
      })

} //end view function

  let viewReceiptNotificationMedicine=()=>{
      $.ajax({
          url:"ajax/view-receiptnotificationmedicine.php",
          type:"get",
          success:(resp)=>{
              $('#page-content').html(resp);
          }
      })

} //end view function

return {
    addReceiptNotificationMedicine: addReceiptNotificationMedicine,
    viewReceiptNotificationMedicine: viewReceiptNotificationMedicine,
    submitForm:submitForm
  };

})(jQuery);
