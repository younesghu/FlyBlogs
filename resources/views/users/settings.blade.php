@extends('components.layout')

@section('content')
<section class="bg-white">
    <div class="flex justify-center items-center my-20">
        <div class="w-full bg-gray-50 rounded-sm shadow dark:border md:mt-0 sm:max-w-md xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Edit profile
                </h1>
                <form class="space-y-4 md:space-y-6" action="{{ route('users.update') }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="flex items-center">
                        <!-- Image that will trigger the file input -->
                        <label for="user_img" class="block mb-2 text-sm font-bold text-gray-900">Change your picture</label>
                        <img id="profile-img" class="mx-auto w-16 h-16 rounded-full hover:border-2 hover:border-gray-300"
                            src="{{ $user->user_img ? asset('storage/' . $user->user_img) : asset('images/img.webp') }}"
                            alt="Profile Image">
                        <!-- Hidden file input -->
                        <input id="file-input" type="file" class="border border-gray-700 bg-white ml-5 p-2 w-full hidden" name="user_img"/>
                    </div>
                    <div>
                        <label for="name" class="block mb-2 text-sm font-bold text-gray-900">Your Username</label>
                        <input type="text" name="name" id="name" class="bg-white border border-gray-500 text-gray-900 sm:text-sm block w-full p-2.5 focus:outline-none" placeholder="name" value="{{$user->name}}">
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-bold text-gray-900">Your email</label>
                        <input type="email" name="email" id="email" class="bg-white border border-gray-500 text-gray-900 sm:text-sm block w-full p-2.5" placeholder="name@company.com" value="{{$user->email}}">
                    </div>
                    <button type="submit" class="w-full bg-gray-200 text-gray-900 font-medium text-sm px-5 py-2.5 text-center">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var profileImg = document.getElementById('profile-img');
        var fileInput = document.getElementById('file-input');

        if (profileImg && fileInput) {
            profileImg.addEventListener('click', function() {
                fileInput.click();
            });

            fileInput.addEventListener('change', function() {
                var file = fileInput.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        profileImg.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    });
</script>
