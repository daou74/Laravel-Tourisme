/**
 * script pour la verification d'user
 */

$('#register-user').click(function(){
    var firstname =$('#firstname').val();
    var lastname =$('#lastname').val();
    var email =$('#email').val();
    var password =$('#password').val();
    var password_confirm =$('#password-confirm').val();
    var passwordLength = password.length;
    var agreeterms =$('#agreeterms');

    
    

   if(firstname != "" && /^[a-zA-Z ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ]+$/.test(firstname)){
    
    $('#firstname').removeClass('is-invalid');
    $('#firstname').addClass('is-valid');
    $('#error-register-firstname').text("");

    if(lastname != "" && /^[a-zA-Z ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ]+$/.test(lastname)){
      
      $('#lastname').removeClass('is-invalid');
      $('#lastname').addClass('is-valid');
      $('#error-register-lastname').text("")


      if(email != "" && /^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/.test(email)){
        
        $('#email').removeClass('is-invalid');
        $('#email').addClass('is-valid');
        $('#error-register-email').text("")


        if(passwordLength >= 4){
        
          $('#password').removeClass('is-invalid');
          $('#password').addClass('is-valid');
          $('#error-register-password').text("")


          if(password == password_confirm ){
          
            $('#password-comfirm').removeClass('is-invalid');
            $('#password-confirm').addClass('is-valid');
            $('#error-register-password-confirm').text("");

            if(agreeterms.is(':checked')){
              $('#agreeterms').removeClass('is-invalid');
              $('#error-register-agreeterms').text("");


              var res =emailExistjs(email);

              /*(res != "exist")? $('#form-register').submit():
                    $('#email').addClass('is-invalid');
                    $('#email').removeClass('is-valid');
                    $('#error-register-email').text("This email address is already used!");*/

                    if((res != "exist")){
                      $('#form-register').submit()
                    }else{
                      $('#email').addClass('is-invalid');
                      $('#email').removeClass('is-valid');
                      $('#error-register-email').text("This email address is already used!");
                    }
              
  
              console.log('ok');
             
  
            }else{
              $('#agreeterms').addClass('is-invalid');
              $('#error-register-agreeterms').text("You should agree to ours terms and condition!")
            }
  
            
            
        
            }else{
                $('#password-confirm').addClass('is-invalid');
                $('#password-confirm').removeClass('is-valid');
                $('#error-register-password-confirm').text("Your password must be identical!")
            } 
  
        }else{
          
          $('#password').addClass('is-invalid');
          $('#password').removeClass('is-valid');
          $('#error-register-password').text("Your password must be at last 8 characteres!")
        }



        console.log('ok');
    
        }else{
            $('#email').addClass('is-invalid');
            $('#email').removeClass('is-valid');
            $('#error-register-email').text("Your email address is not valid!")
        } 



      console.log('ok');
  
      }else{
          $('#lastname').addClass('is-invalid');
          $('#lastname').removeClass('is-valid');
          $('#error-register-lastname').text("Last Name is not valid!")
      }

    

    }else{
        $('#firstname').addClass('is-invalid');
        $('#firstname').removeClass('is-valid');
        $('#error-register-firstname').text("First Name is not valid!")
    } 
     
      
     
       
        

          

         
         

  
          
});


// Evenement pour les termes et conditions
$('#agreeterms').change(function(){
  var agreeterms=$('#agreeterms');
  if(agreeterms.is(':checked')){
    $('#agreeterms').removeClass('is-invalid');
    $('#error-register-agreeterms').text("");

  }else{
    $('#agreeterms').addClass('is-invalid');
    $('#error-register-agreeterms').text("You should agree to ours terms and condition!")
  }
});

function emailExistjs(email){
  
  var url=$('#email').attr('url-emailExist');
  var token=$('#email').attr('token');
  var res ="";

  $.ajax({
    type: 'POST',
    url:url,
    data:{
      '_token': token,
      email: email
    },
    success:function(result){
      res=result.response;
    },
    async:false
  });
  return res;
  
}