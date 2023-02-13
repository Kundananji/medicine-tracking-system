let DamageNotification = (function ($) {
 "use strict";

let submitForm = (e)=>{ 

    e.preventDefault();

    let id= $('#id').val();
    let dateOfNotification= $('#dateOfNotification').val();
    let reportedbyId= $('#reportedbyId').val();
    let details= $('#details').val();
    let location= $('#location').val();

    if(id==null || id==""){
        alert('ID is missing');
        return;
    }
    if(dateOfNotification==null || dateOfNotification==""){
        alert('Date of Notification is missing');
        return;
    }
    if(reportedbyId==null || reportedbyId==""){
        alert('Reported By is missing');
        return;
    }
    if(details==null || details==""){
        alert('Details is missing');
        return;
    }
    if(location==null || location==""){
        alert('Location is missing');
        return;
    }

  $.ajax({
      url:"ajax/save-damagenotification.php",
      type:"post",
      dataType:"json",
      data:{
          id:id,
          dateOfNotification:dateOfNotification,
          reportedbyId:reportedbyId,
          details:details,
          location:location,
      },
      success:(resp)=>{
          if(resp && resp.status=="status"){
              viewDamageNotification();
          }else{;
              alert(resp.message);
          }
      }
  });

}; //end submit form-add-damageNotification

  let addDamageNotification=(id)=>{
      $.ajax({
          url:"forms/damagenotification-form.php",
          type:"get",
          data:{
              id:id
          },
          success:(resp)=>{
              $('#page-content').html(resp);
          }
      })

} //end view function

  let viewDamageNotification=()=>{
      $.ajax({
          url:"ajax/view-damagenotification.php",
          type:"get",
          success:(resp)=>{
              $('#page-content').html(resp);
          }
      })

} //end view function

return {
    addDamageNotification: addDamageNotification,
    viewDamageNotification: viewDamageNotification,
    submitForm:submitForm
  };

})(jQuery);
