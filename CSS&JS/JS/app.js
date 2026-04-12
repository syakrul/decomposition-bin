(() => {

    const sidebar = document.getElementById("sidebar");
    const overlay = document.querySelector(".overlay");
    const btn     = document.querySelector("[data-menu-btn]");

    if (!sidebar) return;

    function openMenu() {
        sidebar.classList.add("show");
        if (overlay) overlay.classList.add("show");
    }

    function closeMenu() {
        sidebar.classList.remove("show");
        if (overlay) overlay.classList.remove("show");
    }

    if (btn) {
        btn.addEventListener("click", () => {
            if (sidebar.classList.contains("show")) {
                closeMenu();
            } else {
                openMenu();
            }
        });
    }

    if (overlay) {
        overlay.addEventListener("click", closeMenu);
    }

})();