@extends('components.layout')

@section('content')

    <div class="relative overflow-x-auto shadow-md">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-16 py-3">
                        <span class="sr-only">Image</span>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Blog Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Blog Description
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Likes
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Edit
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Remove
                    </th>
                </tr>
            </thead>
            <tbody>
                @unless ($blogs->isEmpty())
                    @foreach ($blogs as $blog)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                        <td class="p-4">
                            <img src="{{$blog->blog_img ? asset('storage/' . $blog->blog_img) : asset('images/nature-pic.jpg')}}" alt="" class="w-16 md:w-32 max-w-full max-h-full" alt="Apple Watch">
                        </td>
                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                            {{$blog->title}}
                        </td>
                        <td class="px-6 py-4 max-w-10 text-gray-600 text-white">
                            <p class="line-clamp-4">{{$blog->content}}</p>
                        </td>
                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                            0
                        </td>
                        <td class="px-6 py-4">
                            <a href="/blogs/{{$blog->id}}/edit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td>
                        <td class="px-6 py-4">
                            <form method="POST" action="/blogs/{{$blog->id}}">
                                @csrf
                                @method('DELETE')
                            <button class="font-medium text-red-600 dark:text-red-500 hover:underline">Remove</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                        <td class="p-4">
                        </td>
                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                        </td>
                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white col-span-full">
                            <p>No Blogs found, go make some</p>
                        </td>
                        <td class="px-6 py-4"></td>
                        <td class="px-6 py-4"></td>
                        <td class="px-6 py-4"></td>
                    </tr>
                @endunless
            </tbody>
        </table>
    </div>

@endsection
