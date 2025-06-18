<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { reactive, ref, createApp } from 'vue';
import { QuillEditor } from '@vueup/vue-quill'
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";

// const app = createApp()
// app.component('QuillEditor', QuillEditor)

const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
const form = useForm({
    teacher_name: '',
    apply_date: '',
    book_id: '',
});

const submit = () => {
    form.post(route('book.issueTeacher.store'), {
        onError: (errors) => {
            console.error(errors);
        }
    });
}

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
    <Head title="Project - Create" />
    <authenticated-layout>
        <div class="p-4 w-full max-w-sm bg-white rounded-lg border mx-auto my-10 border-gray-200 shadow-md sm:p-6 md:p-8">
            <div class=" text-gray-900">
                <h3 class="text-3xl mb-3"><b>Tambahkan Pinjaman</b></h3>
                <form @submit.prevent="submit" enctype="multipart/form-data" class="mt-2 p-4">
                    <input type="hidden" name="_token" :value="csrfToken">
                    <div class="items-center justify-center">
                        <div class="mb-4 col-span-3">
                            <label for="teacher_name">Nama Guru *</label>
                            <input class="w-full rounded-md border-gray-200"
                                    v-model="form.teacher_name"
                                    name="teacher_name" id="teacher_name"
                                    type="text"
                                    placeholder="Name...">
                            <span class="text-red-500 text-xs">{{ form.errors.teacher_name }}</span>
                        </div>
                    </div>
                    <div class="items-center justify-center">
                        <div class="mb-4 col-span-3">
                            <label for="apply_date">Tanggal Pinjam *</label>
                            <input class="w-full rounded-md border-gray-200"
                                    v-model="form.apply_date"
                                    name="apply_date" id="apply_date"
                                    type="date">
                            <span class="text-red-500 text-xs">{{ form.errors.apply_date }}</span>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <label for="book_id">ID Buku*</label>
                        <div class="">
                            <div class="relative rounded-md flex items-center">
                                <!--<select name="book_id"
                                        id="book_id"
                                        v-model="form.book_id"
                                        class="min-w-[100px] border-0 ring-gray-300">
                                    <option v-for="(item, index) in $page.props.book" :key="index" :value="item.id">{{ item.name }}</option>
                                </select>-->
                                <v-select
                                id="book_id"
                                v-model="form.book_id"
                                :options="$page.props.book"
                                label="name"
                                :reduce="(book) => book.id"
                                placeholder="Pilih Buku"
                                class="w-full rounded-md border-gray-200"
                                />
                            </div>
                        </div>
                    </div>

                    <br>
                    <button type="submit" class="py-1 px-3 bg-gray-300 hover:bg-gray-400 duration-100 rounded">Save</button>
                </form>

            </div>
        </div>
    </authenticated-layout>
</template>
