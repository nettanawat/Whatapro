
$(document).ready(function () {
    $("#promotionName").keyup(isValidatePromotionName);
    $("#description").keyup(isValidateDescription);
    $("input[type='date']").disabled;
});

$("button").click(function (e) {
    if (this.id == "clickSelectShop") {

    }
    else if (this.id == "clickSubmit") {
        e.preventDefault();
        var text = $("textarea#show").val();
        if(text == '' || !isValidatePromotionName || !isValidateDescription || !isValidateStartDateAndEndDate()) {
            if(text == ''){
                $(".selectShop").addClass("has-error has-feedback").removeClass("has-success");
            }
            isValidateDescription();
            isValidatePromotionName();
            isValidateStartDateAndEndDate();
        } else {
            $( "#addPromotionForm" ).submit();
        }

    } else {
        $.get('whatapro/View/find_shop_name.php?shopId=' + this.id, function (result, data) {
            document.getElementById("show").innerHTML = "You selected " + result;
        });
        document.getElementById("selectedShopId").value = this.id;
        $(".selectShop").addClass("has-success has-feedback").removeClass("has-error");
    }
});

$("#startDateId").change(function(e) {
    isValidateStartDateAndEndDate();
});

$("#endDateId").change(function(e) {
    isValidateStartDateAndEndDate();
});

function isValidatePromotionName(){
    if($("#promotionName").val().length < 4) {
        $("span#spanPromotionName").remove();
        $(".promotionName").addClass("has-error has-feedback").removeClass("has-success").append("<span id='spanPromotionName' class='glyphicon glyphicon-remove form-control-feedback'></span>");
        return false;
    } else {
        $("span#spanPromotionName").remove();
        $(".promotionName").addClass("has-success has-feedback").removeClass("has-error").append("<span id='spanPromotionName' class='glyphicon glyphicon-ok form-control-feedback'></span>");
        return true;
    }
}

function isValidateDescription(){
    if($("#description").val().length > 15){
        $("span#spanDescription").remove();
        $(".description").addClass("has-success has-feedback").removeClass("has-error").append("<span id='spanDescription' class='glyphicon glyphicon-ok form-control-feedback'></span>");
        return true;
    } else {
        $("span#spanDescription").remove();
        $(".description").addClass("has-error has-feedback").removeClass("has-success").append("<span id='spanDescription' class='glyphicon glyphicon-remove form-control-feedback'></span>");
        return false;
    }
}

function isValidateStartDateAndEndDate(){
    var endDate = $("#endDateId").val();
    var startDate = $("#startDateId").val();
    if(endDate == '' || startDate == ''){
        $("span#spanDate").remove();
        $(".dateClass").addClass("has-error has-feedback").removeClass("has-success").append("<span id='spanDate' class='glyphicon glyphicon-remove form-control-feedback'></span>");
        return false;
    } else {
        if(endDate < startDate){
            $("span#spanDate").remove();
            $(".dateClass").addClass("has-error has-feedback").removeClass("has-success").append("<span id='spanDate' class='glyphicon glyphicon-remove form-control-feedback'></span>");
            return false;
        } else {
            $("span#spanDate").remove();
            $(".dateClass").addClass("has-success has-feedback").removeClass("has-error").append("<span id='spanDate' class='glyphicon glyphicon-ok form-control-feedback'></span>");
            return true;
        }
    }
}

