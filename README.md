# Google Font Cache
![Version](https://img.shields.io/badge/version-v1.0.0-violet.svg)
![Last commit](https://img.shields.io/github/last-commit/wysiwyg-software-design/google-font-cache.svg?style=flat)
![Build status](https://api.travis-ci.org/wysiwyg-software-design/google-font-cache.svg?branch=develop)
![WordPress v5.2.4](https://img.shields.io/badge/wordpress-v5.2.4-blue.svg)

A WordPress Plugin to cache Google Fonts to your server to avoid GDPR conflicts

## Requirements
### Docker
1. [Docker](https://docker.com)
2. [Docker Compose](https://docs.docker.com/compose/install/)

## Getting started
To bring your development stack up, just start the vagrant box.

```bash
docker-compose up
```

| Endpoint              | URL                                   |
|---------              | ---                                   |
| **Docker** Frontend   | http://google-font-cache.localhost              |
| **Docker** Backend    | http://google-font-cache.localhost/wp-admin     |
| **Docker** phpMyAdmin | http://google-font-cache.localhost/phpmyadmin   |

| Credential            | Value                                 |
|-----------            | -----                                 |
| MySQL user            | `hypress`                             |
| MySQL password        | `hypress`                             |
| MySQL database        | `hypress`                             |
| WordPress user        | `hypress`                             |
| WordPress password    | `hypress`                             |

## Bundle your theme or Plugin
To create a production ready release, just run

```bash
npm run bundle
```
You'll find a ready to use bundle in `./dist`.

## Contributing
This projects is open for contributions.

[hypress]: https://github.com/hypress
[generator-hypress]: https://github.com/hypress/generator-hypress
[mkcert]: https://github.com/FiloSottile/mkcert
