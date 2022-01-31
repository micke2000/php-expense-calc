const signUpButtons = document.querySelectorAll("div.button.signup");
const loginButtons = document.querySelectorAll("div.button.login");
const body = document.querySelector("body");
signUpButtons.forEach(function(button){
    button.addEventListener("click",function(){
        body.classList.add('exit');
        setTimeout(function(){
            window.location.href = './index.php';
        },1000);
        
    });
});
loginButtons.forEach(function(button){
    button.addEventListener("click",function(){
        body.classList.add('exit');
        setTimeout(function(){
            window.location.href = './processLogin.php';
        },1000);
    });
});

