<template>
    <div>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li :class="{active: activePage === i}" class="page-item" v-for="i in pages">
                    <a
                       class="page-link" @click="setPage(i)" href="#">{{ i }}</a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
    export default {
        name: "pagination",
        props: {
            pages: {
                type: Number,
                required: true,
            },
            activePage: {
                type: Number,
                default: 1,
            }
        },
        methods: {
            setPage(pageNumber) {
                this.$emit(`change`, pageNumber)
            }
        }
    }
</script>

<style scoped>

</style>