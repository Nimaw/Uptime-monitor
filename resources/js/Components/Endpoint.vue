<template>
    <tr>
        <td class="whitespace-nowrap pl-4 sm:pl-6 px-3 text-sm font-medium text-gray-900 w-64">

            <template v-if="editing">
                <InputLabel for="location" value="Location" class="sr-only" />

                <TextInput id="location" type="text" class="block w-full h-9 text-sm" placeholder="e.g. /pricing"
                    v-model="editForm.location" />
            </template>

            <template v-else>
                <a href="/" class="text-indigo-600 hover:text-indigo-900">
                    {{ endpoint.location }}
                </a>
            </template>
        </td>
        <td class="whitespace-nowrap px-3 text-sm text-gray-500 w-64">

            <template v-if="editing">
                <InputLabel for="location" value="Location" class="sr-only" />
                <select name="frequency" id="frequency"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm h-9 leading-none text-sm"
                    v-model="editForm.frequency">
                    
                    <option :value="frequency.frequency" v-for="frequency in page.props.endpoint_frequencies.data"
                        :key="frequency.frequency">
                        {{ frequency.label }}
                    </option>
                </select>
            </template>

            <template v-else>

                {{ endpoint.frequency_label }}
            </template>

        </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            sa
        </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            Status
        </td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
            x%
        </td>
        <td class="whitespace-nowrap pl-3 pr-4 text-right text-sm font-medium sm:pr-6 w-32">
            <button v-on:click="editing = !editing" class="text-indigo-600 hover:text-indigo-900">
                {{ editing? 'Done': 'Edit' }}
            </button>
        </td>
        <td class="whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 w-16">
            <button v-on:click="deleteEndpoint" class="text-red-600 hover:text-red-900">
                Delete
            </button>
        </td>
    </tr>
</template>


<script setup>

import { useForm, usePage } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import { ref, watch } from 'vue';
import debouce from 'lodash.debounce';

const editing = ref(false);


const props = defineProps({
    endpoint: Object
});

const deleteForm = useForm({});
const page = usePage({});

const editForm = useForm({
    location: props.endpoint.location,
    frequency: props.endpoint.frequency_value
});

watch(() => editForm.isDirty, () => {
    editEndpoint();
})


const editEndpoint = debouce(() => {
    editForm.patch(`/endpoints/${props.endpoint.id}`, {
        preserveScroll: true,
    });
}, 500);


const deleteEndpoint = () => {
    if (window.confirm("Are you sure?")) {
        deleteForm.delete(`/endpoints/${props.endpoint.id}`)

    }

}
</script>