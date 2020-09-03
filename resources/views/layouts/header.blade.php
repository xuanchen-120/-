 <nav class="nav cn_nav" data-display=""  data-show-single="true" data-active-class="active" data-animate="false" style="margin-bottom: 0">
        <span data-href="{{ route('chant.index') }}"  @if(url()->current()==route('chant.index')) class="active" @endif >诵经</span>
        <span data-href="{{ route('write.index') }}"  @if(url()->current()==route('write.index')) class="active" @endif >抄经</span>
    </nav>
