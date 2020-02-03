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
   window.location.reload();

}

