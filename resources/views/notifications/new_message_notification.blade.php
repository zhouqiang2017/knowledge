<li class="notifications {{ $notification->unread() ? 'unread' : '' }}">
    <a href="{{$notification->unread()?'/notifications/'.$notification->id.'?redirect_uri=/inbox/'.$notification->data['dialog']:'/inbox/'.$notification->data['dialog'] }}">
        {{ $notification->data['name'] }}私撩了你。
    </a>
</li>
