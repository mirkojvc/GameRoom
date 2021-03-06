
@foreach($posts as $post)
<article class="is-post is-post-excerpt">
        <header>
          <h2>{{$post->title}}</h2></header>
        <a href="#"  style="text-align:center;" class=" image-full"><img src="{{asset($post->first_image)}}" alt="" width="300px" height = ""></a>
        <p> {{$post->text}}</p>
</article>
@endforeach

      <div class="pager">
        @if(intval($page) !== 1)
        <a href = "{{ intval($page)-1 }}" class = "button previous pagination_button" data-page = "pagination/{{ intval($page)-1 }}">Previous Page</a>
        @endif
        <div class="pages">
        @for($i = 0; $i<$pages_no; $i++)
        <a href = ""  class = "pagination_button {{$i+1 === intval($page)? 'active' : ''}}" data-page = "pagination/{{$i+1}}">{{$i+1}}</a>
        @endfor
        </div>
        @if(intval($page) !== intval($pages_no))
        <a href = "{{ intval($page)+1 }}"  class = "button next pagination_button"  data-page = "pagination/{{ intval($page)+1 }}">Next Page</a> </div>
        @endif
    </div>
