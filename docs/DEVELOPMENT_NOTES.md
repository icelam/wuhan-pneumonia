# Backend #
### Folder ###
* `/api`

### Tech stack ###
* PHP > 5.6 (with Composer)

### Install dependencies ###
`php composer.phar install`

# Frontend #
### Folder ###
* `/frontend`

### Node version ###
* Node >= 10

### Changing API Endpoint ###
* You will need to host the `/api` folder yourself. Change the environment variable `VUE_APP_PNEUMONIA_DATA_SOURCE` to the url you are hosting.

### Changing App Domain (Used for meta and open graph tags in HTML templates) ###
* `.env` > `VUE_APP_DOMAIN`

### Changing App Context ###
* `.env` > `VUE_APP_CONTEXT`

### Run project ###
Go to `/frontend` folder and run the following command:
* `npm install`
* `npm run dev`

### Build production ###
Go to `/frontend` folder and run the following command:
* `npm run build`
