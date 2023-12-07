<div>
    {{-- The Master doesn't talk, he acts. --}}

    <div class="mt-4">
        <x-label for="role" value="{{ __('Role') }}"/>
        <select name="role" wire:model="selectedRole" id="role" class="block mt-1 w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm">
            <option value="">Select a role</option>
            @foreach ($roles as $id => $name)
                <option value="{{ $id }}" {{ old('role') == $id ? 'selected' : '' }}>{{ $name }}</option>
            @endforeach
        </select>
    </div>


    @if(!empty($selectedRole))
        @if($selectedRole == 1)
            <div class="mt-4">
                <x-label for="branch_id" value="{{ __('Branch') }}"/>
                <select name="branch_id" id="branch_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm">
                    <option value="">Select a branch</option>
                    @foreach (\App\Models\Branch::orderBy('bank_div_code')->get() as $branch)
                        <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>{{ $branch->bank_name }} - DIV:{{ $branch->bank_div_name }} - SUBD:{{ $branch->bank_sdiv_name }}</option>
                    @endforeach
                </select>
            </div>
        @elseif($selectedRole == 3 || $selectedRole == 2)
            <div class="mt-4">
                <x-label for="branch_id" value="{{ __('Access Level') }}"/>
                <select name="branch_id" id="branch_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm">
                    <option value="NULL">Full Access</option>
                </select>
            </div>

        @elseif($selectedRole == 4)
            <div class="mt-4">
                <x-label for="branch_id" value="{{ __('Access Level') }}"/>
                <select name="branch_id" id="branch_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm">
                    <option value="">Select a circle</option>
                    @foreach (\App\Models\Branch::groupBy('circle')->get() as $branch)
                        <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>{{ $branch->circle }}</option>
                    @endforeach
                </select>
            </div>

        @elseif($selectedRole == 5)
            <div class="mt-4">
                <x-label for="branch_id" value="{{ __('Access Level') }}"/>
                <select name="branch_id" id="branch_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm">
                    <option value="">Select a division</option>
                    @foreach (\App\Models\Branch::groupBy('bank_div_name')->get() as $branch)
                        <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>{{ $branch->bank_div_name }}</option>
                    @endforeach
                </select>
            </div>

        @elseif($selectedRole == 6)
            <div class="mt-4">
                <x-label for="branch_id" value="{{ __('Access Level') }}"/>
                <select name="branch_id" id="branch_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm">
                    <option value="">Select a division</option>
                    @foreach (\App\Models\Branch::groupBy('bank_sdiv_name')->get() as $branch)
                        <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>DIVISION: {{ $branch->bank_div_name }} - SUB DIVISION: {{ $branch->bank_sdiv_name }}</option>
                    @endforeach
                </select>
            </div>

        @endif
    @endif

    {{--    <div class="mt-4">--}}
    {{--        <x-label for="branch_id" value="{{ __('Branch') }}" />--}}
    {{--        <select name="branch_id" id="branch_id"  class="block mt-1 w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm" >--}}
    {{--            <option value="">Select a branch</option>--}}
    {{--            @foreach (\App\Models\Branch::orderBy('bank_div_code')->get() as $branch)--}}
    {{--                <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>{{ $branch->bank_name }} - DIV:{{ $branch->bank_div_name }} - SUBD:{{ $branch->bank_sdiv_name }} - Circle: {{ $branch->circle }}</option>--}}
    {{--            @endforeach--}}
    {{--        </select>--}}
    {{--    </div>--}}
</div>
