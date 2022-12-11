

## Zadanie: Jednoduchý CRM systém pre správu klientov

Cieľom je vytvoriť jednoduchý admin-panel pre správu Klientov, Projektov a Taskov k ním s CRUD
operáciami (add/edit/delete/assign).

Môžeš použiť akúkoľvek štruktúru databázy a tabuliek, ale pokús sa prosím čo najviac využívať
funkcie Laravelu. Niektoré z nich, ktoré určite implementuj:

● Routing
- Route Model Binding v Resource Controller
- Route Redirect - homepage sa môže automaticky redirectovať z prihlásenia

● Database
- Database Seeders a Factories - na automatické vytvorenie prvých dát client/project/task
aj default users
- Eloquent Query Scopes - napr. pre ﬁlter zobrazenia iba aktívnych klientov
- Polymorphic relácie cez https://github.com/spatie/laravel-medialibrary
- Eloquent Accessors a Mutators - pre zobrazovanie dátumov vo formáte d/m/Y
- Soft Delete na všetky modely

● Auth
- Authorization: Roles/Permissions (admin and simple users), Gates, Policies cez Spatie
Permissions package
- Authentication: Email Veriﬁcation


● API
- API Routes and Controllers
- API Eloquent Resources
- API Auth with Sanctum
- Override API Error Handling and Status Codes

● Debugging chýb
- Try-Catch a Laravel Exceptions
- Vlastné Error Pages

● Odosielanie e-mailov
- Mailables and Mail Facade
- Notiﬁcations System: v histórií notiﬁkácii ukladaj zmeny v taskoch a notiﬁkuj o zmene na
mail userov s rolou Admin

● Extra bonus
- Automatické testy pre CRUD operácie

