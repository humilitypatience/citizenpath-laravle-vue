<template>
    <form @submit.prevent="form.post('/services/AR-11')">
        
        <div>
            <label for="physicalStreet"> Street Number And Name * </label>
            <input
                type="text"
                v-model="form.physicalStreetInput"
                id="physicalStreet"
                class="rounded-lg"
            />
        </div>
        <div>
            <label for="apartStatus">Is there an apartment, suite or floor?*</label>
            <select v-model="form.apartStatusSelect" id="apartStatus">
                <option>No</option>
                <option>Apartment</option>
                <option>Suite</option>
                <option>Floor</option>
            </select>
        </div>
        <div v-if="form.apartStatusSelect !== 'No'">
            <lavel for="apartNumber">Enter the number here</lavel>
            <input type="number" v-model="apartNumberInput" id="apartNumber" />
        </div>
        <div>
            <lavel for="city">City or Town</lavel>
            <input v-model="form.cityInput" id="city" />
        </div>
        <div>
            <lavel for="state">State</lavel>
            <input v-model="form.stateInput" id="state" />
        </div>
        <div>
            <lavel for="zipcode">ZIP Code</lavel>
            <input v-model="form.zipcodeInput" id="zipcode" />
        </div>
        <button class="bg-indigo-300 text-lg">submit</button>
    </form>
    <div>{{  }}</div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

// export default {
//     data() {
//         return {
//             physicalStreet: "",
//             apartStatusSelect: "No",
//             citySelect: ""
//         };
//     },
// };

const form = useForm({
    physicalStreetInput: "",
    apartNumberInput: 0,
    apartStatusSelect: "No",
    cityInput: "",
    stateInput: "",
    zipcodeInput: ""
})
</script>
