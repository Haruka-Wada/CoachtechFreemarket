<p>{{ $user->name ? "$user->name" : "$user->email" }}様</p>

<p>{!! nl2br(e($data['message'])) !!}</p>