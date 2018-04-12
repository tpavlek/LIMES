<template>
    <div>
        <button v-show="!showingForm" @click="showForm" class="bg-green-dark hover:bg-green-darker text-white px-4 py-2 border-green-darkest text-xl leading-loose shadow rounded mb-4">
            <span class="fas fa-comment"></span> Say Hello
        </button>
        <div v-show="showingLoginForm">
            <h3 class="mb-2">Do you want to:</h3>
            <button class="block mx-auto bg-green-dark hover:bg-green-darker text-white px-4 py-2 border border-green-dark text-xl leading-loose shadow rounded mb-4">
                <span class="fas fa-comment mr-2"></span> Create an Account
            </button>

            <button @click="showPostForm" class="block mx-auto px-4 py-2 border border-green-dark text-xl leading-loose rounded mb-4">
                Post Anonymously
            </button>
        </div>

        <div v-show="showingPostForm">
            <div class="pt-8 border-b border-l border-r shadow mx-4 bg-white px-4 mb-4 relative z-10">
                <form method="post" :action="postAction" enctype="multipart/form-data">
                    <template v-if="!authenticated">
                        <div class="text-left">
                            <label for="display_name" class="tracking wide font-bold text-sm text-grey-dark">DISPLAY NAME</label>
                            <input type="text" id="display_name" name="display_name" placeholder="Display Name" class="my-2 bg-grey-light p-2 rounded w-full" />
                        </div>
                    </template>

                    <textarea class="bg-grey-light p-2 rounded w-full h-32 mb-2" id="body" name="body" title="Write your post..." placeholder="Write your post..."></textarea>

                    <label for="image" class="mx-auto mb-2 block w-32 h-32 bg-grey-lighter text-grey border-2 border-grey border-dashed flex flex-col justify-center align-center">
                        <span v-show="!fileAdded" class="mx-auto p-2 flex-grow"><span class="fas fa-plus text-3xl"></span></span>
                        <span v-show="!fileAdded" class="p-2 text-xl">Add an Image</span>
                        <span v-show="fileAdded" class="p-2 text-center"><span class="text-4xl fas fa-check-circle"></span></span>
                    </label>
                    <input id="image" type="file" accept="image/*" class="hidden" @change="changeLabel" />

                    <input type="submit" value="Post" class="bg-green-dark hover:bg-green-darker text-white px-4 py-2 border-green-darkest text-xl leading-loose shadow rounded mb-4" />
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [ 'authenticated', 'postAction'],
        data() {
            return {
                showingLoginForm: false,
                showingPostForm: false,
                fileAdded: false,
            }
        },
        methods: {
            showForm() {
                if (! this.authenticated) {
                    this.showingLoginForm = true;
                } else {
                    this.showingPostForm = true;
                }
            },
            showPostForm() {
                this.showingLoginForm = false;
                this.showingPostForm = true;
            },
            changeLabel() {
                this.fileAdded = true;
            }
        },
        computed: {
            showingForm() {
                return this.showingLoginForm || this.showingPostForm;
            }
        }
    }

</script>
