function almacenarStats() {

    // Correr un parseInt para pasarlo todo a int

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

function importarStats() {

    const str = sessionStorage.getItem('str');
    const agi = sessionStorage.getItem('agi');
    const int = sessionStorage.getItem('int');
    const sta = sessionStorage.getItem('sta');
    const spr = sessionStorage.getItem('spr');

    console.log('Fuerza:', str);
    console.log('Agilidad:', agi);
    console.log('Intelecto:', int);
    console.log('Aguante:', sta);
    console.log('Espíritu:', spr);

};