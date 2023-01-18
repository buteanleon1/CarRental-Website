<?php
session_start();
if(isset($_SESSION['id']) && ($_SESSION['status']==1)){
	header("Location: ../main/");
}
$page_title = "Conectare";

include('../components/page_head.php');

?>

<body>
	<div class="uk-margin-xlarge-top	">
        <div class="container d-flex justify-content-center align-items-center">
            <form class="border-dark shadow p-3 mb-5 rounded"
                  action="none"
                  style="width: 450px">
                <h1 class="text-center p-2 mb-5 display-4"><strong>Conectare</strong></h1>
                
                <div class="uk-alert-danger uk-hidden" id="uk-error-alert" uk-alert>
				    <p>Numele de utilizator sau parola sunt incorecte.</p>
				</div>
               
                
                <div class="mb-3">
                  <label for="username" 
                         class="form-label">Utilizator</label>
                  <input type="text"
                         name="username"
                         class="form-control" 
                         id="username">
                </div>
                <div class="mb-3">
                  <label for="password" 
                         class="form-label">Parola</label>
                         <input type="password"
                         name="password"
                         class="form-control" 
                         id="password">
                </div>
                
                
                <div class="uk-clearfix">
                    <div class="uk-float-right">
                        <a href="../signup/" class="ca">Creaza un cont</a>
                    </div>
                    <div class="uk-float-left">
                        <button type="button" class="btn btn-primary" onclick="login_user();">Conectare</button>
                    </div>
                </div>   
              </form>
        </div>
        </div>
            
</body>

<script type="text/javascript">
//login function
function login_user(){
	var regexLetersNumbers = /^([a-zA-Z0-9]{4,})$/;
	
	var user_name = $("#username").val();
	var user_pass = $("#password").val();
	$("#uk-error-alert").addClass("uk-hidden");
	$("#uk-error-alert1").addClass("uk-hidden");
	
	if(!regexLetersNumbers.test(user_name)){
		UIkit.notification({message: 'Numele de utilizator nu poate contine caractere speciale', status: 'danger'})
		return;
	}
	//trimitere request la server
	$.ajax({
        url: 'actions/login_user.php',
        type:'POST',
      	data: {"user_name": user_name, "user_pass": user_pass},
      	success: function(data) {
      		//gestionare raspuns de la server
      		
        	if(data == "login: success-user"){
        		window.location.replace("../main/");
        	} else if(data == "login: success-admin"){
        		window.location.replace("../admin/");
        	} else if(data == "login: error"){
        		$("#uk-error-alert").toggleClass("uk-hidden");
        	}else if(data == "login: utilizator blocat"){
        		UIkit.notification({message: 'Acest utilizator a fost blocat!', status: 'danger'});
        	}else {
        		console.log(data);
        	}
      	}
    });
}

</script>
</html>