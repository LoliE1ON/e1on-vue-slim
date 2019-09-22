<template>
  <div>
      <div class="uk-card uk-card-default uk-card-body uk-card-solid">

        <ul class="uk-breadcrumb">

            <li><router-link to="/"><i class="fas fa-home"></i> Home</router-link></li>

            
            <li v-for="breadcrumb in $route.meta.Breadcrumb" :class="breadcrumb.pathClass">
                <router-link :to="breadcrumb.path">
                    <i :class="breadcrumb.iconClasses"></i> {{ breadcrumb.name }}
                </router-link>
            </li>


        </ul>
      
      </div>

  </div>
</template>

<script>

export default {
  name: 'Breadcrumb'
}
</script>