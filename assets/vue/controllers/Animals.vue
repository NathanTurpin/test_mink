<template>
  <div class="container mx-auto py-12">
    <div
      class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8"
    >
      <Card v-for="animal in animals" :key="animal.id" :animal="animal" />
    </div>
  </div>
</template>

<script setup>
import Card from "../component/Card.vue";
import { onMounted } from "vue";

const props = defineProps({
  animals: Array,
});

onMounted(() => {
  console.log(props.animals);
});
</script>
