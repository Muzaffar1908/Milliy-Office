<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Main\Main;
use App\Models\News\News;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function index()
    {
        $lang = \App::getLocale();
        $mains = Main::select('id', 'title_' . $lang . ' as title', DB::raw('SUBSTRING(`description_' . $lang . '`, 1, 255) as long_text'), 'youtobe_id', 'background_image', 'is_active', 'created_at')->first();
        $news = News::select('id', 'cat_id', 'slug', 'title_' .$lang. ' as title', 'news_image', DB::raw('SUBSTRING(`description_' . $lang . '`, 1, 255) as long_text'), 'is_active', 'created_at')->orderBy('created_at', 'DESC')->take(1)->get();
        return view('frontend.app', ['mains' => $mains, 'news' => $news, 'lang' => $lang]);
    }
}
