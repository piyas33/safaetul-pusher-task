## Setup Instructions
1. Clone the Repository
```
git clone https://github.com/piyas33/safaetul-pusher-task.git
cd safaetul-pusher-task
```
2. Install Dependencies
```
composer install
npm install
```
3. Set Up Environment Variables
```
cp .env.example .env
php artisan key:generate
```
.env
```
//Create database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=pusher

//write pusher id,pusher key and secret from pusher websiter after create account
PUSHER_APP_ID=your-app-id
PUSHER_APP_KEY=your-app-key
PUSHER_APP_SECRET=your-app-secret
PUSHER_APP_CLUSTER=your-app-cluster
BROADCAST_DRIVER=pusher
```
4. Run Migrations
```
php artisan migrate
```
5. Start the Application
```
npm run dev
php artisan serve
```


- **Visit /fetch-products to fetch and store products.**

- **Open multiple browsers or tabs and navigate to /products. Add a new product via the API or manually in the database to see real-time updates.**

## API Integration
   
- The application uses Guzzle (Laravel's HTTP client) to fetch product data from the Fake Store API. The fetched data is stored in the local database.

## Real-Time Updates with Pusher
   
- When a new product is added, a Laravel event (ProductUpdated) is triggered.

- The event is broadcasted to a Pusher channel (products).

- The frontend listens for updates on the products channel using Laravel Echo and Pusher JS.

- When a new product is received, the UI is updated dynamically without refreshing the page.

## Frontend Integration
- The frontend is built using Blade templates and JavaScript.

- Laravel Echo is used to subscribe to the products channel and listen for the ProductUpdated event.

- When the event is received, the new product is appended to the product list.

## Routes
- Fetch Products: /fetch-products (Fetches products from the API and stores them in the database.)

- View Products: /products (Displays the list of products.)
