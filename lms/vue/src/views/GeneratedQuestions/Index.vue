<template>
    <div>
        <template v-if="listing">
            <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                <h2 class="text-lg font-medium mr-auto">
                    {{ t("templates.Generated Question Papers") }}
                </h2>
            </div>
            <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
                <!-- BEGIN: Datatable Content -->
                <div class="intro-y col-span-12 lg:col-span-12">
                    <!-- BEGIN: HTML Table Data -->

                    <div class="intro-y box p-5">
                        <div class="overflow-x-auto scrollbar-hidden">
                            <Datatable
                                module="generated_questions"
                                :importExportOptions="options"
                                @showItem="show"
                                @editItem="edit"
                                @deleteItem="deleteI"
                                @addModel="add"
                            >
                                <template v-slot:info>

                                </template>

                            </Datatable>
                        </div>
                    </div>
                    <!-- END: HTML Table Data -->
                </div>
                <!-- END: Datatable Content -->
            </div>
        </template>
        <template v-else>
            <router-view></router-view>
        </template>
    </div>
</template>

<script setup>
import { ref, onMounted, computed, watch } from "vue";
import { useI18n } from "vue-i18n";
import { useRoute, useRouter } from "vue-router";
import store from "@/stores";

const route = useRoute();
const router = useRouter();

const options = {
    modelName: "Template",
};
const { t } = useI18n();
const listing = ref(true);

onMounted(() => {
    if (
        route.name == "CreateTemplate" ||
        route.name == "EditTemplate" ||
        route.name == "ShowTemplate" ||
        route.name == "PaperGenerator"
    ) {
        listing.value = false;
    }
});

watch(
    () => route.name,
    (to, from) => {
        if (to === "GeneratedQuestionPapers") {
            listing.value = true;
        }
    }
);

function add() {
    listing.value = false;
    router.push({ name: "CreateTemplate" });
}

function edit(item) {
    listing.value = false;
    router.push({
        name: "EditTemplate",
        params: { id: item.id },
    });
}

function show(item) {
    listing.value = false;
    router.push({
        name: "ShowTemplate",
        params: { id: item.id },
    });
}

function deleteI(item) {
    store.dispatch("templates/delete", item.id);
}
</script>

<style scoped>
</style>
