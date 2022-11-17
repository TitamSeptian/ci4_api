# CodeIgniter 4 AP

## Installation & updates

`composer create-project codeigniter4/appstarter` then `composer update` whenever
there is a new release of the framework.

When updating, check the release notes to see if there are any changes you might need to apply
to your `app` folder. The affected files can be copied or merged from
`vendor/codeigniter4/framework/app`.

## Setup

Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.

## some command

```bash
# run development
$ php spark serve
# make migrations
$ php spark make:migration product
# make model
$ php spark make:model ProductModel
# make controller
$ php spark make:controller --restful
# make filter
$ php spark make:filter Cors
```
