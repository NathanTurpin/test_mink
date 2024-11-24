<template>
  <div class="counter">
    <p>Current count: {{ count }}</p>
    <button @click="increment">Increment</button>
    <button @click="decrement" :disabled="count <= 0">Decrement</button>
    <button @click="reset">Reset</button>
  </div>
</template>

<script setup>
import { ref } from "vue";

// Déclare une variable réactive pour le compteur
const count = ref(0);

// Fonction pour incrémenter
const increment = () => {
  count.value++;
};

// Fonction pour décrémenter
const decrement = () => {
  if (count.value > 0) {
    count.value--;
  }
};

// Fonction pour réinitialiser
const reset = () => {
  count.value = 0;
};
</script>
