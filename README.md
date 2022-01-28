    1) Метод POST, (в контроллере метод "store") принимает 2 параметра latitude и longitude, возвращает полный адрес. 
        Также добавляет в таблицу "request_data" данные запроса, а в "regions_cities" название города.

        Пример запроса: 
        http://127.0.0.1:8000/api/geodata/json?latitude=50.4536&longitude=30.5164
   
    2) Метод GET, (в контроллере метод "index") возвращает в формате JSON список всех адресов.
    
        Пример запроса: 
        http://127.0.0.1:8000/api/geodata/json
        
    3) Метод GET, (в контроллере метод "show") принимает 1 параметр id, возвращает в формате JSON адрес по этому id.
    
         Пример запроса: 
         http://127.0.0.1:8000/api/geodata/json/2
         
    4) Метод GET, (в контроллере метод "getSorted") принимает 1 параметр id, возвращает в формате JSON список адресов
     осортированых по id города.
     
         Пример запроса: 
         http://127.0.0.1:8000/api/geodata/sorted/2
   
   
Для успешной отправки запроса требуется API ключ, его можно взять в личном кабинете на 
https://console.cloud.google.com/apis/dashboard. Нужно выбрать/создать проект, перейти в APIs&Services->Credentials,
нажать CREATE CREDENTIALS->API KEY, скопировать сгенерированный API key и вставить его в config/geocodingApi.php,
в массив с ключем "key".

Регистрирование запрос-клиента происходит в app/Api/ApiServiceClient.
Получение и обработка данных в app/RequestDataHandler.
Фильтрация данных происходит в app/Resources/RequestDataResource.
