// Exportar e importar estadísticas a nivel de sesión

function setStats() {

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

function getStats() {

    const str = parseInt(sessionStorage.getItem('str'), 10);
    const agi = parseInt(sessionStorage.getItem('agi'), 10);
    const int = parseInt(sessionStorage.getItem('int'), 10);
    const sta = parseInt(sessionStorage.getItem('sta'), 10);
    const spr = parseInt(sessionStorage.getItem('spr'), 10);

    console.log('Fuerza:', str);
    console.log('Agilidad:', agi);
    console.log('Intelecto:', int);
    console.log('Aguante:', sta);
    console.log('Espíritu:', spr);

};

// Validación de puntos de estadísticas en el menú

function validatePoints() {
    let totalPoints = 0;

    statInputs.forEach(input => {
        totalPoints += parseInt(input.value) || 0;
    });

    if (totalPoints > 15) {
        startButton.disabled = true;
        alert('No puedes asignar más de 15 puntos en total.');
    } else {
        startButton.disabled = false;
    }
};

// Combate y juego

function logAction(message) {
    const newLogEntry = document.createElement("p");
    newLogEntry.textContent = message;
    combatLog.appendChild(newLogEntry);
    combatLog.scrollTop = combatLog.scrollHeight;
  }

