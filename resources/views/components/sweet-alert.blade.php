@if (session('success') || session('error') || session('warning') || session('info'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#10B981',
                    timer: 5000,
                    timerProgressBar: true,
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            @elseif (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '{{ session('error') }}',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#EF4444',
                    timer: 5000,
                    timerProgressBar: true,
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            @elseif (session('warning'))
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan!',
                    text: '{{ session('warning') }}',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#F59E0B',
                    timer: 5000,
                    timerProgressBar: true,
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            @elseif (session('info'))
                Swal.fire({
                    icon: 'info',
                    title: 'Informasi',
                    text: '{{ session('info') }}',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3B82F6',
                    timer: 5000,
                    timerProgressBar: true,
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            @endif
        });
    </script>
@endif
