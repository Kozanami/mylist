// Template switch

document.querySelector('#btnSwap').addEventListener("click", swap);

function expire()
{
    var theDate = new Date();
    var oneYearLater = new Date( theDate.getTime() + 31536000000 );
    var expiryDate = oneYearLater.toGMTString(); 
    return expiryDate;
}

function swap() {
    if(document.querySelector('#dark'))
    {      
        var color = '#dark';
        var colorSwap = "light";
    }
    if(document.querySelector('#light'))
    {
        var color = '#light';
        var colorSwap = "dark";
    }
    var selectColor = document.querySelector(color);
    
    selectColor.id = colorSwap;
    var splitted = selectColor.href;
    
    splitted = splitted.split("-");
    
    splitted = splitted[0]+"-"+colorSwap;
    document.cookie = "color="+colorSwap+"; expires="+expire()+"; path=/";
    selectColor.href = splitted;
    $('body').fadeOut(0, function(){
        $('body').fadeIn(0);
    });

}

// Security Password

var input = document.querySelector(".password");
var password_strength = document.querySelector(".pwdStrength");
var progress_div = document.querySelector(".progress");
var progress_bar = document.querySelector(".pwdStrengthLabel");

input.oninput = keyEvent;

function keyEvent()
{
    var password = document.querySelector(".password").value;
    // Si input vide on display none la progress bar
    if (password.length < 1)
    {
        progress_div.style = "display: none;"
    }
    // Sinon on execute la fonction check
    else
    {
        CheckPasswordStrength(password);
    }
}

function CheckPasswordStrength(password) {

    //Regex
    var regex = new Array();
    regex.push("[A-Z]");
    regex.push("[a-z]");
    regex.push("[0-9]");
    regex.push("[$@$!%*#?&]");

    var passed = 0;
    //Validation de l'expression régulière
    for (var i = 0; i < regex.length; i++) {
        if (new RegExp(regex[i]).test(password)) {
            passed++;
        }
    }

    //Validation du statut
    if (passed > 2) {
        passed++;
    }

    //Affichage du status.
    var classSecurity = "";
    var strength = "";
    var label = "";
    if (password.length > 8)
    {
        switch (passed) {
            case 0:
                strength = "width: 20%;";
                classSecurity = " bg-danger";
                label = "Très Faible";
                break;
            case 1:
                strength = "width: 40%;";
                classSecurity = " bg-danger";
                label = "Faible";
                break;
            case 2:
                strength = "width: 60%;";
                classSecurity = " bg-info";
                label = "Moyen";
                break;
            case 3:
            case 4:
                strength = "width: 80%;";
                classSecurity = " bg-success";
                label = "Bon";
                break;
            case 5:
                strength = "width: 100%;";
                classSecurity = " bg-success";
                label = "Très bon";
                break;
        }
    }
    else
    {
        strength = "width: 100%;";
        classSecurity = " bg-danger";
        label = "Mot de passe trop court";
    }
    progress_bar.innerHTML = label;
    password_strength.style = strength;
    password_strength.className = "pwdStrength progress-bar progress-bar-striped"+classSecurity;
    progress_div.removeAttribute("style");
}