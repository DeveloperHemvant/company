<x-guest-layout>
    <div style="display: flex; justify-content: center; align-items: center; min-height: 100vh; background-color: #f3f4f6;">
        <div style="width: 100%; max-width: 24rem;">
            <div class="card shadow-sm">
                <div class="card-body">
                    <x-validation-errors class="mb-4" />
                    <form method="POST" action="{{ url('/staff/login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password">
                        </div>
                        <div class="mb-3 form-check">
                            <input id="remember_me" type="checkbox" name="remember" class="form-check-input">
                            <label class="form-check-label" for="remember_me">{{ __('Remember me') }}</label>
                        </div>
                        <div class="d-grid gap-2">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm text-gray-600">{{ __('Forgot your password?') }}</a>
                            @endif
                            <button type="submit" class="btn btn-primary">{{ __('Log in') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
