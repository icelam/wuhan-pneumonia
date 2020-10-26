# Changelog

All notable changes to this project will be documented in this file. See [standard-version](https://github.com/conventional-changelog/standard-version) for commit guidelines.

### [1.25.1](https://github.com/icelam/wuhan-pneumonia/compare/v1.25.0...v1.25.1) (2020-10-26)


### Bug Fixes

* **backend:** fix error due to incorrect ha waiting time url ([1ac1fba](https://github.com/icelam/wuhan-pneumonia/commit/1ac1fba8fcbde110f080ca9c586233e76fd43ab9))

## [1.25.0](https://github.com/icelam/wuhan-pneumonia/compare/v1.24.3...v1.25.0) (2020-10-04)


### Features

* **frontend:** add pagination support to data table ([5939aae](https://github.com/icelam/wuhan-pneumonia/commit/5939aae55dd34ab86418c3f18c8fe1f65aae071b))

### [1.24.2](https://github.com/icelam/wuhan-pneumonia/compare/v1.24.1...v1.24.2) (2020-07-21)


### Bug Fixes

* **backend:** date format change in hk latest suitation data source ([bef7302](https://github.com/icelam/wuhan-pneumonia/commit/bef7302155118c87465a65f07da877a2dd8f8ecd))

### [1.24.1](https://github.com/icelam/wuhan-pneumonia/compare/v1.24.0...v1.24.1) (2020-07-08)


### Bug Fixes

* **backend:** thrown error on failed to return API output ([0b61699](https://github.com/icelam/wuhan-pneumonia/commit/0b6169987fcc663b7c271c093b201339d4c18821))

## [1.24.0](https://github.com/icelam/wuhan-pneumonia/compare/v1.23.1...v1.24.0) (2020-04-15)


### Features

* **frontend:** sort map table data according to confirmedCount ([dce3659](https://github.com/icelam/wuhan-pneumonia/commit/dce36599f3e003d176da76b21353059419ce6da6))

### [1.23.1](https://github.com/icelam/wuhan-pneumonia/compare/v1.23.0...v1.23.1) (2020-04-15)


### Bug Fixes

* **backend:** response to change in data source url from data.gov.hk ([e03fc02](https://github.com/icelam/wuhan-pneumonia/commit/e03fc02b37e375d08bb112ac8ad3118dfcfceb44))
* **frontend:** fix NaN in Hong Kong latest suitation ([e4f2e4f](https://github.com/icelam/wuhan-pneumonia/commit/e4f2e4f22806cd78069d0349091763d89372c82a))

## [1.23.0](https://github.com/icelam/wuhan-pneumonia/compare/v1.22.0...v1.23.0) (2020-03-20)


### Features

* **backend:** switch to new home confinees data source ([bfdaaee](https://github.com/icelam/wuhan-pneumonia/commit/bfdaaeeb562d6006315e76c6cd5cca168616309b))
* **frontend:** separate page for home confinees data ([099601b](https://github.com/icelam/wuhan-pneumonia/commit/099601b1985d492737e6ed1a09eab18a78689737))


### Bug Fixes

* **backend:** fix empty scrap of live data ([c05548b](https://github.com/icelam/wuhan-pneumonia/commit/c05548b17d20b2562532d36c7ae7f07bea969d2e))

## [1.22.0](https://github.com/icelam/wuhan-pneumonia/compare/v1.21.0...v1.22.0) (2020-02-28)


### Features

* **frontend:** modify HK latest sutiation UI due to API changes ([d7cb332](https://github.com/icelam/wuhan-pneumonia/commit/d7cb332c184f48f4310396fdb9a1cbdca818e0a5))


### Bug Fixes

* **frontend:** fix missing column label in HK confirmed case table ([f397782](https://github.com/icelam/wuhan-pneumonia/commit/f3977821e30863125f40be7404b2b0d7a9a96615))
* **frontend:** fix NaN on formatting non DD/MM/YYYY string ([d78380b](https://github.com/icelam/wuhan-pneumonia/commit/d78380b34e51b228e56b68f7c224cb2b0a0c4681))
* **frontend:** hints for empty data table ([cdb046f](https://github.com/icelam/wuhan-pneumonia/commit/cdb046f1f5f56482594f6f86416aa5ad41228443))
* **frontend:** missing column headers and update data table title ([75f0c74](https://github.com/icelam/wuhan-pneumonia/commit/75f0c7426522c624e69f059c1dd9445308f6936e))

## [1.21.0](https://github.com/icelam/wuhan-pneumonia/compare/v1.20.0...v1.21.0) (2020-02-06)


### Features

* **backend:** switch new source to google news feed ([1225daa](https://github.com/icelam/wuhan-pneumonia/commit/1225daaa8882bf230256637f9a18c753a9444ece))
* **frontend:** remove description from news card ([5f1d266](https://github.com/icelam/wuhan-pneumonia/commit/5f1d266a9d67aee473c2d8ed45f37f04b685a0d0))


### Bug Fixes

* **frontend:** wrongly mapped css class name ([9e83aca](https://github.com/icelam/wuhan-pneumonia/commit/9e83aca92da405518c7c8e3134f02bbdaf6485f9))

## [1.20.0](https://github.com/icelam/wuhan-pneumonia/compare/v1.19.0...v1.20.0) (2020-02-05)


### Features

* **backend:** scrap data for buildings of home confinees in Hong Kong ([be841c8](https://github.com/icelam/wuhan-pneumonia/commit/be841c8e2469657ac36108933d9b4aea3ae794c0))
* **frontend:** add data for buildings of home confinees in Hong Kong ([112d6c0](https://github.com/icelam/wuhan-pneumonia/commit/112d6c0f4ac36e8c3567c983e1d57ab723c09e07))

## [1.19.0](https://github.com/icelam/wuhan-pneumonia/compare/v1.18.0...v1.19.0) (2020-02-05)


### Features

* **backend:** scrap Hong Kong's latest suitation ([021188f](https://github.com/icelam/wuhan-pneumonia/commit/021188f9a58972ebfed7280bbf17f522df7b4658))
* **frontend:** add Hong Kong latest suitation data ([1045145](https://github.com/icelam/wuhan-pneumonia/commit/10451455fa34a86cb024f47d61a7ee63a15023fe))


### Bug Fixes

* **backend:** remove invalid xml characters returned from rss.app ([00e706b](https://github.com/icelam/wuhan-pneumonia/commit/00e706b8eb138550631ad9f70d9148638ae56285))

## [1.18.0](https://github.com/icelam/wuhan-pneumonia/compare/v1.17.0...v1.18.0) (2020-02-03)


### Features

* **backend:** change data source of related news to RSS App ([2044bf2](https://github.com/icelam/wuhan-pneumonia/commit/2044bf297476902542e43834af197717d18a8f04))
* **frontend:** replace rss app wall with custom news card component ([67b9555](https://github.com/icelam/wuhan-pneumonia/commit/67b9555392e036349b952f808e3792c1aa933287))

## [1.17.0](https://github.com/icelam/wuhan-pneumonia/compare/v1.16.0...v1.17.0) (2020-02-02)


### Features

* **backend:** scrap affected trains and flight data ([994c284](https://github.com/icelam/wuhan-pneumonia/commit/994c28466db63b2e7bbb36bb858580ec3a0b1b06))
* **frontend:** add hong kong affected transport data ([c882b69](https://github.com/icelam/wuhan-pneumonia/commit/c882b69c7a3fa96d80222bef48865b6263b53a88))
* **frontend:** handle date string sorting in data tables ([c1d57c1](https://github.com/icelam/wuhan-pneumonia/commit/c1d57c100fde52ea09b31515190af6b639f45b76))

## [1.16.0](https://github.com/icelam/wuhan-pneumonia/compare/v1.15.1...v1.16.0) (2020-02-01)


### Features

* **frontend:** convert table of A&E waiting time to data map ([0c41908](https://github.com/icelam/wuhan-pneumonia/commit/0c419084fde09bb3d74ff6b87227f904e4c5f081))


### Bug Fixes

* **frontend:** update data source of live data ([1fd2fba](https://github.com/icelam/wuhan-pneumonia/commit/1fd2fbad372ca0bcc585f760b2d03f0c2a3bb3ef))

### [1.15.1](https://github.com/icelam/wuhan-pneumonia/compare/v1.15.0...v1.15.1) (2020-02-01)


### Bug Fixes

* **backend:** change scrapping url of live data ([9514098](https://github.com/icelam/wuhan-pneumonia/commit/9514098dbc993c0dc7abdd99579dfdc9ea5f0e07))

## [1.15.0](https://github.com/icelam/wuhan-pneumonia/compare/v1.14.0...v1.15.0) (2020-01-31)


### Features

* **frontend:** zoom map when clicking map table row ([08d187f](https://github.com/icelam/wuhan-pneumonia/commit/08d187f44ccfc87ae3c66cb42433b9cf43896eae))

## [1.14.0](https://github.com/icelam/wuhan-pneumonia/compare/v1.13.0...v1.14.0) (2020-01-31)


### Features

* **frontend:** implement simple table sorting ([69b7a70](https://github.com/icelam/wuhan-pneumonia/commit/69b7a706662ca2bc4cc1213a75e3c4629b88c2c2))


### Bug Fixes

* **frontend:** fix app icons link ([97713d2](https://github.com/icelam/wuhan-pneumonia/commit/97713d2856741fb12e4f89f78fe6d4fbaf64db6e))
* **frontend:** fix wrong manifest and favicon path ([3e486c8](https://github.com/icelam/wuhan-pneumonia/commit/3e486c85bba6563ea88ff9cbdecce8d2610ee20e))
* **frontend:** remove empty column in pharmacy list ([cb2eede](https://github.com/icelam/wuhan-pneumonia/commit/cb2eede763739fb4332bbbe9c6903120a811799c))

## [1.13.0](https://github.com/icelam/wuhan-pneumonia/compare/v1.12.1...v1.13.0) (2020-01-30)


### Features

* **frontend:** add high risk building data ([706c683](https://github.com/icelam/wuhan-pneumonia/commit/706c683cfa0516a8623dc3321d24f4cf9a219f58))


### Bug Fixes

* **frontend:** typo in Hong Kong case route ([64669ce](https://github.com/icelam/wuhan-pneumonia/commit/64669ced3229987d6a72be1fe18fa10044308fac))

### [1.12.1](https://github.com/icelam/wuhan-pneumonia/compare/v1.12.0...v1.12.1) (2020-01-30)


### Bug Fixes

* **frontend:** remove empty row filter on pharmacy list ([639dda5](https://github.com/icelam/wuhan-pneumonia/commit/639dda562f185a12ff0711e16796a535c90fd1a3))

## [1.12.0](https://github.com/icelam/wuhan-pneumonia/compare/v1.11.1...v1.12.0) (2020-01-30)


### Features

* **backend:** scrap HK data from data.gov.hk ([232f860](https://github.com/icelam/wuhan-pneumonia/commit/232f8605a1d32288c9d730ffb74ea90418b193e0))
* **frontend:** add Hong Kong confirmed case data ([1bd545e](https://github.com/icelam/wuhan-pneumonia/commit/1bd545e298f3fb371c0b80dd8ca4a175c22416f9))
* **frontend:** add tableCard component ([6c4f25d](https://github.com/icelam/wuhan-pneumonia/commit/6c4f25de9aa483e0ce0761c871b30328c5ae10dd))

### [1.11.1](https://github.com/icelam/wuhan-pneumonia/compare/v1.11.0...v1.11.1) (2020-01-29)


### Bug Fixes

* **frontend:** fix news overflow issue on mobile ([803f5f3](https://github.com/icelam/wuhan-pneumonia/commit/803f5f38c8dbbd145a266f24317b4980c81e4d2c))
* **frontend:** prevent font size being adjusted on iOS landscape mode ([646deb5](https://github.com/icelam/wuhan-pneumonia/commit/646deb58253d9dc8a7a5b54e6c699c083a550089))

## [1.11.0](https://github.com/icelam/wuhan-pneumonia/compare/v1.10.0...v1.11.0) (2020-01-29)


### Features

* **backend:** google news rss to json ([7615c96](https://github.com/icelam/wuhan-pneumonia/commit/7615c96185f8b4d777a970b126a68efa25c0581a))
* **frontend:** add "Related News" page ([58f93dd](https://github.com/icelam/wuhan-pneumonia/commit/58f93dd39a10a68b94613e14cb59d309685ae320))

## [1.10.0](https://github.com/icelam/wuhan-pneumonia/compare/v1.9.0...v1.10.0) (2020-01-29)


### Features

* **backend:** scrap blacklist pharmacy from google spreadsheet ([d22be49](https://github.com/icelam/wuhan-pneumonia/commit/d22be490be44b79d6bbadc6c94ae4967222b4540))
* **frontend:** add fraudulent pharmacy list ([74b01ba](https://github.com/icelam/wuhan-pneumonia/commit/74b01bac1a1d0fd1a0fb52d8c0d805b311a0eaa8))


### Bug Fixes

* **frontend:** fix duplicated unit in media queries ([82b2116](https://github.com/icelam/wuhan-pneumonia/commit/82b2116da415467c9f16c3d219fa67dcbe8df88e))

## [1.9.0](https://github.com/icelam/wuhan-pneumonia/compare/v1.8.2...v1.9.0) (2020-01-29)


### Features

* **backend:** scrap AE waiting time data ([753332a](https://github.com/icelam/wuhan-pneumonia/commit/753332a987ebb54fb0ffea11588175fef6e8a7ab))
* **frontend:** add "AE Waiting Time" page ([e332ad4](https://github.com/icelam/wuhan-pneumonia/commit/e332ad4cf9446097c7f37280262aaf78261cb3e6))

### [1.8.2](https://github.com/icelam/wuhan-pneumonia/compare/v1.8.1...v1.8.2) (2020-01-28)


### Bug Fixes

* **frontend:** error message not showing in "Historical Data" page ([8a19b6a](https://github.com/icelam/wuhan-pneumonia/commit/8a19b6a7f931131879b5467fa7b005a0ca56c89f))
* **frontend:** fix runtime caching rules ([830a4ea](https://github.com/icelam/wuhan-pneumonia/commit/830a4ea755b48a20f7f352b70b43dc1c4afeb7b2))

### [1.8.1](https://github.com/icelam/wuhan-pneumonia/compare/v1.8.0...v1.8.1) (2020-01-28)


### Bug Fixes

* **frontend:** runtime caching in service worker for historical data API ([a64770c](https://github.com/icelam/wuhan-pneumonia/commit/a64770c1152a0c5eb7502452b78a7ce81d60e666))

## [1.8.0](https://github.com/icelam/wuhan-pneumonia/compare/v1.7.0...v1.8.0) (2020-01-28)


### Features

* **frontend:** add historical data table ([5d9f2ef](https://github.com/icelam/wuhan-pneumonia/commit/5d9f2ef497481b7ebe293cfbb0e6f5a9f0c6315b))

## [1.7.0](https://github.com/icelam/wuhan-pneumonia/compare/v1.6.0...v1.7.0) (2020-01-28)


### Features

* **backend:** hardcode localized translation replacement ([2ea08c4](https://github.com/icelam/wuhan-pneumonia/commit/2ea08c4815dd39376c548e0883af1cf79d32fc34))
* **frontend:** add overseas statistic table ([4f125de](https://github.com/icelam/wuhan-pneumonia/commit/4f125dee3e18de4403508caca57a9ad3472f1caf))

## [1.6.0](https://github.com/icelam/wuhan-pneumonia/compare/v1.5.0...v1.6.0) (2020-01-28)


### Features

* **forntend:** add overseas count summary ([d648de3](https://github.com/icelam/wuhan-pneumonia/commit/d648de358fea9f757b26a0f8e8bc20b9aa04d0a8))
* **frontend:** disable swipe when map is not zoomed (iOS) ([fc72dfe](https://github.com/icelam/wuhan-pneumonia/commit/fc72dfebad747c285114c4bb3207214adbdc5fe0))
* **frontend:** update legend and data range of map ([6984474](https://github.com/icelam/wuhan-pneumonia/commit/69844744ac442fbc560090db49af4f9cd8370992))

## [1.5.0](https://github.com/icelam/wuhan-pneumonia/compare/v1.4.0...v1.5.0) (2020-01-27)


### Features

* **frontend:** switch to global statistics for "Statistic" section ([5e7c233](https://github.com/icelam/wuhan-pneumonia/commit/5e7c2336725173c8b03027728997def60a508c12))


### Bug Fixes

* **frontend:** wrap link for small screens on "Prevention Method" page ([49d23cd](https://github.com/icelam/wuhan-pneumonia/commit/49d23cdc738bbda7a504d34f2f4e6a28bce436a0))

## [1.4.0](https://github.com/icelam/wuhan-pneumonia/compare/v1.3.2...v1.4.0) (2020-01-27)


### Features

* **backend:** scrap overseas data from dxy ([f2fee28](https://github.com/icelam/wuhan-pneumonia/commit/f2fee28c89c4da64a058408cf23d5046b1d0e380))
* **backend:** temp hack in dxy scrapper for old service workers ([d9bd2cc](https://github.com/icelam/wuhan-pneumonia/commit/d9bd2ccbe8a7a6c5e7699e3cd606f59e8139d866))
* **frontend:** skipWaiting and clientsClaim for service worker ([b0d58ee](https://github.com/icelam/wuhan-pneumonia/commit/b0d58eec2bdb84cc9eb0a67b1d4f1610de7291e3))
* **frontend:** update statistic variable due to changes on scrap data ([7a4827b](https://github.com/icelam/wuhan-pneumonia/commit/7a4827b0e0b16e6af7c3f18bd572e97dff6fe1b1))

### [1.3.2](https://github.com/icelam/wuhan-pneumonia/compare/v1.3.1...v1.3.2) (2020-01-27)


### Bug Fixes

* **frontend:** close mobile navigation when clicking logo ([83c1a2c](https://github.com/icelam/wuhan-pneumonia/commit/83c1a2ce66d007ae4a9bd280e23fcee604c68905))
* **frontend:** scroll to top on route change ([e24d071](https://github.com/icelam/wuhan-pneumonia/commit/e24d071558ca0eb87f5fbeeed50846f3d2a2948d))
* **frontend:** slower animation of navigation toggle ([f1ec60b](https://github.com/icelam/wuhan-pneumonia/commit/f1ec60bb611ea3286b2a097803e06bcdfcad3262))

### [1.3.1](https://github.com/icelam/wuhan-pneumonia/compare/v1.3.0...v1.3.1) (2020-01-27)


### Bug Fixes

* **frontend:** fix mobile navigation z-index ([fbec759](https://github.com/icelam/wuhan-pneumonia/commit/fbec759053b76c4abad914920e321e3067c73981))

## [1.3.0](https://github.com/icelam/wuhan-pneumonia/compare/v1.2.2...v1.3.0) (2020-01-27)


### Features

* **backend:** scrap historical data from QQ News ([3e89f39](https://github.com/icelam/wuhan-pneumonia/commit/3e89f39a8cadef011dfc131a513a2af82990bc27))
* **frontend:** separate "Preventation Method" to another page ([82fdf1d](https://github.com/icelam/wuhan-pneumonia/commit/82fdf1daa5da6d84ef726fbb2e8232b6fdd6ad03))


### Bug Fixes

* **frontend:** clear interval on landing page unmount ([5f9d0ed](https://github.com/icelam/wuhan-pneumonia/commit/5f9d0ed161cdad03ac3813b6e63da5b17ebb919e))

### [1.2.2](https://github.com/icelam/wuhan-pneumonia/compare/v1.2.1...v1.2.2) (2020-01-27)


### Bug Fixes

* **frontend:** fix column wrap issue in mobile ([66a284e](https://github.com/icelam/wuhan-pneumonia/commit/66a284e082de4ce969716fc03726445d78d0133d))
* **frontend:** fix inconsistent section margin ([9dfdc75](https://github.com/icelam/wuhan-pneumonia/commit/9dfdc75b08386276f7114bd34e8d274f046b2f5d))

### [1.2.1](https://github.com/icelam/wuhan-pneumonia/compare/v1.2.0...v1.2.1) (2020-01-26)


### Bug Fixes

* **forntend:** remove extra punctuation at "Prevention Method" section ([5148079](https://github.com/icelam/wuhan-pneumonia/commit/5148079da3135ba88ebb39acdf513cf5b388470b))
* **forntend:** temp fix for SVG resize bug in IE 11 / 10 ([69b3a83](https://github.com/icelam/wuhan-pneumonia/commit/69b3a834caf19692b2377f4e621c24bfb69cfe59))
* **frontend:** IE 10 / 11 flex layout issue ([3f2a7a1](https://github.com/icelam/wuhan-pneumonia/commit/3f2a7a18617711384bc285ebc23cf2a7f0d66e5c))

## [1.2.0](https://github.com/icelam/wuhan-pneumonia/compare/v1.1.0...v1.2.0) (2020-01-26)


### Features

* **frontend:** add prevention information ([3a6c480](https://github.com/icelam/wuhan-pneumonia/commit/3a6c4807fc2805ab41f649c33c3c9bcf55cdd3e1))

## [1.1.0](https://github.com/icelam/wuhan-pneumonia/compare/v1.0.0...v1.1.0) (2020-01-26)


### Features

* **backend:** lock file while performing data backup ([f8f5d1a](https://github.com/icelam/wuhan-pneumonia/commit/f8f5d1a959040204ed8a3f0ab8063091fd2104ea))
* **frontend:** auto fetch new data every 5 minutes ([1f1c443](https://github.com/icelam/wuhan-pneumonia/commit/1f1c4430a4c44295af77ecc4884a40477bdad6fb))

## 1.0.0 (2020-01-25)


### Features

* statistic and datamap of Wuhan pneumonia ([64441b1](https://github.com/icelam/wuhan-pneumonia/commit/64441b18dbaa718d3b2cc22a92aa99ee850a60f3))
