<?php

namespace App\Filament\Pages\Auth;

use Illuminate\Contracts\Support\Htmlable;

class Login extends \Filament\Pages\Auth\Login
{

    public function getHeading(): string | Htmlable
    {
        return __('Log In');
    }

}
