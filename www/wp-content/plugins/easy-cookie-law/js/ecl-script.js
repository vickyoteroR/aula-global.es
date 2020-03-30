var eclCustomCheckbox = document.getElementById("ecl_custom")
var eclCustomCSSArea = document.getElementById("ecl_css_custom_styles")

var toggleCustomCSS = function(){
    if(eclCustomCheckbox && eclCustomCheckbox.checked){
        eclCustomCSSArea.style.display = "none";
    }else{
        eclCustomCSSArea.style.display = "block";
    }
}

eclCustomCheckbox.addEventListener('click', toggleCustomCSS)