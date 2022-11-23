<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partner\Partner;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::select('id', 'user_id', 'image', 'image_url', 'is_active')->paginate(10);
        return view('admin.partner.index', compact('partners'));
    }

    public function is_active($id){
        $change = Partner::find($id);
        if($change->is_active==1){
            $change->is_active=0;
        }else{
            $change->is_active=1;
        }
        $change->save();
        return redirect()->back();
    }

    public function create()
    {
        $users = User::select('id', 'user_name')->get();
        return view('admin.partner.create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->except(array('_token'));
        $rule = array(
            'image' => 'required',
        );

        if (!file_exists('upload/partner')) {
            mkdir('upload/partner', 0777, true);
        }


        $validator = Validator::make($data, $rule);

        if ($validator->fails()) {
            Session::flash('warning', $validator->messages());
            return redirect()->back();
        }

        $inputs = $request->all();
        if (!empty($inputs['id'])) {
            $partners = Partner::findOrFail($inputs['id']);
        } else {
            $partners = new Partner();
        }

        $image = $request->file('image');
        if ($image) {
            $tmpFilePath = 'upload/partner/';
            $hardPath = Str::slug('partner_', '-') . '-' . '-' . md5(time());
            $imagine = new \Imagine\Gd\Imagine();
            $image = $imagine->open($image);
            $thumbnail = $image->thumbnail(new \Imagine\Image\Box(550, 450));
            $thumbnail->save($tmpFilePath . $hardPath . '_thumbnail_550.png');
            $partners->image = $hardPath;
        }

        $partners->user_id = $inputs['user_id'];
        $partners->image_url = $inputs['image_url'];
        $partners->save();

        if (!empty($inputs['id'])) {
            Session::flash('warning', __('ALL_CHANGES_SUCCESSFUL_SAVED'));
            return redirect('admin/partner');
        } else {
            Session::flash('warning', __('ALL_SUCCESSFUL_SAVED'));
            return redirect('admin/partner');
        }
    }
    
    
    public function edit($id)
    {
        $partner = Partner::find($id);
        $users = User::select('id', 'user_name')->get();
        return view('admin.partner.edit', [
            'partner' => $partner,
            'users' => $users,
        ]);
    }


    public function update(Request $request, Partner $partners)
    {
        $data = $request->except(array('_token'));
        $rule = array(
            'image' => 'required',
        );

        if (!file_exists('upload/partner')) {
            mkdir('upload/partner', 0777, true);
        }


        $validator = Validator::make($data, $rule);

        if ($validator->fails()) {
            Session::flash('warning', $validator->messages());
            return redirect()->back();
        }

        $inputs = $request->all();
        if (!empty($inputs['id'])) {
            $partners = Partner::findOrFail($inputs['id']);
        } else {
            $partners = new Partner();
        }

        $image = $request->file('image');
        if ($image) {
            $tmpFilePath = 'upload/partner/';
            $hardPath = Str::slug('partner_', '-') . '-' . '-' . md5(time());
            $imagine = new \Imagine\Gd\Imagine();
            $image = $imagine->open($image);
            $thumbnail = $image->thumbnail(new \Imagine\Image\Box(550, 450));
            $thumbnail->save($tmpFilePath . $hardPath . '_thumbnail_550.png');
            $partners->image = $hardPath;
        }

        $partners->user_id = $inputs['user_id'];
        $partners->image_url = $inputs['image_url'];
        $partners->save();

        if (!empty($inputs['id'])) {
            Session::flash('warning', __('ALL_CHANGES_SUCCESSFUL_SAVED'));
            return redirect('admin/partner');
        } else {
            Session::flash('warning', __('ALL_SUCCESSFUL_SAVED'));
            return redirect('admin/partner');
        }
    }


    public function delete($id)
    {
        $partners = Partner::findOrFail($id);
        // $image_path = public_path() . '/upload/partners/' . $partners->image . '-d.png';
        // unlink($image_path);
        $partners->delete();
        return redirect('admin/partner')->with('warning', 'PARTNER TABLES DELETED');
    }

}
