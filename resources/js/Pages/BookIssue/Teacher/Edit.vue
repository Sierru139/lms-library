<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";

const props = defineProps({
    issueBook: Object,
});

const form = useForm({
    teacher_name: props.issueBook.teacher_name,
    apply_date: props.issueBook.apply_date,
    returned_date: props.issueBook.returned_date,
    book_id: props.issueBook.book_id,
    status: props.issueBook.status,
});

const submit = () => {
    form.post(route('book.issueTeacher.update', props.issueBook.id), {
        onError: (errors) => {
            console.error(errors);
        }
    });
}

</script>

<template>
    <AuthenticatedLayout>
        <Head title="Category Edit" />
        <div
            class="p-4 w-full max-w-sm bg-white rounded-lg border mx-auto my-10 border-gray-200 shadow-md sm:p-6 md:p-8"
        >
        <form @submit.prevent="submit" enctype="multipart/form-data" class="mt-2 p-4">
            <input type="hidden" name="_token" :value="csrfToken">
            <div class="mb-2 items-center justify-center">
                <div class="mb-4 col-span-3">
                    <label for="teacher_name">Nama Guru </label>
                    <input class="w-full rounded-md border-gray-200"
                            v-model="form.teacher_name"
                            name="teacher_name" id="teacher_name"
                            type="text"
                            placeholder="Name...">
                    <span class="text-red-500 text-xs">{{ form.errors.teacher_name }}</span>
                </div>
            </div>
            <div class="mb-2 items-center justify-center">
                <div class="mb-4 col-span-3">
                    <label for="apply_date">Tanggal Pinjam </label>
                    <input class="w-full rounded-md border-gray-200"
                            v-model="form.apply_date"
                            name="apply_date" id="apply_date"
                            type="date">
                    <span class="text-red-500 text-xs">{{ form.errors.apply_date }}</span>
                </div>
            </div>
            <div class="mb-2 items-center justify-center">
                <div class="mb-4 col-span-3">
                    <label for="returned_date">Tanggal Kembali </label>
                    <input class="w-full rounded-md border-gray-200"
                            v-model="form.returned_date"
                            name="returned_date" id="returned_date"
                            type="date">
                    <span class="text-red-500 text-xs">{{ form.errors.returned_date }}</span>
                </div>
            </div>
            <div class="col-span-2">
                <label for="book_id">ID Buku</label>
                <div>
                    <div class="relative rounded-md flex items-center">
                        <v-select
                        id="book_id"
                        v-model="form.book_id"
                        :options="$page.props.books"
                        label="name"
                        :reduce="(book) => book.id"
                        placeholder="Pilih Buku"
                        class="border border-gray-200 rounded-md w-full"
                        />
                    </div>
                </div>
            </div>
            <div class="col-span-2">
                <label for="status">Status</label>
                <div class="">
                    <div class="relative rounded-md flex items-center">
                        <select name="status"
                                id="status"
                                v-model="form.status"
                                class="min-wborder-0 border-gray-200">
                            <option value="pending">Sedang Dipinjam - Belum Disetujui</option>
                            <option value="accepted">Sedang Dipinjam - Telah Disetujui</option>
                            <option value="returned">Telah Dikembalikan</option>
                            <option value="cancel">Dibatalkan</option>
                        </select>
                    </div>
                </div>
            </div>

            <br>
            <button type="submit" class="py-1 px-3 bg-gray-300 hover:bg-gray-400 duration-100 rounded">Save</button>
        </form>
        </div>
    </AuthenticatedLayout>
</template>
