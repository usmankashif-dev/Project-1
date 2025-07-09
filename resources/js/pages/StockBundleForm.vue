<template>
  <div class="max-w-lg mx-auto py-8 print:bg-white print:text-black">
    <h1 class="text-2xl font-bold mb-6 print:text-black">Bundle Finished Stock</h1>
    <form @submit.prevent="submitForm" id="bundleForm">
      <div class="mb-4">
        <label for="bundle_date" class="block text-sm font-medium text-gray-700">Date</label>
        <input type="date" name="bundle_date" id="bundle_date" v-model="form.bundle_date" class="border rounded px-2 py-1 w-full" required />
      </div>
      <div class="mb-4">
        <label for="sheets_per_bundle" class="block text-sm font-medium text-gray-700">Sheets per Bundle</label>
        <input type="number" name="sheets_per_bundle" id="sheets_per_bundle" v-model.number="form.sheets_per_bundle" class="border rounded px-2 py-1 w-full" :min="1" :max="maxSheets" required @input="updateBundleOptions" />
      </div>
      <div class="mb-4">
        <label for="bundle_count" class="block text-sm font-medium text-gray-700">Bundle</label>
        <select name="bundle_count" id="bundle_count" v-model.number="form.bundle_count" class="border rounded px-2 py-1 w-full" required>
          <option value="">Select Bundle</option>
          <option v-for="i in maxBundles" :key="i" :value="i">{{ i }}</option>
        </select>
      </div>
      <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 print:hidden">Submit</button>
    </form>
  </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
  stock: { type: Object, required: true },
  old: { type: Object, default: () => ({}) },
});

const maxSheets = props.stock.bundle;

const form = ref({
  bundle_date: props.old.bundle_date || new Date().toISOString().slice(0, 10),
  sheets_per_bundle: props.old.sheets_per_bundle || 1,
  bundle_count: props.old.bundle_count || '',
});

const maxBundles = computed(() => {
  const sheets = parseInt(form.value.sheets_per_bundle) || 1;
  return Math.floor(maxSheets / sheets);
});

function updateBundleOptions() {
  // Reset bundle_count if out of range
  if (form.value.bundle_count > maxBundles.value) {
    form.value.bundle_count = '';
  }
}

function submitForm() {
  router.post(route('stock.bundle.store', props.stock.id), form.value);
}

watch(() => form.value.sheets_per_bundle, updateBundleOptions);
</script>

<style scoped>
@media print {
  .print\:hidden { display: none !important; }
  .print\:bg-white { background-color: #fff !important; }
  .print\:text-black { color: #000 !important; }
}
</style>
