# Countries Project Laravel API

## Deployment
The api is currently deployed on Heroku : [Click here](https://mysterious-woodland-00550.herokuapp.com/api/countries) to access it.

## How to install the project for the first time ?
This project use Docker.
- Clone this repo with the `git clone` command
- Access to the directory : `cd countries-project`
- Install the composer dependencies : `composer install`
- Copy the example docker env : `cp .env.docker .env`
- Launch the docker composer : `./vendor/bin/sail up`
- (Optional) Create an alias for sail : `alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'`
- (Optional) If you have a problem with the container, you can remove it with this commande : `./vendor/bin/sail down --rmi all -v` )

⚠️ If you have not created the alias you must use `./vendor/bin/sail` instead of `sail`

- Generate the laravel app key : `sail artisan key:generate`
- Launch the migration of the database : `sail artisan migrate`
- Wrap the datas from the RestContriesAPI  : `sail artisan wrap:countries`

## API Routes

- `GET localhost/api/countries` : Get all the countries

    Params: 
    - fields: Select only listed fields. Separate fields with commas (eg: `?fields=common_name,official_name,tld`)

- `GET localhost/api/countries/:countryId` : Get a single country with his ID

## The custom wrap:countries command
As you have seen in the installation of the project we have a custom command `artisan wrap:countries`. It empties the database and retrieves the first 20 countries of the RestCountriesAPI.

## What can be improved ?
- Add tests !!! 
- Add factories and seeders to test the database.
- Create a custom exception
- Improve the exception handler
- Add a limit argument to the command to get the number of countries of our choice

## Encountered problems
- On the API side, no particular problem was encountered. It is very basic, no blocking point was encountered. 
- For the front end, I had to go back to tutorials and docs because it had been a long time since I had done any. Being, basically, a back-end developer, this side was a bit longer.
