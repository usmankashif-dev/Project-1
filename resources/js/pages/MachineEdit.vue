<template>
  <div class="max-w-2xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Edit Machine Entry</h1>
    <form @submit.prevent="submitForm">
      <div class="mb-4">
        <label for="machinedate" class="block text-sm font-medium text-gray-700">Date</label>
        <input type="date" v-model="form.machinedate" id="machinedate" class="border rounded px-2 py-1 w-full" required />
      </div>
      <div class="mb-4">
        <label for="machinenumber" class="block text-sm font-medium text-gray-700">Machine No</label>
        <input type="number" v-model.number="form.machinenumber" id="machinenumber" class="border rounded px-2 py-1 w-full" required />
      </div>
      <div class="mb-4">
        <label for="machineqty" class="block text-sm font-medium text-gray-700">Quantity</label>
        <select v-model.number="form.machineqty" id="machineqty" class="border rounded px-2 py-1 w-full" required>
          <option value="">Select Quantity</option>
          <option v-for="i in Number(maxQty)" :key="i" :value="i">{{ i }}</option>
        </select>
        <div class="text-xs text-gray-500 mt-1">Available to send: {{ maxQty }}</div>
      </div>
      <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
      <a :href="route('machine-view')" class="ml-4 text-gray-600 hover:underline">Cancel</a>
    </form>
    <div v-if="order" class="mt-6 text-sm text-gray-700">
      <strong>Order Rem:</strong> {{ order.rem }}<br />
      <strong>Order Party:</strong> {{ order.partyorder }}
    </div>
  </div>
</template>

<script setup>
import { defineProps, reactive } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
  machine: { type: Object, required: true },
  order: { type: Object, required: false, default: null },
});

const maxQty = props.order ? props.order.rem : props.machine.machineqty;

const form = reactive({
  machinedate: props.machine.machinedate,
  machinenumber: props.machine.machinenumber,
  machineqty: props.machine.machineqty,
});

function submitForm() {
  router.post(route('machine.update', props.machine.id), {
    ...form,
    _method: 'PUT',
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
