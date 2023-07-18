<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChequeRequest;
use App\Http\Requests\UpdateChequeRequest;
use App\Models\Bt;
use App\Models\Cheque;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ChequeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check if the user has the "Super-Admin" role
        if (Auth::user()->hasRole(['Super-Admin', 'admin'])) {

            $vouchers = QueryBuilder::for(Cheque::class)
                ->allowedFilters(['cheques.date', 'branch.bank_div_name', 'branch.bank_sdiv_name', 'cheques.branch_id', AllowedFilter::exact('branch_id'), AllowedFilter::scope('starts_before')])
                ->allowedIncludes(['user', 'branch'])
//                ->join('branches', 'vouchers.branch_id', '=', 'branches.id')
                ->orderBy('cheques.date', 'desc')
                ->get();
        } else {
            $vouchers = QueryBuilder::for(Cheque::with(['user', 'branch']))
                ->allowedFilters([AllowedFilter::exact('date')])
                ->where('branch_id', Auth::user()->branch_id)
                ->orderBy('created_at', 'desc')
                ->paginate(100);
        }
        return view('cheques.index', compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cheques.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChequeRequest $request)
    {
//        $request->merge(['branch_id' => \Auth::user()->branch_id]);
        $request->merge(['user_id' => \Auth::user()->id]);
//        if (\auth()->user()->hasRole('branch')) {
//            $request->merge(['date' => Carbon::now()->format('Y-m-d')]);
//        }
        $request->merge(['date' => Carbon::now()->format('Y-m-d')]);

        // Check if a voucher has already been created today
        $today = now()->format('Y-m-d');
        $existingVoucher = Cheque::where('created_at', '>=', $today)
            ->where('created_at', '<', $today . ' 23:59:59')
            ->where('user_id', \Auth::user()->user_id)
            ->first();

        if ($existingVoucher) {
            // Voucher already exists for today, redirect back with error message
            return to_route('cheque.create')->with('status', 'Only one cheque allowed per day.');
        }

//        dd($request->all());

        // Create a new voucher instance
        $voucher = Cheque::create($request->all());

        // Redirect with success message
        return to_route('cheque.index')->with('status', 'Cheque created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cheque $cheque)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cheque $cheque)
    {
        $today = now()->format('Y-m-d'); // Get today's date

        $voucher = $cheque;
        if (Auth::user()->hasRole(['Super-Admin', 'Admin'])) {
            return view('cheques.edit', compact('voucher'));
        } else {
            if ($cheque->date != $today) {
                return to_route('cheques.index')->with('error', 'You cannot edit backdated vouchers.');
            }
        }

        return view('cheques.edit', compact('cheque'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChequeRequest $request, Cheque $cheque)
    {
        $request->merge(['user_id' => \Auth::user()->id]);
        // Update the voucher
        if (\auth()->user()->hasRole('branch')) {
            $request->merge(['date' => Carbon::now()->format('Y-m-d')]);
        }
        $cheque->update($request->all());

        // Redirect with success message
        return to_route('cheque.index')->with('status', 'Cheque updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cheque $cheque)
    {
        $cheque->delete();
        // Redirect with success message
        return to_route('cheque.index')->with('status', 'Cheque deleted successfully.');
    }
}
