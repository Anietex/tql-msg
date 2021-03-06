<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Requests\UpdateEmployeeRequest;
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
                ->join('companies', 'company_id', '=','companies.id')
                ->where('created_by', $user->id)
                ->select(['employees.*'])
                ->paginate(10);
        }else if($user->role->name === 'company'){
            $employees = Employee::where('company_id', $user->company->id)->paginate();
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
        if($user->role->name === 'superadmin'){
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
     * Show the form for editing the specified resource.
     *
     * @param Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $employee = Employee::find($id);

        $user = auth()->user();
        if($user->role->name === 'superadmin'){
            $companies = Company::paginate(10);
        }else{
            $companies = Company::where('created_by', $user->id)->paginate(10);
        }

        return  response()->view("pages.employee.edit",[ 'employee' => $employee, 'companies' => $companies]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateEmployeeRequest $request, $id)
    {
        $employee = Employee::find($id);
        $employeeData = $request->only(['first_name','last_name', 'email','phone_no', 'company_id']);
        $updated = $employee->update($employeeData);
        if($updated){
            return back()
                ->with('success', 'Employee updated successfully ');
        }else{
            return back()
                ->with('error', 'Unable to update employee at the moment');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $employee =  Employee::find($id);
        $employee->user->delete();
        $employee->delete();
        return back()->with('success', 'Employee deleted successfully');
    }
}
