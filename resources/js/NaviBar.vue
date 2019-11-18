<template>
    <header class="main-header">
        <simplert :useRadius="true"
                  :useIcon="true"
                  ref="simplert">
        </simplert>

        <!-- Logo -->
        <router-link to="/home" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>LT</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Admin</b>LTE</span>
        </router-link>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">Nenhuma mensagem</li>
                            <!--<li>-->
                                <!--&lt;!&ndash; inner menu: contains the actual data &ndash;&gt;-->
                                <!--<ul class="menu">-->
                                    <!--<li>&lt;!&ndash; start message &ndash;&gt;-->
                                        <!--<a href="#">-->
                                            <!--<div class="pull-left">-->
                                                <!--<img src="~admin-lte/dist/img/user2-160x160.jpg" class="img-circle"-->
                                                     <!--alt="User Image">-->
                                            <!--</div>-->
                                            <!--<h4>-->
                                                <!--Support Team-->
                                                <!--<small><i class="fa fa-clock-o"></i> 5 mins</small>-->
                                            <!--</h4>-->
                                            <!--<p>Why not buy a new awesome theme?</p>-->
                                        <!--</a>-->
                                    <!--</li>-->
                                    <!--&lt;!&ndash; end message &ndash;&gt;-->
                                    <!--<li>-->
                                        <!--<a href="#">-->
                                            <!--<div class="pull-left">-->
                                                <!--<img src="~admin-lte/dist/img/user3-128x128.jpg" class="img-circle"-->
                                                     <!--alt="User Image">-->
                                            <!--</div>-->
                                            <!--<h4>-->
                                                <!--AdminLTE Design Team-->
                                                <!--<small><i class="fa fa-clock-o"></i> 2 hours</small>-->
                                            <!--</h4>-->
                                            <!--<p>Why not buy a new awesome theme?</p>-->
                                        <!--</a>-->
                                    <!--</li>-->
                                    <!--<li>-->
                                        <!--<a href="#">-->
                                            <!--<div class="pull-left">-->
                                                <!--<img src="~admin-lte/dist/img/user4-128x128.jpg" class="img-circle"-->
                                                     <!--alt="User Image">-->
                                            <!--</div>-->
                                            <!--<h4>-->
                                                <!--Developers-->
                                                <!--<small><i class="fa fa-clock-o"></i> Today</small>-->
                                            <!--</h4>-->
                                            <!--<p>Why not buy a new awesome theme?</p>-->
                                        <!--</a>-->
                                    <!--</li>-->
                                    <!--<li>-->
                                        <!--<a href="#">-->
                                            <!--<div class="pull-left">-->
                                                <!--<img src="~admin-lte/dist/img/user3-128x128.jpg" class="img-circle"-->
                                                     <!--alt="User Image">-->
                                            <!--</div>-->
                                            <!--<h4>-->
                                                <!--Sales Department-->
                                                <!--<small><i class="fa fa-clock-o"></i> Yesterday</small>-->
                                            <!--</h4>-->
                                            <!--<p>Why not buy a new awesome theme?</p>-->
                                        <!--</a>-->
                                    <!--</li>-->
                                    <!--<li>-->
                                        <!--<a href="#">-->
                                            <!--<div class="pull-left">-->
                                                <!--<img src="~admin-lte/dist/img/user4-128x128.jpg" class="img-circle"-->
                                                     <!--alt="User Image">-->
                                            <!--</div>-->
                                            <!--<h4>-->
                                                <!--Reviewers-->
                                                <!--<small><i class="fa fa-clock-o"></i> 2 days</small>-->
                                            <!--</h4>-->
                                            <!--<p>Why not buy a new awesome theme?</p>-->
                                        <!--</a>-->
                                    <!--</li>-->
                                <!--</ul>-->
                            <!--</li>-->
                            <!--<li class="footer"><a href="#">See All Messages</a></li>-->
                        </ul>
                    </li>
                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <!--<span class="label label-warning">{{ unreadNotificationsCount }}</span>-->
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">Nenhuma notificação</li>
                            <!--<li>-->
                                <!--&lt;!&ndash; inner menu: contains the actual data &ndash;&gt;-->
                                <!--<ul class="menu">-->
                                    <!--<li>-->
                                        <!--<a href="#">-->
                                            <!--<i class="fa fa-users text-aqua"></i> 5 new members joined today-->
                                        <!--</a>-->
                                    <!--</li>-->
                                    <!--<li>-->
                                        <!--<a href="#">-->
                                            <!--<i class="fa fa-warning text-yellow"></i>-->
                                            <!--Very long description here that may not fit into the-->
                                            <!--page and may cause design problems-->
                                        <!--</a>-->
                                    <!--</li>-->
                                    <!--<li>-->
                                        <!--<a href="#">-->
                                            <!--<i class="fa fa-users text-red"></i> 5 new members joined-->
                                        <!--</a>-->
                                    <!--</li>-->
                                    <!--<li>-->
                                        <!--<a href="#">-->
                                            <!--<i class="fa fa-shopping-cart text-green"></i> 25 sales made-->
                                        <!--</a>-->
                                    <!--</li>-->
                                    <!--<li>-->
                                        <!--<a href="#">-->
                                            <!--<i class="fa fa-user text-red"></i> You changed your username-->
                                        <!--</a>-->
                                    <!--</li>-->
                                <!--</ul>-->
                            <!--</li>-->
                            <!--<li class="footer"><a href="#">View all</a></li>-->
                        </ul>
                    </li>
                    <!-- Tasks: style can be found in dropdown.less -->
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa  fa-users"></i>
                            <!--<span class="label label-danger">{{ remainTasksCount }}</span>-->
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have {{ remainTasksCount }} tasks</li>
                            <!--<li>-->
                                <!--&lt;!&ndash; inner menu: contains the actual data &ndash;&gt;-->
                                <!--<ul class="menu">-->
                                    <!--<li>&lt;!&ndash; Task item &ndash;&gt;-->
                                        <!--<a href="#">-->
                                            <!--<h3>-->
                                                <!--Design some buttons-->
                                                <!--<small class="pull-right">20%</small>-->
                                            <!--</h3>-->
                                            <!--<div class="progress xs">-->
                                                <!--<div class="progress-bar progress-bar-aqua" style="width: 20%"-->
                                                     <!--role="progressbar" aria-valuenow="20" aria-valuemin="0"-->
                                                     <!--aria-valuemax="100">-->
                                                    <!--<span class="sr-only">20% Complete</span>-->
                                                <!--</div>-->
                                            <!--</div>-->
                                        <!--</a>-->
                                    <!--</li>-->
                                    <!--&lt;!&ndash; end task item &ndash;&gt;-->
                                    <!--<li>&lt;!&ndash; Task item &ndash;&gt;-->
                                        <!--<a href="#">-->
                                            <!--<h3>-->
                                                <!--Create a nice theme-->
                                                <!--<small class="pull-right">40%</small>-->
                                            <!--</h3>-->
                                            <!--<div class="progress xs">-->
                                                <!--<div class="progress-bar progress-bar-green" style="width: 40%"-->
                                                     <!--role="progressbar" aria-valuenow="20" aria-valuemin="0"-->
                                                     <!--aria-valuemax="100">-->
                                                    <!--<span class="sr-only">40% Complete</span>-->
                                                <!--</div>-->
                                            <!--</div>-->
                                        <!--</a>-->
                                    <!--</li>-->
                                    <!--&lt;!&ndash; end task item &ndash;&gt;-->
                                    <!--<li>&lt;!&ndash; Task item &ndash;&gt;-->
                                        <!--<a href="#">-->
                                            <!--<h3>-->
                                                <!--Some task I need to do-->
                                                <!--<small class="pull-right">60%</small>-->
                                            <!--</h3>-->
                                            <!--<div class="progress xs">-->
                                                <!--<div class="progress-bar progress-bar-red" style="width: 60%"-->
                                                     <!--role="progressbar" aria-valuenow="20" aria-valuemin="0"-->
                                                     <!--aria-valuemax="100">-->
                                                    <!--<span class="sr-only">60% Complete</span>-->
                                                <!--</div>-->
                                            <!--</div>-->
                                        <!--</a>-->
                                    <!--</li>-->
                                    <!--&lt;!&ndash; end task item &ndash;&gt;-->
                                    <!--<li>&lt;!&ndash; Task item &ndash;&gt;-->
                                        <!--<a href="#">-->
                                            <!--<h3>-->
                                                <!--Make beautiful transitions-->
                                                <!--<small class="pull-right">80%</small>-->
                                            <!--</h3>-->
                                            <!--<div class="progress xs">-->
                                                <!--<div class="progress-bar progress-bar-yellow" style="width: 80%"-->
                                                     <!--role="progressbar" aria-valuenow="20" aria-valuemin="0"-->
                                                     <!--aria-valuemax="100">-->
                                                    <!--<span class="sr-only">80% Complete</span>-->
                                                <!--</div>-->
                                            <!--</div>-->
                                        <!--</a>-->
                                    <!--</li>-->
                                    <!--&lt;!&ndash; end task item &ndash;&gt;-->
                                <!--</ul>-->
                            <!--</li>-->
                            <!--<li class="footer">-->
                                <!--<a href="#">View all tasks</a>-->
                            <!--</li>-->

                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li><!-- start message -->
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="~admin-lte/dist/img/user2-160x160.jpg" class="img-circle"
                                                     alt="User Image">
                                            </div>
                                            <h4>
                                                Support Team
                                                <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                    <!-- end message -->
                                    <li>
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="~admin-lte/dist/img/user3-128x128.jpg" class="img-circle"
                                                     alt="User Image">
                                            </div>
                                            <h4>
                                                AdminLTE Design Team
                                                <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="~admin-lte/dist/img/user4-128x128.jpg" class="img-circle"
                                                     alt="User Image">
                                            </div>
                                            <h4>
                                                Developers
                                                <small><i class="fa fa-clock-o"></i> Today</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="~admin-lte/dist/img/user3-128x128.jpg" class="img-circle"
                                                     alt="User Image">
                                            </div>
                                            <h4>
                                                Sales Department
                                                <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="~admin-lte/dist/img/user4-128x128.jpg" class="img-circle"
                                                     alt="User Image">
                                            </div>
                                            <h4>
                                                Reviewers
                                                <small><i class="fa fa-clock-o"></i> 2 days</small>
                                            </h4>
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer"><a href="#">See All Messages</a></li>
                        </ul>
                    </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="~admin-lte/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{ user.name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="~admin-lte/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                                <p>
                                    {{ user.name }}
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat"><span class="glyphicon glyphicon-tasks"></span> Cadastro </a>
                                </div>
                                <div class="pull-right">
                                    <button @click.prevent="sendLogout" class="btn btn-danger btn-flat"> <span class="glyphicon glyphicon-off"></span> Logout </button>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
</template>

<script>

    import Simplert from 'vue2-simplert';

    export default {
        name: 'va-navibar',
        data() {
            return {

                unreadMessagesCount: 5,
                unreadNotificationsCount: 10,
                remainTasksCount: 14,
                currentUser: [],
                user: [],
                rota: this.$route.name
            }
        },
        mounted(){
            this.currentUser =
                {
                    name: "Alexander Pierce",
                    position: "Web Developer",
                    state: {
                        color: "#3c763d",
                        name: "Online"
                    },
                    createdAt: "2018-03-30T21:06:47.164Z"
                }
        },
        methods:{
            getUser() {
                this.$http.get('user')
                    .then((response) => {
                        console.log(response)
                        this.user = response.body
                    })
            },
            logout(){
                this.$router.replace('/login')
            },
            sendLogout(){
                let obj = {
                    title: 'Logout',
                    message: 'Deseja sair do sistema?',
                    type: 'error',
                    useConfirmBtn: true,
                    customConfirmBtnText: 'Sim',
                    customCloseBtnText: 'Não',
                    customConfirmBtnClass: 'btn btn-primary btn-block margin-bottom btn-lg',
                    customCloseBtnClass: 'btn btn-danger btn-block margin-bottom btn-lg',
                    onConfirm: this.logout
                }
                this.$refs.simplert.openSimplert(obj)

            }
        },
        computed:{
        },
        created(){
            //this.getUser();
        },
        components: {
            Simplert
        }

//    computed: {
//    ...mapGetters([
//      'unreadMessagesCount',
//      'unreadNotificationsCount',
//      'remainTasksCount',
//      'currentUser'
//    ])
//  }
    }

</script>
