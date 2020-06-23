<template>
  <div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 work-item">
    <img v-bind:src="photoUrl" alt="" class="img-responsive">
    <slot name="book-link"></slot>
    <slot name="book-title"></slot>
    <slot name="book-status"></slot>
  </div>
</template>

<script>
export default {
  data () {
    return {
      photoUrl: null
    }
  },
  props: {
    isbn: {
      type: String,
    }
  },
  methods: {
    // isbnコードから画像URLを取得
    async fetchPhoto () {
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
