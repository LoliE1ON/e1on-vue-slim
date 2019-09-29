<template>
	<div></div>
</template>

<script>

	import User from "../store/user.js"

	export default {

		name: 'Logout',
		methods: {

			logoutUser () {

				User.commit ('logoutUser', {});
				this.$router.push('/');

			}

		},
		created () {

			this.logoutUser ();

		}

	}

</script>