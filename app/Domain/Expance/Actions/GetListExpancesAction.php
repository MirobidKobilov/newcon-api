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
            'user_id' => 'nullable|string',
        ]);

        $from = $validated['from_date'] ?? null;
        $to = $validated['to_date'] ?? null;
        $username = strtolower($validated['username'] ?? '');
        $amount = $validated['amount'] ?? null;
        $user = $validated['user_id'] ?? null;

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
                $q->whereRaw('LOWER(username) LIKE ?', ["%{$username}%"]);
            });
        }

        if ($amount) {
            $query->where('amount', $amount);
        }

        if ($user) {
            $query->where('user_id', $user);
        }

        if (isset($validated['index']) || isset($validated['size'])) {
            $page = $validated['index'] ?? 1;
            $size = $validated['size'] ?? 10;
            $expances = $query->paginate($size, ['*'], 'page', $page);
        } else {
            $expances = $query->get();
        }

        return ExpanceResource::collection($expances);
    }
}
