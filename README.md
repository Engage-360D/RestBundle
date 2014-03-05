RestBundle
==========

### Шаг 1: Добавить в composer.json:

```js
{
    "require": {
        "engage360d/rest-bundle": "dev-master"
    },
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/Engage-360D/RestBundle.git"
        }
    ]
}
```

### Шаг 2: Добавить в AppKernel.php инициализацию бандла

```php
<?php
    // app/AppKernel.php

    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Engage360d\Bundle\RestBundle\Engage360dRestBundle(),
        );
    }
```

### Шаг 3: Пример использования

```yaml
services:
    engage360d_rest.form.test.post:
        factory_service: form.factory
        factory_method: createNamed
        class: Symfony\Component\Form\Form
        arguments: ["test", "engage360d_rest_post_test", null, { }]
        tags:
            - { name: rest.form, route: post_tests }
```

```yaml
services:
    engage360d_rest.manager.test:
        class: %engage360d_rest.manger.test.class%
        arguments: [@security.encoder_factory]
        tags:
            - { name: rest.entity_manager, route: post_tests }
```

```php
<?php

    public function postTestController()
    {
        $formFactory = $this->container->get('engage360d_rest.form.factory');
        $form = $formFactory->createFormByRoute($this->getRequest()->get('_route'));
        
        $manager = $this->container
            ->get('engage360d_rest.entity_manager.factory')
            ->getEntityManagerByRoute($this->getRequest()->get('_route'));
    }
```