<?php

namespace App\Modules\Management\VolunteerManagement\VolunteerApplication\Validations;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class DataStoreValidation extends FormRequest
{
    /**
     * Determine if the  is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    /**
     * validateError to make this request.
     */
    public function validateError($data)
    {
        $errorPayload = $data->getMessages();
        return response(['status' => 'validation_error', 'errors' => $errorPayload], 422);
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->validateError($validator->errors()));
        if ($this->wantsJson() || $this->ajax()) {
            throw new HttpResponseException($this->validateError($validator->errors()));
        }
        parent::failedValidation($validator);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name'   => 'required|string|max:50',
            'last_name'    => 'required|string|max:50',
            'email'        => 'required|email|max:50',
            'phone_number' => 'required|string|max:30',
            'help_types'   => 'required|array|min:1',
            'help_types.*' => 'in:Telephone Calls,Distribute Signs,Voter Registration,Other',
            'time_slots'   => 'required|array|min:1',
            'time_slots.*' => 'in:Morning,Afternoon,Evening',
            'week_days'    => 'required|array|min:1',
            'week_days.*'  => 'in:Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
            'comment'      => 'nullable|string',
            'status'       => ['sometimes', Rule::in(['active', 'inactive'])],
        ];
    }

    public function messages()
    {
        return [
            'first_name.required'   => 'First name is required.',
            'first_name.max'        => 'First name may not be greater than 50 characters.',
            'last_name.required'    => 'Last name is required.',
            'last_name.max'         => 'Last name may not be greater than 50 characters.',
            'email.required'        => 'Email address is required.',
            'email.email'           => 'Please provide a valid email address.',
            'email.max'             => 'Email may not be greater than 50 characters.',
            'phone_number.required' => 'Phone number is required.',
            'phone_number.max'      => 'Phone number may not be greater than 30 characters.',
            'help_types.required'   => 'Please select at least one way you would like to help.',
            'help_types.min'        => 'Please select at least one way you would like to help.',
            'help_types.*.in'       => 'Invalid help type selected.',
            'time_slots.required'   => 'Please select at least one time slot.',
            'time_slots.min'        => 'Please select at least one time slot.',
            'time_slots.*.in'       => 'Invalid time slot selected.',
            'week_days.required'    => 'Please select at least one day of the week.',
            'week_days.min'         => 'Please select at least one day of the week.',
            'week_days.*.in'        => 'Invalid week day selected.',
        ];
    }
}