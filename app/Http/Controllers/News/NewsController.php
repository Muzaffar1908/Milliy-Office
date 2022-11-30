<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\News;
use App\Models\News\NewsCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::select('id', 'user_id', 'cat_id', 'title_uz', 'news_image', 'is_active', 'created_at')->orderBy('created_at', 'DESC')->paginate(10);
        $users = User::select('id','user_name', 'created_at')->get();
        return view('admin.news.index', compact('news', 'users'));
    }

    public function is_active($id)
    {
        $update=News::find($id);
        if($update->is_active==1){
            $update->is_active=0;
        }else{
            $update->is_active=1;
        }
        $update->save();
        return redirect()->back();
    }

    public function create()
    {
        $users = User::select('id','user_name', 'created_at')->get();
        $news_cat = NewsCategory::get();
        return view('admin.news.create', compact('users', 'news_cat'));
    }

    public function store(Request $request)
    {
        $data = $request->except(array('_token'));
        $rule = array(
            'title_uz' => 'required|string|max:255',
        );

        $validator = Validator::make($data, $rule);

        if ($validator->fails()) {
            Session::flash('warning', $validator->messages());
            return redirect()->back();
        }

        $inputs = $request->all();
        if (!empty($inputs['id'])) {
            $news = News::findOrFail($inputs['id']);
        } else {
            $news = new News;
        }

        if ($inputs['slug'] == "") {
            $news_url = Str::slug($inputs['title_uz'], "-");
        } else {
            $news_url = Str::slug($inputs['slug'], "-");
        }

        $image = $request->file('news_image');
        if ($image) {
            $tmpFilePath = 'upload/news/';
            $hardPath =  Str::slug('news', '-') . '-' .$news_url. '-' . md5(time());
            $imagine = new \Imagine\Gd\Imagine();
            $image = $imagine->open($image);
            $thumbnail = $image->thumbnail(new \Imagine\Image\Box(450, 250));
            $thumbnail->save($tmpFilePath . $hardPath . '_thumbnail_450.png');
            $news->news_image = $hardPath;
        }

        $news->user_id = $inputs['user_id'];
        $news->cat_id = $inputs['cat_id'];
        $news->title_uz = $inputs['title_uz'];
        $news->title_ru = $inputs['title_ru'];
        $news->title_en = $inputs['title_en'];

        $news->description_uz = $inputs['description_uz'];
        if (!empty($news->description_uz)) {
            $dom_save_uz = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_uz->loadHtml('<?xml encoding="UTF-8">' . $news->description_uz, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $dom_image_save_uz = $dom_save_uz->getElementsByTagName('img');
            foreach ($dom_image_save_uz as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/news/description_image/uz_" .$news_url.'_'. time() . $k . '.jpg';
                    $path = public_path() . $image_name;
                    file_put_contents($path, $data);
                    $imagine = new \Imagine\Gd\Imagine();
                    $image = $imagine->open($path);
                    $bigImg = $image->thumbnail(new \Imagine\Image\Box(450, 250));
                    $bigImg->save($path);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $image_name);
                }
            }
            $news->description_uz = str_replace('<?xml encoding="UTF-8">', "", $dom_save_uz->saveHTML((new \DOMXPath($dom_save_uz))->query('/')->item(0)));

        }

        $news->description_ru = $inputs['description_ru'];
        if (!empty($news->description_ru)) {
            $dom_save_ru = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_ru->loadHtml('<?xml encoding="UTF-8">' . $news->description_ru, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $dom_image_save_ru = $dom_save_ru->getElementsByTagName('img');
            foreach ($dom_image_save_ru as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/news/description_image/ru_" .$news_url.'_'. time() . $k . '.jpg';
                    $path = public_path() . $image_name;
                    file_put_contents($path, $data);
                    $imagine = new \Imagine\Gd\Imagine();
                    $image = $imagine->open($path);
                    $bigImg = $image->thumbnail(new \Imagine\Image\Box(450, 250));
                    $bigImg->save($path);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $image_name);
                }
            }
            //fixed bug
            //dd(str_replace('<?xml encoding="UTF-8">', "", $dom_save_ru->saveHTML((new \DOMXPath($dom_save_ru))->query('/')->item(0))));
            $news->description_ru = str_replace('<?xml encoding="UTF-8">', "", $dom_save_ru->saveHTML((new \DOMXPath($dom_save_ru))->query('/')->item(0)));
        }

        $news->description_en = $inputs['description_en'];
        if (!empty($news->description_en)) {
            $dom_save_en = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_en->loadHtml('<?xml encoding="UTF-8">' . $news->description_en, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            //$dom_save_en->loadHTML($news->description_en);
            $dom_image_save_en = $dom_save_en->getElementsByTagName('img');
            foreach ($dom_image_save_en as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/news/description_image/en_" .$news_url.'_'. time() . $k . '.jpg';
                    $path = public_path() . $image_name;
                    file_put_contents($path, $data);
                    $imagine = new \Imagine\Gd\Imagine();
                    $image = $imagine->open($path);
                    $bigImg = $image->thumbnail(new \Imagine\Image\Box(450, 250));
                    $bigImg->save($path);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $image_name);
                }
            }
            $news->description_en = str_replace('<?xml encoding="UTF-8">', "", $dom_save_en->saveHTML((new \DOMXPath($dom_save_en))->query('/')->item(0)));
        }

        $news->save();

        if (!empty($inputs['id'])) {
            Session::flash('warning', __('ALL_CHANGES_SUCCESSFUL_SAVED'));
            return redirect('admin/news');
        } else {
            Session::flash('warning', __('ALL_SUCCESSFUL_SAVED'));
            return redirect('admin/news');
        }
    }

    public function edit($id)
    {
        $news = News::find($id);
        $users = User::select('id','user_name', 'created_at')->get();
        $news_cat = NewsCategory::select('id', 'user_id', 'title_uz')->get();
        return view('admin.news.edit', [
            'news' => $news,
            'users' => $users,
            'news_cat' => $news_cat,
        ]);
    }

    public function update(Request $request, News $news)
    {
        $data = $request->except(array('_token'));
        $rule = array(
            'title_uz' => 'required|string|max:255',
        );

        $validator = Validator::make($data, $rule);

        if ($validator->fails()) {
            Session::flash('warning', $validator->messages());
            return redirect()->back();
        }

        $inputs = $request->all();
        if (!empty($inputs['id'])) {
            $news = News::findOrFail($inputs['id']);
        } else {
            $news = new News;
        }

        if ($inputs['slug'] == "") {
            $news_url = Str::slug($inputs['title_uz'], "-");
        } else {
            $news_url = Str::slug($inputs['slug'], "-");
        }

        $image = $request->file('news_image');
        if ($image) {
            $tmpFilePath = 'upload/news/';
            $hardPath =  Str::slug('news', '-') . '-' .$news_url. '-' . md5(time());
            $imagine = new \Imagine\Gd\Imagine();
            $image = $imagine->open($image);
            $thumbnail = $image->thumbnail(new \Imagine\Image\Box(450, 250));
            $thumbnail->save($tmpFilePath . $hardPath . '_thumbnail_450.png');
            $news->news_image = $hardPath;
        }

        $news->user_id = $inputs['user_id'];
        $news->cat_id = $inputs['cat_id'];
        $news->title_uz = $inputs['title_uz'];
        $news->title_ru = $inputs['title_ru'];
        $news->title_en = $inputs['title_en'];

        $news->description_uz = $inputs['description_uz'];
        if (!empty($news->description_uz)) {
            $dom_save_uz = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_uz->loadHtml('<?xml encoding="UTF-8">' . $news->description_uz, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $dom_image_save_uz = $dom_save_uz->getElementsByTagName('img');
            foreach ($dom_image_save_uz as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/news/description_image/uz_" .$news_url.'_'. time() . $k . '.jpg';
                    $path = public_path() . $image_name;
                    file_put_contents($path, $data);
                    $imagine = new \Imagine\Gd\Imagine();
                    $image = $imagine->open($path);
                    $bigImg = $image->thumbnail(new \Imagine\Image\Box(450, 250));
                    $bigImg->save($path);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $image_name);
                }
            }
            $news->description_uz = str_replace('<?xml encoding="UTF-8">', "", $dom_save_uz->saveHTML((new \DOMXPath($dom_save_uz))->query('/')->item(0)));

        }

        $news->description_ru = $inputs['description_ru'];
        if (!empty($news->description_ru)) {
            $dom_save_ru = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_ru->loadHtml('<?xml encoding="UTF-8">' . $news->description_ru, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $dom_image_save_ru = $dom_save_ru->getElementsByTagName('img');
            foreach ($dom_image_save_ru as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/news/description_image/ru_" .$news_url.'_'. time() . $k . '.jpg';
                    $path = public_path() . $image_name;
                    file_put_contents($path, $data);
                    $imagine = new \Imagine\Gd\Imagine();
                    $image = $imagine->open($path);
                    $bigImg = $image->thumbnail(new \Imagine\Image\Box(450, 250));
                    $bigImg->save($path);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $image_name);
                }
            }
            //fixed bug
            //dd(str_replace('<?xml encoding="UTF-8">', "", $dom_save_ru->saveHTML((new \DOMXPath($dom_save_ru))->query('/')->item(0))));
            $news->description_ru = str_replace('<?xml encoding="UTF-8">', "", $dom_save_ru->saveHTML((new \DOMXPath($dom_save_ru))->query('/')->item(0)));
        }

        $news->description_en = $inputs['description_en'];
        if (!empty($news->description_en)) {
            $dom_save_en = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_en->loadHtml('<?xml encoding="UTF-8">' . $news->description_en, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            //$dom_save_en->loadHTML($news->description_en);
            $dom_image_save_en = $dom_save_en->getElementsByTagName('img');
            foreach ($dom_image_save_en as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/news/description_image/en_" .$news_url.'_'. time() . $k . '.jpg';
                    $path = public_path() . $image_name;
                    file_put_contents($path, $data);
                    $imagine = new \Imagine\Gd\Imagine();
                    $image = $imagine->open($path);
                    $bigImg = $image->thumbnail(new \Imagine\Image\Box(450, 250));
                    $bigImg->save($path);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $image_name);
                }
            }
            $news->description_en = str_replace('<?xml encoding="UTF-8">', "", $dom_save_en->saveHTML((new \DOMXPath($dom_save_en))->query('/')->item(0)));
        }

        $news->save();

        if (!empty($inputs['id'])) {
            Session::flash('warning', __('ALL_CHANGES_SUCCESSFUL_SAVED'));
            return redirect('admin/news');
        } else {
            Session::flash('warning', __('ALL_SUCCESSFUL_SAVED'));
            return redirect('admin/news');
        }
    }

    public function delete($id)
    {
        $news = News::find($id);
        // $image_path = public_path() . '/upload/news/' . $news->user_image . '-d.png';
        // unlink($image_path);
        $news->delete();
        return redirect('admin/news')->with('warning', 'NEWS TABLES DELETED');
    }
}


