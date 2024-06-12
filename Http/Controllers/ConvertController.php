<?php

declare(strict_types=1);

namespace Modules\Media\Http\Controllers;

use App\Http\Controllers\Controller;

class ConvertController extends Controller
{
    /**
     * Show the profile for the given user.
     */
    public function __invoke($id)
    {
        $view = 'media::convert';
        $view_params = [];

        return view($view, $view_params);
    }
}
