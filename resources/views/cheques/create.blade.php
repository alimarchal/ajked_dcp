<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Cheque & Total Collection') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <!-- resources/views/users/create.blade.php -->
                    <x-validation-errors class="mb-4" />
                    <form method="POST" action="{{ route('cheque.store') }}">
                        @csrf

                        @role('Super-Admin|Admin')
                        <div>
                            <x-label for="date" value="{{ __('Date') }}" />
                            <x-input id="date" class="block mt-1 w-full" type="date" name="date" :value="old('date')" required value="{{ date('Y-m-d') }}" max="{{date('Y-m-d')}}" />
                        </div>
                        @endrole

                        <div class="mt-4">
                            <x-label for="total_vouchers" value="{{ __('Total Cheques') }}" />
                            <x-input id="total_vouchers" class="block mt-1 w-full" type="number" name="total_vouchers" min="1" :value="old('total_vouchers')" autofocus required />
                        </div>


                        <div class="mt-4">
                            <x-label for="amount" value="{{ __('Total Amount') }}" />
                            <x-input id="amount" class="block mt-1 w-full" type="number" name="amount" step="0.01" min="1" :value="old('amount')" required />
                        </div>


                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Save') }}
                            </x-button>
                        </div>
                    </form>



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
