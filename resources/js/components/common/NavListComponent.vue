<template>
        
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

        <a class="dropdown-item" v-if="_ca('user')" :href="base_url + '/user'">User</a>
        <a class="dropdown-item" v-if="_ca('leave')" :href="base_url + '/leave'">Leave</a>
        <a class="dropdown-item" href="javascript: void(0);" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>

        <form id="logout-form" :action="base_url + '/logout'" method="POST" style="display: none;">
            <input type="hidden" name="_token" :value="csrf">
        </form>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    data(){
        return{
        }
    },
    computed:{
        ...mapState( [ 'base_url', 'user', 'csrf' ] ),
    },
    methods: {
        _ca( page ){
            return window._commonFn._checkAccess( page );
        }
    }
}
</script>
<style>
</style>
