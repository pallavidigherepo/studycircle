import { ref } from 'vue';
import store from '@/stores';

export default function useImportExport(options) {
    const downloadFileName = ref('');
    const modelName = options.modelName;
    const responseStatus = ref(false);
    const responseMessage = ref('');

    const form = {
        export_as: ""
    }

    const import_file = ref({});

    function importMe(e) {
        responseStatus.value = false;
        responseMessage.value = '';

        import_file.value = e.target.files[0];

        var allowedExtensions =
            import.meta.env.VITE_IMPORTS_ALLOWED.split(",");

        if (allowedExtensions.includes(e.target.files[0]["type"])) {
            proceedAction();
        } else {
            responseStatus.value = false;
            responseMessage.value = "Wrong file type.";
        }
        //console.log(import_file.value.size);
    }

    function proceedAction() {
        let formData = new FormData();
        formData.append("modelName", modelName);
        formData.append("import_file", import_file.value);
        if (options.selectedItem) {
            formData.append('selectedItem', options.selectedItem);
        }
        store
            .dispatch("importMe", formData)
            .then((res) => {
                responseStatus.value = res.data.success;
                responseMessage.value = res.data.message;
                import_file.value = {};
            })
            .catch((error) => {
                //error.response.data;
            });
    }

    async function exportMe(export_as, isDemo) {
        const demo = ref(false);

        if (!isDemo) {
            downloadFileName.value = modelName + "." + export_as;
        } else {
            downloadFileName.value = "Template for " + modelName + "." + export_as;
            demo.value = true;
        }
        const req = {
            fileName: downloadFileName.value,
            modelName: modelName,
            selectedItem: options.selectedItem ? options.selectedItem : "",
            demo: demo.value
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

    // Begin: Download demo
    async function downloadDemo() {
        downloadFileName.value = modelName + ".xls";

        const req = {
            fileName: downloadFileName.value,
            modelName: modelName,
        };
        await store.dispatch('downloadDemo', req)
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
    // End: Download demo
    return {
        importMe,
        exportMe,
        downloadDemo,
        responseStatus,
        responseMessage,

    }
}