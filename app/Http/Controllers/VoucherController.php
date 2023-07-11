<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVoucherRequest;
use App\Http\Requests\UpdateVoucherRequest;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;


class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


        // Check if the user has the "Super-Admin" role
        if (Auth::user()->hasRole(['Super-Admin', 'Admin'])) {
            $vouchers = QueryBuilder::for(Voucher::with(['user', 'branch']))
                ->allowedFilters(['date', 'branch.bank_div_name', 'branch.bank_sdiv_name', 'branch_id',
                    AllowedFilter::exact('date'), AllowedFilter::exact('branch_id'),  AllowedFilter::scope('starts_before'),])
                ->join('branches', 'vouchers.branch_id', '=', 'branches.id')
                ->orderBy('vouchers.created_at', 'desc')
                ->paginate(100);
        } else {
            $vouchers = QueryBuilder::for(Voucher::with(['user', 'branch']))
                ->allowedFilters([AllowedFilter::exact('date')])
                ->where('branch_id', Auth::user()->branch_id)
                ->orderBy('created_at', 'desc')
                ->paginate(100);
        }

        return view('vouchers.index', compact('vouchers'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('vouchers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVoucherRequest $request)
    {
        $request->merge(['branch_id' => \Auth::user()->branch_id]);
        $request->merge(['user_id' => \Auth::user()->id]);
        if (\auth()->user()->hasRole('branch')) {
            $request->merge(['date' => Carbon::now()->format('Y-m-d')]);
        }


        // Check if a voucher has already been created today
        $today = now()->format('Y-m-d');
        $existingVoucher = Voucher::where('created_at', '>=', $today)
            ->where('created_at', '<', $today . ' 23:59:59')
            ->where('branch_id', \Auth::user()->branch_id)
            ->first();

        if ($existingVoucher) {
            // Voucher already exists for today, redirect back with error message
            return to_route('voucher.create')->with('status', 'Only one voucher allowed per day.');
        }

        // Create a new voucher instance
        $voucher = Voucher::create($request->all());

        // Redirect with success message
        return to_route('voucher.index')->with('status', 'Voucher created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Voucher $voucher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Voucher $voucher)
    {
        $today = now()->format('Y-m-d'); // Get today's date

        if (Auth::user()->hasRole(['Super-Admin', 'Admin'])) {
            return view('vouchers.edit', compact('voucher'));
        } else {
            if ($voucher->date != $today) {
                return to_route('voucher.index')->with('error', 'You cannot edit backdated vouchers.');
            }
        }

        return view('vouchers.edit', compact('voucher'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVoucherRequest $request, Voucher $voucher)
    {
        $request->merge(['user_id' => \Auth::user()->id]);
        // Update the voucher
        if (\auth()->user()->hasRole('branch')) {
            $request->merge(['date' => Carbon::now()->format('Y-m-d')]);
        }
        $voucher->update($request->all());

        // Redirect with success message
        return to_route('voucher.index')->with('status', 'Voucher updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voucher $voucher)
    {
        $voucher->delete();
        // Redirect with success message
        return to_route('voucher.index')->with('status', 'Voucher deleted successfully.');

    }
}
