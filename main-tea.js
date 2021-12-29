//function validateForm() {
//   var x = document.forms["form"]["email"].value;
//   var y = document.forms["form"]["username"].value;
//   var z = document.forms["form"]["pass1"].value;
//   var e = document.forms["form"]["pass2"].value;
//   var Maxlenght = 12;
//   var pass_len = pass1.value.length;
//   var mailformat = /^w+([.-]?w+)*@w+([.-]?w+)*(.w{2,3})+$/;
//   if (x == "")  {
//       alert("Необходимо ввести email");
//       return false;
//   }
// 
//   else if (y == "") {
//       alert("Vvedite login");
//       return false;
//   }
//   else if (z == "" )  {
//       alert("Vvedite parol");
//       return false;
//   }
//   else if (z.lenght > Maxlenght) {
//     alert("Maxlenght: " + Maxlenght);
//     return false;
//   } else if (z !== e) {
//     alert("Nesovpadajut paroli");
//     return false;
//   }
//
//}
function validateForm() {
    valid = true;
    if (document.contact_form.r_password.value != document.contact_form.r_password_check.value) {
        alert("You wrote the wrong confirm password.")
        valid = false;
    }
    return valid;
}
function validateForm2 () {
    var username = document.forms['form_login']['username'].value;
    var password = document.forms['form_login']['password'].value;

    if (username == "") {
        alert("You have to write login");
        return false;
    }
    else if (password == "") {
        alert("You have to write")
        return false;
    }
}

$(document).ready(function(){
    if (warnRaised == false){
        localStorage.setItem("review_area", "");
        localStorage.setItem("check1", "");
        localStorage.setItem("check2", "");
        localStorage.setItem("check5", "");
    }

    $("#review_area").val(getValue("review_area"));
    $("#check1").val(getValue("check1"));
    $("#check2").val(getValue("check2"));
    $("#check5").val(getValue("check5"));

    $("#review_area").keypress(function (e) {
        if ( $("#review_area").val() != "" ){
            if (e.which == 13 && !e.shiftKey) {
                $(this).closest("form").submit();
                e.preventDefault();
            }
        } else if (e.which == 13 && !e.shiftKey) {
            e.preventDefault();
        }
    });

    $("#review_area").keypress(function (e) {
        if (e.which == 13 && !e.shiftKey) {
            localStorage.setItem(e.id, "");
        } else {

        }
    });
    $("#check1").val(getValue("check1"));
    $("#check2").val(getValue("check2"));
    $("#check5").val(getValue("check5"));
});

function saveValue(e) {
    var id = e.id;
    var val = e.value;
    localStorage.setItem(id, val);
}

function getValue(v) {
    if (!localStorage.getItem(v)) {
        return "";
    }
    return localStorage.getItem(v);
}