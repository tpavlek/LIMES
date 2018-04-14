<template>
    <div>
        <label for="image" class="mx-auto mb-2 block w-32 h-32 bg-grey-lighter text-grey border-2 border-grey border-dashed flex flex-col justify-center align-center">
            <span v-show="!fileAdded" class="mx-auto p-2 flex-grow"><span class="fas fa-plus text-3xl"></span></span>
            <span v-show="!fileAdded" class="p-2 text-center text-xl">Add an Image</span>
            <span v-show="fileAdded" class="p-2 text-center"><span class="text-4xl fas fa-check-circle"></span></span>
        </label>
        <input id="image" name="image" type="file" accept="image/*" class="hidden" @change="changeLabel" />
    </div>
</template>

<script>
    export default {
        data() {
            return {
                fileAdded: false
            }
        },
        methods: {
            changeLabel() {
                this.fileAdded = true;
            }
        }
    }
</script>
