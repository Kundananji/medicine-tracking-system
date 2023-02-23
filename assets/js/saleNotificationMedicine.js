let SaleNotificationMedicine = (function ($) {
 "use strict";

let submitForm = (e)=>{ 

    e.preventDefault();

    let id= $('#id').val();
    let saleNotificationId= $('#saleNotificationId').val();
    let medicineId= $('#medicineId').val();
    let quantity= $('#quantity').val();
    let amount= $('#amount').val();

    if(id==null || id==""){
        alert('ID is missing');
        return;
    }
    if(saleNotificationId==null || saleNotificationId==""){
        alert('Sale Notification is missing');
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
      url:"ajax/save-salenotificationmedicine.php",
      type:"post",
      dataType:"json",
      data:{
          id:id,
          saleNotificationId:saleNotificationId,
          medicineId:medicineId,
          quantity:quantity,
          amount:amount,
      },
      success:(resp)=>{
          if(resp && resp.status=="success"){
              viewSaleNotificationMedicine();
          }else{;
              alert(resp.message);
          }
      }
  });

}; //end submit form-add-saleNotificationMedicine

  let addSaleNotificationMedicine=(id)=>{
      $.ajax({
          url:"forms/salenotificationmedicine-form.php",
          type:"get",
          data:{
              id:id
          },
          success:(resp)=>{
              $('#page-content').html(resp);
          }
      })

} //end view function

  let viewSaleNotificationMedicine=(data)=>{
     let loader =  `<div class="alert alert-warning"><i class="bi bi-hourglass"></i> Loading....</div>`;
     if(data.saleNotificationId){        
        $('#show-content-modal-body').html(loader);
      }
      else{
        $('#page-content').html(loader);
      }

      console.log(data);

      $.ajax({
          url:"ajax/view-salenotificationmedicine.php",
          type:"get",
          data:data,
          success:(resp)=>{
            if(data.saleNotificationId){
              $('#showContentModal').modal('show');
              $('#show-content-modal-body').html(resp);
            }
            else{
              $('#page-content').html(resp);
            }
          }
      })

} //end view function

return {
    addSaleNotificationMedicine: addSaleNotificationMedicine,
    viewSaleNotificationMedicine: viewSaleNotificationMedicine,
    submitForm:submitForm
  };

})(jQuery);
