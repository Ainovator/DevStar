# DevStar
Тестовое задание от компании "DevStar";

# Комментарии

1. В текущем исполнении ID берётся как int из параметра компонента. Понятно, что в реальном компоненте оно должно парсится из сформированного url пользователя
2. Тестовый класс, просто читал про новые стандартны Bitrix, смотрел, как они реализовали ООП
3. По принципу никто не кому не должны доверять, возможно наклепал лишних проверок на бэке.
4. Добавил проверку для занятого номера телефона
5. Изначально делал по старому, просто добавил обработку $_REQUEST в component.php,переделал на контроллер ajax.php. За основу взял компонент sale.domain.verification.form


# Формулировка:

Тестовое задание для начинающего специалиста Битрикс
 
Разработать компонент, который получает и выводит следующую информацию о пользователе:
Имя
Фамилия
Дата рождения
Мобильный телефон
Пользователь должен задаваться через параметры компонента. Компонент должен выводить форму для изменения вышеуказанных полей, если текущий авторизованный пользователь совпадает с пользователем, заданным через параметр. Иными словами дать возможность отредактировать информацию,если авторизованный пользователь является владельцем профиля, который выводит компонент. Все поля обязательны для заполнения. Если какое то поле заполнено некорректно, компонент не должен сохранять изменения и выводить соответствующую ошибку. Компонент должен поддерживать кеширование данных и выводить актуальную информацию даже в случае изменения полей. Параметры кеширования необходимо продумать самостоятельно.

На что будем обращать внимание:
Чистота кода
Правильно выстроенную архитектуру
Понимание архитектуры Битрикс в целом


Будет плюсом:

Размещение кода в репозитории на gitlab.com или github.com
Наличие в коде проверок и обработка исключительных ситуаций
Использование ядра d7
