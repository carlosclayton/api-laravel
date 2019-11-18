<template>
    <!-- Content Wrapper. Contains page content -->
        <!-- Content Header (Page header) -->
        <!--<router-view></router-view>-->
        <!-- /.content -->
    <!-- /.content-wrapper -->
</template>

<script>


    export default {
        name: 'va-content-wrap',
        data() {
            return {
                currentUser: [],
                rotas: this.$route.matched
            }
        },

        created () {
            console.log(this.$route)
        },
        computed: {
            getNomePath(){
//                this.rota.matched.forEach(function (value, key) {
//                    Store.commit('setNamePath', value.name);
//                    console.log('VALOR: ', value.name)
//                });
                return '';
            }
        },
        watch: {
            '$route': {
                deep: true,
                handler: function () {
                    this.rotas = this.$route.matched;
                }
            }
        }
    }
</script>

<style>
    .page-enter-active, .page-leave-active {
        transition: opacity 0.5s, transform 0.5s;
    }

    .page-enter, .page-leave-to {
        opacity: 0;
    }
</style>


