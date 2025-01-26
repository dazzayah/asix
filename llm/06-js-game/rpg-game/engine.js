// ----------------- Funciones estadísticas y setup -----------------

function setStats() { // Exportar las estadísticas mediante sessionStorage

  const str = document.getElementById('fuerza').value;
  const agi = document.getElementById('agilidad').value;
  const int = document.getElementById('intelecto').value;
  const sta = document.getElementById('aguante').value;
  const spr = document.getElementById('espiritu').value;

  sessionStorage.setItem('str', str);
  sessionStorage.setItem('agi', agi);
  sessionStorage.setItem('int', int);
  sessionStorage.setItem('sta', sta);
  sessionStorage.setItem('spr', spr);

  window.location.href = 'game.html';

};

// Esta función valida que el total de puntos asignados no supere 15, 
// y se activa cada vez que se cambia valor de un input

function validatePoints() {

  let totalPoints = 0;

  statInputs.forEach(input => {
    totalPoints = totalPoints + parseInt(input.value) || 0;
  });

  if (totalPoints > 15) {
    startButton.disabled = true;
    alert('No puedes asignar más de 15 puntos en total.');
  } else {
    startButton.disabled = false;
  }

};

// ----------------- Registro de acciones y combate -----------------

function logAction(message, type) {

  const newLogEntry = document.createElement("p");
  newLogEntry.innerText = message;
  newLogEntry.classList.add(type); // Para darle formato a los mensajes
  combatLog.appendChild(newLogEntry); // combatLog se inicializa en game.html
  combatLog.scrollTop = combatLog.scrollHeight; // https://developer.mozilla.org/en-US/docs/Web/API/Element/scrollHeight

};

function storyTelling() {
  meleeButton.disabled = true;
  rangeButton.disabled = true;
  dmgSpellButton.disabled = true;
  healSpellButton.disabled = true;

  const messages = [
    "Te adentras en la cueva, arma en mano y el corazón en un puño.",
    "El aire se vuelve más denso y cálido.",
    "Un rugido retumba en la cueva, y una sombra se cierne sobre ti.",
    "Un dragón emerge de la oscuridad, caracterizado por sus escamas obsidiana y su tamaño colosal.", 
    "Te preparas para la batalla, sabiendo que solo uno de los dos saldrá con vida."
  ];

  for (let i = 0; i < messages.length; i++) {

    // Lo he tenido que hacer con una función anónima, 
    // ya que ejecuta directamente la funcion logAction si intento incluirle parametros.
    // JavaScript y sus cosas raras.
    setTimeout(function () {
      logAction(messages[i], "narrative");
      if (i === messages.length - 1) {
        meleeButton.disabled = false;
        rangeButton.disabled = false;
        dmgSpellButton.disabled = false;
        healSpellButton.disabled = false;
      }
    }, i * 2500);
  }
}

// ----------------- Dados, hechizos y habilidades -----------------

// https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/random
function roll(max) { // Función para lanzar dados, donde max es el numero de caras del dado
  return Math.floor(Math.random() * (max + 1));
}

// Ataque cuerpo a cuerpo
function melee(str) {
  return Math.round (str * 2.5 + roll(10));
}

// Rango
function range(agi) {
  if (agi >= 5) {
  return Math.round(agi * 1.5 + roll(12) + roll(20));}
  else {
    return Math.round(agi * 1.5 + roll(12));
  }
}

// Hechizo ofensivo
function dmgSpell(int) {
  return Math.round (int * 2 + roll(4));
}

// Hechizo curativo
function healSpell(spr) {
  return Math.round(spr * 1.5 + roll(6));
}

// ----------------- Sistema por turnos y enemigo -----------------

function updateHealthBars() {
  document.getElementById("player-hp").innerText = `Jugador: ${playerHP} HP`;
  document.getElementById("dragon-hp").innerText = `Dragón: ${dragonHP} HP`;
}

function dragonDefense(damage, type) {
  if (type === "physical") {
    if (dragonScales === "up") {
      logAction("Esas escamas no dejarán pasar ningún golpe o proyectil...", "info");
      return Math.floor(damage * 0.2);
    } else if (dragonScales === "weakened") {
      logAction("Las escamas del dragón están debilitadas, pero todavía resisten.", "info");
      return Math.floor(damage * 0.3);
    } else if (dragonScales === "down") {
      return damage;
    }
  }

  else if (type === "magic") {
    return Math.floor(damage * 1.5); // Vulnerable a ataques mágicos
  }
}

function nextTurn() {
  playerTurn = !playerTurn; // Inversión del estado del turno (si es true, se vuelve false y viceversa)

  if (playerTurn === false) {
    setTimeout(dragonAction, 3000); // Añadimos un retraso estético de 3 segundos 
  }
}

function dragonAction() {
  const damage = roll(6) + 3; // Daño base del dragón
  playerHP = playerHP - damage;

  logAction(`El dragón ataca e inflige ${damage} de daño al jugador.`);
  updateHealthBars();

  // Verificar si el jugador ha perdido
  if (playerHP <= 0) {
    endGame("Has muerto.");
  } else {
    nextTurn();
  }
}

function endGame(message) {
  logAction(message);
  meleeButton.disabled = true;
  rangeButton.disabled = true;
  dmgSpellButton.disabled = true;
  healSpellButton.disabled = true;

  if (dragonHP <= 0) {
    setTimeout(function () {
      document.getElementById("game-menu").classList.remove("visible");
      document.getElementById("game-menu").classList.add("hidden");
      document.getElementById("win-end-menu").classList.remove("hidden");
      document.getElementById("win-end-menu").classList.add("visible");
    }, 3000);
  } else if (playerHP <= 0) {
    setTimeout(function () {
      document.getElementById("game-menu").classList.remove("visible");
      document.getElementById("game-menu").classList.add("hidden");
      document.getElementById("lose-end-menu").classList.remove("hidden");
      document.getElementById("lose-end-menu").classList.add("visible");
    }, 3000);
  }

}

