<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewLeaveApplicationRequest extends FormRequest
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
            'start_date'    => ['required', 'date'],
            'end_date'      => ['nullable', 'date' ,'after:start_date'],
            'take_charge'        => ['required', 'string', 'max:255'],
            'leave_type'    => ['required', 'integer', 'max:255'],
            'information'   => ['nullable', 'string', 'max:255'],
        ];
    }

    public function attributes()
    {
        return [
            'start_date'  => 'Start Date',
            'end_date'    => 'End Date',
            'take_charge'      => 'person to take charge',
            'leave_type'  => 'type of Leave',
            'information' => 'Information',
        ];
    }
}
