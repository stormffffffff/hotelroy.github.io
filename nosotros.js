// Animación al hacer scroll
const animarElementos = document.querySelectorAll('.animar');

const observer = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible');
    }
  });
}, {
  threshold: 0.1
});

animarElementos.forEach(el => observer.observe(el));

// Navegación activa
const enlaces = document.querySelectorAll("nav a");

enlaces.forEach(enlace => {
  enlace.addEventListener("click", function () {
    enlaces.forEach(e => e.classList.remove("activo"));
    this.classList.add("activo");
  });
});
