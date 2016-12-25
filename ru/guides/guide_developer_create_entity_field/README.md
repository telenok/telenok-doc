# Объекты Базы данных

В Базе данных информация хранится в плоском формате - в виде строк и столбцов. 
Telenok CMS преобразует каждую строку из таблицы в PHP объект, имеющий набор свойств и методов. 
Каждый такой объект наследуется от <code>\App\Telenok\Core\Interfaces\Eloquent\Object\Model</code>, 
который наследуется от {@link Telenok.Core.Interfaces.Eloquent.Object.Model \Telenok\Core\Interfaces\Eloquent\Object\Model}.

Создание или обновление записи в Базе данных происходит при помощи метода 
<code>\App\Telenok\Core\Interfaces\Eloquent\Object\Model@storeOrUpdate()</code>. Например, создание 
нового поля объекта Group (Группа пользователей) происходит следующим образом:

    @example
    (new \App\Telenok\Core\Model\Object\Field())->storeOrUpdate([
        'title' => ['en' => 'Role', 'ru' => 'Роль'],
        'title_list' => ['en' => 'Role', 'ru' => 'Роль'],
        'key' => 'relation-many-to-many',
        'code' => 'role',
        'active' => 1,
        'field_object_type' => 'group',
        'relation_many_to_many_has' => 'role',
        'field_object_tab' => 'main',
        'multilanguage' => 0,
        'show_in_form' => 1,
        'show_in_list' => 1,
        'allow_search' => 1,
        'allow_create' => 1,
        'allow_update' => 1,
        'field_order' => 6,
    ]);

Как вы видите, мы создаем новое поле, аттрибуты которого содержат разные значения,
например, <code>title</code> хранит массив значений, а <code>allow_search</code> 
содержит целое число.

Для изменения объекта необходимо дополнительно передать значение аттрибута поля <code>id</code>, например:

    @example
    (new \App\Telenok\Core\Model\Security\Resource())->storeOrUpdate([
        'id' => 12334,
        'title' => ['en' => 'Module: Field', 'ru' => 'Модуль: Поле'],
        'code' => 'module.objects-field',
        'active' => 1
    ]);

