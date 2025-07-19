<!-- Loading Screen Component -->
<div id="page-loader"
    class="fixed inset-0 z-50 flex items-center justify-center bg-gradient-to-br from-green-50 to-green-100 transition-opacity duration-500">
    <div class="text-center">
        <!-- Animated Tree -->
        <div class="relative mb-4 flex justify-center">
            <!-- Tree SVG with Animation -->
            <svg width="140" height="140" viewBox="0 0 120 120" class="animate-pulse">
                <!-- Tree Trunk -->
                <rect x="55" y="80" width="10" height="25" fill="#8B4513" class="animate-grow-trunk" />

                <!-- Tree Leaves - Layer 1 (Bottom) -->
                <circle cx="60" cy="75" r="18" fill="#22C55E" class="animate-grow-leaves delay-100" />

                <!-- Tree Leaves - Layer 2 (Middle) -->
                <circle cx="60" cy="65" r="15" fill="#16A34A" class="animate-grow-leaves delay-200" />

                <!-- Tree Leaves - Layer 3 (Top) -->
                <circle cx="60" cy="55" r="12" fill="#15803D" class="animate-grow-leaves delay-300" />

                <!-- Birds Animation -->
                <g class="animate-fly-birds">
                    <path d="M85 45 Q87 43 89 45 Q87 47 85 45" fill="#6B7280" class="animate-flap" />
                    <path d="M95 35 Q97 33 99 35 Q97 37 95 35" fill="#6B7280" class="animate-flap delay-75" />
                </g>

                <!-- Falling Leaves -->
                <circle cx="40" cy="70" r="2" fill="#FCD34D" class="animate-fall-leaf" />
                <circle cx="85" cy="60" r="1.5" fill="#F59E0B" class="animate-fall-leaf delay-150" />
                <circle cx="75" cy="85" r="1.5" fill="#EAB308" class="animate-fall-leaf delay-300" />
            </svg>
        </div>

        <!-- Loading Text -->
        <div class="space-y-2">
            <div class="flex items-center justify-center space-x-2">
                <div class="flex space-x-1">
                    <div class="w-2 h-2 bg-green-600 rounded-full animate-bounce"></div>
                    <div class="w-2 h-2 bg-green-600 rounded-full animate-bounce delay-75"></div>
                    <div class="w-2 h-2 bg-green-600 rounded-full animate-bounce delay-150"></div>
                </div>
                <span id="loading-text" class="text-green-700 font-medium">Memuat halaman...</span>
            </div>
        </div>

        <!-- Progress Bar -->
        <div class="w-64 h-2 bg-green-200 rounded-full overflow-hidden mt-6">
            <div class="h-full bg-gradient-to-r from-green-400 to-green-600 rounded-full animate-loading-progress">
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes grow-trunk {
        0% {
            transform: scaleY(0);
            transform-origin: bottom;
        }

        100% {
            transform: scaleY(1);
            transform-origin: bottom;
        }
    }

    @keyframes grow-leaves {
        0% {
            transform: scale(0);
            opacity: 0;
        }

        50% {
            transform: scale(1.1);
            opacity: 0.8;
        }

        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    @keyframes fly-birds {

        0%,
        100% {
            transform: translateX(0);
        }

        50% {
            transform: translateX(10px);
        }
    }

    @keyframes flap {

        0%,
        100% {
            transform: rotateZ(0deg);
        }

        50% {
            transform: rotateZ(20deg);
        }
    }

    @keyframes fall-leaf {
        0% {
            transform: translateY(-10px) rotateZ(0deg);
            opacity: 1;
        }

        100% {
            transform: translateY(30px) rotateZ(360deg);
            opacity: 0;
        }
    }

    @keyframes loading-progress {
        0% {
            width: 0%;
        }

        50% {
            width: 70%;
        }

        100% {
            width: 100%;
        }
    }

    .animate-grow-trunk {
        animation: grow-trunk 0.8s ease-out forwards;
    }

    .animate-grow-leaves {
        animation: grow-leaves 0.6s ease-out forwards;
    }

    .animate-fly-birds {
        animation: fly-birds 3s ease-in-out infinite;
    }

    .animate-flap {
        animation: flap 0.5s ease-in-out infinite;
    }

    .animate-fall-leaf {
        animation: fall-leaf 2s ease-in-out infinite;
    }

    .animate-loading-progress {
        animation: loading-progress 2s ease-in-out infinite;
    }

    .delay-75 {
        animation-delay: 0.075s;
    }

    .delay-100 {
        animation-delay: 0.1s;
    }

    .delay-150 {
        animation-delay: 0.15s;
    }

    .delay-200 {
        animation-delay: 0.2s;
    }

    .delay-300 {
        animation-delay: 0.3s;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const loader = document.getElementById('page-loader');
        const loadingText = document.getElementById('loading-text');
        const body = document.body;

        // Loading messages
        const loadingMessages = [
            'Memuat halaman...',
            'Menyiapkan konten...',
            'Menghubungkan ke server...',
            'Memuat informasi perhutani...',
            'Menyiapkan data hutan...',
            'Loading...'
        ];

        let messageIndex = 0;
        let messageInterval;

        function showLoader() {
            if (loader) {
                loader.style.display = 'flex';
                loader.style.opacity = '1';
                body.style.overflow = 'hidden';

                // Start cycling through loading messages
                messageIndex = 0;
                if (loadingText) {
                    loadingText.textContent = loadingMessages[messageIndex];
                    messageInterval = setInterval(() => {
                        messageIndex = (messageIndex + 1) % loadingMessages.length;
                        loadingText.textContent = loadingMessages[messageIndex];
                    }, 800);
                }
            }
        }

        function hideLoader() {
            if (loader) {
                // Clear message interval
                if (messageInterval) {
                    clearInterval(messageInterval);
                }

                loader.style.opacity = '0';
                body.style.overflow = '';
                setTimeout(() => {
                    loader.style.display = 'none';
                }, 500);
            }
        }

        // Hide loader when page is fully loaded
        window.addEventListener('load', function() {
            setTimeout(hideLoader, 800);
        });

        // Show loader on navigation - but exclude SweetAlert buttons and special links
        document.addEventListener('click', function(e) {
            const link = e.target.closest('a');

            if (link && link.href && !link.classList.contains('no-loader')) {
                const url = new URL(link.href, window.location.origin);
                const currentUrl = new URL(window.location.href);

                // Skip if it's a SweetAlert button, Alpine.js directive, or special link
                if (link.hasAttribute('x-sweetalert') ||
                    link.closest('.swal2-popup') ||
                    link.hasAttribute('@click') ||
                    link.href.includes('email-preview') ||
                    link.href.includes('admin/')) {
                    return;
                }

                // Check if it's internal navigation
                if (url.hostname === currentUrl.hostname &&
                    !link.href.startsWith('#') &&
                    !link.href.startsWith('javascript:') &&
                    link.target !== '_blank') {

                    // Small delay to allow for any preventDefault handlers
                    setTimeout(() => {
                        if (!e.defaultPrevented) {
                            showLoader();
                        }
                    }, 10);
                }
            }
        });

        // Show loader on form submissions (GET method)
        document.addEventListener('submit', function(e) {
            const form = e.target;
            if (form.method.toLowerCase() === 'get' && !form.classList.contains('no-loader')) {
                showLoader();
            }
        });

        // Handle browser navigation
        window.addEventListener('beforeunload', function() {
            showLoader();
        });
    });
</script>
