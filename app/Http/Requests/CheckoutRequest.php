<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            //
            'customer.first_name' => 'required',
            'customer.last_name' => 'required',
            'customer.email' => 'required|email',
            'customer.street' => 'required',
            'customer.city' => 'required',
            'customer.country' => 'required',
            'customer.state' => 'required',
            'customer.zip' => 'required',
            'bookings' => 'array|required|min:1',
            'bookings.*.bookables_id' => 'required|exists:bookables,id',
            'bookings.*.from' => 'required|date_format:Y-m-d|after_or_equal:today',
            'bookings.*.to' => 'required|date_format:Y-m-d|after_or_equal:bookings.*.from',
        ];
    }
}
