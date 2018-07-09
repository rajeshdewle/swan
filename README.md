# Camel framework
A WordPress Theme Framework

## Installation
Simply put the theme files into `/wp-content/themes` in your WordPress installation directory. Then follow these instructions to install the npm dependencies.

Change the current working directory to the theme directory
```
cd wp-content/themes/<theme-folder>
```

We are using [Laravel Mix](https://github.com/JeffreyWay/laravel-mix) to compile SASS & JavaScript files. To install npm depedancies run following command in terminal.
```
npm install
```

Run watcher to watch for modified files
```
npm run watch
```

Compile (Minify) assets for production
```
npm run production
```

For more information visit [Laravel Mix documentation](https://github.com/JeffreyWay/laravel-mix/tree/master/docs#readme).


