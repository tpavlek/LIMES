<template>
    <div>
        <button v-show="!showingForm" @click="showForm" class="bg-green-dark hover:bg-green-darker text-white px-4 py-2 border-green-darkest text-xl leading-loose shadow rounded mb-4">
            <span class="fas fa-comment"></span> Say Hello
        </button>
        <div v-show="showingLoginForm">
            <h3 class="mb-2">Do you want to:</h3>
            <a :href="accountLink" class="inline-block no-underline mx-auto bg-green-dark hover:bg-green-darker text-white px-4 py-2 border border-green-dark text-xl leading-loose shadow rounded mb-4">
                <span class="fas fa-comment mr-2"></span> Use an Account
            </a>

            <button @click="showPostForm" class="block mx-auto px-4 py-2 border border-green-dark text-xl leading-loose rounded mb-4">
                Post Anonymously
            </button>
        </div>

        <div v-show="showingPostForm">
            <div class="pt-8 border-b border-l border-r shadow mx-4 bg-white px-4 mb-4 relative z-10">
                <form method="post" :action="postAction" enctype="multipart/form-data">
                    <input type="hidden" name="_token" :value="csrfToken" />

                    <template v-if="!authenticated">
                        <div class="text-left">
                            <label for="display_name" class="tracking-wide font-bold text-sm text-grey-dark">DISPLAY NAME</label>
                            <input type="text" id="display_name" name="display_name" placeholder="Display Name" class="my-2 bg-grey-light p-2 rounded w-full" />
                        </div>
                    </template>

                    <textarea class="bg-grey-light p-2 rounded w-full h-32 mb-2" id="body" name="body" title="Write your post..." placeholder="Write your post...">{{ postBody }}</textarea>

                    <image-upload></image-upload>

                    <button type="submit" class="bg-green-dark hover:bg-green-darker text-white px-4 py-2 border-green-darkest text-xl leading-loose shadow rounded mb-4">
                        <i class="fas fa-paper-plane"></i> Submit Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [ 'authenticated', 'postAction', 'accountLink', 'postBody' ],
        data() {
            return {
                showingLoginForm: false,
                showingPostForm: false,
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
            }
        },
        computed: {
            showingForm() {
                return this.showingLoginForm || this.showingPostForm;
            },
            csrfToken() {
                console.log(document.head.querySelector('meta[name="csrf-token"]'));
                return document.head.querySelector('meta[name="csrf-token"]').content;
            }
        }
    }

</script>
