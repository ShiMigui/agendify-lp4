# Agendify

Service scheduling system built with Laravel, Blade, and Docker.

## Features

- User registration and login (messages in PT-BR)
- Users can **offer** services (1:N)
- Users can **book** services from other providers (1:N)
- Booking starts from the **Agendar** button on the service page
- Self-booking is blocked (you cannot book your own service)
- Booking status: **Pendente** (default), **Concluído**, or **Cancelado**
- Status actions via buttons: *Concluir agendamento* / *Cancelar agendamento*
- Booking list grouped by status (Pendentes, Concluídos, Cancelados)
- Date and time in separate fields on the booking form

## Relationships

```
Usuario 1 ──offers──> N Servico
Servico 1 ──is offered by──> 1 Usuario

Usuario 1 ──books──> N Agendamento
Agendamento N ──belongs to──> 1 Servico
```

## Requirements

- Docker and Docker Compose

## How to run

1. Copy the environment file at the project root (used by both Docker and Laravel):

```bash
cp .env.example .env
```

> The root `.env` is passed automatically inside docker-compose.

1. Start the containers:

```bash
docker compose up --build
```

1. Access the application:

- **App:** <http://localhost:8000>
- **phpMyAdmin:** <http://localhost:8080>

1. (Optional) Populate the database with sample data:

```bash
docker compose exec api php artisan db:seed
```

Sample users after seeding:

| Email | Password |
|-------|----------|
| <joao@agendify.com> | password |
| <maria@agendify.com> | password |

## Booking flow

1. Go to **Serviços** and open a service from another provider
2. Click **Agendar** (`/servicos/{id}/agendar`)
3. Fill in the date (default: today), time, and notes
4. The booking is created with status **Pendente**
5. On the edit or details page, use the buttons to **Concluir** or **Cancelar**

## Structure

```
api/
├── app/
│   ├── Http/Controllers/   # Auth, Servico, Agendamento
│   ├── Http/Requests/      # Form validation
│   └── Models/             # User, Servico, Agendamento
├── database/migrations/    # users, servicos, agendamentos
├── lang/pt_BR/             # PT-BR translations
├── resources/views/        # Blade templates
└── routes/web.php          # Application routes
```

## Technologies

- PHP 8.4 / Laravel 13
- MySQL
- Blade + Vite + SCSS
- Docker Compose
