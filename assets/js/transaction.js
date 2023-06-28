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

  let viewTransaction=(data)=>{
    
    let loader =  `<div class="alert alert-warning"><i class="bi bi-hourglass"></i> Loading....</div>`;
    if(data && data.transactionId){        
        $('#showTransactionModal').modal('show');
        $('#show-transaction-modal-body').html(loader);
     }
     else{
       $('#page-content').html(loader);
     }
      $.ajax({
          url:"ajax/view-transaction.php",
          type:"get",
          data:data,
          success:(resp)=>{
            if(data && data.transactionId){                
                $('#show-transaction-modal-body').html(resp);
                $('#table-data-table').DataTable();
              }
              else{
                $('#page-content').html(resp);
                $('#table-data-table').DataTable();
              }
          }
      })

} //end view function

let traceOnMap=(data)=>{
    let loader =  `<div class="alert alert-warning"><i class="bi bi-hourglass"></i> Loading....</div>`;

    $('#page-content').html(loader);
     
    $.ajax({
        url:"ajax/trace-on-map.php",
        type:"get",
        data:data,
        success:(resp)=>{
            $('#page-content').html(resp);
 
        }
    })

} //end view function

let traceMedicine=(data)=>{
    let loader =  `<div class="alert alert-warning"><i class="bi bi-hourglass"></i> Loading....</div>`;

    $('#page-content').html(loader);
     
    $.ajax({
        url:"ajax/trace-medicine.php",
        type:"get",
        data:data,
        success:(resp)=>{
            $('#page-content').html(resp);
 
        }
    })

} //end view function



/**
 * Function to trace a particular medicine 
 */
let viewTrace=(data)=>{
    let loader =  `<div class="alert alert-warning"><i class="bi bi-hourglass"></i> Loading....</div>`;

    $('#showTransactionModal').modal('show');
    $('#show-transaction-modal-body').html(loader);
     
    $.ajax({
        url:"ajax/view-medicine-trace.php",
        type:"get",
        data:data,
        success:(resp)=>{
            $('#show-transaction-modal-body').html(resp);
 
        }
    })

} //end view function

let filterTransactions = () => {
    let startDate = $('#startDate').val();
    let endDate = $('#endDate').val();
    let searchTerm = $('#searchTerm').val();
  
    viewTransaction({
      startDate:startDate,
      endDate: endDate,
      searchTerm: searchTerm
    });
    
  }

return {
    addTransaction: addTransaction,
    viewTransaction: viewTransaction,
    submitForm:submitForm,
    traceOnMap:traceOnMap,
    filterTransactions:filterTransactions,
    traceMedicine:traceMedicine,
    viewTrace:viewTrace
  };

})(jQuery);
