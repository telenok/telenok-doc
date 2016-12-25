# Настройки Telenok CMS

Настройки могут группироваться по смысловой нагрузке, однако доступ к ним из кода 
остается аналогичным стандартному доступу для настроек в Laravel.

    @example
    $localeDefault = config('app.localeDefault');

В Базе данных настройки хранятся в таблице <code>setting</code> в сериализованном виде в поле
<code>value</code>.

В административном разделе настройка по умолчанию отображается в качестве значения элемента управления 
<code>&lt;input type="text" /&gt;</code>. Однако вы так же можете создать как специальный обработчик 
сохраняемого значения настройки, так и шаблон для этой настройки.

Если вы хотите сохранить индивидуальную настройку, можете выполнить следующий код:

    @example
    (new \App\Telenok\Core\Model\System\Setting())->storeOrUpdate([
        'title' => ['en' => 'My settings', 'ru' => 'Мои настройки'],
        'active' => 1,
        'code' => 'mynews.package.describe',
        'value' => 'Some words about my package'
    ]);

Если вы хотите для собственного пакета отображать настройки на одной странице при их создании/редактировании, 
тогда Вы можете программно создавать **групповые** настройки следующим образом:

    @example
    (new \App\Telenok\Core\Model\System\Setting())->storeOrUpdate([
        'title' => ['en' => 'Base settings', 'ru' => 'Основные настройки'],
        'active' => 1,
        'code' => 'telenok.basic',
        'value' => [
            'app.backend.brand' => 'My Company',
            'app.localeDefault' => 'en',
            'app.locales' => ['en'],
            'app.timezone' => 'UTC',
            'telenok.theme' => 'default'
        ]
    ]);

где <code>'code' => 'telenok.basic',</code> - название групповой настройки в классе, который отвечает за сохранение 
и отображение этой группы.

Для создания групповой настройки необходимо добавить в файл <code>path-to-package/src/.../config/event.php</code> 
подобные строки:

    @example
    \Event::listen('telenok.repository.setting', function($list)
    {
        $list->push('App\Telenok\Core\Setting\Basic\Controller');
    });

где <code>App\Telenok\Core\Setting\Basic\Controller</code> является именем класса-обработчика групповой или индивидуальной 
настройки.

Для более подробного ознакомления с созданием и редактированием настроек, пожалуйста, посмотрите, например, класс 
<code>\Telenok\Core\Setting\Basic\Controller</code>