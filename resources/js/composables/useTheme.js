import { ref } from "vue";

export function useTheme() {
    const isDarkMode = ref(false);

    function toggleTheme() {
        isDarkMode.value = !isDarkMode.value;
        if (isDarkMode.value) {
            document.documentElement.setAttribute("data-theme", "dark");
            localStorage.setItem("theme", "dark");
        } else {
            document.documentElement.removeAttribute("data-theme");
            localStorage.setItem("theme", "light");
        }
    }

    return { isDarkMode, toggleTheme };
}
