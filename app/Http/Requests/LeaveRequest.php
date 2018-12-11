<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeaveRequest extends FormRequest
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
            'from_date' => 'required|date|before_or_equal:to_date',
            'to_date'   => 'required|date',
            'reason'    => 'required',
            'backup_user_id'  => 'sometimes|required|integer',
        ];
    }
}
