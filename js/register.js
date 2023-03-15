$('document').ready(function() {   
    /* handle form validation */  
    $("#register-form").validate({
        rules:
     {
     user_name: {
        required: true,
     minlength: 3
     },
     user_dob: {
      required: true,
   },
     password: {
     required: true,
     minlength: 8,
     maxlength: 15
     },
     cpassword: {
     required: true,
     equalTo: '#password'
     },
     user_email: {
              required: true,
              email: true
              },
      user_contact:{
         required: true,
         minlength: 10,
     maxlength: 10
      }
      },
         messages:
      {
              user_name: "please enter user name",
              user_contact:'please enter contact number',
              password:{
                        required: "please provide a password",
                        minlength: "password at least have 8 characters"
                       },
              user_email: "please enter a valid email address",
     cpassword:{
        required: "please retype your password",
        equalTo: "password doesn't match !"
         }
         },
      submitHandler: submitForm 
         });  
      /* handle form submit */
      function submitForm() {  
      var data = $("#register-form").serialize();    
      $.ajax({    
      type : 'POST',
      url  : "http://localhost:3000/php/register.php",
      data : data,
      beforeSend: function() { 
       $("#error").fadeOut();
       $("#btn-submit").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
      },
      success :  function(response) {   
         console.log(response);   
          if(response==1){         
               $("#error").fadeIn(1000, function(){
                 $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; Sorry email already taken !</div>');           
                 $("#btn-submit").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Create Account');          
               });                    
          } else if(response=="registered"){  
               $("#btn-submit").html('<img src="ajax-loader.gif" /> &nbsp; Signing Up ...');
               setTimeout('$(".form-signin").fadeOut(500, function(){ $(".register_container").load("welcome.php"); }); ',3000);
               location.href = "./login.html";    
          } else {          
               $("#error").fadeIn(1000, function(){    
                  window.location.replace("http://127.0.0.1:5500/login.html");         
                    $("#error").html('<div class="alert alert-danger"><span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+data+' !</div>');           
                   $("#btn-submit").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Create Account');         
               });           
             }
          }
      });
      return false;
    }
  });