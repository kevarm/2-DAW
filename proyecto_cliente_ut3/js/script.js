// Elementos clave
const noteForm = document.getElementById('note-form');
const noteInput = document.getElementById('note-input');
const noteDate = document.getElementById('note-date');
const noteTime = document.getElementById('note-time');
const notesContainer = document.getElementById('notes-container');
const pendingTasksElement = document.getElementById('pending-tasks');
const completedTasksElement = document.getElementById('completed-tasks');

// Cargar notas al inicio
document.addEventListener('DOMContentLoaded', () => {
  loadNotes();
  updateTaskCounters();
  checkDeadlines();
  setInterval(checkDeadlines, 1000); // Revisión cada segundo
});

// Manejar el envío del formulario
noteForm.addEventListener('submit', function (e) {
  e.preventDefault();

  const noteText = noteInput.value.trim();
  const deadlineDate = noteDate.value;
  const deadlineTime = noteTime.value;

  // Verificar si la fecha seleccionada es posterior a la actual
  const currentDateTime = new Date();
  const selectedDateTime = new Date(`${deadlineDate}T${deadlineTime}:00`);

  if (noteText && deadlineDate && deadlineTime) {
    if (selectedDateTime < currentDateTime) {
      alert("Error: la fecha establecida es anterior a la actual.");
      return; // No continuar si la fecha es inválida
    }

    const deadline = `${deadlineDate}T${deadlineTime}:00`; // Formato ISO 8601
    addNoteToDOM(noteText, deadline);
    saveNoteToStorage(noteText, deadline);
    noteInput.value = '';
    noteDate.value = '';
    noteTime.value = '';
    
    // Asegurarse de que se actualice el contador de tareas pendientes al crear una tarea
    updateTaskCounters();
  }
});

// Cargar notas desde Local Storage
function loadNotes() {
  const notes = getNotesFromStorage();
  notes.forEach(note => addNoteToDOM(note.text, note.deadline, note.completed));
}

// Agregar una nota al DOM
function addNoteToDOM(text, deadline, completed = false) {
  const note = document.createElement('div');
  note.className = 'note';
  
  // Contenido de la nota
  note.innerHTML = `
    <p>${text}</p>
    <p class="deadline">Fecha límite: ${new Date(deadline).toLocaleString()}</p>
    <button class="complete-btn">${completed ? "Tarea finalizada" : "Marcar como finalizada"}</button>
    <button class="delete-btn" ${completed ? 'disabled' : ''}>Eliminar</button>
  `;

  // Añadir eventos a los botones de la nota
  note.querySelector('.complete-btn').addEventListener('click', () => toggleTaskCompletion(note, text, deadline));
  note.querySelector('.delete-btn').addEventListener('click', () => deleteNote(note, text, deadline));

  // Si la tarea está completada, la marca como finalizada
  if (completed) {
    note.classList.add('completed');
  }

  notesContainer.appendChild(note);
}

// Guardar una nota en Local Storage
function saveNoteToStorage(text, deadline, completed = false) {
  const notes = getNotesFromStorage();
  notes.push({ text, deadline, completed });
  localStorage.setItem('notes', JSON.stringify(notes));
}

// Obtener notas desde Local Storage
function getNotesFromStorage() {
  return JSON.parse(localStorage.getItem('notes')) || [];
}

// Eliminar una nota
function deleteNote(note, text, deadline) {
  if (note.classList.contains('completed')) {
    alert("No se puede eliminar una tarea finalizada.");
    return; // No eliminar si la tarea está finalizada
  }

  const notes = getNotesFromStorage();
  const updatedNotes = notes.filter(n => n.text !== text || n.deadline !== deadline);
  localStorage.setItem('notes', JSON.stringify(updatedNotes));

  notesContainer.removeChild(note);
  updateTaskCounters();
}

// Marcar tarea como finalizada
function toggleTaskCompletion(note, text, deadline) {
  note.classList.toggle('completed');
  const notes = getNotesFromStorage();
  const updatedNotes = notes.map(n => {
    if (n.text === text && n.deadline === deadline) {
      n.completed = !n.completed;  // Cambiar el estado de "completado"
    }
    return n;
  });
  localStorage.setItem('notes', JSON.stringify(updatedNotes));
  updateTaskCounters(); // Actualiza el contador de tareas pendientes y finalizadas
}

// Actualizar los contadores de tareas
function updateTaskCounters() {
  const notes = getNotesFromStorage();
  const pendingTasks = notes.filter(note => !note.completed).length;
  const completedTasks = notes.filter(note => note.completed).length;

  pendingTasksElement.textContent = pendingTasks;
  completedTasksElement.textContent = completedTasks;
}

// Revisar las fechas límite
function checkDeadlines() {
  const now = new Date();
  const notes = getNotesFromStorage();

  notes.forEach(note => {
    const deadline = new Date(note.deadline);
    if (now >= deadline && !note.completed) {
      showModal(`¡Tarea urgente: ${note.text}!`);
      // Eliminar la nota después de mostrar el recordatorio
      const updatedNotes = notes.filter(n => n.deadline !== note.deadline);
      localStorage.setItem('notes', JSON.stringify(updatedNotes));
      loadNotes(); // Recargar las notas en el DOM
    }
  });
}

// Mostrar el modal de tareas urgentes
function showModal(message) {
  alert(message); // Usando una alerta para el ejemplo, pero puede ser un modal personalizado
}


// Obtener los elementos del DOM
const loginForm = document.getElementById('login-form');
const createAccountBtn = document.getElementById('create-account-btn');
const usernameInput = document.getElementById('username');
const passwordInput = document.getElementById('password');
const errorMessage = document.getElementById('error-message');
const appSection = document.getElementById('app-section');
const loginSection = document.getElementById('login-section');

// Función para validar si el usuario existe
function validateUser(username, password) {
    const users = JSON.parse(localStorage.getItem('users')) || [];
    return users.some(user => user.username === username && user.password === password);
}

// Manejo de la creación de nuevo usuario
createAccountBtn.addEventListener('click', () => {
    const username = prompt('Introduce el nombre de usuario:');
    const password = prompt('Introduce la contraseña:');

    // Verificar que el usuario no exista
    const users = JSON.parse(localStorage.getItem('users')) || [];
    if (users.some(user => user.username === username)) {
        alert('Este nombre de usuario ya existe.');
    } else {
        // Crear un nuevo usuario y guardarlo en localStorage
        users.push({ username, password });
        localStorage.setItem('users', JSON.stringify(users));
        alert('Nuevo usuario creado con éxito');
    }
});

// Manejo del formulario de login
loginForm.addEventListener('submit', function(event) {
    event.preventDefault();
    
    const username = usernameInput.value;
    const password = passwordInput.value;
    
    if (validateUser(username, password)) {
        // Si los datos son correctos, mostrar la aplicación y ocultar el login
        loginSection.style.display = 'none';
        appSection.style.display = 'block';
    } else {
        // Si los datos son incorrectos, mostrar mensaje de error
        errorMessage.style.display = 'block';
    }
});
