<p>{{ $user->name ? "$user->name" : "$user->email" }}様</p>

<p>{!! nl2br( $data['message'] ) !!}</p>