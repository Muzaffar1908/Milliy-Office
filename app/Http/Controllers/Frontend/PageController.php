<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact\Contact;
use App\Models\Gallery\Gallery;
use App\Models\Main\Main;
use App\Models\News\News;
use App\Models\Partner\Partner;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function index()
    {
        $lang = \App::getLocale();
        $mains = Main::select('id', 'title_' . $lang . ' as title', DB::raw('SUBSTRING(`description_' . $lang . '`, 1, 255) as long_text'), 'youtobe_id', 'background_image', 'is_active', 'created_at')->first();
        $news = News::select('id', 'title_' . $lang . ' as title', 'news_image', DB::raw('SUBSTRING(`description_' . $lang . '`, 1, 255) as long_text'), 'is_active', 'created_at')->where('cat_id', '=', 1)->orderBy('created_at', 'DESC')->first();
        $news_show = News::select('id', 'title_' . $lang . ' as title', 'news_image', 'is_active', 'created_at')->where('cat_id', '=', 1)->orderBy('created_at', 'DESC')->take(3)->get();
        $galleries = Gallery::select('id', 'image', 'youtobe_id', 'is_active', 'created_at')->where('is_active', '=', 1)->orderBy('created_at', 'DESC')->take(10)->get();
        $partners = Partner::select('id', 'image', 'image_url', 'is_active', 'created_at')->where('is_active', '=', 1)->orderBy('created_at', 'DESC')->take(10)->get();
        $contacts = Contact::select('id', 'address_' . $lang . ' as address', 'phone', 'email', 'started_at', 'stopped_at', 'created_at')->first();

        return view('frontend.app', ['mains' => $mains, 'news' => $news, 'news_show' => $news_show, 'galleries' => $galleries, 'partners' => $partners, 'contacts' => $contacts, 'lang' => $lang]);
    }
}
