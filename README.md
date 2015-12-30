# Werkspot statsd bundle

[![Travis build status](https://travis-ci.org/Werkspot/statsd-bundle.svg?branch=master)](https://travis-ci.org/Werkspot/sitemap-bundle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Werkspot/statsd-bundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Werkspot/statsd-bundle/?branch=master)

### Install

`# composer require werkspot/statsd-bundle`

#### Update your config

```yaml
werkspot_statsd:
    application_prefix: my_app
```

#### Inject statsd clients to services

Use the interface to prepare the service to receive a client

`Werkspot\Bundle\StatsdBundle\Client\StatsdClientInterface`

Use the client factory and symfony expression language to inject via the container with a secondary prefix

```yaml
services:
    test.service:
        class: App\TestService
        arguments:
            - "@=service('werkspot_statsd.client_factory').getClient('instant_connect.service.participant')"
```
