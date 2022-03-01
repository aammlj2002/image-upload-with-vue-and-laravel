<template>
    <div>
        <div>
            <file-pond
                class="mt-5"
                name="image"
                ref="pond"
                label-idle="click to choose iamge or drage here..."
                @init="filepondInitialized"
                accepted-file-types="image/*"
                @processfile="handleProcessesFile"
            />
        </div>
        <div class="mt-8 mb-24">
            <div class="text-2xl font-medium text-center">Image Gallery</div>
            <div class="grid grid-cols-3 gap-2 justify-evenly mt-4">
                <div v-for="(image, index) in images" :key="index">
                    <img :src="`/storage/images/${image}`" />
                </div>
            </div>
        </div>
    </div>
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
            images: []
        }
    },
    mounted() {
        axios.get("/images")
            .then((response) => {
                this.images = response.data;
            })
            .catch((error) => {
                console.error(error)
            })
    },
    methods: {
        filepondInitialized() {
            console.log("filepond");
            console.log("filepond Object", this.$refs.pond)
        },
        handleProcessesFile(error, file) {
            if (error) {
                console.log(error);
                return;
            }
            this.images.unshift(file.serverId);
        }
    }
}
</script>

<style>
</style>