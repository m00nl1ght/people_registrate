// const { isSet } = require("lodash");
import { Autoinsert } from './modules/autoinsert.js';
import { inputFirstBigLetter, inputBigLetter } from './modules/helpers.js';

const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


inputFirstBigLetter(".capitalize");

//чекбоксы
const checkboxAllElem = document.querySelectorAll('input[type=checkbox]');

for (let checkBox of checkboxAllElem) {
    checkBox.addEventListener('click', (elem) => elem.target.toggleAttribute('checked') );
}

    //группы чекбоксов
const checkboxMainElem = document.querySelectorAll('.js-checkbox-main');

checkboxMainElem.forEach((elem) => {
    elem.addEventListener('click', (el) => {
        checkboxElems = el.target.closest('.js-checkbox').querySelectorAll('.js-checkbox-sub');

        if(el.target.getAttribute('aria-checked') == 'false') {
            el.target.setAttribute('aria-checked', 'true');

            if(el.target.getAttribute('name')) {
                sub = document.querySelector('.js-checkbox-' + el.target.getAttribute('name'));
                sub.removeAttribute('disabled');
            } 

            checkboxElems.forEach((elems) => {
                elems.closest('label').classList.remove('text-secondary');
                elems.removeAttribute('disabled');
            });
        } else {
            el.target.setAttribute('aria-checked', 'false');

            if(el.target.getAttribute('name')) {
                sub = document.querySelector('.js-checkbox-' + el.target.getAttribute('name'));
                sub.closest('label').classList.add('text-secondary');
                sub.setAttribute('disabled', 'disabled');
                sub.checked = false;
                sub.removeAttribute('checked');
                sub.setAttribute('aria-checked', 'false')
                subChildren = sub.closest('.js-checkbox').querySelectorAll('.js-checkbox-sub');

                subChildren.forEach((elems) => {
                    elems.closest('label').classList.add('text-secondary');
                    elems.setAttribute('disabled', 'disabled');
                    elems.checked = false;
                    elems.removeAttribute('checked');
                });
            } 

            checkboxElems.forEach((elems) => {
                elems.closest('label').classList.add('text-secondary');
                elems.setAttribute('disabled', 'disabled');
                elems.checked = false;
                elems.removeAttribute('checked');
            });
        }
    });
});


//автоподстановка в форму добавления Security
const securityAddFormElem = document.querySelector('.js-security-add-form');
if (securityAddFormElem){
    const securityFormItemElem = securityAddFormElem.querySelectorAll('.form-control');

    securityFormItemElem.forEach((elems) => {
        let props = {
            url : '/security/autoinsert',
    
            data : {
                "_token" : token,
                "key" : "name" 
            },
    
            insertIntoField : function (elem) {
                elems.value = elem.name;
            }
        };
    
        const autoinsert = new Autoinsert(elems, props);
    
        autoinsert.getFocus();
        autoinsert.lostFocus();
        autoinsert.sendRequest();
    });
}

//автоподстановка в формы Visitor и Car
const visitorForm = document.querySelector('.js-visitor-form');
if (visitorForm) {
    const visitorSurnameElem = visitorForm.querySelector('#visitor_surname');

    let props = {            
        data : {
        "_token" : token,
        "key" : "name"
        }
    };

    if(window.location.pathname == '/visitor/new') {
        props.url = "/visitor/autoinsert"

        props.insertIntoField = function (elems) {
            visitorSurnameElem.value = elems.surname;
            document.querySelector('#visitor_name').value = elems.name;
            document.querySelector('#visitor_patronymic').value = elems.patronymic;
            document.querySelector('#visitor_phone').value = elems.phone;
            document.querySelector('#visitor_firm').value = elems.firm.name;
            document.querySelector('#visitor_category').value = elems.category.name;
        }

    } else if(window.location.pathname == '/car/new') {        
        props.url = "/car/autoinsert"
        
        props.insertIntoField = function (elems) {
            visitorSurnameElem.value = elems.surname;
            document.querySelector('#visitor_name').value = elems.name;
            document.querySelector('#visitor_patronymic').value = elems.patronymic;
            document.querySelector('#visitor_phone').value = elems.phone;
            document.querySelector('#visitor_firm').value = elems.firm.name;
            document.querySelector('#visitor_category').value = elems.category.name;

            if (elems.car !== null) {
                document.querySelector('#visitor_car_number').value = elems.car.number;
                document.querySelector('#visitor_car_model').value = elems.car.model;
            }
        }
    }
   
    const autoinsert = new Autoinsert(visitorSurnameElem, props);

    autoinsert.getFocus();
    autoinsert.lostFocus();
    autoinsert.sendRequest();

    const carNumberElem = document.querySelector('#visitor_car_number');

    if(carNumberElem) {
        inputBigLetter(carNumberElem);
    }
}

//автоподстановка в форму добавления Employee
const employeeFormItemElem = document.querySelector('#visitor_employee_surname');

if (employeeFormItemElem) {
    let props = {
        url : '/employee/autoinsert',

        data : {
            "_token" : token,
            "key" : "name" 
        },

        insertIntoField : function (elems) {
            employeeFormItemElem.value = elems.surname;
            document.querySelector('#visitor_employee_name').value = elems.name;
            document.querySelector('#visitor_employee_patronymic').value = elems.patronymic;
        }
    };

    const autoinsert = new Autoinsert(employeeFormItemElem, props);

    autoinsert.getFocus();
    autoinsert.lostFocus();
    autoinsert.sendRequest();
}

//автоподстановка в форму выдачи карт
const employeeCardForgetName = document.querySelector('#employee_surname');

if (employeeCardForgetName) {
    let props = {
        url : '/employee/autoinsert',

        data : {
            "_token" : token,
            "key" : "name" 
        },

        insertIntoField : function (elems) {
            employeeCardForgetName.value = elems.surname;
            document.querySelector('#employee_name').value = elems.name;
            document.querySelector('#employee_patronymic').value = elems.patronymic;
            document.querySelector('#employee_position').value = elems.position;
        }
    };

    const autoinsert = new Autoinsert(employeeCardForgetName, props);

    autoinsert.getFocus();
    autoinsert.lostFocus();
    autoinsert.sendRequest();
}

const employeeBossCardForgetName = document.querySelector('#employee_boss_surname');

if (employeeBossCardForgetName) {
    let props = {
        url : '/employee/autoinsert',

        data : {
            "_token" : token,
            "key" : "name" 
        },

        insertIntoField : function (elems) {
            employeeBossCardForgetName.value = elems.surname;
            document.querySelector('#employee_boss_name').value = elems.name;
            document.querySelector('#employee_boss_patronymic').value = elems.patronymic;
            document.querySelector('#employee_boss_position').value = elems.position;
        }
    };

    const autoinsert = new Autoinsert(employeeBossCardForgetName, props);
    
    autoinsert.getFocus();
    autoinsert.lostFocus();
    autoinsert.sendRequest();
}