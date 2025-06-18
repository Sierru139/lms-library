<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import { QuillEditor } from '@vueup/vue-quill';

const page = usePage();
const old = page.props?.old || {};
const errors = page.props?.errors || {};

const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

const kesan = ref(old.kesan || '');
const pesan = ref(old.pesan || '');
</script>

<template>
    <Head title="Project - Create" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-gradient-to-b from-gray-100 to-gray-200 shadow sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-3xl mb-3"><b>Tambahkan Pengunjung Tamu</b></h3>

                        <form method="POST" :action="route('book.visitorGuest.store')" enctype="multipart/form-data" class="mt-2 p-4">
                            <input type="hidden" name="_token" :value="csrfToken" />

                            <div class="mb-6 sm:grid grid-cols-6 gap-3 border-b-2 pb-4">
                                <div class="mb-4 col-span-3">
                                    <label for="tanggal" class="block">Tanggal*</label>
                                    <input type="date" id="tanggal" name="tanggal" :value="old.tanggal" class="w-full rounded-md border-gray-300" />
                                    <div class="text-red-500 text-xs">{{$page.props.errors.tanggal}}{{ errors.tanggal }}</div>
                                </div>
                                <div class="mb-4 col-span-3">
                                    <label for="nama" class="block">Nama*</label>
                                    <input type="text" id="nama" name="nama" placeholder="nama..." :value="old.nama" class="w-full rounded-md border-gray-300" />
                                    <div class="text-red-500 text-xs">{{$page.props.errors.nama}}{{ errors.nama }}</div>
                                </div>
                            </div>

                            <div class="mb-6 sm:grid grid-cols-6 gap-3 border-b-2 pb-4">
                                <div class="mb-4 col-span-3">
                                    <label for="alamat">Alamat*</label>
                                    <input type="text" id="alamat" name="alamat" placeholder="alamat..." :value="old.alamat" class="w-full rounded-md border-gray-300" />
                                    <div class="text-red-500 text-xs">{{$page.props.errors.alamat}}{{ errors.alamat }}</div>
                                </div>
                                <div class="mb-4 col-span-3">
                                    <label for="pekerjaan">Pekerjaan*</label>
                                    <input type="text" id="pekerjaan" name="pekerjaan" placeholder="pekerjaan..." :value="old.pekerjaan" class="w-full rounded-md border-gray-300" />
                                    <div class="text-red-500 text-xs">{{$page.props.errors.pekerjaan}}{{ errors.pekerjaan }}</div>
                                </div>
                                <div class="mb-4 col-span-3">
                                    <label for="maksud_kunjungan">Maksud Kunjungan*</label>
                                    <input type="text" id="maksud_kunjungan" name="maksud_kunjungan" placeholder="maksud_kunjungan..." :value="old.maksud_kunjungan" class="w-full rounded-md border-gray-300" />
                                    <div class="text-red-500 text-xs">{{$page.props.errors.maksud_kunjungan}}{{ errors.maksud_kunjungan }}</div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="kesan">Kesan</label>
                                <!-- <QuillEditor
                                    theme="snow"
                                    :toolbar="[['bold', 'italic'], [{ header: 1 }], [{ list: 'ordered' }, { list: 'bullet' }]]"
                                    v-model:content="kesan"
                                    contentType="html"
                                    style="height: 220px;"
                                /> -->
                                <textarea class="block w-full h-40" name="kesan" id="kesan"></textarea>
                                <!-- <input type="hidden" name="kesan" :value="kesan" /> -->
                                <div class="text-red-500 text-xs">{{$page.props.errors.kesan}}{{ errors.kesan }}</div>
                            </div>

                            <div class="mb-4">
                                <label for="pesan">Pesan</label>
                                <!-- <QuillEditor
                                    theme="snow"
                                    :toolbar="[['bold', 'italic'], [{ header: 1 }], [{ list: 'ordered' }, { list: 'bullet' }]]"
                                    v-model:content="pesan"
                                    contentType="html"
                                    style="height: 220px;"
                                /> -->
                                <textarea class="block w-full h-40" name="pesan" id="pesan"></textarea>
                                <!-- <input type="hidden" name="pesan" :value="pesan" /> -->
                                <div class="text-red-500 text-xs">{{$page.props.errors.pesan}}{{ errors.pesan }}</div>
                            </div>

                            <div class="flex justify-between mt-6">
                                <Link href="/mentor" class="text-blue-500 hover:text-blue-700">Back</Link>
                                <button type="submit" class="py-1 px-3 bg-gray-300 hover:bg-gray-400 duration-100 rounded">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style>
input:disabled,
textarea:disabled {
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
