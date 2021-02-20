## Push notification by Laravel WebSocket

    1) Setup Laravel Websocket with Laravel Echo .
    2) Create TestNotification migration & Model .
       Here we'are using HomeController for Notificational Functionalities .
    3) Create TestEvent & TestListener .
    4) Create a route for broadcast on a channel in channel.php .
    5) In TestEvent add 'Class TestEvents implement shouldBroadcast' .
    6) Call the TestEvent from a function of HomeController .