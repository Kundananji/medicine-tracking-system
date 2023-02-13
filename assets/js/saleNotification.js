let SaleNotification = (function ($) {
 "use strict";

let submitForm = (e)=>{ 

    e.preventDefault();

    let id= $('#id').val();
    let dateOfSale= $('#dateOfSale').val();
    let buyerId= $('#buyerId').val();
    let sellerId= $('#sellerId').val();
    let location= $('#location').val();

    if(id==null || id==""){
        alert('ID is missing');
        return;
    }
    if(dateOfSale==null || dateOfSale==""){
        alert('Date of Sale is missing');
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
      url:"ajax/save-salenotification.php",
      type:"post",
      dataType:"json",
      data:{
          id:id,
          dateOfSale:dateOfSale,
          buyerId:buyerId,
          sellerId:sellerId,
          location:location,
      },
      success:(resp)=>{
          if(resp && resp.status=="status"){
              viewSaleNotification();
          }else{;
              alert(resp.message);
          }
      }
  });

}; //end submit form-add-saleNotification

  let addSaleNotification=(id)=>{
      $.ajax({
          url:"forms/salenotification-form.php",
          type:"get",
          data:{
              id:id
          },
          success:(resp)=>{
              $('#page-content').html(resp);
          }
      })

} //end view function

  let viewSaleNotification=()=>{
      $.ajax({
          url:"ajax/view-salenotification.php",
          type:"get",
          success:(resp)=>{
              $('#page-content').html(resp);
          }
      })

} //end view function

return {
    addSaleNotification: addSaleNotification,
    viewSaleNotification: viewSaleNotification,
    submitForm:submitForm
  };

})(jQuery);
