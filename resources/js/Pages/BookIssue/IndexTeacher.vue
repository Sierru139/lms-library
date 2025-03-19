<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import SuccessAlert from "@/Components/SuccessAlert.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { ref } from "vue";

import { Inertia } from "@inertiajs/inertia";
import { watch } from "vue";

const showModal = ref(false);
const id = "";
const props = defineProps({
    issueBooks: {
        type: Object,
        default: () => ({}),
    },
});

let search = ref("");
watch(search, (value) => {
    Inertia.post(
        "/admin/issue/book/teacher",
        { search: value },
        {
            preserveState: true,
        }
    );
});
</script>

<template>
    <Head title="Books" />
    <authenticated-layout>
        <div class="bg-white p-8 rounded-md w-full">
            <div class="flex items-center justify-between pb-6">
                <div>
                    <h2 class="text-gray-600 font-semibold">Pinjaman Buku Guru</h2>
                    <span class="text-xs">All Issue Books</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex bg-gray-50 items-center p-2 rounded-md">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-gray-400"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        <input
                            class="bg-gray-50 outline-none ml-1 block"
                            type="text"
                            name=""
                            id=""
                            placeholder="search..."
                            v-model="search"
                        />
                    </div>
                    <div class="lg:ml-40 ml-10 space-x-8">
                        <Link
                            :href="route('book.issueTeacher.create')"
                            class="bg-indigo-600 hover:bg-indigo-800 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer"
                        >
                            Create
                        </Link>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-center">
                <SuccessAlert />
            </div>
            <div>
                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <div
                        class="inline-block min-w-full shadow rounded-lg overflow-hidden"
                    >
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                    >
                                        NO
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                    >
                                        Nama Guru
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                    >
                                        ID Pinjaman
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                    >
                                        Tanggal Pinjam
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                    >
                                        Judul Buku
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                    >
                                        Tanggal Kembali
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                    >
                                        status
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                    >
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(issue,index) in issueBooks.data"
                                    :key="issue.id"
                                >
                                    <td
                                        class="px-5 py-5 border-b border-gray-200 bg-white text-sm"
                                    >
                                        <p
                                            class="text-gray-900 whitespace-no-wrap"
                                        >
                                            {{ index + 1}}
                                        </p>
                                    </td>
                                    <td
                                        class="px-5 py-5 border-b border-gray-200 bg-white text-sm"
                                    >
                                        <p
                                            class="text-gray-900 whitespace-no-wrap"
                                        >
                                            {{ issue.teacher_name }}
                                        </p>
                                    </td>
                                    <td
                                        class="px-5 py-5 border-b border-gray-200 bg-white text-sm"
                                    >
                                        <p
                                            class="text-gray-900 whitespace-no-wrap"
                                        >
                                            {{ issue.id }}
                                        </p>
                                    </td>
                                    <td
                                        class="px-5 py-5 border-b border-gray-200 bg-white text-sm"
                                    >
                                        <p
                                            class="text-gray-900 whitespace-no-wrap"
                                        >
                                            {{ issue.apply_date }}
                                        </p>
                                    </td>
                                    <td
                                        class="px-5 py-5 border-b border-gray-200 bg-white text-sm"
                                    >
                                        <p
                                            class="text-gray-900 whitespace-no-wrap"
                                        >
                                            {{ issue.book.name }}
                                        </p>
                                    </td>
                                    <td
                                        class="px-5 py-5 border-b border-gray-200 bg-white text-sm"
                                    >
                                        <p
                                            v-if="issue.returned_date"
                                            class="text-gray-900 whitespace-no-wrap"
                                        >
                                            {{ issue.returned_date }}
                                        </p>
                                        <p
                                            v-else
                                            class="text-gray-900 whitespace-no-wrap"
                                        >
                                            Belum dikembalikan
                                        </p>
                                    </td>
                                    <td
                                        class="px-5 py-5 border-b border-gray-200 bg-white text-sm"
                                    >
                                        <span
                                        v-if="issue.status == 'pending'"
                                            class="bg-indigo-100 text-indigo-800 text-sm font-medium mr-2 px-5 py-1 rounded">
                                                Sedang Dipinjam - Belum Disetujui
                                        </span>
                                        <span
                                        v-if="issue.status == 'accepted'"
                                            class="bg-sky-100 text-sky-800 text-sm font-medium mr-2 px-5 py-1 rounded">
                                                Sedang Dipinjam - Telah Setujui
                                        </span>
                                        <span
                                        v-if="issue.status == 'returned'"
                                            class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-5 py-1 rounded">
                                                Telah Dikembalikan
                                        </span>
                                        <span
                                        v-if="issue.status == 'cancel'"
                                            class="bg-red-100 text-red-800 text-sm font-medium mr-2 px-5 py-1 rounded">
                                                Dibatalkan
                                        </span>
                                    </td>
                                    <td
                                        class="px-5 py-5 border-b border-gray-200 bg-white text-sm"
                                    >
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            <Link
                                                :href="route('book.issueTeacher.edit', issue.id)"
                                                type="button"
                                                class="bg-indigo-600 hover:bg-indigo-800 px-1 py-1 rounded-md text-white font-semibold tracking-wide cursor-pointer"
                                            >
                                                <svg
                                                    class="w-6 h-6"
                                                    fill="currentColor"
                                                    viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <path
                                                        d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"
                                                    ></path>
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                        clip-rule="evenodd"
                                                    ></path>
                                                </svg>
                                            </Link>
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <Pagination
                            class="mt-6"
                            :links="issueBooks.links"
                            :meta="issueBooks.meta"
                        />
                    </div>
                </div>
            </div>
        </div>
    </authenticated-layout>
</template>
