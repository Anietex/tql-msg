<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompanyRequest;
use App\Models\Company;
use App\Models\Role;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  response()->view("pages.company.index");

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
        $companyData = $request->only(['name','email']);
        if($request->hasFile('logo')){
            $companyData['logo'] = $request->file('logo')->storePublicly('logo');
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return  response()->view("pages.company.edit");
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
