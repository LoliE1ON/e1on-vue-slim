<template>
    <div>

        <dl class="uk-description-list">

            <dt>Description term</dt>
            <dd>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</dd>

        </dl>

        <div class="uk-card uk-card-default uk-card-body">

            <ul uk-tab>
                <li><a href="#">Overview</a></li>
                <li><a href="#">Statistics</a></li>
            </ul>

            <ul class="uk-switcher uk-margin">
                <li>
                    <VrchatWorlds :displayTitle="false"/>
                </li>
                <li>
                    Statistics
                </li>
            </ul>

        </div>

    </div>
</template>

<script>

import VrchatWorlds from '../components/vrchat/Worlds'

export default {
     name: "Dashboard",
     data: function() {
          return {
             
          };
     },
     methods: {
        
     },
     components: {VrchatWorlds}
};
</script>