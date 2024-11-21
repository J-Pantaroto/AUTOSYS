document.addEventListener("DOMContentLoaded", () => {
    const dropdownMenu = document.getElementById("drop");
    const dropdownButton = document.getElementById("userDropdownMenuLink");
    if (dropdownMenu && dropdownButton) {
        dropdownButton.addEventListener("mouseenter", () => {
            dropdownMenu.style.display = "block";
            dropdownButton.setAttribute("aria-expanded", "true");
        });
        dropdownMenu.addEventListener("mouseleave", () => {
            dropdownMenu.style.display = "none";
            dropdownButton.setAttribute("aria-expanded", "false");
        });
        document.addEventListener("click", function (event) {
            if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.style.display = "none";
                dropdownButton.setAttribute("aria-expanded", "false");
            }
        });
    }
});
