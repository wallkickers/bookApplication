<template>
  <div class="photo-detail">
    <figure class="photo-detail__pane photo-detail__image">
      <img :src="photoUrl" alt="">
    </figure>
  </div>
</template>

<script>
export default {
  data () {
    return {
      photoUrl: null
    }
  },
  methods: {
    async fetchPhoto () {
      const response = await axios.get('https://api.openbd.jp/v1/get?isbn=9784774153773')
      this.photoUrl = response.data[0].summary.cover;
      console.log(this.photoUrl);
    }
  },
  watch: {
    $route: {
      async handler () {
        await this.fetchPhoto()
      },
      immediate: true
    }
  }
}
</script>
