# Agendify

Sistema de agendamento de serviços desenvolvido com Laravel, Blade e Docker.

## Funcionalidades

- Cadastro e login de usuários
- Usuários podem **oferecer** serviços (1:N)
- Usuários podem **agendar** serviços de outros prestadores (1:N)
- CRUD completo de serviços e agendamentos com views Blade

## Relacionamentos

```
Usuario 1 ──oferece──> N Servico
Servico 1 ──é oferecido por──> 1 Usuario

Usuario 1 ──agenda──> N Agendamento
Agendamento N ──pertence a──> 1 Servico
```

## Requisitos

- Docker e Docker Compose

## Como executar

1. Copie o arquivo de ambiente:

```bash
cp .env.example .env
```

2. Suba os containers:

```bash
docker compose up --build
```

3. Acesse a aplicação:

- **App:** http://localhost:8000
- **phpMyAdmin:** http://localhost:8080

4. (Opcional) Popule o banco com dados de exemplo:

```bash
docker compose exec api php artisan db:seed
```

Usuários de exemplo após o seed:

| E-mail | Senha |
|--------|-------|
| joao@agendify.com | password |
| maria@agendify.com | password |

## Estrutura

```
api/
├── app/
│   ├── Http/Controllers/   # Auth, Servico, Agendamento
│   ├── Http/Requests/      # Validação de formulários
│   └── Models/             # User, Servico, Agendamento
├── database/migrations/    # users, servicos, agendamentos
├── resources/views/        # Templates Blade
└── routes/web.php          # Rotas da aplicação
```

## Tecnologias

- PHP 8.4 / Laravel 13
- MySQL
- Blade + Vite + SCSS
- Docker Compose
