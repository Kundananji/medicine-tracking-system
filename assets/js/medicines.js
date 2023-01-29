let Medicine = (function ($) {
    "use strict";
   
   $('#form-add-medicine').on('submit',(e)=>{ 
   
       e.preventDefault();
   
       let id= $('#id').val();
       let name= $('#name').val();
       let description= $('#description').val();
       let manufacturedDate= $('#manufacturedDate').val();
       let expiryDate= $('#expiryDate').val();
       let gtin= $('#gtin').val();
       let serialNumber= $('#serialNumber').val();
       let lotNumber= $('#lotNumber').val();
       let packageDetails= $('#packageDetails').val();
       let manufacturerId= $('#manufacturerId').val();
   
       if(id==null || id==""){
           alert('ID is missing');
           return;
       }
       if(name==null || name==""){
           alert('Name is missing');
           return;
       }
       if(description==null || description==""){
           alert('Description is missing');
           return;
       }
       if(manufacturedDate==null || manufacturedDate==""){
           alert('Manufactured Date is missing');
           return;
       }
       if(expiryDate==null || expiryDate==""){
           alert('Expiry Date is missing');
           return;
       }
       if(gtin==null || gtin==""){
           alert('GTIN is missing');
           return;
       }
       if(serialNumber==null || serialNumber==""){
           alert('Serial Number is missing');
           return;
       }
       if(lotNumber==null || lotNumber==""){
           alert('LOT Number is missing');
           return;
       }
       if(packageDetails==null || packageDetails==""){
           alert('Package Details is missing');
           return;
       }
       if(manufacturerId==null || manufacturerId==""){
           alert('Manufacturer Id is missing');
           return;
       }
   
     $.ajax({
         url:"ajax/save-medicine.php",
         type:"post",
         data:{
             id:id,
             name:name,
             description:description,
             manufacturedDate:manufacturedDate,
             expiryDate:expiryDate,
             gtin:gtin,
             serialNumber:serialNumber,
             lotNumber:lotNumber,
             packageDetails:packageDetails,
             manufacturerId:manufacturerId,
         },
         success:(resp)=>{
             if(resp && resp.status=="status"){
                 viewMedicine;
             }else{;
                 alert('resp.message');
             }
         }
     });
   
   }); //end submit form-add-medicine
   
     let addMedicine=(id)=>{
         $.ajax({
             url:"forms/add-medicine.php",
             type:"get",
             data:{
                 id:id
             },
             success:(resp)=>{
                 $('#page-content').html(resp);
             }
         })
   
   } //end view function
   
     let viewMedicine=()=>{
         $.ajax({
             url:"ajax/view-medicine.php",
             type:"get",
             success:(resp)=>{
                 $('#page-content').html(resp);
             }
         })
   
   } //end view function
   
   return {
       addMedicine: addMedicine,
       viewMedicine: viewMedicine,
     };
   
   })(jQuery);
   