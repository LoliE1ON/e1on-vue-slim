<template>
    <div id="app">
        <div>

			<Header v-show="skeleton"/>

			<div class="uk-grid-collapse" uk-grid>

				<div class="uk-width-1-4 app-sidebar" uk-height-viewport="expand: true" v-show="skeleton">
					<Sidebar/>
				</div>

				<div class="uk-width-expand" style="padding: 20px;">
						<Breadcrumb v-show="skeleton"/>
						<router-view/>
				</div>
				
			</div>

			<Footer v-show="skeleton"/>

    	</div>

    </div>
        
</template>

<script>

	import Sidebar from './components/Sidebar';
	import Header from './components/Header';
	import Footer from './components/Footer';
	import Breadcrumb from './components/Breadcrumb';

	export default {

		name: 'App',
		data: function () {
			return {
				skeleton: true
			}
		},
		components: {
			Sidebar,
			Header,
			Footer,
			Breadcrumb
		},
		mounted () {
			this.skeleton = !this.$route.meta.hideSkeleton;
				console.log (this.$route.meta.hideSkeleton);
			if (typeof this.$route.meta.hideSkeleton === Boolean) {
				console.log (this.$route.meta.hideSkeleton);
			}

		}

	}

</script>