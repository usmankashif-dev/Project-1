<template>
<AppLayout>
  <div class="max-w-7xl mx-auto p-6 bg-white rounded-xl shadow mt-10 print:bg-white print:text-black">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold print:text-black">Bundle Chart</h1>
    </div>
    <div class="overflow-x-auto">
      <table class="min-w-full bg-white border border-gray-200 rounded-lg print:text-xs print:border-black">
        <thead class="bg-gray-100 print:bg-white">
          <tr>
            <th v-for="header in tableHeaders" :key="header" class="px-4 py-2 border-b print:border-black print:font-normal print:text-xs">{{ header }}</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(bundle, idx) in bundles" :key="bundle.id" class="hover:bg-gray-50 print:hover:bg-white">
            <td class="px-4 py-2 border-b print:border-black">{{ idx + 1 }}</td>
            <td class="px-4 py-2 border-b print:border-black">{{ bundle.stock_party_name ?? '-' }}</td>
            <td class="px-4 py-2 border-b print:border-black">{{ bundle.stock_lot ?? '-' }}</td>
            <td class="px-4 py-2 border-b print:border-black">{{ bundle.stock_cutsheet ?? '-' }}</td>
            <td class="px-4 py-2 border-b print:border-black">{{ bundle.stock_peice ?? '-' }}</td>
            <td class="px-4 py-2 border-b print:border-black">{{ bundle.stock_widht ?? '-' }}</td>
            <td class="px-4 py-2 border-b print:border-black">{{ bundle.stock_jalilenght ?? '-' }}</td>
            <td class="px-4 py-2 border-b print:border-black">{{ bundle.date }}</td>
            <td class="px-4 py-2 border-b print:border-black">{{ bundle.sheets_per_bundle }}</td>
            <td class="px-4 py-2 border-b print:border-black">{{ bundle.bundle_count }}</td>
            <td class="px-4 py-2 border-b print:border-black">{{ bundle.sheets_per_bundle * bundle.bundle_count }}</td>
            <td class="px-4 py-2 border-b print:border-black">{{ bundle.packed_by ?? '-' }}</td>
            <td class="px-4 py-2 border-b print:border-black">
              <form @submit.prevent="deleteBundle(bundle.id)" class="inline print:hidden">
                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700" :disabled="deletingId === bundle.id">Delete</button>
              </form>
              <form @submit.prevent="verifyBundle(bundle.id)" class="inline print:hidden">
                <button type="submit" class="bg-green-700 text-white px-3 py-1 rounded hover:bg-green-800 ml-2">Verify</button>
              </form>
              <a @click.prevent="openBilla(bundle.id, 'A')" href="#" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 ml-2 print:hidden" target="_blank">Billa A</a>
              <a @click.prevent="openBilla(bundle.id, 'B')" href="#" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 ml-2 print:hidden" target="_blank">Billa B</a>
              <a @click.prevent="openBilla(bundle.id, 'C')" href="#" class="bg-yellow-600 text-white px-3 py-1 rounded hover:bg-yellow-700 ml-2 print:hidden" target="_blank">Billa C</a>
            </td>
          </tr>
          <tr v-if="!bundles.length">
            <td colspan="13" class="text-center py-6 text-gray-500 print:text-black">No bundles found.</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</AppLayout>
</template>

<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue'

const props = defineProps({
  bundles: { type: Array, required: true },
});

const deletingId = ref(null);

const tableHeaders = [
  '#', 'Party', 'Lot', 'Cuted Sheet', 'Peice', 'Widht', 'Jali Lenght', 'Bundle Date', 'Sheets/Bundle', 'Bundle Count', 'Total Sheets', 'Packed By', 'Actions'
];

function deleteBundle(id) {
  if (confirm('Are you sure you want to delete this bundle?')) {
    deletingId.value = id;
    router.delete(route('bundle.delete', id), {
      onFinish: () => { deletingId.value = null; }
    });
  }
}

function verifyBundle(id) {
  if (confirm('Are you sure you want to verify this bundle?')) {
    router.post(route('bundle.verify', id));
  }
}

function openBilla(id, type) {
  window.open(route('bundle.billa', { id, type }), '_blank');
}
</script>

<style scoped>
@media print {
  .print\:hidden { display: none !important; }
  .print\:bg-white { background-color: #fff !important; }
  .print\:text-black { color: #000 !important; }
  .print\:shadow-none { box-shadow: none !important; }
  .print\:border-black { border-color: #000 !important; }
  .print\:font-normal { font-weight: normal !important; }
  .print\:text-xs { font-size: 0.75rem !important; }
}
</style>
