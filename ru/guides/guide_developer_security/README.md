# Настройки безопасности

Вы можете установить разные уровни доступа к объектам для авторизованных и неавторизованных пользователей,
для групп пользователей. Доступ можно группировать в наборы правил, связывая их с ролями. А роли, в свою очередь,
связывать с группами пользователей.

### Доступ к типам объектов

    @example
    \App\Telenok\Core\Security\Acl::role('frontend_standart_account_role')
        ->setPermission(['create', 'read'], 'object_type.package')
        ->setPermission(['update', 'delete'], 'object_type.package.own')
        ->setPermission(['update'], 'object_field.package.id')
        ->setPermission(['create', 'read', 'update'], 'object_field.package.title')
        ->setPermission(['create', 'read', 'update'], 'object_field.package.key')
        ->setPermission(['create', 'read', 'update'], 'object_field.package.description')
        ->setPermission(['create', 'read', 'update'], 'object_field.package.active')
        ->setPermission(['create', 'read', 'update'], 'object_field.package.version')
        ->setPermission(['create', 'read', 'update'], 'object_field.package.image')

        ->setPermission(['create', 'read'], 'object_type.package_version')
        ->setPermission(['update', 'delete'], 'object_type.package_version.own')
        ->setPermission(['create', 'read', 'update'], 'object_field.package_version.title')
        ->setPermission(['create', 'read', 'update'], 'object_field.package_version.version_package')
        ->setPermission(['create', 'read', 'update'], 'object_field.package_version.active')
        ->setPermission(['create', 'read', 'update'], 'object_field.package_version.zip');


### Доступ к полям объектов

    @example
    \App\Telenok\Core\Security\Acl::role('frontend_standart_account_role')
        ->setPermission(['create', 'read', 'update'], 'object_field.package.title')
        ->setPermission(['create', 'read', 'update'], 'object_field.package.key')
        ->setPermission(['create', 'read', 'update'], 'object_field.package.description')
        ->setPermission(['create', 'read', 'update'], 'object_field.package.active')
        ->setPermission(['create', 'read', 'update'], 'object_field.package.version')
        ->setPermission(['create', 'read', 'update'], 'object_field.package.image')
        ->setPermission(['create', 'read', 'update'], 'object_field.package_version.zip');
