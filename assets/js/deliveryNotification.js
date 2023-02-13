let DeliveryNotification = (function ($) {
 "use strict";

let submitForm = (e)=>{ 

    e.preventDefault();

    let id= $('#id').val();
    let dateOfDelivery= $('#dateOfDelivery').val();
    let deliveredById= $('#deliveredById').val();
    let deliveredToId= $('#deliveredToId').val();
    let location= $('#location').val();

    if(id==null || id==""){
        alert('ID is missing');
        return;
    }
    if(dateOfDelivery==null || dateOfDelivery==""){
        alert('Date of Delivery is missing');
        return;
    }
    if(deliveredById==null || deliveredById==""){
        alert('Delivered By is missing');
        return;
    }
    if(deliveredToId==null || deliveredToId==""){
        alert('Delivered To is missing');
        return;
    }
    if(location==null || location==""){
        alert('Location is missing');
        return;
    }

  $.ajax({
      url:"ajax/save-deliverynotification.php",
      type:"post",
      dataType:"json",
      data:{
          id:id,
          dateOfDelivery:dateOfDelivery,
          deliveredById:deliveredById,
          deliveredToId:deliveredToId,
          location:location,
      },
      success:(resp)=>{
          if(resp && resp.status=="status"){
              viewDeliveryNotification();
          }else{;
              alert(resp.message);
          }
      }
  });

}; //end submit form-add-deliveryNotification

  let addDeliveryNotification=(id)=>{
      $.ajax({
          url:"forms/deliverynotification-form.php",
          type:"get",
          data:{
              id:id
          },
          success:(resp)=>{
              $('#page-content').html(resp);
          }
      })

} //end view function

  let viewDeliveryNotification=()=>{
      $.ajax({
          url:"ajax/view-deliverynotification.php",
          type:"get",
          success:(resp)=>{
              $('#page-content').html(resp);
          }
      })

} //end view function

return {
    addDeliveryNotification: addDeliveryNotification,
    viewDeliveryNotification: viewDeliveryNotification,
    submitForm:submitForm
  };

})(jQuery);
