<template>
    <div>
        <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">{{ t("students.Add Student") }}</h2>
            <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                <router-link
                    to="/students"
                    class="
                        btn
                        box
                        text-gray-700
                        dark:text-gray-300
                        mr-2
                        flex
                        items-center
                        ml-auto
                        sm:ml-0
                      "
                ><ArrowLeftCircleIcon class="w-4 h-4 mr-2" />
                    {{ t("common.Back") }}
                </router-link>
            </div>
        </div>

        <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
            <div class="intro-y box col-span-12 lg:col-span-12">
                <div class="p-5">
                    <div
                        class="alert alert-danger show flex items-center mb-2"
                        role="alert"
                        v-if="isErrored"
                    >
                        <AlertOctagonIcon class="w-6 h-6 mr-2" />
                        {{ message }}
                    </div>
                    <form @submit.prevent="submitForm" class="validate-form" enctype="multipart/form-data">
                        <div class="intro-y col-span-11 2xl:col-span-9">
                            <!-- BEGIN: Board and Standard selection -->
                            <div class="intro-y box p-5 mt-1">
                                <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                    <div
                                        class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                                        <ChevronDownIcon class="w-4 h-4 mr-2"/>
                                        {{ t("questions.Select Standard/Class & Fee Type") }}
                                    </div>
                                    <div class="mt-5">

                                        <div class="form-inline items-start flex-col xl:flex-row mt-1 pt-5 first:mt-0 first:pt-0">
                                            <div class="form-label xl:w-64 xl:!mr-10">
                                                <div class="text-left">
                                                    <div class="flex items-center">
                                                        <div class="font-medium">{{
                                                                t("questions.Choose Standard")
                                                            }}
                                                        </div>
                                                        <div
                                                            class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                            {{ t("common.Required") }}
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                                <TomSelect id="form-standard"
                                                           v-model="model.standard_id"
                                                           :class="{
                                                              'border-danger': submitted && v$.standard_id.$errors.length,
                                                            }"
                                                           :options="{
                                                                allowEmptyOption: false,
                                                                create: false,
                                                                placeholder: 'Select Standard',
                                                                autocomplete: 'off',
                                                           }"
                                                           class="w-full"
                                                           placeholder="Select Standard">
                                                    <option>{{ t('questions.Select Standard') }}</option>
                                                    <option v-for="(standard, indexs) in standards" :key="indexs" :value="indexs">
                                                        {{ standard }}
                                                    </option>
                                                </TomSelect>
                                                <div v-for="(error, index) of v$.standard_id.$errors" :key="index"
                                                     class="text-danger mt-2">
                                                    <div class="error-msg">{{ error.$message }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline items-start flex-col xl:flex-row mt-1 pt-5 first:mt-0 first:pt-0">
                                            <div class="form-label xl:w-64 xl:!mr-10">
                                                <div class="text-left">
                                                    <div class="flex items-center">
                                                        <div class="font-medium">{{
                                                                t("students.Choose Fee Type")
                                                            }}
                                                        </div>
                                                        <div
                                                            class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                            {{ t("common.Required") }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                                <TomSelect id="form-fee-type"
                                                           v-model="model.fee_type_id"
                                                           :class="{ 'border-danger': submitted && v$.fee_type_id.$errors.length, }"
                                                           :options="{
                                                                allowEmptyOption: false,
                                                                create: false,
                                                                placeholder: 'Select Fee Type',
                                                                autocomplete: 'off',
                                                              }"
                                                           :placeholder="'Select Fee Type'"
                                                           class="w-full">
                                                    <option>{{ t('students.Select Fee Type') }}</option>
                                                    <option v-for="(feeType, index) in feeTypes" :key="index" :value="index">
                                                        {{ feeType }}
                                                    </option>
                                                </TomSelect>

                                                <div v-for="(error, index) of v$.fee_type_id.$errors" :key="index"
                                                     class="text-danger mt-2">
                                                    <div class="error-msg">{{ error.$message }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END: Board and Standard selection -->
                            <!-- BEGIN: Basic Information -->
                            <div class="intro-y box p-5 mt-1">
                                <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                    <div
                                        class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                                        <ChevronDownIcon class="w-4 h-4 mr-2"/>
                                        {{ t("students.Basic Information Of Student") }}
                                    </div>
                                    <div class="mt-5">
                                        <div class="form-inline items-start flex-col xl:flex-row mt-1 pt-5 first:mt-0 first:pt-0">
                                            <div class="form-label xl:w-64 xl:!mr-10">
                                                <div class="text-left">
                                                    <div class="flex items-center">
                                                        <div class="font-medium">{{ t("students.Name") }}</div>
                                                        <div
                                                            class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                            {{ t("common.Required") }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                                <input
                                                    id="form-name"
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="Enter name of student"
                                                    v-model.trim="model.name"
                                                    :class="{ 'border-danger': submitted && v$.name.$errors.length, }"
                                                />
                                                <div v-for="(error, index) of v$.name.$errors"
                                                     :key="index" class="text-danger mt-2">
                                                    <div class="error-msg">{{ error.$message }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline items-start flex-col xl:flex-row mt-1 pt-5 first:mt-0 first:pt-0">
                                            <div class="form-label xl:w-64 xl:!mr-10">
                                                <div class="text-left">
                                                    <div class="flex items-center">
                                                        <div class="font-medium">{{ t("students.Email") }}
                                                        </div>
                                                        <div
                                                            class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                            {{ t("common.Required") }}
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                                <input
                                                    id="form-email"
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="Enter email address of student"
                                                    v-model.trim="model.email"
                                                    :class="{ 'border-danger': submitted && v$.email.$errors.length, }"
                                                />
                                                <div v-for="(error, index) of v$.email.$errors" :key="index"
                                                     class="text-danger mt-2">
                                                    <div class="error-msg">{{ error.$message }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline items-start flex-col xl:flex-row mt-1 pt-5 first:mt-0 first:pt-0">
                                            <div class="form-label xl:w-64 xl:!mr-10">
                                                <div class="text-left">
                                                    <div class="flex items-center">
                                                        <div class="font-medium">{{ t("students.Mobile") }}
                                                        </div>
                                                        <div
                                                            class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                            {{ t("common.Required") }}
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                                <input
                                                    id="form-mobile"
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="Enter mobile number of student."
                                                    v-model.trim="model.mobile"
                                                    :class="{ 'border-danger': submitted && v$.mobile.$errors.length, }"
                                                />
                                                <div v-for="(error, index) of v$.mobile.$errors" :key="index"
                                                     class="text-danger mt-2">
                                                    <div class="error-msg">{{ error.$message }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline items-start flex-col xl:flex-row mt-1 pt-5 first:mt-0 first:pt-0">
                                            <div class="form-label xl:w-64 xl:!mr-10">
                                                <div class="text-left">
                                                    <div class="flex items-center">
                                                        <div class="font-medium">{{ t("students.Alternate Mobile") }}</div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                                <input
                                                    id="form-alt-mobile"
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="Enter alternate mobile number of student."
                                                    v-model.trim="model.alt_mobile"
                                                    :class="{ 'border-danger': submitted && v$.alt_mobile.$errors.length, }"
                                                />
                                                <div v-for="(error, index) of v$.alt_mobile.$errors" :key="index"
                                                     class="text-danger mt-2">
                                                    <div class="error-msg">{{ error.$message }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline items-start flex-col xl:flex-row mt-1 pt-5 first:mt-0 first:pt-0">
                                            <div class="form-label xl:w-64 xl:!mr-10">
                                                <div class="text-left">
                                                    <div class="flex items-center">
                                                        <div class="font-medium">{{ t("students.Gender") }}</div>
                                                        <div
                                                            class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                            {{ t("common.Required") }}
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                                <TomSelect id="form-gender"
                                                           v-model="model.gender"
                                                           :class="{ 'border-danger': submitted && v$.gender.$errors.length, }"
                                                           :options="{
                                                                allowEmptyOption: false,
                                                                create: false,
                                                                placeholder: 'Select Gender',
                                                                autocomplete: 'off',
                                                              }"
                                                           :placeholder="'Select Gender'"
                                                           class="w-full">
                                                    <option>{{ t('students.Select Gender') }}</option>
                                                    <option v-for="(gender, index) in genders" :key="index" :value="index">
                                                        {{ gender }}
                                                    </option>
                                                </TomSelect>

                                                <div v-for="(error, index) of v$.gender.$errors" :key="index"
                                                     class="text-danger mt-2">
                                                    <div class="error-msg">{{ error.$message }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline items-start flex-col xl:flex-row mt-1 pt-5 first:mt-0 first:pt-0">
                                            <div class="form-label xl:w-64 xl:!mr-10">
                                                <div class="text-left">
                                                    <div class="flex items-center">
                                                        <div class="font-medium">{{ t("students.Avatar") }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                                <img
                                                    v-if="model.avatar"
                                                    :src="model.avatar"
                                                    :alt="model.name"
                                                    class="w-20 h-20 object-cover rounded-md"
                                                />

                                                <button
                                                    type="button"
                                                    class="relative overflow-hidden bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                >
                                                    <input
                                                        type="file"
                                                        @change="onImageChoose"
                                                        accept="image/png, image/jpeg, image/jpg"
                                                        class="absolute left-0 top-0 right-0 bottom-0 opacity-0 cursor-pointer rounded-full"
                                                    />
                                                    {{ t("students.Avatar") }}
                                                </button>

                                                <div v-for="(error, index) of v$.avatar.$errors" :key="index"
                                                     class="text-danger mt-2">
                                                    <div class="error-msg">{{ error.$message }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline items-start flex-col xl:flex-row mt-1 pt-5 first:mt-0 first:pt-0">
                                            <div class="form-label xl:w-64 xl:!mr-10">
                                                <div class="text-left">
                                                    <div class="flex items-center">
                                                        <div class="font-medium">{{ t("students.Date Of Birth") }}
                                                        </div>
                                                        <div
                                                            class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                            {{ t("common.Required") }}
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                                <div class="relative w-56">
                                                    <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400">
                                                        <CalendarIcon class="w-4 h-4" />
                                                    </div>
                                                    <input v-model="model.dob"
                                                           type="date"
                                                           class="form-control pl-12" />
                                                </div>
                                                <div v-for="(error, index) of v$.dob.$errors" :key="index"
                                                     class="text-danger mt-2">
                                                    <div class="error-msg">{{ error.$message }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline items-start flex-col xl:flex-row mt-1 pt-5 first:mt-0 first:pt-0">
                                            <div class="form-label xl:w-64 xl:!mr-10">
                                                <div class="text-left">
                                                    <div class="flex items-center">
                                                        <div class="font-medium">{{ t("students.Permanent Address") }}
                                                        </div>
                                                        <div
                                                            class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                            {{ t("common.Required") }}
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                                <textarea
                                                    id="form-permanent-address"
                                                    class="form-control"
                                                    placeholder="Enter permanent address of student"
                                                    v-model.trim="model.permanent_address"
                                                    :class="{ 'border-danger': submitted && v$.permanent_address.$errors.length, }"
                                                ></textarea>
                                                <div v-for="(error, index) of v$.permanent_address.$errors" :key="index"
                                                     class="text-danger mt-2">
                                                    <div class="error-msg">{{ error.$message }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline items-start flex-col xl:flex-row mt-1 pt-5 first:mt-0 first:pt-0">
                                            <div class="form-label xl:w-64 xl:!mr-10">
                                                <div class="text-left">
                                                    <div class="flex items-center">
                                                        <div class="font-medium">{{ t("students.Address") }}</div>
                                                        <div
                                                            class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                            {{ t("common.Required") }}
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                                <textarea
                                                    id="form-address"
                                                    class="form-control"
                                                    placeholder="Enter address of student"
                                                    v-model.trim="model.address"
                                                    :class="{ 'border-danger': submitted && v$.address.$errors.length, }"
                                                ></textarea>
                                                <div v-for="(error, index) of v$.address.$errors" :key="index"
                                                     class="text-danger mt-2">
                                                    <div class="error-msg">{{ error.$message }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline items-start flex-col xl:flex-row mt-1 pt-5 first:mt-0 first:pt-0">
                                            <div class="form-label xl:w-64 xl:!mr-10">
                                                <div class="text-left">
                                                    <div class="flex items-center">
                                                        <div class="font-medium">{{ t("students.Aadhaar") }}
                                                        </div>
                                                        <div
                                                            class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                            {{ t("common.Required") }}
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                                <input
                                                    id="form-aadhaar"
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="Enter aadhaar number of student"
                                                    v-model.trim="model.aadhaar"
                                                    :class="{ 'border-danger': submitted && v$.aadhaar.$errors.length, }"
                                                />
                                                <div v-for="(error, index) of v$.aadhaar.$errors" :key="index"
                                                     class="text-danger mt-2">
                                                    <div class="error-msg">{{ error.$message }}</div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- END: Basic Information -->
                            <!-- BEGIN: Aadhaar Information -->
                            <div class="intro-y box p-5 mt-1">
                                <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                    <div
                                        class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                                        <ChevronDownIcon class="w-4 h-4 mr-2"/>
                                        {{ t("students.Aadhaar Number of Parents") }}
                                    </div>
                                    <div class="mt-5">
                                        <div class="form-inline items-start flex-col xl:flex-row mt-1 pt-5 first:mt-0 first:pt-0">
                                            <div class="form-label xl:w-64 xl:!mr-10">
                                                <div class="text-left">
                                                    <div class="flex items-center">
                                                        <div class="font-medium">{{ t("students.Parent Aadhaar Number") }}</div>
                                                        <div
                                                            class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                            {{ t("common.Required") }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                                <input
                                                    id="form-parent-aadhaar-number"
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="Enter parent's aadhaar number."
                                                    v-model.trim="model.parent_aadhaar_number"
                                                    :class="{ 'border-danger': submitted && v$.parent_aadhaar_number.$errors.length, }"
                                                />
                                                <div v-for="(error, index) of v$.parent_aadhaar_number.$errors"
                                                     :key="index" class="text-danger mt-2">
                                                    <div class="error-msg">{{ error.$message }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END: Aadhaar Information -->
                            <!-- BEGIN: Mother Information -->
                            <div class="intro-y box p-5 mt-1">
                                <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                    <div
                                        class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                                        <ChevronDownIcon class="w-4 h-4 mr-2"/>
                                        {{ t("students.Mother Information Of Student") }}
                                    </div>
                                    <div class="mt-5">
                                        <div class="form-inline items-start flex-col xl:flex-row mt-1 pt-5 first:mt-0 first:pt-0">
                                            <div class="form-label xl:w-64 xl:!mr-10">
                                                <div class="text-left">
                                                    <div class="flex items-center">
                                                        <div class="font-medium">{{ t("students.Mother Name") }}</div>
                                                        <div
                                                            class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                            {{ t("common.Required") }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                                <input
                                                    id="form-mother-name"
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="Enter name of student's mother."
                                                    v-model.trim="model.mother_name"
                                                    :class="{ 'border-danger': submitted && v$.mother_name.$errors.length, }"
                                                />
                                                <div v-for="(error, index) of v$.mother_name.$errors"
                                                     :key="index" class="text-danger mt-2">
                                                    <div class="error-msg">{{ error.$message }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline items-start flex-col xl:flex-row mt-1 pt-5 first:mt-0 first:pt-0">
                                            <div class="form-label xl:w-64 xl:!mr-10">
                                                <div class="text-left">
                                                    <div class="flex items-center">
                                                        <div class="font-medium">{{ t("students.Mother Email") }}
                                                        </div>
                                                        <div
                                                            class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                            {{ t("common.Required") }}
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                                <input
                                                    id="form-mother-email"
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="Enter email address of student's mother"
                                                    v-model.trim="model.mother_email"
                                                    :class="{ 'border-danger': submitted && v$.mother_email.$errors.length, }"
                                                />
                                                <div v-for="(error, index) of v$.mother_email.$errors" :key="index"
                                                     class="text-danger mt-2">
                                                    <div class="error-msg">{{ error.$message }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline items-start flex-col xl:flex-row mt-1 pt-5 first:mt-0 first:pt-0">
                                            <div class="form-label xl:w-64 xl:!mr-10">
                                                <div class="text-left">
                                                    <div class="flex items-center">
                                                        <div class="font-medium">{{ t("students.Mother Mobile") }}
                                                        </div>
                                                        <div
                                                            class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                            {{ t("common.Required") }}
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                                <input
                                                    id="form-mother-mobile"
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="Enter mobile number of student's mother."
                                                    v-model.trim="model.mother_mobile"
                                                    :class="{ 'border-danger': submitted && v$.mother_mobile.$errors.length, }"
                                                />
                                                <div v-for="(error, index) of v$.mother_mobile.$errors" :key="index"
                                                     class="text-danger mt-2">
                                                    <div class="error-msg">{{ error.$message }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline items-start flex-col xl:flex-row mt-1 pt-5 first:mt-0 first:pt-0">
                                            <div class="form-label xl:w-64 xl:!mr-10">
                                                <div class="text-left">
                                                    <div class="flex items-center">
                                                        <div class="font-medium">{{ t("students.Mother Qualification") }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                                <input
                                                    id="form-mother-qualification"
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="Enter qualification of student's mother."
                                                    v-model.trim="model.mother_qualification"
                                                />
                                            </div>
                                        </div>
                                        <div class="form-inline items-start flex-col xl:flex-row mt-1 pt-5 first:mt-0 first:pt-0">
                                            <div class="form-label xl:w-64 xl:!mr-10">
                                                <div class="text-left">
                                                    <div class="flex items-center">
                                                        <div class="font-medium">{{ t("students.Mother Occupation") }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                                <input
                                                    id="form-mother-occupation"
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="Enter occupation of student's mother."
                                                    v-model.trim="model.mother_occupation"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END: Mother Information -->
                            <!-- BEGIN: Father Information -->
                            <div class="intro-y box p-5 mt-1">
                                <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                    <div
                                        class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                                        <ChevronDownIcon class="w-4 h-4 mr-2"/>
                                        {{ t("students.Father Information Of Student") }}
                                    </div>
                                    <div class="mt-5">
                                        <div class="form-inline items-start flex-col xl:flex-row mt-1 pt-5 first:mt-0 first:pt-0">
                                            <div class="form-label xl:w-64 xl:!mr-10">
                                                <div class="text-left">
                                                    <div class="flex items-center">
                                                        <div class="font-medium">{{ t("students.Father Name") }}</div>
                                                        <div
                                                            class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                            {{ t("common.Required") }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                                <input
                                                    id="form-father-name"
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="Enter name of student"
                                                    v-model.trim="model.father_name"
                                                    :class="{ 'border-danger': submitted && v$.father_name.$errors.length, }"
                                                />
                                                <div v-for="(error, index) of v$.father_name.$errors"
                                                     :key="index" class="text-danger mt-2">
                                                    <div class="error-msg">{{ error.$message }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline items-start flex-col xl:flex-row mt-1 pt-5 first:mt-0 first:pt-0">
                                            <div class="form-label xl:w-64 xl:!mr-10">
                                                <div class="text-left">
                                                    <div class="flex items-center">
                                                        <div class="font-medium">{{ t("students.Father Email") }}
                                                        </div>
                                                        <div
                                                            class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                            {{ t("common.Required") }}
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                                <input
                                                    id="form-father-email"
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="Enter email address of student's father"
                                                    v-model.trim="model.father_email"
                                                    :class="{ 'border-danger': submitted && v$.father_email.$errors.length, }"
                                                />
                                                <div v-for="(error, index) of v$.father_email.$errors" :key="index"
                                                     class="text-danger mt-2">
                                                    <div class="error-msg">{{ error.$message }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline items-start flex-col xl:flex-row mt-1 pt-5 first:mt-0 first:pt-0">
                                            <div class="form-label xl:w-64 xl:!mr-10">
                                                <div class="text-left">
                                                    <div class="flex items-center">
                                                        <div class="font-medium">{{ t("students.Father Mobile") }}
                                                        </div>
                                                        <div
                                                            class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">
                                                            {{ t("common.Required") }}
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                                <input
                                                    id="form-father-mobile"
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="Enter mobile number of student's father."
                                                    v-model.trim="model.father_mobile"
                                                    :class="{ 'border-danger': submitted && v$.father_mobile.$errors.length, }"
                                                />
                                                <div v-for="(error, index) of v$.father_mobile.$errors" :key="index"
                                                     class="text-danger mt-2">
                                                    <div class="error-msg">{{ error.$message }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline items-start flex-col xl:flex-row mt-1 pt-5 first:mt-0 first:pt-0">
                                            <div class="form-label xl:w-64 xl:!mr-10">
                                                <div class="text-left">
                                                    <div class="flex items-center">
                                                        <div class="font-medium">{{ t("students.Father Qualification") }}</div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                                <input
                                                    id="form-father-qualification"
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="Enter qualification of student's father."
                                                    v-model.trim="model.father_qualification"
                                                />
                                            </div>
                                        </div>
                                        <div class="form-inline items-start flex-col xl:flex-row mt-1 pt-5 first:mt-0 first:pt-0">
                                            <div class="form-label xl:w-64 xl:!mr-10">
                                                <div class="text-left">
                                                    <div class="flex items-center">
                                                        <div class="font-medium">{{ t("students.Father Occupation") }}</div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                                <input
                                                    id="form-father-occupation"
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="Enter occupation of student's father."
                                                    v-model.trim="model.father_occupation"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END: Father Information -->
                        </div>
                        <div class="text-right w-full bottom-0 mt-5">
                            <router-link
                                to="/students"
                                class="btn btn-outline-secondary w-20 mr-1"
                            >
                                {{ t("users.Cancel") }}
                            </router-link>
                            <button type="submit" class="btn btn-primary w-20">
                                {{ t("users.Save") }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <Loading v-if="isLoading" fixed></Loading>
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import {useRoute, useRouter} from "vue-router";
import {useI18n} from "vue-i18n";
import {email, helpers, minLength, maxLength, numeric, required} from "@vuelidate/validators";
import {useVuelidate} from "@vuelidate/core";
import store from "@/stores";

const route = useRoute();
const router = useRouter();
const { t } = useI18n();

const isLoading = ref(false);
const isErrored = ref(false);
const message = ref("");
const submitted = ref(false);

const model = ref({
    name: "",
    email: "",
    mobile: "",
    standard_id: "",
    fee_type_id: "",
    alt_mobile: "",
    gender: "",
    avatar: "",
    dob: "",
    permanent_address: "",
    address: "",
    aadhaar: "",
    parent_aadhaar_number: "",
    mother_name: "",
    mother_email: "",
    mother_mobile: "",
    mother_qualification: "",
    mother_occupation: "",
    father_name: "",
    father_email: "",
    father_mobile: "",
    father_qualification: "",
    father_occupation: "",
});

const rules = computed(() => {
    return {
        name: {
            required: helpers.withMessage("Please enter name of user.", required),
        },
        email: {
            required: helpers.withMessage("Please enter email address.", required),
            email: helpers.withMessage("Please enter valid email address", email),
        },
        mobile: {
            required: helpers.withMessage("Please enter mobile number.", required),
            minLength: helpers.withMessage("Please enter valid mobile number", minLength(10)),
            numeric: helpers.withMessage("Please enter valid mobile number", numeric),
        },
        alt_mobile: {
            required: helpers.withMessage("Please enter mobile number.", required),
            minLength: helpers.withMessage("Please enter valid mobile number", minLength(10)),
            numeric: helpers.withMessage("Please enter valid mobile number", numeric),
        },
        standard_id: {
            required: helpers.withMessage("Please select standard or class of student.", required),
        },
        fee_type_id: {
            required: helpers.withMessage("Please select fee type of student.", required),
        },
        gender: {
            required: helpers.withMessage("Please select gender of student.", required),
        },
        avatar: {
            required: helpers.withMessage("Please upload avatar of student.", required),
        },
        dob: {
            required: helpers.withMessage("Please date of birth of student.", required),
        },
        permanent_address: {
            required: helpers.withMessage("Please enter permanent address of student.", required),
        },
        address: {
            required: helpers.withMessage("Please enter address of student.", required),
        },
        aadhaar: {
            required: helpers.withMessage("Please enter aadhaar number of student.", required),
            minLength: helpers.withMessage("Please enter valid aadhaar number.", minLength(12)),
            maxLength: helpers.withMessage("Please enter valid aadhaar number", maxLength(12)),
            numeric: helpers.withMessage("Please enter valid aadhaar number", numeric),
        },
        parent_aadhaar_number: {
            required: helpers.withMessage("Please enter aadhaar number of parent.", required),
            minLength: helpers.withMessage("Please enter valid aadhaar number.", minLength(12)),
            maxLength: helpers.withMessage("Please enter valid aadhaar number", maxLength(12)),
            numeric: helpers.withMessage("Please enter valid aadhaar number", numeric),
        },
        mother_name: {
            required: helpers.withMessage("Please enter name of student's mother.", required),
        },
        mother_email: {
            required: helpers.withMessage("Please enter email of student's mother.", required),
            email: helpers.withMessage("Please enter valid email address", email),
        },
        mother_mobile: {
            required: helpers.withMessage("Please enter mobile number of student's mother.", required),
            minLength: helpers.withMessage("Please enter valid mobile number", minLength(10)),
            numeric: helpers.withMessage("Please enter valid mobile number", numeric),
        },
        father_name: {
            required: helpers.withMessage("Please enter name of student's father.", required),
        },
        father_email: {
            required: helpers.withMessage("Please enter email of student's father.", required),
            email: helpers.withMessage("Please enter valid email address", email),
        },
        father_mobile: {
            required: helpers.withMessage("Please enter mobile number of student's father.", required),
            minLength: helpers.withMessage("Please enter valid mobile number.", minLength(10)),
            numeric: helpers.withMessage("Please enter valid mobile number.", numeric),
        },
    };
});

const v$ = useVuelidate(rules, model.value);

async function submitForm()
{
    submitted.value = true;
    v$.value.$validate(); // checks all inputs
    if (!v$.value.$error) {
        isLoading.value = true;

        await store
            .dispatch("students/save", model.value)
            .then(() => {
                isLoading.value = false;
                submitted.value = false;
                isErrored.value = false;
                router.push({name: "Students"});
            })
            .catch((err) => {
                isLoading.value = false;
                submitted.value = false;
                isErrored.value = true;
                if (err.response && err.response.data) {
                    message.value = err.response.data.message;
                }

            });
    } else {
        // if ANY fail validation
        return;
    }
}

onMounted(() => {
    store.dispatch("listStandard").then().catch();
    store.dispatch("listFeeTypes").then().catch();
});
const standards = computed(() => store.getters.listStandards);
const feeTypes = computed(() => store.getters.listFeeTypes);

const genders = {
    male: 'Male',
    female: "Female",
    other: "Other"
};


function onImageChoose(ev) {
    const file = ev.target.files[0];
    const reader = new FileReader();
    reader.onload = () => {
        // The field to send on backend and apply validations
        model.value.avatar = reader.result;
        ev.target.value = "";
    };
    reader.readAsDataURL(file);
}

</script>

<style scoped>

</style>
