<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    {{-- The whole world belongs to you. --}}
    @role('Super-Admin|admin|circle|division|sub-division')
    <div>
        <label for="bank_div_name" class="block text-gray-700 font-bold mb-2">Division</label>
        <select id="bank_div_name" wire:model.lazy="division" name="filter[branch.bank_div_name]" class="w-full px-3 py-2 border rounded-md text-gray-700 focus:outline-none focus:border-blue-500">
            <option value="">None</option>
            @if(Auth::user()->hasRole(['Super-Admin','admin']))
                @foreach(\App\Models\Branch::orderBy('bank_div_name', 'asc')->groupBy('bank_div_name')->get() as $branch)
                    <option value="{{ $branch->bank_div_name }}">{{ $branch->bank_div_name }}</option>
                @endforeach
            @elseif(Auth::user()->hasRole(['circle']))
                @foreach(\App\Models\Branch::where('circle', Auth::user()->branch->circle)->orderBy('bank_div_name', 'asc')->groupBy('bank_div_name')->get() as $branch)
                    <option value="{{ $branch->bank_div_name }}">{{ $branch->bank_div_name }}</option>
                @endforeach
            @elseif(Auth::user()->hasRole(['division']))
                @foreach(\App\Models\Branch::where('bank_div_code', Auth::user()->branch->bank_div_code)->orderBy('bank_div_name', 'asc')->groupBy('bank_div_name')->get() as $branch)
                    <option value="{{ $branch->bank_div_name }}">{{ $branch->bank_div_name }}</option>
                @endforeach
            @elseif(Auth::user()->hasRole(['sub-division']))
                @foreach(\App\Models\Branch::where('bank_sdiv_code', Auth::user()->branch->bank_sdiv_code)->orderBy('bank_div_name', 'asc')->groupBy('bank_div_name')->get() as $branch)
                    <option value="{{ $branch->bank_div_name }}">{{ $branch->bank_div_name }}</option>
                @endforeach
            @endif
        </select>
    </div>

    <div>
        <label for="bank_sdiv_name" class="block text-gray-700 font-bold mb-2">Sub Division</label>
        <select id="bank_sdiv_name"  wire:model="subdivision" name="filter[branch.bank_sdiv_name]" class="w-full px-3 py-2 border rounded-md text-gray-700 focus:outline-none focus:border-blue-500">
            <option value="">None</option>
            @if(!empty($division))
                @foreach(\App\Models\Branch::orderBy('bank_sdiv_name', 'asc')->groupBy('bank_sdiv_name')->where('bank_div_name', $division)->get() as $branch)
                    <option value="{{ $branch->bank_sdiv_name }}">{{ $branch->bank_sdiv_name }}</option>
                @endforeach
            @endif
        </select>
    </div>
    <div>
        <label for="branch_id" class="block text-gray-700 font-bold mb-2">Branch Name</label>
        <select id="branch_id" name="filter[branch_id]" wire:model="branchname"  class="w-full px-3 py-2 border rounded-md text-gray-700 focus:outline-none focus:border-blue-500">
            <option value="">None</option>
            @if(!empty($subdivision))
                @foreach(\App\Models\Branch::orderBy('bank_name', 'asc')->where('bank_sdiv_name', $subdivision)->get() as $branch)
                    <option value="{{$branch->id}}">{{ $branch->bank_name }}</option>
                @endforeach
            @endif
        </select>
    </div>




    @endrole


    <div>
        <label for="per_page_print" class="block text-gray-700 font-bold mb-2">Per Page Rows</label>
        <select id="per_page_print" name="per_page_print" class="w-full px-3 py-2 border rounded-md text-gray-700 focus:outline-none focus:border-blue-500">
            <option value="">None</option>
            <option value="200">200</option>
            <option value="300">300</option>
            <option value="400">400</option>
            <option value="500">500</option>
            <option value="1000">1000</option>
            <option value="10000">10000</option>
            <option value="20000">20000</option>
        </select>
    </div>


    <div>
        <label for="date_range" class="block text-gray-700 font-bold mb-2">Date Range</label>
        <input class="w-full px-3 py-2 border rounded-md text-gray-700 focus:outline-none focus:border-blue-500" type="search" readonly name="filter[starts_before]" id="date_range">
    </div>
    <div></div>


    <div class="flex items-center justify-between">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Search
        </button>
    </div>
</div>
