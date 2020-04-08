<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class SettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the service categories.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     /**
     * Show the all services.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function twillo()
    {
        $user = \Auth::user();
        return view('admin.settings.twilio');
    }

    public function paymentGateway()
    {
        $user = \Auth::user();
        return view('admin.settings.gateway');
    }

}
