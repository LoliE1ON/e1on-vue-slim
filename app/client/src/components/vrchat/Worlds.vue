<template>
    <div>

        <div v-show="loading" class="uk-text-lead uk-margin">
            <i class="fas fa-circle-notch fa-spin"></i> Loading worlds...
        </div>
        
        <div v-show="displayTitle">
            <div v-show="!loading" class="uk-text-lead uk-margin">
                <i class="fas fa-globe-europe"></i> E1ON Worlds
            </div>
        </div>

        <article v-for="world in worlds" class="uk-comment uk-card uk-card-default uk-card-body uk-card-solid">
            <header class="uk-comment-header uk-grid-medium uk-flex-middle" uk-grid>
                <div class="uk-width-auto">
                    <img class="uk-comment-avatar uk-border-rounded" :src="world.imageUrl" width="200" height="200" alt="">
                </div>
                <div class="uk-width-expand">
                    <h3 class="uk-comment-title uk-margin-remove">
                        <a class="uk-link-reset" :href="'https://vrchat.com/home/world/' + world.id" target="_blank">
                            {{world.name}}
                        </a>
                    </h3>

                    <ul class="uk-list uk-margin-small">
                        <li class="uk-text-break uk-text-small uk-text-muted">
                            <i class="fas fa-map"></i> {{world.description}}
                        </li>
                        <li class="uk-text-small">
                            <i class="fas fa-star uk-text-danger"></i> Favorites <span class="uk-label">{{world.favorites}}</span>
                        </li>
                        <li class="uk-text-small">
                            <i class="fas fa-eye uk-text-danger"></i> Visits <span class="uk-label">{{world.visits}}</span>
                        </li>
                    </ul>

                </div>
            </header>
        </article>

    </div>
</template>

<script>

import vrchatConfig from "../../config/vrchat"
import Worlds from "../../store/worlds.js"

export default {
    name: 'Worlds',
    data: function () {
        return {
            worlds: Worlds.getters.worlds,
            loading: true,
        }
    },
    props: {
        displayTitle: {
            type: Boolean,
            default: true,
        },
    },
    methods: {
        loadWorlds () {
            
            if (this.worlds.length == 0) {
                this.request ();
            }
            else {
                this.loading = false;
            }

        },
        request () {

            vrchatConfig.watchWorlds.forEach ((worldId) => {

                // query user auth
                axios.post(
                    this.$root.api.API_BASEURL +
                    this.$root.api.API_VRCHAT_GETWORLD,
                    {
                        worldId: worldId
                    }
                )
                .then(response => {

                    if (response.status === 200) {

                        let data = JSON.parse(response.data.data).data;
                        Worlds.commit("add", data);
                        this.loading = false;

                    }

                });

            });
        }
    },
    created () {
        this.loadWorlds ();
    }
}
</script>