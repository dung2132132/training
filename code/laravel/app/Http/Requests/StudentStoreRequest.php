<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => 'required|max:255',
            'name' => 'required|max:255',
            'age' => 'required|numberic|between:18,30',
            'email' => 'required|email|unique:students',
            'address' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'code.required' => 'Code is required',
            'name.required' => 'Name is required',
            'age.required' => 'Age is required',
            'email.required' => 'Email is required!',
            'email.email' => 'Not is email',
            'address.required' => 'Address is required!'
        ];
    }
    protected function failedValidation(Validator $validator)
    {

        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(
            [
                'error' => $errors,
                'status_code' => 422,
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
