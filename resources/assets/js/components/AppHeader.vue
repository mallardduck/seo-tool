<template>
    <div>
  
    <nav class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Liquid Web - SEO Tool</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><router-link to="/">Dashboard</router-link></li>
          <li><router-link to="/errors">Non 2xx responses</router-link></li>
          <li><router-link to="/all">All crawled links</router-link></li>
          <li><router-link to="/links">links Dashboard</router-link></li>
        </ul>
        <div class="navbar-form navbar-right">
        <span>CrawlStatus: <span class="label" v-bind:class="{ 'label-default': !crawlClass, 'label-primary': crawlClass, 'label-success': crawlClass === 2 }">{{ crawlStatus }}</span></span>
          <div class="form-group">
            <input type="text" class="form-control" v-model="url" placeholder="https://example.com">
            <select v-model="crawlType">
              <option v-for="item in crawlOptions" :value="item.value" v-text="item.text"></option>
            </select>
          </div>
          <button class="btn btn-default" v-show="crawlerIsNotBusy" @click="startCrawling">Start crawling</button>
        </div>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>


  <h1 v-show="hasActiveUrl">Seo report for {{ activeUrl }}</h1>

    </div>
</template>

<script>
export default {
    computed: {
        crawlStatus() {
        return this.$store.state.crawlStatus
        },
        
        crawlerIsNotBusy()  {
           return this.$store.state.crawlStatus != 'busy';
        },

        crawlClass() {
          if (this.$store.state.crawlStatus == "finished") {
            return 2
          }
          if (this.$store.state.crawlStatus == "idle") {
            return 0
          }
          return 1
        },

        hasActiveUrl() {
           return this.activeUrl != '';
        },

        activeUrl() {
           return this.$store.state.activeUrl;
        },
    },

    data: function () {
      return {
        crawlType: 'default',
        crawlOptions: [{
          value: 'default',
          text: 'Default'
        },{
          value: 'redirect',
          text: 'Redirects'
        }]
      }
    },

    methods: {
        startCrawling() {
            this.$store.dispatch('startCrawling', {'url': this.url, 'crawlType': this.crawlType})
        },
    }
}

</script>
