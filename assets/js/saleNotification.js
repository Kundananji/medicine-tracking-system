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

    if(!window.selectedMedicines){
        alert('Please select the medicine that was sold');
        return;
    }

    if(window.selectedMedicines.length == 0){
        alert('Please select the medicine that was sold');
        return;
    }

    //loop through each medicines and append amounts
    let missing = 0;
    window.selectedMedicines.forEach((elem,index)=>{

        let div = `#med_${elem.id}`;
        let amount = $(div).val().trim();
        if(amount == null || amount == ""){
            alert('Please enter an amount for '+elem.name);
            missing+=1;
        }

        window.selectedMedicines[index].amount = amount;

    });

    if(missing>0){
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
          medicines:window.selectedMedicines
      },
      success:(resp)=>{
          if(resp && resp.status=="success"){
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
