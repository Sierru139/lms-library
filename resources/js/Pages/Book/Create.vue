<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";

defineProps({
    categories: Object,
    authors: Object,
    locations: Object,
});

const form = useForm({
    name: "",
    no_induk: "",
    category: "",
    author: "",
    location: "",
    no_of_copy: "",
    status: "Choose a Status",
});

const submit = () => {
    form.post(route("book.store"));
};
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Book Add" />
        <div
            class="p-4 w-full bg-white rounded-lg border mx-auto my-10 border-gray-200 shadow-md sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700"
        >
            <form class="space-y-6" @submit.prevent="submit">
                <h5 class="text-xl font-medium text-gray-900 dark:text-white">
                    Add Book
                </h5>
                <div class="flex flex-row gap-4">
                    <div class="basis-3/5">
                        <div>
                            <label
                                for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                >Book Name</label
                            >
                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="bg-gray-50 border mb-6 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Data Structure and Algorithm"
                                required=""
                                v-model="form.name"
                            />
                        </div>
                        <div>
                            <label
                                for="no_induk"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                >ISBN No</label
                            >
                            <input
                                type="text"
                                name="no_induk"
                                id="no_induk"
                                class="bg-gray-50 border mb-6 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="283695645869"
                                required=""
                                v-model="form.no_induk"
                            />
                        </div>
                        <div class="flex flex-row gap-4">
                            <div class="basis-2/4">
                                <label
                                    for="no_of_copy"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                    >No of Copy</label
                                >
                                <input
                                    type="number"
                                    name="no_of_copy"
                                    id="no_of_copy"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="10"
                                    required=""
                                    v-model="form.no_of_copy"
                                />
                            </div>
                            <div class="basis-2/4">
                                <label
                                    for="small"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400"
                                    >Select Status</label
                                >
                                <select
                                    id="small"
                                    v-model="form.status"
                                    class="block p-2 mb-6 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                >
                                    <option selected>Choose a Status</option>
                                    <option value="1">Available</option>
                                    <option value="0">UnAvailable</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="basis-2/5">
                        <div>
                            <label
                                for="category"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400"
                                >Select Category</label
                            >
                            <select
                                id="category"
                                v-model="form.category"
                                class="block p-2 mb-6 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            >
                                <option selected>Select Category</option>
                                <option
                                    v-for="category in categories"
                                    :key="category.id"
                                    :value="category.id"
                                >
                                    {{ category.name }}
                                </option>
                            </select>
                        </div>
                        <div>
                            <label
                                for="author"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400"
                                >Select Author</label
                            >
                            <select
                                id="author"
                                v-model="form.author"
                                class="block p-2 mb-6 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            >
                                <option selected>Choose a Author</option>
                                <option
                                    v-for="author in authors"
                                    :key="author.id"
                                    :value="author.id"
                                >
                                    {{ author.name }}
                                </option>
                            </select>
                        </div>
                        <!-- <div>
                            <label
                                for="location"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400"
                                >Select Location</label
                            >
                            <select
                                id="location"
                                v-model="form.location"
                                class="block p-2 mb-6 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            >
                                <option selected>Choose a Location</option>
                                <option
                                    v-for="location in locations"
                                    :key="location.id"
                                    :value="location.id"
                                >
                                    {{ location.name }}
                                </option>
                            </select>
                        </div> -->
                    </div>
                </div>

                <div class="mb-10">
                    <input
                        type="submit"
                        value="Save"
                        class="w-20 cursor-pointer text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    />
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
