<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

?>

<div class = "place-order-container">
    <div class = "place-order-content">
        <div class = "place-order-header">
            <h1>Заполните информацию для заказа</h1>
        </div>
        <div class = "place-order-input-container">
            <form >
                <input class = "input-name" id = "input-name" type="text" placeholder="Имя" maxlength="15">
                <input class = "input-second-name" id = "input-second-name" type="text" placeholder="Фамилия" maxlength="15">
                <input class = "input-phone" id = "input-phone" type = tel placeholder= "Телефон">
                <button class = "btn-place-order" id = "place-order">Оформить заказ</button>
            </form>
        </div>
    </div>
</div>
