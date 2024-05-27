<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Hash;
class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);


        RateLimiter::for('login:user', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());
            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('login:admin', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());
            return Limit::perMinute(5)->by($throttleKey);
        });

        $this->configureAuthentication();
    }

    protected function configureAuthentication()
    {
        Fortify::authenticateUsing(function (Request $request) {
            if ($request->is('admin/*')) {
                return $this->authenticateAdmin($request);
            }elseif($request->is('staff/*')) {
                return $this->authenticateStaff($request);
            }else{
                return $this->authenticateUser($request);
            }
            
        });
    }

    protected function authenticateUser(Request $request)
    {
        $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

        if (RateLimiter::tooManyAttempts('login:user|' . $throttleKey, 5)) {
            throw ValidationException::withMessages([
                Fortify::username() => [
                    trans('auth.throttle', [
                        'seconds' => RateLimiter::availableIn('login:user|' . $throttleKey),
                        'minutes' => ceil(RateLimiter::availableIn('login:user|' . $throttleKey) / 60),
                    ])
                ],
            ]);
        }

        $user = User::where('email', $request->email)->where('role', 'user')->first();

        if ($user && Hash::check($request->password, $user->password)) {
            RateLimiter::clear('login:user|' . $throttleKey);
            return $user;
        }

        RateLimiter::hit('login:user|' . $throttleKey);

        throw ValidationException::withMessages([
            Fortify::username() => [trans('auth.failed')],
        ]);
    }

    protected function authenticateAdmin(Request $request)
    {
        $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

        if (RateLimiter::tooManyAttempts('login:admin|' . $throttleKey, 5)) {
            throw ValidationException::withMessages([
                Fortify::username() => [
                    trans('auth.throttle', [
                        'seconds' => RateLimiter::availableIn('login:admin|' . $throttleKey),
                        'minutes' => ceil(RateLimiter::availableIn('login:admin|' . $throttleKey) / 60),
                    ])
                ],
            ]);
        }

        $admin = User::where('email', $request->email)->where('role', 'admin')->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            RateLimiter::clear('login:admin|' . $throttleKey);
            return $admin;
        }

        RateLimiter::hit('login:admin|' . $throttleKey);

        throw ValidationException::withMessages([
            Fortify::username() => [trans('auth.failed')],
        ]);
    }
    protected function authenticateStaff(Request $request)
    {
        $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

        if (RateLimiter::tooManyAttempts('login:staff|' . $throttleKey, 5)) {
            throw ValidationException::withMessages([
                Fortify::username() => [
                    trans('auth.throttle', [
                        'seconds' => RateLimiter::availableIn('login:staff|' . $throttleKey),
                        'minutes' => ceil(RateLimiter::availableIn('login:staff|' . $throttleKey) / 60),
                    ])
                ],
            ]);
        }

        $staff = User::where('email', $request->email)->where('role', 'staff')->first();

        if ($staff && Hash::check($request->password, $staff->password)) {
            RateLimiter::clear('login:staff|' . $throttleKey);
            return $staff;
        }

        RateLimiter::hit('login:staff|' . $throttleKey);

        throw ValidationException::withMessages([
            Fortify::username() => [trans('auth.failed')],
        ]);
    }
}

