<template>
    <div>
        <div class="uk-card uk-card-default uk-card-body app-sidebar-card-default uk-card-solid" style="margin-top:15px;">

            test
            
        </div>

        <Discord v-show="user.getters.isLogged"></Discord>
        
    </div>
</template>

<script>

import Discord from './discord/Discord'
import User from "../store/user";

export default {
    name: 'Sidebar',
    data: function () {
        return {
            user: User
        }
    },
    components: { Discord }
}
</script>