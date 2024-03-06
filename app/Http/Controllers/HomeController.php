<?php

namespace App\Http\Controllers;

use App\Domain\IPs\Actions\CreateProxyAction;
use App\Domain\IPs\Actions\MassCreateProxyAction;
use App\Http\Requests\CreateIpRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome', []);
    }

    public function create(CreateIpRequest $request, MassCreateProxyAction $action)
    {
        return view('welcome', [
            'hash' => $action->execute($request->getIpHosts())
        ]);
    }
}
