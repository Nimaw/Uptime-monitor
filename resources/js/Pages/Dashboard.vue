<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Siteselector from '@/Components/SiteSelector.vue'
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { usePage } from '@inertiajs/vue3'

defineProps({
    site: Object,
    sites: Object
});

const page = usePage()
console.log(page);
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">

                    {{ site.data.domain }}

                </h2>
                <div>
                    <Siteselector :sites="sites.data" />
                </div>
            </div>

        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">{{ site }}</div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h2 class="font-semibold text-lg text-gray-800 leading-tight">New endpoint</h2>

                <form class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex items-start p-3 mt-4 space-x-2">
                    <div class="grow">
                        <InputLabel for="location" value="Location" class="sr-only" />
                        <TextInput id="location" type="text" class="block w-full h-9 text-sm"
                            placeholder="e.g. /pricing" />
                    </div>

                    <div>
                        <select name="frequency" id="frequency"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm h-9 leading-none text-sm">
                            <option :value="frequency.frequency"
                                v-for="frequency in page.props.endpoint_frequencies.data"
                                :key="frequency.frequency">
                                {{ frequency.frequency }}
                            </option>
                        </select>
                    </div>

                    <PrimaryButton class="ml-4 shrink-0 h-9">
                        Add
                    </PrimaryButton>
                </form>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
