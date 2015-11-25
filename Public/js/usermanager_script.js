/* 
* @Author: anchen
* @Date:   2015-11-23 00:48:34
* @Last Modified by:   anchen
* @Last Modified time: 2015-11-25 21:49:53
*/

'use strict';

function redirect()
{
    $("#BgDiv").css({ display:"block",height:$(document).height()});
    var yscroll=document.documentElement.scrollTop;
    $("#DialogDiv").css("top","300px");
    $("#DialogDiv").css("display","block");
    document.documentElement.scrollTop=0;

    var password=$("#password").val();
    var userid=$("#userid").val();
    var repassword=$("#repassword").val();
    var amount=$("#Amount").val();
    var currenttype=$("#Currency_Type").val();
    var gatewaytype=$("#Gateway_Type").val();
    var comments=$("#comments").val();
	var url = "/pay/index.php/Home/Recharge/redirect"

    var redirect_url = url+"?userid="+userid+"&password="+password+"&repassword="+
        repassword+"&currenttype="+currenttype+"&gatewaytype="+gatewaytype+"&comments="+
        comments+"&amount="+amount;

    window.open(redirect_url,'target');
}

function close_dig()
{
    $("#BgDiv").css("display","none");
    $("#DialogDiv").css("display","none");
    $("#password").val("");
    $("#repassword").val("");
    $("#Amount").val("");
    $("#comments").val("");

}

function submit_bindBankCard()
{
    var url = "/pay/index.php/Home/Recharge/bindBankCardOper";

    var request = {
        bank : $("#bank").val(),
        bankCardNum : $("#bankCardNum").val(),
        password : $("#password").val(),
        repassword : $("#repassword").val()
    };

    $.ajax({
            type: 'POST',
            data:  request,
            dataType: "json",
            url: url,
            contentType: "application/x-www-form-urlencoded; charset=utf-8",
            success: submit_bindBankCard_success
        });
}

function submit_bindBankCard_success(data)
{
    $("#bindBank_result").html(data);
    $("#bank").val("中国工商银行");
    $("#password").val("");
    $("#repassword").val("");
    $("#bankCardNum").val("");
}


function submit_drawdeposit()
{
    var url = "/pay/index.php/Home/Recharge/drawDepositOper";

    var request = {
        amount : $("#amount").val(),
        password : $("#password").val(),
        repassword : $("#repassword").val()
    };

    $.ajax({
            type: 'POST',
            data:  request,
            dataType: "json",
            url: url,
            contentType: "application/x-www-form-urlencoded; charset=utf-8",
            success: submit_drawdeposit_success
        });
}

function submit_drawdeposit_success(data)
{
    $("#drawdeposit_result").html(data);
}