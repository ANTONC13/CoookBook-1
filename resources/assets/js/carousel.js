$(document).ready(function(){
    $('.carousel').carousel();
});


function reload_receipts_div( group_id ) {
    $( "#receipts_div" ).fadeTo( 500, 0.01, function() {
        $.get( $('html').attr('lang') + "/ajax/welcomeReceiptModalData/" + group_id, function( data ) {
            $( "#receipts_div" ).html( data );
            $('#receipt_carousel').carousel();
            $('.modal').modal();
            $( "#receipts_div" ).fadeTo( 500, 1, function(){
            } );
        });
    });
}
