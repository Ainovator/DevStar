<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

?>

<div class="form-container">
    <div class="form-content">
        <form method="post" name="edit-profile-form" id ="edit-profile-form">
            <div class="form-intro-content">
                <div class="input-block">
                    <label for="name" >Имя</label>
                    <input class = "test-input"
                           id       = "NAME"
                           name     = "NAME"
                           type     = "text"
                           value    = "<?=htmlspecialchars($arResult['NAME'])?>"
                           pattern  = "[A-Za-zА-Яа-яЁё\s]{2,}"
                           required
                    >
                </div>
                <span id = "name-error"></span>

                <div class="input-block">
                    <label for="last-name">Фамилия</label>
                    <input class    = "test-input"
                           id       = "LAST_NAME"
                           name     = "LAST_NAME"
                           type     = "text"
                           value    = "<?=htmlspecialchars($arResult['LAST_NAME'])?>"
                           pattern  = "[A-Za-zА-Яа-яЁё\s]{2,}"
                           required
                    >
                </div>

                <div class="input-block">
                    <label for="personal-birthday">Дата рождения</label>
                    <input id       = "PERSONAL_BIRTHDAY"
                           class    = "test-input"
                           name     = "PERSONAL_BIRTHDAY"
                           type     = "date"
                           value    = "<?=htmlspecialchars($arResult['PERSONAL_BIRTHDAY'])?>"
                           required
                    >
                </div>

                <div class="input-block">
                    <label for="personal-phone">Личный телефон</label>
                    <input id       = "PERSONAL_PHONE"
                           class    = "test-input"
                           name     = "PERSONAL_PHONE"
                           type     = "tel"
                           value    = "<?=htmlspecialchars($arResult['PERSONAL_PHONE'])?>"
                           pattern  ="\d{11}"
                           required
                    >
                </div>
            </div>

            <div class="form-buttons">
                <input type="submit" value = "<?=$arParams['BUTTON_SAVE_NAME']?>" name = "save" id="save" class = "form-button-save">
                <a href = "<?=$arParams['CANCEL_REDIRECT_URL']?>"><?=$arParams['BUTTON_CANCEL_NAME']?></a>
            </div>
        </form>
    </div>
</div>

