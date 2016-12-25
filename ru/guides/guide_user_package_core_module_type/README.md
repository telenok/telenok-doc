# Модуль "Тип объекта"

Модуль **Тип объекта** содержит форму для создания/редактирования Типов элементов, которыми Вы оперируете в 
приложении. Вы можете представить **Тип** как описание объекта. Например, 
**Новость** и **Человек** могут быть типами объекта. В Базе данных храниться
множество экземпляров этих объектов. У каждого объекта имеются свойства (или поля), например, 
у типа **Новость** такими свойствами могут быть Название, Активность, Краткое содержание, Картинки и другие.

В модуле **Тип объекта** Вы можете создать тип и для него в Базе данных будут автоматически
созданы несколько свойств: **Название**, **Активность**, **Доступ**, **Кем и когда создано**,
**Кем и когда обновлено**.

Зачем необходимо хранить типы и уметь ими управлять ? Это требуется для того, 
чтобы спустя время ни Вы, ни другие пользователи или разработчики приложения 
не потеряли данные и не забыли о структуре приложения и имеющихся объектах. 
Такое часто бывает в больших проектах, со временем превращающихся в головную боль 
их владельцев и менеджеров.

Представьте, что у Вас возникла необходимость создавать и хранить новые записи таких типов, 
которых еще нет в приложении. Это может быть тип **Новость**, тип **Товар** или тип **Животное**.

Обычно в таких случаях нанимается программист, который создает класс, новую таблицу в Базе данных, форму редактирования 
и добавляет табличные колонки в соответствии с параметрами Типа.

В колонках таблицы могут храниться, например, строки или целые числа, отражающие адрес или количество.

Именно чтобы упростить работу, Telenok CMS и предоставляет такой инструмент, как Модуль "Тип объекта", 
в котором оперативно и без больших временных затрат реализуется данная задача.

При создании Типа само приложение сконфигурирует Базу Данных, добавит на сервер необходимые файлы и Вам останется 
только заполнить Базу данных элементами созданного Типа.

Модуль **Тип** находится в Группе модулей **Содержимое** в Главном модуле **Объекты**.

{@img 1.gif Модуль "Тип объекта" в Группе модулей}

Описание:

1. Модуль **Тип** в Группе модулей **Содержимое** и Главного модуля **Объекты**.
1. Список типов Вашего приложения.

## Создание типа объекта

Для создания нового Типа объекта нажмите на кнопку **Создать**, представленную на следующем изображении.

{@img 2.gif Создание типа объекта}

Описание:

1. Создание нового типа объекта. Кнопка "Создать"

## Форма Типа объекта

После нажатия на кнопку **Создать** откроется новая вкладка, как показано на следующем изображении. 
Сама форма содержит три вкладки:

1. Основное
1. Видимость
1. Дополнительно

Подробнее о каждой вкладке ниже.

{@img 3.gif Форма "Тип объекта"}

### Описание вкладки **Основное**:

1. Поле **Название**. `Обязательное.` Задается название Типа объекта
1. Поле **Заголовок списка**. `Обязательное.` Задается название типа объекта в списке, который 
содержит записи данного типа объектов. Обычно название списка задается во множественном числе. На картинке показано место, 
в котором отображается значение из поля **Заголовок списка**
{@img 4.gif Где отображается Заголовок списка}
1. Поле **Код**. `Обязательное.` Значение поля должно начинаться с латинской буквы, содержать латинские буквы, цифры или подчеркивание. 
При создании типа объекта в базе данных появится таблица с названием из этого поля.
Так же будет создан PHP класс **Eloquent модели** в директории <app/Model>.
Например, если Вы укажете в этом поле значение "category_news", то полное имя 
класса типа объекта будет равно \App\Model\CategoryNews и файл с классом расположится в <app/Model/CategoryNews.php>.
1. Поле **Мультиязычность**. `Обязательное.` Является ли поле **Название** мультиязычным в элементах этого Типа.
1. Поле **Класс модели**. `Не является обязательным.` Если Вы не укажите здесь класс - он будет создан автоматически, 
как описано для поля "Код". Допустимы, например, такие значение, начинающиеся с \App\:
    - \App\Model\News\CategoryNews
    - \App\Model\Product
или другие классы, не начинающиеся с \App\, но уже существующие физически в PHP файле.
1. Поле **Класс формы**. `Не является обязательным.` В поле указывается полное имя класса, который отвечает 
за прорисовку формы и списка элементов данного Типа, а так же сохранение и 
обновление записи данного Типа. Допустимыми значениями являются, например, такие, начинающиеся с \App\:
    - \App\Telenok\Core\Module\Objects\Version\Controller
    - \App\MyNamespace\Page\Controller
или другие классы, не начинающиеся с \App\, но уже существующие физически в PHP файле.
1. Поле **Деревообразный**. `Обязательное.` Тип может быть ветвистым, то есть элементы могут содержать 
другие элементы в качестве потомков. Это удобно для создания, например, каталога товаров,
где категории товаров имеют подкатегории. Один и тот же элемент может быть потомком в разных ветках дерева.
1. Поля **Потомок** для выбора Потомков Типа. `Не является обязательным.` Это может быть запись типа **Папка** или другая древовидная запись.
Например, в деревовидном списке в центре Вы можете видеть потомков у папки Система и папки Пользователь.
1. Поля **Родитель** для выбора Родителей Типа. `Не является обязательным.` Это может быть запись типа **Папка** или другая древовидная запись.
Например, в деревовидном списке в центре Вы можете видеть родителя (узел) у записи Тип объекта и записи Язык.

### Описание вкладки **Видимость**

Вкладка имеет стандартный функционал, ознакомиться с которым можно по этой ссылке 
[Общие элементы модулей](#!/guide/guide_user_modules_common_elements).


### Описание вкладки **Дополнительно**

На вкладке настройки безопасности и связанных с Типом записей. Подробнее на картинке:

{@img 5.gif Форма "Тип объекта". Вкладка "Дополнительно"}

1. 