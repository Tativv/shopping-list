<script setup>
import { ref, computed, onMounted } from 'vue'

// Estado dos inputs
const produto = ref('')
const preco = ref('')

// Lista de produtos (vem da API)
const produtos = ref([])

// Buscar produtos do backend (Laravel)
const carregarProdutos = async () => {
  const response = await fetch('http://127.0.0.1:8000/api/products')
  const data = await response.json()
  produtos.value = data
}

// Adicionar produto
const addProduto = async () => {
  if (produto.value.trim() === '' || preco.value === '') return

  const valor = parseFloat(preco.value.replace(',', '.'))
  if (valor <= 0) return

  await fetch('http://127.0.0.1:8000/api/products', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      name: produto.value,
      price: valor
    })
  })

  // Limpar campos
  produto.value = ''
  preco.value = ''

  // Atualizar lista
  await carregarProdutos()
}

// Remover produto
const removerProduto = async (id) => {
  const confirmar = confirm('Tem certeza que deseja eliminar este produto?')
  if (!confirmar) return

  await fetch(`http://127.0.0.1:8000/api/products/${id}`, {
    method: 'DELETE'
  })

  await carregarProdutos()
}

// Calcular total
const total = computed(() => {
  return produtos.value.reduce((sum, item) => {
    return sum + Number(item.price)
  }, 0)
})

// Carregar produtos ao iniciar
onMounted(() => {
  carregarProdutos()
})

// Marcar como comprado
const toggleComprado = async (id) => {
  await fetch(`http://127.0.0.1:8000/api/products/${id}`, {
    method: 'PUT'
  })

  await carregarProdutos()
}

</script>

<template>
  <div class="wrapper">
    <div class="container">

      <h1>🛒 Smart Shopping App</h1>

      <!--FORMULÁRIO -->
      <form class="form" @submit.prevent="addProduto">
        <input v-model="produto" placeholder="Nome do produto..." />
        <input v-model="preco" type="text" placeholder="Preço" />
        <button type="submit">Adicionar</button>
      </form>

      <!--LISTA -->
      <TransitionGroup name="fade" tag="ul" class="list">
        <li v-for="item in produtos" :key="item.id" class="item">

          <!-- Nome -->
          <span
            class="nome"
            :class="{ comprado: item.bought }"
            @click="toggleComprado(item.id)"
            >
           {{ item.name }}
         </span>

          <!-- Preço -->
          <span class="preco">
            R$ {{ Number(item.price).toFixed(2).replace('.', ',') }}
          </span>

          <!-- Botão SVG -->
          <button class="delete" @click="removerProduto(item.id)">
            <svg xmlns="http://www.w3.org/2000/svg"
                 width="18"
                 height="18"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 stroke-linecap="round"
                 stroke-linejoin="round">
              <path d="M3 6h18"/>
              <path d="M8 6V4h8v2"/>
              <path d="M19 6l-1 14H6L5 6"/>
              <path d="M10 11v6"/>
              <path d="M14 11v6"/>
            </svg>
          </button>

        </li>
      </TransitionGroup>

      <!-- Total -->
      <h3 class="total">Total: R$ {{ total.toFixed(2) }}</h3>

    </div>
  </div>
</template>

<style>
body {
  margin: 0;
  font-family: Arial, sans-serif;
  background: #f4f6f8;
}

/* CONTENEDOR PRINCIPAL */
.wrapper {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  padding: 15px;
}

/* TARJETA */
.container {
  width: 100%;
  max-width: 500px;
  background: white;
  padding: 20px;
  border-radius: 14px;
  box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}

/* TÍTULO */
h1 {
  text-align: center;
  color: #111;
  font-size: 22px;
  margin-bottom: 20px;
}

/* FORM */
.form {
  display: flex;
  gap: 10px;
  margin-bottom: 20px;
  flex-wrap: wrap;
}

input {
  flex: 1;
  min-width: 120px;
  padding: 10px;
  border-radius: 8px;
  border: 1px solid #ccc;
  font-size: 14px;
}

/* BOTÓN AGREGAR */
.form button {
  padding: 10px 14px;
  border: none;
  background: #42b883;
  color: white;
  border-radius: 8px;
  cursor: pointer;
  font-weight: bold;
}

.form button:hover {
  background: #369870;
}

/* LISTA */
.list {
  list-style: none;
  padding: 0;
  margin: 0;
}

/* ITEM */
.item {
  display: grid;
  grid-template-columns: 1fr 80px 40px;
  align-items: center;
  padding: 12px;
  border-bottom: 1px solid #eee;
  gap: 10px;
  transition: background 0.2s;
}

/* HOVER */
.item:hover {
  background: #f9f9f9;
}

/* NOMBRE */
.nome {
  font-size: 15px;
  color: #111;
  font-weight: 500;
  word-break: break-word;
}

/* PRECIO */
.preco {
  text-align: right;
  font-weight: bold;
  color: #000;
}

/* BOTÓN ELIMINAR */
.delete {
  background: transparent;
  border: none;
  cursor: pointer;
  color: #888;
  display: flex;
  justify-content: center;
  align-items: center;
  transition: all 0.2s ease;
}

.delete:hover {
  color: #ff4d4f;
  transform: scale(1.2);
}

.delete:active {
  transform: scale(0.9);
}

/* TOTAL */
.total {
  text-align: right;
  margin-top: 15px;
  font-size: 18px;
  color: #000;
}

/* ANIMACIÓN */
.fade-enter-active,
.fade-leave-active {
  transition: all 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
  transform: translateY(10px);
}

/* RESPONSIVE (CELULAR) */
@media (max-width: 480px) {

  .container {
    padding: 15px;
  }

  h1 {
    font-size: 18px;
  }

  /* formulario en columna */
  .form {
    flex-direction: column;
  }

  .form button {
    width: 100%;
  }

  /* lista adaptada */
  .item {
    grid-template-columns: 1fr;
    gap: 5px;
    align-items: flex-start;
  }

  .preco {
    text-align: left;
    font-size: 14px;
  }

  .delete {
    align-self: flex-end;
  }

  .total {
    font-size: 16px;
  }
}

.comprado {
  text-decoration: line-through;
  color: gray;
  opacity: 0.7;
}

.nome {
  cursor: pointer;
}

</style>
