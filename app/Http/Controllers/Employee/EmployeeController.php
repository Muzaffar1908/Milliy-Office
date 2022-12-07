<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Department\Department;
use App\Models\Employee\Employee;
use App\Models\Position\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::select('id', 'user_id', 'pos_id', 'dep_id', 'full_name_uz', 'is_active', 'created_at')->orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.employee.index', compact('employees'));
    }

    public function create()
    {
        $users = User::select('id','user_name', 'created_at')->get();
        $positions = Position::select('id', 'pos_name_uz', 'created_at')->get();
        return view('admin.employee.create', compact('users', 'positions'));
    }

    public function create_division()
    {
        $users = User::select('id','user_name', 'created_at')->get();
        $departments = Department::select('id', 'dep_name_uz', 'created_at')->get();
        return view('admin.employee.create_division', compact('users', 'departments'));
    }

    public function create_employee()
    {
        $users = User::select('id','user_name', 'created_at')->get();
        $positions = Position::select('id', 'pos_name_uz', 'created_at')->get();
        $departments = Department::select('id', 'dep_name_uz', 'created_at')->get();
        return view('admin.employee.create_employee', compact('users', 'positions', 'departments'));
    }

    public function store(Request $request)
    {
        $data = $request->except(array('_token'));
        $rule = array(
            'full_name_uz' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required',
            'code' => 'required',
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
            $employees = Employee::findOrFail($inputs['id']);
        } else {
            $employees = new Employee;
        }

        if ($inputs['slug'] == "") {
            $employee_url = Str::slug($inputs['full_name_uz'], "-");
        } else {
            $employee_url = Str::slug($inputs['slug'], "-");
        }

        $image = $request->file('user_image');
        if ($image) {
            $tmpFilePath = 'upload/employee/';
            $hardPath =  Str::slug('employee', '-') . '-' .$employee_url. '-' . md5(time());
            $imagine = new \Imagine\Gd\Imagine();
            $image = $imagine->open($image);
            $thumbnail = $image->thumbnail(new \Imagine\Image\Box(550, 450));
            $thumbnail->save($tmpFilePath . $hardPath . '_thumbnail_550.png');
            $bigImg = $image->thumbnail(new \Imagine\Image\Box(1920, 1080));
            $bigImg->save($tmpFilePath . $hardPath . '_big_1920.png');
            $employees->user_image = $hardPath;
        }

        $employees->user_id = $inputs['user_id'];
        $employees->pos_id = $inputs['pos_id'];
        $employees->full_name_uz = $inputs['full_name_uz'];
        $employees->full_name_ru = $inputs['full_name_ru'];
        $employees->full_name_en = $inputs['full_name_en'];
        $employees->email = $inputs['email'];
        $employees->phone = $inputs['phone'];
        $employees->code = $inputs['code'];
        $employees->title_uz = $inputs['title_uz'];
        $employees->title_ru = $inputs['title_ru'];
        $employees->title_en = $inputs['title_en'];

        $employees->biography_uz = $inputs['biography_uz'];
        if (!empty($employees->biography_uz)) {
            $dom_save_uz = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_uz->loadHtml('<?xml encoding="UTF-8">' . $employees->biography_uz, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $dom_image_save_uz = $dom_save_uz->getElementsByTagName('img');
            foreach ($dom_image_save_uz as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/employee/biography_image/uz_" .$employee_url.'_'. time() . $k . '.jpg';
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
            $employees->biography_uz = str_replace('<?xml encoding="UTF-8">', "", $dom_save_uz->saveHTML((new \DOMXPath($dom_save_uz))->query('/')->item(0)));

        }

        $employees->biography_ru = $inputs['biography_ru'];
        if (!empty($employees->biography_ru)) {
            $dom_save_ru = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_ru->loadHtml('<?xml encoding="UTF-8">' . $employees->biography_ru, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $dom_image_save_ru = $dom_save_ru->getElementsByTagName('img');
            foreach ($dom_image_save_ru as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/employee/biography_image/ru_" .$employee_url.'_'. time() . $k . '.jpg';
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
            $employees->biography_ru = str_replace('<?xml encoding="UTF-8">', "", $dom_save_ru->saveHTML((new \DOMXPath($dom_save_ru))->query('/')->item(0)));
        }

        $employees->biography_en = $inputs['biography_en'];
        if (!empty($employees->biography_en)) {
            $dom_save_en = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_en->loadHtml('<?xml encoding="UTF-8">' . $employees->biography_en, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            //$dom_save_en->loadHTML($employees->biography_en);
            $dom_image_save_en = $dom_save_en->getElementsByTagName('img');
            foreach ($dom_image_save_en as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/employee/biography_image/en_" .$employee_url.'_'. time() . $k . '.jpg';
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
            $employees->biography_en = str_replace('<?xml encoding="UTF-8">', "", $dom_save_en->saveHTML((new \DOMXPath($dom_save_en))->query('/')->item(0)));
        }

        $employees->responsibilities_uz = $inputs['responsibilities_uz'];
        if (!empty($employees->responsibilities_uz)) {
            $dom_save_uz = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_uz->loadHtml('<?xml encoding="UTF-8">' . $employees->responsibilities_uz, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $dom_image_save_uz = $dom_save_uz->getElementsByTagName('img');
            foreach ($dom_image_save_uz as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/employee/responsibilities_image/uz_" .$employee_url.'_'. time() . $k . '.jpg';
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
            $employees->responsibilities_uz = str_replace('<?xml encoding="UTF-8">', "", $dom_save_uz->saveHTML((new \DOMXPath($dom_save_uz))->query('/')->item(0)));

        }

        $employees->responsibilities_ru = $inputs['responsibilities_ru'];
        if (!empty($employees->responsibilities_ru)) {
            $dom_save_ru = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_ru->loadHtml('<?xml encoding="UTF-8">' . $employees->responsibilities_ru, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $dom_image_save_ru = $dom_save_ru->getElementsByTagName('img');
            foreach ($dom_image_save_ru as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/employee/responsibilities_image/ru_" .$employee_url.'_'. time() . $k . '.jpg';
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
            $employees->responsibilities_ru = str_replace('<?xml encoding="UTF-8">', "", $dom_save_ru->saveHTML((new \DOMXPath($dom_save_ru))->query('/')->item(0)));
        }

        $employees->responsibilities_en = $inputs['responsibilities_en'];
        if (!empty($employees->responsibilities_en)) {
            $dom_save_en = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_en->loadHtml('<?xml encoding="UTF-8">' . $employees->responsibilities_en, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            //$dom_save_en->loadHTML($employees->responsibilities_en);
            $dom_image_save_en = $dom_save_en->getElementsByTagName('img');
            foreach ($dom_image_save_en as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/employee/responsibilities_image/en_" .$employee_url.'_'. time() . $k . '.jpg';
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
            $employees->responsibilities_en = str_replace('<?xml encoding="UTF-8">', "", $dom_save_en->saveHTML((new \DOMXPath($dom_save_en))->query('/')->item(0)));
        }

        $employees->save();

        if (!empty($inputs['id'])) {
            Session::flash('warning', __('ALL_CHANGES_SUCCESSFUL_SAVED'));
            return redirect('admin/employee');
        } else {
            Session::flash('warning', __('ALL_SUCCESSFUL_SAVED'));
            return redirect('admin/employee');
        }
    }


    public function store_division(Request $request)
    {
        $data = $request->except(array('_token'));
        $rule = array(
            'full_name_uz' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required',
            'code' => 'required',
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
            $employees = Employee::findOrFail($inputs['id']);
        } else {
            $employees = new Employee;
        }

        $image = $request->file('user_image');
        if ($image) {
            $tmpFilePath = 'upload/employee/division/';
            $hardPath =  Str::slug('employee', '-') . '-' . md5(time());
            $imagine = new \Imagine\Gd\Imagine();
            $image = $imagine->open($image);
            $thumbnail = $image->thumbnail(new \Imagine\Image\Box(550, 450));
            $thumbnail->save($tmpFilePath . $hardPath . '_thumbnail_550.png');
            $bigImg = $image->thumbnail(new \Imagine\Image\Box(1920, 1080));
            $bigImg->save($tmpFilePath . $hardPath . '_big_1920.png');
            $employees->user_image = $hardPath;
        }

        $employees->user_id = $inputs['user_id'];
        $employees->dep_id = $inputs['dep_id'];
        $employees->full_name_uz = $inputs['full_name_uz'];
        $employees->full_name_ru = $inputs['full_name_ru'];
        $employees->full_name_en = $inputs['full_name_en'];
        $employees->email = $inputs['email'];
        $employees->phone = $inputs['phone'];
        $employees->code = $inputs['code'];
        $employees->number_of_members = $inputs['number_of_members'];

        $employees->biography_uz = $inputs['biography_uz'];
        if (!empty($employees->biography_uz)) {
            $dom_save_uz = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_uz->loadHtml('<?xml encoding="UTF-8">' . $employees->biography_uz, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $dom_image_save_uz = $dom_save_uz->getElementsByTagName('img');
            foreach ($dom_image_save_uz as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/employee/division/biography_image/uz_" . time() . $k . '.jpg';
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
            $employees->biography_uz = str_replace('<?xml encoding="UTF-8">', "", $dom_save_uz->saveHTML((new \DOMXPath($dom_save_uz))->query('/')->item(0)));

        }

        $employees->biography_ru = $inputs['biography_ru'];
        if (!empty($employees->biography_ru)) {
            $dom_save_ru = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_ru->loadHtml('<?xml encoding="UTF-8">' . $employees->biography_ru, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $dom_image_save_ru = $dom_save_ru->getElementsByTagName('img');
            foreach ($dom_image_save_ru as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/employee/division/biography_image/ru_" . time() . $k . '.jpg';
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
            $employees->biography_ru = str_replace('<?xml encoding="UTF-8">', "", $dom_save_ru->saveHTML((new \DOMXPath($dom_save_ru))->query('/')->item(0)));
        }

        $employees->biography_en = $inputs['biography_en'];
        if (!empty($employees->biography_en)) {
            $dom_save_en = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_en->loadHtml('<?xml encoding="UTF-8">' . $employees->biography_en, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            //$dom_save_en->loadHTML($employees->biography_en);
            $dom_image_save_en = $dom_save_en->getElementsByTagName('img');
            foreach ($dom_image_save_en as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/employee/division/biography_image/en_" . time() . $k . '.jpg';
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
            $employees->biography_en = str_replace('<?xml encoding="UTF-8">', "", $dom_save_en->saveHTML((new \DOMXPath($dom_save_en))->query('/')->item(0)));
        }

        $employees->responsibilities_uz = $inputs['responsibilities_uz'];
        if (!empty($employees->responsibilities_uz)) {
            $dom_save_uz = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_uz->loadHtml('<?xml encoding="UTF-8">' . $employees->responsibilities_uz, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $dom_image_save_uz = $dom_save_uz->getElementsByTagName('img');
            foreach ($dom_image_save_uz as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/employee/division/responsibilities_image/uz_" . time() . $k . '.jpg';
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
            $employees->responsibilities_uz = str_replace('<?xml encoding="UTF-8">', "", $dom_save_uz->saveHTML((new \DOMXPath($dom_save_uz))->query('/')->item(0)));

        }

        $employees->responsibilities_ru = $inputs['responsibilities_ru'];
        if (!empty($employees->responsibilities_ru)) {
            $dom_save_ru = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_ru->loadHtml('<?xml encoding="UTF-8">' . $employees->responsibilities_ru, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $dom_image_save_ru = $dom_save_ru->getElementsByTagName('img');
            foreach ($dom_image_save_ru as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/employee/division/responsibilities_image/ru_" . time() . $k . '.jpg';
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
            $employees->responsibilities_ru = str_replace('<?xml encoding="UTF-8">', "", $dom_save_ru->saveHTML((new \DOMXPath($dom_save_ru))->query('/')->item(0)));
        }

        $employees->responsibilities_en = $inputs['responsibilities_en'];
        if (!empty($employees->responsibilities_en)) {
            $dom_save_en = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_en->loadHtml('<?xml encoding="UTF-8">' . $employees->responsibilities_en, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            //$dom_save_en->loadHTML($employees->responsibilities_en);
            $dom_image_save_en = $dom_save_en->getElementsByTagName('img');
            foreach ($dom_image_save_en as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/employee/division/responsibilities_image/en_" . time() . $k . '.jpg';
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
            $employees->responsibilities_en = str_replace('<?xml encoding="UTF-8">', "", $dom_save_en->saveHTML((new \DOMXPath($dom_save_en))->query('/')->item(0)));
        }

        $employees->save();

        if (!empty($inputs['id'])) {
            Session::flash('warning', __('ALL_CHANGES_SUCCESSFUL_SAVED'));
            return redirect('admin/employee');
        } else {
            Session::flash('warning', __('ALL_SUCCESSFUL_SAVED'));
            return redirect('admin/employee');
        }
    }


    public function store_employee(Request $request)
    {
        $data = $request->except(array('_token'));
        $rule = array(
            'full_name_uz' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required',
            'code' => 'required',
        );

        $validator = Validator::make($data, $rule);

        if ($validator->fails()) {
            Session::flash('warning', $validator->messages());
            return redirect()->back();
        }

        $inputs = $request->all();
        if (!empty($inputs['id'])) {
            $employees = Employee::findOrFail($inputs['id']);
        } else {
            $employees = new Employee;
        }

        $image = $request->file('user_image');
        if ($image) {
            $tmpFilePath = 'upload/employee/employ/';
            $hardPath =  Str::slug('employee', '-') . '-' . md5(time());
            $imagine = new \Imagine\Gd\Imagine();
            $image = $imagine->open($image);
            $thumbnail = $image->thumbnail(new \Imagine\Image\Box(550, 450));
            $thumbnail->save($tmpFilePath . $hardPath . '_thumbnail_550.png');
            $bigImg = $image->thumbnail(new \Imagine\Image\Box(1920, 1080));
            $bigImg->save($tmpFilePath . $hardPath . '_big_1920.png');
            $employees->user_image = $hardPath;
        }

        $employees->user_id = $inputs['user_id'];
        $employees->dep_id = $inputs['dep_id'];
        $employees->pos_id = $inputs['pos_id'];
        $employees->full_name_uz = $inputs['full_name_uz'];
        $employees->full_name_ru = $inputs['full_name_ru'];
        $employees->full_name_en = $inputs['full_name_en'];
        $employees->email = $inputs['email'];
        $employees->phone = $inputs['phone'];
        $employees->code = $inputs['code'];
        $employees->save();
        
        if (!empty($inputs['id'])) {
            Session::flash('warning', __('ALL_CHANGES_SUCCESSFUL_SAVED'));
            return redirect('admin/employee');
        } else {
            Session::flash('warning', __('ALL_SUCCESSFUL_SAVED'));
            return redirect('admin/employee');
        }
    }


    public function edit($id)
    {
        $employee = Employee::find($id);
        $users = User::select('id','user_name', 'created_at')->get();
        $positions = Position::select('id','pos_name_uz', 'created_at')->get();
        return view('admin.employee.edit', [
            'employee' => $employee,
            'users' => $users,
            'positions' => $positions,
        ]);
    }

    public function edit_division($id)
    {
        $employee = Employee::find($id);
        $users = User::select('id','user_name', 'created_at')->get();
        $department = Department::select('id','dep_name_uz', 'created_at')->get();
        return view('admin.employee.edit_division', [
            'employee' => $employee,
            'users' => $users,
            'department' => $department,
        ]);
    }

    public function edit_employee($id)
    {
        $employee = Employee::find($id);
        $users = User::select('id','user_name', 'created_at')->get();
        $positions = Position::select('id','pos_name_uz', 'created_at')->get();
        $departments = Department::select('id','dep_name_uz', 'created_at')->get();
        return view('admin.employee.edit_employee', [
            'employee' => $employee,
            'users' => $users,
            'positions' => $positions,
            'departments' => $departments,
        ]);
    }


    public function update(Request $request, Employee $employees)
    {
        $data = $request->except(array('_token'));
        $rule = array(
            'full_name_uz' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required',
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
            $employees = Employee::findOrFail($inputs['id']);
        } else {
            $employees = new Employee;
        }

        if ($inputs['slug'] == "") {
            $employee_url = Str::slug($inputs['full_name_uz'], "-");
        } else {
            $employee_url = Str::slug($inputs['slug'], "-");
        }

        $image = $request->file('user_image');
        if ($image) {
            $tmpFilePath = 'upload/employee/';
            $hardPath =  Str::slug('employee', '-') . '-' .$employee_url.'-'. md5(time());
            $imagine = new \Imagine\Gd\Imagine();
            $image = $imagine->open($image);
            $thumbnail = $image->thumbnail(new \Imagine\Image\Box(550, 450));
            $thumbnail->save($tmpFilePath . $hardPath . '_thumbnail_550.png');
            $bigImg = $image->thumbnail(new \Imagine\Image\Box(1920, 1080));
            $bigImg->save($tmpFilePath . $hardPath . '_big_1920.png');
            $employees->user_image = $hardPath;
        }

        $employees->user_id = $inputs['user_id'];
        $employees->pos_id = $inputs['pos_id'];
        $employees->full_name_uz = $inputs['full_name_uz'];
        $employees->full_name_ru = $inputs['full_name_ru'];
        $employees->full_name_en = $inputs['full_name_en'];
        $employees->email = $inputs['email'];
        $employees->phone = $inputs['phone'];
        $employees->code = $inputs['code'];
        $employees->title_uz = $inputs['title_uz'];
        $employees->title_ru = $inputs['title_ru'];
        $employees->title_en = $inputs['title_en'];

        $employees->biography_uz = $inputs['biography_uz'];
        if (!empty($employees->biography_uz)) {
            $dom_save_uz = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_uz->loadHtml('<?xml encoding="UTF-8">' . $employees->biography_uz, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $dom_image_save_uz = $dom_save_uz->getElementsByTagName('img');
            foreach ($dom_image_save_uz as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/employee/biography_image/uz_" .$employee_url.'_'. time() . $k . '.jpg';
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
            $employees->biography_uz = str_replace('<?xml encoding="UTF-8">', "", $dom_save_uz->saveHTML((new \DOMXPath($dom_save_uz))->query('/')->item(0)));

        }

        $employees->biography_ru = $inputs['biography_ru'];
        if (!empty($employees->biography_ru)) {
            $dom_save_ru = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_ru->loadHtml('<?xml encoding="UTF-8">' . $employees->biography_ru, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $dom_image_save_ru = $dom_save_ru->getElementsByTagName('img');
            foreach ($dom_image_save_ru as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/employee/biography_image/ru_" .$employee_url.'_'. time() . $k . '.jpg';
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
            $employees->biography_ru = str_replace('<?xml encoding="UTF-8">', "", $dom_save_ru->saveHTML((new \DOMXPath($dom_save_ru))->query('/')->item(0)));
        }

        $employees->biography_en = $inputs['biography_en'];
        if (!empty($employees->biography_en)) {
            $dom_save_en = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_en->loadHtml('<?xml encoding="UTF-8">' . $employees->biography_en, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            //$dom_save_en->loadHTML($employees->biography_en);
            $dom_image_save_en = $dom_save_en->getElementsByTagName('img');
            foreach ($dom_image_save_en as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/employee/biography_image/en_" .$employee_url.'_'. time() . $k . '.jpg';
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
            $employees->biography_en = str_replace('<?xml encoding="UTF-8">', "", $dom_save_en->saveHTML((new \DOMXPath($dom_save_en))->query('/')->item(0)));
        }

        $employees->responsibilities_uz = $inputs['responsibilities_uz'];
        if (!empty($employees->responsibilities_uz)) {
            $dom_save_uz = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_uz->loadHtml('<?xml encoding="UTF-8">' . $employees->responsibilities_uz, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $dom_image_save_uz = $dom_save_uz->getElementsByTagName('img');
            foreach ($dom_image_save_uz as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/employee/responsibilities_image/uz_" .$employee_url.'_'. time() . $k . '.jpg';
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
            $employees->responsibilities_uz = str_replace('<?xml encoding="UTF-8">', "", $dom_save_uz->saveHTML((new \DOMXPath($dom_save_uz))->query('/')->item(0)));

        }

        $employees->responsibilities_ru = $inputs['responsibilities_ru'];
        if (!empty($employees->responsibilities_ru)) {
            $dom_save_ru = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_ru->loadHtml('<?xml encoding="UTF-8">' . $employees->responsibilities_ru, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $dom_image_save_ru = $dom_save_ru->getElementsByTagName('img');
            foreach ($dom_image_save_ru as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/employee/responsibilities_image/ru_" .$employee_url.'_'. time() . $k . '.jpg';
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
            $employees->responsibilities_ru = str_replace('<?xml encoding="UTF-8">', "", $dom_save_ru->saveHTML((new \DOMXPath($dom_save_ru))->query('/')->item(0)));
        }

        $employees->responsibilities_en = $inputs['responsibilities_en'];
        if (!empty($employees->responsibilities_en)) {
            $dom_save_en = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_en->loadHtml('<?xml encoding="UTF-8">' . $employees->responsibilities_en, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            //$dom_save_en->loadHTML($employees->responsibilities_en);
            $dom_image_save_en = $dom_save_en->getElementsByTagName('img');
            foreach ($dom_image_save_en as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/employee/responsibilities_image/en_" .$employee_url.'_'. time() . $k . '.jpg';
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
            $employees->responsibilities_en = str_replace('<?xml encoding="UTF-8">', "", $dom_save_en->saveHTML((new \DOMXPath($dom_save_en))->query('/')->item(0)));
        }

        $employees->save();

        if (!empty($inputs['id'])) {
            Session::flash('warning', __('ALL_CHANGES_SUCCESSFUL_SAVED'));
            return redirect('admin/employee');
        } else {
            Session::flash('warning', __('ALL_SUCCESSFUL_SAVED'));
            return redirect('admin/employee');
        }
    }

    public function update_division(Request $request, Employee $employees)
    {
        $data = $request->except(array('_token'));
        $rule = array(
            'full_name_uz' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required',
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
            $employees = Employee::findOrFail($inputs['id']);
        } else {
            $employees = new Employee;
        }

        $image = $request->file('user_image');
        if ($image) {
            $tmpFilePath = 'upload/employee/division/';
            $hardPath =  Str::slug('employee', '-') . '-' . md5(time());
            $imagine = new \Imagine\Gd\Imagine();
            $image = $imagine->open($image);
            $thumbnail = $image->thumbnail(new \Imagine\Image\Box(550, 450));
            $thumbnail->save($tmpFilePath . $hardPath . '_thumbnail_550.png');
            $bigImg = $image->thumbnail(new \Imagine\Image\Box(1920, 1080));
            $bigImg->save($tmpFilePath . $hardPath . '_big_1920.png');
            $employees->user_image = $hardPath;
        }

        $employees->user_id = $inputs['user_id'];
        $employees->pos_id = $inputs['pos_id'];
        $employees->full_name_uz = $inputs['full_name_uz'];
        $employees->full_name_ru = $inputs['full_name_ru'];
        $employees->full_name_en = $inputs['full_name_en'];
        $employees->email = $inputs['email'];
        $employees->phone = $inputs['phone'];
        $employees->code = $inputs['code'];
        $employees->title_uz = $inputs['title_uz'];
        $employees->title_ru = $inputs['title_ru'];
        $employees->title_en = $inputs['title_en'];
        $employees->number_of_members = $inputs['number_of_members'];

        $employees->biography_uz = $inputs['biography_uz'];
        if (!empty($employees->biography_uz)) {
            $dom_save_uz = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_uz->loadHtml('<?xml encoding="UTF-8">' . $employees->biography_uz, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $dom_image_save_uz = $dom_save_uz->getElementsByTagName('img');
            foreach ($dom_image_save_uz as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/employee/division/biography_image/uz_" . time() . $k . '.jpg';
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
            $employees->biography_uz = str_replace('<?xml encoding="UTF-8">', "", $dom_save_uz->saveHTML((new \DOMXPath($dom_save_uz))->query('/')->item(0)));

        }

        $employees->biography_ru = $inputs['biography_ru'];
        if (!empty($employees->biography_ru)) {
            $dom_save_ru = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_ru->loadHtml('<?xml encoding="UTF-8">' . $employees->biography_ru, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $dom_image_save_ru = $dom_save_ru->getElementsByTagName('img');
            foreach ($dom_image_save_ru as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/employee/division/biography_image/ru_" . time() . $k . '.jpg';
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
            $employees->biography_ru = str_replace('<?xml encoding="UTF-8">', "", $dom_save_ru->saveHTML((new \DOMXPath($dom_save_ru))->query('/')->item(0)));
        }

        $employees->biography_en = $inputs['biography_en'];
        if (!empty($employees->biography_en)) {
            $dom_save_en = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_en->loadHtml('<?xml encoding="UTF-8">' . $employees->biography_en, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            //$dom_save_en->loadHTML($employees->biography_en);
            $dom_image_save_en = $dom_save_en->getElementsByTagName('img');
            foreach ($dom_image_save_en as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/employee/division/biography_image/en_" . time() . $k . '.jpg';
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
            $employees->biography_en = str_replace('<?xml encoding="UTF-8">', "", $dom_save_en->saveHTML((new \DOMXPath($dom_save_en))->query('/')->item(0)));
        }

        $employees->responsibilities_uz = $inputs['responsibilities_uz'];
        if (!empty($employees->responsibilities_uz)) {
            $dom_save_uz = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_uz->loadHtml('<?xml encoding="UTF-8">' . $employees->responsibilities_uz, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $dom_image_save_uz = $dom_save_uz->getElementsByTagName('img');
            foreach ($dom_image_save_uz as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/employee/division/responsibilities_image/uz_" . time() . $k . '.jpg';
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
            $employees->responsibilities_uz = str_replace('<?xml encoding="UTF-8">', "", $dom_save_uz->saveHTML((new \DOMXPath($dom_save_uz))->query('/')->item(0)));

        }

        $employees->responsibilities_ru = $inputs['responsibilities_ru'];
        if (!empty($employees->responsibilities_ru)) {
            $dom_save_ru = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_ru->loadHtml('<?xml encoding="UTF-8">' . $employees->responsibilities_ru, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $dom_image_save_ru = $dom_save_ru->getElementsByTagName('img');
            foreach ($dom_image_save_ru as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/employee/division/responsibilities_image/ru_" . time() . $k . '.jpg';
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
            $employees->responsibilities_ru = str_replace('<?xml encoding="UTF-8">', "", $dom_save_ru->saveHTML((new \DOMXPath($dom_save_ru))->query('/')->item(0)));
        }

        $employees->responsibilities_en = $inputs['responsibilities_en'];
        if (!empty($employees->responsibilities_en)) {
            $dom_save_en = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom_save_en->loadHtml('<?xml encoding="UTF-8">' . $employees->responsibilities_en, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            //$dom_save_en->loadHTML($employees->responsibilities_en);
            $dom_image_save_en = $dom_save_en->getElementsByTagName('img');
            foreach ($dom_image_save_en as $k => $img) {
                $data = $img->getAttribute('src');
                if (preg_match('/data:image/', $data)) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/employee/division/responsibilities_image/en_" . time() . $k . '.jpg';
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
            $employees->responsibilities_en = str_replace('<?xml encoding="UTF-8">', "", $dom_save_en->saveHTML((new \DOMXPath($dom_save_en))->query('/')->item(0)));
        }

        $employees->save();

        if (!empty($inputs['id'])) {
            Session::flash('warning', __('ALL_CHANGES_SUCCESSFUL_SAVED'));
            return redirect('admin/employee');
        } else {
            Session::flash('warning', __('ALL_SUCCESSFUL_SAVED'));
            return redirect('admin/employee');
        }
    }

    public function update_employee(Request $request, Employee $employees)
    {
        $data = $request->except(array('_token'));
        $rule = array(
            'full_name_uz' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required',
        );

        $validator = Validator::make($data, $rule);

        if ($validator->fails()) {
            Session::flash('warning', $validator->messages());
            return redirect()->back();
        }

        $inputs = $request->all();
        if (!empty($inputs['id'])) {
            $employees = Employee::findOrFail($inputs['id']);
        } else {
            $employees = new Employee;
        }

        $image = $request->file('user_image');
        if ($image) {
            $tmpFilePath = 'upload/employee/employ/';
            $hardPath =  Str::slug('employee', '-') . '-' . md5(time());
            $imagine = new \Imagine\Gd\Imagine();
            $image = $imagine->open($image);
            $thumbnail = $image->thumbnail(new \Imagine\Image\Box(550, 450));
            $thumbnail->save($tmpFilePath . $hardPath . '_thumbnail_550.png');
            $bigImg = $image->thumbnail(new \Imagine\Image\Box(1920, 1080));
            $bigImg->save($tmpFilePath . $hardPath . '_big_1920.png');
            $employees->user_image = $hardPath;
        }

        $employees->user_id = $inputs['user_id'];
        $employees->dep_id = $inputs['dep_id'];
        $employees->pos_id = $inputs['pos_id'];
        $employees->full_name_uz = $inputs['full_name_uz'];
        $employees->full_name_ru = $inputs['full_name_ru'];
        $employees->full_name_en = $inputs['full_name_en'];
        $employees->email = $inputs['email'];
        $employees->phone = $inputs['phone'];
        $employees->code = $inputs['code'];
        
        if (!empty($inputs['id'])) {
            Session::flash('warning', __('ALL_CHANGES_SUCCESSFUL_SAVED'));
            return redirect('admin/employee');
        } else {
            Session::flash('warning', __('ALL_SUCCESSFUL_SAVED'));
            return redirect('admin/employee');
        }
    }
}
