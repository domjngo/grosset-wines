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

    /*var age = getCookie("GWageConfirm");
    if (age != "") {
        console.log( "GWageConfirm cookie set!" );
    } else {
        console.log( "No GWageConfirm cookie set!" );
        $("#verifyAge").show();
        var heights = window.innerHeight;
        document.getElementById("verifyAgeHeight").style.height = heights + "px";
    }

    $("#verifyAgeBtn").click(function(){
        document.cookie = "GWageConfirm=true";
        $("#verifyAge").hide();
    });*/
});

function resize()
{
    if ( document.getElementById("home_banner") !== null ) {
        var heights = window.innerHeight - 60;
        document.getElementById("home_banner").style.height = heights + "px";
    }
}

/*function getCookie(cname)
{
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}*/
