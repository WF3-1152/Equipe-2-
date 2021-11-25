$(document).ready(function() {
    var element = $('#background');
    var stock = $('#stock').text();
    stock = parseInt(stock);
    if(stock < 6 && stock > 2){
        element.addClass('bg-warning');
    } else if(stock <= 2){
        element.addClass('bg-danger');
    } else {
        element.addClass('bg-success');
    }

});


