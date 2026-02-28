<x-guest-layout>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-3 alert" style="background:rgba(52,211,153,0.1);border:1px solid rgba(52,211,153,0.3);color:#34d399;border-radius:10px;padding:0.75rem 1rem;font-size:0.85rem;">
            {{ session('status') }}
        </div>
    @endif

    <h5 class="fw-bold mb-1" style="color:#e2e8f0;">Selamat Datang</h5>
    <p class="mb-4" style="color:#4a5568;font-size:0.85rem;">Masuk ke panel admin portfolio</p>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" required autofocus placeholder="admin@portfolio.com">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>

            <div class="position-relative">
                <input id="password" type="password" name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    required placeholder="••••••••">

                <!-- Icon Toggle -->
                <span onclick="togglePassword()" 
                    style="position:absolute; top:50%; right:15px; transform:translateY(-50%);
                            cursor:pointer; color:#6b7280;">
                    <i class="bi bi-eye" id="toggleIcon"></i>
                </span>
            </div>

            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4 d-flex align-items-center justify-content-between">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember_me"
                       style="background:rgba(255,255,255,0.05);border-color:rgba(255,255,255,0.1);">
                <label class="form-check-label" for="remember_me" style="color:#4a5568;font-size:0.8rem;">
                    Ingat saya
                </label>
            </div>
        </div>

        <button type="submit" class="btn-login">
            <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
        </button>
    </form>

    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const icon = document.getElementById('toggleIcon');

            if (password.type === "password") {
                password.type = "text";
                icon.classList.remove("bi-eye");
                icon.classList.add("bi-eye-slash");
            } else {
                password.type = "password";
                icon.classList.remove("bi-eye-slash");
                icon.classList.add("bi-eye");
            }
        }
    </script>
</x-guest-layout>
