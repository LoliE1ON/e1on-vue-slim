<template>

    <div id="nav">

      <nav class="uk-navbar-container" uk-navbar>
          <div class="uk-navbar-left">

              <ul class="uk-navbar-nav">

                  <router-link to="/" class="uk-navbar-item uk-logo">
                    <i class="fab fa-github ico-margin-large"></i> E1ON
                  </router-link>

                  <li v-show="!user.isLogged">
                    <router-link to="/login"><i class="fas fa-key ico-margin-small"></i> Login</router-link>
                  </li>

              </ul>

          </div>
        
          <div v-show="user.isLogged" class="uk-navbar-right">

              <ul class="uk-navbar-nav">

                  <li>
                    <router-link to="/dashboard" class="uk-text-bold uk-link-black">
                      <i class="fas fa-user-circle ico-margin-small"></i>
                      {{ user.data.login}}
                    </router-link>
                  </li>

              </ul>

          </div>

      </nav>

    </div>
</template>

<script>

import User from '../store/user.js'

export default {
    name: 'Header',
    data: function () {
        return {
            user: User.state
        }
    },
}
</script>