// Page Loader Enhancement
document.addEventListener("DOMContentLoaded", function () {
    const loader = document.getElementById("page-loader");
    const body = document.body;

    // Prevent scrolling when loader is visible
    function showLoader() {
        if (loader) {
            loader.style.display = "flex";
            loader.style.opacity = "1";
            body.style.overflow = "hidden";
        }
    }

    function hideLoader() {
        if (loader) {
            loader.style.opacity = "0";
            body.style.overflow = "";
            setTimeout(() => {
                loader.style.display = "none";
            }, 500);
        }
    }

    // Hide loader when page is fully loaded
    window.addEventListener("load", function () {
        setTimeout(hideLoader, 400); // Show loading for at least 400ms
    });

    // Show loader on link clicks (internal navigation)
    document.addEventListener("click", function (e) {
        const link = e.target.closest("a");

        if (link && link.href && !link.classList.contains("no-loader")) {
            const url = new URL(link.href, window.location.origin);
            const currentUrl = new URL(window.location.href);

            // Check if it's internal navigation
            if (
                url.hostname === currentUrl.hostname &&
                !link.href.startsWith("#") &&
                !link.href.startsWith("javascript:") &&
                link.target !== "_blank" &&
                !link.hasAttribute("download")
            ) {
                // Don't show loader for Alpine.js handled clicks
                if (
                    !link.hasAttribute("x-data") &&
                    !link.hasAttribute("@click") &&
                    !link.closest("[x-data]")
                ) {
                    showLoader();
                }
            }
        }
    });

    // Show loader on form submissions (GET method)
    document.addEventListener("submit", function (e) {
        const form = e.target;
        if (
            form.method.toLowerCase() === "get" &&
            !form.classList.contains("no-loader")
        ) {
            showLoader();
        }
    });

    // Handle back/forward navigation
    window.addEventListener("popstate", function () {
        showLoader();
    });

    // Hide loader on page visibility change (e.g., coming back to tab)
    document.addEventListener("visibilitychange", function () {
        if (!document.hidden) {
            hideLoader();
        }
    });
});
