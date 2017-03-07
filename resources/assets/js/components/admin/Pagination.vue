<template>

    <div class="dataTables_paginate paging_simple_numbers" v-if="totalRows>perPage">
        <ul class="pagination">
            <li :class="['paginate_button','previous',currentPage == 1?'disabled':'']"
                @click.prevent="(currentPage == 1) ? _return : currentPage--"
                ><a href="#" aria-controls="example1"
                 data-dt-idx="0" tabindex="0">上一页</a>
            </li>
            <li  :class="[
                'paginate_butto',
                index + diff === currentPage ? 'active' : '',
                index + diff !== currentPage ? 'hidden-xs-down' : '']" v-for="(item,index) in pageLinks"
                @click.prevent="currentPage = index + diff"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0">{{index + diff}}</a>
            </li>

            <li :class="['paginate_button','next',currentPage == numberOfPages?'disabled':'']"
                @click.prevent="(currentPage == numberOfPages) ? _return : currentPage++"
                id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="7"
                                                                   tabindex="0">下一页</a></li>
        </ul>
    </div>


</template>

<script>
    export default {
        data() {
            return {
                diff: 1,
                showPrev: false,
                showNext: false,
                currentPage: this.value
            };
        },
        computed: {
            numberOfPages() {
                const result = Math.ceil(this.totalRows / this.perPage);
                return (result < 1) ? 1 : result;
            },
            btnSize() {
                return !this.size || this.size === `default` ? `` : `btn-${this.size}`;
            },
            pageLinks() {
                let result = this.limit;
                if (this.currentPage > this.numberOfPages) {
                    this.currentPage = 1;
                }
                this.diff = 1;
                this.showPrev = false;
                this.showNext = false;
                // if less pages than limit just show this pages
                if (this.numberOfPages <= this.limit) {
                    return this.numberOfPages;
                }
                // if at the beggining of the list or at the end show full number of pages within limit - 2
                // -2 is reserves space for two buttons: "..." and "first/last button"
                if (this.currentPage <= this.limit - 2) {
                    this.diff = 1;
                    this.showNext = true;
                    result = this.limit - 2;
                }
                // at the end of the range
                if (this.currentPage > this.numberOfPages - this.limit + 2) {
                    this.diff = this.numberOfPages - this.limit + 3;
                    this.showPrev = true;
                    result = this.limit - 2;
                }
                // if somehere in the middle show just limit - 4 links in the middle and one button on the left with "..." and on button on the right preceeded with "..."
                if (this.currentPage >= this.limit - 2 && this.currentPage <= this.numberOfPages - this.limit + 2) {
                    this.diff = this.currentPage - 1;
                    this.showPrev = true;
                    this.showNext = true;
                    result = this.limit - 4;
                }
                return result;
            }
        },
        methods: {

            _return() {

            }
        },
        watch: {
            currentPage(newPage) {
                this.$emit('input', newPage);
            },
            value(newValue, oldValue) {
                if (newValue !== oldValue) {
                    this.currentPage = newValue;
                }
            }
        },
        props: {
            value: {
                type: Number,
                default: 1
            },
            limit: {
                type: Number,
                default: 7
            },
            perPage: {
                type: Number,
                default: 20
            },
            totalRows: {
                type: Number,
                default: 20
            },
            size: {
                type: String,
                default: 'md'
            },
            variant: {
                type: String,
                default: 'primary'
            },
            secondaryVariant: {
                type: String,
                default: 'secondary'
            }
        }
    };

</script>

<style>
    .pagination > .active > a{
        background:#3d9970 !important;
    }
</style>
