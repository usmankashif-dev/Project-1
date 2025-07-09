<template>
  <div class="max-w-xl mx-auto p-6 bg-white rounded-xl shadow mt-10">
    <h2 class="text-xl font-bold mb-4">Send Order To Machine</h2>
    <form @submit.prevent="submitForm">
      <div class="mb-4">
        <label class="block font-semibold mb-1 text-gray-700">Date</label>
        <input type="date" v-model="form.machinedate" class="w-full border px-4 py-2 rounded focus:ring focus:ring-blue-400" required />
      </div>
      <div class="mb-4">
        <label class="block font-semibold mb-1 text-gray-700">Machine No</label>
        <select v-model.number="form.machinenumber" class="w-full border px-4 py-2 rounded focus:ring focus:ring-blue-400" required>
          <option value="">Select Machine No</option>
          <option v-for="i in 20" :key="i" :value="i">{{ i }}</option>
        </select>
      </div>
      <div class="mb-4">
        <label class="block font-semibold mb-1 text-gray-700">Quantity</label>
        <select
          v-model.number="form.machineqty"
          class="w-full border px-4 py-2 rounded focus:ring focus:ring-blue-400"
          required
        >
          <option value="">Select Quantity</option>
          <option v-for="i in Number(order.rem)" :key="i" :value="i">{{ i }}</option>
        </select>
        <div class="text-xs text-gray-500 mt-1">Available to send: {{ order.rem }}</div>
      </div>
      <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Send To Machine</button>
    </form>
  </div>
</template>

<script setup>
import { defineProps, reactive } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
  order: { type: Object, required: true }
});

const form = reactive({
  machinedate: '',
  machinenumber: '',
  machineqty: ''
});

function submitForm() {
  router.post(route('order.sendToMachine', props.order.id), form);
}
</script>

<style scoped>
@media print {
  .max-w-xl {
    max-width: 100vw !important;
    box-shadow: none !important;
    border-radius: 0 !important;
    margin: 0 !important;
    padding: 0 !important;
  }
}
</style>
