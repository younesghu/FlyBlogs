## FlyBlogs

<hr>

## About 
<p>FlyBlogs is a blogging platform built with Laravel. It allows users to create, manage, and share blog posts, including integration with Twitter for easy social sharing. The app includes features like blog scheduling, image uploads, and filtering based on categories.</p>

<p><strong>Features:</strong></p>

<ul>
    <li>Complete Blog post management system: Create, Read, Update, and Delete (CRUD) blog posts.</li>
    <li>Secure user authentication and profile customization.</li>
    <li>Integrated Twitter sharing, allowing both instant and scheduled posts directly to Twitter.</li>
    <li>Interactive commenting system and "like" feature for user engagement.</li>
    <li>Responsive design ensuring optimal display on both desktop and mobile devices.</li>
    <li>Filter and browse blogs by title, category, and description for enhanced searchability.</li>
</ul>

<p><strong>Technologies Used:</strong></p>

<ul>
    <li>PHP (8.x)</li>
    <li>Laravel (10.x)</li>
    <li>OAuth Twitter Integration</li>
    <li>MySQL database</li>
    <li>Tailwind CSS</li>
    <li>OAuth</li>
</ul>

## Installation & Setup

<p>To get the project up and running, follow these steps:</p>

<ul>
  <li><strong>Clone the repository:</strong></li>

  <pre><code>
git clone https://github.com/younesghu/FlyBlogs.git
cd FlyBlogs
  </code></pre>

  <li><strong>Install dependencies:</strong></li>

  <pre><code>
composer install
  </code></pre>

  <li><strong>Create a <code>.env</code> file:</strong></li>

  <pre><code>
cp .env.example .env
  </code></pre>

  <p>Set up your environment variables in <code>.env</code> (e.g., database credentials).</p>

  <li><strong>Generate an application key:</strong></li>

  <pre><code>
php artisan key:generate
  </code></pre>

  <li><strong>Run the database migrations:</strong></li>

  <pre><code>
php artisan migrate
      or
php artisan migrate:fresh --seed
  </code></pre>
  
<strong>Optionally, you can use the <code>migrate:fresh --seed</code> command to reset your database and seed it with sample data. This will include a user with the following details:</strong>

<ul>
  <li><strong>Name:</strong> David Johnson</li>
  <li><strong>Email:</strong> davidjohnson@test</li>
  <li><strong>Password:</strong> password</li>
</ul>

  <li><strong>Start the development server:</strong></li>

  <pre><code>
php artisan serve
  </code></pre>
</ul>

## Twitter Integration Setup

<p>To enable Twitter sharing for blog posts, follow these steps:</p> 
<ul> 
    <li>Go to the <a href="https://developer.twitter.com/">Twitter Developer Portal</a> and create a Twitter app.</li>
    <li>Get your <strong>API Key</strong>, <strong>API Secret Key</strong>, <strong>Access Token</strong>, and <strong>Access Token Secret</strong>.</li>
    <li>Add these credentials to your <code>.env</code> file:</li>
        <pre><code> TWITTER_CLIENT_ID=your-twitter-api-key TWITTER_CLIENT_SECRET=your-twitter-api-secret TWITTER_ACCESS_TOKEN=your-twitter-access-token TWITTER_ACCESS_SECRET=your-twitter-access-secret </code></pre> 
    <li>Ensure the user has linked their Twitter account through OAuth to share posts directly on Twitter.</li> 
</ul>

## Use Case Diagram

![Task App Use Case](https://github.com/user-attachments/assets/625879c4-57dd-4186-9a49-84b4d7e0609f)

## Use Class Diagram

![Blog App Use Case Diagram](https://github.com/user-attachments/assets/8237d079-4755-42bb-9317-ce141c8a83eb)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
