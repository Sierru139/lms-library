<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";

const props = defineProps({
    student: Object,
});

const form = useForm({
    tanggal: props.student.tanggal,
    nama: props.student.nama,
    kelas: props.student.kelas,
    tujuan: props.student.tujuan,
});

const submit = () => {
    form.post(route('book.visitorStudent.update', props.student.id), {
        onError: (errors) => {
            console.error(errors);
        }
    });
};
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Edit Pengunjung Tamu" />

        <div class="p-4 w-full max-w-2xl bg-white rounded-lg border mx-auto my-10 border-gray-200 shadow-md sm:p-6 md:p-8">
            <form @submit.prevent="submit" class="space-y-4">
                <div>
                    <label for="tanggal" class="block">Tanggal</label>
                    <input type="date" id="tanggal" v-model="form.tanggal" class="w-full rounded border-gray-300" />
                    <span class="text-red-500 text-sm">{{ form.errors.tanggal }}</span>
                </div>

                <div>
                    <label for="nama" class="block">Nama</label>
                    <input type="text" id="nama" v-model="form.nama" class="w-full rounded border-gray-300" />
                    <span class="text-red-500 text-sm">{{ form.errors.nama }}</span>
                </div>

                <div>
                    <label for="kelas" class="block">Kelas</label>
                    <input type="text" id="kelas" v-model="form.kelas" class="w-full rounded border-gray-300" />
                    <span class="text-red-500 text-sm">{{ form.errors.kelas }}</span>
                </div>

                <div>
                    <label for="tujuan" class="block">Tujuan</label>
                    <textarea id="tujuan" v-model="form.tujuan" class="w-full rounded border-gray-300" rows="3"></textarea>
                    <span class="text-red-500 text-sm">{{ form.errors.tujuan }}</span>
                </div>

                <div class="flex justify-between">
                    <Link href="/book/visitorGuest" class="text-blue-500 hover:text-blue-700">Back</Link>
                    <button type="submit" class="py-1 px-3 bg-gray-300 hover:bg-gray-400 duration-100 rounded">Update</button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
