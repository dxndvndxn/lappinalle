<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    private function render() {
        $renderer_source = File::get(base_path('node_modules/vue-server-renderer/basic.js'));
        $app_source = File::get(public_path('js/entry-server.js'));

        $v8 = new \V8Js();

        ob_start();

        $js =
            <<<EOT
var process = { env: { VUE_ENV: "server", NODE_ENV: "production" } };
this.global = { process: process };
EOT;

        $v8->executeString($js);
        $v8->executeString($renderer_source);

        $v8->executeString($app_source);

        return ob_get_clean();
    }

    public function index()
    {
//        $v8 = new \V8Js();
//        $ssr = $v8->executeString(
//            'let hi = "Hi";
//            let Mark = "Mark"
//            hi + Mark
//
//        ');

//        $ssr = $this->render();
//        return view('home', ['ssr' => $ssr]);
        return view('home');
    }
}
