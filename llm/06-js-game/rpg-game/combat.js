    // Menús
    const startScreen = document.getElementById("startScreen");
    const combatScreen = document.getElementById("combatScreen");
    const endScreen = document.getElementById("endScreen");


    // Botones
    const startButton = document.getElementById("startButton");
    const attackButton = document.getElementById("attackButton");
    const defendButton = document.getElementById("defendButton");
    const magicButton = document.getElementById("magicButton");
    const healButton = document.getElementById("healButton");
    const restartButton = document.getElementById("restartButton");

    // Evento para comenzar el juego
    startButton.addEventListener("click", () => {
        startScreen.classList.remove("visible");
        combatScreen.classList.add("visible");
      });
      
    // Evento para reiniciar el juego
    restartButton.addEventListener("click", () => {
      endScreen.classList.remove("visible");
      startScreen.classList.add("visible");
    });

    // Botones de combate: Añadir lógica más tarde
    attackButton.addEventListener("click", () => {
      logAction("El jugador ataca con fuerza.");
    });

    defendButton.addEventListener("click", () => {
      logAction("El jugador se defiende.");
    });

    magicButton.addEventListener("click", () => {
      logAction("El jugador lanza un hechizo.");
    });

    healButton.addEventListener("click", () => {
      logAction("El jugador se cura.");
    });

    // Función para registrar acciones
    const combatLog = document.getElementById("combatLog");
    function logAction(message) {
      const newLogEntry = document.createElement("p");
      newLogEntry.textContent = message;
      combatLog.appendChild(newLogEntry);
      combatLog.scrollTop = combatLog.scrollHeight;
    }