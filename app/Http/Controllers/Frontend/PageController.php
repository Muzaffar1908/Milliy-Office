<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Main\Main;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function index()
    {
        $lang = \App::getLocale();

        $mains = Main::select('id', 'title_'. $lang . ' as title', DB::raw('SUBSTRING(`description_' . $lang . '`, 1, 50) as long_text'), 'youtobe_id', 'background', 'is_active', 'created_at')->take(1);

        return view('frontend.app', compact('mains'));
    }
}
