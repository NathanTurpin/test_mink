<template>
  <div
    class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-300"
  >
    <div
      class="w-full h-32 sm:h-40 md:h-48 lg:h-56 bg-gray-200 flex justify-center items-center"
    >
      <img
        :src="'/uploads/images/' + animal.images"
        alt="Image de l'animal"
        class="w-auto h-full object-cover"
      />
    </div>

    <div class="p-4">
      <h2 class="text-xl font-semibold text-gray-800">{{ animal.name }}</h2>
      <p class="mt-2 text-gray-600">{{ animal.description }}</p>

      <p class="text-lg font-semibold text-green-600 mt-4">
        {{ animal.price }}€
      </p>

      <p class="text-sm text-gray-500">Âge: {{ animal.age }} ans</p>

      <a href="#" class="text-blue-500 mt-4 inline-block"
        >Voir les détails &raquo;</a
      >
    </div>
  </div>
</template>


<script setup>
const props = defineProps({
  animal: Object,
});
</script>

<style scoped>
/* Vous pouvez personnaliser le style si nécessaire */
</style>
