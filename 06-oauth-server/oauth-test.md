#  Описом тестових запитів та відповідей OpenAPI Client

## Authorization Code Flow

Цей потік використовується, коли є сторонній клієнт, який взаємодіє з сервером авторизації від імені користувача.

Параметри запиту:

Client ID: nest-app - унікальний ідентифікатор клієнта в Keycloak.

Client Secret: * - секретний ключ клієнта (конфіденційно).

Scopes: openid, profile - запитувані області доступу.

Authorization URL: http://localhost:8080/realms/Alyona/protocol/openid-connect/auth - точка входу для автентифікації користувача.

Token URL: http://localhost:8080/realms/Alyona/protocol/openid-connect/token - ендпоінт для обміну отриманого коду на токен.

## Implicit Flow

Використовується для SPA (Single Page Application) або додатків, що працюють на стороні клієнта, де немає можливості безпечно зберігати облікові дані.

Параметри запиту:

Client ID: nest-app

Scopes: openid

Authorization URL: http://localhost:8080/realms/Alyona/protocol/openid-connect/auth

## Password Cred Flow

Цей потік використовується, коли додаток має високий рівень довіри до користувача (наприклад, офіційний мобільний додаток). У цьому випадку користувач передає свій логін і пароль безпосередньо клієнту.

Параметри запиту:

Token URL: http://localhost:8080/realms/Alyona/protocol/openid-connect/token 

Username: user1  

Password: * 

Client ID: nest-app 

Client Secret: * 

## Client Cred Flow

Використовується, коли клієнт (додаток) самостійно аутентифікується на сервері авторизації без участі користувача (найчастіше для доступу до ресурсів на стороні сервера).

Параметри запиту:

Token URL: http://localhost:8080/realms/Alyona/protocol/openid-connect/token 

Client ID: nest-app

Client Secret: *

Scopes: openid 

## Отримана відповідь

Помилка 404 - Not Found

Оскільки ми робимо запит до /test-auth, якого реально немає на сервері Swagger.

Хоча запит повернув 404, сам факт відправки запиту з заголовком Authorization: Bearer підтверджує, що клієнт успішно отримав і використав токен.