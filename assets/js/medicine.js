let Medicine = (function ($) {
 "use strict";

 let removeMedicine =(id) => {
    let indexOfItem = -1;
  
    window.selectedMedicines.forEach((elem,index)=>{
        if(elem.id==id){
            indexOfItem = index;
        }

    });

    window.selectedMedicines.splice(indexOfItem,1);
    displaySelected();
 }

 let displaySelected = () =>{
    let output =`
                <h6>Added Medicines</h6>
                 <table class="table table-bordered table-striped">
                   <thead>
                     <tr>
                        <th>

                        </th>
                        <th>
                           Name
                        </th>
                        <th>
                            Description
                        </th>
                        <th>
                            Packaging
                        </th>
                        <th>
                           Manufacturer
                        </th>
                        <th>
                        </th>
                        <th>
                        </th>
                     </tr>
                   </thead>
                   <tbody>
                   
                   `;

                   window.selectedMedicines.forEach((medicine)=>{
      
                    output+=` 
                    <tr>
                        <td>
                         <input type="hidden" name="selected-medicines[]" value="${medicine.id}"/>
                        </td>
                        <td>
                         ${medicine.name}
                        </td>
                        <td>
                        ${medicine.description}
                        </td>
                        <td>
                         ${medicine.packageDetails}
                        </td>
                        <td>
                         ${medicine.manufacturer.name}
                        </td>
                        <td>
                        <input type="text" class="form-control" value="" id="med_${medicine.id}" placeholder="Enter Amount"/>
                       </td>
                       
                        <td>
                          <a href="javascript:void(0)" onclick="Medicine.removeMedicine(${medicine.id})"> <i class="bi bi-trash"></i> Remove</a>
                        </td>
                    </tr>`;

                   });


                   output+=`
                 

                   </tbody>
                 </table>`;

                 $('#added-medicines').html(output);
 }

 let addSelected =()=>{
   let oForm = document.getElementById('form-add-notification');
   let elements = oForm.elements;
   let selected = [];
   for(let i=0; i<elements.length; i++){
      var elem = elements[i];
       console.log(elem);
       if(elem.type=="checkbox" && elem.name =="medicines[]" && elem.checked){
         if(!window.selectedMedicines){
            window.selectedMedicines = [];
         }

         window.medicines.forEach((med)=>{
            if(med.id == elem.value){
                //create array with records that already exist with this id
               var medsFound = window.selectedMedicines.filter(function (el)
                    {
                    return el.id == med.id ;
                    }
                );
                if(medsFound.length == 0){ //only add if no meds already exist
                  window.selectedMedicines.push(med);  
                }
            }
         })
         
       }
   }
   //hide search
   $('#medicines-found').html('');
   displaySelected();
 }

 let searchMedicine =()=>{
    let searchText = $('#text-search-medicine').val().trim();
    if(searchText=="" || searchText==null){
        alert('Please enter a search term');
        return;
    }

    $.ajax({
        url:'ajax/search-medicine.php',
        type:'get',
        dataType:'json',
        data:{searchText:searchText},
        success:(data)=>{

            console.log('meds',data.medicines);
            console.log('length',data.medicines.length);
            if(data && data.medicines.length > 0){

                let output =`
             
                 <table class="table table-bordered">
                   <thead>
                     <tr>
                        <th>

                        </th>
                        <th>
                           Name
                        </th>
                        <th>
                            Description
                        </th>
                        <th>
                            Packaging
                        </th>
                        <th>
                           Manufacturer
                        </th>
                     </tr>
                   </thead>
                   <tbody>
                   
                   `;
                   window.medicines = []; //reset medicines
                   data.medicines.forEach((medicine)=>{
                    window.medicines.push(medicine);
                    output+=` 
                    <tr>
                        <td>
                         <input type="checkbox" name="medicines[]" value="${medicine.id}"/>
                        </td>
                        <td>
                         ${medicine.name}
                        </td>
                        <td>
                        ${medicine.description}
                        </td>
                        <td>
                         ${medicine.packageDetails}
                        </td>
                        <td>
                         ${medicine.manufacturer.name}
                        </td>
                    </tr>`;

                   });


                   output+=`
                 

                   </tbody>
                 </table>
                
                 <div class="m-3">

                   <a href="javascript:void(0)" onclick="Medicine.addSelected()"><i class="bi bi-plus"></i> Add Selected </a>
                 </div>
                
                `;
                $('#medicines-found').html(output);
            }
            else{
               $('#medicines-found').html(data);
            }
        },
        error:(data)=>{
            $('#medicines-found').html(`
              <div class="alert alert-danger">
                <p>Sorry, no medicines found for the search term ${searchText}
              </div>
            `);
        }

    });

 }

let submitForm = (e)=>{ 

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
     /*
    if(id==null || id==""){
        alert('ID is missing');
        return;
    }
    */
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
        alert('Manufacturer is missing');
        return;
    }
    $('#submit-feedback').html(`<div class="alert alert-warning"><i class="bi bi-hourglass-split"> Submitting... please wait.</div>`);

  $.ajax({
      url:"ajax/save-medicine.php",
      type:"post",
      dataType:"json",
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
          if(resp && resp.status=="success"){
              viewMedicine();
          }else{;
           
              $('#submit-feedback').html(`<div class="alert alert-danger"><i class="bi bi-exclamation-triangle-fill">${resp.message}</div>`);

          }
      }
  });

}; //end submit form-add-medicine

  let addMedicine=(id)=>{
      $.ajax({
          url:"forms/medicine-form.php",
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
              $('#table-data-table').DataTable();
          }
      })

} //end view function

return {
    addMedicine: addMedicine,
    viewMedicine: viewMedicine,
    submitForm:submitForm,
    searchMedicine:searchMedicine,
    addSelected:addSelected,
    removeMedicine:removeMedicine,
    displaySelected:displaySelected
  };

})(jQuery);
