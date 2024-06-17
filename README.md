<!-- TODO: Improve this Read.me -->

# Get Start

When you download this repository, first you need to run the migrates and then seed the database.

To run the migrate just run the following command in the directory of the repository: **php artisan migrate**
And then, you can seed the database with the command: **php artisan db:seed**

There is a python script inside rdkit directory

-   Its used to generate molecules images from INCHI or Smiles with Rdkit
-   There is some requirements that you can install using the command pip install -r requirements.txt inside the rdkit directory

To run the system in dev:

-   php artisan serve
-   npm run dev

If you want to import the data to the Algolia:

-   php artisan scout:import

Now, you have two users, separated by middlewares:

-   Admin (Can add/edit/delete)
    -   **Email:** admin@email.com
    -   **Password:** admin
-   User (Can only search and get details)
    -   **Email:** user@email.com
    -   **Password:** user

# Useful commands

-   **MySql:**
    -   **Start:** net start mysql83
    -   **Shutdown:** net stop mysql83

### Clear algolia

```
php artisan scout:flush
```

### Sync Algolia with Database

```
php artisan scout:import
```
