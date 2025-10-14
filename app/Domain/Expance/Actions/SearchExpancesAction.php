<?php


namespace App\Domain\Expance\Actions;

use App\Domain\Expance\Models\Expance;
use App\Http\Resources\ExpanceResource;
use Illuminate\Http\Request;

class SearchExpancesAction
{

    public function __invoke(Request $request)
    {
        $term = $request->term;


        if (empty($term)) {
            return ExpanceResource::collection(Expance::all());
        }

        $expances = Expance::where('reason', 'LIKE', "%{$term}%")
            ->orWhere('amount', '=', $term)
            ->orWhereHas('user', function ($query) use ($term) {
                $query->where('username', 'LIKE', "%{$term}%");
            })
            ->get();
        
        return ExpanceResource::collection($expances);
    }
}
