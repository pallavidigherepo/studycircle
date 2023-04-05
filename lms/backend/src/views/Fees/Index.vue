<template>
    <div>
        <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                {{ t("fees.Fees") }}
            </h2>
        </div>
        <div class="pos intro-y grid grid-cols-12 gap-6 mt-5">
            <!-- BEGIN: Fee Content -->
            <div class="intro-y col-span-12 lg:col-span-12">
                <!-- BEGIN: HTML Table Data -->

                <div class="intro-y box p-5">
                    <div class="overflow-x-auto scrollbar-hidden">
                        <div class="w-full grid grid-cols-12 gap-6 mt-5">
                            <div class="intro-y
                                    col-span-12
                                    flex flex-wrap
                                    sm:flex-nowrap
                                    items-center
                                    mt-2">
                                <div v-if="datatableoptions.export" class="dropdown">
                                    <button aria-expanded="false" class="dropdown-toggle btn btn-primary ml-2"
                                            data-tw-toggle="dropdown">
                                      <span class="flex items-center justify-center">
                                        {{ t("common.Export/Print") }}&nbsp;
                                        <DownloadIcon class="w-4 h-4"/>
                                      </span>
                                    </button>
                                    <div class="dropdown-menu w-40">
                                        <ul class="dropdown-content">
                                            <!-- <li>
                                                <a href="javascript:;" class="dropdown-item">
                                                    <PrinterIcon class="w-4 h-4 mr-2" />
                                                    {{ t("permissions.Print") }}
                                                </a>
                                                </li> -->
                                            <li>
                                                <a class="dropdown-item" href="javascript:;"
                                                   @click.prevent="exportMe('xlsx')">
                                                    <FileTextIcon class="w-4 h-4 mr-2"/>
                                                    {{ t("common.Export to Excel") }}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:;"
                                                   @click.prevent="exportMe('csv')">
                                                    <FileTextIcon class="w-4 h-4 mr-2"/>
                                                    {{ t("common.Export to CSV") }}
                                                </a>
                                            </li>
                                            <!-- <li>
                                                <a
                                                    href="javascript:;"
                                                    class="dropdown-item"
                                                    @click.prevent="exportMe('pdf')"
                                                >
                                                    <FileTextIcon class="w-4 h-4 mr-2" />
                                                    {{ t("permissions.Export to PDF") }}
                                                </a>
                                                </li> -->
                                        </ul>
                                    </div>
                                </div>
                                <div v-if="datatableoptions.import" class="dropdown">
                                    <button aria-expanded="false" class="dropdown-toggle btn btn-primary ml-2"
                                            data-tw-toggle="dropdown">
                                      <span class="flex items-center justify-center">
                                        {{ t("common.Import") }}&nbsp;
                                        <UploadIcon class="w-4 h-4"/>
                                      </span>
                                    </button>
                                    <div class="dropdown-menu w-40">
                                        <ul class="dropdown-content">
                                            <li>
                                                <a class="dropdown-item" href="#" @click.prevent="openModal">
                                                    <FileTextIcon class="w-4 h-4 mr-2"/>
                                                    {{ t("common.CSV/Excel") }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="
                                    intro-y
                                    col-span-12
                                    flex flex-wrap
                                    sm:flex-nowrap
                                    items-center
                                    mt-2
                                  ">
                                <h2>
                                    <FilterIcon></FilterIcon>
                                </h2>
                                <div class="md:block mx-auto text-slate-500">
                                    <div class="grid grid-cols-12 gap-6">
                                        <div class="col-span-3 flex flex-wrap md:block mx-auto">
                                            <TomSelect id="form-batch"
                                                       v-model="model.batch_id"
                                                       :options="{
                                                            allowEmptyOption: false,
                                                            create: false,
                                                            placeholder: 'All Standard',
                                                            autocomplete: 'off',
                                                       }"
                                                       class="w-56"
                                                       placeholder="Select Batch">
                                                <option>{{ t('fees.All Batches') }}</option>
                                                <option v-for="(standard, indexs) in standards" :key="indexs"
                                                        :value="indexs">
                                                    {{ standard }}
                                                </option>
                                            </TomSelect>
                                        </div>
                                        <div class="col-span-3 flex flex-wrap md:block mx-auto">
                                            <TomSelect id="form-standard"
                                                       v-model="model.standard_id"
                                                       :options="{
                                                            allowEmptyOption: false,
                                                            create: false,
                                                            placeholder: 'All Standard',
                                                            autocomplete: 'off',
                                                       }"
                                                       class="w-56"
                                                       placeholder="Select Standard">
                                                <option>{{ t('fees.All Standards') }}</option>
                                                <option v-for="(standard, indexs) in standards" :key="indexs"
                                                        :value="indexs">
                                                    {{ standard }}
                                                </option>
                                            </TomSelect>
                                        </div>
                                        <div class="col-span-3 flex flex-wrap md:block mx-auto">
                                            <TomSelect id="form-fee-type"
                                                       v-model="model.fee_type_id"
                                                       :options="{
                                                            allowEmptyOption: false,
                                                            create: false,
                                                            placeholder: 'All Fee Types',
                                                            autocomplete: 'off',
                                                       }"
                                                       class="w-56"
                                                       placeholder="Select Fee Type">
                                                <option>{{ t('fees.All Fee Types') }}</option>
                                                <option v-for="(feeType, indexs) in feeTypes" :key="indexs"
                                                        :value="indexs">
                                                    {{ feeType }}
                                                </option>
                                            </TomSelect>
                                        </div>
                                        <div class="col-span-3 flex flex-wrap">
                                            <input v-model="model.student_name"
                                                   :placeholder="t('fees.Student Name') + '...'"
                                                   class="form-control w-56 pr-10 w-full mr-5"
                                                   type="text" @keyup="searchMe($event)"/>
                                            <SearchIcon class="w-4 h-4 absolute my-auto inset-y-0 mr-1 right-0"/>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- BEGIN: Data List -->
                            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                                <table class="table table-hover mt-2">
                                    <thead>
                                    <tr>
                                        <th class="uppercase whitespace-nowrap" scope="col"
                                            :class="{ 'table-report__action w-56': !'id' }">
                                            <div class="flex items-center justify-between">
                                                {{ t("fees.ID") }}
                                                <span v-if="'id' === sortBy">
                                                  <ChevronUpIcon v-if="sortOrder === 'asc'"
                                                                 class="w-4 h-4 text-gray-400"></ChevronUpIcon>
                                                  <ChevronDownIcon v-else
                                                                   class="w-4 h-4 text-gray-400"></ChevronDownIcon>
                                                </span>
                                            </div>
                                        </th>
                                        <th class="uppercase whitespace-nowrap" scope="col"
                                            :class="{ 'table-report__action w-56': !'batch_id' }">
                                            <div class="flex items-center justify-between">
                                                {{ t("fees.STUDENT") }}
                                                <span v-if="'student' === sortBy">
                                                  <ChevronUpIcon v-if="sortOrder === 'asc'"
                                                                 class="w-4 h-4 text-gray-400"></ChevronUpIcon>
                                                  <ChevronDownIcon v-else
                                                                   class="w-4 h-4 text-gray-400"></ChevronDownIcon>
                                                </span>
                                            </div>
                                        </th>
                                        <th class="uppercase whitespace-nowrap" scope="col"
                                            :class="{ 'table-report__action w-56': !'batch_id' }">
                                            <div class="flex items-center justify-between">
                                                {{ t("fees.BATCH") }}
                                                <span v-if="'batch_id' === sortBy">
                                                  <ChevronUpIcon v-if="sortOrder === 'asc'"
                                                                 class="w-4 h-4 text-gray-400"></ChevronUpIcon>
                                                  <ChevronDownIcon v-else
                                                                   class="w-4 h-4 text-gray-400"></ChevronDownIcon>
                                                </span>
                                            </div>
                                        </th>
                                        <th class="uppercase whitespace-nowrap" scope="col"
                                            :class="{ 'table-report__action w-56': !'batch_id' }">
                                            <div class="flex items-center justify-between">
                                                {{ t("fees.STANDARD") }}
                                                <span v-if="'standard' === sortBy">
                                                  <ChevronUpIcon v-if="sortOrder === 'asc'"
                                                                 class="w-4 h-4 text-gray-400"></ChevronUpIcon>
                                                  <ChevronDownIcon v-else
                                                                   class="w-4 h-4 text-gray-400"></ChevronDownIcon>
                                                </span>
                                            </div>
                                        </th>
                                        <th class="uppercase whitespace-nowrap" scope="col"
                                            :class="{ 'table-report__action w-56': !'batch_id' }">
                                            <div class="flex items-center justify-between">
                                                {{ t("fees.FEE TYPE") }}
                                                <span v-if="'fee_type' === sortBy">
                                                  <ChevronUpIcon v-if="sortOrder === 'asc'"
                                                                 class="w-4 h-4 text-gray-400"></ChevronUpIcon>
                                                  <ChevronDownIcon v-else
                                                                   class="w-4 h-4 text-gray-400"></ChevronDownIcon>
                                                </span>
                                            </div>
                                        </th>
                                        <th class="uppercase whitespace-nowrap" scope="col"
                                            :class="{ 'table-report__action w-56': !'batch_id' }">
                                            <div class="flex items-center justify-between">
                                                {{ t("fees.AMOUNT") }}
                                                <span v-if="'amount' === sortBy">
                                                  <ChevronUpIcon v-if="sortOrder === 'asc'"
                                                                 class="w-4 h-4 text-gray-400"></ChevronUpIcon>
                                                  <ChevronDownIcon v-else
                                                                   class="w-4 h-4 text-gray-400"></ChevronDownIcon>
                                                </span>
                                            </div>
                                        </th>
                                        <th class="uppercase whitespace-nowrap" scope="col"
                                            :class="{ 'table-report__action w-56': !'batch_id' }">
                                            <div class="flex items-center justify-between">
                                                {{ t("fees.BALANCE") }}
                                                <span v-if="'balance' === sortBy">
                                                  <ChevronUpIcon v-if="sortOrder === 'asc'"
                                                                 class="w-4 h-4 text-gray-400"></ChevronUpIcon>
                                                  <ChevronDownIcon v-else
                                                                   class="w-4 h-4 text-gray-400"></ChevronDownIcon>
                                                </span>
                                            </div>
                                        </th>
                                        <th class="uppercase whitespace-nowrap" scope="col"
                                            :class="{ 'table-report__action w-56': !'batch_id' }">
                                            <div class="flex items-center justify-between">
                                                {{ t("fees.STATUS") }}
                                                <span v-if="'status' === sortBy">
                                                  <ChevronUpIcon v-if="sortOrder === 'asc'"
                                                                 class="w-4 h-4 text-gray-400"></ChevronUpIcon>
                                                  <ChevronDownIcon v-else
                                                                   class="w-4 h-4 text-gray-400"></ChevronDownIcon>
                                                </span>
                                            </div>
                                        </th>
                                        <th class="uppercase whitespace-nowrap" scope="col"
                                            :class="{ 'table-report__action w-56': !'batch_id' }">
                                            <div class="flex items-center justify-between">
                                                {{ t("common.ACTION") }}
                                            </div>
                                        </th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <template v-if="items">
                                        <tr v-for="(item, index) in items.data"
                                            :key="index"
                                            class="intro-x">
                                            <td class="whitespace-nowrap">
                                                <div class="flex items-center">
                                                    {{ item.id }}
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap">
                                                <div class="flex items-center">
                                                    {{ item.student }}
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap">
                                                <div class="flex items-center">
                                                    {{ item.batch }}
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap">
                                                <div class="flex items-center">
                                                    {{ item.standard }}
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap">
                                                <div class="flex items-center">
                                                    {{ item.fee_type }}
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap">
                                                <div class="flex items-center">
                                                    {{ item.amount_to_pay }}
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap">
                                                <div class="flex items-center">
                                                    {{ item.balance }}
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <button v-if="item.status === 'Un-Paid'"
                                                            class="btn btn-danger-soft">
                                                        {{ item.status }}
                                                    </button>

                                                    <button v-if="item.status === 'Paid'" class="btn btn-success-soft">
                                                        {{ item.status }}
                                                    </button>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="flex items-center">

                                                    <template v-if="item.balance !== 0">
                                                        <a class="flex items-center mr-3" href="javascript:;"
                                                           @click.prevent="payNow(item)">
                                                            <CheckSquareIcon class="w-4 h-4 mr-1"/>
                                                            {{ t("fees.Pay Now") }}
                                                        </a>
                                                    </template>
                                                    <a class="flex items-center mr-3" href="javascript:;"
                                                       @click.prevent="paymentHistory(item)">
                                                        <CheckSquareIcon class="w-4 h-4 mr-1"/>
                                                        {{ t("fees.Payment History") }}
                                                    </a>

                                                </div>
                                            </td>
                                        </tr>
                                    </template>

                                    </tbody>
                                    <template v-if="items">
                                        <tbody v-if="noRecords && !items.data.length">
                                        <tr class="intro-x bg-secondary">
                                            <td colspan="8" class="text-center">
                                                {{ t("common.Sorry, no records found") }}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </template>


                                </table>
                            </div>
                            <!-- END: Data List -->
                            <!-- BEGIN: Pagination -->

                            <Pagination
                                :currentPage="currentPage"
                                :links="links"
                                @paginate="getForPage"
                                @perpage="perPageValue"/>
                            <!-- END: Pagination -->
                            <!-- BEGIN: Modal Content For Paynow -->
                            <Modal :show="showPayNowPreview"
                                   size="modal-lg"
                                   backdrop="static"
                                   :slideOver="true"
                                   @hidden="showPayNowPreview = false">
                                <a
                                    @click.prevent="showPayNowPreview = false"
                                    class="absolute top-0 left-0 right-auto mt-4 -ml-12"
                                    href="javascript:;"
                                >
                                    <XIcon class="w-8 h-8 text-slate-400"/>
                                </a>
                                <ModalHeader>
                                    <h2 class="font-medium text-base mr-auto">
                                        {{ t("fees.Pay") }}
                                    </h2>
                                </ModalHeader>
                                <!--                                <CustomeAlert v-if="responseMessage"
                                                                              :errors="responseErrors"
                                                                              :message="responseMessage"
                                                                              :status="responseStatus"
                                                                              class="col-span-12 sm:col-span-6 flex"/>-->
                                <ModalBody class="grid grid-cols-12 gap-4 gap-y-3 intro-y">
                                    <!-- BEGIN: Transaction Details -->
                                    <div class="col-span-12 lg:col-span-12 2xl:col-span-12">
                                        <div class="p-5 rounded-md box">
                                            <div
                                                class="flex items-center pb-5 mb-5 border-b border-slate-200/60 dark:border-darkmode-400"
                                            >
                                                <div class="text-base font-medium truncate">{{ t('fees.Payment Details') }}</div>
                                                <!--                                                    <a href="" class="flex items-center ml-auto text-primary">
                                                                                                        <Lucide icon="Edit" class="w-4 h-4 mr-2" /> Change Status
                                                                                                    </a>-->
                                            </div>
                                            <div class="flex items-center">
                                                <div class="flex font-medium">
                                                    {{ t('fees.Student Name') }}:
                                                </div>
                                                <div class="ml-2">
                                                    <a href="" class="underline decoration-dotted">
                                                        {{ payHistory ? payHistory.student : "" }}
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="flex items-center mt-3">
                                                <div class="flex font-medium">
                                                    {{ t('fees.Batch') }}:
                                                </div>
                                                <div class="ml-2">{{ payHistory ? payHistory.batch : "" }}</div>
                                            </div>
                                            <div class="flex items-center mt-3">
                                                <div class="flex font-medium">
                                                    {{ t('fees.Standard') }}:
                                                </div>
                                                <div class="ml-2">{{ payHistory ? payHistory.standard : "" }}</div>
                                            </div>
                                        </div>

                                        <div class="p-5 rounded-md box">
                                            <form class="validate-form" @submit.prevent="submitForm">
                                                <div
                                                    class="flex items-center pb-5 mb-5 border-b border-slate-200/60 dark:border-darkmode-400"
                                                >
                                                    <div class="text-base font-medium truncate">{{ t('fees.Amount to Pay') }}</div>
                                                </div>
                                                <div class="flex items-center mt-3">
                                                    {{ t('fees.Total Amount') }}:
                                                    <div class="ml-auto">{{
                                                            payHistory ? payHistory.total_amount : ''
                                                        }}
                                                    </div>
                                                </div>

                                                <div class="flex items-center mt-3">
                                                    {{ t('fees.Total Discounts') }}:
                                                    <div class="ml-auto">{{
                                                            discountsForStudent ? discountsForStudent['total_discounts'] : ''
                                                        }}
                                                    </div>
                                                </div>
                                                <div class="flex items-center mt-3">
                                                    {{ t('fees.Balance') }}:
                                                    <div class="ml-auto">{{
                                                            payHistory ? payHistory.balance : ''
                                                        }}
                                                    </div>
                                                </div>
                                                <div class="flex items-center mt-3"
                                                     v-if="payHistory && discountsForStudent">
                                                    {{ t('fees.Amount to Pay') }}:
                                                    <div class="ml-auto">
                                                        <template
                                                            v-if="payHistory.balance > discountsForStudent['total_discounts']">
                                                            {{
                                                                payHistory.balance - discountsForStudent['total_discounts']
                                                            }}
                                                        </template>
                                                        <template v-else>0</template>
                                                    </div>
                                                </div>

                                                <div class="flex items-center">
                                                    {{ t('fees.Payment Method') }}:

                                                    <div class="ml-auto flex w-40">
                                                        <template v-if="transactionModel.payment_method === 'cheque'">
                                                            <input placeholder="Enter cheque number" type="text"
                                                                   class="form-control" v-model="transactionModel.uid"/>
                                                        </template>
                                                        <template v-if="transactionModel.payment_method === 'upi'">
                                                            <input placeholder="Enter transaction number" type="text"
                                                                   class="form-control" v-model="transactionModel.uid"/>
                                                        </template>
                                                    </div>
                                                    <div class="flex ml-2 w-60">
                                                        <TomSelect id="form-payment-method"
                                                                   v-model="transactionModel.payment_method"
                                                                   :options="{
                                                                        allowEmptyOption: false,
                                                                        create: false,
                                                                        placeholder: 'Select Payment Method',
                                                                        autocomplete: 'off',
                                                                      }"
                                                                   :placeholder="'Select Payment Method'"
                                                                   class="w-full">
                                                            <option>{{ t('fees.Select method') }}</option>
                                                            <option value="cash" selected>{{ t('fees.Cash') }}</option>
                                                            <option value="cheque">{{ t('fees.Cheque') }}</option>
                                                            <option value="upi">{{ t('fees.UPI') }}</option>
                                                        </TomSelect>
                                                    </div>
                                                </div>
                                                <div
                                                    class="flex items-center pt-5 mt-5 font-medium border-t border-slate-200/60 dark:border-darkmode-400"
                                                >
                                                    {{ t('fees.Amount') }}:
                                                    <div class="ml-auto">
                                                        <input type="number"
                                                               v-model="transactionModel.amount"
                                                               class="form-control"
                                                               placeholder="Amount paying"
                                                               @blur.prevent="autoFillAmounts"
                                                        />
                                                    </div>
                                                </div>
                                                <div
                                                    class="flex items-center pt-5 mt-5 font-medium border-t border-slate-200/60 dark:border-darkmode-400"
                                                >

                                                    <div class="ml-auto">
                                                        <button class="btn btn-primary" type="submit">{{ t('fees.Pay Now') }}</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="p-5 rounded-md box">
                                            <div
                                                class="flex items-center pb-5 mb-5 border-b border-slate-200/60 dark:border-darkmode-400"
                                            >
                                                <div class="text-base font-medium truncate">{{ t('fees.Fee Structure') }}</div>
                                            </div>
                                            <div class="overflow-auto lg:overflow-visible">
                                                <table class="table striped">
                                                    <tr>
                                                        <th class="whitespace-nowrap">{{ t('fees.Fee Structure Name') }}</th>
                                                        <th class="text-right whitespace-nowrap">{{ t('fees.Amount') }}</th>
                                                        <th class="text-right whitespace-nowrap">{{ t('fees.Amount To Pay') }}
                                                        </th>
                                                    </tr>
                                                    <tbody>
                                                    <template v-if="studentFeeStructure">
                                                        <tr
                                                            v-for="(feeStructure, key) in studentFeeStructure.data"
                                                            :key="key"
                                                        >
                                                            <td class="whitespace-nowrap">{{
                                                                    feeStructure.fee_category
                                                                }}
                                                            </td>
                                                            <td class="text-right">{{ feeStructure.amount }}</td>
                                                            <td class="text-right">
                                                                <div :id="'fee-structure-'+key">
                                                                    <template v-if="transactionModel.amount">
                                                                        {{
                                                                            calculatedAmounts[feeStructure.fee_category]
                                                                        }}
                                                                    </template>
                                                                    <template v-else>
                                                                        -
                                                                    </template>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </template>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="p-5 rounded-md box">
                                            <div
                                                class="flex items-center pb-5 mb-5 border-b border-slate-200/60 dark:border-darkmode-400"
                                            >
                                                <div class="text-base font-medium truncate">{{ t('fees.Discounts Available') }}</div>
                                            </div>
                                            <div class="overflow-auto lg:overflow-visible">
                                                <table class="table striped">
                                                    <template v-if="discountsForStudent">
                                                        <tr
                                                            v-for="(discount, key) in discountsForStudent"
                                                            :key="key"
                                                        >
                                                            <template v-if="key !== 'total_discounts'">
                                                                <td class="text-left">{{ key }}</td>
                                                                <td class="text-left">{{ discount }}</td>
                                                            </template>

                                                        </tr>
                                                    </template>

                                                </table>
                                            </div>
                                        </div>
                                        <!--                                        <AccordionGroup class="accordion-boxed">
                                                                                    <AccordionItem>
                                                                                        <Accordion>
                                                                                            Fees Structure
                                                                                        </Accordion>
                                                                                        <AccordionPanel
                                                                                            class="text-slate-600 dark:text-slate-500 leading-relaxed"
                                                                                        >
                                        vcxxcv
                                                                                        </AccordionPanel>
                                                                                    </AccordionItem>
                                                                                    <AccordionItem>
                                                                                        <Accordion>
                                                                                            Available Discounts
                                                                                        </Accordion>
                                                                                        <AccordionPanel
                                                                                            class="text-slate-600 dark:text-slate-500 leading-relaxed"
                                                                                        >
                                        xcvxcvxccvbcvbcbc
                                                                                        </AccordionPanel>
                                                                                    </AccordionItem>
                                                                                </AccordionGroup>-->
                                    </div>
                                    <!-- END: Transaction Details -->
                                </ModalBody>
                                <ModalFooter>
                                    <button id="import-export-cancel-button"
                                            class="btn btn-outline-secondary w-20 mr-1"
                                            type="button"
                                            @click="showPayNowPreview = false">
                                        {{ t("common.Cancel") }}
                                    </button>
                                    <!-- <button type="button" class="btn btn-primary w-20">
                                        {{ t("permissions.Import") }}
                                        </button> -->
                                </ModalFooter>
                            </Modal>
                            <!-- END: Modal Content -->
                            <!-- BEGIN: Modal Content For Transaction -->
                            <Modal :show="showTransactionHistory"
                                   size="modal-xl"
                                   @hidden="showTransactionHistory = false">
                                <ModalHeader>
                                    <h2 class="font-medium text-base mr-auto">
                                        {{ t("fees.Transaction List") }}
                                    </h2>
                                </ModalHeader>
                                <ModalBody class="grid grid-cols-12 gap-4 gap-y-3 intro-y">
                                    <template v-if="studentFeeTransactions">
                                        <div class="col-span-12 lg:col-span-12 2xl:col-span-12">
                                            <div class="p-5 rounded-md box">

                                                <div class="flex items-center">
                                                    <div class="flex font-medium">
                                                        {{ t('fees.Student Name') }}:
                                                    </div>
                                                    <div class="ml-2">
                                                        <a href="" class="underline decoration-dotted">
                                                            {{ payHistory ? payHistory.student : "" }}
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="flex items-center mt-3">
                                                    <div class="flex font-medium">
                                                        {{ t('fees.Batch') }}:
                                                    </div>
                                                    <div class="ml-2">{{ payHistory ? payHistory.batch : "" }}</div>
                                                </div>
                                                <div class="flex items-center mt-3">
                                                    <div class="flex font-medium">
                                                        {{ t('fees.Standard') }}:
                                                    </div>
                                                    <div class="ml-2">{{ payHistory ? payHistory.standard : "" }}</div>
                                                </div>
                                            </div>
                                            <!-- BEGIN: Transaction Details -->
                                            <div class="grid grid-cols-12 gap-6 mt-2">

                                                <!-- BEGIN: Data List -->
                                                <div class="intro-y col-span-12 overflow-auto 2xl:overflow-visible">
                                                    <table class="table table-report -mt-2">
                                                        <thead>
                                                        <tr>
                                                            <th class="whitespace-nowrap">INVOICE</th>
                                                            <th class="whitespace-nowrap">AMOUNT</th>
                                                            <th class="whitespace-nowrap">PAYMENT METHOD</th>
                                                            <th class="whitespace-nowrap">UID</th>
                                                            <th class="whitespace-nowrap">PAID ON</th>
                                                            <th class="whitespace-nowrap">ACTIONS</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr v-for="(transaction, id) in studentFeeTransactions.data" :key="id">
                                                            <td class="whitespace-nowrap">#{{ transaction.id }}</td>
                                                            <td class="whitespace-nowrap">{{ transaction.amount }}</td>
                                                            <td class="whitespace-nowrap">{{ transaction.method}}</td>
                                                            <td class="whitespace-nowrap">{{ transaction.uid ? transaction.uid: '-' }}</td>
                                                            <td class="whitespace-nowrap">{{ transaction.created_on}}</td>
                                                            <td class="text-center whitespace-nowrap">
                                                                <div class="flex items-center">

                                                                    <a class="btn flex items-center mr-3"
                                                                       href="#"
                                                                       @click.prevent="showTransaction(transaction)">
                                                                        <PrinterIcon class="w-4 h-4 mr-1" />Receipt
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- END: Data List -->
                                            </div>
                                            <!-- END: Transaction Details -->
                                        </div>
                                    </template>
                                </ModalBody>
                            </Modal>
                            <Modal :show="showInvoiceModal"
                                   size="modal-xl"
                                   @hidden="showInvoiceModal = false">
                                <ModalHeader>
                                    <h2 class="font-medium text-base mr-auto">
                                        {{ t("fees.Invoice") }}
                                    </h2>
                                </ModalHeader>
                                <ModalBody class="intro-y box overflow-hidden mt-5">
                                    <div id="div-to-print" v-if="printTransaction">
                                        <div
                                            class="border-b border-slate-200/60 dark:border-darkmode-400 text-center sm:text-left"
                                        >
                                            <div class="border-b-4 border-t-4">
                                                <div class="flex flex-col lg:flex-row px-5 pt-10 pb-10">
                                                    <div class="w-20 h-10 zoom-in flex">
                                                        <img
                                                            :alt="'Meritest'"
                                                            :src='printTransaction.logo'
                                                        />
                                                    </div>
                                                    <div class="text-primary font-semibold text-3xl lg:text-center mt-10 lg:mt-0 lg:ml-auto text-center">

                                                        <div class="text-base text-slate-500">ERA Kids A Play School</div>
                                                        <div class="text-lg font-medium text-primary mt-2"> Sumthana</div>
                                                        <div class="mt-1">era@gmail.com</div>
                                                    </div>
                                                    <div class="lg:text-right mt-10 lg:mt-0 lg:ml-auto">
                                                        Sumthana
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex flex-col lg:flex-row px-5 pt-10 pb-10">
                                                <div>
                                                    <div class="mt-2">
                                                        Receipt: <span class="font-medium">#{{ printTransaction.id }}</span>
                                                    </div>
                                                </div>
                                                <div class="lg:text-right mt-10 lg:mt-0 lg:ml-auto">
                                                    <div class="text-base text-slate-500">Date: {{ printTransaction.created_on }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="px-5 sm:px-16 py-10 sm:py-20">
                                            <div class="overflow-x-auto">
                                            </div>
                                            <p>Received with thanks from Mast/Miss <strong>{{ payHistory ? payHistory.student : "" }}</strong> Class: <strong>{{ payHistory ? payHistory.standard : "" }}</strong> Session: {{ payHistory ? payHistory.batch : ""}} Installment: First/Second/Third The Sum Rupees {{ printTransaction.amount }} by Cash/Cheque No. Drawn on ---- Balance Amount ____.</p>
                                        </div>
                                        <div class="px-5 sm:px-20 pb-10 sm:pb-20 flex flex-col-reverse sm:flex-row">
                                            <div class="text-center sm:text-left mt-10 sm:mt-0">
                                                <div class="text-base text-slate-500">Bank Transfer</div>
                                                <div class="text-lg text-primary font-medium mt-2">Elon Musk</div>
                                                <div class="mt-1">Bank Account : 098347234832</div>
                                                <div class="mt-1">Code : LFT133243</div>
                                            </div>
                                            <div class="text-center sm:text-right sm:ml-auto">
                                                <div class="text-base text-slate-500">Total Amount</div>
                                                <div class="text-xl text-primary font-medium mt-2">$20.600.00</div>
                                                <div class="mt-1">Taxes included</div>
                                            </div>
                                        </div>
                                    </div>
                                </ModalBody>
                            </Modal>
                            <!-- END: Modal Content -->
                            <Loading v-if="loading" fixed></Loading>
                        </div>
                    </div>
                </div>
                <!-- END: HTML Table Data -->
            </div>
            <!-- END: Fee Content -->
        </div>
    </div>
</template>

<script setup>
import {ref, onMounted, computed, reactive, watch} from "vue";

import {useVuelidate} from "@vuelidate/core";
import {required, helpers} from "@vuelidate/validators";

import store from "@/stores";

import {useI18n} from "vue-i18n";
import _ from "lodash";
import axiosClient from "@/axios";
import {AccordionGroup} from "@/global-components/accordion";

// To show/hide modal
const showPayNowPreview = ref(false);
const showTransactionHistory = ref(false);

const options = {
    modelName: "FeeDiscount",
};

const {t} = useI18n();

// End of info

// Variables and actions related to Add/Edit.
let isEdit = ref(false);
let actionText = ref("Add");
let submitted = ref(false);
let message = ref("");
let isErrored = ref(false);
let selectedItem = ref("");

let model = ref({
    batch_id: "",
    standard_id: "",
    fee_type_id: "",
    student_name: "",
});

const transactionModel = ref({
    fee_id: '',
    uid: '',
    payment_method: '',
    amount: '',
});

const rules = computed(() => {
    return {
        payment_method: {
            required: helpers.withMessage(
                "Please select payment method.",
                required
            ),
        },
        amount: {
            required: helpers.withMessage(
                "Please enter amount.",
                required
            ),
        },
    };
});

const v$ = useVuelidate(rules, transactionModel.value);
const checkFeeBalance = ref("");

async function submitForm() {
    // Firstly check if user have made all the payments.
    checkFeeBalance.value = JSON.parse(JSON.stringify(
        await axiosClient
            .get('/check_fee_balance/' + transactionModel.value.fee_id)
            .then(function (data) {
                return data.data;
            })
    ));
    if (checkFeeBalance.value.balance !== 0) {
        submitted.value = true;
        v$.value.$validate(); // checks all inputs

        if (!v$.value.$error) {
            //loading.value = true;

            await store
                .dispatch("fee_transactions/save", transactionModel.value)
                .then(() => {
                    showPayNowPreview.value = false;
                    isErrored.value = false;
                    message.value = "";
                    submitted.value = false;
                })
                .catch((err) => {
                    isErrored.value = true;
                    if (err.response) {
                        message.value = err.response.data.message;
                    }

                });

            //loading.value = false;
        } else {
            // if ANY fail validation
            return;
        }
    } else {
        showPayNowPreview.value = false;
        alert('You have already made all the payments.');
    }

}

// END: Delete
const noRecords = ref(false);
const datatableoptions = computed(
    () => store.getters["fees/datatable"]
);

const items = computed(() => {
    let records = store.getters["fees/fees"];

    if (records.data && parseInt(records.data.length) < 1) {
        noRecords.value = true;
    }
    return records;
});

const links = computed(() => store.getters["fees/meta"]);
const currentPage = ref(datatableoptions.value.defaultPage);

const perPageOptions = [10, 20, 30, 40, 50];
const fetchUrl = ref("");
const loading = ref(false);

const urlParams = reactive({
    column: datatableoptions.value.defaultColumn,
    order: datatableoptions.value.defaultOrder,
    page: datatableoptions.value.defaultPage,
    search: datatableoptions.value.defaultSearch,
    perpage: datatableoptions.value.defaultPerPage,
});

const url = ref(
    "?page=" +
    urlParams.page +
    "&sort_field=" +
    urlParams.column +
    "&sort_order=" +
    urlParams.order +
    "&search=" +
    urlParams.search +
    "&per_page=" +
    urlParams.perpage
);

// Watch to current url parameters change and when this happens we update local url
watch(
    () => _.cloneDeep(urlParams),
    (newVal, oldVal) => {
        url.value =
            "?page=" +
            urlParams.page +
            "&sort_field=" +
            urlParams.column +
            "&sort_order=" +
            urlParams.order +
            "&search=" +
            urlParams.search +
            "&per_page=" +
            urlParams.perpage;
        fetchList();
    }
);

onMounted(() => {
    store.dispatch("listStandard").then().catch();
    store.dispatch("listFeeTypes").then().catch();
    fetchList();
});
const standards = computed(() => store.getters.listStandards);
const feeTypes = computed(() => store.getters.listFeeTypes);

function fetchList() {
    loading.value = true;
    /*if (props.showData) {
        url.value += "&item=" + props.showData;
    }*/
    store
        .dispatch("fees/list", {url: url.value})
        .then(() => {
            loading.value = false;
        })
        .catch();
}

function getForPage(page) {
    if (page === "Next &raquo;") {
        urlParams.page = parseInt(urlParams.page) + 1;
    } else if (page === "&laquo; Previous" && parseInt(urlParams.page) > 1) {
        urlParams.page = parseInt(urlParams.page) - 1;
    } else {
        urlParams.page = page;
    }
}

function perPageValue(value) {
    urlParams.perpage = value;
}

// Begin: Sorting related
let sortBy = ref("id");
let sortOrder = ref("desc");

function sorting(field) {
    if (field === sortBy.value) {
        sortOrder.value = sortOrder.value === "asc" ? "desc" : "asc";
    } else {
        sortBy.value = field;
        sortOrder.value = "asc";
    }
    urlParams.column = sortBy.value;
    urlParams.order = sortOrder.value;
}

//End: Sorting

// Begin: Searching
const search = ref("");

function searchMe(event) {
    urlParams.search = search.value;
    //console.log(event)
}

// End: Searching

const payHistory = ref();
const studentFeeStructure = ref();
const discountsForStudent = ref();

async function payNow(item) {
    showPayNowPreview.value = true;
    payHistory.value = JSON.parse(JSON.stringify(item));
    transactionModel.value.fee_id = item.id;
    // First get list of all the fee structures.
    studentFeeStructure.value = JSON.parse(JSON.stringify(
        await axiosClient
            .get('/fee_structure_list/' + item.standard_id + '/' + item.batch_id + '/' + item.fee_type_id)
            .then(function (data) {
                return data.data;
            })
    ));
    // If student is regular, then only check for discounts available.
    if (item.fee_type_id === 4) {
        // Get list of all the discounts available.
        discountsForStudent.value = JSON.parse(JSON.stringify(
            await axiosClient
                .get('/student_discounts/' + item.student_id)
                .then(function (data) {
                    return data.data;
                })
        ));
    }

}

const calculatedAmounts = ref({});
const cal = ref("");

function autoFillAmounts() {
    cal.value = transactionModel.value.amount;
    JSON.parse(JSON.stringify(studentFeeStructure.value.data)).forEach(function (item, index) {
        if (cal.value >= item.amount) {
            calculatedAmounts.value[item.fee_category] = item.amount;
        } else {
            calculatedAmounts.value[item.fee_category] = cal.value > 0 ? cal.value : 0;
        }
        cal.value -= item.amount;
    });
}
const studentFeeTransactions = ref();
async function paymentHistory(item) {
    showTransactionHistory.value = true;
    payHistory.value = JSON.parse(JSON.stringify(item));
    studentFeeTransactions.value = JSON.parse(JSON.stringify(
        await axiosClient
            .get('/fee_transactions?fee_id=' + item.id)
            .then(function (data) {
                return data.data;
            })
    ));
}
const downloadFileName = ref();

const form = {
    export_as: ""
}

async function exportMe(export_as, transaction) {
    const demo = ref(false);

    let todayDate = new Date();

    let name = "Transaction-" + todayDate.getDate() + "-"
        + (todayDate.getMonth() + 1) + "-"
        + todayDate.getFullYear() + "-"
        + todayDate.getHours() + "-"
        + todayDate.getMinutes() + "-"
        + todayDate.getSeconds();

    downloadFileName.value = name + "." + export_as;

    const req = {
        fileName: downloadFileName.value,
        modelName: "FeeTransaction",
        selectedItem: transaction.id,
        demo: false,
    };

    await store.dispatch('exportMe', req)
        .then((response) => {
            if (response.status === 200) {
                form.export_as = "";
                var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                var fileLink = document.createElement("a");
                fileLink.href = fileURL;
                fileLink.setAttribute("download", downloadFileName.value);
                //fileLink.setAttribute('target', '_blank');
                document.body.appendChild(fileLink);
                fileLink.click();
            }
        })
        .catch();
}
const showInvoiceModal = ref(false);
const printTransaction = ref();
function showTransaction(transaction)
{
    showInvoiceModal.value = true;
    printTransaction.value = JSON.parse(JSON.stringify(transaction));
    setTimeout(function() {window.print();}, 1500);
}
</script>

<style scoped>
/*.accordion .accordion-item:first-of-type {
    display: none;
}*/

</style>
