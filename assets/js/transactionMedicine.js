let TransactionMedicine = (function ($) {
 "use strict";

let submitForm = (e)=>{ 

    e.preventDefault();

    let id= $('#id').val();
    let transactionId= $('#transactionId').val();
    let medicineId= $('#medicineId').val();
    let details= $('#details').val();
    let quantity= $('#quantity').val();
    let amount= $('#amount').val();

    if(id==null || id==""){
        alert('ID is missing');
        return;
    }
    if(transactionId==null || transactionId==""){
        alert('Transaction is missing');
        return;
    }
    if(medicineId==null || medicineId==""){
        alert('Medicine is missing');
        return;
    }
    if(details==null || details==""){
        alert('Details is missing');
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
      url:"ajax/save-transactionmedicine.php",
      type:"post",
      dataType:"json",
      data:{
          id:id,
          transactionId:transactionId,
          medicineId:medicineId,
          details:details,
          quantity:quantity,
          amount:amount,
      },
      success:(resp)=>{
          if(resp && resp.status=="status"){
              viewTransactionMedicine();
          }else{;
              alert(resp.message);
          }
      }
  });

}; //end submit form-add-transactionMedicine

  let addTransactionMedicine=(id)=>{
      $.ajax({
          url:"forms/transactionmedicine-form.php",
          type:"get",
          data:{
              id:id
          },
          success:(resp)=>{
              $('#page-content').html(resp);
          }
      })

} //end view function

  let viewTransactionMedicine=(data)=>{
    let loader =  `<div class="alert alert-warning"><i class="bi bi-hourglass"></i> Loading....</div>`;
    if(data.transactionId){    
        $('#showContentModal').modal('show');    
       $('#show-content-modal-body').html(loader);
     }
     else{
       $('#page-content').html(loader);
     }
      $.ajax({
          url:"ajax/view-transactionmedicine.php",
          type:"get",
          data:data,
          success:(resp)=>{
            if(data.transactionId){
                $('#showContentModal').modal('show');
                $('#show-content-modal-body').html(resp);
                $('#table-data-table').DataTable();
              }
              else{
                $('#page-content').html(resp);
              }
          }
      })

} //end view function

return {
    addTransactionMedicine: addTransactionMedicine,
    viewTransactionMedicine: viewTransactionMedicine,
    submitForm:submitForm
  };

})(jQuery);
