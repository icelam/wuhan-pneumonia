# Backend #
### Folder ###
* `/api`

### PHP version ###
* PHP > 5.6 (with Composer installed)

### Install dependencies ###
`php composer.phar install`

# Frontend #
### Folder ###
* `/frontend`

### Node version ###
* Node >= 10

### Changing API Endpoint ###
* You will need to host the `/api` folder yourself. Change the environment variable `VUE_APP_PNEUMONIA_LIVE_DATA` to the url you are hosting.

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

### Build destination ###
* `dist`

### Prerender Notes ###
* API will need to set `Access-Control-Allow-Origin: http:localhost:8080` or `Access-Control-Allow-Origin: *` to allow prerender
* To wait for API loading finish, prerender is set to capture HTML after `.page-content` is found
