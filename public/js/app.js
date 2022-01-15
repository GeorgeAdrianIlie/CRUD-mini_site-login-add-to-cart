function addQuantity(productId){
    let value = $('#quantity-'+productId).val();
    value++
    $('#quantity-'+productId).val(value);

    console.log(value);
}


function subtractQuantity(productId){
    let value = $('#quantity-'+productId).val();
    if(value > 0 ){
        value--
        $('#quantity-'+productId).val(value);
    }
}


function changeAddress(){
    $("#delivery-address").addClass( "d-none" );
    $("#i-delivery-address").removeClass("d-none");
    $("#save-delivery-address").removeClass("d-none");
    $("#change-delivery-address").addClass( "d-none" );
}

function saveAddress(){
    $("#i-delivery-address").addClass( "d-none" );
    $("#delivery-address").removeClass("d-none");
    $("#change-delivery-address").removeClass("d-none");
    $("#save-delivery-address").addClass( "d-none" );

    let inputValue = $("#i-delivery-address").val();
    $("#i-delivery-address").attr("value", inputValue);
    // $("#i-delivery-address").val(inputValue);
    $("#delivery-address").text(inputValue);
}

function changeInvoiceAddress(){
    $("#invoice-address").addClass( "d-none" );
    $("#i-invoice-address").removeClass("d-none");
    $("#save-invoice-address").removeClass("d-none");
    $("#change-invoice-address").addClass( "d-none" );
}

function saveInvoiceAddress(){
    $("#i-invoice-address").addClass( "d-none" );
    $("#invoice-address").removeClass("d-none");
    $("#change-invoice-address").removeClass("d-none");
    $("#save-invoice-address").addClass( "d-none" );

    let inputValue = $("#i-invoice-address").val();
    $("#i-invoice-address").attr("value", inputValue);
    // $("#i-delivery-address").val(inputValue);
    $("#invoice-address").text(inputValue);
}


$('#toggle').click(function () {
    //check if checkbox is checked
    if ($(this).is(':checked')) {

        $('#place-order').removeAttr('disabled'); //enable input

    } else {
        $('#place-order').attr('disabled', true); //disable input
    }
});
