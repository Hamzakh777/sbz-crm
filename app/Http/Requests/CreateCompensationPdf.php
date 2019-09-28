<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCompensationPdf extends FormRequest
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
            'periodPlanYear' => 'required|numeric',
            'periodPlanMonth' => 'required|numeric',
            'payoutDate' => 'required',
            'salesAgentId' => 'required|numeric'
        ];
    }

    /**
     * Setup the validation of query/route parameters
     */
    public function all($keys = null)
    {
        try {
            $data = parent::all();
            $data['periodPlanYear'] = $this->query('periodPlanYear');
            $data['periodPlanMonth'] = $this->query('periodPlanMonth');
            $data['payoutDate'] = $this->query('payoutDate');
            $data['salesAgentId'] = $this->query('salesAgentId');
            return $data;
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }

}
