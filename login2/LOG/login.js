document.addEventListener('DOMContentLoaded', function() {
    const signupForm = document.querySelector('.form-container.sign-in form');

    signupForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const email = document.querySelector('.form-container.sign-in input[type="email"]').value;
        const password = document.querySelector('.form-container.sign-in input[type="password"]').value;

        fetch('signup.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `email=${email}&password=${password}`
        })
        .then(response => response.text())
        .then(data => {
            console.log(data); // Mostrar respuesta del servidor en la consola
            // Aquí puedes manejar la respuesta del servidor, por ejemplo, redirigir al usuario si el registro fue exitoso
            if (data === 'Registro exitoso') {
                window.location.href = 'login.html'; // Redirigir al login o a la página de registro exitoso
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});
