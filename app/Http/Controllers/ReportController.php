<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ReportController extends Controller
{
    //

    public function index()
    {
        $branches =
            QueryBuilder::for(Branch::class)
                ->allowedFilters([
                    AllowedFilter::exact('id'),
                    AllowedFilter::exact('bank_code'),
                    AllowedFilter::exact('bank_code_branch'),
                    AllowedFilter::exact('bank_name'),
                    AllowedFilter::exact('bank_sdiv_code'),
                    AllowedFilter::exact('bank_sdiv_name'),
                    AllowedFilter::exact('bank_div_code'),
                    AllowedFilter::exact('bank_div_name'),
                ])
//                ->orderBy('bank_sdiv_code', 'asc')
                ->paginate(100)->withQueryString();
//
//            Branch::paginate(100)->withQueryString();
        return view('reports.index', compact('branches'));
    }


    public function missingBranches(Request $request)
    {
        $branches = QueryBuilder::for(Branch::class)->allowedFilters([
            AllowedFilter::exact('id'),
            AllowedFilter::exact('bank_code'),
            AllowedFilter::exact('bank_code_branch'),
            AllowedFilter::exact('bank_name'),
            AllowedFilter::exact('bank_sdiv_code'),
            AllowedFilter::exact('bank_sdiv_name'),
            AllowedFilter::exact('bank_div_code'),
            AllowedFilter::exact('bank_div_name'),
        ])
            ->orderBy('bank_div_code', 'asc')
            ->get();

        $date = null;
        if ($request->has('date')) {
            $date = $request->date;
        } else {
            $date = \Carbon\Carbon::now()->format('Y-m-d');
        }
//            Branch::paginate(100)->withQueryString();
        return view('reports.missing-branches', compact('branches','date'));
    }


}
