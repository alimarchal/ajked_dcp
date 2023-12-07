<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-12 gap-6 ">

                @role('Super-Admin|admin')
                <a href="{{ route('cheque.index') }}" class="transform  hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white">
                    <div class="p-5">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="col-span-2">
                                <div class="text-3xl font-bold leading-8">
                                    Cheques
                                </div>

                                <div class="mt-1 text-base font-extrabold text-black">
                                    &nbsp;
                                </div>
                            </div>
                            <div class="col-span-1 flex items-center justify-end">
                                <img src="https://img.icons8.com/?size=128&id=qhI7peyY4aRR&format=png" alt="employees on leave" class="h-12 w-12">
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('bt.index') }}" class="transform  hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white">
                    <div class="p-5 ">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="col-span-2">
                                <div class="text-3xl font-bold leading-8">
                                  BT's
                                </div>
                                <div class="mt-1 text-base  font-extrabold text-black">
                                    &nbsp;
                                </div>
                            </div>
                            <div class="col-span-1 flex items-center justify-end">

                                <img src="https://img.icons8.com/?size=128&id=16369&format=png" alt="legal case" class="h-12 w-12">
                            </div>
                        </div>
                    </div>
                </a>
                @endrole
            </div>


        </div>
    </div>

    @push('modals')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>


        </script>
    @endpush
</x-app-layout>
