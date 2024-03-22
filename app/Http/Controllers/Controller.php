<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\SocialMediaLink;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    function __construct()
    {
        $this->facebook = SocialMediaLink::where('slug','facebook')->first();
        $this->instagram = SocialMediaLink::where('slug','instagram')->first();
        $this->linkedin = SocialMediaLink::where('slug','linkedin')->first();
        $this->twitter = SocialMediaLink::where('slug','twitter')->first();
        View()->share('facebook', $this->facebook);
        View()->share('instagram', $this->instagram);
        View()->share('linkedin', $this->linkedin);
        View()->share('twitter', $this->twitter);
    }
}
