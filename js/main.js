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
    var divError = $('#errorMessage_mail');    
     if(!emailText.match(regexMail)){
        email.addClass('border-danger');
        email.removeClass('border-success');
        divError.html('<p class="text-secondary"> Veuillez indiquer une adresse mail selon le format suivant : email@email.com.</p>');
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
    var divError = $('#errorMessage_p');
    if(!passwordValue.match(regexPw)){
        password.addClass('border-danger');
        password.removeClass('border-success');
        divError.html('<p class="text-secondary"> Votre mot de passe doit contenir entre 8 et 25 caractères dont une lettre minuscule, une lettre majuscule et un chiffre.</p>');
    } else {
        password.addClass('border-success');
        password.removeClass('border-danger');
    }
}

function pw_doublecheck() {
    var passwordConfirm = $('#confirm_password');
    var passwordValue =  $('#password').val();
    var password_confirmationValue =  $('#confirm_password').val(); 
    var divError = $('#errorMessage_pc');
    if(passwordValue != password_confirmationValue){
        passwordConfirm.addClass('border-danger');
        passwordConfirm.removeClass('border-success');
        divError.html('<p class="text-secondary"> Les deux entrées de mot de passe ne correspondent pas. </p>');
    } else {
        passwordConfirm.addClass('border-success');
        passwordConfirm.removeClass('border-danger');
    }
}