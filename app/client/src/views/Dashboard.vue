<template>
    <div>

        <dl class="uk-description-list">

            <dt>Description term</dt>
            <dd>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</dd>

        </dl>

        <div class="uk-card uk-card-default uk-card-body">

            <Worlds></Worlds>

        </div>

    </div>
</template>

<script>

    import Worlds from "../components/vrchat/Worlds";

    export default {
         name: "Dashboard",
         data: function() {
              return {

              };
         },
         methods: {

         },
        components: {
             Worlds
        }
    };
</script>