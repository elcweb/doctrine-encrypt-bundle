DoctrineEncryptBundle
=====================

[![Latest Stable Version](https://poser.pugx.org/elcweb/doctrine-encrypt-bundle/v/stable.png)](https://packagist.org/packages/elcweb/doctrine-encrypt-bundle)
[![Total Downloads](https://poser.pugx.org/elcweb/doctrine-encrypt-bundle/downloads.png)](https://packagist.org/packages/elcweb/doctrine-encrypt-bundle)

Installation
------------

### Step 1: Download using composer

```js
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
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Elcweb\DoctrineEncryptBundle\ElcwebDoctrineEncryptBundle(),
    );
}
```

License
-------

This bundle is under the MIT license. See the complete license in the bundle:

    Resources/meta/LICENSE

