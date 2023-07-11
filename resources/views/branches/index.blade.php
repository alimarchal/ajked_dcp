<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block">
            {{ __('Branches List') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div
                    class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <!-- resources/views/users/create.blade.php -->


                    <table
                        class="mb-4 w-full text-sm border-collapse border border-slate-400 text-left text-black dark:text-gray-400">
                        <thead class="text-black uppercase bg-gray-50 dark:bg-gray-700 ">
                        <tr>
                            <th scope="col" class="px-1 py-3 border border-black">
                                SID
                            </th>
                            <th scope="col" class="px-1 py-3 border border-black text-center">
                                Bank Code
                            </th>
                            <th scope="col" class="px-1 py-3 border border-black text-center">
                                Br. Code
                            </th>
                            <th scope="col" class="px-1 py-3 border border-black text-center">
                                Bank Name
                            </th>
                            <th scope="col" class="px-1 py-3 border border-black text-center">
                                Div Code
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black text-center">
                                Div Name
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black text-center">
                                Sub Div Code
                            </th>

                            <th scope="col" class="px-1 py-3 border border-black text-center">
                                Sub Div Name
                            </th>
{{--                            <th scope="col" class="px-1 py-3 border border-black text-center">--}}
{{--                                Actions--}}
{{--                            </th>--}}
                        </tr>
                        </thead>
                        <tbody>


                        @foreach ($branches as $branch)
                            <tr class="bg-white  border-b dark:bg-gray-800 dark:border-black text-left">
                                <td class="border px-2 py-2 border-black font-medium text-black dark:text-white">
                                    {{ $branch->id }}
                                </td>
                                <td class="border px-2 py-2 border-black font-medium text-black dark:text-white text-center">
                                    {{ $branch->bank_code }}
                                </td>
                                <td class="border px-2 py-2 border-black font-medium text-black dark:text-white text-left">
                                    {{ $branch->bank_code_branch }}
                                </td>

                                <td class="border px-2 py-2 border-black font-medium text-black dark:text-white text-left">
                                    {{ $branch->bank_name }}
                                </td>
                                <td class="border px-2 py-2 border-black font-medium text-black dark:text-white text-center">
                                    {{ $branch->bank_div_code }}
                                </td>
                                <td class="border px-2 py-2 border-black font-medium text-black dark:text-white text-center">
                                    {{ $branch->bank_div_name }}
                                </td>

                                <td class="border px-2 py-2 border-black font-medium text-black dark:text-white text-center">
                                    {{ $branch->bank_sdiv_code }}
                                </td>

                                <td class="border px-2 py-2 border-black font-medium text-black dark:text-white text-center">
                                    {{ $branch->bank_sdiv_name }}
                                </td>

{{--                                <td class="border px-2 py-2 border-black font-medium text-black dark:text-white text-center">--}}

{{--                                        <a href="{{ route('voucher.edit', $voucher->id) }}" class="inline-flex items-center px-4 py-2 bg-green-800 dark:bg-green-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Edit</a>--}}
{{--                                        <form action="{{ route('voucher.destroy', $voucher->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this role?');" class="inline-block">--}}
{{--                                            @csrf--}}
{{--                                            @method('DELETE')--}}
{{--                                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-800 dark:bg-red-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-red-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-red-900 dark:active:bg-red-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Delete</button>--}}
{{--                                        </form>--}}
{{--                                </td>--}}
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

{{ $branches->links() }}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
