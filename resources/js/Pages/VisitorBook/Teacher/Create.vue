<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { reactive, ref, createApp } from 'vue';
import { QuillEditor } from '@vueup/vue-quill'
// const app = createApp()
// app.component('QuillEditor', QuillEditor)

const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
const form = useForm({
    nama: '',
    tanggal: '',
    tujuan: '',
    ket: '',
});

console.log(form.project_code_id)

const submit = () => {
    form.post(route('book.visitorTeacher.store'), {
        onError: (errors) => {
            // Handle the errors if needed
            console.error(errors);
        }
    });
}

const bannerFile = (event) => {
    if (event.target.files.length > 0) {
        form.banner = event.target.files[0];
        // console.log(event.target.files[0]);
    }
};

const addLeadingZeros = (value, length = 4) => {
    return value.length < length ? value.toString().padStart(length, '0') : value;
};

const handleProjectNumberInput = (event) => {
    let value = event.target.value.replace(/\D/g, ''); // Remove non-numeric characters
    if (value.length === 1) {
        value = value.padStart(1, '0'); // Add a single leading zero for single digits
    }
    form.project_number = value; // Update form value
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
                    <h3 class="text-3xl mb-3"><b>Tambahkan Pengunjung Guru</b></h3>
								<!-- <pre>{{ form.project_code_id }} - {{ form.project_number_b}}</pre> -->
                        <form @submit.prevent="submit" enctype="multipart/form-data" class="mt-2 p-4">

                        <input type="hidden" name="_token" :value="csrfToken">

                        <div class="mb-6 sm:grid grid-cols-6 gap-3">
                            <div class="mb-4 col-span-3">
                                <label for="tanggal">tanggal*</label>
                                <input class="w-full border rounded-md ring-gray-300"
                                        v-model="form.tanggal"
                                        name="tanggal" id="tanggal"
                                        type="text"
                                        placeholder="tanggal...">
                                <span class="text-red-500 text-xs">{{ form.errors.title }}</span>
                            </div>
                            <div class="mb-4 col-span-3">
                                <label for="nama">Nama*</label>
                                <input class="w-full border rounded-md ring-gray-300"
                                        v-model="form.nama"
                                        name="nama" id="nama"
                                        type="text"
                                        placeholder="nama...">
                            </div>
                        </div>
                        <div class="mb-6 sm:grid grid-cols-6 gap-3 border-b-2 pb-4">
                            <div class="mb-4 col-span-3">
                                <label for="alamat">Alamat*</label>
                                <input class="w-full border rounded-md ring-gray-300"
                                        v-model="form.alamat"
                                        name="alamat" id="alamat"
                                        type="text"
                                        placeholder="alamat...">
                            </div>
                            <div class="mb-4 col-span-3">
                                <label for="pekerjaan">Pekerjaan*</label>
                                <input class="w-full border rounded-md ring-gray-300"
                                        v-model="form.pekerjaan"
                                        name="pekerjaan" id="pekerjaan"
                                        type="text"
                                        placeholder="pekerjaan...">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="tujuan">Tujuan</label>
                            <!-- <QuillEditor theme="snow"
                                            :toolbar="[['bold', 'italic'], [{ 'header': 1 }], [{ 'list': 'ordered'}, { 'list': 'bullet' }]]"
                                            v-model:content="form.tujuan"
                                            style="height: 220px;"
                                            contentType="html" name="tujuan" id="tujuan" /> -->
                            <textarea class="block w-full h-40" name="tujuan" id="tujuan"></textarea>
                            <span class="text-red-500 text-xs">{{ form.errors.tujuan }}</span>
                        </div>

                        <div class="mb-4">
                            <label for="ket">Keterangan</label>
                            <!-- <QuillEditor theme="snow"
                                            :toolbar="[['bold', 'italic'], [{ 'header': 1 }], [{ 'list': 'ordered'}, { 'list': 'bullet' }]]"
                                            v-model:content="form.ket"
                                            style="height: 220px;"
                                            contentType="html" name="ket" id="ket" /> -->
                            <textarea class="block w-full h-40" name="ket" id="ket"></textarea>
                            <span class="text-red-500 text-xs">{{ form.errors.ket }}</span>
                        </div>
                        <Link href="/mentor" class="text-blue-500 hover:text-blue-700">Back</Link>
                        <button type="submit" class="py-1 px-3 bg-gray-300 hover:bg-gray-400 duration-100 rounded">Save</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</authenticated-layout>

</template>
