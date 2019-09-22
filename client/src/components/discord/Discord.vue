<template>
    <div>

        <div class="uk-card uk-card-default uk-card-body">

            <span style="font-size: 20px;">
                <i class="fab fa-discord"></i> {{ serverName }}
            </span>

            <span class="uk-label uk-label-success uk-float-right">
                <b>{{ online }}</b> online
            </span>

            <ul class="uk-list">

                <li v-for="user in adminUsers">
                    <img :src="user.avatar_url" class="uk-border-circle" style="width: 40px;"/> 
                    <span class="uk-margin-left uk-text-bold uk-text-danger">{{user.username}}</span>
                    <span class="uk-float-right uk-text-bold">
                        <i class="fas fa-circle" :class="viewStatusClass(user.status)"></i>
                    </span>
                </li>

                <div>
                    <div class="uk-text-center uk-padding-small" style="cursor: pointer;" uk-toggle="target: #discord-all-members">
                        <i class="fas fa-users"></i> All members
                    </div>
                    <div id="discord-all-members" hidden>

                        <hr class="uk-divider-icon">
                        <li v-for="user in users">
                            <img :src="user.avatar_url" class="uk-border-circle" style="width: 40px;"/> 
                            <span class="uk-margin-left uk-text-bold">{{user.username}}</span>
                            <span class="uk-float-right uk-text-bold">
                                <i class="fas fa-circle" :class="viewStatusClass(user.status)"></i>
                            </span>
                        </li>

                    </div>
                </div>

            </ul>

        </div>

    </div>
</template>

<script>

import discordConfig from '../../config/discord.js'
import User from '../../store/user.js'

export default {
    name: "Discord",
    data: function() {
        return {
           online: 0,
           serverName: "serverName",
           users: [],
           adminUsers: [],
        };
    },
    methods: {

        responce () {

            // get data from api
            axios.get(
                discordConfig.API_WIDGET_URL
            )
            .then(response => {
                this.serverName = response.data.name;
                this.online = response.data.members.length;
                this.users = response.data.members;

                response.data.members.forEach ((member) => {
                    if (member.username == "E1ON" || member.username == "vard") {
                        this.adminUsers.push (member);
                    }
                });

            }); 
        },
        viewStatusClass (status) {

            if (status == 'online') {
                return 'uk-text-success';
            }
            else if (status == 'idle') {
                return 'uk-text-warning';
            }
            else {
                return 'uk-text-danger';
            }

        }

    },
    computed: {
        user () {
            return User.getters.isLogged;
        }
    },
    watch: {
        user () {
			this.adminUsers = [];
            this.responce();
        }
    }


};
</script>