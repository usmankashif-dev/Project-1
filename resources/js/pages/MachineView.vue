<template>
 <AppLayout>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div v-if="success" class="mb-4 text-green-600">
      {{ success }}
    </div>
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Machine Orders</h1>
    <!-- Search form (hidden by default, can be toggled with JS if needed) -->
    <form class="space-y-4 mb-6 hidden" id="machineSearchForm">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
          <label for="machinedate" class="block text-sm font-medium text-gray-700">Date</label>
          <input type="date" name="machinedate" id="machinedate" v-model="filters.machinedate" class="border rounded px-2 py-1 w-full" />
        </div>
        <div>
          <label for="machinenumber" class="block text-sm font-medium text-gray-700">Machine No</label>
          <input type="text" name="machinenumber" id="machinenumber" v-model="filters.machinenumber" class="border rounded px-2 py-1 w-full" />
        </div>
        <div>
          <label for="machineqty" class="block text-sm font-medium text-gray-700">Quantity</label>
          <input type="number" name="machineqty" id="machineqty" v-model="filters.machineqty" class="border rounded px-2 py-1 w-full" />
        </div>
        <div>
          <label for="olenght" class="block text-sm font-medium text-gray-700">Length</label>
          <input type="text" name="olenght" id="olenght" v-model="filters.olenght" class="border rounded px-2 py-1 w-full" />
        </div>
        <div>
          <label for="peice" class="block text-sm font-medium text-gray-700">Piece</label>
          <input type="text" name="peice" id="peice" v-model="filters.peice" class="border rounded px-2 py-1 w-full" />
        </div>
        <div>
          <label for="ogauge" class="block text-sm font-medium text-gray-700">Gauge</label>
          <input type="text" name="ogauge" id="ogauge" v-model="filters.ogauge" class="border rounded px-2 py-1 w-full" />
        </div>
        <div>
          <label for="cutsheet" class="block text-sm font-medium text-gray-700">Cut Sheet</label>
          <input type="text" name="cutsheet" id="cutsheet" v-model="filters.cutsheet" class="border rounded px-2 py-1 w-full" />
        </div>
        <div>
          <label for="lot" class="block text-sm font-medium text-gray-700">Lot</label>
          <input type="text" name="lot" id="lot" v-model="filters.lot" class="border rounded px-2 py-1 w-full" />
        </div>
        <div>
          <label for="bundlewidht" class="block text-sm font-medium text-gray-700">Bundle Width</label>
          <input type="text" name="bundlewidht" id="bundlewidht" v-model="filters.bundlewidht" class="border rounded px-2 py-1 w-full" />
        </div>
        <div>
          <label for="sheetperbundle" class="block text-sm font-medium text-gray-700">Sheets/Bundle</label>
          <input type="text" name="sheetperbundle" id="sheetperbundle" v-model="filters.sheetperbundle" class="border rounded px-2 py-1 w-full" />
        </div>
        <div>
          <label for="partyorder" class="block text-sm font-medium text-gray-700">Party Order</label>
          <input type="text" name="partyorder" id="partyorder" v-model="filters.partyorder" class="border rounded px-2 py-1 w-full" />
        </div>
        <div>
          <label for="jalilenght" class="block text-sm font-medium text-gray-700">Jali Length</label>
          <input type="text" name="jalilenght" id="jalilenght" v-model="filters.jalilenght" class="border rounded px-2 py-1 w-full" />
        </div>
        <div>
          <label for="orderedpeices" class="block text-sm font-medium text-gray-700">Ordered Pieces</label>
          <input type="text" name="orderedpeices" id="orderedpeices" v-model="filters.orderedpeices" class="border rounded px-2 py-1 w-full" />
        </div>
      </div>
      <div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Filter</button>
      </div>
    </form>
    <button id="machineSearchToggleBtn" class="search-toggle-btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">Search</button>
    <div class="overflow-x-auto bg-white shadow rounded-lg">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-100">
          <tr>
            <th class="p-2 py-2 text-left text-md font-medium text-gray-500 uppercase tracking-wider border-2 border-black">Date</th>
            <th class="p-2 py-2 text-left text-md font-medium text-gray-500 uppercase tracking-wider border-2 border-black">Party</th>
            <th class="p-2 py-2 text-left text-md font-medium text-gray-500 uppercase tracking-wider border-2 border-black">Lot</th>
            <th class="p-2 py-2 text-left text-md font-medium text-gray-500 uppercase tracking-wider border-2 border-black">Cuted Sheet</th>
            <th class="p-2 py-2 text-left text-md font-medium text-gray-500 uppercase tracking-wider border-2 border-black">Piece</th>
            <th class="p-2 py-2 text-left text-md font-medium text-gray-500 uppercase tracking-wider border-2 border-black">Gauge</th>
            <th class="p-2 py-2 text-left text-md font-medium text-gray-500 uppercase tracking-wider border-2 border-black">Bundle Widht</th>
            <th class="p-2 py-2 text-left text-md font-medium text-gray-500 uppercase tracking-wider border-2 border-black">Lenght</th>
            <th class="p-2 py-2 text-left text-md font-medium text-gray-500 uppercase tracking-wider border-2 border-black">Jali Lenght</th>
            <th class="p-2 py-2 text-left text-md font-medium text-gray-500 uppercase tracking-wider border-2 border-black">Sheet/Bundle</th>
            <th class="p-2 py-2 text-left text-md font-medium text-gray-500 uppercase tracking-wider border-2 border-black">Machine No</th>
            <th class="p-2 py-2 text-left text-md font-medium text-gray-500 uppercase tracking-wider border-2 border-black">Quantity</th>
            <th class="p-2 py-2 text-left text-md font-medium text-gray-500 uppercase tracking-wider border-2 border-black">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="machine in machines" :key="machine.id" class="hover:bg-gray-50">
            <td class="px-4 py-2 text-md text-gray-700 border-2 border-black">{{ machine.machinedate }}</td>
            <td class="px-4 py-2 text-md text-gray-700 border-2 border-black">{{ machine.partyorder }}</td>
            <td class="px-4 py-2 text-md text-gray-700 border-2 border-black">{{ machine.lot }}</td>
            <td class="px-4 py-2 text-md text-gray-700 border-2 border-black">{{ machine.cutsheet }}</td>
            <td class="px-4 py-2 text-md text-gray-700 border-2 border-black">{{ machine.peice }}</td>
            <td class="px-4 py-2 text-md text-gray-700 border-2 border-black">{{ machine.ogauge }}</td>
            <td class="px-4 py-2 text-md text-gray-700 border-2 border-black">{{ machine.bundlewidht }}</td>
            <td class="px-4 py-2 text-md text-gray-700 border-2 border-black">{{ machine.olenght }}</td>
            <td class="px-4 py-2 text-md text-gray-700 border-2 border-black">{{ machine.jalilenght }}</td>
            <td class="px-4 py-2 text-md text-gray-700 border-2 border-black">{{ machine.sheetperbundle }}</td>
            <td class="px-4 py-2 text-md text-gray-700 border-2 border-black">{{ machine.machinenumber }}</td>
            <td class="px-4 py-2 text-md text-gray-700 border-2 border-black">{{ machine.machineqty }}</td>
            <td class="px-4 py-2 text-sm text-gray-700 border-2 border-black">
              <form @submit.prevent="deleteMachine(machine.id)">
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
              </form>
              <Link :href="route('machine.edit', machine.id)" class="bg-cyan-500 hover:bg-cyan-600 text-white px-4 py-2 rounded-md transition ml-2">Edit</Link>
              <div class="p-4">
                <a :href="route('machine.finishForm', machine.id)" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded ml-2">Finish</a>
              </div>
            </td>
          </tr>
          <tr v-if="machines.length === 0">
            <td colspan="15" class="px-4 py-4 text-center text-gray-500">No machine orders found.</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
   </AppLayout>
</template>

<script setup>
import { ref } from 'vue'
import { defineProps } from 'vue'
import { router } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue'

const props = defineProps({
  machines: { type: Array, required: true },
  success: { type: String, default: '' }
})

const filters = ref({
  machinedate: '',
  machinenumber: '',
  machineqty: '',
  olenght: '',
  peice: '',
  ogauge: '',
  cutsheet: '',
  lot: '',
  bundlewidht: '',
  sheetperbundle: '',
  partyorder: '',
  jalilenght: '',
  orderedpeices: ''
})

function deleteMachine(id) {
  if (confirm('Are you sure you want to delete this machine entry?')) {
    router.post(route('machine.delete', id), { _method: 'DELETE' })
  }
}

</script>

<style scoped>
@media print {
  .max-w-7xl {
    max-width: 100vw !important;
    box-shadow: none !important;
    border-radius: 0 !important;
    margin: 0 !important;
    padding: 0 !important;
  }
}
</style>
