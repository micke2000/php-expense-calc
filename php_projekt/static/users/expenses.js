const nav = document.querySelector('div.nav')
const backButton = document.querySelector("button.back");
const nav_slide = document.querySelector('div.nav_slide')
const username = document.querySelector('h1 strong.username')
const logoutBtn = document.querySelector('h2.logout')
const addBtn = document.querySelector('button.add')
const wrapper = document.querySelector("div.wrapper");
const expEdition = document.querySelector('div.exp-edit')
const cancelEditBut = expEdition.querySelector('button.cancel')
const form = expEdition.querySelector('form');
const category = document.getElementById("category");
const amount = document.getElementById("amount");
const name = document.getElementById("name");
const expenseId = document.getElementById('expenseId')
form.addEventListener("submit", function (e) {
    name.parentNode.querySelector("p.error_message").textContent = "";
    amount.parentNode.querySelector("p.error_message").textContent = "";
    let errors = [];
    if (name.value === "" | name.value == null) {
        errors.push('name');
        name.parentNode.querySelector("p.error_message").textContent = "Cannot be empty!";
    }
    if (amount.value === "" | amount.value == null | (! RegExp("^[0-9]+.[0-9]+$").test(amount.value))) {
        errors.push('amount');
        amount.parentNode.querySelector("p.error_message").textContent = "Must be number!";
    }
    if (errors.length > 0) {
        e.preventDefault();
    }
});
cancelEditBut.addEventListener('click',function(){
    expEdition.classList.add('off')
})
nav.addEventListener('click', function () {
    nav.classList.toggle('on')
    nav_slide.classList.toggle('off')
})
backButton.addEventListener("click",function(e){
    wrapper.classList.add('exit')
    setTimeout(function(){
        window.location.href = './login.php';
    },1100);
    
});
var oReq = new XMLHttpRequest();
oReq.onload = function () {
    const expenses = document.querySelector('div.wrapper div.expenses')
    const allExepenses = JSON.parse(this.responseText)
    allExepenses.forEach(exp => {
        let clone = document.querySelector('div.wrapper div.expenses div.expense').cloneNode("true")
        clone.dataset.id = exp[0]
        clone.querySelectorAll("i").forEach(i => {
            i.addEventListener('click', function () {
                if (i.classList.contains("edit")) {
                    expEdition.classList.remove('off')
                    name.value = exp[1]
                    amount.value = exp[2]
                    category.value = exp[3]
                    expenseId.value = exp[0]
                } else if (i.classList.contains("delete")) {
                    window.location.search += `&id=${clone.dataset.id}`;
                }
            })
        });
        clone.classList.add("visible")
        clone.children[0].textContent = exp[1]
        clone.children[1].children[0].textContent = exp[2]
        expenses.appendChild(clone)
    });

};
oReq.open("get", "./user_expenses.php", true);
oReq.send();