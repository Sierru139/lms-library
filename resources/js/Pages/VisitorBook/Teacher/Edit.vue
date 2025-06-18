<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";

const props = defineProps({
    teacher: Object,
});

const form = useForm({
    tanggal: props.teacher.tanggal,
    nama: props.teacher.nama,
    // alamat: props.teacher.alamat,
    // pekerjaan: props.teacher.pekerjaan,
    // maksud_kunjungan: props.teacher.maksud_kunjungan,
    tujuan: props.teacher.tujuan,
    ket: props.teacher.ket,
});

const submit = () => {
    form.post(route('book.visitorTeacher.update', props.teacher.id), {
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

                <!-- <div>
                    <label for="alamat" class="block">Alamat</label>
                    <input type="text" id="alamat" v-model="form.alamat" class="w-full rounded border-gray-300" />
                    <span class="text-red-500 text-sm">{{ form.errors.alamat }}</span>
                </div>

                <div>
                    <label for="pekerjaan" class="block">Pekerjaan</label>
                    <input type="text" id="pekerjaan" v-model="form.pekerjaan" class="w-full rounded border-gray-300" />
                    <span class="text-red-500 text-sm">{{ form.errors.pekerjaan }}</span>
                </div>

                <div>
                    <label for="maksud_kunjungan" class="block">Maksud Kunjungan</label>
                    <input type="text" id="maksud_kunjungan" v-model="form.maksud_kunjungan" class="w-full rounded border-gray-300" />
                    <span class="text-red-500 text-sm">{{ form.errors.maksud_kunjungan }}</span>
                </div> -->

                <div>
                    <label for="tujuan" class="block">tujuan</label>
                    <textarea id="tujuan" v-model="form.tujuan" class="w-full rounded border-gray-300" rows="3"></textarea>
                    <span class="text-red-500 text-sm">{{ form.errors.tujuan }}</span>
                </div>

                <div>
                    <label for="ket" class="block">ket</label>
                    <textarea id="ket" v-model="form.ket" class="w-full rounded border-gray-300" rows="3"></textarea>
                    <span class="text-red-500 text-sm">{{ form.errors.ket }}</span>
                </div>

                <div class="flex justify-between">
                    <Link href="/book/visitorTeacher" class="text-blue-500 hover:text-blue-700">Back</Link>
                    <button type="submit" class="py-1 px-3 bg-gray-300 hover:bg-gray-400 duration-100 rounded">Update</button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
