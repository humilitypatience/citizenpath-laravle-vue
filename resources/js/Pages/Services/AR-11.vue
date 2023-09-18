<template>
    <form
        @submit.prevent="
            form.post('/services/AR-11')
        "
    >
        <div>
            <div class="text-red-500 text-3xl">Previous Physical Address</div>
            <div>
                <label for="physicalStreet"> Street Number And Name * </label>
                <input
                    type="text"
                    v-model="form.prevPhysicalAddress.streetInput"
                    id="physicalStreet"
                    class="rounded-lg"
                />
            </div>
            <div>
                <label for="apartStatus"
                    >Is there an apartment, suite or floor?*</label
                >
                <select
                    v-model="form.prevPhysicalAddress.apartStatusSelect"
                    id="apartStatus"
                >
                    <option>No</option>
                    <option>Apartment</option>
                    <option>Suite</option>
                    <option>Floor</option>
                </select>
            </div>
            <div v-if="form.prevPhysicalAddress.apartStatusSelect !== 'No'">
                <lavel for="apartNumber">Enter the number here</lavel>
                <input
                    type="text"
                    v-model="form.prevPhysicalAddress.apartNumberInput"
                    id="apartNumber"
                />
            </div>
            <div>
                <lavel for="city">City or Town</lavel>
                <input v-model="form.prevPhysicalAddress.cityInput" id="city" />
            </div>
            <div>
                <lavel for="state">State</lavel>
                <input
                    v-model="form.prevPhysicalAddress.stateInput"
                    id="state"
                />
            </div>
            <div>
                <lavel for="zipcode">ZIP Code</lavel>
                <input
                    v-model="form.prevPhysicalAddress.zipcodeInput"
                    id="zipcode"
                />
            </div>
        </div>
        <div>
            <div class="text-red-500 text-3xl">Present Physical Address</div>
            <div>
                <label for="physicalStreet"> Street Number And Name * </label>
                <input
                    type="text"
                    v-model="form.newPhysicalAddress.streetInput"
                    id="physicalStreet"
                    class="rounded-lg"
                />
            </div>
            <div>
                <label for="apartStatus"
                    >Is there an apartment, suite or floor?*</label
                >
                <select
                    v-model="form.newPhysicalAddress.apartStatusSelect"
                    id="apartStatus"
                >
                    <option>No</option>
                    <option>Apartment</option>
                    <option>Suite</option>
                    <option>Floor</option>
                </select>
            </div>
            <div v-if="form.newPhysicalAddress.apartStatusSelect !== 'No'">
                <lavel for="apartNumber">Enter the number here</lavel>
                <input
                    type="text"
                    v-model="form.newPhysicalAddress.apartNumberInput"
                    id="apartNumber"
                />
            </div>
            <div>
                <lavel for="city">City or Town</lavel>
                <input v-model="form.newPhysicalAddress.cityInput" id="city" />
            </div>
            <div>
                <lavel for="state">State</lavel>
                <input
                    v-model="form.newPhysicalAddress.stateInput"
                    id="state"
                />
            </div>
            <div>
                <lavel for="zipcode">ZIP Code</lavel>
                <input
                    v-model="form.newPhysicalAddress.zipcodeInput"
                    id="zipcode"
                />
            </div>
        </div>
        <label
            >Is your mailing address the same as your present physical
            address<input type="checkbox" v-model="form.mailingAddressSameFlag" />
        </label>
        <div v-if="form.mailingAddressSameFlag === false">
            <div class="text-red-500 text-3xl">Mailing Address</div>
            <div>
                <label for="physicalStreet"> Street Number And Name * </label>
                <input
                    type="text"
                    v-model="form.mailingAddress.streetInput"
                    id="physicalStreet"
                    class="rounded-lg"
                />
            </div>
            <div>
                <label for="apartStatus"
                    >Is there an apartment, suite or floor?*</label
                >
                <select
                    v-model="form.mailingAddress.apartStatusSelect"
                    id="apartStatus"
                >
                    <option>No</option>
                    <option>Apartment</option>
                    <option>Suite</option>
                    <option>Floor</option>
                </select>
            </div>
            <div v-if="form.mailingAddress.apartStatusSelect !== 'No'">
                <lavel for="apartNumber">Enter the number here</lavel>
                <input
                    type="text"
                    v-model="form.mailingAddress.apartNumberInput"
                    id="apartNumber"
                />
            </div>
            <div>
                <lavel for="city">City or Town</lavel>
                <input v-model="form.mailingAddress.cityInput" id="city" />
            </div>
            <div>
                <lavel for="state">State</lavel>
                <input v-model="form.mailingAddress.stateInput" id="state" />
            </div>
            <div>
                <lavel for="zipcode">ZIP Code</lavel>
                <input
                    v-model="form.mailingAddress.zipcodeInput"
                    id="zipcode"
                />
            </div>
        </div>
        <div>
            <div class="text-red-500 text-3xl">We need some information about you</div>
            <div>
                <label>Given Name</label>
                <input v-model="form.applicantInfo.firstName" />
            </div>
            <div>
                <label>Middle Name</label>
                <input v-model="form.applicantInfo.middleName"/>
            </div>
            <div>
                <label>Family Name</label>
                <input v-model="form.applicantInfo.lastName"/>
            </div>
            <div>
                <label>Date of Birth</label>
                <input type="date" v-model="form.applicantInfo.birthday"/>
            </div>
            <div>
                <label>Citizenship</label>
                <input v-model="form.applicantInfo.citizenship"/>
            </div>
            <div>
                <label>I am in the United States as a</label>
                <select v-model="form.applicantInfo.visitingRole">
                    <option value="a">Permanent Resident(green card holder)</option>
                    <option value="b">Visitor</option>
                    <option value="c">Student</option>
                    <option value="d">Other</option>
                </select>
            </div>
            <div>
                <label>Please specify your immigration status</label>
                <input v-model="form.applicantInfo.immigrationStatus"/>
            </div>
            <div>
                <label>Alien Registration Number (A-Number)</label>
                <input v-model="form.applicantInfo.alienNumber"/>
            </div>
        </div>

        <button class="bg-indigo-300 text-lg">submit</button>
        <div>{{ form.errors }}</div>
    </form>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
// import { ref } from "vue";

// const mailingAddressSameFlag = ref(true);

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
    prevPhysicalAddress: {
        streetInput: "",
        apartStatusSelect: "No",
        apartNumberInput: "",
        cityInput: "",
        stateInput: "",
        zipcodeInput: "",
    },
    newPhysicalAddress: {
        streetInput: "",
        apartStatusSelect: "No",
        apartNumberInput: "",
        cityInput: "",
        stateInput: "",
        zipcodeInput: "",
    },
    mailingAddress: {
        streetInput: "",
        apartStatusSelect: "No",
        apartNumberInput: "",
        cityInput: "",
        stateInput: "",
        zipcodeInput: "",
    },
    mailingAddressSameFlag: true,
    applicantInfo: {
        firstName: "",
        middleName: "",
        lastName: "",
        birthday: "",
        citizenship: "",
        visitingRole: "",
        immigrationStatus: "",
        alienNumber: ""
    }
});

</script>
