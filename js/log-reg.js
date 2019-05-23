const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});

// registration 
let regBtn = document.getElementById('register');

regBtn.onclick = function(){
	let name = document.getElementById('userName').value,
		email = document.getElementById('userEmail').value,
		pass = document.getElementById('userPass').value,
		conPass = document.getElementById('userConfirmPass').value,
		form = document.getElementById('registerForm');

	let jsonData = JSON.stringify({
		"register":1,
		"userName": name,
		"userEmail": email,
		"userPass":pass,
		"userConfirmPass": conPass
	});

	if (window.XMLHttpRequest) {
		// code for modern browsers
		var xmlhttp = new XMLHttpRequest();
	 } else {
		// code for old IE browsers
		var xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
			var response = this.responseText;
			if( response.indexOf('success') > 0){
				form.reset();
			}
            document.getElementById("error").innerHTML = response;
       }
	};
	xmlhttp.open("POST", "inc/register.php",true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("data=" + jsonData);
	
}



// login
let loginBtn = document.getElementById('login');

loginBtn.onclick = function(){
	let 
		email = document.getElementById('userlogEmail').value,
		pass = document.getElementById('userlogPass').value,
		form = document.getElementById('loginForm');

	let jsonData = JSON.stringify({
		"login":1,
		"userlogEmail": email,
		"userlogPass":pass
	});

	if (window.XMLHttpRequest) {
		// code for modern browsers
		var xmlhttp = new XMLHttpRequest();
	 } else {
		// code for old IE browsers
		var xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
			var response = this.responseText;
			if( response.indexOf('success') > 0){
				form.reset();
			}
            document.getElementById("error").innerHTML = response;
       }
	};
	xmlhttp.open("POST", "inc/register.php",true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("data=" + jsonData);
	
}