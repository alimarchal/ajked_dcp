<x-app-layout>
    @push('custom_headers')
        <link rel="stylesheet" href="https://cms.ajkced.gok.pk/daterange/daterangepicker.min.css">
        <script src="https://cms.ajkced.gok.pk/daterange/jquery-3.6.0.min.js"></script>
        <script src="https://cms.ajkced.gok.pk/daterange/moment.min.js"></script>
        <script src="https://cms.ajkced.gok.pk/daterange/knockout-3.5.1.js" defer></script>
        <script src="https://cms.ajkced.gok.pk/daterange/daterangepicker.min.js" defer></script>
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block">
            @role('Super-Admin|admin')
            {{ __("Collection Lists'") }}
            @endrole


            @role('branch')
            {{ __('Daily Collection Report in ') }} {{ Auth()->user()->branch->bank_name }}
            @endrole
        </h2>


        <div class="flex justify-center items-center float-right">

            @can('create')
                <div class="flex justify-center items-center float-right">
                    <a href="{{ route('bt.create') }}"
                       class="flex items-center px-4 py-2 text-gray-600 bg-white border rounded-lg focus:outline-none hover:bg-gray-100 transition-colors duration-200 transform dark:text-gray-200 dark:border-gray-200  dark:hover:bg-gray-700 ml-2"
                       title="Create New Voucher">
                        <img src="https://img.icons8.com/?size=512&id=f3o1AGoVZ2Un&format=png" class="h-5 w-5" alt="">
                        <span class="hidden md:inline-block ml-2">Create New Voucher</span>
                    </a>
                </div>
            @endcan
            <a href="javascript:;" id="toggle"
               class="flex items-center px-4 py-2 text-gray-600 bg-white border rounded-lg focus:outline-none hover:bg-gray-100 transition-colors duration-200 transform dark:text-gray-200 dark:border-gray-200  dark:hover:bg-gray-700 ml-2"
               title="Members List">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
                <span class="hidden md:inline-block ml-2" style="font-size: 14px;">Search Filters</span>
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto mt-12 px-4 sm:px-6 lg:px-8 print:hidden" style="display: none" id="filters">
        <div class="rounded-xl p-4 bg-white shadow-lg">
            <form action="">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    @role('branch')
                    <div>
                        <label for="start_date" class="block text-gray-700 font-bold mb-2">Start Date</label>
                        <input type="date" name="filter[date]" value="{{ request('filter.date') }}" id="date"
                               class="w-full px-3 py-2 border rounded-md text-gray-700 focus:outline-none focus:border-blue-500">
                    </div>
                    @endrole


                    @role('Super-Admin|Admin')
                    <div>
                        <label for="branch_id" class="block text-gray-700 font-bold mb-2">Branch Name</label>
                        <select id="branch_id" name="filter[branch_id]"
                                class="w-full px-3 py-2 border rounded-md text-gray-700 focus:outline-none focus:border-blue-500">
                            <option value="">None</option>
                            @foreach(\App\Models\Branch::all() as $branch)
                                <option value="{{$branch->id}}">{{ $branch->bank_name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div>
                        <label for="bank_div_name" class="block text-gray-700 font-bold mb-2">Division</label>
                        <select id="bank_div_name" name="filter[branch.bank_div_name]" class="w-full px-3 py-2 border rounded-md text-gray-700 focus:outline-none focus:border-blue-500">
                            <option value="">None</option>
                            @foreach(\App\Models\Branch::orderBy('bank_div_name', 'asc')->groupBy('bank_div_name')->get() as $branch)
                                <option value="{{ $branch->bank_div_name }}">{{ $branch->bank_div_name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div>
                        <label for="bank_sdiv_name" class="block text-gray-700 font-bold mb-2">Sub Division</label>
                        <select id="bank_sdiv_name" name="filter[branch.bank_sdiv_name]" class="w-full px-3 py-2 border rounded-md text-gray-700 focus:outline-none focus:border-blue-500">
                            <option value="">None</option>
                            @foreach(\App\Models\Branch::orderBy('bank_sdiv_name', 'asc')->groupBy('bank_sdiv_name')->get() as $branch)
                                <option value="{{ $branch->bank_sdiv_name }}">{{ $branch->bank_sdiv_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="date_range" class="block text-gray-700 font-bold mb-2">Date Range</label>
                        <input class="w-full px-3 py-2 border rounded-md text-gray-700 focus:outline-none focus:border-blue-500" type="search" readonly name="filter[starts_before]" id="date_range">
                    </div>
                    @endrole

                    <div>
                    </div>
                    <div>
                    </div>
                    <div>
                    </div>

                    <div>
                    </div>


                    <div class="flex items-center justify-between">
                        <button
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="submit">
                            Search
                        </button>
                    </div>


                </div>


            </form>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg print:shadow-none">
                <div class="overflow-x-auto p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <!-- resources/views/users/create.blade.php -->
                    <table
                        class="mb-4 w-full text-sm border-collapse border border-slate-400 text-left text-black dark:text-gray-400">
                        <thead class="text-black uppercase bg-gray-50 dark:bg-gray-700 ">
                        <tr>
                            <th scope="col" class="px-1 py-3 border border-black">
                                VID
                            </th>
                            <th scope="col" class="px-1 py-3 border border-black text-center">
                                User
                            </th>

{{--                            <th scope="col" class="px-1 py-3 border border-black text-center">--}}
{{--                                Branch Name--}}
{{--                            </th>--}}

{{--                            <th scope="col" class="px-1 py-3 border border-black text-center">--}}
{{--                                Div--}}
{{--                            </th>--}}

{{--                            <th scope="col" class="px-1 py-3 border border-black text-center">--}}
{{--                                Sub Div--}}
{{--                            </th>--}}
                            <th scope="col" class="px-1 py-3 border border-black text-center">
                                Date
                            </th>
                            <th scope="col" class="px-1 py-3 border border-black text-center">
                                Vouchers
                            </th>
                            <th scope="col" class="px-1 py-3 border border-black text-center">
                                Amount
                            </th>
                            <th scope="col" class="px-1 py-3 border border-black text-center print:hidden">
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody>


                        @foreach ($vouchers as $voucher)
                            <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                                <td class="border px-2 py-2 border-black font-medium text-black dark:text-white">
                                    {{ $voucher->id }}
                                </td>
                                <td class="border px-2 py-2 border-black font-medium text-black dark:text-white text-center">
                                    {{ $voucher->user->name }}
                                </td>



{{--                                <td class="border px-2 py-2 border-black font-medium text-black dark:text-white text-center">--}}
{{--                                    {{ $voucher->branch->bank_name }}--}}
{{--                                </td>--}}


{{--                                <td class="border px-2 py-2 border-black font-medium text-black dark:text-white text-center">--}}
{{--                                    {{ $voucher->branch->bank_div_name }}--}}
{{--                                </td>--}}

{{--                                <td class="border px-2 py-2 border-black font-medium text-black dark:text-white text-center">--}}
{{--                                    {{ $voucher->branch->bank_sdiv_name }}--}}
{{--                                </td>--}}

                                <td class="border px-2 py-2 border-black font-medium text-black dark:text-white text-center">
                                    {{ \Carbon\Carbon::parse($voucher->date)->format('d-m-Y') }}
                                </td>
                                <td class="border px-2 py-2 border-black font-medium text-black dark:text-white text-center">
                                    {{ $voucher->total_vouchers }}
                                </td>
                                <td class="border px-2 py-2 border-black font-medium text-black dark:text-white text-center">
                                    @if($voucher->amount > 999999)
                                        {{ number_format($voucher->amount/1000000,3) }} M
                                    @else
                                        {{ number_format($voucher->amount,2) }}
                                    @endif
                                </td>
                                <td class="border px-2 py-2 border-black font-medium text-black dark:text-white text-center print:hidden">

                                    <a href="{{ route('bt.edit', $voucher->id) }}"
                                       class="inline-flex items-center px-4 py-2 bg-green-800 dark:bg-green-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Edit</a>
                                    @can('delete')
                                        <form action="{{ route('bt.destroy', $voucher->id) }}" method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this role?');"
                                              class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center px-4 py-2 bg-red-800 dark:bg-red-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-red-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-red-900 dark:active:bg-red-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                                Delete
                                            </button>
                                        </form>
                                    @endcan

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                                <td class="border px-2 py-2 border-black  font-extrabold text-black text-right dark:text-white" colspan="3">
                                    Total:
                                </td>

                                <td class="border px-2 py-2 border-black  font-extrabold text-black text-center dark:text-white">
                                    {{ number_format($vouchers->sum('total_vouchers'),2) }}
                                </td>

                                <td class="border px-2 py-2 border-black font-extrabold text-black text-center dark:text-white">
                                    {{ number_format($vouchers->sum('amount'),2) }}
                                </td>
                                <td class="border px-2 py-2 border-black font-medium text-black text-center dark:text-white print:hidden" >
                                </td>
                            </tr>
                        </tfoot>
                    </table>


{{--                    {{ $vouchers->links() }}--}}

                </div>
            </div>
        </div>
    </div>


    @push('modals')
        <script>


            $(document).ready(function () {

                $("#date_range").daterangepicker({
                    minDate: moment().subtract(10, 'years'),
                    orientation: 'left',
                    callback: function (startDate, endDate, period) {
                        $(this).val(startDate.format('L') + ' – ' + endDate.format('L'));
                    }
                });
            });

            const targetDiv = document.getElementById("filters");
            const btn = document.getElementById("toggle");
            btn.onclick = function () {
                if (targetDiv.style.display !== "none") {
                    targetDiv.style.display = "none";
                } else {
                    targetDiv.style.display = "block";
                }
            };
        </script>
    @endpush
</x-app-layout>
