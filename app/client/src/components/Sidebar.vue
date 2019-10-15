<template>
    <div>
        <div class="uk-card uk-card-default uk-card-body">

            <ul class="uk-nav-default" style="padding-top: 20px;padding-bottom: 20px;" uk-nav>

                <li class="uk-nav-header uk-text-bold">Links</li>

                <li><a href="https://vk.com/vadim_nezhyra" target="_blank">
                    <i class="fab fa-vk uk-text-primary"></i> VK
                </a></li>

                <li><a href="https://twitter.com/loli_e1on" target="_blank">
                    <i class="fab fa-twitter uk-text-primary"></i> Twitter
                </a></li>

                <li><a href="https://www.patreon.com/e1on" target="_blank">
                    <i class="fab fa-patreon uk-text-warning"></i> Patreon
                </a></li>

                <li><a href="https://discord.gg/erRKKqR" target="_blank">
                    <i class="fab fa-discord uk-text-secondary"></i> Discord
                </a></li>

                <li><a href="https://vrchat.com/home/user/usr_5ae64a0e-3f9c-4cf7-b349-2dfd2a93dcaa" target="_blank">
                    <i class="fas fa-circle uk-text-secondary"></i> VRChat

                </a></li>

                <li><a href="https://github.com/LoliE1ON" target="_blank">
                    <i class="fab fa-github uk-text-secondary"></i> GitHub
                </a></li>

            </ul>
            
        </div>

        <Discord></Discord>
        
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