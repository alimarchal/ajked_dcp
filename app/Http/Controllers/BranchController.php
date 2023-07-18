<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\UpdateBranchRequest;
use App\Models\Branch;
use App\Models\Voucher;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        return view('branches.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('branches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBranchRequest $request)
    {

        $request->merge(['bank_sdiv_code' => Branch::find($request->id)->bank_sdiv_code]);
        $request->merge(['bank_sdiv_name' => Branch::find($request->id)->bank_sdiv_name]);
        $request->merge(['bank_div_code' => Branch::find($request->id)->bank_div_code]);
        $request->merge(['bank_div_name' => Branch::find($request->id)->bank_div_name]);

//        dd($request->all());

        // Create a new voucher instance
        $branch = Branch::create($request->all());

        // Redirect with success message
        return to_route('branch.index')->with('status', 'Branch created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBranchRequest $request, Branch $branch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        //
    }
}
