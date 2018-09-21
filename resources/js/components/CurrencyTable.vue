<template>
    <div class="col-12">

        <div class="card" v-if="currencies">
            <div class="card-body" style="overflow-y: scroll; height:440px">

                <table class="table cust-table">
                    <thead>
                    <tr>
                        <th v-for="th in theads"
                            @click="sortTable(th.key)">
                            <sort-label :sort="typeSort(th.key)"></sort-label>
                            {{ th.label }}
                        </th>
                    </tr>
                    </thead>

                    <tbody>
                    <!-- Items -->
                    <tr v-for="item in currenciesWithPaginate">
                        <td v-for="th in theads">{{ item[th.key] }}</td>
                    </tr>
                    <!-- /Items -->

                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="form-group col-auto">
                        <select class="custom-select" id="inputGroupSelect01" v-model="show" @change="changePage(1)">
                            <option value="10" selected>10</option>
                            <option v-for="i in [20, 30, 40, 50, 60, 70]" :value="i">{{ i }}</option>
                        </select>
                    </div>

                    <div class="col-auto">
                        <pagination :active-page="paginate.currentPage"
                                    :pages="countPages" @change="changePage"></pagination>
                    </div>
                </div>
            </div>

        </div>

        <div v-if="!currencies">
            Loading..
        </div>
    </div>
</template>

<script>
    import axios from 'axios'

    import sortLabel from './sort-label'
    import pagination from './pagination'

    const fetchUrl = '/api/currencies';

    export default {
        name: "CurrencyTable",

        data() {
            return {
                currencies: null,
                show: 10,
                paginate: {
                    start: 0,
                    end: 10,
                    currentPage: 1,
                },
                sortKey: null,
                revert: false,
                theads: [
                    {key: `currency`, label: `Currency`},
                    {key: `id`, label: `Transaction Id`},
                    {key: `from`, label: `From`},
                    {key: `amount`, label: `Amount`},
                    {key: `date`, label: `Date`},
                    {key: `status`, label: `Status`},
                    {key: `created_at`, label: `Created`},
                ],
            }
        },
        mounted() {
            this.fetchCurrencies();
        },
        computed: {
            currenciesWithPaginate() {
                return this.currencies.slice(this.paginate.start, this.paginate.end + 1)
            },
            countPages() {
                return Math.ceil(this.currencies.length / this.show)
            }
        },
        methods: {
            async fetchCurrencies() {
                const {data} = await axios.get(fetchUrl);
                this.currencies = data
            },

            sortTable(key) {
                if (this.sortKey === key) {
                    this.revert = !this.revert
                }
                this.sortKey = key;
                this.currencies = this.currencies.sort((a, b) => {
                    if (this.revert) {
                        return a[key] > b[key] ? -1 : a[key] < b[key] ? 1 : 0;
                    } else {
                        return a[key] < b[key] ? -1 : a[key] > b[key] ? 1 : 0;
                    }
                })
            },
            typeSort(key) {
                if (this.sortKey === key) {
                    return this.revert === false ? `up` : `down`
                }
                return false
            },
            changePage(pageNumber) {
                this.paginate.currentPage = pageNumber;
                this.paginate.start = pageNumber * this.show - this.show;

                if (pageNumber * this.show > this.currencies.length) {
                    this.paginate.end = this.currencies.length - 1;
                } else {
                    this.paginate.end = pageNumber * this.show
                }
            },
        },
        components: {
            sortLabel,
            pagination
        }
    }
</script>

<style scoped>
    .cust-table th {
        cursor: pointer;
    }
</style>