<?php

namespace App\Http\Controllers\Specialist;

use App\Http\Controllers\Controller;
use App\Models\Specialist\Specialist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class SpecialistController extends Controller
{
    public function index()
    {
        $specialists = Specialist::select('id', 'user_id', 'spe_name_uz', 'is_active', 'created_at')->orderBy('created_at', 'DESC')->paginate(10);
        $users = User::select('id','user_name', 'created_at')->get();
        return view('admin.specialist.index', compact('specialists', 'users'));
    }

    public function is_active($id)
    {
        $update = Specialist::find($id);
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
        return view('admin.specialist.create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->except(array('_token'));
        $rule = array(
            'spe_name_uz' => 'required|string|max:255',
        );

        $validator = Validator::make($data, $rule);

        if ($validator->fails()) {
            Session::flash('warning', $validator->messages());
            return redirect()->back();
        }

        $inputs = $request->all();
        if (!empty($inputs['id'])) {
            $specialists = Specialist::findOrFail($inputs['id']);
        } else {
            $specialists = new Specialist;
        }

        $specialists->user_id = $inputs['user_id'];
        $specialists->spe_name_uz = $inputs['spe_name_uz'];
        $specialists->spe_name_ru = $inputs['spe_name_ru'];
        $specialists->spe_name_en = $inputs['spe_name_en'];
        $specialists->save();

        if (!empty($inputs['id'])) {
            Session::flash('warning', __('ALL_CHANGES_SUCCESSFUL_SAVED'));
            return redirect('admin/specialist');
        } else {
            Session::flash('warning', __('ALL_SUCCESSFUL_SAVED'));
            return redirect('admin/specialist');
        }
    }

    public function edit($id)
    {
        $specialist = Specialist::find($id);
        $users = User::select('id','user_name', 'created_at')->get();
        return view('admin.specialist.edit', [
            'specialist' => $specialist,
            'users' => $users,
        ]);
    }

    public function update(request $request, Specialist $specialists )
    {
        $data = $request->except(array('_token'));
        $rule = array(
            'spe_name_uz' => 'required|string|max:255',
        );

        $validator = Validator::make($data, $rule);

        if ($validator->fails()) {
            Session::flash('warning', $validator->messages());
            return redirect()->back();
        }

        $inputs = $request->all();
        if (!empty($inputs['id'])) {
            $specialists = Specialist::findOrFail($inputs['id']);
        } else {
            $specialists = new Specialist;
        }

        $specialists->user_id = $inputs['user_id'];
        $specialists->spe_name_uz = $inputs['spe_name_uz'];
        $specialists->spe_name_ru = $inputs['spe_name_ru'];
        $specialists->spe_name_en = $inputs['spe_name_en'];
        $specialists->save();

        if (!empty($inputs['id'])) {
            Session::flash('warning', __('ALL_CHANGES_SUCCESSFUL_SAVED'));
            return redirect('admin/specialist');
        } else {
            Session::flash('warning', __('ALL_SUCCESSFUL_SAVED'));
            return redirect('admin/specialist');
        }

    }

    public function delete($id)
    {
        $specialist = Specialist::findOrFail($id);
        // $image_path = public_path() . '/upload/depa$specialist/' . $specialist->user_image . '-d.png';
        // unlink($image_path);
        $specialist->delete();
        return redirect('admin/specialist')->with('warning', 'SPECIALIST TABLES DELETED');
    }
}
