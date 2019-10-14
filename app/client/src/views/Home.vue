<template>
  <div class="uk-margin">

    <ul uk-tab>
      <li>
        <a href="#">
          <i class="fas fa-globe-europe"></i> Worlds
        </a>
      </li>
      <li>
        <a href="#">
          <i class="fas fa-chart-area"></i> 5 Пятерочка Statistics
        </a>
      </li>
    </ul>

    <ul class="uk-switcher uk-margin">
      <li>
        <Worlds :displayTitle="false"></Worlds>
      </li>
      <li>
        <Statistic></Statistic>
      </li>
    </ul>

  </div>
</template>

<script>

    import Statistic from "../components/vrchat/Statistic";
    import Worlds from "../components/vrchat/Worlds";

	export default {

		name: 'Home',
		data: function() {
			return {
				statistics: []
			};
		},
        components: {
		    Statistic,
            Worlds
        }

	}

</script>