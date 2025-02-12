<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    //
    public function index() {
        return view('app.dashboard');
    }

    public function config() {
        $setting = Setting::where('user_id', Auth::user()->id)->first();
        return view('app.config', ['setting' => $setting]);
    }

    public function configPost(Request $request) {

        if($request->get('receber_email_tarefa_criada') == 'on') {
            Setting::query()
                ->where('user_id', Auth::user()->id)
                ->update([
                    'send_email_on_create' => true,
                ]);
        } else {
            Setting::query()
                ->where('user_id', Auth::user()->id)
                ->update([
                    'send_email_on_create' => false,
                ]);
        }

        if($request->get('receber_email_tarefa_editada') == 'on') {
            Setting::query()
                ->where('user_id', Auth::user()->id)
                ->update([
                    'send_email_on_edit' => true,
                ]);
        } else {
            Setting::query()
                ->where('user_id', Auth::user()->id)
                ->update([
                    'send_email_on_edit' => false,
                ]);
        }

        return redirect()->route('dashboard.config')->with('success', 'Configurações aplicadas com sucesso!');

    }
}
