### Маршрутизация по URL адресам

#### Файл web.php содержит все доступные маршруты в приложении
#### Доступны следующие методы для объявления маршрутов:

```php
use \App\Routing\Route;

Route::get('/uri', [\App\Http\Controller\BaseController::class, 'test'])
Route::post('/uri', [\App\Http\Controller\BaseController::class, 'test'])
Route::put('/uri', [\App\Http\Controller\BaseController::class, 'test'])
Route::delete('/uri', [\App\Http\Controller\BaseController::class, 'test'])
```

#### Вместо контроллера и его метода, можно указать callable объект

```php
use \App\Routing\Route;
use \App\Http\Request\BaseRequest;

Route::get('/test', function (BaseRequest $request) {
    if (empty($request->headers['X-Real-IP'])) {
        header('HTTP/1.0 404 Not Found');
    }

    echo json_encode(['status' => 200, 'message' => 'Success', 'flag' => 'GxIDH1IHFF1BEHAHEafkIPDgGwOHYHNgMxkNM30='])
});
```

### Класс Route реализует функционал регистрации маршрутов в приложении и их дальнейшей передачи в контроллер
#### При необходимости, его функционал можно расширить