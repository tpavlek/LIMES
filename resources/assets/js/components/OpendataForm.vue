<template>
    <div>
        <opendata-header-retrieve></opendata-header-retrieve>

        <hr class="border-b" />

        <opendata-fetch :action-url="actionUrl"></opendata-fetch>
    </div>
</template>

<script>
    export default {
        props: [ 'actionUrl' ]
    }
</script>
