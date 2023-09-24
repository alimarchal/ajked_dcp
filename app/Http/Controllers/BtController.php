<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBtRequest;
use App\Http\Requests\UpdateBtRequest;
use App\Models\Bt;
use App\Models\Cheque;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class BtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check if the user has the "Super-Admin" role
        if (Auth::user()->hasRole(['Super-Admin', 'admin'])) {

            $vouchers = QueryBuilder::for(Bt::class)
                ->allowedFilters(['bts.date', 'branch.bank_div_name', 'branch.bank_sdiv_name', 'bts.branch_id', AllowedFilter::exact('branch_id'), AllowedFilter::scope('starts_before')])
                ->allowedIncludes(['user', 'branch'])
//                ->join('branches', 'vouchers.branch_id', '=', 'branches.id')
                ->orderBy('bts.date', 'desc')
                ->get();
        } else {
            $vouchers = QueryBuilder::for(Bt::with(['user', 'branch']))
                ->allowedFilters([AllowedFilter::exact('date')])
                ->where('branch_id', Auth::user()->branch_id)
                ->orderBy('created_at', 'desc')
                ->paginate(100);
        }
        return view('bts.index', compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBtRequest $request)
    {
//        $request->merge(['branch_id' => \Auth::user()->branch_id]);
        $request->merge(['user_id' => \Auth::user()->id]);
//        if (\auth()->user()->hasRole('branch')) {
//            $request->merge(['date' => Carbon::now()->format('Y-m-d')]);
//        }
        $request->merge(['date' => Carbon::now()->format('Y-m-d')]);

        // Check if a voucher has already been created today
        $today = now()->format('Y-m-d');
        $existingVoucher = Bt::where('created_at', '>=', $today)
            ->where('created_at', '<', $today . ' 23:59:59')
            ->where('user_id', \Auth::user()->user_id)
            ->first();

        if ($existingVoucher) {
            // Voucher already exists for today, redirect back with error message
            return to_route('bt.create')->with('status', 'Only one BT allowed per day.');
        }

//        dd($request->all());

        // Create a new voucher instance
        $voucher = Bt::create($request->all());

        // Redirect with success message
        return to_route('bt.index')->with('status', 'Bt created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bt $bt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bt $bt)
    {
        $today = now()->format('Y-m-d'); // Get today's date

        $cheque = $bt;
        if (Auth::user()->hasRole(['Super-Admin', 'Admin'])) {
            $voucher = $bt;
            return view('bts.edit', compact('voucher'));
        } else {
            if ($bt->date != $today) {
                return to_route('cheques.index')->with('error', 'You cannot edit backdated vouchers.');
            }
        }

        return view('bts.edit', compact('cheque'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBtRequest $request, Bt $bt)
    {
        $request->merge(['user_id' => \Auth::user()->id]);
        // Update the voucher

        $request->merge(['date' => Carbon::now()->format('Y-m-d')]);
        $bt->update($request->all());

        // Redirect with success message
        return to_route('bt.index')->with('status', 'Bt updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bt $bt)
    {
        $bt->delete();
        // Redirect with success message
        return to_route('bt.index')->with('status', 'BT deleted successfully.');
    }
}
