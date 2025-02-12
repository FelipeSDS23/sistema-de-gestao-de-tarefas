<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class AppController extends Controller
{
    //
    public function index() {
        return view('app.dashboard');
    }

    public function config() {
        return view('app.config');
    }

    public function configPost(Request $request) {

        if($request->get('receber_email_tarefa_criada') == 'on') {
            Setting::query()->update([
                'send_email_on_create' => true,
            ]);
        } else {
            Setting::query()->update([
                'send_email_on_create' => false,
            ]);
        }

        if($request->get('receber_email_tarefa_editada') == 'on') {
            Setting::query()->update([
                'send_email_on_edit' => true,
            ]);
        } else {
            Setting::query()->update([
                'send_email_on_edit' => false,
            ]);
        }

        return redirect()->route('dashboard.config')->with('success', 'Configurações aplicadas com sucesso!');

    }
}
