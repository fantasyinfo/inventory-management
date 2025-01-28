import "./bootstrap";

document.addEventListener("alpine:init", () => {
    Alpine.store("theme", {
        dark:
            localStorage.theme === "dark" ||
            (!("theme" in localStorage) &&
                window.matchMedia("(prefers-color-scheme: dark)").matches),
        toggle(theme) {
            if (theme === "system") {
                localStorage.removeItem("theme");
                if (window.matchMedia("(prefers-color-scheme: dark)").matches) {
                    document.documentElement.classList.add("dark");
                    this.dark = true;
                } else {
                    document.documentElement.classList.remove("dark");
                    this.dark = false;
                }
            } else {
                localStorage.theme = theme;
                if (theme === "dark") {
                    document.documentElement.classList.add("dark");
                    this.dark = true;
                } else {
                    document.documentElement.classList.remove("dark");
                    this.dark = false;
                }
            }
        },
    });

    // Set initial theme
    Alpine.store("theme").toggle(localStorage.theme || "system");

    // Listen for theme changes
    window.addEventListener("theme-updated", (event) => {
        Alpine.store("theme").toggle(event.detail.theme);
    });

    // Listen for system theme changes
    window
        .matchMedia("(prefers-color-scheme: dark)")
        .addEventListener("change", (e) => {
            if (!localStorage.theme) {
                // Only if using system theme
                Alpine.store("theme").toggle("system");
            }
        });
});
