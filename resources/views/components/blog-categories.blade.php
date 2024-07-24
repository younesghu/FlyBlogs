@props(['categoriesCsv'])

@php
    $categories = explode(',', $categoriesCsv);
@endphp
@foreach ($categories as $category)
    <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-base font-semibold text-gray-600 mr-2 mb-2">
        <a href="/?category={{$category}}">{{$category}}</a>
    </span>
@endforeach
