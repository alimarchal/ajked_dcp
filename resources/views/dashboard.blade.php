<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-12 gap-6 ">
                @role('branch')
                    <a href="#" class="transform  hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white">
                    <div class="p-5">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="col-span-2">
                                <div class="text-3xl font-bold leading-8">
                                    {{ \App\Models\Voucher::where('user_id', Auth::user()->id)->whereDay('date',now())->sum('total_vouchers') }}
                                </div>

                                <div class="mt-1 text-base font-extrabold text-black">
                                    Today Voucher
                                </div>
                            </div>
                            <div class="col-span-1 flex items-center justify-end">
                                <img src="https://img.icons8.com/?size=128&id=42795&format=png" alt="employees on leave" class="h-12 w-12">
                            </div>
                        </div>
                    </div>
                </a>
                    <a href="#" class="transform  hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white">
                    <div class="p-5 ">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="col-span-2">
                                <div class="text-3xl font-bold leading-8">
{{--                                    @if(\App\Models\Voucher::where('user_id', Auth::user()->id)->sum('amount') > 1000000)--}}
{{--                                        {{ number_format(\App\Models\Voucher::where('user_id', Auth::user()->id)->whereDay('date',now())->sum('amount')/1000000,3) }} M--}}
{{--                                    @else--}}
{{--                                        {{ number_format(\App\Models\Voucher::where('user_id', Auth::user()->id)->whereDay('date',now())->sum('amount'),2) }}--}}
{{--                                    @endif--}}
                                    {{ number_format(\App\Models\Voucher::where('user_id', Auth::user()->id)->whereDay('date',now())->sum('amount'),2) }}

                                </div>
                                <div class="mt-1 text-base  font-extrabold text-black">
                                    Today Collection
                                </div>
                            </div>
                            <div class="col-span-1 flex items-center justify-end">

                                <img src="https://img.icons8.com/?size=128&id=103813&format=png" alt="legal case" class="h-12 w-12">
                            </div>
                        </div>
                    </div>
                </a>
                    <a href="#" class="transform  hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white">
                    <div class="p-5">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="col-span-2">
                                <div class="text-3xl font-bold leading-8">
                                    {{ \App\Models\Voucher::where('user_id', Auth::user()->id)->whereMonth('date',now())->sum('total_vouchers') }}
                                </div>

                                <div class="mt-1 text-base font-extrabold text-black">
                                    Total Vouchers {{ Carbon\Carbon::now()->format('M-Y') }}
                                </div>
                            </div>
                            <div class="col-span-1 flex items-center justify-end">
                                <img src="https://img.icons8.com/?size=128&id=42795&format=png" alt="employees on leave" class="h-12 w-12">
                            </div>
                        </div>
                    </div>
                </a>
                    <a href="#" class="transform  hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white">
                    <div class="p-5 ">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="col-span-2">
                                <div class="text-3xl font-bold leading-8">
{{--                                    @if(\App\Models\Voucher::where('user_id', Auth::user()->id)->sum('amount') > 1000000)--}}
{{--                                        {{ number_format(\App\Models\Voucher::where('user_id', Auth::user()->id)->whereMonth('date',now())->sum('amount')/1000000,3) }} M--}}
{{--                                    @else--}}
{{--                                        {{ number_format(\App\Models\Voucher::where('user_id', Auth::user()->id)->whereMonth('date',now())->sum('amount'),2) }}--}}
{{--                                    @endif--}}

                                        {{ number_format(\App\Models\Voucher::where('user_id', Auth::user()->id)->whereMonth('date',now())->sum('amount'),2) }}

                                </div>
                                <div class="mt-1 text-base  font-extrabold text-black">
                                    Total Collection  {{ Carbon\Carbon::now()->format('M-y') }}
                                </div>
                            </div>
                            <div class="col-span-1 flex items-center justify-end">

                                <img src="https://img.icons8.com/?size=128&id=103813&format=png" alt="legal case" class="h-12 w-12">
                            </div>
                        </div>
                    </div>
                </a>
                @endrole

                @role('Super-Admin|admin')
                    <a href="#" class="transform  hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white">
                        <div class="p-5">
                            <div class="grid grid-cols-3 gap-1">
                                <div class="col-span-2">
                                    <div class="text-3xl font-bold leading-8">
                                        {{ \App\Models\Voucher::whereDay('date',now())->sum('total_vouchers') }}
                                    </div>

                                    <div class="mt-1 text-base font-extrabold text-black">
                                        Today Voucher
                                    </div>
                                </div>
                                <div class="col-span-1 flex items-center justify-end">
                                    <img src="https://img.icons8.com/?size=128&id=42795&format=png" alt="employees on leave" class="h-12 w-12">
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="transform  hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white">
                        <div class="p-5 ">
                            <div class="grid grid-cols-3 gap-1">
                                <div class="col-span-2">
                                    <div class="text-3xl font-bold leading-8">
{{--                                        @if(\App\Models\Voucher::whereDay('date',now())->sum('amount') > 1000000)--}}
{{--                                            {{ number_format(\App\Models\Voucher::whereDay('date',now())->sum('amount')/1000000,3) }} M--}}
{{--                                        @else--}}
{{--                                            {{ number_format(\App\Models\Voucher::whereDay('date',now())->sum('amount'),2) }}--}}
{{--                                        @endif--}}

                                            {{ number_format(\App\Models\Voucher::whereDay('date',now())->sum('amount'),2) }}

                                    </div>
                                    <div class="mt-1 text-base  font-extrabold text-black">
                                        Today Collection
                                    </div>
                                </div>
                                <div class="col-span-1 flex items-center justify-end">

                                    <img src="https://img.icons8.com/?size=128&id=103813&format=png" alt="legal case" class="h-12 w-12">
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="transform  hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white">
                        <div class="p-5">
                            <div class="grid grid-cols-3 gap-1">
                                <div class="col-span-2">
                                    <div class="text-3xl font-bold leading-8">
                                        {{ \App\Models\Voucher::whereMonth('date',now())->sum('total_vouchers') }}
                                    </div>

                                    <div class="mt-1 text-base font-extrabold text-black">
                                         Vouchers  {{ Carbon\Carbon::now()->format('M-Y') }}
                                    </div>
                                </div>
                                <div class="col-span-1 flex items-center justify-end">
                                    <img src="https://img.icons8.com/?size=128&id=42795&format=png" alt="employees on leave" class="h-12 w-12">
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="transform  hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white">
                        <div class="p-5 ">
                            <div class="grid grid-cols-3 gap-1">
                                <div class="col-span-2">
                                    <div class="text-3xl font-bold leading-8">
{{--                                        @if(\App\Models\Voucher::whereMonth('date',now())->sum('amount') > 1000000)--}}
{{--                                            {{ number_format(\App\Models\Voucher::whereMonth('date',now())->sum('amount')/1000000,3) }} M--}}
{{--                                        @else--}}
{{--                                            {{ number_format(\App\Models\Voucher::whereMonth('date',now())->sum('amount'),2) }}--}}
{{--                                        @endif--}}

                                            {{ number_format(\App\Models\Voucher::whereMonth('date',now())->sum('amount'),2) }}

                                    </div>
                                    <div class="mt-1 text-base  font-extrabold text-black">
                                         Collection  {{ Carbon\Carbon::now()->format('M-Y') }}
                                    </div>
                                </div>
                                <div class="col-span-1 flex items-center justify-end">
                                    <img src="https://img.icons8.com/?size=128&id=103813&format=png" alt="legal case" class="h-12 w-12">
                                </div>
                            </div>
                        </div>
                    </a>
                @endrole
            </div>


            @role('Super-Admin|Admin')
            <div class="grid grid-cols-1 gap-4 pt-8">
                <div class="bg-white shadow-xl rounded-lg p-4" id="chart2">
                    <div id="chart2"></div>
                </div>

                <div class="bg-white  shadow-xl rounded-lg p-4" id="chart">
                    <div id="chart"></div>
                </div>
            </div>
            @endrole

        </div>
    </div>

    @push('modals')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>

            // var options = {
            {{--    series: [@foreach($branch_wise_total_vouchers as $bw) {{$bw->total_vouchers}}, @endforeach],--}}
            {{--    chart: {--}}
            {{--        width: 500,--}}
            {{--        height: 300,--}}
            {{--        type: 'pie',--}}
            {{--    },--}}
            {{--    labels: [@foreach($branch_wise_total_vouchers as $bw) '{{$bw->bank_name}}', @endforeach],--}}
            {{--    responsive: [{--}}
            {{--        breakpoint: 480,--}}
            {{--        options: {--}}
            {{--            chart: {--}}
            {{--                width: 500--}}
            {{--            },--}}
            {{--            legend: {--}}
            {{--                position: 'bottom'--}}
            {{--            },--}}
            {{--        }--}}
            {{--    }]--}}
            {{--};--}}







            var options = {
                series: [{
                    name: 'Vouchers: ',
                    data: [@foreach($month_wise_day as $row) {{ ($row->total_vouchers) }}, @endforeach]
                }
                ],
                chart: {
                    type: 'bar',
                    height: 350
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: [@foreach($month_wise_day as $row) '{{$row->day}}', @endforeach],
                },
                yaxis: {
                    title: {
                        text: 'Last 30 days vouchers'
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return " " + val + " "
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();





            var options2 = {
                series: [{
                    name: 'Amount (million)',
                    data: [@foreach($month_wise_day as $row) {{ ($row->total_amount/1000000) }}, @endforeach]
                }
                ],
                chart: {
                    type: 'bar',
                    height: 350
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: [@foreach($month_wise_day as $row) '{{$row->day}}', @endforeach],
                },
                yaxis: {
                    title: {
                        text: 'Last 30 days PKR (thousands)'
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return " " + val + " "
                        }
                    }
                }
            };

            var chart2 = new ApexCharts(document.querySelector("#chart2"), options2);
            chart2.render();




        </script>
    @endpush
</x-app-layout>
