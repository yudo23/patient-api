<?php

namespace App\Http\Requests\Patient;

use App\Enums\GenderEnum;
use App\Exceptions\CustomValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => [
                'required'
            ],
            'id_type' => [
                'required',
            ],
            'id_no' => [
                'required',
            ],
            'dob' => [
                'required',
                'date_format:Y-m-d'
            ],
            'address' => [
                'required',
            ],
            'medium_acquisition' => [
                'required',
            ],
            'gender' => [
                'required',
                'in:'.implode(",",[GenderEnum::MALE->value,GenderEnum::FEMALE->value])
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'id_type.required' => 'The ID type field is required.',
            'id_no.required' => 'The ID number field is required.',
            'dob.required' => 'The date of birth field is required.',
            'dob.date_format' => 'The date of birth must be in the format YYYY-MM-DD.',
            'address.required' => 'The address field is required.',
            'medium_acquisition.required' => 'The medium acquisition field is required.',
            'gender.required' => 'The gender field is required.',
            'gender.in' => 'The selected gender is invalid. Please choose from Male or Female.',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function failedValidation(Validator $validator)
    {
        throw new CustomValidationException($validator);
    }
}