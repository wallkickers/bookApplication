@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">詳細</div>
                {{-- <div id="book">
                  <book-image :val="aaa"></book-image>
                  <template>
                      <div v-bind:isbn="{{ $book->isbn }}"></div>
                      <img :src="blobUrl" onerror="this.style.display='none'"/>
                  </template>
                </div> --}}
                <book-image-component></book-image-component>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class='table'>
                        <tr>
                          <td>書籍名</td>
                          <td>{{ $book->book_name }}</td>
                        </tr>
                        <tr>
                          <td>書籍名(カナ)</td>
                          <td>{{ $book->title_kana }}</td>
                        </tr>
                        <tr>
                          <td>サブタイトル</td>
                          <td>{{ $book->subtitle }}</td>
                        </tr>
                        <tr>
                          <td>サブタイトル（カナ）</td>
                          <td>{{ $book->subtitle_kana }}</td>
                        </tr>
                        <tr>
                          <td>ISBN</td>
                          <td>{{ $book->isbn }}</td>
                        </tr>
                        <tr>
                          <td>著者</td>
                          <td>{{ $book->author }}</td>
                        </tr>
                        <tr>
                          <td>著者（カナ）</td>
                          <td>{{ $book->author_kana }}</td>
                        </tr>
                        <tr>
                          <td>出版</td>
                          <td>{{ $book->publisher }}</td>
                        </tr>
                        <tr>
                          <td>URL</td>
                          @if (isset($book->url))
                            <td><a href="{{ $book->url }}" target="_blank">{{ $book->url }}</a></td>
                          @else
                            <td>{{ $book->url }}</td>
                          @endif
                        </tr>
                    </table>

                @if (!isset($book->user_id))
                <div class='center'>
                    <a href='{{ route('application.create', ['book' => $book->id]) }}' class='btn-sticky'>貸し出し申請</a>
                </div>
                @endif

                @if ($book->user_id == $user->id)
                <form action='{{ route('application.destroy', ['application' => $book->id]) }}' method='POST'>
                    @method('DELETE')
                    @csrf
                    <div class="button_wrapper">
                        <button type="submit" class='btn-sticky'>返却</button>
                    </div>
                </form>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- @section('script')
<script>
  Vue.config.devtools = true;

  Vue.component("book-image", {
    props: ["blobUrl"],
    // template: "<img :src="{{blobUrl}}"/>"
    template: "<p>{{ blobUrl }}</p>"
  })

  new Vue({
    el: '#book',
    name: "ImageFromApi",
    data: {
      blobUrl: "";
    },
    // mounted() {
    //   axios
    //     .get('https://api.openbd.jp/v1/get?isbn=9784774153773')
    //     .then(response => {
    //       this.blobUrl = response.data[0].summary.cover;
    //     });
    // }
  });

  // export default {
  // name: "ImageFromApi",
  // props: {
  //   apiUrl: {
  //     type: String,
  //     required: true
  //   }
  // },
  // data: function() {
  //   return {
  //     blobUrl: ""
  //   };
  // },
  // mounted() {
  //   axios
  //     .get('https://api.openbd.jp/v1/get?isbn=9784774153773', {
  //       responseType: "blob"
  //     })
  //     .then(response => {
  //       console.log(1);
  //       this.blobUrl = window.URL.createObjectURL(response.data);
  //       console.log(this.blobUrl);
  //       console.log(response.data);
  //     });
  // }
  // };
</script> 
@endsection --}}
