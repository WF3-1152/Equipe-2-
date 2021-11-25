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
     } else {
        email.addClass('border-success');
        email.removeClass('border-danger');
   }
}

function check_pw(){
    // At least one digit [0-9]
    // At least one lowercase character [a-z]
    // At least one uppercase character [A-Z]
    var password = $('#password');
    var passwordValue =  $('#password').val(); 
    var regexPw = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,25}$/;    
    if(!passwordValue.match(regexPw)){
        password.addClass('border-danger');
        password.removeClass('border-success');
    } else {
        password.addClass('border-success');
        password.removeClass('border-danger');
    }
}



