function changepass(){document.getElementById("passwordfield").innerHTML='<input class="required validate-password" type="password" id="password" name="password" size="40" value="" onblur="passvalidate(); changefield();" style="color:#000000;" />';document.getElementById("password").focus()}
function changefield(){""==document.getElementById("password").value&&(document.getElementById("passwordfield").innerHTML='<input type="text" name="password" id="password" value="Password" onfocus="changepass();" />')}
function changeconfirmpass(){document.getElementById("confirmfield").innerHTML='<input class="required validate-passverify" type="password" id="password2" equalTo="#password" name="password2" size="40" value="" onblur="confirmvalidate(); changeconfirm();" style="color:#000000;" />';document.getElementById("password2").focus()}
function changeconfirm(){""==document.getElementById("password2").value&&(document.getElementById("confirmfield").innerHTML='<input type="text" name="confirmpassword" id="confirmpassword" value="Confirm Password" onfocus="changeconfirmpass();" />')}function passvalidate(){passwordvalue=document.getElementById("password").value;if("Password"==document.getElementById("password").value)return $("#login_error").append("Enter Password"),!1}
function onFocusEvent(a,b){a.value==b&&("Password"==a.value&&(a.type="password"),a.value="",a.style.color="#000000",a.style.fontWeight="normal")}function onFocusMenu(a,b){a.value==b&&(a.value="",a.style.color="#000000",a.style.fontWeight="normal")}
function onInviteFriends(a,b){a.value==b&&("Email Address 1"==a.value?(a.value="",a.style.color="#000000",a.style.fontWeight="normal"):"Email Address 2"==a.value?(a.value="",a.style.color="#000000",a.style.fontWeight="normal"):"Email Address 3"==a.value?(a.value="",a.style.color="#000000",a.style.fontWeight="normal"):"Email Address 4"==a.value?(a.value="",a.style.color="#000000",a.style.fontWeight="normal"):"Add Personal Note (Optional)"==a.value&&(a.value="",a.style.color="#000000",a.style.fontWeight=
"normal"))}function onBlurEvent(a,b){""==a.value&&(a.value=b,a.style.color="#C9C8C8",a.style.fontWeight="normal")};