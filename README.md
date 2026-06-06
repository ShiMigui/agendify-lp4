# Agendify

Sistema de agendamento de serviços desenvolvido com Laravel, Blade e Docker.

## Funcionalidades

- Cadastro e login de usuários (mensagens em PT-BR)
- Usuários podem **oferecer** serviços (1:N)
- Usuários podem **agendar** serviços de outros prestadores (1:N)
- Agendamento iniciado pelo botão **Agendar** na página do serviço
- Bloqueio de auto-agendamento (não é possível agendar o próprio serviço)
- Status de agendamento: **Pendente** (padrão), **Concluído** ou **Cancelado**
- Ações de status por botões: *Concluir agendamento* / *Cancelar agendamento*
- Listagem de agendamentos separada por status (Pendentes, Concluídos, Cancelados)
- Data e hora em campos separados no formulário de agendamento

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

1. Copie o arquivo de ambiente na raiz do projeto (usado pelo Docker e pelo Laravel):

```bash
cp .env.example .env
```

> O `.env` da raiz é passado automaticamente dentro do docker-compose.

1. Suba os containers:

```bash
docker compose up --build
```

1. Acesse a aplicação:

- **App:** <http://localhost:8000>
- **phpMyAdmin:** <http://localhost:8080>

1. (Opcional) Popule o banco com dados de exemplo:

```bash
docker compose exec api php artisan db:seed
```

Usuários de exemplo após o seed:

| E-mail | Senha |
|--------|-------|
| <joao@agendify.com> | password |
| <maria@agendify.com> | password |

## Fluxo de agendamento

1. Acesse **Serviços** e abra um serviço de outro prestador
2. Clique em **Agendar** (`/servicos/{id}/agendar`)
3. Preencha data (padrão: hoje), hora e observações
4. O agendamento é criado com status **Pendente**
5. Na edição ou detalhes, use os botões para **Concluir** ou **Cancelar**

## Estrutura

```
api/
├── app/
│   ├── Http/Controllers/   # Auth, Servico, Agendamento
│   ├── Http/Requests/      # Validação de formulários
│   └── Models/             # User, Servico, Agendamento
├── database/migrations/    # users, servicos, agendamentos
├── lang/pt_BR/             # Traduções PT-BR
├── resources/views/        # Templates Blade
└── routes/web.php          # Rotas da aplicação
```

## Tecnologias

- PHP 8.4 / Laravel 13
- MySQL
- Blade + Vite + SCSS
- Docker Compose
