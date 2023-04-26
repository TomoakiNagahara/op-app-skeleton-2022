<img src="https://user-images.githubusercontent.com/1668339/72398593-cb0d1900-3786-11ea-863c-418ff8d48f43.png"/>The onepice-framework app skeleton 2022
===

<div class="margin bottom 1">
  <img src="https://img.shields.io/badge/PHP-7.0_higher-brightgreen" alt="php7.0 higher"/>
  <img src="https://www.php.net/images/php8/logo_php8_2.svg" alt="php8.2" height="22" width="60"/>
</div>

# The "onepiece-framework" is insanely great!!

## php70 branch how to use

 1. `git checkout origin/php70 -b php70`
 2. `git submodule sync`
 3. `php git.php asset/git/fetch.php `
 4. `php git.php asset/git/rebase.php `

## 2022 had a big change!!

 The first is "OP()" function.
 "OP()" makes it easy to access the same functionality in any namespaces.
 For details, please refer to the following URL: `develop:/reference/core/OP`

 The second is "CI/CD".
 The onepiece-framework includes its own "CI/CD".
 "CI" is automatically inspect all your code.
 Inspected code only will be delivery via "CD".
 And they work with GitHub Action.

 The third is "The develop module".
 Integrated everything. There are `selftest`, `admin`, `testcase` and `reference`.

## Download & Start up

 1. Download: `git clone --recurse-submodules https://github.com/onepiece-framework/op-app-skeleton-2022.git 2022`
 2. Change directory: `cd 2022`
 3. Do following command: `git submodule foreach git checkout 2022`
 4. Start up at PHP Built-in WebServer: `php -S localhost:8000 app.php`
 5. Access via the browser: `http://localhost:8000`

## CI/CD

 You using CI/CD is very easy.
 Just type: `./cicd`
 If you need more information, please refer to the following URL: develop:/reference/core/CICD

# The "NewWorld" is a new world!!

 * True MVC Completed
 * Intuitive file structure
 * Html pass through

## True MVC Completed

 MVC is not wrong.
 Until now, the implementation method was wrong.
 The "NEW WORLD" solved it in a very simple way.

 * Model is each `Unit`
 * View is  each directory located files.
 * Controller is each directory located `index.php` files.

## Intuitive file structure

 You won't get lost.

## What does "Html pass through" mean?

 "Html pass through" is directly output HTML.
 Until now, Old style MVC is required an empty controller.
 The onepiece-framework's NEW WORLD is does not need a controller.
 Of course it will be doing layout.

# Apology

 * Microsoft Windows products is not support

## Microsoft Windows products is not support

 Our do not support a Microsoft Windows products.
 Because to keep clean sourse code.
 But, Windows Subsystem for Linux should work probably.

# 2022 to 2023

 * asset:/config/op.php  > `_OP_APP_BRANCH_`
 * asset:/config/app.php > `title`
 * asset:/git/submodule/*.sh
