document.addEventListener('DOMContentLoaded', () => {
    const trainerForm = document.getElementById('trainer-form');
    const trainerInfo = document.getElementById('trainer-info');
    const pokedex = document.getElementById('pokedex');
    const modal = document.getElementById('pokemon-modal');
    const closeModal = document.getElementById('close-modal');
    const modalImg = document.getElementById('modal-img');
    const modalName = document.getElementById('modal-name');
    const modalHeight = document.getElementById('modal-height');
    const modalWeight = document.getElementById('modal-weight');
    const modalTypes = document.getElementById('modal-types');
    const captureButton = document.getElementById('capture-button'); // Botón para capturar

    // Mostrar los requisitos en los campos
    document.getElementById('name').placeholder = "Solo letras, máximo 30 caracteres";
    document.getElementById('email').placeholder = "Formato: nombre@dominio.com";
    document.getElementById('phone').placeholder = "Solo números, entre 9 y 15 caracteres";
    document.getElementById('password').placeholder = "Mínimo 1 mayúscula, 1 minúscula y 1 número";
    document.getElementById('confirm-password').placeholder = "Debe coincidir con la contraseña";

    // Validación del formulario
    const validateForm = () => {
        const name = document.getElementById('name');
        const email = document.getElementById('email');
        const phone = document.getElementById('phone');
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirm-password');
        const generation = document.getElementById('generation');

        const nameError = document.getElementById('name-error');
        const emailError = document.getElementById('email-error');
        const phoneError = document.getElementById('phone-error');
        const passwordError = document.getElementById('password-error');
        const confirmPasswordError = document.getElementById('confirm-password-error');

        let isValid = true;

        // Validar nombre
        if (!/^[a-zA-Z\s]{1,30}$/.test(name.value)) {
            nameError.textContent = 'Nombre inválido. Solo letras y máximo 30 caracteres.';
            isValid = false;
        } else {
            nameError.textContent = '';
        }

        // Validar email
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
            emailError.textContent = 'Correo electrónico inválido.';
            isValid = false;
        } else {
            emailError.textContent = '';
        }

        // Validar teléfono
        if (!/^\d{9,15}$/.test(phone.value)) {
            phoneError.textContent = 'Teléfono inválido. Solo números, entre 9 y 15 caracteres.';
            isValid = false;
        } else {
            phoneError.textContent = '';
        }

        // Validar contraseña
        if (!/(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}/.test(password.value)) {
            passwordError.textContent = 'La contraseña debe tener al menos una mayúscula, una minúscula y un número.';
            isValid = false;
        } else {
            passwordError.textContent = '';
        }

        // Confirmar contraseña
        if (password.value !== confirmPassword.value) {
            confirmPasswordError.textContent = 'Las contraseñas no coinciden.';
            isValid = false;
        } else {
            confirmPasswordError.textContent = '';
        }

        return isValid;
    };

    // Evento de envío del formulario
    trainerForm.addEventListener('submit', (e) => {
        e.preventDefault();

        if (validateForm()) {
            alert('Inscripción correcta.');

            // Mostrar información del entrenador
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const phone = document.getElementById('phone').value;
            const generation = document.getElementById('generation').value;

            trainerInfo.innerHTML = `
                <h2>Datos del Entrenador</h2>
                <p><strong>Nombre:</strong> ${name}</p>
                <p><strong>Email:</strong> ${email}</p>
                <p><strong>Teléfono:</strong> ${phone}</p>
                <p><strong>Generación Elegida:</strong> ${generation}</p>
                <p><strong>URL Actual:</strong> ${window.location.href}</p>
            `;

            trainerInfo.style.display = 'block';
            pokedex.style.display = 'grid';
            trainerForm.style.display = 'none';

            const generationRanges = {
                '1st': [1, 151],
                '2nd': [152, 251],
                '3rd': [252, 386]
            };

            const [start, end] = generationRanges[generation];
            fetchPokemon(start, end);
        }
    });

    // Función para obtener Pokémon
    const fetchPokemon = async (start, end) => {
        for (let i = start; i <= end; i++) {
            const res = await fetch(`https://pokeapi.co/api/v2/pokemon/${i}`);
            const pokemon = await res.json();
            renderPokemon(pokemon);
        }
    };

    // Renderizar cada Pokémon
    const renderPokemon = (pokemon) => {
        const card = document.createElement('div');
        card.classList.add('pokemon-card');
        card.dataset.pokemonId = pokemon.id; // Guardamos el ID del Pokémon
        card.innerHTML = `
            <img src="${pokemon.sprites.front_default}" alt="${pokemon.name}">
            <h3>${pokemon.name.charAt(0).toUpperCase() + pokemon.name.slice(1)}</h3>
        `;
        pokedex.appendChild(card);

        card.addEventListener('click', () => showPokemonDetails(pokemon, card));
    };

    // Mostrar detalles del Pokémon
    const showPokemonDetails = (pokemon, card) => {
        modalImg.src = pokemon.sprites.front_default;
        modalName.textContent = pokemon.name.charAt(0).toUpperCase() + pokemon.name.slice(1);
        modalHeight.textContent = pokemon.height;
        modalWeight.textContent = pokemon.weight;
        modalTypes.textContent = pokemon.types.map(type => type.type.name).join(', ');
    
        modal.classList.add('active');
    
        // Asegurarse de que el botón de captura se muestre correctamente
        captureButton.style.display = 'block';
        console.log("Botón Capturar mostrado", captureButton); // Verificación de que el botón se muestra
    
        // Añadir evento al botón de captura
        captureButton.onclick = () => capturePokemon(pokemon, card);
    };

    // Función para capturar un Pokémon
    const capturePokemon = (pokemon, card) => {
        // Marcar el Pokémon como capturado (filtro gris)
        card.classList.add('captured');

        // Cerrar el modal
        modal.classList.remove('active');
        captureButton.style.display = 'none'; // Ocultar el botón después de capturarlo
    };

    // Cerrar modal
    closeModal.addEventListener('click', () => {
        modal.classList.remove('active');
        captureButton.style.display = 'none'; // Ocultar el botón al cerrar el modal
    });
});


