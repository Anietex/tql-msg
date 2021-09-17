<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $employees = [];

        if($user->role->name === 'superadmin'){
            $employees = Employee::paginate(10);
        }else if($user->role->name === 'admin'){
            $employees = Employee::query()
                ->join('companies', 'company_id', '=','id')
                ->where('created_by', $user->id)
                ->paginate(10);
        }else if($user->role->name === 'company'){
            $employees = Employee::where('company', $user->company->id)->paginate();
        }

        return  response()->view("pages.employee.index",['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $user = auth()->user();
        if($user->role->name === 'superamdin'){
            $companies = Company::paginate(10);
        }else{
            $companies = Company::where('created_by', $user->id)->paginate(10);
        }

        return  response()->view("pages.employee.create", ['companies' => $companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateEmployeeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateEmployeeRequest $request)
    {

        $employeeRole = Role::where('name', 'employee')->first();

        if(!$employeeRole){
            return back()
                ->with('error', 'No employee role created please run seeder');
        }
        $user = $this->createUser($request->email, $employeeRole->id);


        $employeeData = $request->only(['first_name','last_name', 'email','phone_no', 'company_id']);
        $employeeData['user_id'] = $user->id;
        $employee = Employee::create($employeeData);

        if($employee){
            return back()
                ->with('success', 'Employee created successfully and password has been sent to user');
        }else{
            return back(500)
                ->with('error', 'Unable to create employee at the moment');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return  response()->view("pages.employee.edit");

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
