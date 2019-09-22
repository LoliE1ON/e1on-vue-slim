<template>
  <div id="app">

    <div>

        <Header/>

        <div class="uk-grid-collapse" uk-grid>

            <div class="uk-width-1-4 app-sidebar" uk-height-viewport="expand: true">
                <Sidebar/>
            </div>

            <div class="uk-width-expand" style="padding: 20px;">
                <Breadcrumb/>
                <router-view/>
            </div>
            
        </div>

        <Footer/>

    </div>

  </div>
</template>

<script>
import Sidebar from './components/Sidebar'
import Header from './components/Header'
import Footer from './components/Footer'
import Breadcrumb from './components/Breadcrumb'

export default {
  name: 'App',
  components: {Sidebar, Header, Footer, Breadcrumb}
}
</script>