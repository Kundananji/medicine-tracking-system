(function() {
    "use strict";

    $(document).ready(()=>{

        $('#logout-link').on('click',(e)=>{
            e.preventDefault();
            if(confirm("Are you Sure you want to logout?")){

                $.ajax({
                    url:'ajax/logout.php',
                    type:'get',
                    dataType:'json',
                    success:(resp)=>{
                        if(resp && resp.status =="success"){
                            window.location="login.php";
                        }
                        else{
                            alert('Sorry, failed to logout');
                        }
                    }
                });
            }

        })




    }); //end document ready

})();