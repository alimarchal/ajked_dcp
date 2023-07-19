<?php

use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Models\Voucher;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {





    return to_route('login');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {

        ini_set('max_execution_time', 300);

//        $role1 = Role::find(1);
//        foreach (\App\Models\Branch::all() as $branch)
//        {
////            echo $branch->bank_code_branch . $branch->bank_sdiv_code ."<br>";
//            $user = \App\Models\User::factory()->create([
//                'name' => $branch->bank_code_branch . $branch->bank_sdiv_code ,
//                'username' => $branch->bank_code_branch . $branch->bank_sdiv_code ,
//                'branch_id' => $branch->id,
//                'email' => $branch->bank_code_branch . $branch->bank_sdiv_code .'@ajkced.gok.pk',
//                'password' => \Hash::make('123456'),
//            ]);
//            $user->assignRole($role1);
//        }

        // Branch wise total vouchers
        $branch_wise_total_vouchers = DB::table('vouchers')
            ->join('branches', 'vouchers.branch_id', '=', 'branches.id')
            ->select('branches.bank_name', 'vouchers.branch_id', DB::raw('COUNT(vouchers.branch_id) as total_vouchers'), DB::raw('SUM(vouchers.amount) as total_collection'))
            ->groupBy('vouchers.branch_id')
            ->get();

        $startDate = Carbon::now()->startOfMonth();

//        $six_month_chart = DB::table('vouchers')
//            ->selectRaw("DATE_FORMAT(date, '%b') AS month_name")
//            ->selectRaw('SUM(amount) AS total_amount')
//            ->selectRaw('SUM(total_vouchers) AS total_vouchers')
//            ->where('date', '>=', $startDate)
//            ->groupBy(DB::raw('MONTH(date)'))
//            ->get();

        $month_wise_day = DB::table('vouchers')
            ->select(DB::raw("DATE_FORMAT(date, '%d') as day"), DB::raw("sum(amount) as total_amount"), DB::raw("sum(total_vouchers) as total_vouchers"))
            ->where('date', '>=', $startDate)
            ->groupBy(DB::raw("day(date)"))
            ->get();

        return view('dashboard', compact('branch_wise_total_vouchers','month_wise_day'));

    })->name('dashboard');
    //
    Route::resource('roles',\App\Http\Controllers\RoleController::class);
    Route::resource('permissions',\App\Http\Controllers\PermissionController::class);
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

    Route::resource('voucher',\App\Http\Controllers\VoucherController::class);
    Route::resource('cheque',\App\Http\Controllers\ChequeController::class);
    Route::resource('bt',\App\Http\Controllers\BtController::class);
    Route::resource('branch',\App\Http\Controllers\BranchController::class);


    //reports
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/missing', [ReportController::class, 'missingBranches'])->name('reports.missing');


});
