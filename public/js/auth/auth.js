function showPassword(el, id) {
    let x = document.getElementById(id);
    console.log(x);
    el.classList.toggle("fa-eye");
    el.classList.toggle("fa-eye-slash");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
