import { sendToController } from './helpers.js';

export class Autoinsert {
    constructor(elems, props) {
        this.elems = elems;
        this.url = props.url;
        this.data = props.data;
        this.insertIntoField = props.insertIntoField;
    }

    getFocus() {
        this.elems.addEventListener('focus', (el) => {
            let insertElem = document.createElement('ul');
            
            insertElem.className = "position-absolute w-100 m0 list-group bg-light";
            insertElem.id = "autosubstitution";
    
            el.target.after(insertElem);
        })
    }

    lostFocus() {
        this.elems.addEventListener('blur', () => {
            setTimeout(function() {
                document.querySelector('#autosubstitution').remove();
            }, 300);        
        });
    }

    sendRequest() {
        this.elems.addEventListener('keyup', (el) => {
         let insertIntoField = this.insertIntoField;
            if (el.target.value.length >= 3) {
                this.data.data = this.elems.value;

                let parentInputField = document.querySelector('#autosubstitution');

                sendToController(this.data, this.url).then(function(response) {
                    while (parentInputField.firstChild) {
                        parentInputField.removeChild(parentInputField.firstChild);
                    }

                    response.forEach(function(element){
                        let listItem = document.createElement('li');
                        listItem.className = "p-0 my-1 list-group-item";
    
                        let button = document.createElement('button');
                        button.className = "w-100 btn btn-outline-secondary text-left";
                        button.type = 'button';

                        

                        button.textContent = `
                            ${ element.surname ? element.surname : ''} 
                            ${element.name ? element.name : ''} 
                            ${element.patronymic ? element.patronymic : ''}
                        `;
    
                        listItem.append(button);
                        parentInputField.append(listItem);

                        button.addEventListener('click', () => {
                            insertIntoField(element);
                        });
                    });
                })
            }
        })
    }
}