# SiteCrafting Wordpress Start

## Install

### Clone The Repo

``` Sh
cd path/to/workspace
git clone git@github.com:sitecrafting/wp-start-test.git
```

### Composer

This site is compiled using Composer and requires a token to load private repositories. A dotENV file called `.env.packagist` is needed to be installed at the root of the repository.

_This is a temporary solution. Hopefully soon we'll have a better solution_

### Start Lando

```sh
cd path/to/workspace
lando start
```

### Assets

The database and files can be obtained from one of the lead developers.


## Launch

Deployment is done via BitBucket Pipelines. Please discuss with the lead developer before launching to any environment.

To deploy to the staging environment create and push a tag that is formatted like `stg-0.0.0`

 ***ONLY THE LEAD DEV SHOULD DO THIS***
To deploy to the production environment create and push a tag that is formatted like `prd-0.0.0`
