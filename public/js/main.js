function toggleDropdown() {
    const dropdownMenu = document.getElementById("drop");
    const dropdownButton = document.querySelector("#userDropdown .user-button");
    const isExpanded = dropdownButton.getAttribute("aria-expanded") === "true";

    if (isExpanded) {
        dropdownMenu.style.display = "none";
        dropdownButton.setAttribute("aria-expanded", "false");
    } else {
        dropdownMenu.style.display = "block";
        dropdownButton.setAttribute("aria-expanded", "true");
    }
}

// Fecha o dropdown se o usuário clicar fora dele
document.addEventListener("click", function (event) {
    const dropdownMenu = document.getElementById("drop");
    const dropdownButton = document.querySelector("#userDropdown .user-button");

    if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
        dropdownMenu.style.display = "none";
        dropdownButton.setAttribute("aria-expanded", "false");
    }
});
