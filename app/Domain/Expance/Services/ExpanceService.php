<?php

namespace App\Domain\Expance\Services;

use App\Domain\Expance\Models\Expance;
use Illuminate\Http\Request;

class ExpanceService
{

    public function calculateExpances(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'nullable|integer'
        ]);

        $user = $validated['user_id'] ?? null;

        $query = Expance::query();

        if ($user) {
            $query->where('user_id', $user);
        }

        $calculated_expances_amount = $query->sum('amount'); 
        $calculated_expances_count = $query->count('id');

        return response()->json([
            'expences_total_amount' => $calculated_expances_amount,
            'expences_count' => $calculated_expances_count
        ]);
    }
}
