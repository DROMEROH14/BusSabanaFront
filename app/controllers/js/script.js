const registerLink = document.getElementById("register-link");
const loginLink = document.getElementById("login-link");
const loginForm = document.getElementById("login-form");
const registerForm = document.getElementById("register-form");
const formTitle = document.getElementById("form-title");

registerLink.addEventListener("click", () => {
    loginForm.classList.add("d-none");
    registerForm.classList.remove("d-none");
    formTitle.innerText = "Registrarse";
});

loginLink.addEventListener("click", () => {
    registerForm.classList.add("d-none");
    loginForm.classList.remove("d-none");
    formTitle.innerText = "Iniciar sesión";
});

loginForm.addEventListener("submit", (e) => {
    e.preventDefault(); 
    
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    const data = {
        email: email,
        password: password,
        action: "login"
    };

    fetch("../app/models/login.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data) 
    })
    .then(response => response.json()) 
    .then(data => {
        if (data.success) {
            if(data.userType == 1){
                window.location.href = "../app/views/dashboardA.php";
            }if(data.userType == 2){
                window.location.href = "../app/views/dashboard.php";
            } 
            
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error en el login',
                text: data.message
            });
            
        }
    })
    .catch(error => {
        alert("Hubo un error al procesar la solicitud: " + error); 
    });
});

registerForm.addEventListener("submit", (e) => {
    e.preventDefault(); 
    
    const email = document.getElementById("reg-email").value;
    const password = document.getElementById("reg-password").value;
    const passwordCon = document.getElementById("reg-confirm-password").value;
    const name = document.getElementById("name").value;
    const apellido = document.getElementById("apellido").value;

    if(password !== passwordCon){
        Swal.fire({
            icon: 'error',
            title: 'Las contraseñas no son iguales'
        });
        die();
    }

    const data = {
        email: email,
        password: password,
        passwordCon: passwordCon,
        name: name,
        apellido: apellido,
        action: "register"
    };

    fetch("../app/models/login.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data) 
    })
    .then(response => response.json()) 
    .then(data => {
        if (data.success) {
            window.location.href = "../app/views/dashboard.php"; 
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error en el login',
                text: data.message
            });
            
        }
    })
    .catch(error => {
        alert("Hubo un error al procesar la solicitud: " + error); 
    });
});
