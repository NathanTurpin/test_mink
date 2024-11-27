  <template>
  <div class="mb-8">
    <div class="flex justify-between mb-4">
      <div>
        <label for="type" class="mr-2">Filtrer par Type</label>
        <select
          v-model="selectedType"
          id="type"
          class="px-4 py-2 border rounded"
        >
          <option value="">Tous</option>
          <option v-for="type in types" :key="type" :value="type">
            {{ type.name }}
          </option>
        </select>
      </div>

      <div>
        <label for="race" class="mr-2">Filtrer par Race</label>
        <select
          v-model="selectedRace"
          id="race"
          class="px-4 py-2 border rounded"
        >
          <option value="">Toutes</option>
          <option v-for="race in races" :key="race" :value="race">
            {{ race.name }}
          </option>
        </select>
      </div>

      <div>
        <label for="sort" class="mr-2">Trier par</label>
        <select v-model="sortBy" id="sort" class="px-4 py-2 border rounded">
          <option value="name">Nom</option>
          <option value="price">Prix</option>
        </select>
        <select
          v-model="sortOrder"
          id="order"
          class="ml-2 px-4 py-2 border rounded"
        >
          <option value="asc">Ascendant</option>
          <option value="desc">Descendant</option>
        </select>
      </div>
    </div>
  </div>
</template>

  <script setup>
import { ref, computed, watch } from "vue";
const props = defineProps({
  animals: Array,
  types: Array,
  races: Array,
});

const selectedType = ref("");
const selectedRace = ref("");
const sortBy = ref("name");
const sortOrder = ref("asc");

const emit = defineEmits(["updateFilteredAnimals"]);

const filteredAnimals = computed(() => {
  let filtered = [...props.animals];

  if (selectedType.value) {
    filtered = filtered.filter(
      (animal) => animal.type.id === selectedType.value.id
    );
  }

  if (selectedRace.value) {
    filtered = filtered.filter(
      (animal) => animal.race.id === selectedRace.value.id
    );
  }

  filtered.sort((a, b) => {
    let compare = 0;

    if (sortBy.value === "name") {
      compare = a.name.localeCompare(b.name);
    }

    if (sortBy.value === "price") {
      compare = a.price - b.price;
    }

    return sortOrder.value === "asc" ? compare : -compare;
  });

  return filtered;
});

watch([selectedType, selectedRace, sortBy, sortOrder], () => {
  emit("updateFilteredAnimals", filteredAnimals.value);
});
</script>
