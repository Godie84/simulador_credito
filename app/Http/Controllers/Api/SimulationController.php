<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SimulationController extends Controller
{
    public function simulate(Request $request)
    {
        $request->validate([
            'requested_amount' => 'required|numeric|min:100000|max:100000000',
            'number_of_installments' => 'required|integer|min:2|max:24',
        ]);

        $amount = $request->requested_amount;
        $installments = $request->number_of_installments;
        $installment_value = round($amount / $installments, 2);

        $plan = [];
        $remaining = $amount;

        for ($i = 1; $i <= $installments; $i++) {
            $remaining -= $installment_value;
            $plan[] = [
                'installment' => $i,
                'amount' => $installment_value,
                'remaining' => max($remaining, 0)
            ];
        }

        return response()->json([
            'installment_value' => $installment_value,
            'plan' => $plan
        ]);
    }
}
