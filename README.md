DoctrineEncryptBundle
=====================

[![Latest Stable Version](https://poser.pugx.org/elcweb/doctrine-encrypt-bundle/v/stable.png)](https://packagist.org/packages/elcweb/doctrine-encrypt-bundle)
[![Total Downloads](https://poser.pugx.org/elcweb/doctrine-encrypt-bundle/downloads.png)](https://packagist.org/packages/elcweb/doctrine-encrypt-bundle)

Installation
------------

### Step 1: Download using composer

```json
{
    "require": {
        "51systems/doctrine-encrypt"         : "*",
        "elcweb/doctrine-encrypt-bundle"     : "dev-master"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update 51systems/doctrine-encrypt
$ php composer.phar update elcweb/doctrine-encrypt-bundle
```

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// config/bundles.php

return [
    // ...
    Elcweb\DoctrineEncryptBundle\ElcwebDoctrineEncryptBundle::class => ['all' => true],
];
```

### Step 3: Set secret
``` yaml
# config/packages/doctrine_encryption.yaml
elcweb_doctrine_encrypt:
  secret_key: SOME_STRING
```

License
-------

This bundle is under the MIT license. See the complete license in the bundle:

    Resources/meta/LICENSE

