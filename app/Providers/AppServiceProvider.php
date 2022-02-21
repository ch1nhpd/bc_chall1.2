<?php

namespace App\Providers;

use App\Models\Account;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('role-T', function (Account $account) {
            return $account->role === 'T';
        });

        Gate::define('update-profile',function(Account $account, $id_update){
            return $account->id == $id_update;
        });

        Validator::extend('file_extension', function ($attribute, $value, $parameters, $validator) {
            if (!$value instanceof UploadedFile) {
                return false;
            }
    
            $extensions = implode(',', $parameters);
            $validator->addReplacer('file_extension', function (
                $message,
                $attribute,
                $rule,
                $parameters
            ) use ($extensions) {
                return \str_replace(':values', $extensions, $message);
            });
    
            $extension = strtolower($value->getClientOriginalExtension());
    
            return $extension !== '' && in_array($extension, $parameters);
        });
    }
}
