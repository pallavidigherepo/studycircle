<template>
    <div>
        <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">{{ t("roles.Add Role") }}</h2>
            <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                <router-link to="/roles"
                            class="btn box text-gray-700 dark:text-gray-300 mr-2 flex items-center ml-auto sm:ml-0"
                            ><ArrowLeftCircleIcon class="w-4 h-4 mr-2" />
                    {{ t("common.Back") }}
                </router-link>
            </div>
        </div>
        <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
            <div class="intro-y box col-span-12 lg:col-span-12">
                <div class="p-5">
                    <div class="alert alert-danger show flex items-center mb-2" role="alert" v-if="isErrored">
                        <AlertOctagonIcon class="w-6 h-6 mr-2" />
                        {{ message }}
                    </div>
                    <form @submit.prevent = "submitForm" class="validate-form">
                        <div>
                            <label for="form-name" class="form-label">{{ t("roles.Name") }}</label>
                            <input id="form-name"
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter name of role."
                                    v-model.trim="role.name"
                                    :class="{ 'border-danger': submitted && v$.name.$errors.length }"
                                    />
                            <div class="text-danger mt-2" v-for="(error, index) of v$.name.$errors" :key="index">
                                <div class="error-msg">{{ error.$message }}</div>
                            </div>
                        </div>
                        <div class="mt-3">

                            <label for="form-permission" class="form-label">{{ t("roles.Permission") }}</label>
                                <div
                                class="p-5 flex flex-col-reverse sm:flex-row text-gray-600 border-b border-gray-200 dark:border-dark-1"
                                >
                                <div
                                    class="flex items-center mt-3 sm:mt-0 border-t sm:border-0 border-gray-200 pt-5 sm:pt-0 mt-5 sm:mt-0 -mx-5 sm:mx-0 px-5 sm:px-0"
                                >
                                    <h2>{{ t("roles.Select permissions by toggling individual permissions per category")}}</h2>
                                </div>

                            </div>
                            <div class="mt-3 py-2"
                                v-for="(permission, index) in listPermissions"
                                :key="index">
                                <div class="roles">
                                    <label>{{ index }}</label>
                                </div>
                                <div class="flex flex-col sm:flex-row mt-2">

                                    <div class="form-check mr-2"
                                        v-for="(individualPerms, perIdx) in permission"
                                        :key="perIdx">
                                        <input :id="individualPerms"
                                            class="form-check-input"
                                            type="checkbox"
                                            v-model="role.permissions"
                                            :value="perIdx"
                                            :class="{ 'border-danger': submitted && v$.permissions.$errors.length }" />
                                        <label class="form-check-label" :for="individualPerms">{{ individualPerms }}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="text-danger mt-2" v-for="(error, index) of v$.permissions.$errors" :key="index">
                                <div class="error-msg">{{ error.$message }}</div>
                            </div>
                        </div>

                        <div class="text-right w-full bottom-0">
                            <router-link to="/roles" class="btn btn-outline-secondary w-20 mr-1" >
                                {{ t("common.Cancel") }}
                            </router-link>
                            <button type="submit" class="btn btn-primary w-20">
                                {{ t("common.Save") }}
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</template>

<script setup>
import store from '@/stores';
import { ref, reactive, computed, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';

import { useVuelidate } from '@vuelidate/core';
import { required, helpers } from '@vuelidate/validators'
import {useI18n} from "vue-i18n";

const { t } = useI18n();
const submitted = ref(false);

const isErrored = ref(false);
const message = ref('');
const isLoading = ref(false);

const route = useRoute();
const router = useRouter();
// Now we must get editing details for the selected item

const role = reactive({
    id: '',
    name: '',
    permissions: [],
});

onMounted(() => {
    store.dispatch('permissions/modules');
});

const listPermissions = computed(() => {
    return store.state.permissions.module_wise_permissions;
});

const rules = computed(() => {
    return {
        name: {
            required: helpers.withMessage('Please enter name of role.', required),
        },
        permissions: {
            required: helpers.withMessage('Please select atleast one perimission.', required)
        }
    }
});

const v$ = useVuelidate (rules, role);

async function submitForm() {
    submitted.value = true;
    v$.value.$validate(); // checks all inputs

    if (!v$.value.$error) {
        isLoading.value = true;
        await store
            .dispatch("roles/save", role)
            .then(() => {
                isLoading.value = false;
                submitted.value = false;
                router.push({ name: "Roles" });
            })
            .catch((err) => {
                isLoading.value = false;
                isErrored.value = true;
                if (err.response) {
                    message.value = err.response.data.message;
                }

            });
    } else {
        // if ANY fail validation
        return ;
    }
}
</script>

<style scoped>
.roles {
    float: left;
    width: 18rem;
}

.form-check-label {
    width: 5rem;
}
</style>
