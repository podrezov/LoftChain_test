<template>
    <div>
        <i v-if="sort === false" class="fa fa-sort"></i>
        <i v-if="sort === `up`" class="fa fa-sort-up"></i>
        <i v-if="sort === `down`" class="fa fa-sort-down"></i>
    </div>
</template>

<script>
    export default {
        name: "sort-label",
        props: ['sort']
    }
</script>

<style scoped>

</style>