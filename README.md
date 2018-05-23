# ecommerce_api

API helpful for an ecommerce website

To install the project :

- Clone the project in your computer
- Create an empty database
- In your terminal, run <pre>composer install</pre> at project root to install the dependencies. It will also ask you to provide your server and database details
- Run <pre>php bin/console doctrine:migrations:migrate</pre> to create the tables in the database
- Run the server with <pre>php bin/console server:run</pre> and open your browser
- Go to http://<your-localhost-url>/init/ to fill the tables with test data
- The project is ready!