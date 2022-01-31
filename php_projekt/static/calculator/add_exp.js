const backButton = document.querySelector("button.back");
const main = document.querySelector("div.wrapper main");
const nav = document.querySelector('div.nav')
const logoutBtn = document.querySelector('h2.logout')
const nav_slide = document.querySelector('div.nav_slide')
const h1 = document.querySelector("header h1");
const category = document.getElementById("category");
const amount = document.getElementById("amount");
const name = document.getElementById("name");
logoutBtn.addEventListener('click',function(){
    window.location.href = './logout.php'; 
});
nav.addEventListener('click', function () {
    nav.classList.toggle('on')
    nav_slide.classList.toggle('off')
})
backButton.addEventListener("click", function (e) {
    main.classList.add('exit');
    // h1.classList.add('exit');
    setTimeout(function () {
        window.location.href = './login.php';
    }, 1100);

});
const form = document.querySelector('main form');
form.addEventListener("submit", function (e) {
    name.parentNode.querySelector("p.error_message").textContent = "";
    amount.parentNode.querySelector("p.error_message").textContent = "";
    let errors = [];
    if (name.value === "" | name.value == null | (! RegExp("^[a-zA-Z0-9_.-]*$").test(name.value))) {
        errors.push('name');
        name.parentNode.querySelector("p.error_message").textContent = "Wrong name!";
    }
    if (amount.value === "" | amount.value == null | (! RegExp("^[0-9]+.[0-9]+$").test(amount.value))) {
        errors.push('amount');
        amount.parentNode.querySelector("p.error_message").textContent = "Must be number!";
    }
    if (errors.length > 0) {
        e.preventDefault();
    }
});