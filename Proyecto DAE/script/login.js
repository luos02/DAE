function log(){    
    var user;
    var pass;
    

    user = document.getElementById("user").value;
    pass = document.getElementById("pass").value;

    if(user == "admin" && pass == "1234"){
        window.location = "Select.html";
    }else{
        alert("Usuario no valido");
    }

}