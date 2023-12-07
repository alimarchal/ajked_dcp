<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block">
            {{ __('Create New Role') }}
        </h2>

        <div class="flex justify-center items-center float-right">
            <a href="{{ route('users.create') }}"
               class="flex items-center px-4 py-2 text-gray-600 bg-white border rounded-lg focus:outline-none hover:bg-gray-100 transition-colors duration-200 transform dark:text-gray-200 dark:border-gray-200  dark:hover:bg-gray-700 ml-2"
               title="Members List">
                <img src="https://img.icons8.com/?size=512&id=f3o1AGoVZ2Un&format=png" class="h-5 w-5" alt="">
                <span class="hidden md:inline-block ml-2">Create New User</span>
            </a>

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
                    <!-- Circle Field -->
                    <div>
                        <label for="circle" class="block text-gray-700 font-bold mb-2">Circle</label>
                        <select id="circle" name="filter[branch.circle]" class="w-full px-3 py-2 border rounded-md text-gray-700 focus:outline-none focus:border-blue-500">
                            <option value="">None</option>
                            @foreach ($circles as $circle)
                                <option value="{{ $circle->circle }}"
                                        {{ (is_array(request()->input('filter')) && request()->input('filter')['branch.circle'] == $circle->circle) ? 'selected' : '' }}>
                                    {{ $circle->circle }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Per Page Rows Field -->
                    <div>
                        <label for="perPage" class="block text-gray-700 font-bold mb-2">Per Page Rows</label>
                        <select id="perPage" name="perPage" class="w-full px-3 py-2 border rounded-md text-gray-700 focus:outline-none focus:border-blue-500">
                            <option value="">None</option>
                            @foreach ([5, 10, 50, 100, 200, 500, 1000, 2000, 5000] as $perPageOption)
                                <option value="{{ $perPageOption }}"
                                        {{ request('perPage') == $perPageOption ? 'selected' : '' }}>
                                    {{ $perPageOption }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Other Fields and Submit Button -->
                    <div></div>
                    <div class="flex items-center justify-between">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                            Search
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div
                        class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <!-- resources/views/users/create.blade.php -->


                    <table
                            class="w-full mb-4 text-sm border-collapse border border-slate-400 text-left text-black dark:text-gray-400">
                        <thead class="text-black uppercase bg-gray-50 dark:bg-gray-700 ">
                        <tr>
                            <th scope="col" class="px-1 py-3 border border-black ">
                                ID
                            </th>
                            {{--                            <th scope="col" class="px-1 py-3 border border-black  text-center">--}}
                            {{--                                Name--}}
                            {{--                            </th>--}}
                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Username
                            </th>
                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Bank Name
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Division
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Sub Division
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Circle
                            </th>
                            {{--                            <th scope="col" class="px-1 py-3 border border-black  text-center">--}}
                            {{--                                Role--}}
                            {{--                            </th>--}}
                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Permissions
                            </th>
                        </tr>
                        </thead>
                        <tbody>


                        @foreach ($users as $user)
                            <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                                <th class="border px-2 py-2  border-black font-medium text-black dark:text-white">
                                    {{ $loop->iteration }}
                                </th>
                                {{--                                <th class="border px-2 py-2 border-black font-medium text-black dark:text-white">--}}
                                {{--                                    <a href="{{ route('users.edit', $user->id) }}" class="hover:underline text-blue-600">{{ $user->name }}</a>--}}
                                {{--                                </th>--}}
                                <th class="border px-2 py-2 border-black font-medium text-black dark:text-white">
                                    <a href="{{ route('users.edit', $user->id) }}" class="hover:underline text-blue-600">
                                        {{ $user->username }}
                                    </a>


                                </th>


                                <th class="border px-2 py-2 border-black font-medium text-black dark:text-white">
                                    {{--                                    {{ $user->email }}--}}
                                    @if(!empty($user->branch))
                                        {{ $user->branch->bank_name }}
                                    @endif

                                </th>

                                <th class="border px-2 py-2 border-black font-medium text-black dark:text-white">
                                    @if(!empty($user->branch))
                                        {{ $user->branch->bank_div_name }}
                                    @endif
                                </th>

                                <th class="border px-2 py-2 border-black font-medium text-black dark:text-white">
                                    @if(!empty($user->branch))
                                        {{ $user->branch->bank_sdiv_name }}
                                    @endif
                                </th>

                                <th class="border px-2 py-2 border-black font-medium text-black dark:text-white">
                                    @if(!empty($user->branch))
                                        {{ $user->branch->circle }}
                                    @endif
                                </th>

                                {{--                                <th class="border px-2 py-2 border-black font-medium text-black dark:text-white text-center">--}}
                                {{--                                    @foreach ($user->roles as $role)--}}
                                {{--                                        {{ $role->name }}--}}
                                {{--                                        @if (!$loop->last)--}}
                                {{--                                            ,--}}
                                {{--                                        @endif--}}
                                {{--                                    @endforeach--}}
                                {{--                                </th>--}}

                                <th class="border px-2 py-2 border-black font-medium text-black dark:text-white text-center">
                                    @foreach ($user->roles as $role)
                                        {{ $role->name }}
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                    {{--                                    @foreach ($user->getAllPermissions() as $permission)--}}
                                    {{--                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-500 text-white">--}}
                                    {{--                                                {{ $permission->name }}--}}
                                    {{--                                        </span>--}}
                                    {{--                                    @endforeach--}}

                                    {{--                                    @if($user->hasRole('Super-Admin'))--}}
                                    {{--                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-500 text-white">--}}
                                    {{--                                            All Permission Granted--}}
                                    {{--                                        </span>--}}
                                    {{--                                    @endif--}}
                                </th>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>


                    {{ $users->links() }}

                </div>

            </div>
        </div>
    </div>

    @push('modals')
        <script>
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
