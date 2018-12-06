var Form = {

	pseudo: document.getElementById("pseudo"),
	password: document.getElementById("password"),
 	email: document.getElementById("email"),
 	connexionButton: document.querySelector("#connexionButton"),
  	pseudoHelp: document.getElementById("pseudoHelp"),
	passwordHelp: document.getElementById("passwordHelp"),
	emailHelp: document.getElementById("emailHelp"),
	textMinLength: "Faible",
	textLength: "Correct",

 	init: function(){
		
 		this.pseudoControl();
 		this.passwordControl();
 		this.emailControl();

 	},

 	pseudoControl: function(){

 		Form.pseudo.addEventListener("input", function(e){

 			var pseudoTarget = e.target.value;
 			

 			if(pseudoTarget.length >= 6){

 				Form.pseudoHelp.textContent = "Longueur : " + Form.textLength;
 				Form.pseudoHelp.style.color = "green";

 			}else{

 				Form.pseudoHelp.textContent = "Longueur : " + Form.textMinLength;
 				Form.pseudoHelp.style.color = "red";
 			}
 		});

 	},

 	passwordControl: function(){

 		Form.password.addEventListener("input", function(e){

 			var passwordTarget = e.target.value;
 		

 			if(passwordTarget.length >= 8){

 				Form.passwordHelp.textContent = "Longueur : " + Form.textLength;
 				Form.passwordHelp.style.color = "green";

 			}else{

 				Form.passwordHelp.textContent = "Longueur : " + Form.textMinLength;
 				Form.passwordHelp.style.color = "red";
 			}
 		});
 	},

 	emailControl: function(){

 		Form.email.addEventListener("input", function(e){

 			var regexPassword = /.+@.+\..+/;
 		

 			if(regexPassword.test(e.target.value)){

 				Form.emailHelp.textContent = "Adresse valide";
 				Form.emailHelp.style.color = "green";

 			}else{

 				Form.emailHelp.textContent = "Adresse non valide";
 				Form.emailHelp.style.color = "red";

 			}
 		});

 	}

}

Form.init();
