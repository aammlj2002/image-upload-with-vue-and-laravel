<template>
    <file-pond
        class="mt-5"
        name="image"
        ref="pond"
        label-idle="click to choose iamge or drage here..."
        @init="filepondInitialized"
        accepted-file-types="image/*"
    />
</template>

<script>
import "filepond/dist/filepond.min.css"
import VueFilePond, { setOptions } from 'vue-filepond';
setOptions({
    server: {
        process: {
            url: './upload',
            headers: {
                'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf_token"]').content
            }
        }
    },
});

import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
const FilePond = VueFilePond(FilePondPluginFileValidateType);
export default {
    components: {
        FilePond
    },
    data() {
        return {
        }
    },
    methods: {
        filepondInitialized() {
            console.log("filepond");
            console.log("filepond Object", this.$refs.pond)
        }
    }
}
</script>

<style>
</style>