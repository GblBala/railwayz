// Troisième bloc de code
const container = document.getElementById('container');
const loginBtn = document.getElementById('login');
const registerBtn = document.getElementById('register');

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});