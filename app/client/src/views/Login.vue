<template>
    <div class="login">
        <div class="uk-alert-warning" uk-alert v-show="loginStatus">
            <p>
                <i class="fas fa-exclamation-triangle"></i> Login or password incorrect
            </p>
        </div>

        <div class="uk-card uk-card-default uk-card-body">
            <fieldset class="uk-fieldset">
                <legend class="uk-legend">Login to dashboard</legend>

                <div class="uk-margin">
                        <input class="uk-input" type="text" placeholder="Your login" v-model="login" />
                </div>

                <div class="uk-margin">
                        <input class="uk-input" type="password" placeholder="Password" v-model="password" />
                </div>

                <div class="uk-margin">
                        <button class="uk-button uk-button-secondary uk-width-1-1" @click="signIn">
                            <i :class="loginButtonClasses"></i>
                            {{ loginButtonText }}
                        </button>
                </div>
            </fieldset>
        </div>
    </div>
</template>

<script>
import User from "../store/user";

export default {
    name: "Login",
    data: function() {
        return {
            // user enter data
            login: "loli",
            password: "qwerty1",

            wait: false,
            loginStatus: false,

            // data for button
            loginButtonClasses: "fas fa-sign-in-alt",
            loginButtonText: "",

            // default button data
            defaultButtonClasses: "fas fa-sign-in-alt",
            waitButtonClasses: "fas fa-circle-notch fa-spin"
        };
    },
    methods: {

        // klick to login
        signIn() {

            // change button data
            this.loginButtonClasses = this.waitButtonClasses;
            this.loginButtonText = "Wait...";
            this.loginStatus = false;

            // query user auth
            axios.post(
                this.$root.api.API_BASEURL +
                this.$root.api.API_AUTH_GETTOKEN,
                {
                        login: this.login,
                        password: this.password
                },
            )
            .then(response => {

                // change button data
                this.loginButtonClasses = this.defaultButtonClasses;
                this.loginButtonText = "";

                // auth
                if (response.status === 200) {

                    let data = JSON.parse(response.data.data);
                    User.commit("save", data.user);
                    User.commit("changeIsLogged", true);
                    this.$router.push('dashboard');

                } else this.loginStatus = true;

            })
            .catch(error => {
                // change button data
                this.loginButtonClasses = this.defaultButtonClasses;
                this.loginButtonText = "";
            });
        }
    }
};
</script>