<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';

const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

const form = useForm({
    tanggal: '',
    nama: '',
    kelas: '',
    tujuan: '',
});

const submit = () => {
    form.post(route('book.visitorStudent.store'), {
        onError: (errors) => {
            console.error(errors);
        }
    });
};
</script>

<style>
input:disabled:hover,
input:disabled:active,
input:disabled:focus,
textarea:disabled:hover,
textarea:disabled:active,
textarea:disabled:focus,
textarea:disabled,
input:disabled {
  background-color: rgb(245, 245, 245);
  border: 1px solid rgba(128, 128, 128, 0.3);
  cursor: not-allowed;
}
input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
	-webkit-appearance: none;
	margin: 0;
}
.ql-editor {
    background-color: white;
}
</style>

<template>
<Head title="Visitor Teacher" />
<authenticated-layout>
  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="p-4 w-full bg-white rounded-lg border mx-auto my-10 border-gray-200 shadow-md sm:p-6 md:p-8">
        <div class="p-6 text-gray-900">
          <h3 class="text-3xl mb-3 font-bold">Tambahkan Pengunjung Murid</h3>

          <form @submit.prevent="submit" enctype="multipart/form-data" class="mt-2 p-4">
            <input type="hidden" name="_token" :value="csrfToken" />

            <div class="mb-6 sm:grid grid-cols-6 gap-3">
              <div class="mb-4 col-span-3">
                <label for="tanggal">Tanggal *</label>
                <input class="w-full border rounded-md ring-gray-300"
                  v-model="form.tanggal"
                  name="tanggal" id="tanggal"
                  type="date"
                  placeholder="Tanggal...">
                <span class="text-red-500 text-xs">{{ form.errors.tanggal }}</span>
              </div>

              <div class="mb-4 col-span-3">
                <label for="nama">Nama *</label>
                <input class="w-full border rounded-md ring-gray-300"
                  v-model="form.nama"
                  name="nama" id="nama"
                  type="text"
                  placeholder="Nama...">
                <span class="text-red-500 text-xs">{{ form.errors.nama }}</span>
              </div>
            </div>

            <div class="mb-4">
              <label for="kelas">Kelas *</label>
              <input class="w-full border rounded-md ring-gray-300"
                v-model="form.kelas"
                name="kelas" id="kelas"
                type="text"
                placeholder="Kelas...">
              <span class="text-red-500 text-xs">{{ form.errors.kelas }}</span>
            </div>

            <div class="mb-4">
              <label for="tujuan">Tujuan *</label>
              <textarea class="block w-full h-40 border rounded-md ring-gray-300"
                v-model="form.tujuan"
                name="tujuan" id="tujuan"
                placeholder="Tujuan..."></textarea>
              <span class="text-red-500 text-xs">{{ form.errors.tujuan }}</span>
            </div>

            <div class="flex justify-between items-center mt-4">
              <Link href="/mentor" class="text-blue-500 hover:text-blue-700">Back</Link>
              <button type="submit" class="py-1 px-4 bg-gray-300 hover:bg-gray-400 duration-100 rounded">Save</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</authenticated-layout>
</template>
