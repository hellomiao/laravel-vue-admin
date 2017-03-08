<template>

    <div class="box-body table-responsive no-padding">

    <table :class="['table table-bordered dataTable',stripped?'table-striped':'',hover?'table-hover':'']">
        <thead>
        <tr>
            <th @click="headClick(field,key)"
                :class="[field.sortable?'sorting':null,sort===key?'sorting_'+(sortDesc?'desc':'asc'):'']"
                v-for="field,key in fields"
            >
                {{field.label}}
            </th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in _items" :key="items_key" :class="[item.state?'table-'+item.state:null]">
            <td v-for="(field,key) in fields">
                <slot :name="key" :value="field.need?item[field.need][key]:item[key]" :item="item">{{field.need?item[field.need][key]:item[key]}}</slot>
            </td>
        </tr>
        </tbody>
    </table>
    <div class="col-sm-7">
        <vPagination size="md"
                     :total-rows="total"
                     :per-page="perPage"
                     v-model="currentPage"
        />
    </div>
    </div>
</template>

<script>
    require('admin-lte/plugins/datatables/dataTables.bootstrap.css');
    import Pagination from './Pagination.vue';


    export default{
        components: {vPagination: Pagination},

        data() {
            return {
                items:[],
                total:0,
                currentPage:1,
                sort: null,
                sortDesc: true,
                loadingColor:"#00a65a"
            };
        },

        props: {
            sortable: {
                type: Boolean,
                default: false
            },

            fields: {
                type: Object,
                default: () => {
                }
            },
            stripped: {
                type: Boolean,
                default: false
            },
            hover: {
                type: Boolean,
                default: false
            },
            perPage: {
                type: Number,
                default: null
            },
            items_key: {
                type: String,
                default: null
            },
            ajax_url: {
                type: String,
                default: null
            },
            params: {
                type: Object,
                default: () => {
              }
            },

            del: {
                type: Object,
            default: () => {
                }
            }
        },

        computed: {
            _items() {
                if (!this.items) {
                    return [];
                }

                let items = this.items;

                //
                const fix = v => {
                    if (v instanceof Object) {
                        return Object.keys(v).map(k => fix(v[k])).join(' ');
                    }
                    return String(v);
                };



                // Apply Sort
//                if (this.sort) {
//                    items = items.sort((a, b) => {
//                        const r = fix(a[this.sort]).localeCompare(fix(b[this.sort]));
//                        return this.sortDesc ? r : r * -1;
//                    });
//                }



                return items;
            },

        },
    watch: {
        currentPage(){


            this.loadList();

        }
    },
    created () {




    },
    mounted () {
        this.loadList();
    },
        methods: {
            headClick(field, key) {
                if (!field.sortable) {
                    return;
                }

                if (key === this.sort) {
                    this.sortDesc = !this.sortDesc;
                }
                this.sort = key;
                this.loadList();
            },
            loadList: function () {
                this.$Progress.start()
                var that = this;
                var url = this.ajax_url;
                var sort = this.sort;
                var sortType=this.sortDesc?'desc':'asc';
                var params={start:(this.currentPage-1)*this.perPage,sort:[sort,sortType],perPage:this.perPage};
                if (typeof this.params !== "undefined") {
                    params = Object.assign(params, this.params);
                }
                this.callHttp("POST",url,params, function (json) {
                    that.items = json.data;
                    that.total = json.total;
                    that.$Progress.finish()
                });
            },

                onDel: function (id) {
                    var that = this;
                    swal({
                                title: "确定要删除?",
                                text: that.del.title,
                                type: "warning",
                                showCancelButton: true,
                                cancelButtonText: "取消",
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: "删除",
                                closeOnConfirm: true
                            }).then(function () {
                                var url = that.del.url+'/'+id;
                                that.callHttp("DELETE", url, {}, function (json) {
                                    if (json.status) {
                                        toastr.success(that.del.successText)
                                        that.loadList();
                                    }
                                });
                            });
                }


        }

    };
</script>




