<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompensations extends FormRequest
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
            'insuranceId' => 'required',
            'insuranceProvisionPeriodPlanMonth' => 'required',
            'insuranceProvisionPeriodPlanYear' => 'required',
            'insuranceProvisionPeriodPlanCompleted' => 'required',
            'totalProvisionPaid' => 'required',
            'payoutRate' => 'required',
            'salesCompensationFeedback' => 'required',
            'salesCompensationPeriodPlanMonth' => 'required',
            'salesCompensationPeriodPlanYear' => 'required',
            'salesCompensationPeriodPlanCompleted' => 'required',
            'totalSalesCompensation' => 'required',
            'salesOrder.id' => 'required'
        ];
    }
}
