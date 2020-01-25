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

# D3 References #
* [使用d3绘制中国地图](https://blog.tcs-y.com/2018/12/12/d3-china-map/)
* [State Choropleth](https://observablehq.com/@d3/state-choropleth)
* [Click-to-zoom via transform](https://bl.ocks.org/mbostock/2206590)
* [Zoomable Raster & Vector](https://observablehq.com/@d3/zoomable-raster-vector?collection=@d3/d3-geo)
* [Zoom to Bounding Box](https://observablehq.com/@d3/zoom-to-bounding-box?collection=@d3/d3-zoom)
