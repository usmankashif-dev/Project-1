<template>
  <div class="max-w-2xl mx-auto p-6 bg-white rounded-xl shadow mt-10">
    <form @submit.prevent="submitForm">
      <div class="flex justify-center">
        <h1 class="text-xl">Edit Order</h1>
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
        <template v-if="order.type === 'm'">
          <input type="number" v-model.number="form.orderedqty" class="w-full border px-4 py-2 rounded focus:ring focus:ring-blue-400 bg-gray-100" id="orderedqty" readonly />
          <div class="text-xs text-gray-500 mt-1">Full quantity will be used for M Order.</div>
        </template>
        <template v-else>
          <input
            type="number"
            v-model.number="form.orderedqty"
            class="w-full border px-4 py-2 rounded focus:ring focus:ring-blue-400"
            id="orderedqty"
            min="1"
            required
          />
          <div class="text-xs text-gray-500 mt-1">Available: {{ maxQty }}</div>
        </template>
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
      <input type="hidden" :value="order.id" name="mall_id" />
      <div class="mt-6">
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
          Submit
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { defineProps, reactive } from 'vue';
import { useForm, router } from '@inertiajs/vue3';

const props = defineProps({
  order: { type: Object, required: true },
  mall: { type: Object, required: false, default: null },
});

const maxQty = props.mall?.availableqty ?? props.order?.orderedqty ?? 100;

const form = reactive({
  ogauge: props.order.ogauge,
  peice: props.order.peice,
  olenght: props.order.olenght,
  orderedqty: props.order.orderedqty,
  dateno: props.order.dateno,
  bundlewidht: props.order.bundlewidht,
  sheetperbundle: props.order.sheetperbundle,
  jalilenght: props.order.jalilenght,
  mall_id: props.order.mall_id, // ensure correct mall_id is sent
});

function submitForm() {
  router.post(route('order.update', props.order.id), form);
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
