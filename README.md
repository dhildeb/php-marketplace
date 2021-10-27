PHP Template, it includes authentication and mysql db.

setup

create an .env file in the services folder with these variables
SERVER=
USERNAME=
PASSWORD=
DB=

AUTH0_DOMAIN=
AUTH0_CLIENT_ID=
AUTH0_CLIENT_SECRET=
AUTH0_REDIRECT_URI=
AUTH0_COOKIE_SECRET=

ensure your db has the following tables and columns

account
-id
-name
-email
-picture

desks
-id
-number

reservations
-id
-dateReserved
-profileId
-deskId