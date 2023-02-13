let TransactionActor = (function ($) {
 "use strict";

let submitForm = (e)=>{ 

    e.preventDefault();

    let id= $('#id').val();
    let userId = $('#userId ').val();
    let transactionRoleId= $('#transactionRoleId').val();

    if(id==null || id==""){
        alert('ID is missing');
        return;
    }
    if(userId ==null || userId ==""){
        alert('User is missing');
        return;
    }
    if(transactionRoleId==null || transactionRoleId==""){
        alert('Transaction Role is missing');
        return;
    }

  $.ajax({
      url:"ajax/save-transactionactor.php",
      type:"post",
      dataType:"json",
      data:{
          id:id,
          userId :userId ,
          transactionRoleId:transactionRoleId,
      },
      success:(resp)=>{
          if(resp && resp.status=="status"){
              viewTransactionActor();
          }else{;
              alert(resp.message);
          }
      }
  });

}; //end submit form-add-transactionActor

  let addTransactionActor=(id)=>{
      $.ajax({
          url:"forms/transactionactor-form.php",
          type:"get",
          data:{
              id:id
          },
          success:(resp)=>{
              $('#page-content').html(resp);
          }
      })

} //end view function

  let viewTransactionActor=()=>{
      $.ajax({
          url:"ajax/view-transactionactor.php",
          type:"get",
          success:(resp)=>{
              $('#page-content').html(resp);
          }
      })

} //end view function

return {
    addTransactionActor: addTransactionActor,
    viewTransactionActor: viewTransactionActor,
    submitForm:submitForm
  };

})(jQuery);
