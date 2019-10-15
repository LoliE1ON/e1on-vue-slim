<template>
  <div>

    <article class="uk-comment uk-card uk-card-default uk-card-body">
      <header class="uk-comment-header uk-grid-medium uk-flex-middle" uk-grid>
        <div class="uk-width-auto">
          <img class="uk-comment-avatar uk-border-circle" src="/e1on.jpg" width="40" height="40" alt="E1ON avatar">
        </div>
        <div class="uk-width-expand">
          <h4 class="uk-comment-title uk-margin-remove">Loli E1ON</h4>
            <i class="fas fa-angle-right"></i> <code>This is my website. Here you can view my contacts.</code></span>
        </div>
      </header>
    </article>

    <ul uk-tab>
      <li>
        <a href="#">
          <i class="fas fa-globe-europe"></i> My Worlds
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