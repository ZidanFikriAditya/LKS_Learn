<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Society;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::viaRequest('custom-token', function (Request $request) {
           $token = $request->bearerToken();

           if (!is_null($token)){
                $society = Society::where('login_tokens', $token)->first();
                if (is_null($society)) return null;
                return $society;
           }
            return false;
        });
    }
}
