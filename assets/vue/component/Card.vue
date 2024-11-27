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
      <p
        class="mt-2 text-gray-600 line-clamp-2"
        v-html="sanitizedDescription"
      ></p>
      <p class="text-lg font-semibold text-green-600 mt-4">
        {{ calculatePriceWithVAT(animal.price, animal.tva) }}
      </p>
      <div class="flex gap-2">
        <p class="text-sm text-gray-500">Âge: {{ animal.age }} ans |</p>
        <p class="text-sm text-gray-500">Type: {{ animal.type.name }} |</p>
        <p class="text-sm text-gray-500">Race: {{ animal.race.name }}</p>
      </div>

      <a
        href="tel:+33781975489"
        class="text-white bg-blue-500 hover:bg-blue-600 rounded-md py-2 px-4 mt-4 inline-block sm:hidden"
      >
        Appeler
      </a>

      <p class="text-blue-500 mt-4 hidden sm:block">+33781975489</p>
    </div>
  </div>
</template>


<script setup>
import { computed } from "vue";
import DOMPurify from "dompurify";
import { priceMixin } from "../mixin/priceMixin";
const props = defineProps({
  animal: Object,
});

defineOptions({
  mixins: [priceMixin],
});

const sanitizedDescription = computed(() => {
  // delete all dangerous html attribut
  return DOMPurify.sanitize(props.animal.description);
});
</script>

