<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = $this->user();
        return in_array($user->role->name, ['superadmin','admin','company']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|max:255',
            'last_name'  => 'required|max:255',
            'email'      =>   'required|email|unique:users|max:255',
            'phone_no'   =>  'nullable|size:11',
            'company_id' => 'required|exists:companies,id'
        ];
    }
}
