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
        <a class="page-header__link" href="{{ route('car-index') }}">Назад</a>
	</div>
	<div class="page">
		<div class="title">
            <h1 class="title__head">Пропуск для автомобиля № <?= $printDataArr['id'] ?></h1>
			<img class="title__img" src="/img/claas-logo.svg"/>
        </div>
        
        <div class="divider"></div>
        
        <div class="page-container">
            <div class="left-part">
                <table class="table-box">
                    <tr>
                        <td class="table-box__item table-box__item_w50">
                            <h3 class="table-box__item-head">Автомобиль:</h3>
                            <small>(модель, гос. рег. знак)</small>
                        </td>
                        <td class="table-box__item"><?= $printDataArr['car_number'] ?></td>
                    </tr>

                    <tr>
                        <td class="table-box__item table-box__item_w50">
                            <h3 class="table-box__item-head">Водитель:</h3>
                            <small>(Фамилия И. О., № паспорта)</small>
                        </td>
                        <td class="table-box__item"><?= $printDataArr['visitor'] ?></td>
                    </tr>

                    <tr>
                        <td class="table-box__item table-box__item_w50">
                            <h3 class="table-box__item-head">Организация:</h3>
                            <small>(отправитель, перевозчик)</small>
                        </td>
                        <td class="table-box__item"><?= $printDataArr['firm'] ?></td>
                    </tr>

                    <tr>
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
                    <tr>
                        <th class="table-box__item" colspan=2>с правилами ознакомлен</th>
                    </tr>
                    <tr>
                        <th class="table-box__item table-box__item_w50">Дата</th>
                        <th class="table-box__item">Подпись водителя</th>
                    </tr>
                    <tr>
                        <td class="table-box__item table-box__item_center table-box__item_w50"><?= $printDataArr['date'] ?></td>
                        <td class="table-box__item"></td>
                    </tr>
                </table>

            </div>

            <div class="right-part">
                <table class="table-box">
                    <tr>
                        <th class="table-box__item" colspan=2>Прибытие</th>
                    </tr>

                    <tr>
                        <td class="table-box__item table-box__item_w50">Дата</td>
                        <td class="table-box__item"><?= $printDataArr['date'] ?></td>
                    </tr>

                    <tr>
                        <td class="table-box__item table-box__item_w50">Время</td>
                        <td class="table-box__item"><?= $printDataArr['time'] ?></td>
                    </tr>

                    <tr>
                        <td class="table-box__item table-box__item_w50">Ф.И.О. сотрудника охраны</td>
                        <td class="table-box__item"><?= $printDataArr['security'] ?></td>
                    </tr>
                </table>

                <table class="table-box">
                    <tr>
                        <th class="table-box__item" colspan=2>Отметки сотрудника охраны</th>
                    </tr>
                    <tr>
                        <td class="table-box__item table-box__item_w50">Время убытия</td>
                        <td class="table-box__item"></td>
                    </tr>
                    <tr>
                        <td class="table-box__item table-box__item_w50">Ф.И.О. сотрудника охраны</td>
                        <td class="table-box__item"></td>
                    </tr>
                </table>

                <table class="table-box">
                    <caption class="table-box__caption">Отметки сотрудника ООО "КЛААС"</caption>
                    <tr>
                        <td class="table-box__item table-box__item_w50">Место выгрузки:</td>
                        <td class="table-box__item"></td>
                    </tr>
                    <tr>
                        <td class="table-box__item table-box__item_w50">Груз, количество мест:</td>
                        <td class="table-box__item"></td>
                    </tr>
                    <tr>
                        <td class="table-box__item table-box__item_w50">Разгрузку осуществил:</td>
                        <td class="table-box__item"></td>
                    </tr>
                </table>
    

                <table class="table-box">
                    <tr>
                        <td class="table-box__item table-box__item_w50">Время убытия</td>
                        <td class="table-box__item"></td>
                    </tr>
                    <tr>
                        <td class="table-box__item table-box__item_w50">Ф.И.О. сотрудника<br/>ООО "КЛААС"</td>
                        <td class="table-box__item"></td>
                    </tr>
                    <tr>
                        <td class="table-box__item table-box__item_w50">Подпись</td>
                        <td class="table-box__item"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

	<div class="page second-page">
		<div class="page-container">
			<div class="left-part">
				<h2 class="second-page__head">Пожалуйста, соблюдайте правила пребывания на территории предприятия:</h2>
				<ul>
					<li class="second-page__list-item">Следуйте правилам безопасности, с которыми Вас ознакомили сотрудники охраны;</li>
					<li class="second-page__list-item">Транспортные средства ООО «КЛААС» имеют право преимущественного проезда;</li>
					<li class="second-page__list-item">Передвижение по территории только в сопровождении или по маршруту, указанному сотрудником  ООО «КЛААС»;</li>
					<li class="second-page__list-item">Парковка разрешена только в специально отведенных местах;</li>
					<li class="second-page__list-item">Запрещен доступ на территорию зоны таможенного контроля, отмеченной соответствующим знаком;</li>
					<li class="second-page__list-item">Запрещены фото- и видеосъемка;</li>
					<li class="second-page__list-item">Запрещено курение, за исключением специально отведенных мест;</li>
                    <li class="second-page__list-item">На территории ООО «КЛААС» водителю разрешено находиться строго в специальной защитной обуви с закрытым носком и пяткой;</li>
                    <li class="second-page__list-item">Перемещаться по территории завода только в сопровождении сотрудника ООО «КЛААС» или строго по указанному сотрудником охраны маршруту;</li>
					<li class="second-page__list-item">Сотрудники охраны могут произвести осмотр транспортных средств, сумок и других имеющихся при себе вещей.</li>
				</ul>
			</div>

			<div class="right-part">
				<img class="location-map" src="/img/carMap.jpg" />
			</div>
		</div>
	</div>
</body>
</html>
