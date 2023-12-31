<h1>CodeParadise | Laravel 10 Bookstore project</h1>

<p>This is my major Laravel project I started in August 2023. The goal of the project is to delve into Backend Development.  While working on CodeParadise I've gained knowledge and learned skills including:</p>

<ul>
    <li>Using migrations, factories, and seeders for convenient database work (You can check DB in root directory -> DatabaseStructure.png)</li>
    <li>Models: relations (one-to-one, one-to-many, many-to-many), scopes, custom methods</li>
<br>
    <li>Extracting validation and business logic from controllers using requests and services</li>
    <li>Inversion of Control: injecting services (Dependency Injection)</li>
    <li>Using DTOs to have more control over data transmission</li>
    <li>Catching errors</li>
    <li>Throwing custom errors</li>
<br>
    <li>Uploading files</li>
<br>
    <li>Basic routing, route parameters, groups, middlewares, prefixes, naming, and route-model binding</li>
    <li>Performing CRUD operations</li>
    <li>Form requests, @csrf</li>
    <li>Performing redirects</li>
    <li>Flashing session data</li>
<br> 
    <li>Solving N+1 Query Problem in project using Eager Loading </li>
    <li>Implementing a live searching/filtering system using Spatie Query Builder + AJAX</li>
    <li>Monitoring application requests with Laravel Telescope</li>
<br>    
    <li>Authorization and email verification</li>
    <li>Integrating re:captcha</li>
    <li>Assigning roles and managing access control through middlewares and gates</li>
<br>
    <li>Implementing a cart and payment system: initially using sessions, then with a database</li>
    <li>Using database transactions</li>
    <li>Integrating the Stripe payment system</li>
<br>
    <li>Using blade @yield and @include directives, variables, if-else statements, loop structures </li>
    <li>Pushing data into views with View::composer</li>
    <li>Using Vite</li>
<br>
    <li>Performing AJAX requests, rendering data without page reload </li>
</ul>

<h2>Deployment</h2>

<p> Clone directory </p>

<strong><code>git clone https://github.com/white-paprika/CodeParadise.git</code></strong><br>

<p> Create a database CodeParadiseDB and fill .env </p>

<strong><code>DB_CONNECTION=mysql</code></strong><br>

<strong><code>DB_HOST=127.0.0.1</code></strong><br>

<strong><code>DB_PORT=3306</code></strong><br>

<strong><code>DB_DATABASE=CodeParadiseDB</code></strong><br>

<strong><code>DB_USERNAME=root</code></strong><br>

<strong><code>DB_PASSWORD=</code></strong><br>

<p> Open directory in console and update composer: </p>

<strong><code>composer update</code></strong><br>

<p> Generate tables using migrations:</p>

<strong><code>php artisan migrate</code></strong><br>

<p> Then seed the database:</p>

<strong><code>php artisan db:seed</code></strong><br>

<p> To start the project run: </p>

<strong><code>php artisan serve</code></strong><br>

<p> Then open new console to run NodeJS:</p>

<strong><code>npm install npm run dev</code></strong><br>

<p> Open in browser: http://127.0.0.1:8000 </p>

<p>I am looking forward learning more about application architectures and data handling.</p>
