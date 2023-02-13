let ReceiptNotification = (function ($) {
 "use strict";

let submitForm = (e)=>{ 

    e.preventDefault();

    let id= $('#id').val();
    let dateOfReceipt= $('#dateOfReceipt').val();
    let buyerId= $('#buyerId').val();
    let sellerId= $('#sellerId').val();
    let location= $('#location').val();

    if(id==null || id==""){
        alert('ID is missing');
        return;
    }
    if(dateOfReceipt==null || dateOfReceipt==""){
        alert('Date of Receipt is missing');
        return;
    }
    if(buyerId==null || buyerId==""){
        alert('Buyer is missing');
        return;
    }
    if(sellerId==null || sellerId==""){
        alert('Seller is missing');
        return;
    }
    if(location==null || location==""){
        alert('Location is missing');
        return;
    }

  $.ajax({
      url:"ajax/save-receiptnotification.php",
      type:"post",
      dataType:"json",
      data:{
          id:id,
          dateOfReceipt:dateOfReceipt,
          buyerId:buyerId,
          sellerId:sellerId,
          location:location,
      },
      success:(resp)=>{
          if(resp && resp.status=="status"){
              viewReceiptNotification();
          }else{;
              alert(resp.message);
          }
      }
  });

}; //end submit form-add-receiptNotification

  let addReceiptNotification=(id)=>{
      $.ajax({
          url:"forms/receiptnotification-form.php",
          type:"get",
          data:{
              id:id
          },
          success:(resp)=>{
              $('#page-content').html(resp);
          }
      })

} //end view function

  let viewReceiptNotification=()=>{
      $.ajax({
          url:"ajax/view-receiptnotification.php",
          type:"get",
          success:(resp)=>{
              $('#page-content').html(resp);
          }
      })

} //end view function

return {
    addReceiptNotification: addReceiptNotification,
    viewReceiptNotification: viewReceiptNotification,
    submitForm:submitForm
  };

})(jQuery);
