
document.getElementById("signup-form").addEventListener("submit", function(event) {
    let campoEmail = document.getElementById("email").value.trim(); // Elimina espacios en blanco
    let campoPassword = document.getElementById("password").value.trim();

    if (campoEmail === '' || campoPassword === '') {
        event.preventDefault(); // Evita el envío del formulario

        // Muestra un mensaje de error en un elemento HTML con el id "error-message"
        let errorMessage = document.getElementById("error-message");
        errorMessage.textContent = "Por favor, complete todos los campos.";

        // También puedes agregar estilos CSS para resaltar el mensaje de error
        errorMessage.style.color = "red";
    }
});


//AUN FALTA NO ESTA FUNCIONANADO AUN FALTA INCRETAR ...



