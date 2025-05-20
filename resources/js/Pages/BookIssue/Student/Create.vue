<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
</script>

<template>
    <Head title="Project - Create" />
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-gradient-to-b from-gray-100 to-gray-200 shadow sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-3xl mb-3"><b>Add Team</b></h3>

                        <!-- Flash Message -->
                        <div v-if="$page.props.flash.message" class="mb-4 text-green-600">
                            {{ $page.props.flash.message }}
                        </div>
                        <div v-if="$page.props.flash.error" class="mb-4 text-red-600">
                            {{ $page.props.flash.error }}
                        </div>

                        <!-- Form -->
                        <form method="POST" :action="route('book.issueStudent.store')">
                            <input type="hidden" name="_token" :value="csrfToken" />

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
                                <div>
                                    <label for="student_name">Nama Siswa *</label>
                                    <input type="text" name="student_name" id="student_name" class="w-full border rounded-md ring-1 ring-gray-300 px-3 py-2" :value="$page.props.old?.student_name" />
                                    <div v-if="$page.props.errors?.student_name" class="text-red-500 text-sm">
                                        {{ $page.props.errors.student_name }}
                                    </div>
                                </div>

                                <div>
                                    <label for="no_kartu_perp">No. Kartu Perpustakaan</label>
                                    <input type="text" name="no_kartu_perp" id="no_kartu_perp" class="w-full border rounded-md ring-1 ring-gray-300 px-3 py-2" :value="$page.props.old?.no_kartu_perp" />
                                    <div v-if="$page.props.errors?.no_kartu_perp" class="text-red-500 text-sm">
                                        {{ $page.props.errors.no_kartu_perp }}
                                    </div>
                                </div>

                                <div>
                                    <label for="kelas">Kelas</label>
                                    <input type="text" name="kelas" id="kelas" class="w-full border rounded-md ring-1 ring-gray-300 px-3 py-2" :value="$page.props.old?.kelas" />
                                    <div v-if="$page.props.errors?.kelas" class="text-red-500 text-sm">
                                        {{ $page.props.errors.kelas }}
                                    </div>
                                </div>

                                <div>
                                    <label for="jurusan">Jurusan</label>
                                    <input type="text" name="jurusan" id="jurusan" class="w-full border rounded-md ring-1 ring-gray-300 px-3 py-2" :value="$page.props.old?.jurusan" />
                                    <div v-if="$page.props.errors?.jurusan" class="text-red-500 text-sm">
                                        {{ $page.props.errors.jurusan }}
                                    </div>
                                </div>

                                <div>
                                    <label for="apply_date">Tanggal Pinjam *</label>
                                    <input type="date" name="apply_date" id="apply_date" class="w-full border rounded-md ring-1 ring-gray-300 px-3 py-2" :value="$page.props.old?.apply_date" />
                                    <div v-if="$page.props.errors?.apply_date" class="text-red-500 text-sm">
                                        {{ $page.props.errors.apply_date }}
                                    </div>
                                </div>

                                <div>
                                    <label for="issue_date">Tanggal Terbit</label>
                                    <input type="date" name="issue_date" id="issue_date" class="w-full border rounded-md ring-1 ring-gray-300 px-3 py-2" :value="$page.props.old?.issue_date" />
                                    <div v-if="$page.props.errors?.issue_date" class="text-red-500 text-sm">
                                        {{ $page.props.errors.issue_date }}
                                    </div>
                                </div>

                                <div>
                                    <label for="returned_date">Tanggal Kembali</label>
                                    <input type="date" name="returned_date" id="returned_date" class="w-full border rounded-md ring-1 ring-gray-300 px-3 py-2" :value="$page.props.old?.returned_date" />
                                    <div v-if="$page.props.errors?.returned_date" class="text-red-500 text-sm">
                                        {{ $page.props.errors.returned_date }}
                                    </div>
                                </div>

                                <!-- <div>
                                    <label for="id_pinjaman">ID Pinjaman</label>
                                    <input type="text" name="id_pinjaman" id="id_pinjaman" class="w-full border rounded-md ring-1 ring-gray-300 px-3 py-2" :value="$page.props.old?.id_pinjaman" />
                                    <div v-if="$page.props.errors?.id_pinjaman" class="text-red-500 text-sm">
                                        {{ $page.props.errors.id_pinjaman }}
                                    </div>
                                </div> -->

                                <div>
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="w-full border rounded-md ring-1 ring-gray-300 px-3 py-2">
                                        <option value="dipinjam" :selected="$page.props.old?.status === 'dipinjam'">Dipinjam</option>
                                        <option value="dikembalikan" :selected="$page.props.old?.status === 'dikembalikan'">Dikembalikan</option>
                                        <option value="hilang" :selected="$page.props.old?.status === 'hilang'">Hilang</option>
                                    </select>
                                    <div v-if="$page.props.errors?.status" class="text-red-500 text-sm">
                                        {{ $page.props.errors.status }}
                                    </div>
                                </div>

                                <div>
                                    <label for="book_id">Buku*</label>
                                    <select name="book_id" id="book_id" class="w-full border rounded-md ring-1 ring-gray-300 px-3 py-2">
                                        <option value="">-- Pilih Buku --</option>
                                        <option v-for="(book, index) in $page.props.book" :key="index" :value="book.id" :selected="$page.props.old?.book_id == book.id">
                                            {{ book.name }}
                                        </option>
                                    </select>
                                    <div v-if="$page.props.errors?.book_id" class="text-red-500 text-sm">
                                        {{ $page.props.errors.book_id }}
                                    </div>
                                </div>
                            </div>

                            <!-- Keterangan -->
                            <div class="mt-4">
                                <label for="keterangan">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" rows="3" class="w-full border rounded-md ring-1 ring-gray-300 px-3 py-2">{{ $page.props.old?.keterangan }}</textarea>
                                <div v-if="$page.props.errors?.keterangan" class="text-red-500 text-sm">
                                    {{ $page.props.errors.keterangan }}
                                </div>
                            </div>

                            <!-- Tombol -->
                            <div class="mt-6 flex justify-between">
                                <Link href="/team" class="text-blue-500 hover:text-blue-700">Back</Link>
                                <button type="submit" class="py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
