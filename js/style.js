document.getElementById("signup-form").addEventListener("submit", function(event) {
 
event.preventDefault();
let formData = new FormData(this);

   
if (formData.get("email").trim() === '' || formData.get("password").trim() === '') {
        
    let errorMessage = document.getElementById("error-message");
    errorMessage.textContent = "Por favor, complete todos los campos.";

 
    errorMessage.style.color = "red";
} else {
    
    this.submit();
}
});








//AUN FALTA NO ESTA FUNCIONANADO AUN FALTA INCRETAR ...



 