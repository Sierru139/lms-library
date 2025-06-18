<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";

const props = defineProps({
    issueBook: Object,
});

const form = useForm({
    student_name: props.issueBook.student_name || '',
    apply_date: props.issueBook.apply_date || '',
    issue_date: props.issueBook.issue_date || '',
    returned_date: props.issueBook.returned_date || '',
    no_kartu_perp: props.issueBook.no_kartu_perp || '',
    kelas: props.issueBook.kelas || '',
    jurusan: props.issueBook.jurusan || '',
    status: props.issueBook.status || 'pending',
    keterangan: props.issueBook.keterangan || '',
    book_id: props.issueBook.book_id || null,
});

const submit = () => {
    form.post(route('book.issueStudent.update', props.issueBook.id), {
        onError: (errors) => {
            console.error(errors);
        },
    });
};
</script>


<template>
  <AuthenticatedLayout>
    <Head title="Edit Peminjaman Siswa" />

    <div class="p-4 max-w-md bg-white rounded-lg border mx-auto my-10 border-gray-200 shadow-md">
      <form @submit.prevent="submit" class="space-y-4">
        <div>
          <label for="student_name">Nama Siswa</label>
          <input
            type="text"
            id="student_name"
            name="student_name"
            v-model="form.student_name"
            class="w-full border rounded-md px-3 py-2"
            placeholder="Nama siswa..."
          />
          <span class="text-red-500 text-xs">{{ form.errors.student_name }}</span>
        </div>

        <div>
          <label for="apply_date">Tanggal Pengajuan</label>
          <input
            type="date"
            id="apply_date"
            name="apply_date"
            v-model="form.apply_date"
            class="w-full border rounded-md px-3 py-2"
          />
          <span class="text-red-500 text-xs">{{ form.errors.apply_date }}</span>
        </div>

        <div>
          <label for="issue_date">Tanggal Pinjam</label>
          <input
            type="date"
            id="issue_date"
            name="issue_date"
            v-model="form.issue_date"
            class="w-full border rounded-md px-3 py-2"
          />
          <span class="text-red-500 text-xs">{{ form.errors.issue_date }}</span>
        </div>

        <div>
          <label for="returned_date">Tanggal Kembali</label>
          <input
            type="date"
            id="returned_date"
            name="returned_date"
            v-model="form.returned_date"
            class="w-full border rounded-md px-3 py-2"
          />
          <span class="text-red-500 text-xs">{{ form.errors.returned_date }}</span>
        </div>

        <div>
          <label for="no_kartu_perp">No Kartu Perpustakaan</label>
          <input
            type="text"
            id="no_kartu_perp"
            name="no_kartu_perp"
            v-model="form.no_kartu_perp"
            class="w-full border rounded-md px-3 py-2"
            placeholder="Nomor kartu perpustakaan"
          />
          <span class="text-red-500 text-xs">{{ form.errors.no_kartu_perp }}</span>
        </div>

        <div>
          <label for="kelas">Kelas</label>
          <input
            type="text"
            id="kelas"
            name="kelas"
            v-model="form.kelas"
            class="w-full border rounded-md px-3 py-2"
            placeholder="Kelas siswa"
          />
          <span class="text-red-500 text-xs">{{ form.errors.kelas }}</span>
        </div>

        <div>
          <label for="jurusan">Jurusan</label>
          <input
            type="text"
            id="jurusan"
            name="jurusan"
            v-model="form.jurusan"
            class="w-full border rounded-md px-3 py-2"
            placeholder="Jurusan siswa"
          />
          <span class="text-red-500 text-xs">{{ form.errors.jurusan }}</span>
        </div>

        <div>
          <label for="book_id">Buku</label>
          <v-select
            id="book_id"
            v-model="form.book_id"
            :options="$page.props.books"
            label="name"
            :reduce="book => book.id"
            placeholder="Pilih Buku"
            class="border border-gray-300 rounded-md w-full"
          />
          <span class="text-red-500 text-xs">{{ form.errors.book_id }}</span>
        </div>

        <div>
          <label for="status">Status</label>
          <select
            id="status"
            name="status"
            v-model="form.status"
            class="w-full border rounded-md px-3 py-2"
          >
            <option value="pending">Sedang Dipinjam - Belum Disetujui</option>
            <option value="accepted">Sedang Dipinjam - Telah Disetujui</option>
            <option value="returned">Telah Dikembalikan</option>
            <option value="cancel">Dibatalkan</option>
          </select>
          <span class="text-red-500 text-xs">{{ form.errors.status }}</span>
        </div>

        <div>
          <label for="keterangan">Keterangan</label>
          <textarea
            id="keterangan"
            name="keterangan"
            v-model="form.keterangan"
            class="w-full border rounded-md px-3 py-2"
            rows="3"
            placeholder="Keterangan tambahan"
          ></textarea>
          <span class="text-red-500 text-xs">{{ form.errors.keterangan }}</span>
        </div>

        <button
          type="submit"
          class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition"
        >
          Simpan
        </button>
      </form>
    </div>
  </AuthenticatedLayout>
</template>

