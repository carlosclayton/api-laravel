<template>
    <div class="wrapper">
        <notifications group="foo" position="bottom right"/>
        <va-navibar></va-navibar>
        <va-slider></va-slider>
        <div id="content-wrap" class="content-wrapper">
            <section class="content-header">
                <h1>
                    Blank page
                    <small>it all starts here</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="#">Examples</a></li>
                    <li class="active">Blank page</li>
                </ol>
            </section>
            <section class="content">

                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Title</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                    title="" data-original-title="Collapse">
                                <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                                    title="" data-original-title="Remove">
                                <i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body" style="">
                        Start creating your amazing application!
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer" style="">
                        <!--<div class="form-group">-->
                            <!--<label>Select</label>-->
                            <!--<select name="" id="" v-model="type" class="form-control">-->
                                <!--<option value="5">ENTRADA</option>-->
                                <!--<option value="6">SAÍDA</option>-->
                            <!--</select>-->
                        <!--</div>-->
                        <!--<button type="button" class="btn btn-block btn-default" v-on:click="sendMessage1()"><span-->
                                <!--class="glyphicon glyphicon-print"></span> Cadastrar-->
                        <!--</button>-->
                        Footer
                    </div>
                    <!-- /.box-footer-->
                </div>
                <!-- /.box -->
            </section>
        </div>
        <va-footer></va-footer>
    </div>

</template>

<script>
    import Vue from 'vue'
    import Notifications from 'vue-notification'
    import velocity from 'velocity-animate'
    import SocketIO from 'socket.io-client';
    import VueSocketIO from 'vue-socket.io'
    import VANaviBar from '../NaviBar.vue'
    import VASlider from '../Slider.vue'
    import VAContentWrap from '../ContentWrap.vue'
    import VAFooter from '../Footer.vue'

    Vue.use(new VueSocketIO({
        debug: true,
        connection: SocketIO(process.env.MIX_ENDPOINT_SOCKET),
    }))

    Vue.use(Notifications)

    export default {
        data() {
            return {
                type: 'E'
            }
        },
        sockets: {
            connect: function () {
                console.log('socket connected')
            },
            giroOutput: function (data) {
                console.log('Received: ', data)
                Vue.notify({
                    group: 'foo',
                    type: data.type,
                    title: 'Catraca #01',
                    text: data.message,
                    duration: 10000,
                    speed: 1000
                })
            }
        },
        mounted() {
            console.log('Component mounted.')
            // this.$socket.on('sendClient', function (data) {
            //     console.log('Data: ', data);
            // })
        },
        methods: {
            sendMessage1() {
                Vue.notify({
                    group: 'foo',
                    type: 'success',
                    title: 'Catraca #01',
                    text: 'Iniciando coleta biometrica...',
                    duration: 10000,
                    speed: 1000
                })
                console.log('Enviando mensagem...')
                this.$socket.emit('giroInput', {
                    type: this.type,

                });

            }
        },
        components: {
            'va-navibar': VANaviBar,
            'va-slider': VASlider,
            'va-content-wrap': VAContentWrap,
            'va-footer': VAFooter
        }
    }
</script>
