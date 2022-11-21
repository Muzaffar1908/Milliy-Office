<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\NewsCategory;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class NewsCategoryController extends Controller
{
    public function index()
    {
        $lang = \App::getLocale();
        $news_cat = NewsCategory::orderBy('created_at', 'DESC')->paginate(10);
        $users = User::select('id','user_name', 'created_at')->get();
        return view('admin.news_cat.index', compact('news_cat', 'users'));
    }

    public function is_active($id)
    {
        $update=NewsCategory::find($id);
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
        return view('admin.news_cat.create', compact('users'));
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
            $news_cats = NewsCategory::findOrFail($inputs['id']);
        } else {
            $news_cats = new NewsCategory;
        }

        $news_cats->user_id = $inputs['user_id'];
        $news_cats->title_uz = $inputs['title_uz'];
        $news_cats->title_ru = $inputs['title_ru'] ?? null;
        $news_cats->title_en = $inputs['title_en'] ?? null;
        $news_cats->save();

        if (!empty($inputs['id'])) {
            Session::flash('warning', __('ALL_CHANGES_SUCCESSFUL_SAVED'));
            return redirect('admin/news_cat');
        } else {
            Session::flash('warning', __('ALL_SUCCESSFUL_SAVED'));
            return redirect('admin/news_cat');
        }
    }

    public function edit($id)
    {
        $news_cat = NewsCategory::find($id);
        $users = User::select('id','user_name', 'created_at')->get();
        return view('admin.news_cat.edit', [
            'news_cat' => $news_cat,
            'users' => $users,
        ]);
    }

    public function update(Request $request, NewsCategory $news_cats)
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
            $news_cats = NewsCategory::findOrFail($inputs['id']);
        } else {
            $news_cats = new NewsCategory;
        }

        $news_cats->user_id = $inputs['user_id'];
        $news_cats->title_uz = $inputs['title_uz'];
        $news_cats->title_ru = $inputs['title_ru'] ?? null;
        $news_cats->title_en = $inputs['title_en'] ?? null;
        $news_cats->save();

        if (!empty($inputs['id'])) {
            Session::flash('warning', __('ALL_CHANGES_SUCCESSFUL_SAVED'));
            return redirect('admin/news_cat');
        } else {
            Session::flash('warning', __('ALL_SUCCESSFUL_SAVED'));
            return redirect('admin/news_cat');
        }
    }

    public function delete($id)
    {
        $news_cat = NewsCategory::findOrFail($id);
        $news_cat->delete();
        return redirect('admin/news_cat')->with('warning', 'ALL_SUCCESSFUL_DELETED');
    }
}
