<template>
    <form :action="actionUrl" method="post">
        <input type="hidden" name="_token" :value="csrfToken" />
        <input type="hidden" name="socrata_url" :value="socrataUrl"/>

        <label for="name_name" class="tracking-wide font-bold text-sm text-grey-dark">
            NAME FIELD
        </label>
        <input required type="text" name="name_name" id="name_name" placeholder="Field for the name" class="my-2 bg-grey-light p-2 rounded w-full" />

        <label for="description_name" class="tracking-wide font-bold text-sm text-grey-dark">
            DESCRIPTION FIELD
        </label>
        <input @autofill="alert('here')" type="text" name="description_name" id="description_name" placeholder="Field for the description" class="my-2 bg-grey-light p-2 rounded w-full" />

        <label for="lat_name" class="tracking-wide font-bold text-sm text-grey-dark">
            LATITUDE FIELD
        </label>
        <input v-on:autofill-ready="autoFill" type="text" name="lat_name" id="lat_name" placeholder="Latitude Field" class="my-2 bg-grey-light p-2 rounded w-full" />

        <label for="lon_name" class="tracking-wide font-bold text-sm text-grey-dark">
            LONGITUDE FIELD
        </label>
        <input type="text" name="lon_name" id="lon_name" placeholder="Longitude Field" class="my-2 bg-grey-light p-2 rounded w-full" />

        <label for="num_records" class="tracking-wide font-bold text-sm text-grey-dark">
            # OF RECORDS
        </label>
        <input type="number" name="num_records" id="num_records" value="2" class="my-2 bg-grey-light p-2 rounded w-full" />

        <button class="bg-green-dark text-white px-4 py-2 mx-auto border-blue-darkest leading-loose shadow rounded mb-4 inline-block w-24 h-16 text-center flex flex-col justify-center">
            Import
        </button>
    </form>

</template>

<script>
    function addGreenBorder(el)
    {
        el.classList.add("border-2");
        el.classList.add("border-green");
    }

    export default {
        props: [ 'actionUrl' ],
        data() {
            return {
                socrataUrl: ""
            }
        },
        methods: {
            autoFill(e) {
                if (e.hasOwnProperty("latitude")) {
                    let el = document.getElementById("lat_name");

                    el.value = "latitude";
                    addGreenBorder(el);
                }

                if (e.hasOwnProperty("longitude")) {
                    let el = document.getElementById("lon_name");

                    el.value = "longitude";
                    addGreenBorder(el);
                }

                if (e.hasOwnProperty("name")) {
                    let el = document.getElementById("name_name");

                    el.value = "name";
                    addGreenBorder(el);
                }
            }
        },
        mounted() {
            let vm = this;
            this.$root.$on('sampleRetrieved', function(e) {
                vm.autoFill(e);
            });

            this.$root.$on('new-data-url', function (url) {
                vm.socrataUrl = url;
            })
        },
        computed:  {
            csrfToken() {
                return document.head.querySelector('meta[name="csrf-token"]').content;
            }
        }
    }
</script>
