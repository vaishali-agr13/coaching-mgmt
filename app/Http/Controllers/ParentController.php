<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ParentModel;
use Illuminate\Support\Facades\Hash;

class ParentController extends Controller
{
    public function index()
        {
        $parents=ParentModel::with('user')
                    ->latest()
                    ->get();

        return view(
            'admin.parents.index',
            compact('parents')
        );
        }

    public function create()
        {
        return view('admin.parents.create');
        }

        public function store(Request $request)
            {
            $request->validate([

                'email'=>'required|email|unique:users',

                'password'=>'required|min:6',

                'father_name'=>'required',

                'phone'=>'required',

                'address'=>'required',

            ]);

            $user=User::create([

                'name'=>$request->father_name,

                'phone'=>$request->phone,

                'email'=>$request->email,

                'password'=>Hash::make($request->password),

                'role'=>'parent'

            ]);

            ParentModel::create([

                'user_id'=>$user->id,

                'father_name'=>$request->father_name,

                'mother_name'=>$request->mother_name,

                'phone'=>$request->phone,

                'alternate_phone'=>$request->alternate_phone,

                'occupation'=>$request->occupation,

                'email'=>$request->email,

                'address'=>$request->address

            ]);

            return redirect()
                    ->route('admin.parents.index')
                    ->with('success','Parent Added Successfully');
            }

    public function edit($id)
        {
        $parent=ParentModel::with('user')
                ->findOrFail($id);

        return view(
            'admin.parents.edit',
            compact('parent')
        );
        }

    public function update(Request $request,$id)
        {
        $parent=ParentModel::findOrFail($id);

        $parent->user->update([

            'name'=>$request->name,

            'email'=>$request->email,

        ]);

        $parent->update([

            'father_name'=>$request->father_name,

            'mother_name'=>$request->mother_name,

            'phone'=>$request->phone,

            'alternate_phone'=>$request->alternate_phone,

            'occupation'=>$request->occupation,

            'email'=>$request->email,

            'address'=>$request->address

        ]);

        return redirect()
                ->route('admin.parents.index')
                ->with('success','Updated Successfully');
        }

    public function destroy($id)
        {
        $parent=ParentModel::findOrFail($id);

        $parent->user()->delete();

        $parent->delete();

        return redirect()
                ->route('admin.parents.index')
                ->with('success','Deleted Successfully');
        }
}
