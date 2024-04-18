# Drupal Dev Tools
This repository contains assets for running linters, pre-commit hooks, xdebug and unit testing during Drupal site development.

## Usage

Add this project to any Drupal distribution based on drupal/core-composer-scaffold to enable it for use.

This project setup the following features:

- Pre-commit hooks.
- Linters: php, drupal, js, styles.
- Scripts for running PHPUnit and Behat tests.
- Xdebug setup for VSCode.
- Enable debugging twig templates.

## Enabling this project

This project must be enabled in the top-level composer.json file, or it will be ignored and will not perform any of its functions.
```
{
    "require": {
        "frankrecalde/drupal-devtools"
    },
    ...
    "extra": {
        "drupal-scaffold": {
            "allowed-packages": [
                "frankrecalde/drupal-devtools"
            ]
        }
    }
}
```

## Pre-commit checks

The idea behind is to put effort in to fail on simple checks as quickly as possible, and pre-commit hooks can be used to detect failures before they are even committed.

Pre-commit checks run after staging changes and running `git commit` and before a commit is completed. If the checks fail then the commit is not made and an error shown, while if all checks pass the commit is made as normal.

The aim is to run linting scripts and tests, allowing each commit to be as clean as possible.

### Ignore pre-commit hooks

For committing without any validation use the `--no-verify` flag.

## Scripts

There are several scripts available to aid in development tasks.

**Note:** All linter scripts will run as part of the pre-commit checks. Setup can be found in `.lintstagedrc.yml` file.

**Run the PHP and YAML linter**

```
  npm run test:code:php
  npm run test:code:php web/modules/custom/custom_module/src/Sample.php
  npm run test:code:php web/themes/custom/custom_module
```

**Run the check on Drupal correctness and deprecation errors**

```
  npm run test:code:drupal
  npm run test:code:drupal web/modules/custom/custom_module/src/Sample.php
  npm run test:code:drupal web/themes/custom/custom_module
```

**Run automate fixing deprecated Drupal code**

```
  npm run test:code:drupal-rector
```

**Run the JavaScript linter**

```
  npm run test:code:js
  npm run test:code:js web/modules/custom/custom_module/js/sample.es6.js
  npm run test:code:js web/themes/custom/custom_module/js
```

**Run the Style linter**

```
  npm run test:code:styles
  npm run test:code:styles web/themes/custom/custom_module/scss
```

**Run the functional and unit tests (todo)**

**Run Behat tests(todo)**
