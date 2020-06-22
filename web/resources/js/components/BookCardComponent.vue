<template>
  <div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 work-item">
    <a v-bind:href="url">
      <img v-bind:src="photoUrl" alt="" class="img-responsive">
    </a>
    <slot name="book-title"></slot>
    <slot name="book-status"></slot>
  </div>
</template>

<script>
export default {
  data () {
    return {
      url: null,
      isbn: null,
      photoUrl: null
    }
  },
  methods: {
    // isbnコードから画像URLを取得
    async fetchPhoto () {
      console.log(this.isbn);

      const response = await axios.get('https://api.openbd.jp/v1/get?isbn='+this.isbn)
      if(response.data[0] == null){
        this.photoUrl = null
      } else {
        this.photoUrl = response.data[0].summary.cover;
      }
    }
  },
  watch: {
    $route: {
      async handler () {
        await this.fetchPhoto()
      },
      immediate: true
    }
  },
}
</script>
