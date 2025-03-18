<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { reactive, ref, createApp } from 'vue';
import { QuillEditor } from '@vueup/vue-quill'

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

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-gradient-to-b from-gray-100 to-gray-200 shadow sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-3xl mb-3"><b>Add Team</b></h3>
                        <form @submit.prevent="submit" enctype="multipart/form-data" class="mt-2 p-4">
                        <input type="hidden" name="_token" :value="csrfToken">
                        <div class="mb-6 sm:grid grid-cols-6 gap-3 border-b-2 pb-4 items-center justify-center">
                            <div class="mb-4 col-span-3">
                                <label for="teacher_name">Nama Guru *</label>
                                <input class="w-full border-0 rounded-md ring-gray-300"
                                        v-model="form.teacher_name"
                                        name="teacher_name" id="teacher_name"
                                        type="text"
                                        placeholder="Name...">
                                <span class="text-red-500 text-xs">{{ form.errors.teacher_name }}</span>
                            </div>
                        </div>
                        <div class="mb-6 sm:grid grid-cols-6 gap-3 border-b-2 pb-4 items-center justify-center">
                            <div class="mb-4 col-span-3">
                                <label for="apply_date">Tanggal Pinjam *</label>
                                <input class="w-full border-0 rounded-md ring-gray-300"
                                        v-model="form.apply_date"
                                        name="apply_date" id="apply_date"
                                        type="date">
                                <span class="text-red-500 text-xs">{{ form.errors.apply_date }}</span>
                            </div>
                        </div>
                        <div class="col-span-2">
                                <label for="project_number">Project Number*</label>
                                <div class="">
                                    <div class="relative rounded-md flex items-center">
                                        <select name="book_id"
                                                id="book_id"
                                                v-model="form.book_id"
                                                class="min-w-[100px] border-0 ring-gray-300">
                                            <option v-for="(item, index) in $page.props.book" :key="index" :value="item.id">{{ item.name }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                        <Link href="/team" class="text-blue-500 hover:text-blue-700">Back</Link>
                        <button type="submit" class="py-1 px-3 bg-gray-300 hover:bg-gray-400 duration-100 rounded">Save</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</template>
