Setup

Child Theme Setup
To setup the child theme copy the contents of the git repository and drag the blank-slate-child theme folder into your site directory: your-site-name/app/public/wp-content/themes
Alternatively you can zip up blank-slate-child and upload directly to wordpress admin through appearance -> themes -> add theme -> upload theme
After that the theme can be activated through wordpress admin

Plugin Setup
Copy plugin folder "custom-post" from the git repository into the plugins directory of your site: your-site-name/app/public/wp-content/plugins
Activate on wordpress admin under Plugins -> Installed Plugins

Install Carbon Fields
Use this command to install carbon fields
composer require htmlburger/carbon-fields



Vite Setup
to setup vite like I have done for this theme on a wordpress site input the following commands into the terminal

//Change the working directory to your theme directory
cd wp-content\themes\your-theme-name

//Create a package.json in your theme directory
npm init -y

//Instal Vite
npm install vite


//Create a file called vite.config.js in your directory and input the following javascript code

import { defineConfig } from "vite";
import sass from "sass";

export default defineConfig({
  root: "src",
  build: {
    outDir: "../dist",
    emptyOutDir: true,
    rollupOptions: {
        input: {
        main: "src/main.js",
      },
        output: {
        entryFileNames: "main.js",
        assetFileNames: "style.css"
      },
    },
  },
});


//In package.json you may see some more javascript code like this:

{
  "name": "your-theme-name",
  "version": "1.0.0",
  "main": "index.js",
  "scripts": {
    "test": "echo \"Error: no test specified\" && exit 1",
    "dev": "vite",
    "build": "vite build"
  },
  "keywords": [],
  "author": "",
  "license": "ISC",
  "description": "",
  "dependencies": {
    "sass": "^1.93.2"
  },
  "devDependencies": {
    "vite": "^7.1.8"
  }
}

//what's important here is this part:

  "scripts": {
    "dev": "vite",
    "build": "vite build"
    },

//You want to make sure you add this part to your package.json so that you can compile scss files using vite


//Next add 2 folders to your theme called dist and src
//inside of /src add a folder called scss and add a file called main.scss, this is where you will add your scss code to be compiled into css by vite
//inside of /src add a file called main.js with the following code:

import "./scss/main.scss";

console.log("Vite is working");

//this tells vite where your scss file is as well as outputs a message to the console which can be viewed on the web page using the inspector to check if vite is up and working


//once it is setup use this command in your site shell to compile vite for development builds:
npm run dev

//and this one for production builds:
npm run build

//If all is working this will compile your scss into a css file which can be found in the dist folder


//Finally to make sure it works on your site you need to enqueue the dist/style.css with your site's existing style.css
//To do this put this code in your functions.php


add_action('wp_enqueue_scripts', function () {

    //Enqueue compiled main.scss from dist/style.css
    wp_enqueue_style(
        'your-theme-name',
        get_stylesheet_directory_uri() . '/dist/style.css', // compiled CSS
    );
});




--challenges faced during development--

Some of the challenges I faced whilst developing were setting up and utilising vite for sass this was challenging because I encountered some errors when it came to writing the scss. I later found out these were due to incorrect paths in my php function.
Another difficulty I found was finding the right web elements in the php to modify in scss for example alter the position, scale and other aspects of the content.
