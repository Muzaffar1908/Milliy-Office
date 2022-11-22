<?php

namespace App\Http\Controllers\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About\About;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AboutController extends Controller
{
    public function index()
    {
        $abouts = About::select('id', 'user_id', 'about_title_uz', 'section_number', 'section_title_uz', 'is_active')->paginate(10);
        $users = User::all();
        return view('admin.about.index', compact('abouts', 'users'));
    }

    public function is_active($id)
    {
        $update=About::find($id);
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
        $users = User::all();
        return view('admin.about.create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->except(array('_token'));
        $rule = array(
            'about_title_uz' => 'required|string|max:255',
            'section_number' => 'required',
            'section_title_uz' => 'required|string|max:255',
        );

        $validator = Validator::make($data, $rule);

        if ($validator->fails()) {
            Session::flash('warning', $validator->messages());
            return redirect()->back();
        }

        $inputs = $request->all();
        if (!empty($inputs['id'])) {
            $abouts = About::findOrFail($inputs['id']);
        } else {
            $abouts = new About;
        }

        $abouts->user_id = $inputs['user_id'];
        $abouts->about_title_uz = $inputs['about_title_uz'];
        $abouts->about_title_ru = $inputs['about_title_ru'];
        $abouts->about_title_en = $inputs['about_title_en'];
        $abouts->section_number = $inputs['section_number'];
        $abouts->section_title_uz = $inputs['section_title_uz'];
        $abouts->section_title_ru = $inputs['section_title_ru'];
        $abouts->section_title_en = $inputs['section_title_en'];
        $abouts->save();

        if (!empty($inputs['id'])) {
            Session::flash('warning', __('ALL_CHANGES_SUCCESSFUL_SAVED'));
            return redirect('admin/about');
        } else {
            Session::flash('warning', __('ALL_SUCCESSFUL_SAVED'));
            return redirect('admin/about');
        }
    } 
    

    public function edit($id)
    {
        $about = About::find($id);
        $users = User::all();
        return view('admin.about.edit', [
            'about' => $about,
            'users' => $users,
        ]);
    }

    public function update(Request $request, About $abouts)
    {
        $data = $request->except(array('_token'));
        $rule = array(
            'about_title_uz' => 'required|string|max:255',
            'section_number' => 'required',
            'section_title_uz' => 'required|string|max:255',
        );

        $validator = Validator::make($data, $rule);

        if ($validator->fails()) {
            Session::flash('warning', $validator->messages());
            return redirect()->back();
        }

        $inputs = $request->all();
        if (!empty($inputs['id'])) {
            $abouts = About::findOrFail($inputs['id']);
        } else {
            $abouts = new About;
        }

        $abouts->user_id = $inputs['user_id'];
        $abouts->about_title_uz = $inputs['about_title_uz'];
        $abouts->about_title_ru = $inputs['about_title_ru'];
        $abouts->about_title_en = $inputs['about_title_en'];
        $abouts->section_number = $inputs['section_number'];
        $abouts->section_title_uz = $inputs['section_title_uz'];
        $abouts->section_title_ru = $inputs['section_title_ru'];
        $abouts->section_title_en = $inputs['section_title_en'];
        $abouts->save();

        if (!empty($inputs['id'])) {
            Session::flash('warning', __('ALL_CHANGES_SUCCESSFUL_SAVED'));
            return redirect('admin/about');
        } else {
            Session::flash('warning', __('ALL_SUCCESSFUL_SAVED'));
            return redirect('admin/about');
        }

    }

    public function delete($id)
    {
        $about = About::findOrFail($id);
        // $image_path = public_path() . '/upload/about/' . $about->user_image . '-d.png';
        // unlink($image_path);
        $about->delete();
        return redirect('admin/about')->with('warning', 'ABOUT TABLES DELETED');
    }

}
