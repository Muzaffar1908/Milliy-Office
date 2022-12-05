<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Main\Main;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class MainController extends Controller
{
    public function index()
    {
        $mains = Main::select('id', 'user_id', 'title_uz', 'logo_title_uz', 'youtobe_id', 'background_image', 'is_active', 'created_at')->orderBy('created_at', 'DESC')->paginate(5);
        $users = User::select('id','user_name', 'created_at')->get();
        return view('admin.main.index', compact('mains', 'users'));
    }

    public function is_active($id)
    {
        $update=Main::find($id);
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
        $users = User::select('id', 'user_name', 'created_at')->get();
        return view('admin.main.create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->except(array('_token'));
        $rule = array(
            'logo_title_uz' => 'required|string|max:255',
            'title_uz' => 'required|string|max:255',
            'description_uz' => 'required',
            'youtobe_id' => 'required|string',
        );

        $validator = Validator::make($data, $rule);

        if ($validator->fails()) {
            Session::flash('warning', $validator->messages());
            return redirect()->back();
        }

        $inputs = $request->all();
        if (!empty($inputs['id'])) {
            $main = Main::findOrFail($inputs['id']);
        } else {
            $main = new Main;
        }

        $image = $request->file('background_image');
        if ($image) {
            $tmpFilePath = 'upload/main/';
            $hardPath =  Str::slug('main', '-') . '-' . md5(time());
            $imagine = new \Imagine\Gd\Imagine();
            $image = $imagine->open($image);
            $thumbnail = $image->thumbnail(new \Imagine\Image\Box(1920, 1080));
            $thumbnail->save($tmpFilePath . $hardPath . '_big_1920.png');
            $main->background_image = $hardPath;
        }

        $main->user_id = $inputs['user_id'];
        $main->title_uz = $inputs['title_uz'];
        $main->title_ru = $inputs['title_ru'];
        $main->title_en = $inputs['title_en'];
        $main->youtobe_id = $inputs['youtobe_id'];

        $main->description_uz = $inputs['description_uz'];
        if (!empty($main->description_uz)) {
            $dom_save_uz = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_uz->loadHtml('<?xml encoding="UTF-8">' . $main->description_uz, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $dom_image_save_uz = $dom_save_uz->getElementsByTagName('img');
            foreach ($dom_image_save_uz as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/main/description_image/uz_" . time() . $k . '.jpg';
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
            $main->description_uz = str_replace('<?xml encoding="UTF-8">', "", $dom_save_uz->saveHTML((new \DOMXPath($dom_save_uz))->query('/')->item(0)));

        }

        $main->description_ru = $inputs['description_ru'];
        if (!empty($main->description_ru)) {
            $dom_save_ru = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_ru->loadHtml('<?xml encoding="UTF-8">' . $main->description_ru, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $dom_image_save_ru = $dom_save_ru->getElementsByTagName('img');
            foreach ($dom_image_save_ru as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/main/description_image/ru_" . time() . $k . '.jpg';
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
            $main->description_ru = str_replace('<?xml encoding="UTF-8">', "", $dom_save_ru->saveHTML((new \DOMXPath($dom_save_ru))->query('/')->item(0)));
        }

        $main->description_en = $inputs['description_en'];
        if (!empty($main->description_en)) {
            $dom_save_en = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_en->loadHtml('<?xml encoding="UTF-8">' . $main->description_en, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            //$dom_save_en->loadHTML($main->description_en);
            $dom_image_save_en = $dom_save_en->getElementsByTagName('img');
            foreach ($dom_image_save_en as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/main/description_image/en_" . time() . $k . '.jpg';
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
            $main->description_en = str_replace('<?xml encoding="UTF-8">', "", $dom_save_en->saveHTML((new \DOMXPath($dom_save_en))->query('/')->item(0)));
        }

        $main->save();

        if (!empty($inputs['id'])) {
            Session::flash('warning', __('ALL_CHANGES_SUCCESSFUL_SAVED'));
            return redirect('admin/main');
        } else {
            Session::flash('warning', __('ALL_SUCCESSFUL_SAVED'));
            return redirect('admin/main');
        }
    }


    public function edit($id)
    {
        $main = Main::find($id);
        $users = User::select('id','user_name', 'created_at')->get();
        return view('admin.main.edit', [
            'main' => $main,
            'users' => $users,
        ]);
    }

    public function update(Request $request, Main $main)
    {
        $data = $request->except(array('_token'));
        $rule = array(
            'logo_title_uz' => 'required|string|max:255',
            'title_uz' => 'required|string|max:255',
            'description_uz' => 'required',
            // 'background_image' => 'required|mimes:png,jpg,jpeg',
            // 'youtobe_id' => 'required|string',
        );

        $validator = Validator::make($data, $rule);

        if ($validator->fails()) {
            Session::flash('warning', $validator->messages());
            return redirect()->back();
        }

        $inputs = $request->all();
        if (!empty($inputs['id'])) {
            $main = Main::findOrFail($inputs['id']);
        } else {
            $main = new Main;
        }

        $image = $request->file('background_image');
        if ($image) {
            $tmpFilePath = 'upload/main/';
            $hardPath =  Str::slug('main', '-') . '-' . md5(time());
            $imagine = new \Imagine\Gd\Imagine();
            $image = $imagine->open($image);
            $thumbnail = $image->thumbnail(new \Imagine\Image\Box(1920, 1080));
            $thumbnail->save($tmpFilePath . $hardPath . '_big_1920.png');
            $main->background_image = $hardPath;
        }

        $main->user_id = $inputs['user_id'];
        $main->title_uz = $inputs['title_uz'];
        $main->title_ru = $inputs['title_ru'];
        $main->title_en = $inputs['title_en'];
        $main->youtobe_id = $inputs['youtobe_id'];

        $main->description_uz = $inputs['description_uz'];
        if (!empty($main->description_uz)) {
            $dom_save_uz = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_uz->loadHtml('<?xml encoding="UTF-8">' . $main->description_uz, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $dom_image_save_uz = $dom_save_uz->getElementsByTagName('img');
            foreach ($dom_image_save_uz as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/main/description_image/uz_" . time() . $k . '.jpg';
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
            $main->description_uz = str_replace('<?xml encoding="UTF-8">', "", $dom_save_uz->saveHTML((new \DOMXPath($dom_save_uz))->query('/')->item(0)));

        }

        $main->description_ru = $inputs['description_ru'];
        if (!empty($main->description_ru)) {
            $dom_save_ru = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_ru->loadHtml('<?xml encoding="UTF-8">' . $main->description_ru, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $dom_image_save_ru = $dom_save_ru->getElementsByTagName('img');
            foreach ($dom_image_save_ru as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/main/description_image/ru_" . time() . $k . '.jpg';
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
            $main->description_ru = str_replace('<?xml encoding="UTF-8">', "", $dom_save_ru->saveHTML((new \DOMXPath($dom_save_ru))->query('/')->item(0)));
        }

        $main->description_en = $inputs['description_en'];
        if (!empty($main->description_en)) {
            $dom_save_en = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_en->loadHtml('<?xml encoding="UTF-8">' . $main->description_en, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            //$dom_save_en->loadHTML($main->description_en);
            $dom_image_save_en = $dom_save_en->getElementsByTagName('img');
            foreach ($dom_image_save_en as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/main/description_image/en_" . time() . $k . '.jpg';
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
            $main->description_en = str_replace('<?xml encoding="UTF-8">', "", $dom_save_en->saveHTML((new \DOMXPath($dom_save_en))->query('/')->item(0)));
        }

        $main->save();

        if (!empty($inputs['id'])) {
            Session::flash('warning', __('ALL_CHANGES_SUCCESSFUL_SAVED'));
            return redirect('admin/main');
        } else {
            Session::flash('warning', __('ALL_SUCCESSFUL_SAVED'));
            return redirect('admin/main');
        }

    }

    public function delete($id)
    {
        $main = Main::findOrFail($id);
        // $image_path = public_path() . '/upload/main/' . $main->user_image . '-d.png';
        // unlink($image_path);
        $main->delete();
        return redirect('admin/main')->with('warning', 'NEWS TABLES DELETED');
    }

    
    
}
