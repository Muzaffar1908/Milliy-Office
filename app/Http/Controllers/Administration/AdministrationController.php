<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Models\Administration\Administration;
use App\Models\Position\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AdministrationController extends Controller
{
    public function index()
    {
        $administrations = Administration::select('id', 'user_id', 'pos_id', 'user_image', 'full_name_uz', 'email', 'phone', 'is_active', 'created_at')->orderBy('created_at', 'DESC')->paginate(10);
        $users = User::select('id','user_name', 'created_at')->get();
        $positions = Position::select('id','pos_name_uz', 'created_at')->get();
        return view('admin.administration.index', compact('administrations', 'users', 'positions'));
    }

    public function is_active($id)
    {
        $update = Administration::find($id);
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
        $positions = Position::select('id','pos_name_uz', 'created_at')->get();
        return view('admin.administration.create', compact('users', 'positions'));
    }

    public function store(Request $request)
    {
        $data = $request->except(array('_token'));
        $rule = array(
            'full_name_uz' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required',
            'title_uz' => 'required|string|max:255',
            'biography_uz' => 'required',
            'responsibilities_uz' => 'required',
        );

        $validator = Validator::make($data, $rule);

        if ($validator->fails()) {
            Session::flash('warning', $validator->messages());
            return redirect()->back();
        }

        $inputs = $request->all();
        if (!empty($inputs['id'])) {
            $administrations = Administration::findOrFail($inputs['id']);
        } else {
            $administrations = new Administration;
        }

        $image = $request->file('user_image');
        if ($image) {
            $tmpFilePath = 'upload/administration/';
            $hardPath =  Str::slug('administration', '-') . '-' . md5(time());
            $imagine = new \Imagine\Gd\Imagine();
            $image = $imagine->open($image);
            $thumbnail = $image->thumbnail(new \Imagine\Image\Box(550, 450));
            $thumbnail->save($tmpFilePath . $hardPath . '_thumbnail_550.png');
            $bigImg = $image->thumbnail(new \Imagine\Image\Box(1920, 1080));
            $bigImg->save($tmpFilePath . $hardPath . '_big_1920.png');
            $administrations->user_image = $hardPath;
        }

        $administrations->user_id = $inputs['user_id'];
        $administrations->pos_id = $inputs['pos_id'];
        $administrations->full_name_uz = $inputs['full_name_uz'];
        $administrations->full_name_ru = $inputs['full_name_ru'];
        $administrations->full_name_en = $inputs['full_name_en'];
        $administrations->email = $inputs['email'];
        $administrations->phone = $inputs['phone'];
        $administrations->title_uz = $inputs['title_uz'];
        $administrations->title_ru = $inputs['title_ru'];
        $administrations->title_en = $inputs['title_en'];

        $administrations->biography_uz = $inputs['biography_uz'];
        if (!empty($administrations->biography_uz)) {
            $dom_save_uz = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_uz->loadHtml('<?xml encoding="UTF-8">' . $administrations->biography_uz, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $dom_image_save_uz = $dom_save_uz->getElementsByTagName('img');
            foreach ($dom_image_save_uz as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/administrations/biography_image/uz_" . time() . $k . '.jpg';
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
            $administrations->biography_uz = str_replace('<?xml encoding="UTF-8">', "", $dom_save_uz->saveHTML((new \DOMXPath($dom_save_uz))->query('/')->item(0)));

        }

        $administrations->biography_ru = $inputs['biography_ru'];
        if (!empty($administrations->biography_ru)) {
            $dom_save_ru = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_ru->loadHtml('<?xml encoding="UTF-8">' . $administrations->biography_ru, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $dom_image_save_ru = $dom_save_ru->getElementsByTagName('img');
            foreach ($dom_image_save_ru as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/administrations/biography_image/ru_" . time() . $k . '.jpg';
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
            $administrations->biography_ru = str_replace('<?xml encoding="UTF-8">', "", $dom_save_ru->saveHTML((new \DOMXPath($dom_save_ru))->query('/')->item(0)));
        }

        $administrations->biography_en = $inputs['biography_en'];
        if (!empty($administrations->biography_en)) {
            $dom_save_en = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_en->loadHtml('<?xml encoding="UTF-8">' . $administrations->biography_en, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            //$dom_save_en->loadHTML($administrations->biography_en);
            $dom_image_save_en = $dom_save_en->getElementsByTagName('img');
            foreach ($dom_image_save_en as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/administrations/biography_image/en_" . time() . $k . '.jpg';
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
            $administrations->biography_en = str_replace('<?xml encoding="UTF-8">', "", $dom_save_en->saveHTML((new \DOMXPath($dom_save_en))->query('/')->item(0)));
        }

        $administrations->responsibilities_uz = $inputs['responsibilities_uz'];
        if (!empty($administrations->responsibilities_uz)) {
            $dom_save_uz = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_uz->loadHtml('<?xml encoding="UTF-8">' . $administrations->responsibilities_uz, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $dom_image_save_uz = $dom_save_uz->getElementsByTagName('img');
            foreach ($dom_image_save_uz as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/administrations/responsibilities_image/uz_" . time() . $k . '.jpg';
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
            $administrations->responsibilities_uz = str_replace('<?xml encoding="UTF-8">', "", $dom_save_uz->saveHTML((new \DOMXPath($dom_save_uz))->query('/')->item(0)));

        }

        $administrations->responsibilities_ru = $inputs['responsibilities_ru'];
        if (!empty($administrations->responsibilities_ru)) {
            $dom_save_ru = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_ru->loadHtml('<?xml encoding="UTF-8">' . $administrations->responsibilities_ru, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $dom_image_save_ru = $dom_save_ru->getElementsByTagName('img');
            foreach ($dom_image_save_ru as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/administrations/responsibilities_image/ru_" . time() . $k . '.jpg';
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
            $administrations->responsibilities_ru = str_replace('<?xml encoding="UTF-8">', "", $dom_save_ru->saveHTML((new \DOMXPath($dom_save_ru))->query('/')->item(0)));
        }

        $administrations->responsibilities_en = $inputs['responsibilities_en'];
        if (!empty($administrations->responsibilities_en)) {
            $dom_save_en = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_en->loadHtml('<?xml encoding="UTF-8">' . $administrations->responsibilities_en, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            //$dom_save_en->loadHTML($administrations->responsibilities_en);
            $dom_image_save_en = $dom_save_en->getElementsByTagName('img');
            foreach ($dom_image_save_en as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/administrations/responsibilities_image/en_" . time() . $k . '.jpg';
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
            $administrations->responsibilities_en = str_replace('<?xml encoding="UTF-8">', "", $dom_save_en->saveHTML((new \DOMXPath($dom_save_en))->query('/')->item(0)));
        }

        $administrations->save();

        if (!empty($inputs['id'])) {
            Session::flash('warning', __('ALL_CHANGES_SUCCESSFUL_SAVED'));
            return redirect('admin/administration');
        } else {
            Session::flash('warning', __('ALL_SUCCESSFUL_SAVED'));
            return redirect('admin/administration');
        }
    }

    public function edit($id)
    {
        $administration = Administration::find($id);
        $users = User::select('id','user_name', 'created_at')->get();
        $positions = Position::select('id','pos_name_uz', 'created_at')->get();
        return view('admin.administration.edit', [
            'administration' => $administration,
            'users' => $users,
            'positions' => $positions,
        ]);
    }

    public function update(Request $request, Administration $administrations)
    {
        $data = $request->except(array('_token'));
        $rule = array(
            'full_name_uz' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required',
            'title_uz' => 'required|string|max:255',
            'biography_uz' => 'required',
            'responsibilities_uz' => 'required',
        );

        $validator = Validator::make($data, $rule);

        if ($validator->fails()) {
            Session::flash('warning', $validator->messages());
            return redirect()->back();
        }

        $inputs = $request->all();
        if (!empty($inputs['id'])) {
            $administrations = Administration::findOrFail($inputs['id']);
        } else {
            $administrations = new Administration;
        }

        $image = $request->file('user_image');
        if ($image) {
            $tmpFilePath = 'upload/administration/';
            $hardPath =  Str::slug('administration', '-') . '-' . md5(time());
            $imagine = new \Imagine\Gd\Imagine();
            $image = $imagine->open($image);
            $thumbnail = $image->thumbnail(new \Imagine\Image\Box(550, 450));
            $thumbnail->save($tmpFilePath . $hardPath . '_thumbnail_550.png');
            $bigImg = $image->thumbnail(new \Imagine\Image\Box(1920, 1080));
            $bigImg->save($tmpFilePath . $hardPath . '_big_1920.png');
            $administrations->user_image = $hardPath;
        }

        $administrations->user_id = $inputs['user_id'];
        $administrations->pos_id = $inputs['pos_id'];
        $administrations->full_name_uz = $inputs['full_name_uz'];
        $administrations->full_name_ru = $inputs['full_name_ru'];
        $administrations->full_name_en = $inputs['full_name_en'];
        $administrations->email = $inputs['email'];
        $administrations->phone = $inputs['phone'];
        $administrations->title_uz = $inputs['title_uz'];
        $administrations->title_ru = $inputs['title_ru'];
        $administrations->title_en = $inputs['title_en'];

        $administrations->biography_uz = $inputs['biography_uz'];
        if (!empty($administrations->biography_uz)) {
            $dom_save_uz = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_uz->loadHtml('<?xml encoding="UTF-8">' . $administrations->biography_uz, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $dom_image_save_uz = $dom_save_uz->getElementsByTagName('img');
            foreach ($dom_image_save_uz as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/administrations/biography_image/uz_" . time() . $k . '.jpg';
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
            $administrations->biography_uz = str_replace('<?xml encoding="UTF-8">', "", $dom_save_uz->saveHTML((new \DOMXPath($dom_save_uz))->query('/')->item(0)));

        }

        $administrations->biography_ru = $inputs['biography_ru'];
        if (!empty($administrations->biography_ru)) {
            $dom_save_ru = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_ru->loadHtml('<?xml encoding="UTF-8">' . $administrations->biography_ru, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $dom_image_save_ru = $dom_save_ru->getElementsByTagName('img');
            foreach ($dom_image_save_ru as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/administrations/biography_image/ru_" . time() . $k . '.jpg';
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
            $administrations->biography_ru = str_replace('<?xml encoding="UTF-8">', "", $dom_save_ru->saveHTML((new \DOMXPath($dom_save_ru))->query('/')->item(0)));
        }

        $administrations->biography_en = $inputs['biography_en'];
        if (!empty($administrations->biography_en)) {
            $dom_save_en = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_en->loadHtml('<?xml encoding="UTF-8">' . $administrations->biography_en, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            //$dom_save_en->loadHTML($administrations->biography_en);
            $dom_image_save_en = $dom_save_en->getElementsByTagName('img');
            foreach ($dom_image_save_en as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/administrations/biography_image/en_" . time() . $k . '.jpg';
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
            $administrations->biography_en = str_replace('<?xml encoding="UTF-8">', "", $dom_save_en->saveHTML((new \DOMXPath($dom_save_en))->query('/')->item(0)));
        }

        $administrations->responsibilities_uz = $inputs['responsibilities_uz'];
        if (!empty($administrations->responsibilities_uz)) {
            $dom_save_uz = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_uz->loadHtml('<?xml encoding="UTF-8">' . $administrations->responsibilities_uz, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $dom_image_save_uz = $dom_save_uz->getElementsByTagName('img');
            foreach ($dom_image_save_uz as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/administrations/responsibilities_image/uz_" . time() . $k . '.jpg';
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
            $administrations->responsibilities_uz = str_replace('<?xml encoding="UTF-8">', "", $dom_save_uz->saveHTML((new \DOMXPath($dom_save_uz))->query('/')->item(0)));

        }

        $administrations->responsibilities_ru = $inputs['responsibilities_ru'];
        if (!empty($administrations->responsibilities_ru)) {
            $dom_save_ru = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_ru->loadHtml('<?xml encoding="UTF-8">' . $administrations->responsibilities_ru, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $dom_image_save_ru = $dom_save_ru->getElementsByTagName('img');
            foreach ($dom_image_save_ru as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/administrations/responsibilities_image/ru_" . time() . $k . '.jpg';
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
            $administrations->responsibilities_ru = str_replace('<?xml encoding="UTF-8">', "", $dom_save_ru->saveHTML((new \DOMXPath($dom_save_ru))->query('/')->item(0)));
        }

        $administrations->responsibilities_en = $inputs['responsibilities_en'];
        if (!empty($administrations->responsibilities_en)) {
            $dom_save_en = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_en->loadHtml('<?xml encoding="UTF-8">' . $administrations->responsibilities_en, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            //$dom_save_en->loadHTML($administrations->responsibilities_en);
            $dom_image_save_en = $dom_save_en->getElementsByTagName('img');
            foreach ($dom_image_save_en as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/administrations/responsibilities_image/en_" . time() . $k . '.jpg';
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
            $administrations->responsibilities_en = str_replace('<?xml encoding="UTF-8">', "", $dom_save_en->saveHTML((new \DOMXPath($dom_save_en))->query('/')->item(0)));
        }

        $administrations->save();

        if (!empty($inputs['id'])) {
            Session::flash('warning', __('ALL_CHANGES_SUCCESSFUL_SAVED'));
            return redirect('admin/administration');
        } else {
            Session::flash('warning', __('ALL_SUCCESSFUL_SAVED'));
            return redirect('admin/administration');
        }
    }

    public function delete($id)
    {
        $administration = Administration::findOrFail($id);
        // $image_path = public_path() . '/upload/main/' . $administration->user_image . '-d.png';
        // unlink($image_path);
        $administration->delete();
        return redirect('admin/administration')->with('warning', 'ADMINISTRATION TABLES DELETED');
    }
}
