## Project Information

Project name: Capbay Mamak

Project directory: capbay-mamak

Total time spent : 10.5h


## Installation requirements

- PHP
- Composer
- Docker Desktop

## Local startup

Navigate to project directory and type in the following command:

<code>./vendor/bin/sail up</code>

This will startup the project and the databse in a docker environment. The base URL for the project is http://0.0.0.0.

Once the project has started, the database can be setup by running the following command which will run all the migrate files and fill the databases with the initial seeded data, which will include all data necessary for the initial required test:

<code>./vendor/bin/sail artisan migrate:fresh --seed</code>

Unfortunately since there is no UI, the easiest way to utilize the functionality of the project would be via Postman. In the project root directory is a Postman Collection (CapBay Mamak APIs.postman_collection.json) that can be directly imported to have all the APIs ready to be used.

The list of functionality is as follows:
- Menu Items
    - List all menu items
    - Create menu item
    - Delete menu item
- Pricing Rules
    - List all pricing rules
    - Create new pricing rule
    - Delete pricing rule
- Checkout
    - Do checkout with any input
    - Test checkout which will run the required checkout test