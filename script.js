// Seleccionar los elementos relevantes del DOM
const menuBtn = document.getElementById("menu-btn");
const navLinks = document.getElementById("nav-links");
const menuBtnIcon = menuBtn ? menuBtn.querySelector("i") : null; // Asegurarse de que existe

const inputs = document.querySelectorAll(".input-field");
const toggleBtn = document.querySelectorAll(".toggle");
const main = document.querySelector("main");
const bullets = document.querySelectorAll(".bullets span");
const images = document.querySelectorAll(".image");

// Función para manejar el enfoque y desenfoque de los campos de entrada
inputs.forEach((input) => {
  input.addEventListener("focus", () => {
    input.classList.add("active");
  });

  input.addEventListener("blur", () => {
    if (input.value !== "") return;
    input.classList.remove("active");
  });
});

// Función para alternar entre el formulario de inicio de sesión y el de registro
toggleBtn.forEach((btn) => {
  btn.addEventListener("click", () => {
    main.classList.toggle("sign-up-mode");
  });
});

// Función para mover el slider
function moveSlider() {
  const index = this.dataset.value;

  // Cambiar la imagen activa en el slider
  const currentImage = document.querySelector(`.img-${index}`);
  images.forEach((img) => img.classList.remove("show"));
  currentImage.classList.add("show");

  // Mover el texto del slider
  const textSlider = document.querySelector(".text-group");
  textSlider.style.transform = `translateY(${-(index - 1) * 2.2}rem)`;

  // Cambiar la clase 'active' del bullet
  bullets.forEach((bull) => bull.classList.remove("active"));
  this.classList.add("active");
}

// Agregar el evento click para mover el slider
bullets.forEach((bullet) => {
  bullet.addEventListener("click", moveSlider);
});

// Funcionalidad de la barra de hamburguesa (sin la "X")
if (menuBtn && menuBtnIcon) {
  menuBtn.addEventListener("click", () => {
    navLinks.classList.toggle("active"); // Alterna la clase 'active' en el menú
    // Solo se mantiene el icono de barras
    menuBtnIcon.setAttribute("class", "fas fa-bars"); // Siempre muestra las barras
  });

  // Cerrar el menú cuando se haga clic en un enlace
  navLinks.addEventListener("click", (event) => {
    if (event.target.tagName === "A") { // Verificar si se ha hecho clic en un enlace
      navLinks.classList.remove("active");
      // Volver a poner el icono de hamburguesa
      menuBtnIcon.setAttribute("class", "fas fa-bars"); // Siempre mantiene las barras
    }
  });
}
