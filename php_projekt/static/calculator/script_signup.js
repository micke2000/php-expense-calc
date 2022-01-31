const backButton = document.querySelector("button.back");
const main = document.querySelector("div.wrapper main");
const h1 = document.querySelector("header h1");
const email = document.getElementById("email");
const password = document.getElementById("password");
const username = document.getElementById("username");
    backButton.addEventListener("click",function(e){
        main.classList.add('exit');
        h1.classList.add('exit');
        setTimeout(function(){
            window.location.href = './home_page.php';
        },1100);
        
    });
const form = document.querySelector('main form');
form.addEventListener("submit",function(e){
    username.parentNode.querySelector("p.error_message").textContent = "";
    email.parentNode.querySelector("p.error_message").textContent = "";
    password.parentNode.querySelector("p.error_message").textContent = "";
    let errors = [];
    if(username.value === "" | username.value == null | (! RegExp("^[a-zA-Z0-9_.-]*$").test(username.value))){
        errors.push('username');
        username.parentNode.querySelector("p.error_message").textContent = "Wrong username!";
    }
    if(! RegExp("^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$").test(email.value)){
        errors.push('email');
        email.parentNode.querySelector("p.error_message").textContent = "Wrong email address!";
    }
    if(!(RegExp(".*[0-9]",'g').test(password.value) && RegExp(".*[a-zA-Z]",'g').test(password.value)&&RegExp(".{8,}",'g').test(password.value)) || (password.value == "" || password.value == null)){
        errors.push('password');
        password.parentNode.querySelector("p.error_message").textContent = "Wrong password!";
    }
    if(errors.length > 0){
        e.preventDefault();
    }
});
