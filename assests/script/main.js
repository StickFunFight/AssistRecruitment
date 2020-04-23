// Function to show and hide the maintence sub menu
function maintenceSubMenu(){
    // Ophalen van element
    var submenu = document.getElementById("maintanceSubmenu");

    // CSS class toevoegen als die er niet op staan en verwijderen als ze er wel op staan
    submenu.classList.toggle("submenu--show");
}

// Function to switch active clas on the customer-edit overviews
function changeTabActive(newActiveTab) {
    // Getting the tab li
    var scans = document.getElementById("scansTab");
    var departments = document.getElementById("departmentsTab");
    var contacts = document.getElementById("contactsTab");

    if(newActiveTab == "scansTab") {
        // Remove active class
        departments.classList.remove('active');
        contacts.classList.remove('active');

        // Add active class
        scans.classList.add('active');
    } else if(newActiveTab == "departmentsTab") {
        // Remove active class
        scans.classList.remove('active');
        contacts.classList.remove('active');

        // Add active class
        departments.classList.add('active');
    } else if(newActiveTab == "contactsTab") {
        // Remove active class
        scans.classList.remove('active');
        departments.classList.remove('active');

        // Add active class
        contacts.classList.add('active');
    }
}