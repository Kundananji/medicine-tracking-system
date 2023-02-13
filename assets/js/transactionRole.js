let TransactionRole = (function ($) {
 "use strict";

let submitForm = (e)=>{ 

    e.preventDefault();

    let id= $('#id').val();
    let name = $('#name ').val();
    let description= $('#description').val();

    if(id==null || id==""){
        alert('ID is missing');
        return;
    }
    if(name ==null || name ==""){
        alert('Name is missing');
        return;
    }
    if(description==null || description==""){
        alert('Description is missing');
        return;
    }

  $.ajax({
      url:"ajax/save-transactionrole.php",
      type:"post",
      dataType:"json",
      data:{
          id:id,
          name :name ,
          description:description,
      },
      success:(resp)=>{
          if(resp && resp.status=="status"){
              viewTransactionRole();
          }else{;
              alert(resp.message);
          }
      }
  });

}; //end submit form-add-transactionRole

  let addTransactionRole=(id)=>{
      $.ajax({
          url:"forms/transactionrole-form.php",
          type:"get",
          data:{
              id:id
          },
          success:(resp)=>{
              $('#page-content').html(resp);
          }
      })

} //end view function

  let viewTransactionRole=()=>{
      $.ajax({
          url:"ajax/view-transactionrole.php",
          type:"get",
          success:(resp)=>{
              $('#page-content').html(resp);
          }
      })

} //end view function

return {
    addTransactionRole: addTransactionRole,
    viewTransactionRole: viewTransactionRole,
    submitForm:submitForm
  };

})(jQuery);
