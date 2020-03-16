<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Order;

class CreateOrderRequest extends FormRequest
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
            'from_street' => 'required',
            'from_building' => 'required',
            'from_city' => 'required',
            'to_street' => 'required',
            'to_building' => 'required',
            'to_city' => 'required',
            'shippment_type' => 'required',
//            'cash_collected' => 'required',
            'number_of_piece' => 'required',
            'delivery_date' => 'required'
        ];
    }
}
