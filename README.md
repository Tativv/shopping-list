# 🛒 Smart Shopping App

Aplicação full stack de lista de compras desenvolvida com **Vue** no frontend e **Laravel** no backend.

---

## Sobre o projeto

Este projeto permite gerenciar uma lista de compras de forma simples e eficiente.

Funcionalidades principais:

* Adicionar produtos
* Listar produtos
* Remover produtos
* Persistência de dados em banco (API Laravel)
* Interface responsiva 

---

### Frontend
![Vue](https://img.shields.io/badge/Vue%203-42b883?style=for-the-badge&logo=vue.js&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-FFEB3B?style=for-the-badge&logo=javascript&logoColor=black)
![Vite](https://img.shields.io/badge/Vite-646CFF?style=for-the-badge&logo=vite&logoColor=white)
![CSS](https://img.shields.io/badge/CSS3-1565C0?style=for-the-badge&logo=css3&logoColor=white)

---

### Backend
![Laravel](https://img.shields.io/badge/Laravel-F55247?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)

---

### Banco de dados
![SQLite](https://img.shields.io/badge/SQLite-07405E?style=for-the-badge&logo=sqlite&logoColor=white)

---

## Arquitetura

Projeto dividido em duas partes:

```bash
shopping-app-vue-laravel/
├── frontend-vue/   # Aplicação Vue
└── shopping-api/   # API Laravel
```

---

## Como rodar o projeto

### Backend (Laravel)

```bash
cd shopping-api
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

**A API estará disponível em:**

```
http://127.0.0.1:8000
```

---

### Frontend (Vue)

```bash
cd frontend-vue
npm install
npm run dev
```

**A aplicação estará em:**

```
http://localhost:5173
```

---

## Comunicação

O frontend consome a API Laravel através de requisições HTTP:

* GET /api/products
* POST /api/products
* DELETE /api/products/{id}

---

## Objetivo

Este projeto foi desenvolvido como parte do meu aprendizado em desenvolvimento full stack, com foco em:

* Integração entre frontend e backend
* Consumo de APIs
* Boas práticas de desenvolvimento
* Construção de aplicações reais

---

## Próximas melhorias

* Marcar produto como comprado
* Filtro de produtos
* Melhorias de UI/UX
* Deploy da aplicação

---

## 👩‍💻 Autora
Tatiana Varona

