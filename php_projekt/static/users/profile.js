const nav = document.querySelector('div.nav')
const nav_slide = document.querySelector('div.nav_slide')
const username = document.querySelector('h1 strong.username')
const totalMonthExpenses = document.querySelector('h2.money strong')
const logoutBtn = document.querySelector('h2.logout')
const addBtn = document.querySelector('button.add')
const overBtn = document.querySelector('button.overview')
nav.addEventListener('click', function () {
    nav.classList.toggle('on')
    nav_slide.classList.toggle('off')
})
// const logout_nav = document.querySelector('div.nav_slide h2.logout')
// logout_nav.addEventListener('click', function () {
//     window.location.href = 'login_form.html';
// })
function reqListener() {
    console.log(this.responseText);
}
logoutBtn.addEventListener('click',function(){
    window.location.href = './logout.php'; 
});
addBtn.addEventListener('click',function(){
    window.location.href = 'add_exp.php';
});
overBtn.addEventListener('click',function(){
    window.location.href = 'overwiev.php';
});
var oReq = new XMLHttpRequest();
oReq.onload = function () {
    const data = JSON.parse(this.responseText)
    username.textContent = data.username;
    console.log(data)
    totalMonthExpenses.textContent = data.totalMonthExpenses
};
oReq.open("get", "./userdata.php", true);
oReq.send();