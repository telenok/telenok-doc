# Создание шаблона веб-страницы

По умолчанию шаблоны хранятся в директории <code>&lt;base_path&gt;/resources/views/</code>. Так же вы 
можете в Контрольной панели определить условия и ключи к ним, в соответствии с которыми система пытается 
найти шаблоны в директориях, например, для ключа default в 
<code>&lt;base_path&gt;/resources/views/template/default/view/my_template.blade.php</code>

Если пользователем в Контрольной панели не определен ни один ключ или шаблон не найден по указанному адресу, 
то используется шаблон из директории <code>&lt;base_path&gt;/resources/views/</code>.

Для подключения шаблона в контроллере вы можете использовать фукнцию <code>theme_view</code>. Код функции 
располагается в <code>&lt;base_path&gt;/vendor/telenok/core/src/config/helpers.php</code>.

    @example
    class Controller extends \App\Telenok\Core\Controller\Frontend\Controller {
        public function getContent()
        {
            //....
            return theme_view("page.home");
        }
    }

Для выше приведенного кода для ключа 