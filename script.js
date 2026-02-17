let currentStep = 0;
const steps = document.querySelectorAll(".step");
const progressBar = document.getElementById("progressBar");
const review = document.getElementById("review");

function showStep() { //muestra los steps
  steps.forEach((s, i) => {
    s.classList.toggle("active", i === currentStep); //solo deja en "active" el actual (los otros se mantienen ocultos)
  });

  progressBar.style.width = `${(currentStep + 1) / steps.length * 100}%`; //Calcula el % del progreso de la barra

  // Último step = rellenar review
  if (currentStep === steps.length - 1) { //si llega al ultimo step, crea el resumen
    mostrarDatos();
  }

}


const nombre = document.querySelector('[name="nombre"]');
const apellido1 = document.querySelector('[name="apellido1"]');
const apellido2 = document.querySelector('[name="apellido2"]');
const email = document.querySelector('[name="email"]');
const edad = document.querySelector('[name="edad"]');
const formacionInput = document.getElementById('formacionInput');
const habilidadesInput = document.getElementById('habilidadesInput');
const idiomasInput = document.getElementById('idiomasInput');

nombre.addEventListener("input", function () {
  this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ]/g, "");
});

apellido1.addEventListener("input", function () {
  this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ]/g, "");
});

apellido2.addEventListener("input", function () {
  this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ]/g, "");
});

formacionInput.addEventListener("input", function () {
  this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ]/g, "");
});

habilidadesInput.addEventListener("input", function () {
  this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ]/g, "");
});

idiomasInput.addEventListener("input", function () {
  this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ]/g, "");
});

//Comprueba que el step cumpla las condiciones
function validateStep(stepIndex) {

  // Step 0 = Datos personales
  if (stepIndex === 0) {


    if (!nombre.value.trim() || !apellido1.value.trim() || !email.value.trim() || !edad.value.trim()) { //si los campos no estan completos salta la alerta
      alert("Por favor, rellena todos los campos obligatorios");
      return false;
    }

    if (!validarEmail(email.value)) { //si el email es invalido, salta la alerta
      alert("Por favor, Introduzca un correo electronico valido");
      return false;
    }
    if (edad.value < 16 || edad.value > 100) { //si la edad es invalida, salta la alerta
      alert("Por favor, Introduzca una edad valida");
      return false;
    }
  }

  // Step 1 = Experiencia y formación
  if (stepIndex === 1) {
    const experiencia = document.querySelector('[name="descripcion"]');
    const formacion = document.querySelectorAll("#listaFormacion li");

    if (!experiencia.value.trim()) { //si la experiencia no esta completos salta la alerta
      alert("Describe tu experiencia laboral");
      return false;
    }

    if (formacion.length === 0) { //si la formación no esta completos salta la alerta
      alert("Añade al menos una formación académica");
      return false;
    }
  }

  // Step 2 = Habilidades e idiomas
  if (stepIndex === 2) {
    const habilidades = document.querySelectorAll("#listaHabilidades li");
    const idiomas = document.querySelectorAll("#listaIdiomas li");

    if (habilidades.length === 0) { //si las habilidades no estan completos salta la alerta
      alert("Añade al menos una habilidad");
      return false;
    }

    if (idiomas.length === 0) { //si los idiomas no estan completos salta la alerta
      alert("Añade al menos un idioma");
      return false;
    }
  }

  return true; //si todo esta bien, devuelve true
}


function nextStep() {

  if (!validateStep(currentStep)) return; //valida el siguiente step (en caso de que no lo sea, hace un return)

  if (currentStep < steps.length - 1) { //Una vez validado avanza al siguiente step
    currentStep++;
    showStep();
  }
}

function prevStep() {//retrocede al step anterior
  if (currentStep > 0) {
    currentStep--;
    showStep();
  }
}



function mostrarDatos() { //rellena el mostrar datos del final
  const data = {
    "Nombre": document.querySelector('[name="nombre"]').value,
    "Apellido 1": document.querySelector('[name="apellido1"]').value,
    "Apellido 2": document.querySelector('[name="apellido2"]').value,
    "Email": document.querySelector('[name="email"]').value,
    "Edad": document.querySelector('[name="edad"]').value,
    "Experiencia laboral": document.querySelector('[name="descripcion"]').value,
    "Formación académica": getListValues("listaFormacion"),
    "Habilidades": getListValues("listaHabilidades"),
    "Idiomas": getListValues("listaIdiomas")
  };

  review.innerHTML = Object.entries(data).map(([key, value]) => `<div><strong>${key}:</strong> ${value || "—"}</div>`).join(""); //convierte el objeto en html
}


//conecta el imput con la <ol>
function initChips(inputId, chipsContainerId) {
  const input = document.getElementById(inputId);
  const chipsContainer = document.getElementById(chipsContainerId);
  //
  input.addEventListener("keydown", (e) => {
    if (e.key === "Enter" && input.value.trim() !== "") { //se ejecuta cuaddo se pulsa el enter y el input no esta vacio
      e.preventDefault(); //evita que al darle al enter se envie el formulario
      createChip(input.value.trim(), chipsContainer); //llama a createChip y le pasa el texto del input por parametros
      input.value = ""; //vacia los campos
    }
  });
}


//crea los chips
function createChip(text, container) {
  const chip = document.createElement("li");
  chip.className = "chip";
  //inserta los chips en el html
  chip.innerHTML = `
        ${text}
        <button type="button">×</button>
    `;

  chip.querySelector("button").addEventListener("click", () => { //si le da al boton de x , se elimina el chip
    chip.remove();
  });

  container.appendChild(chip);//se agrega a la <ol>
}

// Inicializamos cada sección
initChips("formacionInput", "listaFormacion");
initChips("habilidadesInput", "listaHabilidades");
initChips("idiomasInput", "listaIdiomas");
/**
 * document.querySelectorAll = devuelve un NodeList con todos los <li> de la lista con el id introducido por parametros
 *  ... = convierte el NodeList en un array
 * map= elimina los espacios en la array
 * join = une todos separandolos con "," 
 */
function getListValues(listId) {
  return [...document.querySelectorAll(`#${listId} li`)].map(li => li.textContent.trim()).join(", ");
}


function validarEmail(email) {
  // Expresión regular para validar un correo electrónico
  const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
  return regex.test(email);
}


//guarda los chips antes de enviarlos
document.querySelector('form').addEventListener('submit', () => {
  document.getElementById('formacionesHidden').value = getListValues("listaFormacion");
  document.getElementById('habilidadesHidden').value = getListValues("listaHabilidades");
  document.getElementById('idiomasHidden').value = getListValues("listaIdiomas");
});

//carga la foto

const cargar_foto = document.getElementById('cargarFoto');
const avatar = document.querySelector('.avatar');

cargar_foto.addEventListener('change', function () {
  const file = this.files[0]; // Tomamos el primer archivo (solo se puede elegir uno, pero viene como array)
  if (file) {
    const reader = new FileReader(); //Api del navegador, que lee archivos
    reader.onload = function (e) { //( onload = se ejecuta cuadno el archivo esta cargado)
      avatar.innerHTML = `<img src="${e.target.result}" alt="Preview" style="width:100px; height:100px; object-fit:cover; border-radius:50%;">`; //reescribe el html con la nueva imagen
    }
    reader.readAsDataURL(file); //lee el archivo (imagen)
  } else { //si no selecciono ningun archivo, se edita el html poniendo "No Preview"
    avatar.innerHTML = "No Preview";
  }
});

document.getElementById("formulario").addEventListener("keydown", function (event) {
  if (event.key === "Enter") {
    event.preventDefault();
  }
})

showStep(); //muestra el primer step