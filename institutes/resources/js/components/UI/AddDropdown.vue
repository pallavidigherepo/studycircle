<template>
    <div class="dropdown">
        <button
            class="dropdown-toggle btn px-2 box text-gray-700 dark:text-gray-300"
            aria-expanded="false"
        >
            <span class="w-5 h-5 flex items-center justify-center">
                <PlusIcon class="w-4 h-4" />
            </span>
        </button>
        <div class="dropdown-menu w-40">
            <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                <a
                    href=""
                    class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"
                >
                    <PrinterIcon class="w-4 h-4 mr-2" /> Print
                </a>
                <a
                    href=""
                    class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"
                >
                    <DownloadCloudIcon class="w-4 h-4 mr-2" /> Import
                </a>
                <a
                    href=""
                    class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"
                >
                    <UploadCloudIcon class="w-4 h-4 mr-2" /> Export to Excel
                </a>
            </div>
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style>

</style>