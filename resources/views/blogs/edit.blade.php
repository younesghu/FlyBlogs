@extends('components.layout')

@section('content')
<section class="bg-white mt-10">
    <form method="POST" action="/blogs/{{$blog->id}}" class="w-full max-w-lg mx-auto" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    Blog Title
                </label>
                <input class="appearance-none block w-full bg-gray-50 text-gray-900 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none" id="grid-first-name" type="text" name="title" placeholder="Title" value="{{$blog->title}}">
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="categories">
                    Blog Categories
                </label>
                <input class="appearance-none block w-full bg-gray-50 text-gray-900 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none" id="grid-first-name" type="text" name="categories" placeholder="Category" value="{{$blog->categories}}">
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="blog_img">
                    Blog image
                </label>
                <input class="appearance-none block w-full bg-gray-50 text-gray-900 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight" id="blog_img" type="file" name="blog_img" accept="image/*" onchange="previewImage(event)">

                <!-- Preview Image Section -->
                <img id="imgPreview" class="mt-3" src="{{$blog->blog_img ? asset('storage/' . $blog->blog_img) : asset('images/blogimg.jpg')}}" alt="" style="max-width: 100%; height: auto;">
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="content">
                    Blog Content
                </label>
                <textarea class="appearance-none block w-full bg-gray-50 text-gray-900 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none" name="content" rows="10" placeholder="">{{$blog->content}}</textarea>
            </div>
        </div>
        <button type="submit" class="w-full bg-gray-200 text-gray-900 font-medium text-sm px-5 py-2.5 text-center">Update</button>
    </form>
</section>
@endsection

<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('imgPreview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }
</script>
