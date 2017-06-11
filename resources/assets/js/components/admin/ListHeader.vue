<template>
    <div class="box-header">

        <h3 class="box-title"></h3>

        <div class="pull-right">
            <div class="form-inline pull-right">

                <fieldset>

                    <slot name="form">13</slot>

                    <div class="btn-group btn-group-sm">
                        <button type="submit" class="btn btn-primary" @click="table.loadList()"><i
                                class="fa fa-search"></i></button>
                        <a href=""
                           class="btn btn-warning"><i class="fa fa-undo"></i></a>
                    </div>

                </fieldset>

            </div>


            <div class="btn-group pull-right" style="margin-right: 10px">
                <a href="" target="_blank"
                   class="btn btn-sm btn-twitter">
                    <i class="fa fa-download"></i>&nbsp;&nbsp;Export
                </a>
            </div>


            <div class="btn-group pull-right" style="margin-right: 10px">
                <router-link :to="{path:'create'}" v-if="can('admin.user.create')" class="btn btn-sm btn-success">
                    <i class="fa fa-plus-circle"></i>&nbsp;添加用户
                </router-link>
            </div>

        </div>

        <span>
            <div class="icheckbox_minimal-blue" aria-checked="false" aria-disabled="false" style="position: relative;">
                <input type="checkbox" class="grid-select-all" style="position: absolute; opacity: 0;">
                <ins class="iCheck-helper"
                     style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
            </div>&nbsp;

<div class="btn-group">
    <a class="btn btn-sm btn-default"> 操作</a>
    <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu" role="menu">
        <li><a href="#" class="grid-batch-0">删除</a></li>
    </ul>
</div> <a class="btn btn-sm btn-primary grid-refresh" @click="$refs.table.loadList()" href="javascript:;"><i
                class="fa fa-refresh"></i> 刷新</a>
        </span>

    </div>
</template>
<script>
    export default{
        props: {
            table: {
                type: String,
                default: ''
              }
    },
    mounted()
    {

        console.log(this.$parent);
    },
    methods: {


    }
    }
</script>