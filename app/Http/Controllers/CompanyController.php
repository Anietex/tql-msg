<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompanyRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if($user->role->name === 'superadmin'){
            $companies = Company::paginate(10);
        }else{
            $companies = Company::where('created_by', $user->id)->paginate(10);
        }

        return  response()->view("pages.company.index", ['companies' => $companies]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  response()->view("pages.company.create");

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCompanyRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateCompanyRequest $request)
    {
        $companyRole = Role::where('name', 'company')->first();

        if(!$companyRole){
            return back()
                ->with('error', 'No company role created please run seeder');
        }
        $user = $this->createUser($request->email, $companyRole->id);
        $companyData = $request->only(['name','email', 'website']);


        if($request->hasFile('logo')){
            $companyData['logo'] = $request->file('logo')->storePublicly('public/logo', '');
        }

        $companyData['created_by'] = auth()->user()->id;
        $companyData['user_id'] = $user->id;
        $company =  Company::create($companyData);

        if($company){
            return back()
                ->with('success', 'Company created successfully and password has been sent to user');
        }else{
            return back(500)
                ->with('error', 'Unable to create company at the moment');
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);

        return  response()->view("pages.company.edit",[ 'company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCompanyRequest $request, $id)
    {
        $companyData = $request->only(['name','email', 'website']);

        $company = Company::find($id);
        if($request->hasFile('logo')){
            $companyData['logo'] = $request->file('logo')->storePublicly('public/logo', '');
            if($company->logo){
                Storage::disk('public')->delete($company->logo);
            }
        }
        $updated = $company->update($companyData);

        if($updated){
            return back()
                ->with('success', 'Company updated successfully ');
        }else{
            return back()
                ->with('error', 'Unable to update company at the moment');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company =  Company::find($id);
        $company->user->delete();
        $company->delete();
        return back()->with('success', 'Company deleted successfully');
    }
}
