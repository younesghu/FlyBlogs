@extends('components.layout')

@section('content')

    <section class="max-w-4xl mx-auto">
        {{-- How App Works Section --}}
        <div class="text-center font-serif">
            <h2 class="text-3xl font-extrabold p-4">How It Works</h2>
            <ol class="list-decimal pl-6 space-y-4 text-left mx-auto max-w-2xl">
                <li class="bg-gray-100 p-4 rounded shadow-md">
                    <strong class="text-lg"><a href="/register">Sign up</a></strong> Create an account to start using our platform. It's quick and easy!
                </li>
                <li class="bg-gray-100 p-4 rounded-sm">
                    <strong class="text-lg"><a href="/blogs/create">Create Your Blog:</a></strong> Use our editor to write and format your posts.
                </li>
                <li class="bg-gray-100 p-4 rounded-sm">
                    <strong class="text-lg">Publish and Share:</strong> Publish your content and share it with the world through social media.
                </li>
                <li class="bg-gray-100 p-4 rounded-sm">
                    <strong class="text-lg">Engage with Readers:</strong> Interact with your audience through comments and likes.
                </li>
                <li class="bg-gray-100 p-4 rounded-sm">
                    <strong class="text-lg"><a href="/blogs/manage">Manage and Analyze:</a></strong> Use our dashboard to manage your posts and view analytics.
                </li>
            </ol>
        </div>

        {{-- Features Section --}}
        <div class="font-serif">
            <h2 class="text-3xl font-extrabold mx-auto p-4 text-center">Our Features</h2>
            <ul class="list-disc pl-5 space-y-4">
                <li><strong>User-Friendly Blog Creation:</strong> Easily create and publish your blog posts with our intuitive editor. Customize your content with rich text formatting, add images, and more.</li>
                <li><strong>Manage Your Posts:</strong> Keep track of your blog posts with our management dashboard. Edit, update, or delete posts as needed, and view detailed analytics about your content’s performance.</li>
                <li><strong>Categorize Your Content:</strong> Organize your posts into categories to help your readers find exactly what they’re interested in. Our platform supports multiple categories and tags for easy navigation.</li>
                <li><strong>Social Media Integration:</strong> Share your blog posts directly to your social media accounts. Our platform supports Twitter integration, allowing you to post updates with just a click.</li>
                <li><strong>Comment System:</strong> Engage with your readers through our integrated comment system. Allow readers to leave feedback and participate in discussions on your posts.</li>
                <li><strong>Like and Dislike:</strong> Let your readers express their appreciation or thoughts on your content with our like and dislike buttons.</li>
                <li><strong>Notifications:</strong> Stay updated with real-time notifications about new comments, likes, and other interactions with your posts.</li>
                <li><strong>User Profiles:</strong> Create a personalized profile where you can manage your blog posts, update your settings, and view your activity history.</li>
                <li><strong>Search and Filters:</strong> Find posts quickly with our search functionality and filter options. Easily browse through content based on categories, tags, and keywords.</li>
                <li><strong>Responsive Design:</strong> Enjoy a seamless experience on any device. Our platform is designed to be fully responsive, ensuring that your content looks great whether you’re on a desktop, tablet, or mobile device.</li>
                <li><strong>Secure and Private:</strong> Your data and privacy are important to us. We use secure protocols to protect your information and ensure a safe browsing experience.</li>
                <li><strong>Contact Us:</strong> Have questions or need support? Reach out to mme via our contact form or email us directly at <a href="mailto:yourcontactemail@example.com" class="text-gray-500 underline">younes.guigaho.biz@gmail.com</a>. We’re here to help!</li>
            </ul>
        </div>

        {{-- About Us Section --}}
        <div class="text-center font-serif">
            <h2 class="text-3xl font-extrabold mx-auto p-4">About Us</h2>

            <p class="text-lg">
                At <strong>FlyBlogs</strong>, we are dedicated to providing a seamless blogging experience with a variety of features designed to help you create, share, and engage with content effortlessly. Whether you’re a passionate writer, an avid reader, or someone who enjoys sharing their thoughts with the world, our platform is here to support you every step of the way.
            </p>
        </div>

        {{-- Join Us Section --}}
        <div class="font-serif">
            <h2 class="text-3xl text-center font-extrabold mx-auto p-4">Join Us Today!</h2>
            <p class="text-lg">Start sharing your voice with the world on <strong>FlyBlogs</strong>. We’re excited to have you on board and can’t wait to see what you create!</p>
        </div>
    </section>
@endsection
