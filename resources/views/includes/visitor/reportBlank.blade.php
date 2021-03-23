<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/css/reportBlank.css">
    <title>Пропуск автомобиль</title>
</head>
</html>

<body>
    <div class="no-print page-header">
        <button class="page-header__button" onclick="window.print()">Печатать</button>
        <a class="page-header__link" href="{{ route('visitor-index') }}">Назад</a>
	</div>
	<div class="page">
		<div class="title">
            <h1 class="title__head">Пропуск для посетителя № <?= $printDataArr['id'] ?></h1>
			<img class="title__img" src="/img/claas-logo.svg"/>
        </div>
        
        <div class="divider"></div>
        
        <div class="page-container">
            <div class="left-part">
                <table class="table-box">
                    <tr class="table-box__row_h10">
                        <td class="table-box__item table-box__item_w50">
                            <h3 class="table-box__item-head">Посетитель:</h3>
                            <!-- <small>(Фамилия И. О., № паспорта)</small> -->
                        </td>
                        <td class="table-box__item"><?= $printDataArr['visitor'] ?></td>
                    </tr>

                    <tr class="table-box__row_h10">
                        <td class="table-box__item table-box__item_w50">
                            <h3 class="table-box__item-head">Организация:</h3>
                            <!-- <small>(отправитель, перевозчик)</small> -->
                        </td>
                        <td class="table-box__item"><?= $printDataArr['firm'] ?></td>
                    </tr>

                    <tr class="table-box__row_h10">
                        <td class="table-box__item table-box__item_w50">
                            <h3 class="table-box__item-head">Контактное лицо:</h3>
                            <small>(со стороны ООО "КЛААС")</small>
                        </td>
                        <td class="table-box__item"><?= $printDataArr['employee'] ?></td>
                    </tr>
                </table>

                <div class="warning-message">
                    <h3 class="warning-message__text">Внимание!</h3>
                    <p class="warning-message__text">Ознакомьтесь с правилами пребывания на предприятии</p>
                    <small>(на обратной стороне бланка)</small>
                    <img class="warning-message__img" src="/img/signs.png" />
                </div>

        
                <table class="table-box">
                    <tr class="table-box__row_h10">
                        <th class="table-box__item table-box__item_center" colspan=2>с правилами ознакомлен</th>
                    </tr>
                    <tr class="table-box__row_h10">
                        <th class="table-box__item table-box__item_center table-box__item_w50">Дата</th>
                        <th class="table-box__item table-box__item_center">Подпись</th>
                    </tr>
                    <tr class="table-box__row_h10">
                        <td class="table-box__item table-box__item_center table-box__item_w50"><?= $printDataArr['date'] ?></td>
                        <td class="table-box__item"></td>
                    </tr>
                </table>

            </div>

            <div class="right-part">
                <table class="table-box">
                    <tr class="table-box__row_h10">
                        <th class="table-box__item" colspan=2>Прибытие</th>
                    </tr>

                    <tr class="table-box__row_h10">
                        <td class="table-box__item table-box__item_w50">Дата</td>
                        <td class="table-box__item"><?= $printDataArr['date'] ?></td>
                    </tr>

                    <tr class="table-box__row_h10">
                        <td class="table-box__item table-box__item_w50">Время</td>
                        <td class="table-box__item"><?= $printDataArr['time'] ?></td>
                    </tr>

                    <tr class="table-box__row_h10">
                        <td class="table-box__item table-box__item_w50">Ф.И.О. сотрудника охраны</td>
                        <td class="table-box__item"><?= $printDataArr['security'] ?></td>
                    </tr>
                </table>

                <table class="table-box">
                    <tr class="table-box__row_h10">
                        <th class="table-box__item" colspan=2>Отметки сотрудника охраны</th>
                    </tr>
                    <tr class="table-box__row_h10">
                        <td class="table-box__item table-box__item_w50">Время убытия</td>
                        <td class="table-box__item"></td>
                    </tr>
                    <tr class="table-box__row_h10">
                        <td class="table-box__item table-box__item_w50">Ф.И.О. сотрудника охраны</td>
                        <td class="table-box__item"></td>
                    </tr>
                </table>

                <table class="table-box">
                    <tr class="table-box__row_h10">
                        <th class="table-box__item" colspan=2>Отметки сотрудника "КЛААС"</th>
                    </tr>
                    <tr class="table-box__row_h10">
                        <td class="table-box__item table-box__item_w50">Время убытия</td>
                        <td class="table-box__item"></td>
                    </tr>
                    <tr class="table-box__row_h10">
                        <td class="table-box__item table-box__item_w50">Ф.И.О. сотрудника<br/>ООО "КЛААС"</td>
                        <td class="table-box__item"></td>
                    </tr>
                    <tr class="table-box__row_h10">
                        <td class="table-box__item table-box__item_w50">Подпись</td>
                        <td class="table-box__item"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

	<div class="page">
		<div class="rules">
			<div class="rules__header">Пожалуйста, соблюдайте правила пребывания на территории предприятия:</div>
			<ul class="rules__list">
				<li class="rules__list-item">Следуйте правилам безопасности, с которыми Вас ознакомили сотрудники охраны;</li>
				<li class="rules__list-item">Транспортные средства ООО «КЛААС» имеют право преимущественного проезда;</li>
				<li class="rules__list-item">Передвижение по территории только в сопровождении или по маршруту, указанному сотрудником  ООО «КЛААС»;</li>
				<li class="rules__list-item">Парковка разрешена только в специально отведенных местах;</li>
				<li class="rules__list-item">Запрещен доступ на территорию зоны таможенного контроля, отмеченной соответствующим знаком;</li>
				<li class="rules__list-item">Запрещены фото- и видеосъемка;</li>
                <li class="rules__list-item">Перемещаться по территории завода только в сопровождении сотрудника ООО «КЛААС» или строго по указанному сотрудником охраны маршруту;</li>
                <li class="rules__list-item">Запрещается находиться в производственных помещениях без сопровождения сотрудника ООО «КЛААС» и без средств индивидуальной защиты;</li>
				<li class="rules__list-item">Запрещено курение, за исключением специально отведенных мест;</li>
				<li class="rules__list-item">Сотрудники охраны могут произвести осмотр транспортных средств, сумок и других имеющихся при себе вещей.</li>
			</ul>
		</div>
		</div>
        </body>
</html>