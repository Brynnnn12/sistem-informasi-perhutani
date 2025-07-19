@extends('layouts.app')

@section('title', 'Test Reset Password')

@section('content')
    <div class="min-h-screen bg-gray-50 py-12">
        <div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Test Reset Password</h2>

            <div id="message" class="mb-4 hidden"></div>

            <form id="resetForm">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" value="admin@perhutani.go.id"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                </div>

                <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition-colors">
                    Kirim Reset Password
                </button>
            </form>

            <div class="mt-6">
                <h3 class="text-lg font-medium text-gray-900 mb-2">Test Throttling</h3>
                <p class="text-sm text-gray-600 mb-4">Klik tombol di atas beberapa kali dengan cepat untuk test throttling
                    (5 detik).</p>

                <button id="rapidTest"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition-colors">
                    Test Rapid Send (3x)
                </button>
            </div>

            <div class="mt-6 p-4 bg-gray-100 rounded-md">
                <h4 class="font-medium text-gray-900 mb-2">Logs:</h4>
                <div id="logs" class="text-sm text-gray-600 max-h-48 overflow-y-auto"></div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('resetForm');
            const message = document.getElementById('message');
            const logs = document.getElementById('logs');
            const rapidTest = document.getElementById('rapidTest');

            function addLog(text) {
                const time = new Date().toLocaleTimeString();
                logs.innerHTML += `<div>[${time}] ${text}</div>`;
                logs.scrollTop = logs.scrollHeight;
            }

            function showMessage(text, isSuccess = true) {
                message.className =
                    `mb-4 p-3 rounded-md ${isSuccess ? 'bg-green-100 text-green-700 border border-green-200' : 'bg-red-100 text-red-700 border border-red-200'}`;
                message.textContent = text;
                message.classList.remove('hidden');
            }

            function sendReset() {
                const email = document.getElementById('email').value;

                return fetch('/test/password-reset/send', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('[name=_token]').value
                        },
                        body: JSON.stringify({
                            email: email
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        addLog(`${data.success ? 'SUCCESS' : 'FAILED'}: ${data.message}`);
                        showMessage(data.message, data.success);
                        return data;
                    })
                    .catch(error => {
                        addLog(`ERROR: ${error.message}`);
                        showMessage('Terjadi kesalahan jaringan', false);
                    });
            }

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                sendReset();
            });

            rapidTest.addEventListener('click', function() {
                addLog('Starting rapid test...');

                // Send 3 requests rapidly
                sendReset().then(() => {
                    setTimeout(() => sendReset(), 100);
                    setTimeout(() => sendReset(), 200);
                });
            });

            // Initial log
            addLog('Ready to test password reset throttling');
        });
    </script>
@endsection
