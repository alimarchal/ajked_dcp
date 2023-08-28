<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Voucher & Total Collection') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <!-- resources/views/users/create.blade.php -->
                    <x-validation-errors class="mb-4" />
                    <form method="POST" action="{{ route('branch.store') }}">
                        @csrf

                        <div class="mt-4">
                            <x-label for="bank_code" value="{{ __('Bank Code') }}" />
                            <select name="bank_code" id="bank_code" class="block mt-1 w-full" >
                                <option value="">None</option>
                                @foreach(\App\Models\Branch::groupBy('bank_code')->whereNotNull('bank_code')->get() as $branch)
                                    <option value="{{ $branch->bank_code }}">{{ $branch->bank_code }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mt-4">
                            <x-label for="bank_code_branch" value="{{ __('Bank Branch Code') }}" />
                            <x-input id="bank_code_branch" class="block mt-1 w-full" type="text" name="bank_code_branch" min="1" :value="old('bank_code_branch')" required />
                        </div>




                        <div class="mt-4">
                            <x-label for="id" value="{{ __('Bank Sub Division Name') }}" />
                            <select name="id" id="bank_sdiv_code" class="block mt-1 w-full" >
                                <option value="">None</option>
                                @foreach(\App\Models\Branch::groupBy('bank_sdiv_name')->get() as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->bank_sdiv_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-label for="bank_name" value="{{ __('Bank Name') }}" />
                            <x-input id="bank_name" class="block mt-1 w-full" type="text" name="bank_name" step="0.01" min="1" :value="old('bank_name')" required />
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
    @push('modals')
        <script>
            $('form').submit(function(){
                $(this).find(':submit').attr('disabled','disabled');
            });
        </script>
    @endpush
</x-app-layout>
