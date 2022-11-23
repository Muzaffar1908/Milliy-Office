<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery\Gallery;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::select('id', 'user_id', 'image', 'youtobe_id', 'is_active', 'created_at')->orderBy('created_at', 'DESC')->paginate(10);
        $users = User::select('id','user_name', 'created_at')->get();
        return view('admin.gallery.index', compact('galleries', 'users'));
    }

    public function is_active($id)
    {
        $update = Gallery::find($id);
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
        return view('admin.gallery.create', compact('users'));
    }


    public function store(Request $request)
    {
        $data = $request->except(array('_token'));
        if( empty($data['image']) && empty($data['youtobe_id']))
        {
            $rule = array(
              'image' => 'required',
              'youtobe_id' => 'required',
            );
        }
        else
        {
            $rule = array(
                'image',
                'youtobe_id',
              ); 
        }
        

        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            Session::flash('warning', $validator->messages());
            return redirect()->back();
        }

        $inputs = $request->all();
        if (!empty($inputs['id'])) {
            $galleries = Gallery::findOrFail($inputs['id']);
        } else {
            $galleries = new Gallery();
        }

        $image = $request->file('image');
        if ($image) {
            $tmpFilePath = 'upload/gallery/';
            $hardPath = Str::slug('gallery_', '-') . '-' . '-' . md5(time());
            $imagine = new \Imagine\Gd\Imagine();
            $image = $imagine->open($image);
            $thumbnail = $image->thumbnail(new \Imagine\Image\Box(450, 250));
            $thumbnail->save($tmpFilePath . $hardPath . '_thumbnail_450.png');
            $bigImg = $image->thumbnail(new \Imagine\Image\Box(1920, 1080));
            $bigImg->save($tmpFilePath . $hardPath . '_big_1920.png');
            $galleries->image = $hardPath;
        }

        $galleries->user_id = $inputs['user_id'];
        $galleries->youtobe_id = $inputs['youtobe_id'];
        $galleries->save();

        if (!empty($inputs['id'])) {
            Session::flash('warning', __('ALL_CHANGES_SUCCESSFUL_SAVED'));
            return redirect('admin/gallery');
        } else {
            Session::flash('warning', __('ALL_SUCCESSFUL_SAVED'));
            return redirect('admin/gallery');
        }
    }


    public function edit($id)
    {
        $gallery = Gallery::find($id);
        $users = User::select('id', 'user_name')->get();
        return view('admin.gallery.edit', [
            'gallery' => $gallery,
            'users' => $users,
        ]);
    }


    public function update(Request $request, Gallery $galleries)
    {
        $data = $request->except(array('_token'));
        $rule = array(
            'image',
            'youtobe_id',
        );
        
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            Session::flash('warning', $validator->messages());
            return redirect()->back();
        }

        $inputs = $request->all();
        if (!empty($inputs['id'])) {
            $galleries = Gallery::findOrFail($inputs['id']);
        } else {
            $galleries = new Gallery();
        }

        $image = $request->file('image');
        if ($image) {
            $tmpFilePath = 'upload/gallery/';
            $hardPath = Str::slug('gallery_', '-') . '-' . '-' . md5(time());
            $imagine = new \Imagine\Gd\Imagine();
            $image = $imagine->open($image);
            $thumbnail = $image->thumbnail(new \Imagine\Image\Box(450, 250));
            $thumbnail->save($tmpFilePath . $hardPath . '_thumbnail_450.png');
            $bigImg = $image->thumbnail(new \Imagine\Image\Box(1920, 1080));
            $bigImg->save($tmpFilePath . $hardPath . '_big_1920.png');
            $galleries->image = $hardPath;
        }

        $galleries->user_id = $inputs['user_id'];
        $galleries->youtobe_id = $inputs['youtobe_id'];
        $galleries->save();

        if (!empty($inputs['id'])) {
            Session::flash('warning', __('ALL_CHANGES_SUCCESSFUL_SAVED'));
            return redirect('admin/gallery');
        } else {
            Session::flash('warning', __('ALL_SUCCESSFUL_SAVED'));
            return redirect('admin/gallery');
        }

    }


    public function delete($id)
    {
        $gallery = Gallery::findOrFail($id);
        // $image_path = public_path() . '/upload/gallery$gallery/' . $gallery->image . '-d.png';
        // unlink($image_path);
        $gallery->delete();
        return redirect('admin/gallery')->with('warning', 'GALLERY TABLES DELETED');
    }

}
