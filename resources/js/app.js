import "./bootstrap";

import Alpine from "alpinejs";
import Swal from "sweetalert2";

// Make SweetAlert available globally
window.Swal = Swal;
window.Alpine = Alpine;

// Alpine.js SweetAlert directive
Alpine.directive(
    "sweetalert",
    (el, { expression, modifiers }, { evaluate }) => {
        const config = evaluate(expression);

        el.addEventListener("click", () => {
            if (modifiers.includes("confirm")) {
                Swal.fire({
                    title: config.title || "Apakah Anda yakin?",
                    text: config.text || "Aksi ini tidak dapat dibatalkan.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#16a34a",
                    cancelButtonColor: "#dc2626",
                    confirmButtonText: config.confirmText || "Ya, lanjutkan!",
                    cancelButtonText: config.cancelText || "Batal",
                    ...config,
                }).then((result) => {
                    if (result.isConfirmed && config.onConfirm) {
                        config.onConfirm();
                    }
                });
            } else if (modifiers.includes("success")) {
                Swal.fire({
                    title: config.title || "Berhasil!",
                    text: config.text,
                    icon: "success",
                    confirmButtonColor: "#16a34a",
                    ...config,
                });
            } else if (modifiers.includes("error")) {
                Swal.fire({
                    title: config.title || "Error!",
                    text: config.text,
                    icon: "error",
                    confirmButtonColor: "#dc2626",
                    ...config,
                });
            } else {
                Swal.fire(config);
            }
        });
    }
);

Alpine.start();
