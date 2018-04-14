<template>
    <div>
        <label for="opendata_url" class="tracking-wide font-bold text-sm text-grey-dark">
            OPENDATA URL
        </label>
        <input :disabled="isQuerying" @change="queryHeaders" type="text" name="opendata_url" id="opendata_url" placeholder="Enter the API resource URL" class="my-2 bg-grey-light p-2 rounded w-full" />

        <div class="bg-green-dark text-white px-4 py-2 mx-auto border-blue-darkest leading-loose shadow rounded mb-4 inline-block w-24 h-16 text-center flex flex-col justify-center">
            <div v-show="!isQuerying">
                <i class="fas fa-check"></i>
            </div>
            <div v-show="isQuerying" class="spinner h-8">
                <div class="rect1"></div>
                <div class="rect2"></div>
                <div class="rect3"></div>
                <div class="rect4"></div>
                <div class="rect5"></div>
            </div>
        </div>

        <hr class="border-b" />

        <div>
            <h3>Sample Data:</h3>
            <div v-for="(value,key) in sample" v-if="(typeof value === 'string')">
                <span class="tracking-wide font-bold text-sm text-grey-dark">{{ key }}</span>: {{ value }}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                isQuerying: false,
                sample: {
                }
            }
        },
        methods: {
            queryHeaders(e) {
                let url = e.target.value;

                this.$root.$emit('new-data-url', url);

                this.isQuerying = true;

                const socrata = axios.create({
                    timeout: 1000,
                    headers: {'X-App-Token': document.head.querySelector('meta[name="socrata-token"]').content }
                });

                socrata.get(url, {
                    params: {
                        '$limit': 1
                    }
                }).then(data => {
                    this.populateSample(data);
                });
            },
            populateSample(data) {
                if (data.hasOwnProperty("data") && Array.isArray(data.data)) {
                    this.sample = data.data[0];
                }

                this.$root.$emit("sampleRetrieved", this.sample);

                this.isQuerying = false;
            }
        }
    }
</script>

<style lang="postcss">
    .spinner {
        text-align: center;
    }

    .spinner > div {
        background-color: #333;
        height: 100%;
        width: 6px;
        display: inline-block;

        -webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;
        animation: sk-stretchdelay 1.2s infinite ease-in-out;
    }

    .spinner .rect2 {
        -webkit-animation-delay: -1.1s;
        animation-delay: -1.1s;
    }

    .spinner .rect3 {
        -webkit-animation-delay: -1.0s;
        animation-delay: -1.0s;
    }

    .spinner .rect4 {
        -webkit-animation-delay: -0.9s;
        animation-delay: -0.9s;
    }

    .spinner .rect5 {
        -webkit-animation-delay: -0.8s;
        animation-delay: -0.8s;
    }

    @-webkit-keyframes sk-stretchdelay {
        0%, 40%, 100% { -webkit-transform: scaleY(0.4) }
        20% { -webkit-transform: scaleY(1.0) }
    }

    @keyframes sk-stretchdelay {
        0%, 40%, 100% {
            transform: scaleY(0.4);
            -webkit-transform: scaleY(0.4);
        }  20% {
               transform: scaleY(1.0);
               -webkit-transform: scaleY(1.0);
           }
    }
</style>
