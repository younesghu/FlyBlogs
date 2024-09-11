@extends('components.layout')

@section('content')
<div class="relative overflow-x-auto shadow-md">
    <div class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white">
        <div>
            <button class="bg-gray-200 border mt-2 ml-5 border-gray-300 hover:bg-gray-50 rounded-sm px-3 py-1.5" type="button">
                <a href="{{ route('twitter.redirect') }}">Connect a Twitter account</a>
            </button>
        </div>
    </div>
    @if(session('success'))
    <div class="alert alert-success text-center text-green-500">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger text-center text-red-500">
        {{ session('error') }}
    </div>
    @endif

    @if(Auth::user()->twitterAccount)
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">Name</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-white border-b hover:bg-gray-100">
                <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap">
                    <img class="w-10 h-10 rounded-full" src="{{ Auth::user()->twitterAccount->profile_image }}" alt="">
                    <div class="ps-3">
                        <div class="text-base text-gray-900 font-semibold">{{ Auth::user()->twitterAccount->name }}</div>
                        <div class="font-normal text-gray-500">Twitter Account</div>
                    </div>
                </th>
                <td class="px-6 py-4">
                    <div class="flex items-center">
                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> Online
                    </div>
                </td>
                <td class="px-6 py-4">
                    <form action="{{route('twitter.destroy')}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="font-medium text-red-600 hover:underline">Delete Account</button>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
    @else
    <p class="text-center text-gray-800">No Twitter account linked.</p>
    @endif
</div>
@endsection
