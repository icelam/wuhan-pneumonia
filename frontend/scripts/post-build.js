/* eslint "import/no-extraneous-dependencies": ["error", {"optionalDependencies": false} ] */
const dotenv = require('dotenv');
const cpx = require('cpx');

// https://github.com/bkeepers/dotenv#what-other-env-files-can-i-use
const Path = require('path');
const fs = require('fs');

console.log('Running post-build tasks...');

const dotenvFiles = [
  Path.resolve(__dirname, '../.env.production.local'),
  Path.resolve(__dirname, '../.env.production'),
  Path.resolve(__dirname, '../.env')
].filter((dotenvFile) => fs.existsSync(dotenvFile));

console.log(`${dotenvFiles[0]} will be used.\n`);

// Load env variables
dotenv.config({
  path: dotenvFiles[0]
});

const htaccessPath = Path.resolve(__dirname, '../.htaccess');
const htaccessDestination = Path.resolve(__dirname, `../dist${process.env.VUE_APP_CONTEXT}`);

cpx.copy(
  htaccessPath,
  htaccessDestination,
  (err) => {
    if (err) {
      console.log(err);
    } else {
      console.log(`Copied ${htaccessPath} to ${htaccessDestination}`);
    }
  }
);
