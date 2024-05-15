// Определяем контейнеры для сообщений и форм
const msgContainer = document.getElementById("userpanel-container");
const formsContainer = document.getElementById("forms-container");

const autoAuthPath = 'assets/php/autoAuthenication.php';
const authPath = 'assets/php/authenticate.php';
const regPath = 'assets/php/register.php';
const logoutPath = 'assets/php/logout.php';
const logoutWipePath = 'assets/php/logoutWipe.php';
const deleteUserPath = 'assets/php/deleteUser.php';


// Добавляем обработчики событий при загрузке документа
document.addEventListener('DOMContentLoaded', function() {

    // Отправляем запросы на авторизацию и проверку статуса пользователя
    sendAction(autoAuthPath);

    // Обработчик отправки форм регистрации
    document.getElementById('reg-form').addEventListener('submit', function(event) {    
        event.preventDefault();

        const formData = new FormData(this);
        const data = Object.fromEntries(formData.entries());

        sendQuery(regPath, data);
    });
    // Обработчик отправки формы аутентификации
    document.getElementById('auth-form').addEventListener('submit', function(event) {    
        event.preventDefault();

        const formData = new FormData(this);
        const data = Object.fromEntries(formData.entries());

        sendQuery(authPath, data);
    });

    // Обработчики кнопки выхода из системы
    document.getElementById('logout-btn').onclick = function() {
        sendAction(logoutPath);
    };
    // Обработчики кнопки выхода из системы с удаленнием всех сессий
    document.getElementById('logout-wipe-btn').onclick = function() {
        sendAction(logoutWipePath);
    };
    // Обработчики кнопки удаления пользователя
    document.getElementById('deleteuser-btn').onclick = function() {
        sendAction(deleteUserPath);
    };
});

// Функция для отправки запросов на сервер
function sendAction(path){
    fetch(path)
      .then(response => response.json())
      .then(result => {
        if (result.success) {
            handleActionResponse(path, result);
        } else {
            switch(path){
                case authPath:
                case autoAuthPath:
                    msgContainer.style.display = "none";
                    formsContainer.style.display = "block";
                    break;
                default:
                    // Скрываем блок пользователя и показываем формы при любых других действиях
                    msgContainer.style.display = "none";
                    formsContainer.style.display = "block";
            }
        }
    })
    .catch(error => console.error('Error:', error));
}

// Обработчик ответов на действия пользователя
function handleActionResponse(path, result){
    switch (path) {
        case autoAuthPath:
            msgContainer.style.display = "block";
            formsContainer.style.display = "none";
            document.getElementById("greetings-text").textContent = "Hello " + result.name;
            break;
        default:
            // Скрываем блок пользователя и показываем формы при любых других действиях
            msgContainer.style.display = "none";
            formsContainer.style.display = "block";
    }
}

// Функция для отправки запросов с данными
function sendQuery(path, data){
    fetch(path, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=UTF-8',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify(data)
    })
   .then(response => response.json())
   .then(result => {
            if (result.success) {
                handleQueryResponse(path, result);
            } else {
                displayErrors(path, result.errors);
            }
        })
      .catch(error => console.error('Error:', error));
}

// Обработчик ответов на запросы с данными
function handleQueryResponse(path, result) {
    let text = '';

    switch (path) {
        case regPath:
            text = "reg";
            alert('Пользователь успешно зарегистрировался');
            break;
        case authPath:
            text = "auth";

            msgContainer.style.display = "block";
            formsContainer.style.display = "none";
            document.getElementById("greetings-text").textContent = "Hello " + result.name;
            
            break;
        default:
            // Скрываем блок пользователя и показываем формы при любых других действиях
            msgContainer.style.display = "none";
            formsContainer.style.display = "block";
    }
    let errorLabels = document.querySelectorAll(`[class="error-label-${text}"]`);  
    errorLabels.forEach((label) => {
        label.textContent = '';
    });
}

// Функция для отображения ошибок
function displayErrors(path, errors) {
    Object.keys(errors).forEach(key => {
        let text = '';
        switch (path){
            case regPath:
                text = "reg";
                break;
            case authPath:
                text = "auth";
                break;
         }
        label = document.querySelector(`[for="${key}-input-` + text+`"]`);
        if(label){
            if (errors[key]) {
                label.textContent = errors[key];
            } else {
                label.textContent = '';
            }
        }
    });
}