document.addEventListener('DOMContentLoaded', () => {
    const pokedex = document.getElementById('pokedex');
    const modal = document.getElementById('pokemon-modal');
    const closeModal = document.getElementById('close-modal');
    const modalImg = document.getElementById('modal-img');
    const modalName = document.getElementById('modal-name');
    const modalHeight = document.getElementById('modal-height');
    const modalWeight = document.getElementById('modal-weight');
    const modalTypes = document.getElementById('modal-types');

    // Función para obtener los primeros 20 Pokémon
    const fetchPokemon = async () => {
        for (let i = 1; i <= 50; i++) {
            const res = await fetch(`https://pokeapi.co/api/v2/pokemon/${i}`);
            const pokemon = await res.json();
            renderPokemon(pokemon);
        }
    };

    // Renderizar Pokémon en la Pokédex
    const renderPokemon = (pokemon) => {
        const card = document.createElement('div');
        card.classList.add('pokemon-card');
        card.innerHTML = `
            <img src="${pokemon.sprites.front_default}" alt="${pokemon.name}">
            <h3>${pokemon.name.charAt(0).toUpperCase() + pokemon.name.slice(1)}</h3>
        `;
        pokedex.appendChild(card);

        // Añadir evento para mostrar el modal
        card.addEventListener('click', () => showPokemonDetails(pokemon));
    };

    // Mostrar detalles del Pokémon en el modal
    const showPokemonDetails = (pokemon) => {
        modalImg.src = pokemon.sprites.front_default;
        modalName.textContent = pokemon.name.charAt(0).toUpperCase() + pokemon.name.slice(1);
        modalHeight.textContent = pokemon.height;
        modalWeight.textContent = pokemon.weight;
        modalTypes.textContent = pokemon.types
            .map((type) => type.type.name)
            .join(', ');

        modal.classList.add('active');
    };

    // Cerrar el modal
    closeModal.addEventListener('click', () => {
        modal.classList.remove('active');
    });

    // Llamar a la función para obtener los Pokémon
    fetchPokemon();
});
