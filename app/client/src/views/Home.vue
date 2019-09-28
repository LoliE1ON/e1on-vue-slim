<template>
  <div class="uk-margin">

        <VrchatWorlds/>
		

  </div>
</template>

<script>

	import VrchatWorlds from '../components/vrchat/Worlds';

	export default {

		name: 'Home',
		data: function() {
			return {
				statistics: []
			};
		},
		components: {
			VrchatWorlds
		}

	}

</script>