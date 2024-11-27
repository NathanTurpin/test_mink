<template>
  <div class="container mx-auto py-12">
    <AnimalFilter
      :animals="animals"
      :types="types"
      :races="races"
      @updateFilteredAnimals="updateFilteredAnimals"
    />
    <div
      class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8"
    >
      <Card
        v-for="animal in filterdAnimals"
        :key="animal.id"
        :animal="animal"
      />
    </div>
  </div>
</template>

<script setup>
import Card from "../component/Card.vue";
import AnimalFilter from "../component/AnimalFilter.vue";
import { ref } from "vue";

const props = defineProps({
  animals: Array,
  types: Array,
  races: Array,
});

const filterdAnimals = ref(props.animals);

const updateFilteredAnimals = (filtered) => {
  filterdAnimals.value = filtered;
};
</script>
