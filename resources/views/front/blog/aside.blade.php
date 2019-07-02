<div class="p-3 mb-3 bg-transparent rounded">
    <h4 class="font-italic">About</h4>
    <p class="mb-0">
        <em>Victor&middot;Frankenstein</em>
        <br>
        Even if my dreams are lonely,  I will not forget to cheer myself up. At least, The funny cigarettes will accompany me to the end! —LNMPA
    </p>
</div>
<div class="p-3">
    <h4 class="font-italic">Archives</h4>
    <ol class="list-unstyled mb-0">
        <li><a href="{{route('blog.index')}}">Home</a></li>
        @forelse($archives as $month)
        <li><a href="{{ route('blog.index', ['month'=>$month['date']]) }}">{{ $month['text'] }}</a></li>
        @empty
            <li><a href="">null</a></li>
        @endforelse
    </ol>
</div>
<div class="p-3">
    <h4 class="font-italic">Elsewhere</h4>
    <ol class="list-unstyled">
        @forelse($elsewhere as $key=>$val)
            <li><a href="{{ $val }}" target="_blank">{{ ucfirst($key) }}</a></li>
        @empty
            <li><a href="">null</a></li>
        @endforelse
    </ol>
</div>
