# FoundationPressBeet Development Theme
This is a starter-theme for WordPress based on [FoundationPress](https://github.com/olefredrik/foundationpress). The purpose of this theme, is to act as a small and handy toolbox that contains the essentials needed to build any design, and its meant to be a starting point, not the final product.

## Requirements

This project uses [Gulp task runner](http://gulpjs.com/) that requires [Node.js](http://nodejs.org) v6.x.x  to be installed on your machine. 
If you haven't installed Gulp CLI on your machine yet, run:

```bash
$ npm install --global gulp-cli
```

## Quickstart

### 1. Clone the repository and install with npm

```bash
$ cd wordpress-folder/wp-content/themes/your-theme
$ git clone https://github.com/alexcss/foundation-beet ./
$ npm install
```

### 2. Setup your gulpfile.js:

#### 2.1 Live reload
Add your local or remote server URL, so LiveReload can refresh browser as you are working on your code :

```javascript
var URL = 'https://alexcss.com/foundation-beet'
```

### 3. Run Gulp

While working on your project, run "gulp" task from the NPM: `gulp`.

When project is done, run `gulp -p` to minify CSS, JS and remove unnecessary sourcemaps

## Overview
### Images
Gulp will compress all images from `_src\img\` and put them to `assets\img`. If you use FTP/SFTP, only compressed images will be uploaded to server.
### PHP and `\library` folder

The `library` folder contains php files, connected to `functions.php`:

* `cleanup.php` - contains functions for cleaning up default Wordpress styles, scripts, etc.
* `enqueue-scripts.php` - serves for registering your styles and scripts in Wordpress
* `menu-walkers.php` - contains pre-configured menu walker.
* `navigation.php` - serves for registering menu areas.
* `theme-support.php` - serves for registering theme support for languages, menus, post-thumbnails, post-formats etc. Most of them are already enabled.
* `widget-areas.php` - serves for registering menu areas.
