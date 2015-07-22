

$(document).ready(function () {
    $("#confirmPassword").keyup(checkPasswordMatch);
    $("#password").keyup(checkPasswordMatch);
    $("#shopName").keyup(isValidateShopName);
    $("#address").keyup(isValidateAddress);
    $("#phoneNumber").keyup(isValidatePhone);
    $("#description").keyup(isValidateDescription);
//    $("#inputLatitude").keyup(isValidateLatitude);
    $("#openAndCloseTime").keyup(isValidateOpenAndCloseTime);

});

function checkPasswordMatch() {
    var password = $("#password").val();
    var confirmPassword = $("#confirmPassword").val();
    if (password != confirmPassword){
        $("span#spanPassword").remove();
        $("span#spanConfirmPassword").remove();
        $(".password").addClass("has-error has-feedback").append("<span id='spanPassword' class='glyphicon glyphicon-remove form-control-feedback'></span>");
        $(".confirmPassword").addClass("has-error has-feedback").append("<span id='spanPassword' class='glyphicon glyphicon-remove form-control-feedback'></span>");
    } else{
        if(password.length <= 3){
            $("span#spanPassword").remove();
            $("span#spanConfirmPassword").remove();
            $(".password").addClass("has-error has-feedback").append("<span id='spanPassword' class='glyphicon glyphicon-remove form-control-feedback'></span>");
            $(".confirmPassword").addClass("has-error has-feedback").append("<span id='spanPassword' class='glyphicon glyphicon-remove form-control-feedback'></span>");
        } else{
            $("span#spanPassword").remove();
            $("span#spanConfirmPassword").remove();
            $(".password").addClass("has-success").removeClass("has-error").append("<span id='spanPassword' class='glyphicon glyphicon-ok form-control-feedback'></span>");
            $(".confirmPassword").addClass("has-success").removeClass("has-error").append("<span id='spanConfirmPassword' class='glyphicon glyphicon-ok form-control-feedback'></span>");
        }
    }
}

var checkEmailIsValid = false;

function changeCheckEmailIsValidValue(){
    checkEmailIsValid = true;
}

$( "#submitAddBtn" ).click(function( event ) {
    event.preventDefault();
    var password = $("#password").val();
    var confirmPassword = $("#confirmPassword").val();
    if(isValidateAddress() && isValidateDescription() && isValidateLatitude() && isValidatePhone() && isValidateShopName() && isValidateOpenAndCloseTime()){
        if(password == confirmPassword && password.length >= 4 && checkEmailIsValid == true) {
            $( "#addAccountForm" ).submit();
        } else {
            $( "#submitAddBtn").after("<p style='padding-left: 10px; color: orangered'>Check your input</p>")
        }
    } else {
        isValidateAddress();
        isValidateDescription();
        isValidateLatitude();
        isValidateLatitude();
        isValidateOpenAndCloseTime();
        isValidatePhone();
        isValidateShopName();
        isValidEmailAddress();
        checkPasswordMatch();
        checkExistingEmail();
    }
});

function isValidateShopName(){
    if($("#shopName").val().length > 2){
        $("span#spanShopName").remove();
        $(".shopName").addClass("has-success has-feedback").removeClass("has-error").append("<span id='spanShopName' class='glyphicon glyphicon-ok form-control-feedback'></span>");
        return true;
    } else {
        $("span#spanShopName").remove();
        $(".shopName").addClass("has-error has-feedback").append("<span id='spanShopName' class='glyphicon glyphicon-remove form-control-feedback'></span>");
        return false;
    }
}

function isValidatePhone(){
    if($("#phoneNumber").val().length > 8){
        $("span#spanPhoneNumber").remove();
        $(".phoneNumber").addClass("has-success has-feedback").removeClass("has-error").append("<span id='spanPhoneNumber' class='glyphicon glyphicon-ok form-control-feedback'></span>");
        return true;
    } else {
        $("span#spanPhoneNumber").remove();
        $(".phoneNumber").addClass("has-error has-feedback").append("<span id='spanPhoneNumber' class='glyphicon glyphicon-remove form-control-feedback'></span>");
        return false;
    }
}

function isValidateDescription(){
    if($("#description").val().length > 15){
        $("span#spanDescription").remove();
        $(".description").addClass("has-success has-feedback").removeClass("has-error").append("<span id='spanDescription' class='glyphicon glyphicon-ok form-control-feedback'></span>");
        return true;
    } else {
        $("span#spanDescription").remove();
        $(".description").addClass("has-error has-feedback").append("<span id='spanDescription' class='glyphicon glyphicon-remove form-control-feedback'></span>");
        return false;
    }
}

function isValidateAddress() {
    if($("#address").val().length > 10){
        $("span#spanAddress").remove();
        $(".address").addClass("has-success has-feedback").removeClass("has-error").append("<span id='spanAddress' class='glyphicon glyphicon-ok form-control-feedback'></span>");
        return true;
    } else {
        $("span#spanAddress").remove();
        $(".address").addClass("has-error has-feedback").append("<span id='spanAddress' class='glyphicon glyphicon-remove form-control-feedback'></span>");
        return false;
    }
}

function isValidateLatitude() {
    if($("#inputLatitude").val().length > 2){
        $("span#spanInputLatitude").remove();
        $(".inputLatitude").addClass("has-success has-feedback").removeClass("has-error").append("<span id='spanInputLatitude' class='glyphicon glyphicon-ok form-control-feedback'></span>");
        return true;
    } else {
        $("span#spanInputLatitude").remove();
        $(".inputLatitude").addClass("has-error has-feedback").append("<span id='spanInputLatitude' class='glyphicon glyphicon-remove form-control-feedback'></span>");
        return false;
    }
}

function isValidateOpenAndCloseTime(){
    if($("#openAndCloseTime").val().length > 5){
        $("span#spanOpenAndCloseTime").remove();
        $(".openAndCloseTime").addClass("has-success has-feedback").removeClass("has-error").append("<span id='spanOpenAndCloseTime' class='glyphicon glyphicon-ok form-control-feedback'></span>");
        return true;
    } else {
        $("span#spanOpenAndCloseTime").remove();
        $(".openAndCloseTime").addClass("has-error has-feedback").append("<span id='spanOpenAndCloseTime' class='glyphicon glyphicon-remove form-control-feedback'></span>");
        return false;
    }
}


function checkExistingEmail(data) {
    if(isValidEmailAddress(data) == true) {
        $.ajax({
            method: "GET",
            url: "whatapro/checkexistingemail",
            data: { key: data}
        }).done(function( msg ) {
            if(msg == true){
                $("span#spanEmail").remove();
                checkEmailIsValid = true;
                $(".email").addClass("has-success has-feedback").removeClass("has-error").append("<span id='spanEmail' class='glyphicon glyphicon-ok form-control-feedback'></span>");
            } else {
                $("span#spanEmail").remove();
                checkEmailIsValid = false;
                $(".email").addClass("has-error has-feedback").append("<span id='spanEmail' class='glyphicon glyphicon-remove form-control-feedback'></span>");
            }
        });
    } else {
        $("span#spanEmail").remove();
        $(".email").addClass("has-error has-feedback").append("<span id='spanEmail' class='glyphicon glyphicon-remove form-control-feedback'></span>");
    }
}

function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(emailAddress);
};


