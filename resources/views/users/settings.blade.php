@extends('components.layout')

@section('content')
    <section class="bg-white">
        <div class="flex justify-center items-center my-20">
            <div class="w-full bg-gray-50 rounded-sm shadow md:mt-0 sm:max-w-md xl:p-0">

                {{-- Edit Profile Section --}}
                <div class="p-6 space-y-4 md:space-y-6 rounded-sm shadow sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Edit profile
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        {{-- Change Picture --}}
                        <div class="flex items-center">
                            <label for="user_img" class="block mb-2 text-sm font-bold text-gray-900">Change your picture</label>
                            <img id="profile-img" class="mx-auto w-16 h-16 rounded-full hover:border-2 hover:border-gray-500"
                            src="{{ $user->user_img ? asset('storage/' . $user->user_img) : asset('images/img.webp') }}"
                            alt="Profile Image">
                            <input id="file-input" type="file" class="border border-gray-700 bg-white ml-5 p-2 w-full hidden" name="user_img"/>
                        </div>


                        {{-- Change Username and Email --}}
                        <label for="name" class="block text-sm font-bold text-gray-900">Your Username</label>
                        <div>
                            <input type="text" name="name" id="name" class="rounded bg-white border border-gray-500 text-gray-900 sm:text-sm block w-full p-2.5 focus:outline-none" placeholder="name" value="{{$user->name}}">
                        </div>

                        <label for="email" class="block text-sm font-bold text-gray-900">Your email</label>
                        <div>
                            <input type="email" name="email" id="email" class="rounded bg-white border border-gray-500 text-gray-900 sm:text-sm block w-full p-2.5" placeholder="name@company.com" value="{{$user->email}}">
                        </div>

                        {{-- Save Button for Picture, Username and Email --}}
                        <button type="submit" class="w-full rounded bg-gray-200 text-gray-900 font-medium text-sm px-5 py-2.5 text-center">Save Changes</button>
                    </form>
                </div>
                <hr>

                {{-- Reset Password Section --}}
                <div class="p-6 space-y-4 md:space-y-6 rounded-sm shadow sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Reset Password
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="{{route('password.update')}}" method="POST">
                        @method('PUT')
                        @csrf

                        {{-- Current Password Field --}}
                        <label for="current_password" class="block text-sm font-bold text-gray-900">Current Password</label>
                        <div class="relative">
                            <input type="password" name="current_password" id="current_password"
                                class="rounded bg-white border border-gray-500 text-gray-900 sm:text-sm block w-full p-2.5 pr-12 focus:outline-none"
                                placeholder="••••••••" required>
                            <button type="button" class="absolute inset-y-0 right-0 flex items-center px-3 cursor-pointer" onclick="togglePassword('current_password', this)">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </button>
                        </div>

                        {{-- New Password Field --}}
                        <label for="new_password" class="block mb-2 text-sm font-bold text-gray-900">New Password</label>
                        <div class="relative">
                            <input type="password" name="new_password" id="new_password"
                                class="rounded bg-white border border-gray-500 text-gray-900 sm:text-sm block w-full p-2.5 pr-10 focus:outline-none"
                                placeholder="••••••••" required>
                            <button type="button" class="absolute inset-y-0 right-0 flex items-center px-3 cursor-pointer" onclick="togglePassword('new_password', this)">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </button>
                        </div>

                        {{-- Confirm New Password Field --}}
                        <label for="new_password_confirmation" class="block text-sm font-bold text-gray-900">Confirm New Password</label>
                        <div class="relative">
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                class="rounded bg-white border border-gray-500 text-gray-900 sm:text-sm block w-full p-2.5 pr-10 focus:outline-none"
                                placeholder="••••••••" required>
                            <button type="button" class="absolute inset-y-0 right-0 flex items-center px-3 cursor-pointer" onclick="togglePassword('new_password_confirmation', this)">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </button>
                        </div>

                        {{-- Save Button for Password Reset --}}
                        <button type="submit" class="w-full rounded bg-gray-200 text-gray-900 font-medium text-sm px-5 py-2.5 text-center">
                            Change Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

<script>
    function togglePassword(inputId, button) {
        var passwordInput = document.getElementById(inputId);
        var type = passwordInput.type === 'password' ? 'text' : 'password';
        passwordInput.type = type;

        // Toggle eye icon
        button.querySelector('i').classList.toggle('fa-eye');
        button.querySelector('i').classList.toggle('fa-eye-slash');
    }

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

