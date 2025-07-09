<template>
  <div>
    <div class="mb-6 p-4 bg-gray-100 border-l-4 border-blue-500 rounded shadow">
      <h2 class="text-xl font-semibold text-blue-800 mb-2">Mall Information</h2>
      <p><strong>Party:</strong> {{ mall.party }}</p>
      <p><strong>Gauge:</strong> {{ mall.input1 }}</p>
      <p><strong>Length:</strong> {{ mall.input2 }}</p>
      <p><strong>Width:</strong> {{ mall.input3 }}</p>
      <p><strong>Lot:</strong> {{ mall.lot }}</p>
      <p><strong>Quantity:</strong> {{ mall.availableqty }}</p>
    </div>
    <div class="max-w-2xl mx-auto p-6 bg-white rounded-xl shadow mt-10">
      <form @submit.prevent="submitForm">
        <div class="flex justify-center">
          <h1 class="text-xl">Create New Order</h1>
        </div>
        <div class="mb-4">
          <label class="block font-semibold mb-1 text-gray-700">Gauge</label>
          <input type="text" v-model="form.ogauge" class="w-full border px-4 py-2 rounded focus:ring focus:ring-blue-400" id="ogauge" required />
        </div>
        <div class="mb-4">
          <label class="block font-semibold mb-1 text-gray-700">Piece</label>
          <input type="text" v-model="form.peice" class="w-full border px-4 py-2 rounded focus:ring focus:ring-blue-400" id="peice" required />
        </div>
        <div class="mb-4">
          <label class="block font-semibold mb-1 text-gray-700">Lenght:</label>
          <input type="number" v-model.number="form.olenght" class="w-full border px-4 py-2 rounded focus:ring focus:ring-blue-400" id="olenght" required />
        </div>
        <div class="mb-4">
          <label class="block font-semibold mb-1 text-gray-700">Quantity</label>
          <select v-model.number="form.orderedqty" class="w-full border px-4 py-2 rounded focus:ring focus:ring-blue-400" id="orderedqty" :disabled="mall.availableqty < 1" required>
            <option value="">Select Quantity</option>
            <option v-for="i in quantityOptions" :key="i" :value="i">{{ i }}</option>
          </select>
          <div class="text-xs text-gray-500 mt-1">Available: {{ mall.availableqty }}</div>
        </div>
        <div class="mb-4">
          <label class="block font-semibold mb-1 text-gray-700">Date:</label>
          <input type="date" v-model="form.dateno" class="w-full border px-4 py-2 rounded focus:ring focus:ring-blue-400" id="dateno" required />
        </div>
        <div class="mb-4">
          <label class="block font-semibold mb-1 text-gray-700">Widht:</label>
          <input type="number" v-model.number="form.bundlewidht" class="w-full border px-4 py-2 rounded focus:ring focus:ring-blue-400" id="bundlewidht" required />
        </div>
        <div class="mb-4">
          <label class="block font-semibold mb-1 text-gray-700">Sheets Per Bundle:</label>
          <input type="number" v-model.number="form.sheetperbundle" class="w-full border px-4 py-2 rounded focus:ring focus:ring-blue-400" id="sheetperbundle" required />
        </div>
        <div class="mb-4">
          <label class="block font-semibold mb-1 text-gray-700">Jali Lenght:</label>
          <input type="number" v-model.number="form.jalilenght" class="w-full border px-4 py-2 rounded focus:ring focus:ring-blue-400" id="jalilenght" required />
        </div>
        <input type="hidden" :value="mall.id" name="mall_id" />
        <div class="mt-6">
          <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
            Submit
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { defineProps, reactive, computed } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
  mall: { type: Object, required: true }
});

const form = reactive({
  ogauge: '',
  peice: '',
  olenght: '',
  orderedqty: '',
  dateno: '',
  bundlewidht: '',
  sheetperbundle: '',
  jalilenght: ''
});

const quantityOptions = computed(() => {
  const qty = parseInt(props.mall.availableqty) || 0;
  return Array.from({ length: qty }, (_, i) => i + 1);
});

function submitForm() {
  router.post(route('Addmall.store'), {
    ...form,
    mall_id: props.mall.id
  });
}
</script>

<style scoped>
@media print {
  .max-w-2xl {
    max-width: 100vw !important;
    box-shadow: none !important;
    border-radius: 0 !important;
    margin: 0 !important;
    padding: 0 !important;
  }
}
</style>
