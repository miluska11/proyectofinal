// Buscar el botón con el id "flecha"
const boton = document.getElementById("flecha");

// Buscar el elemento de navegación con el id "navigation"
const nav = document.getElementById("navigation");

// Agregar un evento click al botón
boton.addEventListener("click", aparecer);

// Función para mostrar u ocultar el menú
function aparecer() {
    // Toggle (agregar o quitar) la clase "hidden" en el elemento de navegación
    nav.classList.toggle("hidden");
}
