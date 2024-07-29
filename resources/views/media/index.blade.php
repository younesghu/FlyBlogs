@extends('components.layout')

@section('content')

<div class="relative overflow-x-auto shadow-md">
    <div class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white">
        <div>
            <button class="bg-gray-200 border mt-2 ml-5 border-gray-300 hover:bg-gray-50 rounded-sm px-3 py-1.5" type="button">
                <a href="{{ url('auth/twitter') }}">Connect a Social Account</a>
            </button>
        </div>
    </div>
    <h1>Media Page</h1>
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif
    {{-- <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-white border-b hover:bg-gray-100">
                <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                    <img class="w-10 h-10 rounded-full" src="" alt="Jese image">
                    <div class="ps-3">
                        <div class="text-base text-gray-900 font-semibold">Neil Sims</div>
                        <div class="font-normal text-gray-500">Instagram Account</div>
                    </div>
                </th>
                <td class="px-6 py-4">
                    <div class="flex items-center">
                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> Online
                    </div>
                </td>
                <td class="px-6 py-4">
                    <a href="#" class="font-medium text-red-600 hover:underline">Delete Account</a>
                </td>
            </tr>
        </tbody>
    </table> --}}
</div>


@endsection
