<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;

class SaveRolesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        switch ($this->route()->getActionMethod()) {
            case 'store':
                return Gate::authorize('create', new Role);
                break;
            case 'update':
                return Gate::authorize('update', $this->route('role'));
                break;
            default:
                return false;
                break;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'display_name' => 'required|max:255'
        ];
        if ($this->method() !== 'PUT') {
            $rules['name'] = 'required|unique:roles,name,' . $this->route('role');
            // $rules['permissions'] = 'nullable|array';
            // $rules['permissions.*'] = 'exists:permissions,id';
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'El Identificador es Requerido',
            'name.unique' => 'El Identificador está Registrado',
            'display_name.required' => 'El Nombre es Requerido',
        ];
    }
}
