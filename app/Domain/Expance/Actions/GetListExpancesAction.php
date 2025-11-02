<?php

namespace App\Domain\Expance\Actions;

use App\Domain\Expance\Models\Expance;
use App\Http\Resources\ExpanceResource;
use Illuminate\Http\Request;

class GetListExpancesAction
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'index' => 'nullable|integer|min:1',
            'size' => 'nullable|integer|min:1',
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date',
            'username' => 'nullable|string',
            'amount' => 'nullable|numeric',
        ]);

        $page = $validated['index'] ?? 1;
        $size = $validated['size'] ?? 10;
        $from = $validated['from_date'] ?? null;
        $to = $validated['to_date'] ?? null;
        $username = $validated['username'] ?? null;
        $amount = $validated['amount'] ?? null;

        $query = Expance::with('user');

        if ($from && $to) {
            $query->whereBetween('created_at', [$from, $to]);
        } elseif ($from) {
            $query->whereDate('created_at', '>=', $from);
        } elseif ($to) {
            $query->whereDate('created_at', '<=', $to);
        }

        if ($username) {
            $query->whereHas('user', function ($q) use ($username) {
                $q->where('username', 'like', "%{$username}%");
            });
        }

        if ($amount) {
            $query->where('amount', $amount);
        }

        $expances = $query->paginate($size, ['*'], 'page', $page);

        return ExpanceResource::collection($expances);
    }
}
