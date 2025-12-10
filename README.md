DEV_ARTIGOS

Este projeto é uma mini-aplicação desenvolvida em Laravel com foco em boas práticas, responsividade e organização de código. 
Ele permite gerenciar Desenvolvedores, Artigos e a relação muitos-para-muitos entre eles, 
além de incluir autenticação completa e interface responsiva com Tailwind CSS.

🚀 Funcionalidades
🔐 Autenticação

Login, Registro (Laravel / UI — conforme implementado)

👨‍💻 Desenvolvedores (CRUD completo)

Campos:

Nome

E-mail (único)

Senioridade: Jr, Pl, Sr

Skills (tags)

Busca e filtros por:

Nome

Skill

Senioridade

Badge exibindo quantidade de artigos associados e criados

📝 Artigos (CRUD completo)

Campos:

Título

Slug

Conteúdo (HTML)

Data de publicação

Imagem de capa (opcional)

Associar múltiplos desenvolvedores ao criar/editar

Badge exibindo número de desenvolvedores vinculados

💻📱 Interface Responsiva

Desktop: Grid em cards

Mobile: Listagem vertical

Desenvolvido com Tailwind CSS

🧱 Requisitos Técnicos / Stack

Laravel 10+

PHP 8.1+

MySQL ou PostgreSQL

Tailwind CSS

Migrations + Seeders + Factories (Faker)

Policies para garantir que cada usuário altere apenas seus dados

Git Flow / Commits organizados

📦 Instalação e Configuração
1️⃣ Clonar o repositório
git clone https://github.com/KelvinsoaresF/artigos_dev.git
cd seu-repo

2️⃣ Instalar dependências
composer install
npm install
npm run build

3️⃣ Criar arquivo .env
cp .env.example .env

Configure seu banco de dados no .env:

DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

4️⃣ Gerar key da aplicação
php artisan key:generate

5️⃣ Rodar migrações e seeders
php artisan migrate --seed

6️⃣ Criar link simbólico para visualizar imagens
Após rodar as migrações, execute:
php artisan storage:link

7️⃣ Iniciar servidor
php artisan serve

npm run dev (em outro terminal na mesma pasta)

Acesse:
➡️ http://localhost:8000
