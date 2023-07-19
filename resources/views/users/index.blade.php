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
        </div>
    </x-slot>

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
                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Name
                            </th>
                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Username
                            </th>
                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Email
                            </th>
                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Role
                            </th>
                            <th scope="col" class="px-1 py-3 border border-black  text-center">
                                Permissions
                            </th>
                        </tr>
                        </thead>
                        <tbody>


                        @foreach ($users as $user)
                            <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                                <th class="border px-2 py-2  border-black font-medium text-black dark:text-white">
                                    {{ $user->id }}
                                </th>
                                <th class="border px-2 py-2 border-black font-medium text-black dark:text-white">
                                    <a href="{{ route('users.edit', $user->id) }}" class="hover:underline text-blue-600">{{ $user->name }}</a>
                                </th>
                                <th class="border px-2 py-2 border-black font-medium text-black dark:text-white">
                                    {{ $user->username }}
                                </th>
                                <th class="border px-2 py-2 border-black font-medium text-black dark:text-white">
                                    {{ $user->email }}
                                </th>

                                <th class="border px-2 py-2 border-black font-medium text-black dark:text-white text-center">
                                    @foreach ($user->roles as $role)
                                        {{ $role->name }}
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </th>

                                <th class="border px-2 py-2 border-black font-medium text-black dark:text-white text-center">
                                    @foreach ($user->getAllPermissions() as $permission)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-500 text-white">
                                                {{ $permission->name }}
                                        </span>
                                    @endforeach

                                    @if($user->hasRole('Super-Admin'))
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-500 text-white">
                                            All Permission Granted
                                        </span>
                                    @endif
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
</x-app-layout>
