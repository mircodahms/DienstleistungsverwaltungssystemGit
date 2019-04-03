//Buttons
$(document).ready(function(){
    $(".icon-input-btn").each(function(){
        var btnFont = $(this).find(".btn").css("font-size");
        var btnColor = $(this).find(".btn").css("color");
        $(this).find(".glyphicon").css("font-size", btnFont);
        $(this).find(".glyphicon").css("color", btnColor);
        if($(this).find(".btn-xs").length){
            $(this).find(".glyphicon").css("top", "24%");
        }
    });
});

//Sicherheitsabfrage
function chkDeleteNutzer(){
    submitBool = confirm("Wollen Sie den Nutzer wirklich löschen?");
    if (submitBool == false){
        return false;
    } else {
        return true;
    }
    // Oder gleich "return submitBool;"
}

//Sicherheitsabfrage
function chkDeleteDienst(){
    submitBool = confirm("Wollen Sie den Dienst wirklich löschen?");
    if (submitBool == false){
        return false;
    } else {
        return true;
    }
    // Oder gleich "return submitBool;"
}