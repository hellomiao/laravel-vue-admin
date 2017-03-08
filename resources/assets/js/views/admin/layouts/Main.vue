
<template>
    <div class="wrapper">



        <mheader></mheader>
        <sidebar></sidebar>
    <div class="content-wrapper">

        <!--<cheader :title="$route.name"></cheader>-->
        <!-- Main content -->
        <section class="content">
            <router-view></router-view>

            <!-- Your Page Content Here -->

        </section>
        <!-- /.content -->
    </div>




        <aside class="control-sidebar control-sidebar-dark">
            <!-- Create the tabs -->
            <ul class="nav nav-tabs nav-justified control-sidebar-tabs">

            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <!-- Home tab content -->
                <div class="tab-pane" id="control-sidebar-home-tab">


                </div>
                <!-- /.tab-pane -->
                <!-- Stats tab content -->
                <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>

                <!-- /.tab-pane -->
            </div>
        </aside>
        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
             immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>

    </div>
</template>
<script>
    import { mapActions,mapGetters} from 'vuex';
    import Mheader from './Mheader.vue';
    import Sidebar from './Sidebar.vue';

    export default {
        components: {
            Mheader,
            Sidebar
        },
        mounted () {

        },
        methods:{

           }


    }

</script>