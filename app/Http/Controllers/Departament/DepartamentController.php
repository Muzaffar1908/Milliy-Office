<?php

namespace App\Http\Controllers\Departament;

use App\Http\Controllers\Controller;
use App\Models\Department\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class DepartamentController extends Controller
{
    public function index()
    {
        $departaments = Department::select('id', 'user_id', 'dep_name_uz', 'is_active', 'created_at')->orderBy('created_at', 'DESC')->paginate(10);
        $users = User::select('id','user_name', 'created_at')->get();
        return view('admin.departament.index', compact('departaments', 'users'));
    }

    public function is_active($id)
    {
        $update = Department::find($id);
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
        return view('admin.departament.create', compact('users'));

    }

    public function store(Request $request)
    {
        $data = $request->except(array('_token'));
        $rule = array(
            'dep_name_uz' => 'required|string|max:255',
        );

        $validator = Validator::make($data, $rule);

        if ($validator->fails()) {
            Session::flash('warning', $validator->messages());
            return redirect()->back();
        }

        $inputs = $request->all();
        if (!empty($inputs['id'])) {
            $departaments = Department::findOrFail($inputs['id']);
        } else {
            $departaments = new Department;
        }

        $departaments->user_id = $inputs['user_id'];
        $departaments->dep_name_uz = $inputs['dep_name_uz'];
        $departaments->dep_name_ru = $inputs['dep_name_ru'];
        $departaments->dep_name_en = $inputs['dep_name_en'];
        $departaments->save();

        if (!empty($inputs['id'])) {
            Session::flash('warning', __('ALL_CHANGES_SUCCESSFUL_SAVED'));
            return redirect('admin/departament');
        } else {
            Session::flash('warning', __('ALL_SUCCESSFUL_SAVED'));
            return redirect('admin/departament');
        }
    }

    public function edit($id)
    {
        $departament = Department::find($id);
        $users = User::select('id','user_name', 'created_at')->get();
        return view('admin.departament.edit', [
            'departament' => $departament,
            'users' => $users,
        ]);
    }

    public function update(Request $request, Department $departaments)
    {
        $data = $request->except(array('_token'));
        $rule = array(
            'dep_name_uz' => 'required|string|max:255',
        );

        $validator = Validator::make($data, $rule);

        if ($validator->fails()) {
            Session::flash('warning', $validator->messages());
            return redirect()->back();
        }

        $inputs = $request->all();
        if (!empty($inputs['id'])) {
            $departaments = Department::findOrFail($inputs['id']);
        } else {
            $departaments = new Department;
        }

        $departaments->user_id = $inputs['user_id'];
        $departaments->dep_name_uz = $inputs['dep_name_uz'];
        $departaments->dep_name_ru = $inputs['dep_name_ru'];
        $departaments->dep_name_en = $inputs['dep_name_en'];
        $departaments->save();

        if (!empty($inputs['id'])) {
            Session::flash('warning', __('ALL_CHANGES_SUCCESSFUL_SAVED'));
            return redirect('admin/departament');
        } else {
            Session::flash('warning', __('ALL_SUCCESSFUL_SAVED'));
            return redirect('admin/departament');
        }
    }

    public function delete($id)
    {
        $departament = Department::findOrFail($id);
        // $image_path = public_path() . '/upload/depa$departament/' . $departament->user_image . '-d.png';
        // unlink($image_path);
        $departament->delete();
        return redirect('admin/departament')->with('warning', 'DEPARTAMENT TABLES DELETED');
    }

    
}
