
function validatePatient(id)
{
    let firstname = $("#firstname"+id).val();
    let lastname = $("#lastname"+id).val();
    let dob = $("#dob"+id).val();
    let phone = $("#phone"+id).val();
    let username = $("#username"+id).val();
    let email = $("#email"+id).val();
    let password = $('#password'+id).val();
    let confirm = $('#confirm_password'+id).val();
    let result = false;

    if(firstname == ""){
        $("#fmsg"+id).text("Firstname cannot be empty!");
        result = false;
    }else{
        $("#fmsg"+id).text('');
        result = true;
    }

    if(lastname == ""){
        $("#lmsg"+id).text("Lastname cannot be empty!");
        result = false;
    }else{
        $("#lmsg"+id).text('');
        result = true;
    }

    if(dob == ""){
        $("#dmsg"+id).text("Date of Birth cannot be empty!");
        result = false;
    }else{
        $("#dmsg"+id).text('');
        result = true;
    }

    if(username == ""){
        $("#umsg"+id).text("Username cannot be empty!");
        result = false;
    }else{
        $("#umsg"+id).text('');
        result = true;
    }

    if(email == ""){
        $("#emsg"+id).text("Email cannot be empty!");
        result = false;
    }else{
        $("#emsg"+id).text('');
        result = true;
    }

    if(phone == ""){
        $("#pmsg"+id).text("Phone Number cannot be empty!");
        result = false;
    }else if(phone.length != 10){
        $("#pmsg"+id).text("Phone Number Must be 10 Digit!");
        result = false;
    }else{
        $("#pmsg"+id).text('');
        result = true;
    }

    if( password != confirm){
        $(`#cmsg${id}`).text("Password and Confirm Password Mismatch");
        result = false;
    }else{
        $(`#cmsg${id}`).text('');
        result = true ;
    }

    return result;
}
