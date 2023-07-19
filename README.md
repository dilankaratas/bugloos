# Bugloos Test Case Project
This Laravel project is created to perform a test case. The purpose of the test case is to retrieve data from an external API and convert it into a specific Object format. The project accomplishes this conversion process using the powerful capabilities and tools provided by Laravel.

This test case simulates a commonly encountered scenario: retrieving data from an external API, transforming the data into a specific database format, and finally saving the data into your own program's database. The project serves as a sample test environment to mimic a real-life situation.

For API integration and data transformation, the project utilizes YAML configurations. YAML files are used to define the fields in the API response and map those fields to the corresponding database fields in your program. By supporting JSON or XML format in API responses, the project facilitates integration with various API sources.# Setup
Go to the root of the project and run the following command to install the required dependencies:

`composer install`

# Setup

1. Download or clone the project files to your computer.

2. Open terminal and navigate to the project folder.

3. Run the following command to install the required dependencies:
    ```
    composer install
    ```

4. Copy the `.env.example` file as `.env`:
    ```
    cp .env.example .env
    ```

5. Open the `.env` file and update your database settings. Enter the required information for the database connection.

6. Run the following command to create the database:
    ```
    php artisan migrate
    ```

7. Run the following command to populate the database with sample data:
    ```
    php artisan db:seed
    ```

8. Run the following command to start the application:
    ```
    php artisan serve
    ```

9. Go to `http://localhost:8000` in your browser and observe that the project is running.

# Run the following command to create the database tables and load the sample data

`php artisan migrate --seed`

## Usage

To use this project, follow the steps below:

1. Make sure you are logged in to access patient data:

   - Send a POST request to the `/login` endpoint with valid credentials to authenticate.
   - The request body should include the following parameters: `email` and `password`.
   - If the authentication is successful, you will receive a bearer token in the response.

2. Retrieve patient data:

   - Send a GET request to the `/patients` endpoint to retrieve a list of all patients.
   - Include the bearer token received during login as the Authorization header: `Authorization: Bearer <token>`.
   - If the request is successful, you will receive a JSON response containing patient data.



