<template>
    <div>
        <h3>Hello, <b>{{ user.data.login}}</b>!</h3>
        <Worlds class="uk-margin"></Worlds>
    </div>
</template>

<script>

    import Worlds from "../components/vrchat/Worlds";
    import User from "../store/user";

    export default {
        name: "Dashboard",
        data: function () {
            return {
                user: User.state
            }
        },
        methods: {

        },
        components: {
             Worlds
        }
    };
</script>