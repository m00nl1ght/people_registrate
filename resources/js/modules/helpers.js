//функция отправки на сервер json
export let sendToController = async function(data, url) {
    let response = await fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify(data)
    });
          
    if(response.ok) {
        let result = await response.json();
  
        return result;
    };
}


//инпуты с большой первой буквы
export let inputFirstBigLetter = function(selector) {
    let field = document.querySelectorAll(selector);

    field.forEach(function(e) {
        e.addEventListener("input", function() {
            if (this.value[0] != undefined) {
                this.value = this.value[0].toUpperCase() + this.value.slice(1);
            }
        });
    });
}

//инпут все буквы большие
export let inputBigLetter = function(selector) {
    selector.addEventListener('input', function() {
        if (this.value[0] != undefined) {
            this.value = this.value.toUpperCase();
        }
    })
}
