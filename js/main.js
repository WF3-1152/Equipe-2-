$(document).ready(function() {
    var element = $('#background');
    var stock = $('#stock').text();
    stock = parseInt(stock);
    if(stock >= 10){
        element.addClass('bg-success');
    } else if(stock > 0 && stock < 10){
        element.addClass('bg-warning');
    } else {
        element.addClass('bg-danger');
    }
});


function validation(){
    var email = $('#email');
     var emailText = $('#email').val(); 
    var regexMail= /[a-z0-9]+@[a-z]+\.[a-z]{2,3}/;    
     if(!emailText.match(regexMail)){
         email.addClass('border-danger');
         email.removeClass('border-success');
         console.log('KO');
     } else {
        email.addClass('border-success');
        email.removeClass('border-danger');
        console.log('OK')
   }
 }



