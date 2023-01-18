<?php
date_default_timezone_set("Europe/Athens");
session_start();
if(isset($_SESSION['id'])){
	header("Location: ../main/");
}

$page_title = "Inregistrare";

include('../components/page_head.php');

?>

<body>
        <div class="container d-flex justify-content-center align-items-center">
            <form class="border-dark shadow p-3 mb-5 rounded"
                  action="none"
                  style="width: 450px">
                <h1 class="text-center p-2 mb-5 display-4"><strong>Inregistrare</strong></h1>
                
                <!--<div class="uk-alert-danger uk-hidden" id="uk-error-alert" uk-alert>
				    <p>Numele de utilizator este luat, incercati alt nume!</p>
				</div>-->
				<div class="uk-alert-success uk-hidden" id="uk-success-alert" uk-alert>
				    <p>Contul dumneavoastra a fost creat cu succes!</p>
				</div>
                
                <div class="mb-3">
                
                    <label for="fullname" 
                         class="form-label">Nume si prenume</label>
                    
                        <input type="text"
                            name="fullname"
                            class="form-control"
                            id="fullname">
                        
                        <label for="CNP" 
                         class="form-label">CNP</label>
                    
                        <input type="text"
                            name="CNP"
                            class="form-control"
                            id="CNP">
                            
                           <label for="datan" 
                         class="form-label">Data nasterii</label>
		                  <input type="date"
		                         name="datan"
		                         class="form-control" 
		                         id="datan">

                        
                        <label for="address" 
                         class="form-label">Adresa(strada, oras, judet)</label>
                        <input type="text"
                            name="address"
                            class="form-control"
                            id="address">
                            
                            <label for="firstissued" 
                         class="form-label">Data primei emiteri a permisului</label>
                  <input type="date"
                         name="firstissued"
                         class="form-control" 
                         id="firstissued">
                    
 
                  <label for="issued" 
                         class="form-label">Data emitere permis</label>
                  <input type="date"
                         name="issued"
                         class="form-control" 
                         id="issued">
                  
                  <label for="expires" 
                         class="form-label">Data expirare permis</label>
                  <input type="date"
                         name="expires"
                         class="form-control" 
                         id="expires">
                  
                   <label for="username" 
                         class="form-label">Nume utilizator</label>
                        <input type="text"
                            name="username"
                            class="form-control"
                            
                            id="username">
                   

                  <label for="password" 
                         class="form-label">Parola</label>
                         <input type="password"
                         name="password"
                         class="form-control" 
                         id="password">
                         
                  <label for="re_password" 
                         class="form-label">Confirmare parola</label>
                   <input type="password"
                         name="re_password"
                         class="form-control" 
                         id="re_password">
                </div>
                 <div class="mb-1">
                    <p hidden> <label for="password" class="form-label">User type:</label></p>
                </div>
                <p hidden><select class="form-select mb-3" 
                        name="role"
                        aria-label="Default select example">
                    <option selected value="user">User</option>
<!--                    <option value="admin">Admin</option>-->
                </select></p>
                <div class="uk-clearfix">
                    <div class="uk-float-right">
                        <a href="../login" class="ca">Ai deja un cont?</a>
                    </div>
                    <div class="uk-float-left">
                        <button type="button" class="btn btn-primary" onclick="signup_user();">Inregistrare</button>
                    </div>
                </div>
              </form>
        </div>
            
    </body>

<script type="text/javascript">
	//signup function
function signup_user(){
	var fullname = $("#fullname").val();
	var CNP = $("#CNP").val();
	var datan = (new Date($("#datan").val())).getTime() / 1000;
	var address = $("#address").val();
	var firstissued = (new Date($("#firstissued").val())).getTime() / 1000;
	var issued = (new Date($("#issued").val())).getTime() / 1000;
	var expires = (new Date($("#expires").val())).getTime() / 1000;
	var username = $("#username").val();
	var password = $("#password").val();
	var re_password = $("#re_password").val();
	$("#uk-error-alert").addClass("uk-hidden");
	$("#uk-success-alert").addClass("uk-hidden");
	
	var current_timestamp = Math.floor(Date.now() / 1000);
	
	//validari	
	var regexLetersNumbers = /^([a-zA-Z0-9]{4,})$/;
	var regularExpression = /^[a-zA-Z0-9!@#\$%\^\&*\)\(+=._-]{4,}$/g;
	var regexcnp = /^[0-9]*$/;
	var regexlettersandspaces = /^[A-Za-z\s]+$/;
	
	if(!regexlettersandspaces.test(fullname)){
		UIkit.notification({message: 'Numele si prenumele trebuie sa contina impreuna minim 6 caractere', status: 'danger'})
		return;
	}
	if(CNP.length != 13){
		UIkit.notification({message: 'Codul numeric personal nu are 13 caractere', status: 'danger'})
		return;
	}
	if(!regexcnp.test(CNP)){
		UIkit.notification({message: 'Codul numeric personal nu poate sa contina litere sau caractere speciale', status: 'danger'})
		return;
	}
	if((CNP.toString().charAt(0) == '1') || (CNP.toString().charAt(0) == '2') || (CNP.toString().charAt(0) == '5') || (CNP.toString().charAt(0) == '6')){
		
		
	}else{
		UIkit.notification({message: 'Cod numeric personal invalid', status: 'danger'})
		return;
	}
	if(current_timestamp - datan >= 31556926*65){
		UIkit.notification({message: 'Trebuie sa sub 65 de ani pentru a avea un cont si pentru a putea inchiria', status: 'danger'})
		return;
	}
	if(address.length < 10){
		UIkit.notification({message: 'Adresa are prea putine caractere, exemplu adresa: strada,nr., oras, judet, tara', status: 'danger'})
		return;
	}
	if(address.length < 10){
		UIkit.notification({message: 'Adresa are prea putine caractere, exemplu adresa: strada,nr., oras, judet, tara', status: 'danger'})
		return;
	}
	if(current_timestamp-firstissued <= 31556926*3){
		UIkit.notification({message: 'Trebuie sa ai minim 3 ani de experiata pentru a avea un cont si pentru a inchiria', status: 'danger'})
		return;
	}
	if(issued >= expires){
		UIkit.notification({message: 'Data emitere/expirare permis invalida', status: 'danger'})
		return;
	}
	//data emitere =>3 ani si data emitere <=65
	if(!regexLetersNumbers.test(username)){
		UIkit.notification({message: 'Numele de utilizator nu poate contine caractere speciale si trebuie sa contina minim 4 caractere', status: 'danger'})
		return;
	}
	if(!regularExpression.test(password)){
		UIkit.notification({message: 'Parola trebuie sa contina minim 4 caractere', status: 'danger'})
		return;
	}
	if(password != re_password){
		UIkit.notification({message: 'Parolele nu se potrivesc. Încercați din nou.', status: 'danger'})
		return;
	}
	
	
	//trimitere request la server
	$.ajax({
        url: 'actions/signup_user.php',
        type:'POST',
      	data: {"fullname": fullname, "CNP": CNP, "datan": datan, "address": address, "firstissued": firstissued, "issued": issued, "expires": expires, "username": username, "password": password},
      	success: function(data) {
      		//gestionare raspuns de la server
      		
        	if(data == "signup: success"){
        		$("#uk-success-alert").toggleClass("uk-hidden");
        		setTimeout(function(){ 
        			window.location.replace("../login/"); 
        		}, 2000);
        	} else if(data == "signup: error_already"){
        		UIkit.notification({message: 'Numele de utilizator este luat, incercati alt nume!', status: 'danger'})
        	}else if(data == "signup: CNPerror_already"){
        		UIkit.notification({message: 'Exista deja un cont facut pe acest CNP!', status: 'danger'})
        	} else {
        		console.log(data);
        	}
      	}
    });
}
</script>
</html>