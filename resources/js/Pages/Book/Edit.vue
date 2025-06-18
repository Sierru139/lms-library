<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
    book: Object,
    categories: Object,
    authors: Object,
    locations: Object,
});

const form = useForm({
    tanggal_buat: props.book?.tanggal_buat || "",
    name: props.book?.name || "",
    no_induk: props.book?.no_induk || "",
    no_judul: props.book?.no_judul || "",
    judul_buku: props.book?.judul_buku || "",
    author: props.book?.author_id || "",
    penerbit: props.book?.penerbit || "",
    cet_ed: props.book?.cet_ed || "",
    jilid: props.book?.jilid || "",
    kota_terbit: props.book?.kota_terbit || "",
    tahun_terbit: props.book?.tahun_terbit || "",
    asal: props.book?.buy_from ? "Beli" : (props.book?.present_from ? "Hadiah" : ""),
    harga: props.book?.harga || "",
    jum: props.book?.jumlah || "",
    no_class: props.book?.no_class || "",
    ket: props.book?.keterangan || "",
    category: props.book?.category_id || "",
    location: props.book?.location_rack_id || "",
    no_of_copy: props.book?.no_of_copy || "",
    status: props.book?.status || "0",
});

const submit = () => {
    Inertia.post(`/admin/book/${props.book.id}`, {
        _method: "PUT",
        ...form,
        // Mapping "asal" ke kolom DB
        buy_from: form.asal === "Beli" ? "Beli" : null,
        present_from: form.asal === "Hadiah" ? "Hadiah" : null,
    });
};
</script>

<template>
    <AuthenticatedLayout>
      <Head title="Edit Buku" />
      <div class="p-4 w-full bg-white rounded-lg border mx-auto my-10 border-gray-200 shadow-md sm:p-6 md:p-8">
        <form class="space-y-6" @submit.prevent="submit">
          <h5 class="text-xl font-medium text-gray-900">Edit Buku</h5>
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label for="tanggal_buat" class="block text-sm font-medium text-gray-900">Tanggal Buat</label>
              <input type="date" id="tanggal_buat" v-model="form.tanggal_buat" class="input" />
            </div>
            <div>
              <label for="no_induk" class="block text-sm font-medium text-gray-900">Nomor Induk</label>
              <input type="text" id="no_induk" v-model="form.no_induk" class="input" />
            </div>
            <div>
              <label for="no_judul" class="block text-sm font-medium text-gray-900">Nomor Judul</label>
              <input type="text" id="no_judul" v-model="form.no_judul" class="input" />
            </div>
            <!-- Optional, only show if needed -->

            <div>
              <label for="name" class="block text-sm font-medium text-gray-900">Judul Buku</label>
              <input type="text" id="name" v-model="form.name" class="input" />
            </div>

            <div>
              <label for="author" class="block text-sm font-medium text-gray-900">Pilih Pengarang</label>
              <select id="author" v-model="form.author" class="input">
                <option selected>Pilih Pengarang</option>
                <option v-for="author in authors" :key="author.id" :value="author.id">
                  {{ author.name }}
                </option>
              </select>
            </div>
            <div>
              <label for="penerbit" class="block text-sm font-medium text-gray-900">Penerbit</label>
              <input type="text" id="penerbit" v-model="form.penerbit" class="input" />
            </div>
            <div>
              <label for="cet_ed" class="block text-sm font-medium text-gray-900">Cet/Ed</label>
              <input type="text" id="cet_ed" v-model="form.cet_ed" class="input" />
            </div>
            <div>
              <label for="jilid" class="block text-sm font-medium text-gray-900">Jilid</label>
              <input type="text" id="jilid" v-model="form.jilid" class="input" />
            </div>
            <div>
              <label for="kota_terbit" class="block text-sm font-medium text-gray-900">Kota Terbit</label>
              <input type="text" id="kota_terbit" v-model="form.kota_terbit" class="input" />
            </div>
            <div>
              <label for="tahun_terbit" class="block text-sm font-medium text-gray-900">Tahun Terbit</label>
              <input type="text" id="tahun_terbit" v-model="form.tahun_terbit" class="input" />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-900">Asal</label>
              <div class="flex items-center gap-4">
                <label>
                  <input type="radio" name="asal" value="Beli" v-model="form.asal" class="mr-1" />
                  Beli
                </label>
                <label>
                  <input type="radio" name="asal" value="Hadiah" v-model="form.asal" class="mr-1" />
                  Hadiah
                </label>
              </div>
            </div>
            <div>
              <label for="harga" class="block text-sm font-medium text-gray-900">Harga</label>
              <input type="number" id="harga" v-model="form.harga" class="input" />
            </div>
            <div>
              <label for="jum" class="block text-sm font-medium text-gray-900">Jumlah</label>
              <input type="text" id="jum" v-model="form.jum" class="input" />
            </div>
            <div>
              <label for="no_class" class="block text-sm font-medium text-gray-900">No Kelas</label>
              <input type="text" id="no_class" v-model="form.no_class" class="input" />
            </div>
            <div>
              <label for="ket" class="block text-sm font-medium text-gray-900">Keterangan</label>
              <input type="text" id="ket" v-model="form.ket" class="input" />
            </div>
            <div>
              <label for="category" class="block text-sm font-medium text-gray-900">Kategori</label>
              <select id="category" v-model="form.category" class="input">
                <option selected>Select Category</option>
                <option v-for="category in categories" :key="category.id" :value="category.id">
                  {{ category.name }}
                </option>
              </select>
            </div>
            <!-- <div>
              <label for="location" class="block text-sm font-medium text-gray-900">Lokasi</label>
              <select id="location" v-model="form.location" class="input">
                <option selected>Choose Location</option>
                <option v-for="location in locations" :key="location.id" :value="location.id">
                  {{ location.name }}
                </option>
              </select>
            </div> -->
            <div>
              <label for="no_of_copy" class="block text-sm font-medium text-gray-900">Jumlah Salinan</label>
              <input type="number" id="no_of_copy" v-model="form.no_of_copy" class="input" />
            </div>
            <div>
              <label for="status" class="block text-sm font-medium text-gray-900">Status</label>
              <select id="status" v-model="form.status" class="input">
                <option selected>Choose a Status</option>
                <option value="1">Available</option>
                <option value="0">Unavailable</option>
              </select>
            </div>
          </div>

          <div class="pt-6">
            <input
              type="submit"
              value="Update"
              class="w-20 cursor-pointer text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            />
          </div>
        </form>
      </div>
    </AuthenticatedLayout>
  </template>

  <style scoped>
  .input {
    @apply bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5;
  }
  </style>

