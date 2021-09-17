<?php

namespace App\Http\Controllers;

use App\Events\UserCreated;
use App\Http\Requests\CreateAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $adminRole = Role::where('name', 'admin')->first();
        $users = User::where('role_id', $adminRole->id??null)->paginate(10);
        return  response()->view("pages.admin.index", ['admins' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return  response()->view("pages.admin.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Response|\Illuminate\Routing\Redirector
     */
    public function store(CreateAdminRequest $request)
    {
        $admin = $request->safe()->only(['name', 'email']);


        $adminRole = Role::where('name', 'admin')->first();

        if(!$adminRole){
            return back()
                ->with('error', 'No admin role created please run seeder');
        }


        $password = Str::random(6);
        $userData = [
            'first_name' => $admin['name'],
            'email' => $admin['email'],
            'password' => bcrypt($password),
            'role_id'  => $adminRole->id
        ];

        $user = User::create($userData);
        if($user){
            UserCreated::dispatch($user, $password);
            return back()
                ->with('success', 'Admin created successfully and password has been sent to user');
        }else{
            return back()
                ->with('error', 'Unable to create admin at the moment');
        }



    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $admin = User::find($id);
        return  response()->view("pages.admin.edit", ['admin' => $admin]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(UpdateAdminRequest $request, $id)
    {
        $admin = $request->safe()->only(['name', 'email']);

        $updated = User::find($id)->update([
            'first_name' => $admin['name'],
            'email'      => $admin['email']
        ]);

        if($updated){
            return back()
                ->with('success', 'Admin updated successfully ');
        }else{
            return back()
                ->with('error', 'Unable to update admin at the moment');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return back()->with('success', 'Admin deleted successfully');
    }
}
