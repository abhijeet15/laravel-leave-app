<template>

  <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="/">
                    {{ app.name }}
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <template  v-if="user">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{user.name }} <span class="caret"></span>
                                </a>
                                <nav-list></nav-list>
                            </li>
                           
                        </template>

                        <template  v-else>
                             <li class="nav-item">
                                <a class="nav-link" href="/login">Login</a>
                            </li>
                        </template>
                    </ul>
                </div>
            </div>
        </nav>
</template>

<script>
import { mapState } from 'vuex';
import TopNav from './NavListComponent';

    export default {
        data(){
            return{
            }
        },
        components:{
            'nav-list' : TopNav
        },
        computed:{
             ...mapState( [ 'app', 'user' ] ),

             user(){
                console.log(js_parent_var.user);
                return js_parent_var.user;
             }
        }
    }
</script>

<style>

</style>