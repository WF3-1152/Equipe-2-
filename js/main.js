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


