// Function to show and hide the maintence sub menu
function maintenceSubMenu(){
    // Ophalen van element
    var submenu = document.getElementById("maintanceSubmenu");

    // CSS class toevoegen als die er niet op staan en verwijderen als ze er wel op staan
    submenu.classList.toggle("submenu--show");
}