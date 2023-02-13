let Transaction = (function ($) {
 "use strict";

let submitForm = (e)=>{ 

    e.preventDefault();

    let id= $('#id').val();
    let dateOfTransaction= $('#dateOfTransaction').val();
    let details= $('#details').val();
    let location= $('#location').val();
    let transactionTypeId= $('#transactionTypeId').val();

    if(id==null || id==""){
        alert('ID is missing');
        return;
    }
    if(dateOfTransaction==null || dateOfTransaction==""){
        alert('Date of Transaction is missing');
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
    if(transactionTypeId==null || transactionTypeId==""){
        alert('Transaction Type is missing');
        return;
    }

  $.ajax({
      url:"ajax/save-transaction.php",
      type:"post",
      dataType:"json",
      data:{
          id:id,
          dateOfTransaction:dateOfTransaction,
          details:details,
          location:location,
          transactionTypeId:transactionTypeId,
      },
      success:(resp)=>{
          if(resp && resp.status=="status"){
              viewTransaction();
          }else{;
              alert(resp.message);
          }
      }
  });

}; //end submit form-add-transaction

  let addTransaction=(id)=>{
      $.ajax({
          url:"forms/transaction-form.php",
          type:"get",
          data:{
              id:id
          },
          success:(resp)=>{
              $('#page-content').html(resp);
          }
      })

} //end view function

  let viewTransaction=()=>{
      $.ajax({
          url:"ajax/view-transaction.php",
          type:"get",
          success:(resp)=>{
              $('#page-content').html(resp);
          }
      })

} //end view function

return {
    addTransaction: addTransaction,
    viewTransaction: viewTransaction,
    submitForm:submitForm
  };

})(jQuery);
