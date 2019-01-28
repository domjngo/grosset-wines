/*!
 * Additional JS
 * 
 */

$( document ).ready(function() {
    console.log( "ready!" );
    // Closes the Responsive Menu on Menu Item Click
    $('.navbar-collapse ul li a').click(function() {
        $('.navbar-toggle:visible').click();
    });

    // Removes fixed width from .wp-caption div for images
    $(".wp-caption").removeAttr('style');

    resize();

    window.onresize = function() {
        resize();
    };
});

function resize()
{
    if ( document.getElementById("home_banner") !== null ) {
        var heights = window.innerHeight - 60;
        document.getElementById("home_banner").style.height = heights + "px";
    }
}
