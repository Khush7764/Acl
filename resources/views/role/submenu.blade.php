<ul>
@foreach($childs as $child)
    <li class="list-unstyled">
       <input type="checkbox" name="permission_id[]" value="{{ $child->id }}" @if (!empty($role_id)) {{(in_array($child->id, $userPer)) ? 'checked' : '' }} @endif> {{ $child->menu_name }} 
</li>
       @if(count($child->subMenus) > 0)
            @include('role.submenu',['childs' => $child->subMenus])
        @endif
   </li>
@endforeach
</ul>