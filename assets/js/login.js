(function() {
    "use strict";

    $(document).ready(()=>{

        $('#form-login').on('submit',(e)=>{
            e.preventDefault();
            let username = $('#yourUsername').val();
            let password = $('#yourPassword').val();

            if(!username){
        
                $('#feed-back').html(`
                 <div class="alert alert-warning">
                     <p><i class="fa fa-times"></i> Please enter username</p>
                 </div>
                
                `);
                return;
            }

            if(!password){
                $('#feed-back').html(`
                <div class="alert alert-warning">
                    <p><i class="fa fa-times"></i> Please enter password</p>
                </div>
               
               `);
                return;
            }

            $('#feed-back').html(`
            <div class="alert alert-warning">
                <p><i class="fa fa-hourglass"></i> Please wait as we log you in...</p>
            </div>                           
           `);

            $.ajax({
                url:'ajax/login.php',
                type:'post',
                dataType:'json',
                data:{
                    username:username,
                    password:password,

                },
                success:(resp)=>{
                    if(resp){
                        if(resp.status =="success"){
                            $('#feed-back').html(`
                                <div class="alert alert-success">
                                    <p><i class="fa fa-check"></i> Logged In Successfully!</p>
                                </div>                           
                            `);
                            window.location="index.php";
                        }
                        else{
                            $('#feed-back').html(`
                            <div class="alert alert-warning">
                                <p> <i class="fa fa-times"></i> Invalid username or password</p>
                            </div>                           
                           `);
                  
                        }
                    }
                    else{
                       
                        $('#feed-back').html(`
                        <div class="alert alert-warning">
                            <p><i class="fa fa-times"></i> Invalid username or password</p>
                        </div>                           
                       `);
                    }
                },
                error:(resp)=>{
                   
                    $('#feed-back').html(`
                    <div class="alert alert-danger">
                        <p><i class="fa fa-times"></i> Sorry, an error occurred. Try again later.</p>
                    </div>                           
                   `);
                }
            });
        })

    });

})();